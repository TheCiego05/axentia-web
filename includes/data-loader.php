<?php
// Lee data/site-data.json y lo expone como $DATA / $NEXT_ID en PHP,
// y como el mismo <script>const DATA = {...}</script> que antes venía de js/data.js.

if (!defined('DATA_FILE')) {
    require_once __DIR__ . '/../config.php';
}

function load_site_data() {
    $raw = @file_get_contents(DATA_FILE);
    $json = $raw ? json_decode($raw, true) : null;
    if (!is_array($json)) {
        $json = ['services' => [], 'clients' => [], 'blog' => [], 'partners' => [], 'faq' => [],
                  'contacto' => [], 'nosotros' => [], 'nextId' => []];
    }
    return $json;
}

function save_site_data($data) {
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    if ($json === false) return false;
    return file_put_contents(DATA_FILE, $json, LOCK_EX) !== false;
}

$SITE_DATA = load_site_data();
$DATA = $SITE_DATA;
unset($DATA['nextId']);
$NEXT_ID = isset($SITE_DATA['nextId']) ? $SITE_DATA['nextId'] : [];

function render_data_script($data, $nextId) {
    echo '<script>const DATA = ' . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . ';';
    echo 'const NEXT_ID = ' . json_encode($nextId, JSON_UNESCAPED_UNICODE) . ';</script>';
}
