(function () {
  'use strict';

  var lowMotion =
    window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var finePointer = window.matchMedia && window.matchMedia('(pointer: fine)').matches;

  var bar = document.getElementById('agb-scroll-progress');
  function updateScrollBar() {
    if (!bar) return;
    var el = document.documentElement;
    var max = el.scrollHeight - el.clientHeight;
    var p = max > 0 ? el.scrollTop / max : 0;
    bar.style.transform = 'scaleX(' + Math.min(1, Math.max(0, p)) + ')';
  }
  if (bar) {
    window.addEventListener(
      'scroll',
      function () {
        window.requestAnimationFrame(updateScrollBar);
      },
      { passive: true }
    );
    updateScrollBar();
  }

  var glow = document.getElementById('agb-cursor-glow');
  var mainEl = document.querySelector('main');
  if (glow && !lowMotion && finePointer) {
    glow.classList.remove('hidden');
    document.addEventListener('mousemove', function (e) {
      glow.style.left = e.clientX + 'px';
      glow.style.top = e.clientY + 'px';
      if (mainEl && mainEl.contains(e.target)) {
        glow.style.opacity = '0.5';
      } else {
        glow.style.opacity = '0.15';
      }
    });
    document.body.addEventListener('mouseleave', function () {
      glow.style.opacity = '0';
    });
  }

  var btn = document.getElementById('mobile-menu-btn');
  var menu = document.getElementById('mobile-menu');
  if (btn && menu) {
    btn.addEventListener('click', function () {
      menu.classList.toggle('hidden');
      btn.setAttribute('aria-expanded', menu.classList.contains('hidden') ? 'false' : 'true');
    });
    menu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        menu.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      });
    });
  }

  var revealEls = document.querySelectorAll('[data-reveal]');
  if (lowMotion) {
    revealEls.forEach(function (el) {
      el.classList.add('opacity-100', 'translate-y-0');
    });
  } else {
    revealEls.forEach(function (el) {
      el.classList.add('opacity-0', 'translate-y-6', 'transition-all', 'duration-700', 'ease-out');
      var d = el.getAttribute('data-reveal-delay');
      if (d != null && d !== '') {
        el.style.transitionDelay = d + 'ms';
      }
    });
    var obs = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          entry.target.classList.remove('opacity-0', 'translate-y-6');
          entry.target.classList.add('opacity-100', 'translate-y-0');
          obs.unobserve(entry.target);
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
    );
    revealEls.forEach(function (el) {
      obs.observe(el);
    });
  }

  var roadmap = document.getElementById('roadmap-section');
  if (roadmap) {
    if (lowMotion) {
      roadmap.classList.add('is-visible');
    } else {
      var ro = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            roadmap.classList.add('is-visible');
            ro.unobserve(roadmap);
          });
        },
        { threshold: 0.2, rootMargin: '0px 0px -10% 0px' }
      );
      ro.observe(roadmap);
    }
  }

  var funnelPanel = document.getElementById('hero-funnel-panel');
  if (funnelPanel) {
    var maskRect = funnelPanel.querySelector('.agb-funnel-mask-rect');

    function activateHeroFunnel() {
      funnelPanel.classList.add('is-visible');
      if (maskRect) {
        if (lowMotion) {
          maskRect.setAttribute('height', '320');
        }
      }
    }

    if (lowMotion) {
      activateHeroFunnel();
    } else {
      var funnelObs = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            funnelObs.unobserve(funnelPanel);
            funnelPanel.classList.add('is-visible');
            if (!maskRect) return;
            var dur = 2400;
            var start = performance.now();
            function tickMask(now) {
              var t = Math.min(1, (now - start) / dur);
              var eased = 1 - Math.pow(1 - t, 3);
              maskRect.setAttribute('height', String(Math.round(320 * eased * 1000) / 1000));
              if (t < 1) requestAnimationFrame(tickMask);
              else maskRect.setAttribute('height', '320');
            }
            requestAnimationFrame(tickMask);
          });
        },
        { threshold: 0.22, rootMargin: '0px 0px -6% 0px' }
      );
      funnelObs.observe(funnelPanel);
    }
  }

  document.querySelectorAll('.agb-faq-item').forEach(function (item) {
    var btn = item.querySelector('.agb-faq-trigger');
    if (!btn) return;
    btn.addEventListener('click', function () {
      var wasOpen = item.classList.contains('is-open');
      document.querySelectorAll('.agb-faq-item').forEach(function (o) {
        o.classList.remove('is-open');
        var b = o.querySelector('.agb-faq-trigger');
        if (b) b.setAttribute('aria-expanded', 'false');
      });
      if (!wasOpen) {
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  var form = document.getElementById('lead-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      if (!window.fetch) return;
      e.preventDefault();
      var err = document.getElementById('lead-form-error');
      if (err) {
        err.classList.add('hidden');
        err.textContent = '';
      }
      var fd = new FormData(form);
      fetch(form.action, {
        method: 'POST',
        body: fd,
        headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin',
      })
        .then(function (r) {
          return r.json().then(function (data) {
            return { ok: r.ok, status: r.status, data: data };
          });
        })
        .then(function (res) {
          if (res.ok && res.data && res.data.ok) {
            form.reset();
            var okEl = document.getElementById('lead-form-success');
            if (okEl) {
              okEl.classList.remove('hidden');
              okEl.textContent = res.data.message || 'Recebemos seus dados. Em breve entraremos em contato.';
            }
            if (err) err.classList.add('hidden');
            return;
          }
          var msg = 'Não foi possível enviar. Tente novamente.';
          if (res.data && res.data.errors) {
            msg = Object.values(res.data.errors).join(' ');
          } else if (res.data && res.data.error) {
            msg = res.data.error;
          }
          if (err) {
            err.classList.remove('hidden');
            err.classList.add('text-red-600');
            err.textContent = msg;
          }
        })
        .catch(function () {
          if (err) {
            err.classList.remove('hidden');
            err.classList.add('text-red-600');
            err.textContent = 'Erro de rede. Tente novamente.';
          }
        });
    });
  }
})();
