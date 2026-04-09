<?php
/** @var array<string, string|null> $settings */
use App\Core\Csrf;
?>
<h1 class="font-display text-2xl font-bold">Configurações</h1>
<form method="post" action="/admin/settings" class="mt-8 max-w-2xl space-y-4">
  <?= Csrf::field() ?>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Meta título global (SEO)</label>
    <input name="site_meta_title" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($settings['site_meta_title'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Meta descrição global</label>
    <textarea name="site_meta_description" rows="3" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2"><?= e($settings['site_meta_description'] ?? '') ?></textarea>
  </div>
  <div class="grid gap-4 sm:grid-cols-2">
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">E-mail de contato (exibido / uso interno)</label>
      <input name="contact_email" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($settings['contact_email'] ?? '') ?>">
    </div>
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Telefone</label>
      <input name="contact_phone" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($settings['contact_phone'] ?? '') ?>">
    </div>
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">URL do WhatsApp (link completo)</label>
    <input name="whatsapp_url" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" placeholder="https://wa.me/55..." value="<?= e($settings['whatsapp_url'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Logo (caminho público)</label>
    <input name="logo_path" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" placeholder="/assets/img/logo.png" value="<?= e($settings['logo_path'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Logo modo escuro (opcional)</label>
    <input name="logo_dark_path" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($settings['logo_dark_path'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Favicon (caminho público)</label>
    <input name="favicon_path" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" placeholder="/assets/img/icon.png" value="<?= e($settings['favicon_path'] ?? '') ?>">
  </div>
  <button type="submit" class="rounded-full bg-gold px-8 py-2 text-sm font-bold uppercase text-charcoal">Salvar</button>
</form>
