// ═══════════════════════════════════════════
//  AXENTIA SRL — Shared JS
//  js/main.js
// ═══════════════════════════════════════════

// ── Nav mobile toggle ──
function toggleMenu() {
  document.getElementById('nav-links').classList.toggle('open');
}

// ── Highlight active nav link ──
(function () {
  const path = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.nav-links a').forEach(a => {
    if (a.getAttribute('href') && a.getAttribute('href').includes(path)) {
      a.classList.add('active');
    }
  });
})();

// ── Toast ──
function showToast(msg = '✓ Guardado exitosamente') {
  let t = document.getElementById('global-toast');
  if (!t) {
    t = document.createElement('div');
    t.id = 'global-toast';
    t.className = 'toast';
    document.body.appendChild(t);
  }
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2800);
}

// ── FAQ toggle ──
function toggleFaq(el) {
  el.parentElement.classList.toggle('open');
}

function sitePrefix() {
  const path = window.location.pathname;
  if (path.includes('/pages/fabricantes/')) return '../../';
  if (path.includes('/pages/servicios/')) return '../../';
  if (path.includes('/pages/') || path.includes('/admin/')) return '../';
  return '';
}

function brandLogoUrl() {
  return `${sitePrefix()}assets/logos/axentia-gradient.svg`;
}

function applyBrandLogos() {
  document.querySelectorAll('.nav-logo').forEach(logo => {
    logo.innerHTML = `<img src="${brandLogoUrl()}" alt="Axentia SRL" class="brand-logo-img">`;
  });
}

function initInteractiveSite() {
  if (!document.body.classList.contains('interactive-site')) return;

  window.addEventListener('pointermove', event => {
    const x = Math.round((event.clientX / window.innerWidth) * 100);
    const y = Math.round((event.clientY / window.innerHeight) * 100);
    document.documentElement.style.setProperty('--mx', `${x}%`);
    document.documentElement.style.setProperty('--my', `${y}%`);
  }, { passive: true });

  const items = document.querySelectorAll('.service-card, .hero-card, .service-values-grid article, .stats-row .stat-item, .manufacturer-card, .blog-card, .pillar-card, .testimonial-card, .fabricante-mini-card, .hero-v3-copy, .hero-showcase, .hero-notif-wrap, .client-card, .partner-badge, .section-label, .section-title, .manufacturer-hero-card, .manufacturer-capabilities > div, .manufacturer-products');
  if (!('IntersectionObserver' in window)) {
    items.forEach(item => item.classList.add('is-visible'));
    return;
  }

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  items.forEach(item => {
    item.classList.add('reveal-on-scroll');
    observer.observe(item);
  });
}

// ── Fondo de partículas (canvas, solo hero de home) ──
function initAxParticlesBg() {
  const canvas = document.getElementById('ax-particles-bg');
  if (!canvas) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const ctx = canvas.getContext('2d');
  let w, h, dpr, particles;
  const section = canvas.closest('#hero');
  const mouse = { x: -99999, y: -99999 };

  function isMobile() { return window.innerWidth < 768; }

  function resize() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    const rect = section.getBoundingClientRect();
    w = canvas.width = rect.width * dpr;
    h = canvas.height = rect.height * dpr;
    canvas.style.width = rect.width + 'px';
    canvas.style.height = rect.height + 'px';
    const count = isMobile() ? 300 : 850;
    particles = Array.from({ length: count }, (_, idx) => {
      const big = idx % 7 === 0;
      return {
        x: Math.random() * w,
        y: Math.random() * h,
        vx: (Math.random() - 0.5) * 1.1 * dpr,
        vy: (Math.random() - 0.5) * 1.1 * dpr,
        r: (big ? Math.random() * 1.8 + 2.2 : Math.random() * 1.3 + 1) * dpr,
        o: big ? Math.random() * 0.25 + 0.55 : Math.random() * 0.35 + 0.35,
      };
    });
  }

  function onPointerMove(event) {
    const rect = section.getBoundingClientRect();
    mouse.x = (event.clientX - rect.left) * dpr;
    mouse.y = (event.clientY - rect.top) * dpr;
  }
  function onPointerLeave() { mouse.x = -99999; mouse.y = -99999; }

  section.addEventListener('mousemove', onPointerMove);
  section.addEventListener('mouseleave', onPointerLeave);

  function step() {
    ctx.clearRect(0, 0, w, h);
    const repelDist = 130 * dpr;
    const repelStrength = 3.2 * dpr;

    ctx.fillStyle = 'rgba(37,99,235,1)';
    for (let i = 0; i < particles.length; i++) {
      const p = particles[i];

      const mdx = p.x - mouse.x, mdy = p.y - mouse.y;
      const mdist = Math.sqrt(mdx * mdx + mdy * mdy);
      if (mdist < repelDist) {
        const push = (1 - mdist / repelDist) * repelStrength;
        p.x += (mdx / (mdist || 1)) * push;
        p.y += (mdy / (mdist || 1)) * push;
      }

      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > w) p.vx *= -1;
      if (p.y < 0 || p.y > h) p.vy *= -1;

      ctx.globalAlpha = p.o;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.globalAlpha = 1;

    requestAnimationFrame(step);
  }

  resize();
  window.addEventListener('resize', resize);
  requestAnimationFrame(step);
}

