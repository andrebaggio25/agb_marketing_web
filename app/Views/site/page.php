<?php
/** @var array<string,mixed> $page */
/** @var array<string, string|null> $settings */
require VIEW_PATH . '/site/partials/nav_public.php';
?>
<article class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
  <header class="mb-12 border-b border-white/10 pb-8">
    <h1 class="font-display text-4xl font-bold text-ivory"><?= e($page['title']) ?></h1>
  </header>
  <div class="space-y-4 leading-relaxed text-ivory/80 [&_a]:text-gold [&_h2]:font-display [&_h2]:text-2xl [&_h2]:text-ivory">
    <?= $page['body'] ?? '' ?>
  </div>
</article>
