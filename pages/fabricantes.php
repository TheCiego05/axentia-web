<?php require_once __DIR__ . '/../includes/data-loader.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fabricantes – Axentia SRL</title>
  <meta name="description" content="Fabricantes y socios tecnológicos certificados de Axentia SRL: Microsoft, Fortinet, Kaspersky, Xcitium, Veeam y más.">
  <link rel="stylesheet" href="../css/style.css?v=38">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / Fabricantes</div>
      <div class="section-label">Soluciones por fabricante</div>
      <h1>Fabricantes y socios tecnológicos</h1>
      <p>Explora las soluciones que Axentia puede implementar, integrar y soportar para tu organización.</p>
    </div>
  </div>

  <section class="section-dark manufacturer-feature-section">
    <div class="container">
      <div class="manufacturer-feature-xcitium">
        <div>
          <div class="section-label">Distribuidor autorizado</div>
          <img src="../assets/logos/partners/xcitium.png" alt="Xcitium" class="manufacturer-feature-logo">
          <h2>Zero Trust Endpoint Security</h2>
          <p>Axentia integra Xcitium para proteger endpoints, nube y operaciones críticas con tecnología ZeroDwell, contención de amenazas desconocidas y capacidades EDR, MDR y XDR.</p>
          <div class="manufacturer-actions">
            <a href="fabricantes/xcitium.php" class="btn-primary">Ver Xcitium</a>
            <a href="contacto.php" class="btn-outline light-outline">Cotizar solución</a>
          </div>
        </div>
        <div class="manufacturer-feature-metrics">
          <article><span>ZeroDwell</span><p>Contención antes de la ejecución maliciosa.</p></article>
          <article><span>EDR / XDR</span><p>Visibilidad y respuesta para endpoints y operaciones.</p></article>
          <article><span>Soporte local</span><p>Acompañamiento de Axentia en evaluación e implementación.</p></article>
        </div>
      </div>
    </div>
  </section>

  <section class="section-dark">
    <div class="container">
      <div class="manufacturer-grid">
        <?php foreach (($DATA['fabricantesInfo'] ?? []) as $f): ?>
        <?php
          $cp = $f['customPage'] ?? '';
          $isExternal = $cp !== '' && (strpos($cp, 'http://') === 0 || strpos($cp, 'https://') === 0);
          $cardHref = $cp !== '' ? ($isExternal ? $cp : 'fabricantes/' . $cp) : 'fabricantes/ver.php?slug=' . urlencode($f['slug']);
        ?>
        <?php $isOwnProduct = stripos($f['categoria'] ?? '', 'producto propio') !== false; ?>
        <a class="manufacturer-card<?= $isOwnProduct ? ' manufacturer-card-own' : '' ?>" href="<?= htmlspecialchars($cardHref) ?>"<?= $isExternal ? ' target="_blank" rel="noopener"' : '' ?>>
          <div class="manufacturer-card-logo">
            <img src="../<?= htmlspecialchars($f['logo']) ?>" alt="<?= htmlspecialchars($f['name']) ?>" loading="lazy">
            <?php if ($isOwnProduct): ?>
            <span class="own-product-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.2 4.6 5 .7-3.6 3.6.8 5.1-4.4-2.4-4.4 2.4.8-5.1L4.8 8.3l5-.7z"/></svg></span>
            <?php endif; ?>
          </div>
          <span<?= $isOwnProduct ? ' class="own-product-badge"' : '' ?>><?= htmlspecialchars($f['categoria'] ?? '') ?></span>
          <h3><?= htmlspecialchars($f['name']) ?></h3>
          <p><?= htmlspecialchars($f['descripcion'] ?? '') ?></p>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=14"></script>
  <script>renderFooter();</script>
</body>
</html>