// ── Partículas que forman el nombre del fabricante (páginas de detalle) ──
function initAxParticlesText(canvasId, text, avoidSelector) {
  const canvas = document.getElementById(canvasId);
  if (!canvas || !text) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const ctx = canvas.getContext('2d');
  const section = canvas.parentElement;
  const avoidEl = avoidSelector ? document.querySelector(avoidSelector) : null;
  let w, h, dpr, particles;
  const mouse = { x: -99999, y: -99999 };

  // Rect del elemento a evitar (ej. la tarjeta con el logo/texto), relativo a la sección —
  // para no desperdiciar copias del nombre dibujándolas escondidas detrás de la tarjeta.
  function getAvoidRect() {
    if (!avoidEl) return null;
    const s = section.getBoundingClientRect();
    const a = avoidEl.getBoundingClientRect();
    return { left: a.left - s.left, top: a.top - s.top, right: a.right - s.left, bottom: a.bottom - s.top };
  }

  function isMobile() { return window.innerWidth < 768; }

  // Letras sin ascendente/descendente (se dibujan más bajas y cortas, como en una fuente real).
  var X_HEIGHT_CHARS = { a: 1, c: 1, e: 1, m: 1, n: 1, o: 1, r: 1, s: 1, u: 1, v: 1, w: 1, x: 1, z: 1 };
  var DESCENDER_CHARS = { g: 1, j: 1, p: 1, q: 1, y: 1 };
  // Letras con un "ojo"/contraforma hueco en el centro (evita que se vean como bloques sólidos).
  var ROUND_CHARS = { a: 1, b: 1, d: 1, e: 1, g: 1, o: 1, p: 1, q: 1, D: 1, O: 1, Q: 1, B: 1, P: 1, R: 1 };
  function inCounterHole(nx, ny) {
    const dx = (nx - 0.5) / 0.30, dy = (ny - 0.55) / 0.34;
    return dx * dx + dy * dy < 1;
  }

  // Una sola "instancia" del nombre, con puntos relativos a su propia caja (0..w, 0..h).
  // Primero intenta leer los píxeles reales del texto (nitidez perfecta); si el navegador
  // bloquea esa lectura por privacidad (Brave, Firefox modo estricto, etc.), usa como respaldo
  // una medición por DOM (getBoundingClientRect), que ningún navegador bloquea nunca.
  function buildInstanceViaCanvas(fontSizeCss) {
    const scratch = document.createElement('canvas').getContext('2d');
    scratch.font = `900 ${fontSizeCss}px Arial, sans-serif`;
    const textW = scratch.measureText(text).width;
    if (!(textW > 0)) return null;

    const padding = fontSizeCss * 0.18;
    const instW = Math.ceil(textW + padding * 2);
    const instH = Math.ceil(fontSizeCss * 1.35);
    const off = document.createElement('canvas');
    off.width = instW; off.height = instH;
    const octx = off.getContext('2d');
    octx.fillStyle = '#fff';
    octx.font = `900 ${fontSizeCss}px Arial, sans-serif`;
    octx.textBaseline = 'middle';
    octx.textAlign = 'left';
    octx.fillText(text, padding, instH / 2);

    const data = octx.getImageData(0, 0, instW, instH).data; // throws if canvas readback is blocked
    const step = Math.max(1, Math.round(fontSizeCss / 40));
    const points = [];
    for (let y = 0; y < instH; y += step) {
      for (let x = 0; x < instW; x += step) {
        if (data[(y * instW + x) * 4 + 3] > 120) points.push({ x, y });
      }
    }
    return points.length ? { points, w: instW, h: instH } : null;
  }

  // Respaldo sin canvas: mide cada letra con el DOM (getBoundingClientRect) en vez de leer
  // píxeles. Las cajas de línea de letras contiguas casi se tocan y tienen la misma altura, así
  // que sin separación ni variación de altura el resultado se vería como un bloque sólido.
  function buildInstanceViaDom(fontSizeCss) {
    const measurer = document.createElement('div');
    measurer.style.cssText = `position:fixed;left:-99999px;top:0;white-space:nowrap;visibility:hidden;pointer-events:none;font:900 ${fontSizeCss}px Arial, sans-serif;letter-spacing:${(fontSizeCss * 0.12).toFixed(1)}px;`;
    measurer.innerHTML = text.split('').map(ch => `<span>${ch === ' ' ? '&nbsp;' : ch}</span>`).join('');
    document.body.appendChild(measurer);

    const box = measurer.getBoundingClientRect();
    if (box.width < 1 || box.height < 1) { document.body.removeChild(measurer); return null; }
    const insetX = 0.16;

    const points = [];
    Array.from(measurer.children).forEach((span, i) => {
      const ch = text[i];
      const r = span.getBoundingClientRect();
      if (r.width < 1 || r.height < 1 || ch === ' ') return;

      let top = 0.06, bottom = 0.80;
      if (DESCENDER_CHARS[ch]) { top = 0.40; bottom = 0.96; }
      else if (X_HEIGHT_CHARS[ch]) { top = 0.40; bottom = 0.80; }

      const fillW = r.width * (1 - insetX * 2);
      const localX = (r.left - box.left) + r.width * insetX;
      const fillTop = (r.top - box.top) + r.height * top;
      const fillH = r.height * (bottom - top);

      const isRound = !!ROUND_CHARS[ch];
      const count = Math.max(10, Math.round((fillW * fillH) / 22));
      for (let k = 0; k < count; k++) {
        let nx, ny, tries = 0;
        do {
          nx = Math.random(); ny = Math.random();
          tries++;
        } while (isRound && tries < 6 && inCounterHole(nx, ny));
        points.push({ x: localX + nx * fillW, y: fillTop + ny * fillH });
      }
    });

    document.body.removeChild(measurer);
    return points.length ? { points, w: box.width, h: box.height } : null;
  }

  // Coloca el nombre en una cuadrícula limpia (sin solaparse) dentro de cada franja libre
  // alrededor de la tarjeta (arriba, abajo, izquierda, derecha — las que tengan espacio real),
  // en vez de sortear posiciones al azar: eso desperdiciaba intentos en la zona ocupada o
  // amontonaba varias copias unas sobre otras en franjas angostas.
  function buildTargets(rectW, rectH, avoidRect) {
    const margins = avoidRect
      ? { left: avoidRect.left, right: rectW - avoidRect.right, top: avoidRect.top, bottom: rectH - avoidRect.bottom }
      : { left: rectW, right: rectW, top: rectH, bottom: rectH };
    const bestMargin = Math.max(margins.left, margins.right, margins.top, margins.bottom, 60);
    const fontSizeCss = Math.min(bestMargin * 0.34, rectH * 0.22);
    if (!(fontSizeCss > 0)) return null;

    let instance = null;
    try { instance = buildInstanceViaCanvas(fontSizeCss); } catch (err) { instance = null; }
    if (!instance) { try { instance = buildInstanceViaDom(fontSizeCss); } catch (err) { instance = null; } }
    if (!instance) return null;

    const cx = instance.w / 2, cy = instance.h / 2;
    // Extensión real del rectángulo ya rotado hasta el ángulo máximo (mucho más ajustada que
    // el radio del círculo envolvente, sobre todo para una palabra ancha y baja como esta).
    const maxAngle = Math.PI / 18; // ~10°
    const halfW = (instance.w / 2) * Math.cos(maxAngle) + (instance.h / 2) * Math.sin(maxAngle);
    const halfH = (instance.w / 2) * Math.sin(maxAngle) + (instance.h / 2) * Math.cos(maxAngle);
    const stepW = halfW * 2 * 1.03, stepH = halfH * 2 * 1.03; // pequeño respiro entre copias

    const zones = [];
    if (!avoidRect) {
      zones.push({ x0: 0, x1: rectW, y0: 0, y1: rectH });
    } else {
      if (margins.left > stepW) zones.push({ x0: 0, x1: avoidRect.left, y0: 0, y1: rectH });
      if (margins.right > stepW) zones.push({ x0: avoidRect.right, x1: rectW, y0: 0, y1: rectH });
      if (margins.top > stepH) zones.push({ x0: 0, x1: rectW, y0: 0, y1: avoidRect.top });
      if (margins.bottom > stepH) zones.push({ x0: 0, x1: rectW, y0: avoidRect.bottom, y1: rectH });
    }
    if (!zones.length) return null;

    const targets = [];
    zones.forEach(zone => {
      const cols = Math.max(1, Math.floor((zone.x1 - zone.x0) / stepW));
      const rows = Math.max(1, Math.floor((zone.y1 - zone.y0) / stepH));
      const cellW = (zone.x1 - zone.x0) / cols, cellH = (zone.y1 - zone.y0) / rows;
      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          const baseX = zone.x0 + c * cellW + cellW / 2 + (Math.random() - 0.5) * cellW * 0.1;
          const baseY = zone.y0 + r * cellH + cellH / 2 + (Math.random() - 0.5) * cellH * 0.1;
          const angle = (Math.random() - 0.5) * maxAngle * 2; // hasta ~±10°, apenas "de lado", prioriza que se lea bien
          const cos = Math.cos(angle), sin = Math.sin(angle);
          instance.points.forEach(p => {
            const dx = p.x - cx, dy = p.y - cy;
            const rx = dx * cos - dy * sin;
            const ry = dx * sin + dy * cos;
            targets.push({ x: (baseX + rx) * dpr, y: (baseY + ry) * dpr });
          });
        }
      }
    });
    return targets.length ? targets : null;
  }

  function ambientTargets(pxW, pxH) {
    const count = isMobile() ? 220 : 420;
    return Array.from({ length: count }, () => ({ x: Math.random() * pxW, y: Math.random() * pxH }));
  }

  function resize() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    const rect = section.getBoundingClientRect();
    w = canvas.width = rect.width * dpr;
    h = canvas.height = rect.height * dpr;
    canvas.style.width = rect.width + 'px';
    canvas.style.height = rect.height + 'px';

    let targets;
    try {
      targets = buildTargets(rect.width, rect.height, getAvoidRect());
    } catch (err) {
      targets = null;
    }
    if (!targets || !targets.length) targets = ambientTargets(w, h);

    const maxPoints = isMobile() ? 1000 : 2600;
    if (targets.length > maxPoints) {
      const stride = Math.ceil(targets.length / maxPoints);
      targets = targets.filter((_, i) => i % stride === 0);
    }

    particles = targets.map(t => ({
      x: Math.random() * w,
      y: Math.random() * h,
      tx: t.x, ty: t.y,
      vx: 0, vy: 0,
      r: (Math.random() * 1.1 + 1.3) * dpr,
      o: Math.random() * 0.3 + 0.55,
      seedA: Math.random() * Math.PI * 2,
      seedF: 0.6 + Math.random() * 0.8,
    }));
  }

  function onPointerMove(event) {
    const rect = section.getBoundingClientRect();
    mouse.x = (event.clientX - rect.left) * dpr;
    mouse.y = (event.clientY - rect.top) * dpr;
  }
  function onPointerLeave() { mouse.x = -99999; mouse.y = -99999; }
  section.addEventListener('mousemove', onPointerMove);
  section.addEventListener('mouseleave', onPointerLeave);

  const CYCLE_MS = 8000; // cada ciclo: se dispersan y se vuelven a unir formando el nombre

  function step(now) {
    ctx.clearRect(0, 0, w, h);
    const repelDist = 85 * dpr;
    const repelStrength = 6.5 * dpr;
    const scatterRadius = 90 * dpr;
    const idleDrift = 3 * dpr;
    const spring = 0.045;
    const friction = 0.82;

    // Pulso periódico: la mitad del ciclo quedan formando el nombre quietas (para poder
    // leerlo), la otra mitad se alejan y regresan — así nunca se quedan del todo estáticas.
    const cyclePos = ((now || 0) % CYCLE_MS) / CYCLE_MS;
    const pulse = Math.pow(Math.max(0, Math.sin(cyclePos * Math.PI * 2)), 2);
    const scatterAmp = scatterRadius * pulse;

    ctx.fillStyle = 'rgba(37,99,235,1)';
    for (let i = 0; i < particles.length; i++) {
      const p = particles[i];

      const wanderT = (now || 0) * 0.001 * p.seedF;
      const wanderX = Math.cos(p.seedA + wanderT) * (scatterAmp + idleDrift);
      const wanderY = Math.sin(p.seedA * 1.3 + wanderT) * (scatterAmp + idleDrift);
      const targetX = p.tx + wanderX;
      const targetY = p.ty + wanderY;

      p.vx += (targetX - p.x) * spring;
      p.vy += (targetY - p.y) * spring;

      const mdx = p.x - mouse.x, mdy = p.y - mouse.y;
      const mdist = Math.sqrt(mdx * mdx + mdy * mdy);
      if (mdist < repelDist) {
        const push = (1 - mdist / repelDist) * repelStrength;
        p.vx += (mdx / (mdist || 1)) * push;
        p.vy += (mdy / (mdist || 1)) * push;
      }

      p.vx *= friction; p.vy *= friction;
      p.x += p.vx; p.y += p.vy;

      ctx.globalAlpha = p.o;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.globalAlpha = 1;

    requestAnimationFrame(step);
  }

  try {
    resize();
  } catch (err) {
    w = canvas.width; h = canvas.height;
    particles = ambientTargets(w, h).map(t => ({ x: t.x, y: t.y, tx: t.x, ty: t.y, vx: 0, vy: 0, r: 1.5, o: 0.6 }));
  }
  window.addEventListener('resize', resize);
  requestAnimationFrame(step);
}

