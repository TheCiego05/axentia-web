<?php
// Navbar compartido.
// Variables esperadas antes del include:
//   $base        string  prefijo relativo a la raíz del sitio ('', '../', '../../')
//   $navVariant  string  'full' (con mega-menú, por defecto) o 'simple' (lista plana, usado en pages/servicios/*)
if (!isset($base)) $base = '';
if (!isset($navVariant)) $navVariant = 'full';
$logo = $navVariant === 'simple' ? 'AXENTIA' : 'A<span>X</span>ENTIA';
?>
  <nav id="navbar">
    <a href="<?= $base ?>index.php" class="nav-logo"><?= $logo ?></a>
    <button class="nav-toggle" onclick="toggleMenu()" aria-label="Menu">☰</button>
    <div class="nav-right">
      <ul class="nav-links" id="nav-links">
        <li><a href="<?= $base ?>pages/nosotros.php">Nosotros</a></li>
<?php if ($navVariant === 'simple'): ?>
        <li><a href="<?= $base ?>pages/servicios.php" class="active">Servicios</a></li>
        <li><a href="<?= $base ?>pages/fabricantes.php">Fabricantes</a></li>
<?php else: ?>
        <li class="nav-item-dropdown">
          <a href="<?= $base ?>pages/servicios.php">Servicios</a>
          <div class="mega-menu">
            <div class="mega-col">
              <span class="mega-label">Servicios</span>
              <a href="<?= $base ?>pages/servicios.php">Todos los servicios</a>
              <a href="<?= $base ?>pages/soporte.php">Soporte gestionado</a>
              <a href="<?= $base ?>pages/servicios.php#ciberseguridad">Ciberseguridad</a>
              <a href="<?= $base ?>pages/servicios.php#infraestructura">Infraestructura IT</a>
              <a href="<?= $base ?>pages/servicios.php#nube">Nube y continuidad</a>
            </div>
            <div class="mega-col">
              <span class="mega-label">Fabricantes</span>
              <a href="<?= $base ?>pages/fabricantes.php">Ver todos</a>
              <a href="<?= $base ?>pages/fabricantes/microsoft.php">Microsoft</a>
              <a href="<?= $base ?>pages/fabricantes/fortinet.php">Fortinet</a>
              <a href="<?= $base ?>pages/fabricantes/xcitium.php">Xcitium</a>
              <a href="<?= $base ?>pages/fabricantes/veeam.php">Veeam</a>
            </div>
          </div>
        </li>
<?php endif; ?>
        <li><a href="<?= $base ?>pages/soporte.php">Soporte</a></li>
        <li><a href="<?= $base ?>pages/socios.php">Socios</a></li>
        <li><a href="<?= $base ?>pages/blog.php">Blog</a></li>
        <li><a href="<?= $base ?>pages/recursos.php">Recursos</a></li>
        <li><a href="<?= $base ?>pages/contacto.php" class="nav-cta">Contáctanos</a></li>
      </ul>
      <div class="nav-actions">
        <div class="header-search">
          <input type="text" id="header-search-input" placeholder="Buscar servicios o fabricantes…" autocomplete="off">
          <div id="header-search-results" class="header-search-results"></div>
        </div>
        <button id="theme-toggle" class="theme-toggle" onclick="toggleDarkMode()" aria-label="Cambiar a modo oscuro">🌙</button>
      </div>
    </div>
  </nav>
  <script>
    (function () {
      if (localStorage.getItem('axentia_theme') === 'dark') {
        document.documentElement.classList.add('dark-mode');
      }
      var btn = document.getElementById('theme-toggle');
      function syncBtn() {
        var isDark = document.documentElement.classList.contains('dark-mode');
        btn.textContent = isDark ? '☀️' : '🌙';
        btn.setAttribute('aria-label', isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro');
      }
      window.toggleDarkMode = function () {
        document.documentElement.classList.toggle('dark-mode');
        localStorage.setItem('axentia_theme', document.documentElement.classList.contains('dark-mode') ? 'dark' : 'light');
        syncBtn();
      };
      syncBtn();
    })();
  </script>
