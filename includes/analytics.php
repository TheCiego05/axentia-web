<?php
// Analítica propia y ligera del sitio: cuenta vistas por página/artículo,
// de dónde vienen los visitantes (referrer) y qué tipo de dispositivo usan.
// Se guarda en data/analytics.json (NO se sube a git — es estado del servidor,
// no contenido editorial). No usa cookies ni JS: cuenta en el servidor con
// cada carga de página, así que funciona igual con o sin JavaScript.

if (!defined('ANALYTICS_FILE')) {
    define('ANALYTICS_FILE', __DIR__ . '/../data/analytics.json');
}

function analytics_default() {
    return [
        'totalViews' => 0,
        'pages' => [],      // "pages/blog.php" => n
        'articles' => [],   // "5" (id del blog) => n
        'referrers' => [],  // "Directo" | "google.com" | ... => n
        'daily' => [],      // "2026-09-10" => n
        'devices' => [],    // "Escritorio" | "Móvil" | "Tablet" => n
    ];
}

function analytics_is_bot($ua) {
    if (!$ua) return true; // sin user-agent, casi siempre es un bot/script
    return (bool) preg_match('/bot|crawl|spider|slurp|facebookexternalhit|whatsapp|telegrambot|preview|curl|wget|python-requests|axios|monitor|uptime|pingdom/i', $ua);
}

// Registra una vista. $pageKey identifica la página (ej. "pages/blog.php").
// $articleId (opcional) es el id del blog cuando la página es un artículo.
function track_pageview($pageKey, $articleId = null) {
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (analytics_is_bot($ua)) return;

    $fp = @fopen(ANALYTICS_FILE, 'c+');
    if (!$fp) return;
    if (!flock($fp, LOCK_EX)) { fclose($fp); return; }

    $size = filesize(ANALYTICS_FILE);
    $raw = $size > 0 ? fread($fp, $size) : '';
    $stats = $raw ? json_decode($raw, true) : null;
    if (!is_array($stats)) $stats = analytics_default();
    foreach (analytics_default() as $k => $def) {
        if (!isset($stats[$k]) || !is_array($stats[$k]) && !is_int($stats[$k])) $stats[$k] = $def;
    }

    $stats['totalViews'] = ($stats['totalViews'] ?? 0) + 1;
    $stats['pages'][$pageKey] = ($stats['pages'][$pageKey] ?? 0) + 1;

    if ($articleId !== null) {
        $key = (string) $articleId;
        $stats['articles'][$key] = ($stats['articles'][$key] ?? 0) + 1;
    }

    // Referrer: solo nos interesa el dominio de origen (Google, Facebook, LinkedIn, directo, etc.)
    $ref = $_SERVER['HTTP_REFERER'] ?? '';
    $refHost = $ref ? (parse_url($ref, PHP_URL_HOST) ?: '') : '';
    $selfHost = preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST'] ?? '');
    $refHostClean = preg_replace('/^www\./i', '', $refHost);
    $bucket = ($refHostClean === '' || $refHostClean === $selfHost) ? 'Directo / interno' : $refHostClean;
    $stats['referrers'][$bucket] = ($stats['referrers'][$bucket] ?? 0) + 1;

    // Día (zona horaria de Rep. Dominicana), se conserva un historial acotado
    $day = (new DateTime('now', new DateTimeZone('America/Santo_Domingo')))->format('Y-m-d');
    $stats['daily'][$day] = ($stats['daily'][$day] ?? 0) + 1;
    if (count($stats['daily']) > 120) {
        ksort($stats['daily']);
        $stats['daily'] = array_slice($stats['daily'], -120, null, true);
    }

    // Dispositivo, a partir del user-agent (heurística simple, sin librerías externas)
    if (preg_match('/ipad|tablet/i', $ua)) {
        $device = 'Tablet';
    } elseif (preg_match('/mobile|android|iphone/i', $ua)) {
        $device = 'Móvil';
    } else {
        $device = 'Escritorio';
    }
    $stats['devices'][$device] = ($stats['devices'][$device] ?? 0) + 1;

    $json = json_encode($stats, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if ($json !== false) {
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, $json);
        fflush($fp);
    }
    flock($fp, LOCK_UN);
    fclose($fp);
}

// Lee las estadísticas guardadas (usado por el panel de administración).
function get_analytics() {
    $raw = @file_get_contents(ANALYTICS_FILE);
    $stats = $raw ? json_decode($raw, true) : null;
    if (!is_array($stats)) $stats = analytics_default();
    foreach (analytics_default() as $k => $def) {
        if (!isset($stats[$k])) $stats[$k] = $def;
    }
    return $stats;
}
