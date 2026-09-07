/* CalculAI - JavaScript Principal */
/* Versión: 1.0.0 */

'use strict';

// ===================== NAVBAR =====================
const navbar = document.querySelector('.navbar');
const hamburger = document.querySelector('.hamburger');

if (navbar) {
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 20);
  });
}

if (hamburger) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    document.querySelector('.navbar').classList.toggle('nav-menu-open');
  });
  // Close menu on link click
  document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('active');
      navbar.classList.remove('nav-menu-open');
    });
  });
}

// ===================== SCROLL ANIMATIONS =====================
const observeElements = () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right').forEach(el => {
    observer.observe(el);
  });
};

// ===================== FAQ =====================
const initFAQ = () => {
  document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
      const item = question.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });
};

// ===================== SMOOTH SCROLL =====================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const targetId = this.getAttribute('href');
    if (targetId === '#') return;
    const target = document.querySelector(targetId);
    if (target) {
      e.preventDefault();
      const offset = 80;
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  });
});

// ===================== COUNTERS =====================
const animateCounters = () => {
  const counters = document.querySelectorAll('[data-count]');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.dataset.animated) {
        entry.target.dataset.animated = 'true';
        const target = parseInt(entry.target.dataset.count);
        const suffix = entry.target.dataset.suffix || '';
        const duration = 1800;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
          current = Math.min(current + step, target);
          entry.target.textContent = Math.floor(current).toLocaleString() + suffix;
          if (current >= target) clearInterval(timer);
        }, 16);
      }
    });
  }, { threshold: 0.5 });
  counters.forEach(c => observer.observe(c));
};

// ===================== REGISTRATION FORM =====================
const initRegistrationForm = () => {
  const form = document.getElementById('formRegistro');
  if (!form) return;

  const usaSoftware = document.getElementById('usa_software');
  const cualField = document.getElementById('cual_software_group');

  if (usaSoftware && cualField) {
    usaSoftware.addEventListener('change', () => {
      if (usaSoftware.value === 'si') {
        cualField.classList.add('show');
        cualField.querySelector('input').required = true;
      } else {
        cualField.classList.remove('show');
        cualField.querySelector('input').required = false;
      }
    });
  }

  // Real-time validation
  const validateField = (field) => {
    const parent = field.closest('.form-group');
    const errorMsg = parent ? parent.querySelector('.error-msg') : null;
    let valid = true;
    let message = '';

    field.classList.remove('error');
    if (errorMsg) errorMsg.classList.remove('show');

    if (field.required && !field.value.trim()) {
      valid = false;
      message = 'Este campo es obligatorio.';
    } else if (field.type === 'email' && field.value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(field.value)) { valid = false; message = 'Ingresa un email válido.'; }
    } else if (field.type === 'tel' && field.value) {
      const telClean = field.value.replace(/\D/g, '');
      if (!/^(809|829|849)\d{7}$/.test(telClean)) {
        valid = false; message = 'Formato: 809-XXX-XXXX (809/829/849).';
      }
    }

    if (!valid) {
      field.classList.add('error');
      if (errorMsg) { errorMsg.textContent = message; errorMsg.classList.add('show'); }
    }
    return valid;
  };

  form.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('blur', () => validateField(field));
    field.addEventListener('input', () => {
      if (field.classList.contains('error')) validateField(field);
    });
  });

  // Phone formatting
  const phoneField = document.getElementById('telefono');
  if (phoneField) {
    phoneField.addEventListener('input', () => {
      let val = phoneField.value.replace(/\D/g, '');
      if (val.length >= 3) val = val.slice(0,3) + '-' + val.slice(3);
      if (val.length >= 7) val = val.slice(0,7) + '-' + val.slice(7);
      phoneField.value = val.slice(0, 12);
    });
  }

  // Form submission
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    let allValid = true;
    form.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
      if (!validateField(field)) allValid = false;
    });
    if (!allValid) { showToast('Por favor completa todos los campos requeridos.', 'error'); return; }

    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="spinner-sm"></span> Enviando...';
    submitBtn.disabled = true;

    try {
      const formData = new FormData(form);
      const response = await fetch('api/registro.php', {
        method: 'POST',
        body: formData
      });
      const result = await response.json();
      if (result.success) {
        window.location.href = 'gracias.html?name=' + encodeURIComponent(formData.get('nombre_completo'));
      } else {
        showToast(result.message || 'Error al enviar. Intenta de nuevo.', 'error');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      }
    } catch (err) {
      showToast('Error de conexión. Verifica tu internet.', 'error');
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;
    }
  });
};