// ── Parallax sutil del showcase del hero ──
function initHeroParallax() {
  const frame = document.getElementById('heroParallaxFrame');
  if (!frame) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  let ticking = false;
  function update() {
    const offset = Math.min(window.scrollY, 500) * 0.06;
    frame.style.setProperty('--parallax-y', offset.toFixed(1) + 'px');
    ticking = false;
  }
  window.addEventListener('scroll', () => {
    if (!ticking) { requestAnimationFrame(update); ticking = true; }
  }, { passive: true });
}

// ══════════════════════════════════════════
//  RENDER HELPERS  (public site cards)
// ══════════════════════════════════════════

function assetUrl(path) {
  if (!path) return '';
  return sitePrefix() + path;
}


function renderServiceCard(s) {
  const items = s.items.map(i => `<li>${i}</li>`).join('');
  const slug = s.slug || String(s.title).toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
  const href = `${sitePrefix()}pages/servicios/${slug}.php`;
  return `
    <article class="service-card">
      <div class="service-icon">${svcIcon(s.slug, s.icon)}</div>
      <h3>${s.title}</h3>
      <p>${s.desc}</p>
      <ul>${items}</ul>
      <a class="service-card-link" href="${href}">Ver detalle</a>
    </article>`;
}

const AX_SERVICE_ICONS = {
  'consultoria-tecnologica': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/><path d="M8 11h6"/></svg>',
  'infraestructura-it': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="7" rx="1.5"/><rect x="3" y="13" width="18" height="7" rx="1.5"/><circle cx="7" cy="7.5" r=".6" fill="currentColor" stroke="none"/><circle cx="7" cy="16.5" r=".6" fill="currentColor" stroke="none"/></svg>',
  'gestion-de-la-nube': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 18a4.5 4.5 0 0 1-.5-8.97A5.5 5.5 0 0 1 17.2 8.1 4 4 0 0 1 17 18H7z"/></svg>',
  'ciberseguridad': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3z"/><path d="M9.5 12l1.8 1.8L15 10.2"/></svg>',
  'sistemas-integrados': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 13.5a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V19a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H4a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1.1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H10a1.7 1.7 0 0 0 1-1.5V4a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V10a1.7 1.7 0 0 0 1.5 1H20a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>',
  'capacitacion-concienciacion': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9.5l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5v-5"/><path d="M22 9.5v6"/></svg>',
  'transformacion-digital': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 15.4-6.4L21 8"/><path d="M21 4v4h-4"/><path d="M21 12a9 9 0 0 1-15.4 6.4L3 16"/><path d="M3 20v-4h4"/></svg>',
  'redes-cableado': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a13 13 0 0 1 0 18M12 3a13 13 0 0 0 0 18"/></svg>',
  'seguridad-fisica': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8l3-3h10l3 3v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8z"/><circle cx="12" cy="13" r="3.2"/><path d="M9 8h.01"/></svg>'
};
function svcIcon(slug, fallback) { return AX_SERVICE_ICONS[slug] || fallback || ''; }

