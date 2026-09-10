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
$stats = $fabricante['stats'] ?? [];
$plataforma = $fabricante['plataforma'] ?? [];
$planes = $fabricante['planes'] ?? [];
$comparativa = $fabricante['comparativa'] ?? [];
$premios = $fabricante['premios'] ?? [];
$faqs = $fabricante['faqs'] ?? [];
$mpAccent = $fabricante['colorAccent'] ?? '#4F81BD';

function xcIconIsImage($icono) {
    return is_string($icono) && preg_match('/\.(webp|png|svg|jpg|jpeg)$/i', $icono);
}

function renderPlataformaItem($pl) {
    $esImagen = xcIconIsImage($pl['icono'] ?? '');
    if ($esImagen) {
        echo '<article><span class="icon-img" aria-hidden="true"><img src="../../' . htmlspecialchars($pl['icono']) . '" alt="" loading="lazy"></span><h3>' . htmlspecialchars($pl['titulo']) . '</h3><p>' . htmlspecialchars($pl['texto']) . '</p></article>';
    } else {
        echo '<div class="mp-tier-card"><h3>' . htmlspecialchars($pl['titulo']) . '</h3><p>' . htmlspecialchars($pl['texto']) . '</p></div>';
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($fabricante['name']) ?> – Axentia SRL</title>
  <meta name="description" content="<?= htmlspecialchars($fabricante['descripcion']) ?>">
  <link rel="stylesheet" href="../../css/style.css?v=35">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site fabricante-<?= htmlspecialchars($fabricante['slug']) ?>" style="--mp-accent: <?= htmlspecialchars($mpAccent) ?>;">
  <?php $base = '../../'; $navVariant = 'full'; include __DIR__ . '/../../includes/nav.php'; ?>
<header class="mp-hero">
    <canvas id="ax-particles-text" aria-hidden="true"></canvas>
    <div class="container mp-hero-grid">
      <div class="mp-copy">
        <div class="breadcrumb"><a href="../../index.php">Inicio</a> / <a href="../fabricantes.php">Fabricantes</a> / <?= htmlspecialchars($fabricante['name']) ?></div>
        <div class="mp-eyebrow"><?= htmlspecialchars($fabricante['etiquetaRelacion'] ?? 'Distribuidor autorizado') ?> <?= htmlspecialchars($fabricante['name']) ?></div>
        <img src="../../<?= htmlspecialchars($fabricante['logo']) ?>" alt="<?= htmlspecialchars($fabricante['name']) ?>" class="mp-logo">
        <h1><?= htmlspecialchars($fabricante['name']) ?></h1>
        <p><?= htmlspecialchars($fabricante['descripcion']) ?></p>
        <div class="manufacturer-actions">
          <a href="../contacto.php" class="btn-primary mp-primary">Solicitar asesoría</a>
          <a href="../fabricantes.php" class="btn-outline mp-outline">Ver fabricantes</a>
          <?php if (!empty($fabricante['sitioOficial'])): ?>
          <a href="<?= htmlspecialchars($fabricante['sitioOficial']) ?>" class="btn-outline mp-outline" target="_blank" rel="noopener noreferrer">Sitio oficial de <?= htmlspecialchars($fabricante['name']) ?> ↗</a>
          <?php endif; ?>
        </div>
      </div>
      <aside class="mp-status-card">
        <span>Axentia SRL</span>
        <h2>Equipo certificado</h2>
        <p>Especialistas de Axentia preparados para evaluar, dimensionar e implementar soluciones <?= htmlspecialchars($fabricante['name']) ?> en ambientes empresariales, con soporte local en República Dominicana.</p>
      </aside>
    </div>
  </header>

  <section class="mp-section mp-dark-band">
    <div class="container mp-two-col">
      <div>
        <div class="section-label">Cómo te ayudamos</div>
        <h2 class="section-title">Implementación, soporte y acompañamiento</h2>
        <p class="section-sub">Axentia ayuda a evaluar, cotizar, implementar y operar soluciones <?= htmlspecialchars($fabricante['name']) ?>, alineando tecnología, seguridad y continuidad con las necesidades reales de cada organización.</p>
        <a href="../contacto.php" class="btn-primary mp-primary" style="margin-top:10px">Cotizar solución</a>
      </div>
      <div class="mp-textcard-grid two">
        <?php foreach ($capacidades as $cap): ?>
        <div class="mp-textcard"><h3><?= htmlspecialchars($cap['titulo']) ?></h3><p><?= htmlspecialchars($cap['texto']) ?></p></div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php if (!empty($productos)): ?>
    <div class="container" style="margin-top:34px">
      <div class="section-label">Soluciones relacionadas</div>
      <div class="mp-textcard-grid" style="margin-top:14px">
        <?php foreach ($productos as $p): ?>
        <div class="mp-textcard" style="padding:16px 16px 16px 22px"><h3 style="margin:0;font-size:.95rem"><?= htmlspecialchars($p) ?></h3></div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </section>

  <?php if (!empty($stats)): ?>
  <section class="section-blue">
    <div class="container">
      <div class="stats-row">
        <?php foreach ($stats as $st): ?>
        <div class="stat-item"><span class="stat-num"><?= htmlspecialchars($st['num']) ?></span><span class="stat-label"><?= htmlspecialchars($st['label']) ?></span></div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($plataforma)): ?>
  <section class="mp-section">
    <div class="container">
      <div class="section-label">Plataforma</div>
      <h2 class="section-title">Capacidades de <?= htmlspecialchars($fabricante['name']) ?></h2>
      <?php if (!empty($fabricante['plataformaIntro'])): ?>
      <p class="section-sub mp-section-intro"><?= htmlspecialchars($fabricante['plataformaIntro']) ?></p>
      <?php endif; ?>
      <?php $plataformaAgrupada = isset($plataforma[0]['categoria']); ?>
      <?php if ($plataformaAgrupada): ?>
        <?php foreach ($plataforma as $grupo): ?>
        <div class="mp-platform-category">
          <h3 class="mp-platform-category-title"><?= htmlspecialchars($grupo['categoria']) ?></h3>
          <div class="manufacturer-platform-grid mp-textcard-grid">
            <?php foreach (($grupo['items'] ?? []) as $pl): renderPlataformaItem($pl); ?>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
      <div class="manufacturer-platform-grid mp-textcard-grid">
        <?php foreach ($plataforma as $pl): renderPlataformaItem($pl); ?>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($planes)): ?>
  <section class="section-dark">
    <div class="container">
      <div class="section-label">Planes</div>
      <h2 class="section-title">Elige tu plan de <?= htmlspecialchars($fabricante['name']) ?></h2>
      <div class="support-plans">
        <?php foreach ($planes as $pln): ?>
        <div class="support-card<?= !empty($pln['popular']) ? ' popular' : '' ?>">
          <h3><?= htmlspecialchars($pln['nombre']) ?></h3>
          <div class="support-range"><?= htmlspecialchars($pln['tier']) ?></div>
          <p style="color:var(--white-70);font-size:.85rem;margin-bottom:14px"><?= htmlspecialchars($pln['desc']) ?></p>
          <ul><?php foreach (($pln['features'] ?? []) as $feat): ?><li><?= htmlspecialchars($feat) ?></li><?php endforeach; ?></ul>
          <a href="../contacto.php" class="<?= !empty($pln['popular']) ? 'btn-primary' : 'btn-outline' ?>" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($comparativa['filas'])): ?>
  <section class="section-dark">
    <div class="container">
      <div class="section-label">Análisis comparativo</div>
      <h2 class="section-title"><?= htmlspecialchars($fabricante['name']) ?> vs. seguridad tradicional</h2>
      <div style="overflow-x:auto">
        <table class="sla-table manufacturer-compare-table">
          <thead><tr><?php foreach (($comparativa['headers'] ?? []) as $h): ?><th><?= htmlspecialchars($h) ?></th><?php endforeach; ?></tr></thead>
          <tbody>
            <?php foreach ($comparativa['filas'] as $fila): ?>
            <tr>
              <td><strong><?= htmlspecialchars($fila[0]) ?></strong></td>
              <td class="cell-bad"><?= htmlspecialchars($fila[1]) ?></td>
              <td class="cell-good"><?= htmlspecialchars($fila[2]) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($premios)): ?>
  <section class="section-dark">
    <div class="container">
      <div class="section-label" style="justify-content:center">Reconocimientos</div>
      <h2 class="section-title" style="text-align:center">Premios y certificaciones</h2>
      <div class="manufacturer-awards-grid">
        <?php foreach ($premios as $pr): ?>
        <div class="manufacturer-award-card<?= xcIconIsImage($pr['icono'] ?? '') ? '' : ' no-icon' ?>">
          <?php if (xcIconIsImage($pr['icono'] ?? '')): ?>
          <div class="award-icon" aria-hidden="true"><img src="../../<?= htmlspecialchars($pr['icono']) ?>" alt="" loading="lazy"></div>
          <?php endif; ?>
          <h4><?= htmlspecialchars($pr['titulo']) ?></h4>
          <p><?= htmlspecialchars($pr['org']) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($faqs)): ?>
  <section class="section-dark">
    <div class="container">
      <div class="section-label" style="justify-content:center">Preguntas frecuentes</div>
      <h2 class="section-title" style="text-align:center">FAQ — <?= htmlspecialchars($fabricante['name']) ?></h2>
      <div class="faq-list">
        <?php foreach ($faqs as $fq): ?>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)"><?= htmlspecialchars($fq['q']) ?></div>
          <div class="faq-a"><?= htmlspecialchars($fq['a']) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

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
  <script src="../../js/main.js?v=11"></script>
  <script>
    <?php if ($tieneRecursos): ?>
    document.getElementById('fabricante-recursos').innerHTML = renderFabricanteRecursosHtml('<?= htmlspecialchars($fabricante['slug'], ENT_QUOTES) ?>');
    <?php endif; ?>
    initAxParticlesText('ax-particles-text', <?= json_encode($fabricante['name'], JSON_UNESCAPED_UNICODE) ?>, '.mp-hero-grid');
    renderFooter();
  </script>
</body>
</html>
