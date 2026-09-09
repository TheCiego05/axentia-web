<?php require_once __DIR__ . '/../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Planes de soporte IT gestionado para empresas dominicanas: monitoreo, respuesta y visitas presenciales según el nivel de tu operación.">
  <title>Soporte – Axentia SRL</title>
  <link rel="stylesheet" href="../css/style.css?v=31">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / Soporte</div>
      <div class="section-label">Servicios Continuos</div>
      <h1>Soporte Gestionado</h1>
      <p>Planes de soporte IT gestionado diseñados para empresas dominicanas. Monitoreo, respuesta y visitas presenciales incluidas según tu nivel.</p>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="support-plans">
        <div class="support-card">
          <h3>Business Support</h3>
          <div class="support-range">1 – 20 dispositivos</div>
          <ul>
            <li>2 visitas/mes</li>
            <li>Soporte remoto</li>
            <li>Gestión de tickets</li>
            <li>Monitoreo operativo</li>
            <li>Soporte preventivo</li>
          </ul>
          <a href="contacto.php" class="btn-outline" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <div class="support-card popular">
          <h3>Business Plus</h3>
          <div class="support-range">21 – 50 dispositivos</div>
          <ul>
            <li>3–4 visitas/mes</li>
            <li>Soporte prioritario</li>
            <li>Operación diaria TI</li>
            <li>Seguimiento preventivo</li>
            <li>Acompañamiento onsite</li>
          </ul>
          <a href="contacto.php" class="btn-primary" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <div class="support-card">
          <h3>Corporate Managed</h3>
          <div class="support-range">51 – 120 dispositivos</div>
          <ul>
            <li>4 visitas/mes + prioridad</li>
            <li>Gestión operativa extendida</li>
            <li>Escalamiento prioritario</li>
            <li>Coordinación técnica</li>
            <li>Reportes ejecutivos</li>
          </ul>
          <a href="contacto.php" class="btn-outline" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <div class="support-card">
          <h3>Enterprise</h3>
          <div class="support-range">121+ dispositivos</div>
          <ul>
            <li>SLA dedicado</li>
            <li>Servicio personalizado</li>
            <li>Según operación y criticidad</li>
            <li>Acuerdo de nivel de servicio</li>
            <li>Gestor de cuenta asignado</li>
          </ul>
          <a href="contacto.php" class="btn-outline" style="justify-content:center">Solicitar Cotización</a>
        </div>
      </div>

      <div style="margin-top:80px">
        <div class="section-label">SLA</div>
        <h2 class="section-title">Niveles de Servicio</h2>
        <div style="overflow-x:auto">
          <table class="sla-table">
            <thead>
              <tr><th>Plan</th><th>Tiempo de respuesta</th><th>Visitas/mes</th><th>Soporte</th><th>Reportes</th></tr>
            </thead>
            <tbody>
              <tr><td>Business Support</td><td>4 horas hábiles</td><td>2</td><td>Remoto</td><td>Mensual básico</td></tr>
              <tr><td>Business Plus</td><td>2 horas hábiles</td><td>3–4</td><td>Remoto + Onsite</td><td>Mensual detallado</td></tr>
              <tr><td>Corporate Managed</td><td>1 hora hábil</td><td>4+</td><td>Prioritario</td><td>Ejecutivo mensual</td></tr>
              <tr><td>Enterprise</td><td>SLA dedicado</td><td>Según acuerdo</td><td>Dedicado</td><td>Personalizado</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-band">
    <div class="container" style="text-align:center">
      <h2 class="section-title">¿Por qué Axentia SRL como su aliado operativo?</h2>
      <p class="section-sub" style="margin:0 auto 36px">Más de 4 años de experiencia, presencia en Santo Domingo y Santiago, y alianzas con las principales marcas tecnológicas del mundo.</p>
      <a href="contacto.php" class="btn-primary">Solicitar Cotización</a>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=10"></script>
  <script>renderFooter();</script>
</body>
</html>