const AX_SVC_ICONS = {
  edr: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3z"/><path d="M9.5 12l1.8 1.8L15 10.2"/></svg>',
  pentest: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/><path d="M11 8v3l2 2"/></svg>',
  soc: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3a9 9 0 0 1 9 9"/><circle cx="12" cy="12" r="2.5"/></svg>',
  assessment: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16l1.7 1.7L14 14.4"/></svg>',
  ad: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="8" r="2.5"/><circle cx="17" cy="8" r="2.5"/><path d="M3 20c0-3 2-5 4-5s4 2 4 5M13 20c0-3 2-5 4-5s4 2 4 5"/></svg>',
  hardening: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="6" rx="1.5"/><rect x="4" y="14" width="16" height="6" rx="1.5"/><circle cx="8" cy="7" r=".6" fill="currentColor" stroke="none"/><circle cx="8" cy="17" r=".6" fill="currentColor" stroke="none"/></svg>',
  incident: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l9 16H3L12 3z"/><path d="M12 10v4"/><circle cx="12" cy="17" r=".6" fill="currentColor" stroke="none"/></svg>',
  identity: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="4"/><path d="M2 21c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17.5" cy="15.5" r="3.2"/><path d="M17.5 13.6V15l1 1"/></svg>'
};

const SERVICE_CARDS = {
  ciberseguridad: {
    label: 'Servicios',
    title: 'Servicios',
    sub: 'Soluciones de ciberseguridad adaptadas a las necesidades de tu negocio',
    items: [
      { icon: 'edr', titulo: 'EDR y Gestión de Endpoints', texto: 'Detección y respuesta en tiempo real con tecnología Xcitium.' },
      { icon: 'pentest', titulo: 'Pentesting', texto: 'Simulamos ataques reales para encontrar vulnerabilidades antes que un atacante.' },
      { icon: 'soc', titulo: 'SOC como Servicio', texto: 'Monitoreo continuo 24/7 con respuesta coordinada ante amenazas.' },
      { icon: 'assessment', titulo: 'Assessment de Ciberseguridad', texto: 'Evaluamos tu postura de seguridad actual e identificamos brechas críticas.' },
      { icon: 'ad', titulo: 'Auditoría de Active Directory', texto: 'Revisamos configuraciones, políticas y permisos de tu dominio para cerrar vectores de ataque.' },
      { icon: 'hardening', titulo: 'Hardening de Infraestructura', texto: 'Fortalecemos servidores, redes y sistemas según mejores prácticas.' },
      { icon: 'incident', titulo: 'Respuesta a Incidentes', texto: 'Investigación, contención y remediación ante brechas activas.' },
      { icon: 'identity', titulo: 'Gestión de Identidad y Accesos', texto: 'Conditional Access y Defender for Cloud en entornos Microsoft/Azure.' }
    ]
  }
};

function renderServiceCardsSection(slug) {
  const cfg = SERVICE_CARDS[slug];
  if (!cfg) return '';
  return `
    <section class="service-detail-section service-cards-section">
      <div class="container">
        ${slug === 'ciberseguridad' ? '<div class="live-badge"><span class="dot" aria-hidden="true"></span>Monitoreo de amenazas activo 24/7</div>' : ''}
        <div class="section-label">${cfg.label}</div>
        <h2 class="section-title">${cfg.title}</h2>
        <p class="section-sub">${cfg.sub}</p>
        <div class="service-cards-grid">
          ${cfg.items.map(it => `
            <article class="svc-tile">
              <span class="service-card-icon" aria-hidden="true">${AX_SVC_ICONS[it.icon] || ''}</span>
              <h3>${it.titulo}</h3>
              <p>${it.texto}</p>
            </article>`).join('')}
        </div>
      </div>
    </section>`;
}

const SERVICE_DETAIL_COPY = {
  'consultoria-tecnologica': {
    outcome: 'Ayudamos a convertir necesidades de negocio en una ruta tecnológica clara, medible y ejecutable.',
    process: ['Diagnóstico de infraestructura y operación', 'Mapa de riesgos, brechas y prioridades', 'Plan de adopción tecnológica por fases', 'Recomendaciones de inversión y mejora continua'],
    deliverables: ['Informe ejecutivo', 'Roadmap técnico', 'Priorización de iniciativas', 'Acompañamiento para selección de fabricantes']
  },
  'infraestructura-it': {
    outcome: 'Diseñamos e implementamos bases tecnológicas estables para que la operación crezca con seguridad y continuidad.',
    process: ['Levantamiento de servidores, redes y almacenamiento', 'Diseño de arquitectura física, virtual o híbrida', 'Implementación y documentación', 'Monitoreo, mantenimiento y optimización'],
    deliverables: ['Arquitectura recomendada', 'Plan de implementación', 'Documentación técnica', 'Soporte post-implementación']
  },
  'gestion-de-la-nube': {
    outcome: 'Acompañamos migraciones y optimización cloud para reducir fricción, costos innecesarios y riesgos operativos.',
    process: ['Evaluación de cargas y dependencias', 'Diseño de nube pública, privada o híbrida', 'Migración por etapas', 'Optimización de costos, respaldo y seguridad'],
    deliverables: ['Assessment cloud', 'Arquitectura objetivo', 'Plan de migración', 'Políticas de respaldo y seguridad']
  },
  'ciberseguridad': {
    outcome: 'Protegemos usuarios, endpoints, red y datos con una estrategia integral de prevención, detección y respuesta.',
    process: ['Evaluación de postura de seguridad', 'Selección de controles y fabricantes', 'Implementación de EDR, firewall, SIEM o awareness', 'Operación, seguimiento y mejora'],
    deliverables: ['Diagnóstico de riesgos', 'Arquitectura de seguridad', 'Plan de remediación', 'Soporte y monitoreo']
  },
  'sistemas-integrados': {
    outcome: 'Integramos plataformas de gestión para que ventas, operación, administración y colaboración trabajen con mejor visibilidad.',
    process: ['Análisis de procesos y flujos actuales', 'Selección o ajuste de ERP, CRM y colaboración', 'Configuración, capacitación y puesta en marcha', 'Acompañamiento para adopción'],
    deliverables: ['Mapa de procesos', 'Configuración funcional', 'Capacitación de usuarios', 'Plan de mejora']
  },
  'capacitacion-concienciacion': {
    outcome: 'Fortalecemos el conocimiento del equipo para reducir errores, mejorar hábitos y elevar la madurez tecnológica.',
    process: ['Evaluación de necesidades de formación', 'Diseño del programa por perfiles', 'Ejecución de sesiones y campañas', 'Medición de avance y recomendaciones'],
    deliverables: ['Plan de capacitación', 'Material de apoyo', 'Reporte de participación', 'Recomendaciones de refuerzo']
  },
  'transformacion-digital': {
    outcome: 'Modernizamos procesos con automatización, aplicaciones y mejores flujos de información.',
    process: ['Identificación de procesos repetitivos o críticos', 'Diseño de solución o automatización', 'Desarrollo, integración y pruebas', 'Acompañamiento de adopción'],
    deliverables: ['Mapa de oportunidades', 'Prototipo o solución', 'Documentación del flujo', 'Plan de evolución']
  },
  'redes-cableado': {
    outcome: 'Construimos conectividad confiable para oficinas, sucursales, usuarios, voz, datos, video y Wi-Fi empresarial.',
    process: ['Site survey y levantamiento técnico', 'Diseño LAN, WAN, Wi-Fi o cableado', 'Instalación, certificación y organización', 'Documentación y soporte'],
    deliverables: ['Diseño de red', 'Listado de materiales', 'Implementación física/lógica', 'Documentación final']
  },
  'seguridad-fisica': {
    outcome: 'Integramos videovigilancia, control de acceso y monitoreo para proteger espacios físicos y activos críticos.',
    process: ['Levantamiento del sitio y puntos críticos', 'Diseño de cámaras, NVR y accesos', 'Instalación, configuración y pruebas', 'Capacitación y soporte'],
    deliverables: ['Diseño de cobertura', 'Cotización de equipos', 'Configuración y pruebas', 'Manual de operación']
  }
};

