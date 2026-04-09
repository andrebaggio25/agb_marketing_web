<?php
/** @var array<string, array<string,mixed>> $sections */
/** @var array<string, string|null> $settings */
$s = $sections;
$logo = !empty($settings['logo_path']) ? $settings['logo_path'] : '/assets/img/logo.png';
$wa = $settings['whatsapp_url'] ?? '';
?>
<header class="fixed inset-x-0 top-0 z-50 border-b border-burgundy/10 bg-landing/90 shadow-[0_1px_0_rgba(110,15,47,0.04)] backdrop-blur-xl">
  <div class="pointer-events-none absolute inset-x-0 bottom-0 z-[1] h-[2px] bg-burgundy/[0.07]">
    <div id="agb-scroll-progress" class="agb-scroll-line h-full w-full origin-left bg-gradient-to-r from-burgundy via-gold/90 to-burgundy will-change-transform" style="transform:scaleX(0)"></div>
  </div>
  <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-5 sm:px-6">
    <a href="/" class="flex items-center rounded-lg ring-burgundy/0 transition hover:opacity-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-burgundy/30">
      <img src="<?= e($logo) ?>" alt="AGB Marketing" class="h-10 w-auto max-w-[200px] object-contain object-left sm:h-[2.75rem]" width="200" height="52">
    </a>
    <nav class="hidden items-center gap-8 text-sm font-semibold text-charcoal/75 md:flex">
      <a href="#servicos" class="transition hover:text-burgundy">Serviços</a>
      <a href="#metodo" class="transition hover:text-burgundy">Método</a>
      <a href="/blog" class="transition hover:text-burgundy">Blog</a>
      <a href="#contato" class="agb-btn-shimmer relative overflow-hidden rounded-full bg-gradient-to-r from-burgundy to-burgundy-dark px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-burgundy/20 transition hover:brightness-110">Contato</a>
    </nav>
    <div class="flex items-center gap-2 md:hidden">
      <?php if ($wa): ?>
      <a href="<?= e($wa) ?>" class="rounded-full border border-burgundy/25 bg-white/80 px-3 py-1.5 text-xs font-bold text-burgundy" target="_blank" rel="noopener">WA</a>
      <?php endif; ?>
      <button type="button" id="mobile-menu-btn" class="rounded-lg border border-burgundy/15 bg-white/60 p-2 text-charcoal" aria-expanded="false" aria-controls="mobile-menu" aria-label="Abrir menu">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </div>
  <div id="mobile-menu" class="hidden border-t border-burgundy/10 bg-landing/98 shadow-inner md:hidden">
    <div class="mx-auto flex max-w-6xl flex-col gap-1 px-4 py-5 text-sm font-semibold sm:px-6">
      <a href="#servicos" class="rounded-lg py-3 text-charcoal/90 hover:bg-burgundy/5">Serviços</a>
      <a href="#metodo" class="rounded-lg py-3 text-charcoal/90 hover:bg-burgundy/5">Método</a>
      <a href="/blog" class="rounded-lg py-3 text-charcoal/90 hover:bg-burgundy/5">Blog</a>
      <a href="#contato" class="mt-2 rounded-full bg-burgundy py-3.5 text-center text-xs font-bold uppercase tracking-wider text-white">Contato</a>
    </div>
  </div>
</header>

