<?php require_once __DIR__ . '/../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto – Axentia SRL</title>
  <link rel="stylesheet" href="../css/style.css?v=8">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / Contacto</div>
      <div class="section-label">Estamos listos</div>
      <h1>Contáctanos</h1>
      <p>Cuéntanos qué necesitas resolver y te orientamos con una ruta clara: diagnóstico, propuesta, implementación y soporte.</p>
    </div>
  </div>

  <section class="section-dark contact-modern-section">
    <div class="container">
      <div class="contact-summary-grid">
        <article><span>01</span><h3>Diagnóstico</h3><p>Entendemos tu necesidad, entorno y prioridad.</p></article>
        <article><span>02</span><h3>Propuesta</h3><p>Diseñamos una solución con alcance y fabricantes adecuados.</p></article>
        <article><span>03</span><h3>Acompañamiento</h3><p>Te apoyamos en implementación, soporte y mejora continua.</p></article>
      </div>
      <div class="contact-grid">
        <div class="contact-info">
          <h2>Hablemos de tu proyecto</h2>
          <p>Comparte el contexto de tu organización y nuestro equipo te ayudará a identificar el camino técnico más conveniente.</p>
          <div class="contact-items" id="contact-items">
            <!-- rendered by JS -->
          </div>
        </div>
        <div class="contact-form">
          <h3>Envíanos un mensaje</h3>
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" id="f-name" placeholder="Tu nombre completo">
          </div>
          <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" id="f-email" placeholder="tu@correo.com">
          </div>
          <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" id="f-phone" placeholder="+1 (809) 000-0000">
          </div>
          <div class="form-group">
            <label>Servicio de interés</label>
            <select id="f-service">
              <option value="">Seleccionar servicio...</option>
              <option>Ciberseguridad / Xcitium</option>
              <option>Infraestructura IT</option>
              <option>Gestión de la Nube</option>
              <option>Soporte Gestionado</option>
              <option>Transformación Digital</option>
              <option>Redes y Cableado</option>
              <option>Seguridad Física</option>
              <option>Otro</option>
            </select>
          </div>
          <div class="form-group">
            <label>Mensaje</label>
            <textarea id="f-msg" placeholder="Cuéntanos sobre tu proyecto o consulta..."></textarea>
          </div>
          <button class="btn-primary" style="width:100%;justify-content:center" onclick="submitForm()">
            Enviar Mensaje
          </button>
          <p id="form-note" style="display:none;margin-top:16px;text-align:center;color:#5eff9b;font-size:.9rem">
            ✓ Mensaje enviado. Te contactaremos pronto.
          </p>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=8"></script>
  <script>
    function submitForm() {
      const name = document.getElementById('f-name').value.trim();
      const email = document.getElementById('f-email').value.trim();
      if (!name || !email) { alert('Por favor completa nombre y correo.'); return; }

      const btn = document.querySelector('.contact-form .btn-primary');
      btn.disabled = true;

      fetch('contacto-enviar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          name,
          email,
          phone: document.getElementById('f-phone').value.trim(),
          service: document.getElementById('f-service').value,
          message: document.getElementById('f-msg').value.trim(),
        }),
      })
        .then(r => r.json())
        .then(res => {
          if (!res.ok) { alert(res.error || 'No se pudo enviar el mensaje. Intenta de nuevo.'); return; }
          document.getElementById('form-note').style.display = 'block';
          document.getElementById('f-name').value = '';
          document.getElementById('f-email').value = '';
          document.getElementById('f-phone').value = '';
          document.getElementById('f-service').value = '';
          document.getElementById('f-msg').value = '';
        })
        .catch(() => alert('No se pudo enviar el mensaje. Intenta de nuevo.'))
        .finally(() => { btn.disabled = false; });
    }

    // Render contact items
    const c = DATA.contacto;
    const html = `
      <div class="contact-item">
        <div class="contact-item-icon contact-icon-mail"></div>
        <div><h5>Email</h5><p>${c.email}</p></div>
      </div>` +
      c.personas.map(p => `
      <div class="contact-item">
        <div class="contact-item-icon contact-icon-phone"></div>
        <div><h5>${p.nombre}</h5><p>${p.telefono}</p></div>
      </div>`).join('') + `
      <div class="contact-item">
        <div class="contact-item-icon contact-icon-location"></div>
        <div><h5>Ubicación</h5><p>${c.ubicacion}</p></div>
      </div>`;
    document.getElementById('contact-items').innerHTML = html;
    renderFooter();
  </script>
</body>
</html>

