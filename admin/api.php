<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/data-loader.php';
header('Content-Type: application/json; charset=utf-8');

function respond($payload) {
    echo json_encode($payload);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) $input = [];
$action = $input['action'] ?? ($_POST['action'] ?? '');

switch ($action) {
    case 'login':
        $user = trim((string)($input['user'] ?? ''));
        $pass = (string)($input['pass'] ?? '');
        if ($user === ADMIN_USER && password_verify($pass, ADMIN_PASS_HASH)) {
            $_SESSION['admin_logged_in'] = true;
            respond(['ok' => true]);
        }
        respond(['ok' => false, 'error' => 'Usuario o contraseña incorrectos']);
        break;

    case 'logout':
        unset($_SESSION['admin_logged_in']);
        respond(['ok' => true]);
        break;

    case 'save':
        if (empty($_SESSION['admin_logged_in'])) {
            http_response_code(401);
            respond(['ok' => false, 'error' => 'No autenticado']);
        }
        $data = $input['data'] ?? null;
        if (!is_array($data)) {
            respond(['ok' => false, 'error' => 'Datos inválidos']);
        }
        foreach (['services', 'clients', 'blog', 'partners', 'faq', 'contacto', 'nosotros'] as $key) {
            if (!array_key_exists($key, $data)) {
                respond(['ok' => false, 'error' => "Falta la sección: $key"]);
            }
        }
        if (save_site_data($data)) {
            respond(['ok' => true]);
        }
        respond(['ok' => false, 'error' => 'No se pudo guardar en el servidor']);
        break;

    default:
        http_response_code(400);
        respond(['ok' => false, 'error' => 'Acción no reconocida']);
}