function renderServiceDetail(slug) {
  const service = DATA.services.find(s => s.slug === slug);
  const detail = SERVICE_DETAIL_COPY[slug];
  if (!service || !detail) return;

  document.title = `${service.title} - Axentia SRL`;
  const title = document.getElementById('service-title');
  const desc = document.getElementById('service-desc');
  const icon = document.getElementById('service-icon');
  const outcome = document.getElementById('service-outcome');
  if (title) title.textContent = service.title;
  if (desc) desc.textContent = service.desc;
  if (icon) icon.innerHTML = svcIcon(service.slug, service.icon);
  if (outcome) outcome.textContent = detail.outcome;

  const items = document.getElementById('service-items');
  if (items) items.innerHTML = service.items.map(i => `<li>${i}</li>`).join('');
  const process = document.getElementById('service-process');
  if (process) process.innerHTML = detail.process.map((p, i) => `<article><span>0${i + 1}</span><p>${p}</p></article>`).join('');
  const deliverables = document.getElementById('service-deliverables');
  if (deliverables) deliverables.innerHTML = detail.deliverables.map(d => `<li>${d}</li>`).join('');
}

function resolveMediaUrl(url) {
  const clean = String(url || '').trim();
  if (!clean) return '';
  if (/^(https?:)?\/\//i.test(clean) || /^data:/i.test(clean)) return clean;
  return assetUrl(clean);
}

function renderFabricanteRecursosHtml(slug) {
  const f = (DATA.fabricantesInfo || []).find(x => x.slug === slug);
  const brochure = f && f.brochureUrl
    ? `<a class="btn-primary" href="${assetUrl(f.brochureUrl)}" target="_blank" rel="noopener">📄 Descargar brochure</a>`
    : `<p class="recursos-empty">Brochure próximamente.</p>`;
  const videoSrc = f && f.videoUrl ? resolveMediaUrl(f.videoUrl) : '';
  const video = videoSrc
    ? `<div class="fabricante-video-embed">${embedMedia(videoSrc, f ? f.name : 'Video')}</div>`
    : `<p class="recursos-empty">Video/webinar próximamente.</p>`;
  return `
    <div class="fabricante-recursos-grid">
      <div class="fabricante-recurso-box">
        <h4>Brochure</h4>
        ${brochure}
      </div>
      <div class="fabricante-recurso-box">
        <h4>Video / Webinar</h4>
        ${video}
      </div>
    </div>`;
}

function renderFabricanteMiniCard(slug) {
  const f = (DATA.fabricantesInfo || []).find(x => x.slug === slug);
  if (!f) return '';
  const logo = f.logo
    ? `<img src="../../${f.logo}" alt="${f.name}" loading="lazy">`
    : '';
  return `
    <a class="fabricante-mini-card" href="../fabricantes/${f.slug}.php">
      <div class="fabricante-mini-logo">${logo}</div>
      <span>${f.name}</span>
    </a>`;
}

function renderServiceDetailPage(slug) {
  const service = DATA.services.find(s => s.slug === slug);
  const detail = SERVICE_DETAIL_COPY[slug];
  const shell = document.getElementById('service-detail-shell');
  if (!service || !detail || !shell) return;

  const fabricantes = service.fabricantes || [];
  const fabricantesSection = fabricantes.length ? `
    <section class="service-detail-section">
      <div class="container">
        <div class="section-label">Fabricantes asociados</div>
        <h2 class="section-title">Marcas que integramos para este servicio</h2>
        <div class="fabricante-mini-grid">
          ${fabricantes.map(renderFabricanteMiniCard).join('')}
        </div>
      </div>
    </section>` : '';

  document.title = `${service.title} - Axentia SRL`;
  shell.innerHTML = `
    <header class="service-detail-hero">
      <div class="container service-detail-hero-grid">
        <div>
          <div class="breadcrumb"><a href="../../index.php">Inicio</a> / <a href="../servicios.php">Servicios</a> / ${service.title}</div>
          <div class="section-label">Servicio Axentia</div>
          <h1>${service.title}</h1>
          <p>${detail.outcome}</p>
          <div class="manufacturer-actions">
            <a href="../contacto.php" class="btn-primary">Solicitar asesoría</a>
            <a href="../servicios.php" class="btn-outline light-outline">Ver servicios</a>
          </div>
        </div>
        <aside class="service-detail-card">
          <div class="service-icon">${svcIcon(service.slug, service.icon)}</div>
          <h2>Alcance principal</h2>
          <ul>${service.items.map(i => `<li>${i}</li>`).join('')}</ul>
        </aside>
      </div>
    </header>
    ${renderServiceCardsSection(slug)}

    <section class="service-detail-section">
      <div class="container service-detail-grid">
        <div>
          <div class="section-label">Cómo trabajamos</div>
          <h2 class="section-title">Un proceso claro desde el diagnóstico hasta la mejora</h2>
          <p class="section-sub">${service.desc} Nuestro enfoque combina revisión técnica, recomendación práctica e implementación acompañada.</p>
        </div>
        <div class="service-process-grid">
          ${detail.process.map((p, i) => `<article><span>0${i + 1}</span><p>${p}</p></article>`).join('')}
        </div>
      </div>
    </section>

    <section class="service-detail-section service-detail-soft">
      <div class="container service-detail-grid">
        <div>
          <div class="section-label">Entregables</div>
          <h2 class="section-title">Qué puedes esperar</h2>
          <p class="section-sub">Cada proyecto se dimensiona según el entorno, el nivel de urgencia y el objetivo de negocio.</p>
        </div>
        <ul class="service-deliverable-list">
          ${detail.deliverables.map(d => `<li>${d}</li>`).join('')}
        </ul>
      </div>
    </section>
    ${fabricantesSection}

    <section class="cta-band">
      <div class="container" style="text-align:center">
        <h2 class="section-title">¿Quieres evaluar este servicio?</h2>
        <p class="section-sub" style="margin:0 auto 32px">Te ayudamos a revisar tu necesidad y preparar una propuesta ajustada a tu organización.</p>
        <a href="../contacto.php" class="btn-primary">Contactar a Axentia</a>
      </div>
    </section>`;
}

function renderClientCard(c) {
  const logo = c.logo
    ? `<img class="client-logo-img" src="${assetUrl(c.logo)}" alt="${c.name}" loading="lazy">`
    : `<span class="client-avatar">${c.initials}</span>`;

  return `
    <article class="client-card logo-card">
      <div class="logo-frame">${logo}</div>
      <div class="logo-meta">
        <h4>${c.name}</h4>
        <p>${c.sector}</p>
      </div>
    </article>`;
}

function renderBlogCard(b) {
  const type = b.type || 'noticia';
  const label = { noticia: 'Noticia', articulo: 'Artículo', video: 'Video', webinar: 'Webinar' }[type] || 'Noticia';
  const action = type === 'video' ? 'Ver video' : type === 'webinar' ? 'Ver webinar' : 'Leer artículo';
  const hasImage = b.mediaUrl && /^(data:image\/|https?:\/\/.*\.(png|jpe?g|webp|gif)(\?.*)?$)/i.test(b.mediaUrl);
  const mediaPreview = hasImage
    ? `<img class="blog-cover-img" src="${b.mediaUrl}" alt="${b.title}" loading="lazy">`
    : `<span class="blog-media-mark" aria-hidden="true"></span>`;
  return `
    <article class="blog-card blog-type-${type}" data-type="${type}" onclick="openBlogArticle(${b.id})" tabindex="0" onkeydown="if(event.key==='Enter')openBlogArticle(${b.id})">
      <div class="blog-img">
        <span class="blog-type-badge">${label}</span>
        ${mediaPreview}
      </div>
      <div class="blog-body">
        <span class="blog-tag">${b.tag}</span>
        <h3>${b.title}</h3>
        <p>${b.desc}</p>
        <div class="blog-meta">${b.date}${b.eventDate ? ' · ' + b.eventDate : ''} · ${action}</div>
      </div>
    </article>`;
}

function initBlogFilter() {
  const bar = document.getElementById('blog-filter-bar');
  const grid = document.getElementById('blog-grid');
  if (!bar || !grid) return;
  bar.addEventListener('click', event => {
    const btn = event.target.closest('[data-filter]');
    if (!btn) return;
    bar.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const filter = btn.getAttribute('data-filter');
    grid.querySelectorAll('.blog-card').forEach(card => {
      card.style.display = (filter === 'all' || card.getAttribute('data-type') === filter) ? '' : 'none';
    });
  });
}

function openBlogArticle(id) {
  const article = DATA.blog.find(b => b.id === id);
  if (!article) return;

  let modal = document.getElementById('blog-article-modal');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'blog-article-modal';
    modal.className = 'blog-article-modal';
    modal.addEventListener('click', event => {
      if (event.target === modal) closeBlogArticle();
    });
    document.body.appendChild(modal);
  }

  const content = article.content || article.desc;
  const paragraphs = String(content)
    .split(/\n{2,}/)
    .map(p => `<p>${p.trim().replace(/\n/g, '<br>')}</p>`)
    .join('');
  const type = article.type || 'noticia';
  const mediaBlock = article.mediaUrl
    ? `<div class="blog-media-embed">${embedMedia(article.mediaUrl, article.title)}</div>`
    : '';
  const eventBlock = article.eventDate
    ? `<div class="blog-event-note"><strong>Fecha del webinar:</strong> ${article.eventDate}</div>`
    : '';

  modal.innerHTML = `
    <article class="blog-article-dialog">
      <button class="blog-article-close" onclick="closeBlogArticle()" aria-label="Cerrar">×</button>
      <span class="blog-tag">${article.tag}</span>
      <h2>${article.title}</h2>
      <div class="blog-meta">${article.date} · ${type}</div>
      ${eventBlock}
      ${mediaBlock}
      <div class="blog-article-content">${paragraphs}</div>
    </article>`;
  modal.classList.add('show');
}

