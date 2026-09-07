<?php
require_once __DIR__ . '/../../includes/data-loader.php';

$slug = isset($_GET['slug']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['slug'])) : '';
$fabricante = null;
foreach (($DATA['fabricantesInfo'] ?? []) as $f) {
    if ($f['slug'] === $slug) { $fabricante = $f; break; }
}

// Si el fabricante tiene una página propia (ej. Kaspersky), redirige ahí en vez de renderizar la plantilla genérica.
if ($fabricante && !empty($fabricante['customPage'])) {
    header('Location: ' . $fabricante['customPage']);
    exit;
}

// Fabricante no encontrado (fue borrado desde el admin, o el slug no existe): vuelve al listado.
if (!$fabricante) {
    header('Location: ../fabricantes.php');
    exit;
}

$capacidades = $fabricante['capacidades'] ?? [];
$productos = $fabricante['productos'] ?? [];
$tieneRecursos = !empty($fabricante['brochureUrl']) || !empty($fabricante['videoUrl']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($fabricante['name']) ?> – Axentia SRL</title>
  <meta name="description" content="<?= htmlspecialchars($fabricante['descripcion']) ?>">
  <link rel="stylesheet" href="../../css/style.css?v=8">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '../../'; $navVariant = 'full'; include __DIR__ . '/../../includes/nav.php'; ?>
<div class="page-header manufacturer-header">
    <canvas id="ax-particles-text" aria-hidden="true"></canvas>
    <div class="container">
      <div class="breadcrumb"><a href="../../index.php">Inicio</a> / <a href="../fabricantes.php">Fabricantes</a> / <?= htmlspecialchars($fabricante['name']) ?></div>
      <div class="manufacturer-hero-card reveal-on-scroll">
        <div class="manufacturer-logo-frame">
          <img src="../../<?= htmlspecialchars($fabricante['logo']) ?>" alt="<?= htmlspecialchars($fabricante['name']) ?>">
        </div>
        <div>
          <div class="section-label"><?= htmlspecialchars($fabricante['categoria']) ?></div>
          <h1><?= htmlspecialchars($fabricante['name']) ?></h1>
          <p><?= htmlspecialchars($fabricante['descripcion']) ?></p>
          <div class="manufacturer-actions">
            <a href="../contacto.php" class="btn-primary">Solicitar asesoría</a>
            <a href="../fabricantes.php" class="btn-outline">Ver fabricantes</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="manufacturer-detail-grid">
        <div>
          <div class="section-label">Cómo te ayudamos</div>
          <h2 class="section-title">Implementación, soporte y acompañamiento</h2>
          <p class="section-sub">Axentia ayuda a evaluar, cotizar, implementar y operar soluciones <?= htmlspecialchars($fabricante['name']) ?>, alineando tecnología, seguridad y continuidad con las necesidades reales de cada organización.</p>
          <div class="manufacturer-capabilities">
            <?php foreach ($capacidades as $cap): ?>
            <div><h3><?= htmlspecialchars($cap['titulo']) ?></h3><p><?= htmlspecialchars($cap['texto']) ?></p></div>
            <?php endforeach; ?>
          </div>
        </div>
        <aside class="manufacturer-products">
          <h3>Soluciones relacionadas</h3>
          <ul><?php foreach ($productos as $p): ?><li><?= htmlspecialchars($p) ?></li><?php endforeach; ?></ul>
          <a href="../contacto.php" class="btn-primary">Cotizar solución</a>
        </aside>
      </div>
    </div>
  </section>

  <?php if ($tieneRecursos): ?>
  <section class="section-dark manufacturer-resources-section">
    <div class="container">
      <div class="section-label">Recursos</div>
      <h2 class="section-title">Brochure y contenido de <?= htmlspecialchars($fabricante['name']) ?></h2>
      <div id="fabricante-recursos"></div>
    </div>
  </section>
  <?php endif; ?>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../../js/main.js?v=8"></script>
  <script>
    <?php if ($tieneRecursos): ?>
    document.getElementById('fabricante-recursos').innerHTML = renderFabricanteRecursosHtml('<?= htmlspecialchars($fabricante['slug'], ENT_QUOTES) ?>');
    <?php endif; ?>
    initAxParticlesText('ax-particles-text', <?= json_encode($fabricante['name'], JSON_UNESCAPED_UNICODE) ?>, '.manufacturer-hero-card');
    renderFooter();
  </script>
</body>
</html>
