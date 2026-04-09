<?php

declare(strict_types=1);

return [
    'from_address' => getenv('MAIL_FROM_ADDRESS') ?: 'noreply@example.com',
    'from_name' => getenv('MAIL_FROM_NAME') ?: 'AGB Marketing',
    'lead_to' => getenv('MAIL_LEAD_TO') ?: getenv('MAIL_FROM_ADDRESS') ?: 'contato@example.com',
    'transport' => getenv('MAIL_TRANSPORT') ?: 'mail', // mail | smtp
    'smtp' => [
        'host' => getenv('SMTP_HOST') ?: '',
        'port' => (int) (getenv('SMTP_PORT') ?: '587'),
        'user' => getenv('SMTP_USER') ?: '',
        'pass' => getenv('SMTP_PASS') ?: '',
        'encryption' => getenv('SMTP_ENCRYPTION') ?: 'tls',
    ],
];
