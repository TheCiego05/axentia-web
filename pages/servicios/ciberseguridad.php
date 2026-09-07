<?php require_once __DIR__ . '/../../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Servicio - Axentia SRL</title>
  <link rel="stylesheet" href="../../css/style.css?v=8">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="service-detail-page">
  <?php $base = '../../'; $navVariant = 'simple'; include __DIR__ . '/../../includes/nav.php'; ?>
<main id="service-detail-shell" data-service-slug="ciberseguridad"></main>
  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../../js/main.js?v=8"></script>
  <script>renderServiceDetailPage('ciberseguridad'); renderFooter();</script>
</body>
</html>
