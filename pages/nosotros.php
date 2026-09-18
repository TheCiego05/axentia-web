<?php require_once __DIR__ . '/../includes/data-loader.php'; require_once __DIR__ . '/../includes/analytics.php'; track_pageview('nosotros.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Conoce a Axentia SRL: nuestra historia, misión, visión y el equipo que respalda soluciones de tecnología y ciberseguridad en República Dominicana.">
  <title>Nosotros – Axentia SRL</title>
  <link rel="stylesheet" href="/css/style.css?v=47">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '/'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="/index.php">Inicio</a> / Nosotros</div>
      <div class="section-label">Quiénes Somos</div>
      <h1>Sobre Axentia SRL</h1>
      <p>Un aliado tecnológico para organizaciones que buscan seguridad, continuidad operativa y crecimiento digital sostenible.</p>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="about-grid">
        <div>
          <div class="section-label">Nuestra Historia</div>
          <h2 class="section-title">Tecnología con enfoque estratégico</h2>
          <p class="section-sub"><?= htmlspecialchars($DATA['nosotros']['descripcion'] ?? '') ?></p>
          <div class="about-pillars">
            <div class="pillar-card">
              <span aria-hidden="true">01</span>
              <h3>Infraestructura confiable</h3>
              <p>Diseño, implementación y soporte para entornos físicos, virtuales, híbridos y en la nube.</p>
            </div>
            <div class="pillar-card">
              <span aria-hidden="true">02</span>
              <h3>Seguridad como base</h3>
              <p>Ciberseguridad, protección de endpoints, continuidad y gestión de riesgos tecnológicos.</p>
            </div>
            <div class="pillar-card">
              <span aria-hidden="true">03</span>
              <h3>Acompañamiento cercano</h3>
              <p>Soporte local, asesoría técnica y ejecución alineada a los objetivos de cada cliente.</p>
            </div>
          </div>
          <div class="about-values">
            <div class="value-card">
              <h3>Misión</h3>
              <p><?= htmlspecialchars($DATA['nosotros']['mision'] ?? '') ?></p>
            </div>
            <div class="value-card">
              <h3>Visión</h3>
              <p><?= htmlspecialchars($DATA['nosotros']['vision'] ?? '') ?></p>
            </div>
          </div>
        </div>
        <div class="about-stats">
          <div class="about-stat"><div class="num">4+</div><div class="label">Profesionales</div></div>
          <div class="about-stat"><div class="num">7+</div><div class="label">Clientes activos</div></div>
          <div class="about-stat"><div class="num">2</div><div class="label">Ciudades en RD</div></div>
          <div class="about-stat"><div class="num">20+</div><div class="label">Socios tecnológicos</div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-blue">
    <div class="container">
      <div class="section-label">Quienes confían en nosotros</div>
      <h2 class="section-title">Nuestros Clientes</h2>
      <div class="clients-grid" id="clients-grid"></div>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="/js/main.js?v=18"></script>
  <script>
    document.getElementById('clients-grid').innerHTML = DATA.clients.map(renderClientCard).join('');
    renderFooter();
  </script>
</body>
</html>