function closeBlogArticle() {
  const modal = document.getElementById('blog-article-modal');
  if (modal) modal.classList.remove('show');
}

function embedMedia(url, title) {
  const clean = String(url || '').trim();
  if (!clean) return '';
  const youtube = clean.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([A-Za-z0-9_-]+)/);
  if (youtube) {
    return `<iframe src="https://www.youtube.com/embed/${youtube[1]}" title="${title}" loading="lazy" allowfullscreen></iframe>`;
  }
  if (/^data:video\//i.test(clean) || /\.(mp4|webm|ogg)(\?.*)?$/i.test(clean)) {
    return `<video controls src="${clean}"></video>`;
  }
  if (/^data:image\//i.test(clean) || /\.(png|jpe?g|webp|gif)(\?.*)?$/i.test(clean)) {
    return `<img src="${clean}" alt="${title}" loading="lazy">`;
  }
  return `<a href="${clean}" target="_blank" rel="noopener" class="btn-primary">Abrir recurso</a>`;
}

function renderPartnerBadge(p) {
  const logo = p.logo
    ? `<img class="partner-logo-img" src="${assetUrl(p.logo)}" alt="${p.name}" loading="lazy">`
    : `<span class="partner-name-fallback">${p.name}</span>`;

  return `
    <article class="partner-badge logo-card" title="${p.name}">
      <div class="logo-frame">${logo}</div>
      <span class="logo-caption">${p.name}</span>
    </article>`;
}

function renderFaqEl(f) {
  return `
    <div class="faq-item">
      <div class="faq-q" onclick="toggleFaq(this)">${f.q}</div>
      <div class="faq-a">${f.a}</div>
    </div>`;
}

function renderTestimonialCard(t) {
  const client = t.client ? (DATA.clients || []).find(c => c.name === t.client) : null;
  const clientLogo = client && client.logo ? `<img src="${assetUrl(client.logo)}" alt="${client.name}" loading="lazy">` : '';
  return `
    <article class="testimonial-card">
      <div class="testimonial-quote-mark">“</div>
      <p class="testimonial-quote">${t.quote}</p>
      <div class="testimonial-author">
        <div>
          <strong>${t.author}</strong>
          <span>${t.role}</span>
        </div>
        ${clientLogo ? `<div class="testimonial-client-logo">${clientLogo}</div>` : ''}
      </div>
    </article>`;
}

