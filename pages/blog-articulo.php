<?php
require_once __DIR__ . '/../includes/data-loader.php';
require_once __DIR__ . '/../includes/analytics.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$article = null;
foreach (($DATA['blog'] ?? []) as $b) {
    if ((int) $b['id'] === $id) { $article = $b; break; }
}

if (!$article) {
    header('Location: blog.php');
    exit;
}

track_pageview('blog-articulo.php', $article['id']);

$typeLabels = ['noticia' => 'Noticia', 'articulo' => 'Artículo', 'video' => 'Video', 'webinar' => 'Webinar'];
$typeLabel = $typeLabels[$article['type'] ?? 'noticia'] ?? 'Noticia';
$hasImage = !empty($article['mediaUrl']) && (preg_match('/^data:image\//i', $article['mediaUrl']) || preg_match('/\.(png|jpe?g|webp|gif)(\?.*)?$/i', $article['mediaUrl']));
$coverSrc = $hasImage
    ? (preg_match('/^(data:|https?:\/\/)/i', $article['mediaUrl']) ? $article['mediaUrl'] : '../' . $article['mediaUrl'])
    : '';

// otros artículos para "seguir leyendo" (excluye el actual, más recientes primero, máx 3)
$otros = array_filter(($DATA['blog'] ?? []), fn($b) => (int) $b['id'] !== $id);
usort($otros, fn($a, $b) => $b['id'] - $a['id']);
$otros = array_slice($otros, 0, 3);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($article['title']) ?> – Axentia SRL</title>
  <meta name="description" content="<?= htmlspecialchars($article['desc']) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($article['title']) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($article['desc']) ?>">
  <?php if ($coverSrc): ?><meta property="og:image" content="<?= htmlspecialchars($coverSrc) ?>"><?php endif; ?>
  <link rel="stylesheet" href="../css/style.css?v=38">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '../'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>

  <div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="../index.php">Inicio</a> / <a href="blog.php">Blog</a> / <?= htmlspecialchars($article['title']) ?></div>
    </div>
  </div>

  <section class="section-dark">
    <div class="container blog-article-page">
      <article class="blog-article-full">
        <span class="blog-tag"><?= htmlspecialchars($article['tag']) ?></span>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <div class="blog-meta"><?= htmlspecialchars($article['date']) ?><?= !empty($article['eventDate']) ? ' · ' . htmlspecialchars($article['eventDate']) : '' ?> · <?= htmlspecialchars($typeLabel) ?></div>

        <?php if ($coverSrc): ?>
          <div class="blog-article-cover">
            <img src="<?= htmlspecialchars($coverSrc) ?>" alt="<?= htmlspecialchars($article['title']) ?>" loading="lazy">
          </div>
        <?php endif; ?>

        <?php if (!empty($article['eventDate'])): ?>
          <div class="blog-event-note"><strong>Fecha del webinar:</strong> <?= htmlspecialchars($article['eventDate']) ?></div>
        <?php endif; ?>

        <div class="blog-article-content">
          <?php foreach (preg_split('/\n{2,}/', trim($article['content'] ?? $article['desc'])) as $p): ?>
            <p><?= nl2br(htmlspecialchars(trim($p))) ?></p>
          <?php endforeach; ?>
        </div>

        <div class="blog-article-back">
          <a href="blog.php" class="btn-secondary">← Volver al blog</a>
        </div>
      </article>

      <?php if ($otros): ?>
        <div class="blog-article-related">
          <h3>Sigue leyendo</h3>
          <div class="blog-grid">
            <?php foreach ($otros as $o): ?>
              <?php
                $oHasImage = !empty($o['mediaUrl']) && (preg_match('/^data:image\//i', $o['mediaUrl']) || preg_match('/\.(png|jpe?g|webp|gif)(\?.*)?$/i', $o['mediaUrl']));
                $oCover = $oHasImage ? (preg_match('/^(data:|https?:\/\/)/i', $o['mediaUrl']) ? $o['mediaUrl'] : '../' . $o['mediaUrl']) : '';
              ?>
              <a class="blog-card blog-type-<?= htmlspecialchars($o['type'] ?? 'noticia') ?>" href="blog-articulo.php?id=<?= (int) $o['id'] ?>">
                <div class="blog-img">
                  <span class="blog-type-badge"><?= htmlspecialchars($typeLabels[$o['type'] ?? 'noticia'] ?? 'Noticia') ?></span>
                  <?php if ($oCover): ?>
                    <img class="blog-cover-img" src="<?= htmlspecialchars($oCover) ?>" alt="<?= htmlspecialchars($o['title']) ?>" loading="lazy">
                  <?php else: ?>
                    <span class="blog-media-mark" aria-hidden="true"></span>
                  <?php endif; ?>
                </div>
                <div class="blog-body">
                  <span class="blog-tag"><?= htmlspecialchars($o['tag']) ?></span>
                  <h3><?= htmlspecialchars($o['title']) ?></h3>
                  <p><?= htmlspecialchars($o['desc']) ?></p>
                  <div class="blog-meta"><?= htmlspecialchars($o['date']) ?></div>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="../js/main.js?v=14"></script>
  <script>
    renderFooter();
  </script>
</body>
</html>
