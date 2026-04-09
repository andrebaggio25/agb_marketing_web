<?php
/** @var array<string, string|null> $settings */
$settings = $settings ?? [];
$logo = !empty($settings['logo_path']) ? $settings['logo_path'] : '/assets/img/logo.png';
?>
<header class="border-b border-white/10 bg-charcoal/95 backdrop-blur">
  <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
    <a href="/" class="flex items-center">
      <img src="<?= e($logo) ?>" alt="AGB Marketing" class="h-9 w-auto max-w-[200px] object-contain sm:h-10">
    </a>
    <nav class="flex gap-4 text-sm font-semibold text-ivory/80">
      <a href="/#servicos" class="hover:text-gold">Serviços</a>
      <a href="/blog" class="hover:text-gold">Blog</a>
      <a href="/#contato" class="rounded-full bg-burgundy px-4 py-1.5 text-xs uppercase tracking-wider hover:bg-burgundy-dark">Contato</a>
    </nav>
  </div>
</header>
