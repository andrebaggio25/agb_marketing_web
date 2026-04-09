<?php
/** @var string $title */
/** @var string $metaDescription */
/** @var string $slot */
/** @var array<string, string|null> $settings */
$settings = $settings ?? [];
$logo = !empty($settings['logo_path']) ? $settings['logo_path'] : '/assets/img/logo.png';
$favicon = !empty($settings['favicon_path']) ? $settings['favicon_path'] : '/assets/img/icon.png';
$bodyClass = $bodyClass ?? 'min-h-screen bg-charcoal text-ivory selection:bg-burgundy selection:text-ivory';
?>
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'AGB Marketing') ?></title>
  <?php if (!empty($metaDescription)): ?>
  <meta name="description" content="<?= e($metaDescription) ?>">
  <?php endif; ?>
  <link rel="icon" href="<?= e($favicon) ?>" type="image/png">
  <link rel="apple-touch-icon" href="<?= e($favicon) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="<?= e($bodyClass) ?>">
  <?= $slot ?>
  <script src="/assets/js/app.js" defer></script>
</body>
</html>
