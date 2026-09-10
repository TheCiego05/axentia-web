<?php require_once __DIR__ . '/../includes/data-loader.php'; require_once __DIR__ . '/../includes/analytics.php'; track_pageview('blog.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog – Axentia SRL</title>
  <meta name="description" content="Noticias de ciberseguridad, vulnerabilidades, ransomware e inteligencia artificial aplicada a la seguridad de la informacion, explicadas por el equipo de Axentia SRL.">
  <link rel="stylesheet" href="/css/style.css?v=38">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site">
  <?php $base = '/'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="/index.php">Inicio</a> / Blog</div>
      <div class="section-label">Noticias & Recursos</div>
      <h1>Blog Axentia</h1>
      <p>Noticias, videos tecnológicos y webinars sobre ciberseguridad, infraestructura y transformación digital.</p>
    </div>
  </div>

  <section class="section-dark">
    <div class="container">
      <div class="blog-resource-strip">
        <article><span>Noticias</span><p>Actualizaciones y análisis para tomar mejores decisiones tecnológicas.</p></article>
        <article><span>Artículos</span><p>Contenido educativo en profundidad sobre tecnología y ciberseguridad.</p></article>
        <article><span>Videos</span><p>Contenido audiovisual para explicar soluciones, fabricantes y buenas prácticas.</p></article>
        <article><span>Webinars</span><p>Sesiones educativas para equipos técnicos, comerciales y directivos.</p></article>
      </div>
      <div class="blog-filter-bar" id="blog-filter-bar">
        <button class="active" data-filter="all">Todas</button>
        <button data-filter="noticia">Noticias</button>
        <button data-filter="articulo">Artículos</button>
        <button data-filter="video">Videos</button>
        <button data-filter="webinar">Webinars</button>
      </div>
      <div class="blog-grid" id="blog-grid"></div>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="/js/main.js?v=15"></script>
  <script>
    document.getElementById('blog-grid').innerHTML = [...DATA.blog].sort((a, b) => b.id - a.id).map(renderBlogCard).join('');
    initBlogFilter();
    renderFooter();
  </script>
</body>
</html>

