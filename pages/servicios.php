<?php require_once __DIR__ . '/../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Servicios – Axentia SRL</title>
  <link rel="stylesheet" href="../css/style.css?v=16">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site services-interactive-page">
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="motion-network" aria-hidden="true">
      <span></span><span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / Servicios</div>
      <div class="section-label">Lo que ofrecemos</div>
      <h1>Nuestros Servicios</h1>
      <p>Soluciones tecnológicas completas para proteger, modernizar y operar mejor tu organización. Cada servicio cuenta con una página de detalle para profundizar alcance, proceso y entregables.</p>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="services-intro-panel">
        <div>
          <div class="section-label">Explora por necesidad</div>
          <h2>Servicios con rutas claras de implementación</h2>
          <p>Selecciona un servicio para ver cómo lo abordamos, qué entregables puedes esperar y cómo se conecta con fabricantes, soporte y continuidad operativa. Más que vender tecnología, acompañamos cada decisión técnica con criterio, claridad y responsabilidad operativa.</p>
        </div>
        <div class="service-values-grid">
          <article class="value-seguridad"><span>01</span><h3>Seguridad</h3><p>Diseñamos pensando en prevención, continuidad y control del riesgo.</p></article>
          <article class="value-claridad"><span>02</span><h3>Claridad</h3><p>Traducimos complejidad técnica en decisiones accionables.</p></article>
          <article class="value-compromiso"><span>03</span><h3>Compromiso</h3><p>Acompañamos desde el diagnóstico hasta la operación diaria.</p></article>
          <article class="value-innovacion"><span>04</span><h3>Innovación</h3><p>Integramos fabricantes y soluciones que aportan valor real.</p></article>
        </div>
      </div>
      <div class="stats-row services-stats-row">
        <div class="stat-item"><span class="stat-num" id="services-count">–</span><span class="stat-label">Servicios activos</span></div>
        <div class="stat-item"><span class="stat-num">20+</span><span class="stat-label">Fabricantes integrados</span></div>
        <div class="stat-item"><span class="stat-num">Gold</span><span class="stat-label">Partner Kaspersky</span></div>
        <div class="stat-item"><span class="stat-num">RD</span><span class="stat-label">Soporte local</span></div>
      </div>
      <div class="services-grid service-grid-enhanced" id="services-grid"></div>
    </div>
  </section>

  <section class="section-blue">
    <div class="container">
      <div class="section-label">Soluciones por marca</div>
      <h2 class="section-title">Explora por fabricante</h2>
      <p class="section-sub">Encuentra información de cada fabricante, sus soluciones principales y cómo Axentia puede ayudarte a implementarlas, integrarlas y soportarlas.</p>
      <a href="fabricantes.php" class="btn-primary">Ver fabricantes</a>
    </div>
  </section>

  <section class="cta-band">
    <div class="container" style="text-align:center">
      <h2 class="section-title">¿Necesitas una solución personalizada?</h2>
      <p class="section-sub" style="margin:0 auto 36px">Nuestro equipo analiza tus necesidades y diseña la solución tecnológica ideal para tu empresa.</p>
      <a href="contacto.php" class="btn-primary">Solicitar Consultoría</a>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=10"></script>
  <script>
    document.getElementById('services-grid').innerHTML = DATA.services.map(renderServiceCard).join('');
    var servicesCountEl = document.getElementById('services-count');
    if (servicesCountEl) servicesCountEl.textContent = DATA.services.length;
    renderFooter();
  </script>
</body>
</html>

