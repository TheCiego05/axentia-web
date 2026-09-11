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
    ? (preg_match('/^(data:|https?:\/\/)/i', $article['mediaUrl']) ? $article['mediaUrl'] : '/' . $article['mediaUrl'])
    : '';

// otros artículos para "seguir leyendo" (excluye el actual, más recientes primero, máx 3)
$otros = array_filter(($DATA['blog'] ?? []), fn($b) => (int) $b['id'] !== $id);
usort($otros, fn($a, $b) => $b['id'] - $a['id']);
$otros = array_slice($otros, 0, 3);

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'axentia.com.do';
$articleUrl = $scheme . '://' . $host . '/pages/blog-articulo.php?id=' . (int) $article['id'];
$shareText = rawurlencode($article['title']);
$shareUrl = rawurlencode($articleUrl);
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
  <meta property="og:url" content="<?= htmlspecialchars($articleUrl) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="stylesheet" href="/css/style.css?v=39">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '/'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>

  <div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="/index.php">Inicio</a> / <a href="/pages/blog.php">Blog</a> / <?= htmlspecialchars($article['title']) ?></div>
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

        <div class="blog-article-share">
          <span class="blog-article-share-label">Compartir:</span>
          <a class="blog-share-btn share-whatsapp" target="_blank" rel="noopener" aria-label="Compartir en WhatsApp"
             href="https://wa.me/?text=<?= $shareText ?>%20<?= $shareUrl ?>">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.66 15L2 22l5.13-1.35A10 10 0 1 0 12 2zm0 18.2a8.17 8.17 0 0 1-4.17-1.14l-.3-.18-3.05.8.82-2.98-.2-.31A8.19 8.19 0 1 1 20.2 12 8.2 8.2 0 0 1 12 20.2zm4.5-6.13c-.25-.12-1.47-.72-1.7-.81s-.4-.12-.56.12-.65.81-.8.97-.3.18-.55.06a6.6 6.6 0 0 1-1.94-1.2 7.3 7.3 0 0 1-1.35-1.68c-.14-.25 0-.38.12-.5s.28-.32.42-.48a.6.6 0 0 0 .1-.6c-.1-.24-.56-1.36-.77-1.86s-.4-.42-.56-.43h-.48a.93.93 0 0 0-.67.32 2.83 2.83 0 0 0-.88 2.1c0 1.24.9 2.44 1.03 2.6s1.76 2.7 4.28 3.68c2.51.98 2.51.65 2.96.61s1.47-.6 1.68-1.18.2-1.08.14-1.18-.22-.16-.47-.28z"/></svg>
          </a>
          <a class="blog-share-btn share-facebook" target="_blank" rel="noopener" aria-label="Compartir en Facebook"
             href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M13.5 21v-7.2h2.4l.4-2.8h-2.8V9.1c0-.8.2-1.4 1.4-1.4h1.5V5.2c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2.1H8v2.8h2.5V21z"/></svg>
          </a>
          <a class="blog-share-btn share-linkedin" target="_blank" rel="noopener" aria-label="Compartir en LinkedIn"
             href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $shareUrl ?>">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M6.94 8.5H3.56V20h3.38zM5.25 3.5a1.94 1.94 0 1 0 0 3.88 1.94 1.94 0 0 0 0-3.88zM20.45 20v-6.4c0-3.06-1.63-4.48-3.81-4.48a3.29 3.29 0 0 0-2.98 1.64h-.04V8.5H10.4c.05 1.02 0 11.5 0 11.5h3.38v-6.42c0-.34.02-.68.13-.92.28-.68.94-1.4 2.05-1.4 1.44 0 2.06 1.1 2.06 2.7V20z"/></svg>
          </a>
          <a class="blog-share-btn share-x" target="_blank" rel="noopener" aria-label="Compartir en X"
             href="https://twitter.com/intent/tweet?text=<?= $shareText ?>&url=<?= $shareUrl ?>">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M18.9 2.4h3l-6.6 7.5 7.7 10.2h-6l-4.7-6.2-5.4 6.2h-3l7.1-8.1L3.5 2.4h6.1l4.2 5.7z"/></svg>
          </a>
          <button type="button" class="blog-share-btn share-copy" aria-label="Copiar enlace" data-url="<?= htmlspecialchars($articleUrl) ?>" onclick="copyArticleLink(this)">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.07 0l1.93-1.93a5 5 0 0 0-7.07-7.07L10.5 5.4"/><path d="M14 11a5 5 0 0 0-7.07 0L5 12.93a5 5 0 0 0 7.07 7.07l1.43-1.43"/></svg>
          </button>
        </div>

        <div class="blog-article-back">
          <a href="/pages/blog.php" class="btn-secondary">← Volver al blog</a>
        </div>
      </article>

      <?php if ($otros): ?>
        <div class="blog-article-related">
          <h3>Sigue leyendo</h3>
          <div class="blog-grid">
            <?php foreach ($otros as $o): ?>
              <?php
                $oHasImage = !empty($o['mediaUrl']) && (preg_match('/^data:image\//i', $o['mediaUrl']) || preg_match('/\.(png|jpe?g|webp|gif)(\?.*)?$/i', $o['mediaUrl']));
                $oCover = $oHasImage ? (preg_match('/^(data:|https?:\/\/)/i', $o['mediaUrl']) ? $o['mediaUrl'] : '/' . $o['mediaUrl']) : '';
              ?>
              <a class="blog-card blog-type-<?= htmlspecialchars($o['type'] ?? 'noticia') ?>" href="/pages/blog-articulo.php?id=<?= (int) $o['id'] ?>">
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
  <script src="/js/main.js?v=15"></script>
  <script>
    renderFooter();
    function copyArticleLink(btn) {
      const url = btn.getAttribute('data-url');
      const done = () => {
        const original = btn.innerHTML;
        btn.innerHTML = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>';
        setTimeout(() => { btn.innerHTML = original; }, 1500);
      };
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(done).catch(() => {});
      } else {
        const ta = document.createElement('textarea');
        ta.value = url;
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); done(); } catch (e) {}
        document.body.removeChild(ta);
      }
    }
  </script>
</body>
</html>
