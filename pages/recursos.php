<?php require_once __DIR__ . '/../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recursos – Axentia SRL</title>
  <meta name="description" content="Brochures, whitepapers y casos de estudio de las soluciones que integra Axentia SRL.">
  <link rel="stylesheet" href="../css/style.css?v=20">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
  <div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / Recursos</div>
      <div class="section-label">Material descargable</div>
      <h1>Recursos</h1>
      <p>Brochures, whitepapers y casos de estudio de las soluciones que integramos. Descarga el que te interese dejando tu correo.</p>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="resources-grid" id="resources-grid"></div>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=10"></script>
  <script>
    const grid = document.getElementById('resources-grid');
    grid.innerHTML = (DATA.resources || []).length
      ? DATA.resources.map(renderResourceCard).join('')
      : '<p style="color:var(--white-40)">Aún no hay recursos publicados.</p>';
    renderFooter();
  </script>
</body>
</html>
