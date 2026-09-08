<?php require_once __DIR__ . '/includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Axentia SRL – Conectando Ideas, Innovando el Futuro</title>
  <meta name="description" content="Soluciones tecnológicas y de ciberseguridad para cualquier tipo de organización en República Dominicana — pequeña, mediana, grande o gobierno.">
  <link rel="stylesheet" href="css/style.css?v=10">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">

  <!-- NAVBAR -->
  <?php $base = ''; include __DIR__ . '/includes/nav.php'; ?>

  <!-- HERO -->
  <section id="hero">
    <canvas id="ax-particles-bg" aria-hidden="true"></canvas>
    <div class="container hero-v3-copy reveal-on-scroll">
      <div class="hero-badge">
        <span class="badge-dot"></span>
        <?= htmlspecialchars($DATA['hero']['badge']) ?>
      </div>
      <h1 class="hero-h1 hero-h1-v3">
        <?= htmlspecialchars($DATA['hero']['t1']) ?> <span class="accent"><?= htmlspecialchars($DATA['hero']['t2']) ?></span> <?= htmlspecialchars($DATA['hero']['t3']) ?> <?= htmlspecialchars($DATA['hero']['t4']) ?>
      </h1>
      <p class="hero-desc hero-desc-v3">
        <?= htmlspecialchars($DATA['hero']['desc']) ?>
      </p>
      <div class="hero-btns hero-btns-v3">
        <a href="pages/servicios.php" class="btn-primary">Nuestros Servicios</a>
        <a href="pages/contacto.php" class="btn-outline">Contáctanos</a>
      </div>
    </div>

    <div class="hero-showcase reveal-on-scroll">
      <div class="hero-showcase-glow" aria-hidden="true"></div>
      <div class="hero-showcase-frame" id="heroParallaxFrame">
        <div class="ax-mockup">
          <div class="ax-mockup-header">
            <span class="ax-dot red"></span><span class="ax-dot yellow"></span><span class="ax-dot green"></span>
            <span class="ax-mockup-title">Axentia — Centro de Operaciones</span>
          </div>
          <div class="ax-mockup-body">
            <div class="ax-mockup-kpis">
              <div class="ax-mockup-kpi"><div class="ax-mockup-kpi-val">128</div><div class="ax-mockup-kpi-lbl">Amenazas bloqueadas</div></div>
              <div class="ax-mockup-kpi"><div class="ax-mockup-kpi-val">99.9%</div><div class="ax-mockup-kpi-lbl">Disponibilidad</div></div>
              <div class="ax-mockup-kpi"><div class="ax-mockup-kpi-val">340</div><div class="ax-mockup-kpi-lbl">Endpoints protegidos</div></div>
            </div>
            <div class="ax-mockup-chart" aria-hidden="true">
              <span style="height:30%"></span><span style="height:55%"></span><span style="height:40%"></span>
              <span style="height:68%"></span><span style="height:50%"></span><span style="height:80%"></span>
              <span style="height:95%"></span>
            </div>
            <div class="ax-mockup-list">
              <div class="ax-mockup-row"><span>Firewall perimetral</span><span>Activo</span><span class="ax-ok">✓</span></div>
              <div class="ax-mockup-row"><span>Copia de seguridad · Nube</span><span>Al día</span><span class="ax-ok">✓</span></div>
              <div class="ax-mockup-row"><span>Endpoint sin parchar</span><span>Revisar</span><span class="ax-warn">!</span></div>
            </div>
          </div>
        </div>

        <div class="hero-agent-panel">
          <div class="hero-agent-panel-header"><span class="dot"></span> Monitoreo Axentia</div>
          <div class="hero-agent-panel-body">
            <div class="hero-agent-task done"><span></span> Escaneando endpoints</div>
            <div class="hero-agent-task done"><span></span> Verificando backups</div>
            <div class="hero-agent-task"><span></span> Actualizando firmas…</div>
          </div>
        </div>
      </div>

      <div class="hero-notif-wrap n1 reveal-on-scroll"><div class="hero-notif">✅ Amenaza bloqueada en tiempo real</div></div>
      <div class="hero-notif-wrap n2 reveal-on-scroll"><div class="hero-notif">💾 Backup verificado</div></div>
      <div class="hero-notif-wrap n3 reveal-on-scroll"><div class="hero-notif">🔒 Certificado SSL renovado</div></div>
      <div class="hero-notif-wrap n4 reveal-on-scroll"><div class="hero-notif">🛠️ Parche crítico aplicado</div></div>
    </div>
  </section>

  <!-- SERVICIOS PREVIEW -->
  <section id="servicios-preview" class="section-dark">
    <div class="container">
      <div class="section-label">Lo que ofrecemos</div>
      <h2 class="section-title">Nuestros Servicios</h2>
      <p class="section-sub">Soluciones tecnológicas completas para potenciar tu empresa dominicana.</p>
      <div class="services-grid" id="home-services-grid">
        <!-- Rendered by JS from server-side DATA -->
      </div>
      <div style="text-align:center;margin-top:40px">
        <a href="pages/servicios.php" class="btn-primary">Ver todos los servicios</a>
      </div>
    </div>
  </section>

  <!-- FABRICANTES PREVIEW -->
  <section id="fabricantes-preview" class="section-gradient">
    <div class="container">
      <div class="xcitium-header">
        <div class="section-label" style="justify-content:center">Ecosistema tecnológico</div>
        <h2 class="section-title" style="text-align:center">Fabricantes que respaldan nuestras soluciones</h2>
        <p class="section-sub" style="margin:0 auto 40px;text-align:center">
          Integramos soluciones de ciberseguridad, nube, infraestructura, redes, continuidad y gestión empresarial con fabricantes líderes.
        </p>
        <div style="text-align:center">
          <a href="pages/fabricantes.php" class="btn-primary">Ver fabricantes</a>
        </div>
      </div>
      <div class="stats-row">
        <div class="stat-item"><span class="stat-num">20+</span><span class="stat-label">Fabricantes</span></div>
        <div class="stat-item"><span class="stat-num">360°</span><span class="stat-label">Portafolio IT</span></div>
        <div class="stat-item"><span class="stat-num">Local</span><span class="stat-label">Acompañamiento</span></div>
        <div class="stat-item"><span class="stat-num">Gold</span><span class="stat-label">Partner Kaspersky</span></div>
      </div>
    </div>
  </section>

  <?php $destacados = array_values(array_filter($DATA['fabricantesInfo'] ?? [], function ($f) { return !empty($f['destacado']); })); ?>
  <?php if (!empty($destacados)): ?>
  <!-- PRODUCTOS DESTACADOS -->
  <section id="productos-destacados" class="section-dark featured-products-section">
    <div class="container">
      <div class="section-label" style="justify-content:center">Lo mejor de nuestro portafolio</div>
      <h2 class="section-title" style="text-align:center">Descubre nuestros productos estrella</h2>
      <p class="section-sub" style="margin:0 auto 32px;text-align:center">Soluciones que recomendamos especialmente por su impacto real en la operación de nuestros clientes.</p>
      <div class="featured-products-grid">
        <?php foreach ($destacados as $f): ?>
        <article class="featured-product-card">
          <div class="featured-product-media">
            <?php if (!empty($f['videoUrl'])): ?>
              <video controls preload="metadata" src="<?= htmlspecialchars($f['videoUrl']) ?>"></video>
            <?php elseif (!empty($f['logo'])): ?>
              <img src="<?= htmlspecialchars($f['logo']) ?>" alt="<?= htmlspecialchars($f['name']) ?>">
            <?php endif; ?>
          </div>
          <div class="featured-product-info">
            <span class="section-label" style="margin-bottom:6px"><?= htmlspecialchars($f['categoria'] ?? '') ?></span>
            <h3><?= htmlspecialchars($f['name']) ?></h3>
            <p><?= htmlspecialchars($f['descripcion'] ?? '') ?></p>
            <div>
              <a href="<?= !empty($f['customPage']) ? 'pages/fabricantes/' . htmlspecialchars($f['customPage']) : 'pages/fabricantes/ver.php?slug=' . urlencode($f['slug']) ?>" class="btn-primary">Conocer más</a>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- CLIENTES PREVIEW -->
  <section id="clientes-preview" class="section-dark">
    <div class="container">
      <div class="section-label">Quienes confían en nosotros</div>
      <h2 class="section-title">Nuestros Clientes</h2>
      <div class="clients-grid" id="home-clients-grid">
        <!-- Rendered by JS -->
      </div>
    </div>
  </section>

  <!-- TESTIMONIOS -->
  <section id="testimonios" class="section-gradient">
    <div class="container">
      <div class="section-label">Casos de éxito</div>
      <h2 class="section-title">Lo que dicen quienes ya trabajan con nosotros</h2>
      <div class="testimonials-grid" id="home-testimonials-grid">
        <!-- Rendered by JS -->
      </div>
    </div>
  </section>

  <!-- SOCIOS PREVIEW -->
  <section id="socios-preview" class="section-blue">
    <div class="container">
      <div class="section-label">Alianzas estratégicas</div>
      <h2 class="section-title">Trabajamos Con</h2>
      <p class="section-sub">Somos partners y revendedores certificados de las principales marcas tecnológicas del mundo.</p>
      <div class="partners-grid" id="home-partners-grid">
        <!-- Rendered by JS -->
      </div>
    </div>
  </section>

  <!-- CTA BAND -->
  <section class="cta-band">
    <div class="container" style="text-align:center">
      <h2 class="section-title">¿Listo para transformar tu empresa?</h2>
      <p class="section-sub" style="margin:0 auto 36px">Contáctanos y un especialista de Axentia te brindará la solución que necesitas.</p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="pages/contacto.php" class="btn-primary">Solicitar asesoría</a>
        <a href="pages/servicios.php" class="btn-outline">Explorar servicios</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer id="footer"></footer>

  <?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="js/main.js?v=10"></script>
  <script>
    // Render preview sections
    document.getElementById('home-services-grid').innerHTML =
      DATA.services.slice(0,6).map(renderServiceCard).join('');
    document.getElementById('home-clients-grid').innerHTML =
      DATA.clients.map(renderClientCard).join('');
    document.getElementById('home-partners-grid').innerHTML =
      DATA.partners.map(renderPartnerBadge).join('');
    document.getElementById('home-testimonials-grid').innerHTML =
      (DATA.testimonials || []).map(renderTestimonialCard).join('');
    renderFooterRoot();
  </script>
</body>
</html>
