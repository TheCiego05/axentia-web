<?php
// Sitemap XML dinamico: se genera a partir de data/site-data.json,
// asi que cada articulo de blog y fabricante nuevo entra automaticamente
// sin tener que editar este archivo. Referenciado desde robots.txt.
require_once __DIR__ . '/includes/data-loader.php';

header('Content-Type: application/xml; charset=utf-8');

$domain = 'https://axentia.com.do';
$today = date('Y-m-d');

// Mapa simple "Mes Año" (español) -> fecha aproximada AAAA-MM-01, para lastmod del blog.
function blog_date_to_iso($fecha) {
    $meses = [
        'enero' => '01', 'febrero' => '02', 'marzo' => '03', 'abril' => '04',
        'mayo' => '05', 'junio' => '06', 'julio' => '07', 'agosto' => '08',
        'septiembre' => '09', 'octubre' => '10', 'noviembre' => '11', 'diciembre' => '12',
    ];
    $partes = explode(' ', trim(strtolower($fecha)));
    if (count($partes) === 2 && isset($meses[$partes[0]]) && ctype_digit($partes[1])) {
        return $partes[1] . '-' . $meses[$partes[0]] . '-01';
    }
    return null;
}

$urls = [];
$urls[] = ['loc' => "$domain/index.php", 'priority' => '1.0', 'lastmod' => $today];
$urls[] = ['loc' => "$domain/pages/blog.php", 'priority' => '0.9', 'lastmod' => $today];
$urls[] = ['loc' => "$domain/pages/servicios.php", 'priority' => '0.8'];
$urls[] = ['loc' => "$domain/pages/fabricantes.php", 'priority' => '0.7'];
$urls[] = ['loc' => "$domain/pages/nosotros.php", 'priority' => '0.5'];
$urls[] = ['loc' => "$domain/pages/contacto.php", 'priority' => '0.6'];
$urls[] = ['loc' => "$domain/pages/recursos.php", 'priority' => '0.5'];
$urls[] = ['loc' => "$domain/pages/socios.php", 'priority' => '0.4'];
$urls[] = ['loc' => "$domain/pages/soporte.php", 'priority' => '0.5'];
$urls[] = ['loc' => "$domain/pages/xcitium.php", 'priority' => '0.6'];

$serviciosSlugs = [
    'ciberseguridad', 'infraestructura-it', 'gestion-de-la-nube', 'redes-cableado',
    'seguridad-fisica', 'sistemas-integrados', 'consultoria-tecnologica',
    'transformacion-digital', 'capacitacion-concienciacion', 'pruebas-software-qa',
];
foreach ($serviciosSlugs as $slug) {
    $urls[] = ['loc' => "$domain/pages/servicios/$slug.php", 'priority' => '0.6'];
}

foreach (($DATA['fabricantesInfo'] ?? []) as $f) {
    if (empty($f['slug'])) continue;
    $urls[] = ['loc' => "$domain/pages/fabricantes/ver.php?slug=" . rawurlencode($f['slug']), 'priority' => '0.5'];
}

foreach (($DATA['blog'] ?? []) as $b) {
    $lastmod = blog_date_to_iso($b['date'] ?? '') ?: $today;
    $urls[] = ['loc' => "$domain/pages/blog-articulo.php?id=" . (int) $b['id'], 'priority' => '0.7', 'lastmod' => $lastmod];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($u['loc']) . "</loc>\n";
    if (!empty($u['lastmod'])) echo "    <lastmod>" . htmlspecialchars($u['lastmod']) . "</lastmod>\n";
    echo "    <priority>" . htmlspecialchars($u['priority']) . "</priority>\n";
    echo "  </url>\n";
}
echo '</urlset>' . "\n";
