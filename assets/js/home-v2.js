/* CalculAI — HOME v2 JS (solo index.html) */
/* Se carga después de main.js. No redefine nada de main.js. */

'use strict';

// ===================== FONDO DE PARTÍCULAS =====================
function initParticlesBg() {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const canvas = document.createElement('canvas');
  canvas.id = 'particles-bg';
  canvas.setAttribute('aria-hidden', 'true');
  document.body.prepend(canvas);
  if (reduceMotion) return;

  const ctx = canvas.getContext('2d');
  let w, h, dpr, particles;

  function isMobile() { return window.innerWidth < 768; }

  function resize() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    w = canvas.width = window.innerWidth * dpr;
    h = canvas.height = window.innerHeight * dpr;
    canvas.style.width = window.innerWidth + 'px';
    canvas.style.height = window.innerHeight + 'px';
    const count = isMobile() ? 26 : 58;
    particles = Array.from({ length: count }, () => ({
      x: Math.random() * w,
      y: Math.random() * h,
      vx: (Math.random() - 0.5) * 0.15 * dpr,
      vy: (Math.random() - 0.5) * 0.15 * dpr,
      r: (Math.random() * 1.6 + 0.6) * dpr,
      o: Math.random() * 0.35 + 0.15,
    }));
  }

  function step() {
    ctx.clearRect(0, 0, w, h);
    const linkDist = 140 * dpr;
    for (let i = 0; i < particles.length; i++) {
      const p = particles[i];
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > w) p.vx *= -1;
      if (p.y < 0 || p.y > h) p.vy *= -1;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(37,99,235,${p.o})`;
      ctx.fill();
      for (let j = i + 1; j < particles.length; j++) {
        const q = particles[j];
        const dx = p.x - q.x, dy = p.y - q.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < linkDist) {
          ctx.beginPath();
          ctx.moveTo(p.x, p.y);
          ctx.lineTo(q.x, q.y);
          ctx.strokeStyle = `rgba(37,99,235,${0.12 * (1 - dist / linkDist)})`;
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      }
    }
    requestAnimationFrame(step);
  }

  resize();
  window.addEventListener('resize', resize);
  requestAnimationFrame(step);
}

// ===================== SCROLL REVEAL (v2) =====================
function initV2Reveal() {
  const items = document.querySelectorAll('.v2-reveal');
  if (!items.length) return;
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  items.forEach(el => observer.observe(el));
}

// ===================== NAV: SECCIÓN ACTIVA =====================
function initNavActiveSection() {
  const links = Array.from(document.querySelectorAll('.nav-links a[href^="#"]'));
  if (!links.length) return;
  const map = new Map();
  links.forEach(link => {
    const id = link.getAttribute('href').slice(1);
    const el = document.getElementById(id);
    if (el) map.set(el, link);
  });
  if (!map.size) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        links.forEach(l => l.classList.remove('nav-active'));
        map.get(entry.target).classList.add('nav-active');
      }
    });
  }, { threshold: 0.5, rootMargin: '-40% 0px -40% 0px' });

  map.forEach((_link, el) => observer.observe(el));
}

// ===================== DEMO DEL AGENTE IA =====================
const AGENT_TASKS = [
  'Analizando transacciones del mes',
  'Conciliando cuentas bancarias',
  'Validando comprobantes fiscales',
  'Registrando asientos contables',
  'Calculando impuestos',
  'Revisando cuentas por cobrar',
  'Revisando cuentas por pagar',
  'Detectando inconsistencias',
  'Actualizando indicadores',
  'Generando Estado de Resultados',
  'Generando Balance General',
  'Preparando Flujo de Efectivo',
  'Elaborando reporte ejecutivo',
];

function initAgentDemo() {
  const section = document.getElementById('agente-ia');
  const body = document.getElementById('agentChatBody');
  if (!section || !body) return;
  let played = false;

  function playAgentDemo() {
    body.innerHTML = '';

    const userMsg = document.createElement('div');
    userMsg.className = 'chat-bubble user';
    userMsg.textContent = 'Realiza el cierre contable del mes.';
    body.appendChild(userMsg);

    const agentMsg = document.createElement('div');
    agentMsg.className = 'chat-bubble agent';
    agentMsg.style.animationDelay = '.3s';
    agentMsg.textContent = 'Entendido. Iniciando el cierre contable — esto tomará solo unos segundos.';
    body.appendChild(agentMsg);

    const list = document.createElement('div');
    list.className = 'agent-task-list';
    body.appendChild(list);

    const finalMsg = document.createElement('div');
    finalMsg.className = 'agent-chat-final';
    finalMsg.textContent = '✓ Todas las tareas fueron completadas exitosamente.';
    body.appendChild(finalMsg);

    AGENT_TASKS.forEach((task, i) => {
      setTimeout(() => {
        const el = document.createElement('div');
        el.className = 'agent-task';
        el.innerHTML = `<span class="agent-task-icon"></span><span>${task}</span>`;
        list.appendChild(el);
        requestAnimationFrame(() => el.classList.add('show'));
        setTimeout(() => el.classList.add('done'), 550);
      }, 900 + i * 260);
    });

    setTimeout(() => finalMsg.classList.add('show'), 900 + AGENT_TASKS.length * 260 + 700);
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !played) {
        played = true;
        playAgentDemo();
        observer.disconnect();
      }
    });
  }, { threshold: 0.4 });
  observer.observe(section);

  const replayBtn = document.getElementById('agentReplayBtn');
  if (replayBtn) {
    replayBtn.addEventListener('click', () => {
      played = true;
      playAgentDemo();
      trackEventV2('agent_demo_replay');
    });
  }
}

// ===================== SHOWCASE: PESTAÑAS DE MÓDULOS =====================
function initShowcaseTabs() {
  const tabs = document.querySelectorAll('.showcase-tab');
  if (!tabs.length) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      if (tab.classList.contains('active')) return;
      const targetId = tab.dataset.target;
      const targetPanel = document.getElementById(targetId);
      if (!targetPanel) return;

      tabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected', 'false'); });
      tab.classList.add('active');
      tab.setAttribute('aria-selected', 'true');

      document.querySelectorAll('.showcase-panel').forEach(p => p.classList.remove('active'));
      targetPanel.classList.add('active');

      trackEventV2('showcase_tab_view', { module: targetId.replace('tab-', '') });
    });
  });
}

// ===================== MÓDULOS: PULSO ROTATIVO =====================
function initModulePulse() {
  const cards = document.querySelectorAll('.module-card-v2');
  if (!cards.length) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  let idx = 0;
  function tick() {
    cards.forEach(c => c.classList.remove('pulse'));
    cards[idx].classList.add('pulse');
    idx = (idx + 1) % cards.length;
  }
  tick();
  setInterval(tick, 2600);
}

// ===================== TRACKING (reutiliza gtag si existe) =====================
function trackEventV2(eventName, params = {}) {
  if (typeof gtag === 'function') gtag('event', eventName, params);
}

// ===================== INIT =====================
document.addEventListener('DOMContentLoaded', () => {
  initParticlesBg();
  initV2Reveal();
  initNavActiveSection();
  initAgentDemo();
  initModulePulse();
  initShowcaseTabs();
});
