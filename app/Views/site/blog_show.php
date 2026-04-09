<?php
/** @var array<string,mixed> $post */
/** @var array<string, string|null> $settings */
require VIEW_PATH . '/site/partials/nav_public.php';
?>
<article class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
  <p class="text-xs font-bold uppercase tracking-wider text-gold"><?= e($post['category_name'] ?? 'Blog') ?></p>
  <h1 class="mt-3 font-display text-4xl font-bold"><?= e($post['title']) ?></h1>
  <div class="mt-10 space-y-4 leading-relaxed text-ivory/80 [&_a]:text-gold [&_h2]:font-display [&_h2]:mt-8 [&_h2]:text-ivory">
    <?= $post['body'] ?? '' ?>
  </div>
  <p class="mt-12"><a href="/blog" class="text-gold hover:underline">← Voltar ao blog</a></p>
</article>