<main class="bg-landing-soft pt-[5.25rem]">
  <!-- Hero -->
  <section class="relative min-h-[88vh] overflow-hidden bg-landing-soft scroll-mt-24">
    <div class="pointer-events-none absolute -left-[25%] top-0 h-[85vh] w-[90vw] max-w-[900px] animate-mesh-drift rounded-full bg-[radial-gradient(ellipse_at_center,rgba(110,15,47,0.12),transparent_68%)] blur-3xl will-change-transform"></div>
    <div class="pointer-events-none absolute -right-[15%] top-10 h-[70vh] w-[70vw] max-w-[700px] animate-mesh-drift-slow rounded-full bg-[radial-gradient(ellipse_at_center,rgba(216,188,103,0.18),transparent_62%)] blur-3xl will-change-transform"></div>
    <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(110,15,47,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(110,15,47,0.04)_1px,transparent_1px)] bg-[size:56px_56px] [mask-image:radial-gradient(ellipse_75%_55%_at_50%_25%,black,transparent_85%)]"></div>
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <?php for ($hi = 0; $hi < 16; $hi++): ?>
      <span class="hero-dot absolute h-1 w-1 rounded-full bg-burgundy/35 animate-twinkle" style="left:<?= 4 + ($hi * 6) % 88 ?>%;top:<?= 8 + ($hi * 11) % 75 ?>%;animation-delay:<?= sprintf('%.2f', $hi * 0.35) ?>s"></span>
      <?php endfor; ?>
    </div>
    <div class="pointer-events-none absolute inset-x-0 top-0 h-[min(100%,900px)] overflow-hidden opacity-40">
      <div class="hero-scan absolute inset-x-[12%] top-0 h-40 bg-gradient-to-b from-gold/30 via-gold/5 to-transparent animate-scan-slow"></div>
    </div>
    <div class="agb-grain" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-0 z-[4] bg-[radial-gradient(ellipse_95%_75%_at_50%_45%,transparent_32%,rgba(74,10,32,0.14)_100%)] mix-blend-multiply" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto flex max-w-6xl flex-col gap-16 px-4 pb-28 pt-16 sm:px-6 lg:flex-row lg:items-center lg:gap-14 lg:pb-36 lg:pt-20">
      <div class="max-w-xl flex-1 lg:max-w-[560px]">
        <div class="inline-flex items-center gap-3 rounded-full border border-burgundy/15 glass-panel-light px-4 py-2.5">
          <span class="relative flex h-2.5 w-2.5">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-burgundy/40"></span>
            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-burgundy shadow-[0_0_10px_rgba(110,15,47,0.35)]"></span>
          </span>
          <span class="text-[10px] font-bold uppercase tracking-[0.4em] text-burgundy"><?= e(section_text($s, 'hero_badge', 'title', 'Performance · conversão · pipeline')) ?></span>
        </div>
        <h1 class="mt-10 font-display text-[2.1rem] font-extrabold leading-[1.08] tracking-tight sm:text-5xl lg:text-[3.25rem] lg:leading-[1.06]">
          <span class="text-gradient-hero-light"><?= nl2br(e(section_text($s, 'hero_title', 'title', 'Tráfego que converte. Funil que fecha.'))) ?></span>
        </h1>
        <p class="mt-8 max-w-lg text-base leading-relaxed text-charcoal/72 sm:text-lg">
          <?= e(section_text($s, 'hero_title', 'subtitle', 'Unimos mídia, páginas e CRM para transformar clique em oportunidade e oportunidade em receita — com métricas que importam para o seu CFO, não só para o feed.')) ?>
        </p>
        <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center">
          <a href="#contato" class="agb-btn-shimmer group relative inline-flex items-center justify-center overflow-hidden rounded-full bg-gradient-to-r from-gold via-[#e0ca7a] to-[#c4a85a] px-8 py-4 text-center text-xs font-bold uppercase tracking-[0.2em] text-charcoal shadow-[0_8px_30px_rgba(216,188,103,0.35)] transition hover:brightness-105 sm:text-sm">
            <?= e(section_text($s, 'hero_cta', 'title', 'Quero falar com a AGB')) ?>
          </a>
          <a href="#metodo" class="inline-flex items-center justify-center gap-2 rounded-full border border-burgundy/20 bg-white/60 px-8 py-4 text-xs font-bold uppercase tracking-[0.2em] text-charcoal/85 shadow-sm transition hover:border-gold/50 hover:text-burgundy sm:text-sm">
            <span class="h-px w-8 bg-gradient-to-r from-transparent via-gold to-burgundy/60"></span>
            Ver o método
          </a>
        </div>
      </div>
      <div class="relative mx-auto w-full max-w-lg flex-1 lg:mx-0 lg:max-w-none">
        <div id="hero-funnel-panel" class="agb-funnel-wrap relative mx-auto max-w-[400px] lg:max-w-[420px]">
          <div class="pointer-events-none absolute -inset-6 animate-spin-slow rounded-full border border-gold/20 [background:conic-gradient(from_200deg_at_50%_50%,transparent_0deg,rgba(216,188,103,0.1)_130deg,transparent_260deg)] opacity-90" aria-hidden="true"></div>
          <div class="relative overflow-hidden rounded-3xl border border-burgundy/12 glass-panel-light p-5 shadow-[0_24px_70px_rgba(110,15,47,0.12)] sm:p-7">
            <div class="flex items-start justify-between gap-3 border-b border-burgundy/10 pb-3 sm:pb-4">
              <div>
                <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-burgundy/75">live.agb // growth_funnel</p>
                <p class="mt-1.5 font-display text-lg font-bold text-charcoal sm:text-xl">Do clique ao cliente fiel</p>
              </div>
              <span class="shrink-0 rounded border border-emerald-600/30 bg-emerald-50/90 px-2 py-0.5 font-mono text-[9px] font-semibold uppercase tracking-wide text-emerald-700">Live</span>
            </div>
            <p class="mt-3 text-[11px] leading-snug text-charcoal/48">Fluxo integrado: cada etapa alimenta a próxima — mídia, experiência, CRM e relacionamento.</p>
            <div class="relative mx-auto mt-5 max-w-[260px] sm:max-w-[280px]">
              <div class="relative aspect-[240/320] w-full">
                <svg class="agb-funnel-svg h-full w-full overflow-visible" viewBox="0 0 240 320" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="hero-funnel-title hero-funnel-desc">
                  <title id="hero-funnel-title">Funil Atração, Conversão e Retenção</title>
                  <desc id="hero-funnel-desc">Ilustração do funil de crescimento em três etapas de cima para baixo.</desc>
                  <defs>
                    <linearGradient id="agb-funnel-grad-1" x1="120" y1="0" x2="120" y2="100" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#8B2244"/>
                      <stop offset="100%" stop-color="#6E0F2F"/>
                    </linearGradient>
                    <linearGradient id="agb-funnel-grad-2" x1="120" y1="100" x2="120" y2="200" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#6E0F2F"/>
                      <stop offset="100%" stop-color="#5c0d28"/>
                    </linearGradient>
                    <linearGradient id="agb-funnel-grad-3" x1="120" y1="200" x2="120" y2="320" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#5c0d28"/>
                      <stop offset="70%" stop-color="#4A0A20"/>
                      <stop offset="100%" stop-color="#6E0F2F"/>
                    </linearGradient>
                    <linearGradient id="agb-funnel-stroke" x1="0" y1="0" x2="240" y2="320" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#D8BC67"/>
                      <stop offset="45%" stop-color="#e8d491"/>
                      <stop offset="100%" stop-color="#6E0F2F"/>
                    </linearGradient>
                    <mask id="hero-funnel-flow-mask" maskUnits="userSpaceOnUse" x="0" y="0" width="240" height="320">
                      <rect width="240" height="320" fill="black"/>
                      <rect class="agb-funnel-mask-rect" x="0" y="0" width="240" height="0" fill="white"/>
                    </mask>
                  </defs>
                  <g mask="url(#hero-funnel-flow-mask)">
                    <path d="M 15 8 L 225 8 L 195 98 L 45 98 Z" fill="url(#agb-funnel-grad-1)"/>
                    <path d="M 45 102 L 195 102 L 175 198 L 65 198 Z" fill="url(#agb-funnel-grad-2)"/>
                    <path d="M 65 202 L 175 202 L 158 305 L 82 305 Z" fill="url(#agb-funnel-grad-3)"/>
                    <path d="M 82 308 L 158 308 L 148 318 L 92 318 Z" fill="url(#agb-funnel-grad-3)"/>
                  </g>
                  <path class="agb-funnel-outline" pathLength="1" d="M 15 8 L 225 8 L 195 98 L 175 198 L 158 305 L 148 318 L 92 318 L 82 305 L 65 198 L 45 98 Z" stroke="url(#agb-funnel-stroke)" stroke-width="2.25" stroke-linejoin="round" stroke-linecap="round" fill="none"/>
                  <path class="agb-funnel-flow-line" pathLength="1" d="M 120 14 L 120 312" fill="none" stroke="url(#agb-funnel-stroke)" stroke-width="1.25" stroke-dasharray="0.05 0.09" stroke-opacity="0.45"/>
                </svg>
                <div class="pointer-events-none absolute inset-0 grid grid-rows-[minmax(0,0.88fr)_minmax(0,1fr)_minmax(0,1.12fr)] text-center font-display font-bold tracking-tight text-white drop-shadow-[0_1px_8px_rgba(0,0,0,0.35)]">
                  <div class="agb-funnel-label agb-funnel-label--1 flex flex-col items-center justify-center pt-1 text-[0.7rem] uppercase leading-tight sm:text-sm">
                    <span>Atração</span>
                    <span class="mt-1 font-body text-[9px] font-normal normal-case tracking-normal text-white/75 sm:text-[10px]">Mídia · alcance</span>
                  </div>
                  <div class="agb-funnel-label agb-funnel-label--2 flex flex-col items-center justify-center text-[0.7rem] uppercase leading-tight sm:text-sm">
                    <span>Conversão</span>
                    <span class="mt-1 font-body text-[9px] font-normal normal-case tracking-normal text-white/75 sm:text-[10px]">Página · CRM · automação</span>
                  </div>
                  <div class="agb-funnel-label agb-funnel-label--3 flex flex-col items-center justify-center pb-2 text-[0.7rem] uppercase leading-tight sm:text-sm">
                    <span>Retenção</span>
                    <span class="mt-1 font-body text-[9px] font-normal normal-case tracking-normal text-white/75 sm:text-[10px]">Relacionamento · LTV</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Strip -->
  <section class="relative border-y border-burgundy/10 bg-landing-deep py-8 md:py-12">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_100%_80%_at_50%_50%,rgba(110,15,47,0.05),transparent)]"></div>
    <?php
    $stripItems = ['Tráfego pago', 'Social media', 'Sites & conversão', 'Automação & CRM', 'Software'];
    ?>
    <div class="relative mx-auto max-w-6xl px-4 sm:px-6">
      <div class="relative md:hidden">
        <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-10 bg-gradient-to-r from-landing-deep to-transparent" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-10 bg-gradient-to-l from-landing-deep to-transparent" aria-hidden="true"></div>
        <div class="flex flex-nowrap items-stretch justify-start gap-x-8 overflow-x-auto pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
          <?php foreach ($stripItems as $si => $label): ?>
            <?php if ($si > 0): ?>
          <span class="h-auto w-px shrink-0 self-center bg-burgundy/15" aria-hidden="true"></span>
            <?php endif; ?>
          <span class="flex shrink-0 items-center whitespace-nowrap py-2 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-charcoal/60"><?= e($label) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="hidden overflow-hidden md:block">
        <div class="agb-strip-marquee">
          <?php for ($dup = 0; $dup < 2; $dup++): ?>
          <div class="flex shrink-0 items-center <?= $dup === 1 ? 'agb-strip-marquee__dup ' : '' ?>">
            <?php foreach ($stripItems as $si => $label): ?>
              <?php if ($si > 0): ?>
            <span class="mx-6 h-4 w-px shrink-0 bg-burgundy/15" aria-hidden="true"></span>
              <?php endif; ?>
            <span class="flex shrink-0 items-center whitespace-nowrap text-xs font-semibold uppercase tracking-[0.28em] text-charcoal/60 lg:text-sm"><?= e($label) ?></span>
            <?php endforeach; ?>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Dor → transformação -->
  <section id="diagnostico" class="agb-section scroll-mt-24">
    <div class="agb-section-glow" aria-hidden="true"></div>
    <div class="agb-section-inner agb-section-pad">
      <div class="grid gap-14 lg:grid-cols-5 lg:items-start lg:gap-12 xl:gap-16">
        <div class="lg:col-span-3" data-reveal>
          <p class="agb-kicker">Diagnóstico</p>
          <h2 class="mt-4 font-display text-3xl font-bold leading-tight text-charcoal sm:text-4xl lg:text-[2.5rem]">Budget que entra. Lead que esfria. Venda que não fecha.</h2>
          <p class="mt-8 text-lg leading-relaxed text-charcoal/68 md:text-xl">
            <?= e(section_text($s, 'pain_block', 'body', 'Isso costuma ser sintoma de funil quebrado: criativo forte com página fraca, formulário sem SLA, CRM vazio ou campanha sem north star. A AGB liga anúncio → página → follow-up → dado — para você saber o que escala e o que cortar.')) ?>
          </p>
          <a href="#contato" class="agb-cta-outline mt-10">Mapear meu funil</a>
        </div>
        <div class="rounded-3xl border border-burgundy/20 bg-burgundy/[0.07] p-8 shadow-[0_20px_50px_rgba(110,15,47,0.08)] sm:p-10 lg:col-span-2" data-reveal>
          <h3 class="font-display text-xl font-bold text-burgundy">O que muda na prática</h3>
          <ul class="mt-8 space-y-5 text-charcoal/85">
            <li class="flex gap-4">
              <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-gold/45 bg-white/90 text-burgundy shadow-sm" aria-hidden="true">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              </span>
              <span class="pt-1">CPL e CAC com contexto: origem, qualificação e fechamento — não só clique barato.</span>
            </li>
            <li class="flex gap-4">
              <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-gold/45 bg-white/90 text-burgundy shadow-sm" aria-hidden="true">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              </span>
              <span class="pt-1">Páginas e jornadas desenhadas para conversão, com testes e mensagem alinhada à oferta.</span>
            </li>
            <li class="flex gap-4">
              <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-gold/45 bg-white/90 text-burgundy shadow-sm" aria-hidden="true">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              </span>
              <span class="pt-1">CRM e automação para o time comercial responder no tempo certo e não perder oportunidade.</span>
            </li>
          </ul>
          <a href="#contato" class="agb-btn-shimmer relative mt-10 inline-flex w-full overflow-hidden rounded-full bg-gradient-to-r from-burgundy to-burgundy-dark py-3.5 text-center text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-burgundy/20 transition hover:brightness-110 sm:w-auto sm:px-8">Pedir retorno da AGB</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Serviços -->
  <section id="servicos" class="agb-section scroll-mt-24 bg-landing-soft">
    <div class="agb-section-glow" aria-hidden="true"></div>
    <div class="agb-section-inner agb-section-pad">
      <div class="mx-auto max-w-3xl text-center" data-reveal>
        <p class="agb-kicker">Stack de crescimento</p>
        <h2 class="mt-5 font-display text-3xl font-bold leading-tight text-charcoal sm:text-4xl md:text-5xl"><?= e(section_text($s, 'services_intro', 'title', 'Um stack que empurra a mesma meta: conversão')) ?></h2>
        <p class="mt-6 text-base leading-relaxed text-charcoal/65 md:text-lg"><?= e(section_text($s, 'services_intro', 'subtitle', 'Nada aqui é “pacote bonito”: cada peça existe para alimentar lead qualificado, velocidade comercial e previsibilidade de receita.')) ?></p>
        <a href="#contato" class="agb-cta-outline mt-10">Ver encaixe no meu negócio</a>
      </div>
      <?php
      $svc = [
        ['01', 'Tráfego pago', 'Aquisição com criativo, público e mensagem testados — com otimização semanal em CPA, ROAS e qualidade de lead.', 'M12 2v20M2 12h20M4.93 4.93l14.14 14.14M4.93 19.07L19.07 4.93', 'lg:col-span-7'],
        ['02', 'Social media', 'Conteúdo e prova social que empurram consideração e remarketing — alinhados ao que a mídia e o site precisam converter.', 'M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0', 'lg:col-span-5'],
        ['03', 'Criação de sites', 'Landing e site com velocidade, clareza de oferta e CTA — para o tráfego pago não morrer na primeira dobra.', 'M4 4h16v16H4V4zm2 4h12v8H6V8zm2 4h8M8 16h8', 'lg:col-span-4'],
        ['04', 'Automações', 'Gatilhos, e-mail e WhatsApp no timing certo: menos lead esfriando, mais resposta e reunião agendada.', 'M13 10V3L4 14h7v7l9-11h-7z', 'lg:col-span-4'],
        ['05', 'CRM', 'Pipeline visível, etapas e SLA: você sabe onde trava e o que repetir para bater meta.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', 'lg:col-span-4'],
        ['06', 'Software sob medida', 'Integrações, dashboards e ferramentas internas quando o padrão de mercado não acompanha seu processo.', 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'lg:col-span-12'],
      ];
      ?>
      <div class="mt-20 grid auto-rows-fr gap-5 sm:grid-cols-2 lg:grid-cols-12">
        <?php foreach ($svc as $si => $row): ?>
        <?php
          $isCore = $si === 0;
          $isConv = $si === 2;
          $borderRing = $isCore
              ? 'ring-2 ring-gold/50 border-gold/40'
              : ($isConv ? 'ring-1 ring-gold/40 border-gold/30' : 'border-burgundy/10');
        ?>
        <article class="agb-card-lift group relative overflow-hidden rounded-3xl border bg-white/85 p-7 shadow-sm transition duration-500 hover:border-gold/40 hover:shadow-[0_24px_60px_-12px_rgba(110,15,47,0.15)] sm:p-9 <?= e($borderRing) ?> <?= e($row[4]) ?>" data-reveal data-reveal-delay="<?= (int) ($si * 70) ?>">
          <?php if ($isCore): ?>
          <span class="absolute right-4 top-4 z-[1] rounded-full border border-gold/55 bg-gold/20 px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-wider text-burgundy-dark">Core</span>
          <?php elseif ($isConv): ?>
          <span class="absolute right-4 top-4 z-[1] rounded-full border border-gold/40 bg-white/90 px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-wider text-burgundy">Conversão</span>
          <?php endif; ?>
          <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-gold/10 blur-2xl transition group-hover:bg-gold/15"></div>
          <div class="flex items-start gap-5">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-burgundy/15 bg-landing-soft shadow-inner">
              <svg class="h-7 w-7 text-burgundy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="<?= e($row[3]) ?>"/></svg>
            </div>
            <div class="min-w-0 flex-1">
              <span class="font-mono text-[10px] font-bold uppercase tracking-[0.25em] text-burgundy/70"><?= e($row[0]) ?></span>
              <h3 class="mt-2 font-display text-xl font-bold text-charcoal sm:text-2xl"><?= e($row[1]) ?></h3>
              <p class="mt-4 text-sm leading-relaxed text-charcoal/62 sm:text-base"><?= e($row[2]) ?></p>
              <?php if ($si <= 1): ?>
              <a href="#contato" class="mt-5 inline-flex text-[11px] font-bold uppercase tracking-wider text-burgundy underline decoration-gold/50 decoration-2 underline-offset-4 transition hover:text-burgundy-dark">Falar sobre <?= e($row[1]) ?></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="mt-8 h-px w-0 bg-gradient-to-r from-gold/70 to-burgundy/30 transition-all duration-500 group-hover:w-full"></div>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="mt-16 text-center" data-reveal>
        <a href="#contato" class="agb-btn-shimmer relative inline-flex overflow-hidden rounded-full bg-gradient-to-r from-gold via-[#e0ca7a] to-[#c4a85a] px-10 py-4 text-xs font-bold uppercase tracking-[0.18em] text-charcoal shadow-[0_8px_30px_rgba(216,188,103,0.35)] transition hover:brightness-105">Quero priorizar o que converte</a>
      </div>
    </div>
  </section>

  <!-- Manifesto -->
  <section class="agb-section bg-landing">
    <div class="agb-section-glow-strong opacity-80" aria-hidden="true"></div>
    <div class="agb-section-inner agb-section-pad-md">
      <?php
      $manifestDefault = 'Vanity metric não paga folha. Acreditamos em execução que aparece no funil: lead melhor, ciclo mais curto, receita mais previsível.';
      $manifestBody = section_text($s, 'manifest', 'body', $manifestDefault);
      ?>
      <div class="relative mx-auto max-w-4xl text-center" data-reveal>
        <p class="agb-kicker">Manifesto</p>
        <?php if (trim($manifestBody) === trim($manifestDefault)): ?>
        <blockquote class="mt-6 font-display text-2xl font-bold leading-snug text-charcoal sm:text-3xl md:text-[1.85rem] md:leading-snug lg:text-4xl">
          “<span class="text-burgundy sm:text-[1.07em] sm:font-extrabold">Vanity metric</span> não paga folha. Acreditamos em execução que aparece no <span class="text-burgundy sm:text-[1.07em] sm:font-extrabold">funil</span>: <span class="italic text-burgundy/95">lead melhor</span>, <span class="italic text-burgundy/95">ciclo mais curto</span>, <span class="text-burgundy sm:text-[1.07em] sm:font-extrabold">receita mais previsível</span>.”
        </blockquote>
        <?php else: ?>
        <blockquote class="mt-6 font-display text-2xl font-bold leading-snug text-charcoal sm:text-3xl md:text-[1.85rem] md:leading-snug lg:text-4xl">
          “<?= e($manifestBody) ?>”
        </blockquote>
        <?php endif; ?>
        <p class="mt-10 text-sm font-semibold uppercase tracking-[0.35em] text-burgundy/80">AGB Marketing</p>
        <a href="#contato" class="agb-cta-outline mt-10">Conversar sobre metas e métricas</a>
      </div>
    </div>
  </section>

  <!-- Método -->
  <section id="metodo" class="agb-section scroll-mt-24 bg-landing-soft">
    <div class="agb-section-glow-strong" aria-hidden="true"></div>
    <div id="roadmap-section" class="agb-section-inner agb-section-pad">
      <div class="mb-20 text-center" data-reveal>
        <p class="agb-kicker">roadmap.agb</p>
        <h2 class="mt-5 font-display text-3xl font-bold text-charcoal sm:text-4xl md:text-5xl">Método</h2>
        <p class="mx-auto mt-6 max-w-xl text-base leading-relaxed text-charcoal/65 md:text-lg">Da leitura do funil ao ritmo de otimização — com entregas que você consegue auditar em número.</p>
        <a href="#contato" class="agb-cta-outline mt-8">Alinhar próximo passo</a>
      </div>
      <?php
      $steps = [
        ['Diagnóstico', 'Levantamos gargalos em aquisição, página, resposta comercial e CRM — e definimos 2–3 alavancas com maior impacto em conversão.'],
        ['Estratégia', 'Priorizamos canal, oferta e mensagem com metas de CAC, MQL/SQL ou receita, não só alcance.'],
        ['Execução', 'Campanhas, criativos, páginas e automações em ciclo curto de teste → aprendizado → ajuste.'],
        ['Escala', 'CRM, playbooks e, quando fizer sentido, software para repetir o que já provou fechar negócio.'],
      ];
      ?>
      <div class="relative hidden md:block">
        <svg class="mb-6 h-32 w-full" viewBox="0 0 1000 100" preserveAspectRatio="none" aria-hidden="true">
          <defs>
            <linearGradient id="roadmap-grad" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" stop-color="#6E0F2F" stop-opacity="0.95"/>
              <stop offset="50%" stop-color="#D8BC67" stop-opacity="1"/>
              <stop offset="100%" stop-color="#6E0F2F" stop-opacity="0.95"/>
            </linearGradient>
          </defs>
          <path class="roadmap-path-el" pathLength="1" d="M 40 52 C 200 18, 350 88, 500 52 S 800 18, 960 52" fill="none" stroke="url(#roadmap-grad)" stroke-width="2.5" stroke-linecap="round" vector-effect="non-scaling-stroke"/>
        </svg>
        <ol class="relative -mt-8 grid grid-cols-4 gap-8">
          <?php foreach ($steps as $i => $st): ?>
          <li class="roadmap-step text-center" data-reveal data-reveal-delay="<?= (int) ($i * 100) ?>" data-step="<?= (int) $i ?>">
            <div class="agb-roadmap-node mx-auto flex h-16 w-16 items-center justify-center rounded-full border-2 border-gold/60 bg-white shadow-[0_12px_40px_rgba(110,15,47,0.12)] transition duration-500 hover:scale-105 hover:border-gold" style="animation-delay:<?= sprintf('%.2f', $i * 0.35) ?>s">
              <span class="font-display text-xl font-black text-burgundy"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            </div>
            <h3 class="mt-6 font-display text-lg font-bold text-charcoal"><?= e($st[0]) ?></h3>
            <p class="mt-3 text-sm leading-relaxed text-charcoal/60"><?= e($st[1]) ?></p>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
      <div class="space-y-4 md:hidden">
        <?php foreach ($steps as $i => $st): ?>
        <div class="flex gap-4 rounded-2xl border border-burgundy/10 border-l-[3px] border-l-gold/50 bg-white/90 p-5 pl-4 shadow-sm" data-reveal data-reveal-delay="<?= (int) ($i * 90) ?>">
          <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border-2 border-gold/55 bg-landing-soft font-display text-sm font-black text-burgundy shadow-sm"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <div class="min-w-0 pt-0.5">
            <h3 class="font-display text-lg font-bold text-charcoal"><?= e($st[0]) ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-charcoal/60"><?= e($st[1]) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="mt-16 text-center md:mt-20" data-reveal>
        <a href="#contato" class="agb-btn-shimmer relative inline-flex overflow-hidden rounded-full bg-gradient-to-r from-gold via-[#e0ca7a] to-[#c4a85a] px-10 py-4 text-xs font-bold uppercase tracking-[0.18em] text-charcoal shadow-[0_8px_30px_rgba(216,188,103,0.35)] transition hover:brightness-105">Agendar conversa técnica</a>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="agb-section bg-landing">
    <div class="agb-section-glow opacity-70" aria-hidden="true"></div>
    <div class="agb-section-inner agb-section-pad-md">
      <h2 class="text-center font-display text-3xl font-bold text-charcoal md:text-4xl">Perguntas frequentes</h2>
      <div class="mx-auto mt-14 max-w-3xl space-y-3">
        <?php
        $faqs = [
          ['A AGB só cuida de anúncio?', 'Não. Anúncio sem página e follow-up é dinheiro jogado. Integramos mídia, conversão, CRM e automação para o lead não morrer no meio do funil.'],
          ['Com quem vocês trabalham melhor?', 'Negócios B2B e B2C que já investem em aquisição ou estão prontos para investir — e querem número de oportunidade/receita, não só impressão.'],
          ['Como sabemos se está funcionando?', 'Combinamos metas (ex.: CPL, taxa de qualificação, taxa de reunião, receita atribuída) e revisamos em ritmo fixo — transparente para time de marketing e comercial.'],
        ];
        foreach ($faqs as $fi => $faq):
            $fid = 'faq-' . (int) $fi;
        ?>
        <div class="agb-faq-item rounded-2xl border border-burgundy/10 bg-white/90 shadow-sm" data-reveal data-reveal-delay="<?= (int) ($fi * 80) ?>">
          <h3 class="m-0">
            <button type="button" class="agb-faq-trigger flex w-full items-start gap-4 px-5 py-5 text-left sm:px-7 sm:py-6" id="<?= e($fid) ?>-btn" aria-expanded="false" aria-controls="<?= e($fid) ?>-panel">
              <span class="font-mono text-[11px] font-bold leading-6 text-burgundy/55"><?= str_pad((string) ($fi + 1), 2, '0', STR_PAD_LEFT) ?></span>
              <span class="flex-1 font-display text-base font-bold text-burgundy sm:text-lg"><?= e($faq[0]) ?></span>
              <svg class="agb-faq-chevron mt-0.5 h-5 w-5 shrink-0 text-burgundy/45" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
          </h3>
          <div class="agb-faq-panel border-t border-burgundy/[0.07] px-5 pb-5 pl-[3.25rem] pr-5 sm:px-7 sm:pb-6 sm:pl-[4.25rem]" id="<?= e($fid) ?>-panel" role="region" aria-labelledby="<?= e($fid) ?>-btn">
            <p class="pt-4 text-sm leading-relaxed text-charcoal/68 md:text-base"><?= e($faq[1]) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="mt-14 text-center" data-reveal>
        <a href="#contato" class="agb-btn-shimmer relative inline-flex overflow-hidden rounded-full bg-gradient-to-r from-burgundy to-burgundy-dark px-10 py-3.5 text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-burgundy/20 transition hover:brightness-110">Tirar dúvidas no contato</a>
      </div>
    </div>
  </section>

  <!-- Contato -->
  <section id="contato" class="relative scroll-mt-24 border-t border-burgundy/10 bg-gradient-to-br from-landing via-landing-soft to-landing-deep py-28 md:py-36 lg:py-40">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(216,188,103,0.12),transparent_50%)]"></div>
    <div class="relative mx-auto grid max-w-6xl gap-14 px-4 sm:gap-16 sm:px-6 lg:grid-cols-2 lg:gap-24">
      <div data-reveal>
        <p class="agb-kicker">Contato</p>
        <h2 class="mt-5 font-display text-3xl font-bold leading-tight text-charcoal sm:text-4xl md:text-[2.75rem]">Conte onde o funil trava. A gente responde com próximo passo.</h2>
        <p class="mt-6 text-lg leading-relaxed text-charcoal/68">Envie contexto (segmento, ticket, canal que já usa). Voltamos com leitura objetiva — o que testar primeiro e o que não faz sentido gastar budget agora.</p>
        <?php
        $fs = $_SESSION['flash_success'] ?? null;
        if ($fs) {
            unset($_SESSION['flash_success']);
        }
        $fe = $_SESSION['flash_error'] ?? null;
        if ($fe) {
            unset($_SESSION['flash_error']);
        }
        ?>
        <?php if ($fe): ?>
        <p class="mt-8 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"><?= e($fe) ?></p>
        <?php endif; ?>
        <p id="lead-form-success" class="<?= $fs ? '' : 'hidden ' ?>mt-8 rounded-xl border border-gold/40 bg-gold/10 px-4 py-3 text-sm font-semibold text-burgundy-dark"><?= $fs ? e($fs) : '' ?></p>
      </div>
      <div class="rounded-3xl border border-burgundy/10 bg-white/95 p-7 shadow-[0_24px_60px_rgba(110,15,47,0.1)] backdrop-blur sm:p-10" data-reveal>
        <form id="lead-form" action="/lead" method="post" class="space-y-5">
          <?= \App\Core\Csrf::field() ?>
          <div>
            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-charcoal/50" for="name">Nome</label>
            <input class="w-full rounded-xl border border-burgundy/15 bg-landing px-4 py-3.5 text-charcoal placeholder:text-charcoal/35 focus:border-gold/50 focus:outline-none focus:ring-2 focus:ring-gold/25" id="name" name="name" required autocomplete="name" placeholder="Seu nome">
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-charcoal/50" for="email">E-mail corporativo</label>
            <input class="w-full rounded-xl border border-burgundy/15 bg-landing px-4 py-3.5 text-charcoal placeholder:text-charcoal/35 focus:border-gold/50 focus:outline-none focus:ring-2 focus:ring-gold/25" type="email" id="email" name="email" required autocomplete="email" placeholder="voce@empresa.com">
          </div>
          <div class="grid gap-5 sm:grid-cols-2">
            <div>
              <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-charcoal/50" for="phone">Telefone / WhatsApp</label>
              <input class="w-full rounded-xl border border-burgundy/15 bg-landing px-4 py-3.5 text-charcoal placeholder:text-charcoal/35 focus:border-gold/50 focus:outline-none focus:ring-2 focus:ring-gold/25" id="phone" name="phone" autocomplete="tel" placeholder="(00) 00000-0000">
            </div>
            <div>
              <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-charcoal/50" for="company">Empresa</label>
              <input class="w-full rounded-xl border border-burgundy/15 bg-landing px-4 py-3.5 text-charcoal placeholder:text-charcoal/35 focus:border-gold/50 focus:outline-none focus:ring-2 focus:ring-gold/25" id="company" name="company" placeholder="Nome da empresa">
            </div>
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-charcoal/50" for="message">Como podemos ajudar?</label>
            <textarea class="min-h-[120px] w-full rounded-xl border border-burgundy/15 bg-landing px-4 py-3.5 text-charcoal placeholder:text-charcoal/35 focus:border-gold/50 focus:outline-none focus:ring-2 focus:ring-gold/25" id="message" name="message" placeholder="Contexto do negócio, desafio principal, prazo..."></textarea>
          </div>
          <p id="lead-form-error" class="hidden text-sm font-semibold text-red-600" role="alert"></p>
          <button type="submit" class="agb-btn-shimmer relative w-full overflow-hidden rounded-full bg-gradient-to-r from-gold to-[#c4a85a] py-4 text-sm font-bold uppercase tracking-widest text-charcoal shadow-lg shadow-gold/20 transition hover:brightness-105">
            Enviar
          </button>
          <p class="text-center text-xs text-charcoal/45">Ao enviar, você concorda com o uso dos dados para contato comercial.</p>
        </form>
      </div>
    </div>
  </section>
  <div id="agb-cursor-glow" class="hidden" aria-hidden="true"></div>
</main>

<footer class="border-t border-burgundy/10 bg-landing-deep py-14 md:py-16">
  <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-8 px-4 text-center text-sm text-charcoal/55 sm:flex-row sm:text-left sm:px-6">
    <div class="flex items-center">
      <img src="<?= e($logo) ?>" alt="AGB Marketing" class="h-10 w-auto max-w-[200px] object-contain sm:h-11">
    </div>
    <div class="flex flex-wrap justify-center gap-8">
      <a href="/blog" class="font-medium transition hover:text-burgundy">Blog</a>
    </div>
    <p class="max-w-xs leading-relaxed sm:max-w-none">© <?= date('Y') ?> AGB Marketing. <?= e(section_text($s, 'footer_tag', 'title', 'Estratégia, performance e crescimento.')) ?></p>
  </div>
</footer>