function renderResourceCard(r) {
  const typeLabel = { brochure: 'Brochure', 'caso-estudio': 'Caso de estudio', whitepaper: 'Whitepaper' }[r.type] || 'Recurso';
  return `
    <article class="resource-card">
      <span class="resource-type-badge">${typeLabel}</span>
      <h3>${r.title}</h3>
      <p>${r.desc}</p>
      <button class="btn-primary" onclick="openResourceGate(${r.id})">Descargar</button>
    </article>`;
}

// ══════════════════════════════════════════
//  BUSCADOR DE HEADER
// ══════════════════════════════════════════
function initHeaderSearch() {
  const input = document.getElementById('header-search-input');
  const results = document.getElementById('header-search-results');
  if (!input || !results || typeof DATA === 'undefined') return;

  const items = [
    ...(DATA.services || []).map(s => ({ label: s.title, href: `${sitePrefix()}pages/servicios/${s.slug}.php` })),
    ...(DATA.fabricantesInfo || []).map(f => ({ label: f.name, href: `${sitePrefix()}pages/fabricantes/${f.slug}.php` })),
  ];

  function renderResults(query) {
    const q = query.trim().toLowerCase();
    if (!q) { results.innerHTML = ''; results.classList.remove('show'); return; }
    const matches = items.filter(i => i.label.toLowerCase().includes(q)).slice(0, 8);
    if (!matches.length) {
      results.innerHTML = '<div class="header-search-empty">Sin resultados</div>';
    } else {
      results.innerHTML = matches.map(i => `<a href="${i.href}">${i.label}</a>`).join('');
    }
    results.classList.add('show');
  }

  input.addEventListener('input', () => renderResults(input.value));
  input.addEventListener('focus', () => { if (input.value.trim()) renderResults(input.value); });
  document.addEventListener('click', event => {
    if (!event.target.closest('.header-search')) results.classList.remove('show');
  });
}

// ══════════════════════════════════════════
//  SELLO DE CERTIFICACIONES (cerca del footer)
// ══════════════════════════════════════════
function certStripHtml(p) {
  const partners = (typeof DATA !== 'undefined' && DATA.partners) ? DATA.partners.slice(0, 10) : [];
  if (!partners.length) return '';
  return `
    <div class="cert-strip">
      <span class="cert-strip-label">Certificados y respaldados por</span>
      <div class="cert-strip-logos">
        ${partners.map(pt => pt.logo ? `<img src="${p}${pt.logo}" alt="${pt.name}" loading="lazy" title="${pt.name}">` : '').join('')}
      </div>
    </div>`;
}

// ══════════════════════════════════════════
//  FOOTER
// ══════════════════════════════════════════
function renderFooter() {
  const footer = document.getElementById('footer');
  if (!footer) return;
  const p = sitePrefix();
  footer.innerHTML = `
    ${certStripHtml(p)}
    <div class="footer-top">
      <div class="footer-brand">
        <a href="${p}index.php" class="nav-logo">A<span>X</span>ENTIA</a>
        <p>Conectando Ideas, Innovando el Futuro.<br>© ${new Date().getFullYear()} Axentia SRL. Todos los derechos reservados.</p>
      </div>
      <div class="footer-col">
        <h5>Empresa</h5>
        <ul>
          <li><a href="${p}pages/nosotros.php">Nosotros</a></li>
          <li><a href="${p}pages/socios.php">Socios</a></li>
          <li><a href="${p}pages/blog.php">Blog</a></li>
          <li><a href="${p}pages/contacto.php">Contacto</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Servicios</h5>
        <ul>
          <li><a href="${p}pages/servicios.php">Ciberseguridad</a></li>
          <li><a href="${p}pages/servicios.php">Infraestructura IT</a></li>
          <li><a href="${p}pages/servicios.php">Gestión de Nube</a></li>
          <li><a href="${p}pages/soporte.php">Soporte Gestionado</a></li>
          <li><a href="${p}pages/fabricantes.php">Fabricantes</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Contacto</h5>
        <ul>
          <li><a href="mailto:contacto@axentia.com.do">contacto@axentia.com.do</a></li>
          <li><a href="tel:+18294075537">+1 (829) 407-5537</a></li>
          <li><a href="tel:+18094324778">+1 (809) 432-4778</a></li>
          <li><a href="${p}pages/contacto.php">Santo Domingo & Santiago</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© ${new Date().getFullYear()} Axentia SRL · República Dominicana</p>
      <p>Diseñado por Axentia SRL</p>
    </div>`;
  applyBrandLogos();
  initChatWidget();
}

// Footer for index.php (root level)
function renderFooterRoot() {
  const footer = document.getElementById('footer');
  if (!footer) return;
  footer.innerHTML = `
    ${certStripHtml('')}
    <div class="footer-top">
      <div class="footer-brand">
        <a href="index.php" class="nav-logo">A<span>X</span>ENTIA</a>
        <p>Conectando Ideas, Innovando el Futuro.<br>© ${new Date().getFullYear()} Axentia SRL. Todos los derechos reservados.</p>
      </div>
      <div class="footer-col">
        <h5>Empresa</h5>
        <ul>
          <li><a href="pages/nosotros.php">Nosotros</a></li>
          <li><a href="pages/socios.php">Socios</a></li>
          <li><a href="pages/blog.php">Blog</a></li>
          <li><a href="pages/contacto.php">Contacto</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Servicios</h5>
        <ul>
          <li><a href="pages/servicios.php">Ciberseguridad</a></li>
          <li><a href="pages/servicios.php">Infraestructura IT</a></li>
          <li><a href="pages/servicios.php">Gestión de Nube</a></li>
          <li><a href="pages/soporte.php">Soporte Gestionado</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Contacto</h5>
        <ul>
          <li><a href="mailto:contacto@axentia.com.do">contacto@axentia.com.do</a></li>
          <li><a href="tel:+18294075537">+1 (829) 407-5537</a></li>
          <li><a href="tel:+18094324778">+1 (809) 432-4778</a></li>
          <li><a href="pages/contacto.php">Santo Domingo & Santiago</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© ${new Date().getFullYear()} Axentia SRL · República Dominicana</p>
      <p>Diseñado por Axentia SRL</p>
    </div>`;
  applyBrandLogos();
  initChatWidget();
}

// ══════════════════════════════════════════
//  WIDGET DE CHAT (cotización guiada, sin IA)
// ══════════════════════════════════════════
const CHAT_ORG_TYPES = ['Pequeña empresa', 'Mediana empresa', 'Gran empresa', 'Gobierno / Institución pública'];

function initChatWidget() {
  if (document.getElementById('axentia-chat')) return;

  const wrap = document.createElement('div');
  wrap.id = 'axentia-chat';
  wrap.innerHTML = `
    <button id="chat-launcher" class="chat-launcher" aria-label="Abrir chat de cotización">💬</button>
    <div id="chat-panel" class="chat-panel">
      <div class="chat-panel-header">
        <span>Habla con Axentia</span>
        <button id="chat-close" aria-label="Cerrar">×</button>
      </div>
      <div id="chat-messages" class="chat-messages"></div>
    </div>`;
  document.body.appendChild(wrap);

  const launcher = document.getElementById('chat-launcher');
  const panel = document.getElementById('chat-panel');
  const closeBtn = document.getElementById('chat-close');

  launcher.addEventListener('click', () => {
    panel.classList.toggle('open');
    if (panel.classList.contains('open') && !document.getElementById('chat-messages').children.length) {
      chatResetFlow();
    }
  });
  closeBtn.addEventListener('click', () => panel.classList.remove('open'));
}

