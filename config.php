<?php
// Configuración del sitio: credenciales del admin y datos de envío de correo.
// Para cambiar la contraseña del admin, genera un hash nuevo con:
//   php -r "echo password_hash('tu-clave-nueva', PASSWORD_DEFAULT);"
// y pega el resultado en ADMIN_PASS_HASH (nunca guardes la contraseña en texto plano).

define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', '$2y$12$stloiNG22lLVoy3nHT.BqOWL5KCuUUoRJsYdzI8G7gTcHagzhZfNe');

define('CONTACT_TO_EMAIL', 'contacto@axentia.com.do');
define('CONTACT_FROM_EMAIL', 'noreply@axentia.com.do');

define('DATA_FILE', __DIR__ . '/data/site-data.json');

if (session_status() === PHP_SESSION_NONE) {
    session_name('axentia_admin');
    session_start();
}
