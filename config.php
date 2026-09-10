<?php
// Configuración del sitio: credenciales del admin y datos de envío de correo.
// Para cambiar la contraseña del admin, genera un hash nuevo con:
//   php -r "echo password_hash('tu-clave-nueva', PASSWORD_DEFAULT);"
// y pega el resultado en ADMIN_PASS_HASH (nunca guardes la contraseña en texto plano).

define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', '$2b$12$WnN/D7I79Oe/ZI4v8IuSH.I9mZpM50dXoKEgsuDzV1d/nbld4TqKW');

define('CONTACT_TO_EMAIL', 'contacto@axentia.com.do');
define('CONTACT_FROM_EMAIL', 'noreply@axentia.com.do');

define('DATA_FILE', __DIR__ . '/data/site-data.json');
define('ANALYTICS_FILE', __DIR__ . '/data/analytics.json');

if (session_status() === PHP_SESSION_NONE) {
    session_name('axentia_admin');
    session_start();
}