// ===================== TOAST NOTIFICATIONS =====================
const showToast = (message, type = 'success') => {
  let container = document.querySelector('.toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
  }
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `
    <span>${type === 'success' ? '✅' : '❌'}</span>
    <span>${message}</span>`;
  container.appendChild(toast);
  setTimeout(() => { toast.style.opacity = '0'; toast.style.transform = 'translateX(100%)'; setTimeout(() => toast.remove(), 300); }, 4000);
};

// ===================== ADMIN: SEARCH & FILTER =====================
const initAdminTable = () => {
  const searchInput = document.getElementById('searchInput');
  const tableRows = document.querySelectorAll('.data-table tbody tr');
  if (!searchInput || !tableRows.length) return;

  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    tableRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
};

// ===================== ADMIN: MODAL =====================
const initModals = () => {
  document.querySelectorAll('[data-modal]').forEach(trigger => {
    trigger.addEventListener('click', () => {
      const modalId = trigger.dataset.modal;
      const modal = document.getElementById(modalId);
      if (modal) modal.classList.add('show');
    });
  });
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) overlay.classList.remove('show');
    });
  });
  document.querySelectorAll('.modal-close').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.closest('.modal-overlay').classList.remove('show');
    });
  });
};

// ===================== GA4 EVENTS =====================
const trackEvent = (eventName, params = {}) => {
  if (typeof gtag === 'function') {
    gtag('event', eventName, params);
  }
};

// Scroll depth tracking
let scrollDepths = { 25: false, 50: false, 75: false, 100: false };
window.addEventListener('scroll', () => {
  const scrollPct = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
  [25, 50, 75, 100].forEach(depth => {
    if (scrollPct >= depth && !scrollDepths[depth]) {
      scrollDepths[depth] = true;
      trackEvent('scroll_depth', { percent_scrolled: depth });
    }
  });
});

// CTA tracking
document.querySelectorAll('[data-track]').forEach(el => {
  el.addEventListener('click', () => trackEvent(el.dataset.track, { location: el.dataset.trackLoc || 'page' }));
});

// Section visibility tracking
const sectionObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting && entry.target.dataset.section) {
      trackEvent('seccion_vista', { section_name: entry.target.dataset.section });
    }
  });
}, { threshold: 0.5 });
document.querySelectorAll('[data-section]').forEach(el => sectionObserver.observe(el));

// ===================== THANKS PAGE =====================
const initThanksPage = () => {
  const params = new URLSearchParams(window.location.search);
  const name = params.get('name');
  const nameEl = document.getElementById('userName');
  if (nameEl && name) nameEl.textContent = name.split(' ')[0];
  // Redirect after 15 seconds
  const countdown = document.getElementById('countdown');
  if (countdown) {
    let seconds = 15;
    setInterval(() => {
      seconds--;
      countdown.textContent = seconds;
      if (seconds <= 0) window.location.href = 'index.html';
    }, 1000);
  }
};

