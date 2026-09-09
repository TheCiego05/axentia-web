<?php require_once __DIR__ . '/../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Axentia SRL es partner y revendedor certificado de Microsoft, Fortinet, Kaspersky, Veeam y otras marcas tecnológicas líderes.">
  <title>Socios – Axentia SRL</title>
  <link rel="stylesheet" href="../css/style.css?v=31">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / Socios</div>
      <div class="section-label">Alianzas Estratégicas</div>
      <h1>Nuestros Socios</h1>
      <p>Somos partners y revendedores certificados de las principales marcas tecnológicas del mundo.</p>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="partners-grid" id="partners-grid"></div>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=10"></script>
  <script>
    document.getElementById('partners-grid').innerHTML = DATA.partners.map(renderPartnerBadge).join('');
    renderFooter();
  </script>
</body>
</html>

