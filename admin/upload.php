<?php
// Sube un logo/imagen real al servidor (socios, clientes o fabricantes)
// y devuelve la ruta pública para guardarla en data/site-data.json.
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');

function respond($payload) {
    echo json_encode($payload);
    exit;
}

if (empty($_SESSION['admin_logged_in'])) {
    http_response_code(401);
    respond(['ok' => false, 'error' => 'No autenticado']);
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    respond(['ok' => false, 'error' => 'No se recibió un archivo válido']);
}

$file = $_FILES['file'];
$type = ($_POST['type'] ?? 'image') === 'video' ? 'video' : 'image';

$allowedMimes = $type === 'video'
    ? [
        'video/mp4'  => 'mp4',
        'video/webm' => 'webm',
        'video/ogg'  => 'ogv',
      ]
    : [
        'image/png'     => 'png',
        'image/jpeg'    => 'jpg',
        'image/webp'    => 'webp',
        'image/svg+xml' => 'svg',
      ];

$maxBytes = $type === 'video' ? 60 * 1024 * 1024 : 5 * 1024 * 1024;
if ($file['size'] > $maxBytes) {
    $limitMb = $maxBytes / (1024 * 1024);
    respond(['ok' => false, 'error' => "El archivo pesa demasiado. Máximo {$limitMb}MB."]);
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!isset($allowedMimes[$mime])) {
    $formats = $type === 'video' ? 'MP4, WEBM u OGG' : 'PNG, JPG, WEBP o SVG';
    respond(['ok' => false, 'error' => "Formato no permitido. Usa {$formats}."]);
}

$folder = $_POST['folder'] ?? '';
$allowedFolders = ['partners', 'clients', 'fabricantes'];
if (!in_array($folder, $allowedFolders, true)) {
    $folder = 'uploads';
}

$baseDir = $type === 'video' ? 'assets/videos' : 'assets/logos';
$dir = __DIR__ . '/../' . $baseDir . '/' . $folder;
if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
    respond(['ok' => false, 'error' => 'No se pudo preparar la carpeta de destino']);
}

$baseName = pathinfo($file['name'], PATHINFO_FILENAME);
$safeName = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $baseName));
$safeName = trim($safeName, '-');
if ($safeName === '') $safeName = 'logo';

$ext = $allowedMimes[$mime];
$filename = $safeName . '-' . substr(bin2hex(random_bytes(4)), 0, 8) . '.' . $ext;
$dest = $dir . '/' . $filename;

if (!move_uploaded_file($file['tmp_name'], $dest)) {
    respond(['ok' => false, 'error' => 'No se pudo guardar el archivo en el servidor']);
}

respond(['ok' => true, 'path' => $baseDir . '/' . $folder . '/' . $filename]);
