# Axentia Web

Sitio en PHP. Requiere un hosting con soporte PHP (no funciona en GitHub Pages).

## Estructura

- `index.php`: página de inicio
- `css/style.css`: estilos globales con fondo blanco y ambiente tecnológico
- `js/main.js`: render helpers compartidos (usa el objeto `DATA` inyectado por PHP en cada página)
- `pages/`: páginas internas (`pages/fabricantes/`, `pages/servicios/`)
- `admin/`: panel administrativo (login por sesión PHP, `admin/api.php`)
- `includes/nav.php`: navbar compartido, incluido por cada página
- `includes/data-loader.php`: lee/escribe `data/site-data.json` y expone `$DATA` en PHP
- `data/site-data.json`: contenido editable (servicios, clientes, blog, socios, FAQ, contacto, nosotros) — única fuente de verdad, se actualiza desde el admin
- `config.php`: credenciales del admin y datos de envío de correo (edítalo antes de publicar)
- `assets/logos/clients`: logos de clientes
- `assets/logos/partners`: logos de socios tecnológicos

## Admin

Entra en `/admin/` con el usuario/contraseña definidos en `config.php` (por defecto `admin` / `axentia2025` — cámbialo). Los cambios se guardan de inmediato en `data/site-data.json` en el servidor y se ven para todos los visitantes.

## Contacto

El formulario en `pages/contacto.php` envía el mensaje vía `pages/contacto-enviar.php` con `mail()` de PHP al correo definido en `config.php` (`CONTACT_TO_EMAIL`). Si el hosting no tiene `mail()` configurado (SPF/DKIM), revisa con el proveedor.

## Notas

Los logos fueron organizados desde la presentación corporativa de Axentia. Xcitium queda como texto hasta agregar el logo oficial.
