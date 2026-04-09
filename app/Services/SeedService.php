<?php

declare(strict_types=1);

namespace App\Services;

use PDO;

final class SeedService
{
    public static function run(PDO $pdo): void
    {
        $hash = password_hash('estetica', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            'INSERT INTO users (id, name, email, password_hash, role) VALUES (1, ?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE name = VALUES(name), email = VALUES(email), password_hash = VALUES(password_hash), role = VALUES(role)'
        );
        $stmt->execute(['Administrador', 'andrebaggio25@outlook.com', $hash, 'admin']);

        $defaults = [
            'site_meta_title' => 'AGB Marketing — Estratégia, performance e crescimento',
            'site_meta_description' => 'Impulsionamos marcas com estratégia, performance e foco em resultado.',
            'contact_email' => 'contato@agbmarketing.com.br',
            'contact_phone' => '',
            'whatsapp_url' => '',
            'logo_path' => '/assets/img/logo.png',
            'favicon_path' => '/assets/img/icon.png',
        ];

        foreach ($defaults as $k => $v) {
            $pdo->prepare('INSERT IGNORE INTO settings (`key`, `value`) VALUES (?, ?)')->execute([$k, $v]);
        }

        $sections = [
            ['home', 'hero_badge', 'Estratégia · performance · crescimento', null, null, 0],
            ['home', 'hero_title', 'Crescimento com direção.', 'Estratégia, performance e estrutura para transformar presença digital em resultado real.', null, 1],
            ['home', 'hero_sub', null, null, 'A AGB une comunicação, performance, tecnologia e estrutura comercial em uma mesma direção estratégica.', 2],
            ['home', 'hero_cta', 'Quero um diagnóstico', null, null, 3],
            ['home', 'services_intro', 'Serviços em uma engrenagem de crescimento.', 'Não entregamos apenas execução. Entregamos uma estrutura integrada para atrair, posicionar, converter e crescer.', null, 4],
            ['home', 'pain_block', null, null, 'Muitas empresas investem sem clareza estratégica, geram leads que não convertem e sentem a marca estagnada. A AGB não opera em blocos soltos: posicionamento, atração, conversão, processo e tecnologia trabalham juntos.', 5],
            ['home', 'manifest', null, null, 'Não acreditamos em marketing feito por impulso. Acreditamos em marcas que crescem com clareza — com estratégia, performance e foco no que realmente importa.', 6],
            ['home', 'footer_tag', 'Estratégia, performance e crescimento.', null, null, 7],
        ];

        foreach ($sections as $s) {
            $pdo->prepare(
                'INSERT IGNORE INTO content_sections (page_key, section_key, title, subtitle, body, sort_order) VALUES (?,?,?,?,?,?)'
            )->execute($s);
        }

        $pages = [
            ['Sobre a AGB', 'sobre', '<p>A AGB Marketing se posiciona como parceira estratégica de crescimento.</p>', 'published'],
            ['Política de privacidade', 'privacidade', '<p>Em breve o texto completo desta política.</p>', 'published'],
        ];

        foreach ($pages as $p) {
            $pdo->prepare(
                'INSERT IGNORE INTO pages (title, slug, body, status) VALUES (?,?,?,?)'
            )->execute($p);
        }
    }
}