function chatBotMessage(html) {
  const messages = document.getElementById('chat-messages');
  const el = document.createElement('div');
  el.className = 'chat-msg chat-msg-bot';
  el.innerHTML = html;
  messages.appendChild(el);
  messages.scrollTop = messages.scrollHeight;
  return el;
}

function chatUserMessage(text) {
  const messages = document.getElementById('chat-messages');
  const el = document.createElement('div');
  el.className = 'chat-msg chat-msg-user';
  el.textContent = text;
  messages.appendChild(el);
  messages.scrollTop = messages.scrollHeight;
}

function chatClearOptions() {
  const old = document.getElementById('chat-messages').querySelector('.chat-options, .chat-form');
  if (old) old.remove();
}

const chatState = { service: '', orgType: '' };

function chatResetFlow() {
  document.getElementById('chat-messages').innerHTML = '';
  chatState.service = '';
  chatState.orgType = '';
  const services = (typeof DATA !== 'undefined' && DATA.services) ? DATA.services.map(s => s.title) : [];
  services.push('Otro');
  chatBotMessage('¡Hola! Soy el asistente de cotización de Axentia. ¿Qué servicio te interesa?');
  const opts = document.createElement('div');
  opts.className = 'chat-options';
  opts.innerHTML = services.map(s => `<button data-value="${s}">${s}</button>`).join('');
  opts.addEventListener('click', event => {
    const btn = event.target.closest('button[data-value]');
    if (!btn) return;
    chatState.service = btn.getAttribute('data-value');
    chatUserMessage(chatState.service);
    chatClearOptions();
    chatStepOrgType();
  });
  document.getElementById('chat-messages').appendChild(opts);
}

function chatStepOrgType() {
  chatBotMessage('¿Qué tipo de organización representas?');
  const opts = document.createElement('div');
  opts.className = 'chat-options';
  opts.innerHTML = CHAT_ORG_TYPES.map(t => `<button data-value="${t}">${t}</button>`).join('');
  opts.addEventListener('click', event => {
    const btn = event.target.closest('button[data-value]');
    if (!btn) return;
    chatState.orgType = btn.getAttribute('data-value');
    chatUserMessage(chatState.orgType);
    chatClearOptions();
    chatStepContact();
  });
  document.getElementById('chat-messages').appendChild(opts);
}

function chatStepContact() {
  chatBotMessage('Perfecto, ¿cómo te contactamos?');
  const form = document.createElement('div');
  form.className = 'chat-form';
  form.innerHTML = `
    <input type="text" id="chat-f-name" placeholder="Nombre completo">
    <input type="email" id="chat-f-email" placeholder="Correo electrónico">
    <input type="tel" id="chat-f-phone" placeholder="Teléfono (opcional)">
    <button id="chat-f-submit" class="btn-primary">Enviar</button>`;
  document.getElementById('chat-messages').appendChild(form);
  document.getElementById('chat-f-submit').addEventListener('click', chatSubmit);
}

function chatSubmit() {
  const name = document.getElementById('chat-f-name').value.trim();
  const email = document.getElementById('chat-f-email').value.trim();
  const phone = document.getElementById('chat-f-phone').value.trim();
  if (!name || !email) { alert('Por favor completa nombre y correo.'); return; }

  const btn = document.getElementById('chat-f-submit');
  btn.disabled = true;
  btn.textContent = 'Enviando...';

  fetch(`${sitePrefix()}pages/contacto-enviar.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      name, email, phone,
      service: chatState.service,
      orgType: chatState.orgType,
      message: `Cotización iniciada vía chat del sitio.`,
    }),
  })
    .then(r => r.json())
    .then(res => {
      chatClearOptions();
      if (res.ok) {
        chatBotMessage(`¡Gracias, ${name}! Te contactaremos pronto.`);
        const again = document.createElement('div');
        again.className = 'chat-options';
        again.innerHTML = `<button id="chat-restart">Iniciar nueva consulta</button>`;
        document.getElementById('chat-messages').appendChild(again);
        document.getElementById('chat-restart').addEventListener('click', chatResetFlow);
      } else {
        chatBotMessage(res.error || 'No se pudo enviar el mensaje. Intenta de nuevo.');
      }
    })
    .catch(() => chatBotMessage('No se pudo conectar con el servidor. Intenta de nuevo más tarde.'));
}

// ══════════════════════════════════════════
//  RECURSOS DESCARGABLES (lead-gen gate)
// ══════════════════════════════════════════
function openResourceGate(id) {
  const resource = (DATA.resources || []).find(r => r.id === id);
  if (!resource) return;

  let modal = document.getElementById('resource-gate-modal');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'resource-gate-modal';
    modal.className = 'resource-gate-modal';
    modal.addEventListener('click', event => { if (event.target === modal) modal.classList.remove('show'); });
    document.body.appendChild(modal);
  }

  modal.innerHTML = `
    <div class="resource-gate-dialog">
      <button class="resource-gate-close" onclick="document.getElementById('resource-gate-modal').classList.remove('show')" aria-label="Cerrar">×</button>
      <h3>${resource.title}</h3>
      <p>Déjanos tu correo y descarga el recurso de inmediato.</p>
      <input type="text" id="rg-name" placeholder="Nombre completo">
      <input type="email" id="rg-email" placeholder="Correo electrónico">
      <button class="btn-primary" id="rg-submit" style="width:100%;justify-content:center">Descargar</button>
    </div>`;
  modal.classList.add('show');

  document.getElementById('rg-submit').addEventListener('click', () => {
    const name = document.getElementById('rg-name').value.trim();
    const email = document.getElementById('rg-email').value.trim();
    if (!name || !email) { alert('Por favor completa nombre y correo.'); return; }
    const btn = document.getElementById('rg-submit');
    btn.disabled = true;
    btn.textContent = 'Procesando...';

    fetch(`${sitePrefix()}pages/contacto-enviar.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, email, service: `Recurso: ${resource.title}`, message: 'Solicitud de descarga de recurso.' }),
    })
      .then(() => {
        modal.classList.remove('show');
        window.open(assetUrl(resource.fileUrl), '_blank');
      })
      .catch(() => {
        btn.disabled = false;
        btn.textContent = 'Descargar';
        alert('No se pudo procesar la solicitud. Intenta de nuevo.');
      });
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    applyBrandLogos();
    initInteractiveSite();
    initHeaderSearch();
    initAxParticlesBg();
    initHeroParallax();
  });
} else {
  applyBrandLogos();
  initInteractiveSite();
  initHeaderSearch();
  initAxParticlesBg();
  initHeroParallax();
}
