<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/data-loader.php';
$adminLoggedIn = !empty($_SESSION['admin_logged_in']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin – Axentia SRL</title>
  <link rel="stylesheet" href="../css/style.css?v=33">
  <link rel="stylesheet" href="admin.css">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="admin-page">

<!-- LOGIN -->
<div id="login-screen" class="login-screen">
  <div class="login-box">
    <div class="login-logo">A<span>X</span>ENTIA</div>
    <h2>Panel Admin</h2>
    <p>Ingresa tus credenciales para acceder</p>
    <div id="login-error" class="login-error">Usuario o contraseña incorrectos</div>
    <div class="admin-field">
      <label>Usuario</label>
      <input type="text" id="login-user" placeholder="admin" autocomplete="username">
    </div>
    <div class="admin-field" style="margin-top:14px">
      <label>Contraseña</label>
      <input type="password" id="login-pass" placeholder="••••••••" autocomplete="current-password"
             onkeydown="if(event.key==='Enter') doLogin()">
    </div>
    <div style="display:flex;gap:12px;margin-top:24px">
      <button class="btn-save" style="flex:1" onclick="doLogin()">Ingresar</button>
      <a href="../index.php" class="btn-cancel" style="flex:1;text-align:center">Volver al sitio</a>
    </div>
  </div>
</div>

<!-- DASHBOARD -->
<div id="dashboard" class="dashboard" style="display:none">
  <!-- SIDEBAR -->
  <aside class="admin-sidebar">
    <div class="admin-logo">
      A<span>X</span>ENTIA
      <small>Panel Admin</small>
    </div>
    <ul class="admin-nav">
      <li><a href="#" class="active" onclick="showPanel('panel-dash',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="5" rx="1.5"/><rect x="13" y="12" width="8" height="9" rx="1.5"/><rect x="3" y="14" width="8" height="7" rx="1.5"/></svg></span> Dashboard</a></li>
      <li><a href="#" onclick="showPanel('panel-hero',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-7 9 7"/><path d="M5 9.5V20a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1V9.5"/></svg></span> Hero / Inicio</a></li>
      <li><a href="#" onclick="showPanel('panel-servicios',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 13.5a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V19a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H4a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1.1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H10a1.7 1.7 0 0 0 1-1.5V4a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V10a1.7 1.7 0 0 0 1.5 1H20a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg></span> Servicios</a></li>
      <li><a href="#" onclick="showPanel('panel-clientes',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="10" width="7" height="11"/><path d="M10 21V6l7-3v18"/><path d="M17 21V11l4 2v8z"/></svg></span> Clientes</a></li>
      <li><a href="#" onclick="showPanel('panel-blog',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 9h10M7 13h10M7 17h6"/></svg></span> Blog / Medios</a></li>
      <li><a href="#" onclick="showPanel('panel-socios',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3"/><circle cx="16" cy="8" r="3"/><path d="M2 20c0-3 2.5-5 6-5s6 2 6 5M10 20c0-3 2.5-5 6-5s6 2 6 5"/></svg></span> Socios</a></li>
      <li><a href="#" onclick="showPanel('panel-nosotros',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/></svg></span> Nosotros</a></li>
      <li><a href="#" onclick="showPanel('panel-contacto',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h4l2 5-2.5 1.5a11 11 0 0 0 5 5L14 14l5 2v4a2 2 0 0 1-2.2 2A17 17 0 0 1 2 4.2 2 2 0 0 1 4 5z"/></svg></span> Contacto</a></li>
      <li><a href="#" onclick="showPanel('panel-faq',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9.5 9.2a2.5 2.5 0 1 1 3.5 2.3c-.9.5-1.3 1-1.3 1.9"/><circle cx="12" cy="17" r=".6" fill="currentColor" stroke="none"/></svg></span> FAQ</a></li>
      <li><a href="#" onclick="showPanel('panel-fabricantes',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V10l5 3V10l5 3V10l5 3v8H3z"/><path d="M3 21h18"/></svg></span> Fabricantes</a></li>
      <li><a href="#" onclick="showPanel('panel-testimonios',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-8.5 8.4A8.6 8.6 0 0 1 8 18.7L3 20l1.4-4.2A8.4 8.4 0 0 1 12.5 3 8.4 8.4 0 0 1 21 11.5z"/></svg></span> Testimonios</a></li>
      <li><a href="#" onclick="showPanel('panel-recursos',this)"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z"/></svg></span> Recursos</a></li>
    </ul>
    <div style="margin-top:auto;padding:0 20px 24px">
      <a href="../index.php" class="btn-outline" style="width:100%;justify-content:center;font-size:.78rem;padding:10px">
        ← Ver sitio web
      </a>
      <button class="btn-danger" style="width:100%;margin-top:10px;justify-content:center" onclick="logout()">
        ✕ Cerrar sesión
      </button>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="admin-main">

    <!-- DASHBOARD -->
    <div id="panel-dash" class="admin-panel active">
      <div class="admin-header">
        <div><h1>Dashboard</h1><p>Bienvenido al panel de administración de Axentia SRL</p></div>
      </div>
      <div class="dash-stats">
        <div class="dash-stat"><div class="ds-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 13.5a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V19a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H4a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1.1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H10a1.7 1.7 0 0 0 1-1.5V4a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V10a1.7 1.7 0 0 0 1.5 1H20a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg></div><div class="ds-val" id="ds-srv">9</div><div class="ds-label">Servicios</div></div>
        <div class="dash-stat"><div class="ds-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="10" width="7" height="11"/><path d="M10 21V6l7-3v18"/><path d="M17 21V11l4 2v8z"/></svg></div><div class="ds-val" id="ds-cli">7</div><div class="ds-label">Clientes</div></div>
        <div class="dash-stat"><div class="ds-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 9h10M7 13h10M7 17h6"/></svg></div><div class="ds-val" id="ds-blg">3</div><div class="ds-label">Noticias y medios</div></div>
        <div class="dash-stat"><div class="ds-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3"/><circle cx="16" cy="8" r="3"/><path d="M2 20c0-3 2.5-5 6-5s6 2 6 5M10 20c0-3 2.5-5 6-5s6 2 6 5"/></svg></div><div class="ds-val" id="ds-soc">20</div><div class="ds-label">Socios</div></div>
      </div>
      <div class="admin-card">
        <h3>Instrucciones</h3>
        <p style="color:var(--white-70);line-height:1.8;font-size:.9rem">
          Desde este panel puedes gestionar todo el contenido de la página web de Axentia.<br>
          • Los cambios se guardan directamente en el servidor (<code>data/site-data.json</code>) al presionar cada botón "Guardar".<br>
          • Se ven de inmediato para todos los visitantes del sitio, no solo en tu navegador.<br>
          • Usa el menú lateral para navegar entre secciones.<br>
          • Haz clic en "Ver sitio web" para ver los cambios en vivo.
        </p>
      </div>
    </div>

    <!-- HERO -->
    <div id="panel-hero" class="admin-panel">
      <div class="admin-header"><div><h1>Hero / Inicio</h1><p>Edita el texto principal de la página de inicio</p></div></div>
      <div class="admin-card">
        <h3>Textos del Hero</h3>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Título línea 1</label><input type="text" id="h-t1" value="CONECTANDO"></div>
          <div class="admin-field"><label>Título línea 2 (acento azul)</label><input type="text" id="h-t2" value="IDEAS,"></div>
          <div class="admin-field"><label>Título línea 3</label><input type="text" id="h-t3" value="INNOVANDO"></div>
          <div class="admin-field"><label>Título línea 4</label><input type="text" id="h-t4" value="EL FUTURO"></div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Descripción</label>
          <textarea id="h-desc">Soluciones tecnológicas y de ciberseguridad para organizaciones de cualquier tamaño.</textarea>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Badge (texto pequeño)</label>
          <input type="text" id="h-badge" value="Axentia SRL · Tecnología para toda organización">
        </div>
        <div class="admin-actions">
          <button class="btn-save" onclick="saveHero()"><svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8"/><path d="M7 3v5h8"/></svg>Guardar Hero</button>
        </div>
      </div>
    </div>

    <!-- SERVICIOS -->
    <div id="panel-servicios" class="admin-panel">
      <div class="admin-header"><div><h1>Servicios</h1><p>Agrega, edita o elimina servicios</p></div></div>
      <div class="admin-card">
        <h3>Lista de Servicios <button class="btn-add" onclick="openModal('service')">+ Nuevo Servicio</button></h3>
        <div class="items-list" id="list-services"></div>
      </div>
    </div>

    <!-- CLIENTES -->
    <div id="panel-clientes" class="admin-panel">
      <div class="admin-header"><div><h1>Clientes</h1><p>Gestiona los clientes de Axentia</p></div></div>
      <div class="admin-card">
        <h3>Clientes <button class="btn-add" onclick="openModal('client')">+ Nuevo Cliente</button></h3>
        <div class="items-list" id="list-clients"></div>
      </div>
    </div>

    <!-- BLOG -->
    <div id="panel-blog" class="admin-panel">
      <div class="admin-header"><div><h1>Blog / Medios</h1><p>Gestiona noticias, videos tecnológicos y webinars</p></div></div>
      <div class="admin-card">
        <h3>Publicaciones <button class="btn-add" onclick="openModal('blog')">+ Nueva Publicación</button></h3>
        <div class="items-list" id="list-blog"></div>
      </div>
    </div>

    <!-- SOCIOS -->
    <div id="panel-socios" class="admin-panel">
      <div class="admin-header"><div><h1>Socios / Partners</h1><p>Gestiona los socios tecnológicos</p></div></div>
      <div class="admin-card">
        <h3>Socios <button class="btn-add" onclick="openModal('partner')">+ Nuevo Socio</button></h3>
        <div class="items-list" id="list-partners"></div>
      </div>
    </div>

    <!-- NOSOTROS -->
    <div id="panel-nosotros" class="admin-panel">
      <div class="admin-header"><div><h1>Nosotros</h1><p>Edita la información sobre la empresa</p></div></div>
      <div class="admin-card">
        <h3>Información de la Empresa</h3>
        <div class="admin-field"><label>Descripción general</label><textarea id="a-desc" rows="5"></textarea></div>
        <div class="admin-field" style="margin-top:12px"><label>Misión</label><textarea id="a-mision" rows="4"></textarea></div>
        <div class="admin-field" style="margin-top:12px"><label>Visión</label><textarea id="a-vision" rows="4"></textarea></div>
        <div class="admin-actions"><button class="btn-save" onclick="saveNosotros()"><svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8"/><path d="M7 3v5h8"/></svg>Guardar</button></div>
      </div>
    </div>

    <!-- CONTACTO -->
    <div id="panel-contacto" class="admin-panel">
      <div class="admin-header"><div><h1>Contacto</h1><p>Edita la información de contacto</p></div></div>
      <div class="admin-card">
        <h3>Datos de Contacto</h3>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Email</label><input type="email" id="c-email"></div>
          <div class="admin-field"><label>Ubicación</label><input type="text" id="c-loc"></div>
          <div class="admin-field"><label>Contacto 1 — Nombre</label><input type="text" id="c-n1"></div>
          <div class="admin-field"><label>Contacto 1 — Teléfono</label><input type="text" id="c-p1"></div>
          <div class="admin-field"><label>Contacto 2 — Nombre</label><input type="text" id="c-n2"></div>
          <div class="admin-field"><label>Contacto 2 — Teléfono</label><input type="text" id="c-p2"></div>
        </div>
        <div class="admin-actions"><button class="btn-save" onclick="saveContacto()"><svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8"/><path d="M7 3v5h8"/></svg>Guardar</button></div>
      </div>
    </div>

    <!-- FAQ -->
    <div id="panel-faq" class="admin-panel">
      <div class="admin-header"><div><h1>FAQ</h1><p>Preguntas frecuentes sobre Xcitium</p></div></div>
      <div class="admin-card">
        <h3>Preguntas <button class="btn-add" onclick="openModal('faq')">+ Nueva Pregunta</button></h3>
        <div class="items-list" id="list-faq"></div>
      </div>
    </div>

    <!-- FABRICANTES -->
    <div id="panel-fabricantes" class="admin-panel">
      <div class="admin-header"><div><h1>Fabricantes</h1><p>Gestiona los fabricantes destacados, su brochure y video</p></div></div>
      <div class="admin-card">
        <h3>Fabricantes <button class="btn-add" onclick="openModal('fabricante')">+ Nuevo Fabricante</button></h3>
        <div class="items-list" id="list-fabricantes"></div>
      </div>
    </div>

    <!-- TESTIMONIOS -->
    <div id="panel-testimonios" class="admin-panel">
      <div class="admin-header"><div><h1>Testimonios</h1><p>Casos de éxito mostrados en el inicio</p></div></div>
      <div class="admin-card">
        <h3>Testimonios <button class="btn-add" onclick="openModal('testimonial')">+ Nuevo Testimonio</button></h3>
        <div class="items-list" id="list-testimonials"></div>
      </div>
    </div>

    <!-- RECURSOS -->
    <div id="panel-recursos" class="admin-panel">
      <div class="admin-header"><div><h1>Recursos</h1><p>Brochures, whitepapers y casos de estudio descargables</p></div></div>
      <div class="admin-card">
        <h3>Recursos <button class="btn-add" onclick="openModal('resource')">+ Nuevo Recurso</button></h3>
        <div class="items-list" id="list-resources"></div>
      </div>
    </div>

  </main>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modal-overlay" onclick="if(event.target===this)closeModal()">
  <div class="modal" id="modal-content"></div>
</div>

<!-- TOAST -->
<div class="toast" id="global-toast"></div>

<?php render_data_script($DATA, $NEXT_ID); ?>
<script>const ADMIN_LOGGED_IN = <?= $adminLoggedIn ? 'true' : 'false' ?>;</script>
<script src="../js/main.js?v=10"></script>
<script src="admin.js"></script>
</body>
</html>
