<?php

declare(strict_types=1);

return [
    'name' => 'AGB Marketing',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => filter_var(getenv('APP_DEBUG') ?: 'false', FILTER_VALIDATE_BOOL),
    'url' => rtrim(getenv('APP_URL') ?: 'http://localhost', '/'),
    'timezone' => getenv('APP_TIMEZONE') ?: 'America/Sao_Paulo',
    'session_name' => 'agb_session',
];
