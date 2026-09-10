<?php require_once __DIR__ . '/../../includes/data-loader.php'; require_once __DIR__ . '/../../includes/analytics.php'; track_pageview('servicios/consultoria-tecnologica.php'); ?>
<?php
  $svcSlug = 'consultoria-tecnologica';
  $svcInfo = null;
  foreach (($DATA['services'] ?? []) as $s) { if ($s['slug'] === $svcSlug) { $svcInfo = $s; break; } }
  $svcTitle = $svcInfo ? $svcInfo['title'] : 'Servicio';
  $svcDesc  = $svcInfo ? $svcInfo['desc']  : 'Conoce este servicio de Axentia SRL.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($svcDesc) ?>">
  <title><?= htmlspecialchars($svcTitle) ?> – Axentia SRL</title>
  <link rel="stylesheet" href="/css/style.css?v=38">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="service-detail-page interactive-site">
  <?php $base = '/'; $navVariant = 'simple'; include __DIR__ . '/../../includes/nav.php'; ?>
<main id="service-detail-shell" data-service-slug="consultoria-tecnologica"></main>
  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="/js/main.js?v=15"></script>
  <script>renderServiceDetailPage('consultoria-tecnologica'); renderFooter();</script>
</body>
</html>
