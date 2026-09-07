<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');

function respond($ok, $error = null) {
    echo json_encode($error === null ? ['ok' => $ok] : ['ok' => $ok, 'error' => $error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Método no permitido');
}

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) $input = $_POST;

$name    = trim((string)($input['name'] ?? ''));
$email   = trim((string)($input['email'] ?? ''));
$phone   = trim((string)($input['phone'] ?? ''));
$service = trim((string)($input['service'] ?? ''));
$orgType = trim((string)($input['orgType'] ?? ''));
$message = trim((string)($input['message'] ?? ''));

if ($name === '' || $email === '') {
    respond(false, 'Nombre y correo son obligatorios.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'El correo electrónico no es válido.');
}

$subject = 'Nuevo mensaje de contacto - ' . $name;
$body =
    "Nombre: $name\n" .
    "Correo: $email\n" .
    "Teléfono: $phone\n" .
    "Servicio de interés: $service\n" .
    ($orgType !== '' ? "Tipo de organización: $orgType\n" : '') .
    "\nMensaje:\n$message\n";

$headers = [
    'From: ' . CONTACT_FROM_EMAIL,
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
];

$sent = @mail(CONTACT_TO_EMAIL, $subject, $body, implode("\r\n", $headers));

if (!$sent) {
    respond(false, 'No se pudo enviar el mensaje en este momento.');
}

respond(true);
