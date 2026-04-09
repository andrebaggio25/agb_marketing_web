<?php

declare(strict_types=1);

namespace App\Services;

final class MailService
{
    public static function send(string $to, string $subject, string $body, ?string $replyTo = null): bool
    {
        $mail = config('mail');
        $from = $mail['from_address'] ?? 'noreply@example.com';
        $fromName = $mail['from_name'] ?? 'AGB Marketing';

        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'From: ' . self::encodeHeader($fromName) . ' <' . $from . '>';
        if ($replyTo) {
            $headers[] = 'Reply-To: ' . $replyTo;
        }

        if (($mail['transport'] ?? 'mail') === 'smtp' && !empty($mail['smtp']['host'])) {
            return self::sendSmtp($to, $subject, $body, $from, $fromName, $replyTo, $mail['smtp']);
        }

        return @mail($to, self::encodeSubject($subject), $body, implode("\r\n", $headers));
    }

    private static function encodeSubject(string $subject): string
    {
        return '=?UTF-8?B?' . base64_encode($subject) . '?=';
    }

    private static function encodeHeader(string $name): string
    {
        return '=?UTF-8?B?' . base64_encode($name) . '?=';
    }

    /**
     * SMTP mínimo (AUTH LOGIN) para ambientes que não tenham mail() configurado.
     * @param array<string,mixed> $smtp
     */
    private static function sendSmtp(string $to, string $subject, string $body, string $from, string $fromName, ?string $replyTo, array $smtp): bool
    {
        $host = (string) ($smtp['host'] ?? '');
        $port = (int) ($smtp['port'] ?? 587);
        $user = (string) ($smtp['user'] ?? '');
        $pass = (string) ($smtp['pass'] ?? '');
        $enc = strtolower((string) ($smtp['encryption'] ?? 'tls'));

        $remote = ($enc === 'ssl') ? 'ssl://' . $host : $host;
        $socket = @stream_socket_client($remote . ':' . $port, $errno, $errstr, 15, STREAM_CLIENT_CONNECT);
        if (!$socket) {
            return false;
        }
        stream_set_timeout($socket, 15);
        $read = fn () => fgets($socket, 515);

        if (strpos($read(), '220') === false) {
            fclose($socket);
            return false;
        }
        fwrite($socket, "EHLO agb.local\r\n");
        while ($line = $read()) {
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        if ($enc === 'tls') {
            fwrite($socket, "STARTTLS\r\n");
            $read();
            stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            fwrite($socket, "EHLO agb.local\r\n");
            while ($line = $read()) {
                if (isset($line[3]) && $line[3] === ' ') {
                    break;
                }
            }
        }
        if ($user !== '') {
            fwrite($socket, "AUTH LOGIN\r\n");
            $read();
            fwrite($socket, base64_encode($user) . "\r\n");
            $read();
            fwrite($socket, base64_encode($pass) . "\r\n");
            $resp = $read();
            if (strpos($resp, '235') === false) {
                fclose($socket);
                return false;
            }
        }
        fwrite($socket, 'MAIL FROM:<' . $from . ">\r\n");
        $read();
        fwrite($socket, 'RCPT TO:<' . $to . ">\r\n");
        $read();
        fwrite($socket, "DATA\r\n");
        $read();
        $msg = "Subject: " . self::encodeSubject($subject) . "\r\n";
        $msg .= "From: " . self::encodeHeader($fromName) . " <{$from}>\r\n";
        $msg .= "To: <{$to}>\r\n";
        if ($replyTo) {
            $msg .= "Reply-To: {$replyTo}\r\n";
        }
        $msg .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
        $msg .= str_replace("\n.", "\n..", $body) . "\r\n.\r\n";
        fwrite($socket, $msg);
        $read();
        fwrite($socket, "QUIT\r\n");
        fclose($socket);
        return true;
    }
}