// ===================== VIDEO PLAYER =====================
const initVideoPlayer = () => {
  const video    = document.getElementById('demoVideo');
  const overlay  = document.getElementById('videoOverlay');
  const playBtn  = document.getElementById('videoPlayBtn');
  const controls = document.getElementById('videoControls');
  if (!video) return;

  const vcPlayPause  = document.getElementById('vcPlayPause');
  const vcMute       = document.getElementById('vcMute');
  const vcFullscreen = document.getElementById('vcFullscreen');
  const vcProgress   = document.getElementById('vcProgressBar');
  const vcProgressW  = document.getElementById('vcProgressWrap');
  const vcTime       = document.getElementById('vcTime');
  const playIcon     = document.getElementById('playPauseIcon');
  const muteIcon     = document.getElementById('muteIcon');

  // Muted badge
  const mutedBadge = document.createElement('div');
  mutedBadge.className = 'muted-badge';
  mutedBadge.innerHTML = '<i class="fas fa-volume-mute"></i> Sin sonido — clic para activar';
  video.parentElement.appendChild(mutedBadge);

  // Format seconds → m:ss
  const fmt = s => {
    if (isNaN(s)) return '0:00';
    const m = Math.floor(s / 60);
    const sec = Math.floor(s % 60).toString().padStart(2, '0');
    return `${m}:${sec}`;
  };

  // Update progress bar & time
  video.addEventListener('timeupdate', () => {
    if (!video.duration) return;
    const pct = (video.currentTime / video.duration) * 100;
    vcProgress.style.width = pct + '%';
    if (vcTime) vcTime.textContent = `${fmt(video.currentTime)} / ${fmt(video.duration)}`;
  });

  // Click overlay → play with sound
  if (overlay) {
    overlay.addEventListener('click', () => {
      video.muted = false;
      video.play();
      overlay.classList.add('hidden');
      mutedBadge.classList.add('hide');
      if (playIcon) playIcon.className = 'fas fa-pause';
      trackEvent('video_play_sound', { source: 'overlay_click' });
    });
  }

  // Play / Pause button
  if (vcPlayPause) {
    vcPlayPause.addEventListener('click', () => {
      if (video.paused) { video.play(); }
      else { video.pause(); }
    });
    video.addEventListener('play',  () => { if (playIcon) playIcon.className = 'fas fa-pause'; });
    video.addEventListener('pause', () => { if (playIcon) playIcon.className = 'fas fa-play'; });
  }

  // Mute toggle
  if (vcMute) {
    vcMute.addEventListener('click', () => {
      video.muted = !video.muted;
      muteIcon.className = video.muted ? 'fas fa-volume-mute' : 'fas fa-volume-up';
      mutedBadge.classList.toggle('hide', !video.muted);
      if (overlay && !video.muted) overlay.classList.add('hidden');
    });
  }

  // Progress bar scrubbing
  if (vcProgressW) {
    vcProgressW.addEventListener('click', e => {
      const rect = vcProgressW.getBoundingClientRect();
      const ratio = (e.clientX - rect.left) / rect.width;
      video.currentTime = ratio * video.duration;
    });
  }

  // Fullscreen
  if (vcFullscreen) {
    vcFullscreen.addEventListener('click', () => {
      const box = video.parentElement;
      if (!document.fullscreenElement) {
        (box.requestFullscreen || box.webkitRequestFullscreen || box.mozRequestFullScreen).call(box);
        vcFullscreen.querySelector('i').className = 'fas fa-compress';
      } else {
        (document.exitFullscreen || document.webkitExitFullscreen).call(document);
        vcFullscreen.querySelector('i').className = 'fas fa-expand';
      }
    });
  }

  // Click video itself toggles play/pause
  video.addEventListener('click', () => {
    if (overlay && !overlay.classList.contains('hidden')) return;
    if (video.paused) video.play(); else video.pause();
  });

  // Keyboard shortcuts when video is focused
  document.addEventListener('keydown', e => {
    const active = document.activeElement;
    if (active && (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA')) return;
    if (e.code === 'Space' && document.getElementById('demoVideo')) {
      e.preventDefault();
      if (video.paused) video.play(); else video.pause();
    }
    if (e.code === 'KeyM') { video.muted = !video.muted; }
  });

  // Show controls always on mobile (no hover)
  if (window.innerWidth <= 768 && controls) {
    controls.style.opacity = '1';
  }
};

// ===================== INIT =====================
document.addEventListener('DOMContentLoaded', () => {
  observeElements();
  initFAQ();
  animateCounters();
  initRegistrationForm();
  initAdminTable();
  initModals();
  initThanksPage();
  initVideoPlayer();
});
