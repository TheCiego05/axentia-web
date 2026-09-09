// ═══════════════════════════════════════════
//  AXENTIA SRL — Admin Panel JS
//  admin/admin.js
// ═══════════════════════════════════════════

// ── Auth (verificada en el servidor, admin/api.php) ──
function doLogin() {
  const u = document.getElementById('login-user').value.trim();
  const p = document.getElementById('login-pass').value;
  const err = document.getElementById('login-error');

  fetch('api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'login', user: u, pass: p }),
  })
    .then(r => r.json())
    .then(res => {
      if (res.ok) {
        err.style.display = 'none';
        document.getElementById('login-screen').style.display = 'none';
        document.getElementById('dashboard').style.display = 'flex';
        initAdmin();
      } else {
        err.textContent = res.error || 'Usuario o contraseña incorrectos';
        err.style.display = 'block';
        document.getElementById('login-pass').value = '';
        document.getElementById('login-pass').focus();
      }
    })
    .catch(() => {
      err.textContent = 'No se pudo conectar con el servidor';
      err.style.display = 'block';
    });
}

function logout() {
  fetch('api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'logout' }),
  }).catch(() => {});
  document.getElementById('dashboard').style.display = 'none';
  document.getElementById('login-screen').style.display = 'flex';
  document.getElementById('login-user').value = '';
  document.getElementById('login-pass').value = '';
}

if (typeof ADMIN_LOGGED_IN !== 'undefined' && ADMIN_LOGGED_IN) {
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('login-screen').style.display = 'none';
    document.getElementById('dashboard').style.display = 'flex';
    initAdmin();
  });
}

// ── Panel navigation ──────────────────────
function showPanel(id, el) {
  document.querySelectorAll('.admin-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.admin-nav a').forEach(a => a.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  if (el) el.classList.add('active');
  if (event) event.preventDefault();
}

// ── Init ──────────────────────────────────
function initAdmin() {
  renderAllLists();
  updateStats();
  populateHeroForm();
  populateNosotrosForm();
  populateContactoForm();
}

// ── Persistencia en el servidor (admin/api.php -> data/site-data.json) ──
function saveToStorage() {
  fetch('api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'save', data: Object.assign({}, DATA, { nextId: NEXT_ID }) }),
  })
    .then(r => r.json())
    .then(res => { if (!res.ok) showToast('⚠ No se pudo guardar en el servidor: ' + (res.error || '')); })
    .catch(() => showToast('⚠ No se pudo conectar con el servidor'));
}

// ── Stats ─────────────────────────────────
function updateStats() {
  document.getElementById('ds-srv').textContent = DATA.services.length;
  document.getElementById('ds-cli').textContent = DATA.clients.length;
  document.getElementById('ds-blg').textContent = DATA.blog.length;
  document.getElementById('ds-soc').textContent = DATA.partners.length;
}

// ── Render admin lists ────────────────────
function renderAllLists() {
  renderAdminList('list-services',     DATA.services,     serviceAdminRow);
  renderAdminList('list-clients',      DATA.clients,      clientAdminRow);
  renderAdminList('list-blog',         DATA.blog,         blogAdminRow);
  renderAdminList('list-partners',     DATA.partners,     partnerAdminRow);
  renderAdminList('list-faq',          DATA.faq,          faqAdminRow);
  renderAdminList('list-fabricantes',  DATA.fabricantesInfo || [], fabricanteInfoAdminRow);
  renderAdminList('list-testimonials', DATA.testimonials || [],   testimonialAdminRow);
  renderAdminList('list-resources',    DATA.resources || [],      resourceAdminRow);
}

function renderAdminList(containerId, arr, rowFn) {
  const el = document.getElementById(containerId);
  if (!el) return;
  el.innerHTML = arr.length ? arr.map(rowFn).join('') : '<p style="color:var(--white-40);font-size:.85rem;padding:12px 0">Sin elementos. Agrega uno nuevo.</p>';
}

// ── Row renderers ─────────────────────────
function serviceAdminRow(s) {
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${s.icon} ${s.title}</h4>
      <p>${s.desc}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('service',${s.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('services',${s.id})">Eliminar</button>
    </div>
  </div>`;
}

function clientAdminRow(c) {
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${c.initials} — ${c.name}</h4>
      <p>${c.sector}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('client',${c.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('clients',${c.id})">Eliminar</button>
    </div>
  </div>`;
}

function blogAdminRow(b) {
  const hasContent = b.content ? ' · contenido completo' : ' · solo resumen';
  const type = b.type || 'noticia';
  const media = b.mediaUrl ? ' · recurso enlazado' : '';
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${type.toUpperCase()} · ${b.title}</h4>
      <p>${b.tag} · ${b.date}${b.eventDate ? ' · ' + b.eventDate : ''}${hasContent}${media}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('blog',${b.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('blog',${b.id})">Eliminar</button>
    </div>
  </div>`;
}

function partnerAdminRow(p) {
  return `<div class="list-item">
    <div class="list-item-info"><h4>${p.name}</h4></div>
    <div class="list-item-actions">
      <button class="btn-danger" onclick="deleteItem('partners',${p.id})">Eliminar</button>
    </div>
  </div>`;
}

function faqAdminRow(f) {
  const preview = f.a.length > 80 ? f.a.substring(0,80) + '…' : f.a;
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${f.q}</h4>
      <p>${preview}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('faq',${f.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('faq',${f.id})">Eliminar</button>
    </div>
  </div>`;
}

function fabricanteInfoAdminRow(f) {
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${f.destacado ? '⭐ ' : ''}${f.name}</h4>
      <p>/${f.slug} · ${f.brochureUrl ? 'brochure ✓' : 'sin brochure'} · ${f.videoUrl ? 'video ✓' : 'sin video'}${f.destacado ? ' · destacado' : ''}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('fabricante',${f.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('fabricantesInfo',${f.id})">Eliminar</button>
    </div>
  </div>`;
}

function testimonialAdminRow(t) {
  const preview = t.quote.length > 70 ? t.quote.substring(0, 70) + '…' : t.quote;
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${t.author}</h4>
      <p>${preview}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('testimonial',${t.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('testimonials',${t.id})">Eliminar</button>
    </div>
  </div>`;
}

function resourceAdminRow(r) {
  return `<div class="list-item">
    <div class="list-item-info">
      <h4>${r.title}</h4>
      <p>${r.type} · ${r.fileUrl}</p>
    </div>
    <div class="list-item-actions">
      <button class="btn-edit" onclick="openModal('resource',${r.id})">Editar</button>
      <button class="btn-danger" onclick="deleteItem('resources',${r.id})">Eliminar</button>
    </div>
  </div>`;
}

// ── Delete ────────────────────────────────
function deleteItem(key, id) {
  if (!confirm('¿Eliminar este elemento?')) return;
  DATA[key] = DATA[key].filter(i => i.id !== id);
  saveToStorage();
  renderAllLists();
  updateStats();
  showToast('Elemento eliminado');
}

// ── Modal ─────────────────────────────────
let modalType = null;
let modalEditId = null;
let blogUploadData = '';
let blogUploadName = '';

function openModal(type, id = null) {
  modalType = type;
  modalEditId = id;
  const c = document.getElementById('modal-content');
  let item = null;

  if (id !== null) {
    item = DATA[typeToKey(type)].find(x => x.id === id);
  }

  const title = id ? 'Editar' : 'Nuevo';

  switch (type) {
    case 'service':
      c.innerHTML = `<h3>${title} Servicio</h3>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Icono (opcional, ya no se usa en Ciberseguridad/Servicios rediseñados)</label><input id="m-icon" value="${item ? (item.icon || '') : ''}" placeholder="vacío = usa el ícono de línea por defecto"></div>
          <div class="admin-field"><label>Título</label><input id="m-title" value="${item ? esc(item.title) : ''}"></div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Descripción corta</label>
          <textarea id="m-desc">${item ? esc(item.desc) : ''}</textarea>
        </div>
        <div class="admin-field" style="margin-top:12px">
          <label>Items de la lista (uno por línea)</label>
          <textarea id="m-items" rows="6">${item ? item.items.join('\n') : ''}</textarea>
        </div>
        <div class="admin-field" style="margin-top:12px">
          <label>Fabricantes asociados</label>
          <div class="admin-checkbox-group" id="m-fabricantes-group">
            ${(DATA.fabricantesInfo || []).map(f => `<label class="admin-checkbox"><input type="checkbox" value="${f.slug}" ${item && (item.fabricantes || []).includes(f.slug) ? 'checked' : ''}> ${esc(f.name)}</label>`).join('') || '<p class="admin-help-text">Agrega fabricantes desde la sección "Fabricantes" primero.</p>'}
          </div>
        </div>
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;

    case 'client':
      c.innerHTML = `<h3>${title} Cliente</h3>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Iniciales (máx. 4, se usan si no subes logo)</label><input id="m-init" value="${item ? esc(item.initials) : ''}" maxlength="4"></div>
          <div class="admin-field"><label>Nombre completo</label><input id="m-name" value="${item ? esc(item.name) : ''}"></div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Sector / Industria</label><input id="m-sector" value="${item ? esc(item.sector) : ''}"></div>
        ${logoFieldHtml('m-logo', 'clients', item ? item.logo : '')}
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;

    case 'blog':
      blogUploadData = item ? (item.uploadData || '') : '';
      blogUploadName = item ? (item.uploadName || '') : '';
      c.innerHTML = `<h3>${title} Publicación</h3>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Tipo</label>
            <select id="m-type">
              <option value="noticia" ${!item || (item.type || 'noticia') === 'noticia' ? 'selected' : ''}>Noticia</option>
              <option value="articulo" ${item && item.type === 'articulo' ? 'selected' : ''}>Artículo</option>
              <option value="video" ${item && item.type === 'video' ? 'selected' : ''}>Video tecnológico</option>
              <option value="webinar" ${item && item.type === 'webinar' ? 'selected' : ''}>Webinar</option>
            </select>
          </div>
          <div class="admin-field"><label>Categoría / Tag</label><input id="m-tag" value="${item ? esc(item.tag) : ''}"></div>
          <div class="admin-field"><label>Fecha</label><input id="m-date" placeholder="Ej: Mayo 2025" value="${item ? esc(item.date) : ''}"></div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Título del artículo</label><input id="m-title" value="${item ? esc(item.title) : ''}"></div>
        <div class="admin-field" style="margin-top:12px"><label>Descripción / Resumen</label>
          <textarea id="m-desc">${item ? esc(item.desc) : ''}</textarea>
        </div>
        <div class="admin-form-grid" style="margin-top:12px">
          <div class="admin-field"><label>URL de video o webinar</label><input id="m-media" placeholder="YouTube, MP4 o enlace externo" value="${item ? esc(item.mediaUrl || '') : ''}"></div>
          <div class="admin-field"><label>Fecha del webinar / evento</label><input id="m-event-date" placeholder="Ej: 15 agosto 2026 · 10:00 AM" value="${item ? esc(item.eventDate || '') : ''}"></div>
        </div>
        <div class="admin-field" style="margin-top:12px">
          <label>Subir imagen o video</label>
          <input id="m-upload" type="file" accept="image/*,video/mp4,video/webm,video/ogg" onchange="handleBlogUpload(this)">
          <p class="admin-help-text" id="m-upload-note">${blogUploadName ? 'Archivo cargado: ' + esc(blogUploadName) : 'Puedes seleccionar una imagen de portada o un video corto. Para archivos grandes, es mejor usar un enlace de YouTube.'}</p>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Contenido completo / notas</label>
          <textarea id="m-content" rows="10" placeholder="Escribe el contenido completo. Usa una línea en blanco para separar párrafos.">${item ? esc(item.content || '') : ''}</textarea>
        </div>
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;

    case 'partner':
      c.innerHTML = `<h3>${title} Socio / Partner</h3>
        <div class="admin-field"><label>Nombre del socio</label><input id="m-name" value="${item ? esc(item.name) : ''}" placeholder="Ej: Cisco Partner"></div>
        ${logoFieldHtml('m-logo', 'partners', item ? item.logo : '')}
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;

    case 'faq':
      c.innerHTML = `<h3>${title} Pregunta</h3>
        <div class="admin-field"><label>Pregunta</label><input id="m-q" value="${item ? esc(item.q) : ''}"></div>
        <div class="admin-field" style="margin-top:12px"><label>Respuesta</label>
          <textarea id="m-a" rows="6">${item ? esc(item.a) : ''}</textarea>
        </div>
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;

    case 'fabricante': {
      const caps = (item && item.capacidades && item.capacidades.length === 4)
        ? item.capacidades
        : [
            { titulo: 'Evaluación', texto: '' },
            { titulo: 'Diseño', texto: '' },
            { titulo: 'Implementación', texto: '' },
            { titulo: 'Soporte', texto: '' },
          ];
      c.innerHTML = `<h3>${title} Fabricante</h3>
        <p class="admin-help-text">Esta información arma automáticamente la página pública del fabricante — no necesitas tocar código.</p>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Nombre</label><input id="m-name" value="${item ? esc(item.name) : ''}" placeholder="Ej: Dell"></div>
          <div class="admin-field"><label>Slug (URL, sin espacios)</label><input id="m-slug" value="${item ? esc(item.slug) : ''}" placeholder="ej: dell"></div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Categoría (texto pequeño arriba del título)</label><input id="m-categoria" value="${item ? esc(item.categoria || '') : ''}" placeholder="Ej: Equipos e infraestructura"></div>
        <div class="admin-field" style="margin-top:12px"><label>Descripción</label><textarea id="m-descripcion">${item ? esc(item.descripcion || '') : ''}</textarea></div>
        ${logoFieldHtml('m-logo', 'fabricantes', item ? item.logo : '')}
        <div class="admin-field" style="margin-top:12px">
          <label>Cómo te ayudamos (4 pasos)</label>
          <div class="admin-form-grid" id="m-cap-group">
            ${caps.map((c2, i) => `
              <div class="admin-field">
                <label>Paso ${i + 1} — título</label>
                <input class="m-cap-titulo" value="${esc(c2.titulo)}">
                <label style="margin-top:6px">Paso ${i + 1} — texto</label>
                <textarea class="m-cap-texto" rows="2">${esc(c2.texto)}</textarea>
              </div>`).join('')}
          </div>
        </div>
        <div class="admin-field" style="margin-top:12px">
          <label>Soluciones relacionadas (una por línea)</label>
          <textarea id="m-productos" rows="4">${item && item.productos ? item.productos.join('\n') : ''}</textarea>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Ruta o URL del brochure (PDF)</label><input id="m-brochure" value="${item ? esc(item.brochureUrl || '') : ''}" placeholder="assets/docs/xxx.pdf"></div>
        ${videoFieldHtml('m-video', 'fabricantes', item ? item.videoUrl : '')}
        <div class="admin-field" style="margin-top:12px">
          <label class="admin-checkbox" style="font-weight:600">
            <input type="checkbox" id="m-destacado" ${item && item.destacado ? 'checked' : ''}>
            ⭐ Producto destacado (aparece en la sección "Productos Destacados" del inicio)
          </label>
        </div>
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;
    }

    case 'testimonial':
      c.innerHTML = `<h3>${title} Testimonio</h3>
        <div class="admin-field"><label>Cita</label><textarea id="m-quote" rows="4">${item ? esc(item.quote) : ''}</textarea></div>
        <div class="admin-form-grid" style="margin-top:12px">
          <div class="admin-field"><label>Autor</label><input id="m-author" value="${item ? esc(item.author) : ''}"></div>
          <div class="admin-field"><label>Cargo / empresa</label><input id="m-role" value="${item ? esc(item.role) : ''}"></div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Cliente (debe coincidir exacto con el nombre de un cliente para mostrar su logo)</label><input id="m-client" value="${item ? esc(item.client || '') : ''}"></div>
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;

    case 'resource':
      c.innerHTML = `<h3>${title} Recurso</h3>
        <div class="admin-form-grid">
          <div class="admin-field"><label>Título</label><input id="m-title" value="${item ? esc(item.title) : ''}"></div>
          <div class="admin-field"><label>Tipo</label>
            <select id="m-rtype">
              <option value="brochure" ${!item || item.type === 'brochure' ? 'selected' : ''}>Brochure</option>
              <option value="whitepaper" ${item && item.type === 'whitepaper' ? 'selected' : ''}>Whitepaper</option>
              <option value="caso-estudio" ${item && item.type === 'caso-estudio' ? 'selected' : ''}>Caso de estudio</option>
            </select>
          </div>
        </div>
        <div class="admin-field" style="margin-top:12px"><label>Descripción</label><textarea id="m-desc">${item ? esc(item.desc) : ''}</textarea></div>
        <div class="admin-field" style="margin-top:12px"><label>Ruta o URL del archivo</label><input id="m-file" value="${item ? esc(item.fileUrl) : ''}" placeholder="assets/docs/xxx.pdf"></div>
        <div class="modal-actions">
          <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
          <button class="btn-save" onclick="saveModal()">Guardar</button>
        </div>`;
      break;
  }

  document.getElementById('modal-overlay').classList.add('show');
}

function closeModal() {
  document.getElementById('modal-overlay').classList.remove('show');
  modalType = null;
  modalEditId = null;
}

function saveModal() {
  let obj;
  const key = typeToKey(modalType);
  const editId = modalEditId;

  switch (modalType) {
    case 'service': {
      const title = document.getElementById('m-title').value.trim();
      const original = editId ? DATA.services.find(x => x.id === editId) : null;
      const slug = original ? original.slug : title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
      obj = {
        id: editId || NEXT_ID.services++,
        slug,
        icon:  document.getElementById('m-icon').value.trim(),
        title,
        desc:  document.getElementById('m-desc').value.trim(),
        items: document.getElementById('m-items').value.split('\n').map(s=>s.trim()).filter(Boolean),
        fabricantes: Array.from(document.querySelectorAll('#m-fabricantes-group input:checked')).map(cb => cb.value),
      };
      break;
    }
    case 'client':
      obj = {
        id:       editId || NEXT_ID.clients++,
        initials: document.getElementById('m-init').value.trim(),
        name:     document.getElementById('m-name').value.trim(),
        sector:   document.getElementById('m-sector').value.trim(),
        logo:     document.getElementById('m-logo').value.trim(),
      };
      break;
    case 'blog':
      obj = {
        id:    editId || NEXT_ID.blog++,
        type:  document.getElementById('m-type').value,
        emoji: '',
        tag:   document.getElementById('m-tag').value.trim(),
        title: document.getElementById('m-title').value.trim(),
        desc:  document.getElementById('m-desc').value.trim(),
        content: document.getElementById('m-content').value.trim(),
        mediaUrl: blogUploadData || document.getElementById('m-media').value.trim(),
        uploadData: blogUploadData,
        uploadName: blogUploadName,
        eventDate: document.getElementById('m-event-date').value.trim(),
        date:  document.getElementById('m-date').value.trim(),
      };
      break;
    case 'partner':
      obj = {
        id: editId || NEXT_ID.partners++,
        name: document.getElementById('m-name').value.trim(),
        logo: document.getElementById('m-logo').value.trim(),
      };
      break;
    case 'faq':
      obj = {
        id: editId || NEXT_ID.faq++,
        q:  document.getElementById('m-q').value.trim(),
        a:  document.getElementById('m-a').value.trim(),
      };
      break;
    case 'fabricante': {
      const capTitulos = Array.from(document.querySelectorAll('.m-cap-titulo'));
      const capTextos = Array.from(document.querySelectorAll('.m-cap-texto'));
      const original = editId ? DATA.fabricantesInfo.find(x => x.id === editId) : null;
      obj = {
        id: editId || NEXT_ID.fabricantesInfo++,
        slug: document.getElementById('m-slug').value.trim(),
        name: document.getElementById('m-name').value.trim(),
        categoria: document.getElementById('m-categoria').value.trim(),
        descripcion: document.getElementById('m-descripcion').value.trim(),
        logo: document.getElementById('m-logo').value.trim(),
        capacidades: capTitulos.map((t, i) => ({ titulo: t.value.trim(), texto: capTextos[i].value.trim() })),
        productos: document.getElementById('m-productos').value.split('\n').map(s => s.trim()).filter(Boolean),
        brochureUrl: document.getElementById('m-brochure').value.trim(),
        videoUrl: document.getElementById('m-video').value.trim(),
        destacado: document.getElementById('m-destacado').checked,
        customPage: original ? (original.customPage || '') : '',
      };
      break;
    }
    case 'testimonial':
      obj = {
        id: editId || NEXT_ID.testimonials++,
        quote: document.getElementById('m-quote').value.trim(),
        author: document.getElementById('m-author').value.trim(),
        role: document.getElementById('m-role').value.trim(),
        client: document.getElementById('m-client').value.trim(),
      };
      break;
    case 'resource':
      obj = {
        id: editId || NEXT_ID.resources++,
        title: document.getElementById('m-title').value.trim(),
        type: document.getElementById('m-rtype').value,
        desc: document.getElementById('m-desc').value.trim(),
        fileUrl: document.getElementById('m-file').value.trim(),
      };
      break;
  }

  if (editId) {
    const idx = DATA[key].findIndex(x => x.id === editId);
    if (idx > -1) DATA[key][idx] = obj;
  } else {
    DATA[key].push(obj);
  }

  saveToStorage();
  renderAllLists();
  updateStats();
  closeModal();
  showToast(editId ? '✓ Actualizado correctamente' : '✓ Elemento agregado');
}

// ── Subida real de logos (socios, clientes, fabricantes) ──
function handleLogoUpload(input, folder, hiddenFieldId) {
  const file = input.files && input.files[0];
  const note = document.getElementById(hiddenFieldId + '-note');
  if (!file) return;

  const allowed = ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'];
  if (!allowed.includes(file.type)) {
    if (note) note.textContent = '⚠ Formato no permitido. Usa PNG, JPG, WEBP o SVG.';
    input.value = '';
    return;
  }
  if (file.size > 5 * 1024 * 1024) {
    if (note) note.textContent = '⚠ El archivo pesa demasiado. Máximo 5MB.';
    input.value = '';
    return;
  }

  const formData = new FormData();
  formData.append('file', file);
  formData.append('folder', folder);
  if (note) note.textContent = 'Subiendo...';

  fetch('upload.php', { method: 'POST', body: formData })
    .then(r => r.json())
    .then(res => {
      if (res.ok) {
        document.getElementById(hiddenFieldId).value = res.path;
        if (note) note.textContent = '✓ Logo subido: ' + res.path;
        const preview = document.getElementById(hiddenFieldId + '-preview');
        if (preview) { preview.src = '../' + res.path; preview.style.display = 'block'; }
      } else {
        if (note) note.textContent = '⚠ ' + (res.error || 'No se pudo subir el archivo');
      }
    })
    .catch(() => { if (note) note.textContent = '⚠ No se pudo conectar con el servidor'; });
}

function logoFieldHtml(hiddenFieldId, folder, currentPath) {
  const preview = currentPath
    ? `<img id="${hiddenFieldId}-preview" src="../${esc(currentPath)}" style="max-height:48px;margin-top:8px;border-radius:6px;display:block">`
    : `<img id="${hiddenFieldId}-preview" src="" style="max-height:48px;margin-top:8px;border-radius:6px;display:none">`;
  return `
    <div class="admin-field">
      <label>Logo</label>
      <input type="file" id="${hiddenFieldId}-file" accept="image/png,image/jpeg,image/webp,image/svg+xml"
             onchange="handleLogoUpload(this,'${folder}','${hiddenFieldId}')">
      <input type="hidden" id="${hiddenFieldId}" value="${esc(currentPath || '')}">
      <p class="admin-help-text" id="${hiddenFieldId}-note">${currentPath ? 'Logo actual: ' + esc(currentPath) : 'Selecciona una imagen (PNG, JPG, WEBP o SVG, máx. 5MB).'}</p>
      ${preview}
      <button type="button" class="btn-cancel" style="margin-top:8px" onclick="clearMediaField('${hiddenFieldId}')">Quitar logo</button>
    </div>`;
}

function videoFieldHtml(hiddenFieldId, folder, currentPath) {
  return `
    <div class="admin-field">
      <label>Video (pega un link de YouTube/externo, o sube un archivo real)</label>
      <input id="${hiddenFieldId}" value="${esc(currentPath || '')}" placeholder="https://youtube.com/... o sube un archivo abajo">
      <input type="file" id="${hiddenFieldId}-file" accept="video/mp4,video/webm,video/ogg" style="margin-top:8px"
             onchange="handleVideoUpload(this,'${folder}','${hiddenFieldId}')">
      <p class="admin-help-text" id="${hiddenFieldId}-note">${currentPath ? 'Video actual: ' + esc(currentPath) : 'Sube un video (MP4, WEBM u OGG, máx. 60MB) o pega un enlace arriba.'}</p>
      <button type="button" class="btn-cancel" style="margin-top:8px" onclick="clearMediaField('${hiddenFieldId}')">Quitar video</button>
    </div>`;
}

function clearMediaField(hiddenFieldId) {
  const field = document.getElementById(hiddenFieldId);
  const note = document.getElementById(hiddenFieldId + '-note');
  const preview = document.getElementById(hiddenFieldId + '-preview');
  const fileInput = document.getElementById(hiddenFieldId + '-file');
  if (field) field.value = '';
  if (note) note.textContent = 'Sin archivo.';
  if (preview) { preview.style.display = 'none'; preview.src = ''; }
  if (fileInput) fileInput.value = '';
}

// ── Subida real de video (fabricantes) ──
function handleVideoUpload(input, folder, hiddenFieldId) {
  const file = input.files && input.files[0];
  const note = document.getElementById(hiddenFieldId + '-note');
  if (!file) return;

  const allowed = ['video/mp4', 'video/webm', 'video/ogg'];
  if (!allowed.includes(file.type)) {
    if (note) note.textContent = '⚠ Formato no permitido. Usa MP4, WEBM u OGG.';
    input.value = '';
    return;
  }
  if (file.size > 60 * 1024 * 1024) {
    if (note) note.textContent = '⚠ El video pesa demasiado. Máximo 60MB. Para videos más grandes, súbelo por el File Manager y pega la ruta arriba.';
    input.value = '';
    return;
  }

  const formData = new FormData();
  formData.append('file', file);
  formData.append('folder', folder);
  formData.append('type', 'video');
  if (note) note.textContent = 'Subiendo video...';

  fetch('upload.php', { method: 'POST', body: formData })
    .then(r => r.json())
    .then(res => {
      if (res.ok) {
        document.getElementById(hiddenFieldId).value = res.path;
        if (note) note.textContent = '✓ Video subido: ' + res.path;
      } else {
        if (note) note.textContent = '⚠ ' + (res.error || 'No se pudo subir el video');
      }
    })
    .catch(() => { if (note) note.textContent = '⚠ No se pudo conectar con el servidor'; });
}

function handleBlogUpload(input) {
  const file = input.files && input.files[0];
  const note = document.getElementById('m-upload-note');
  blogUploadData = '';
  blogUploadName = '';
  if (!file) {
    if (note) note.textContent = 'No se seleccionó archivo.';
    return;
  }
  const maxMb = file.type.startsWith('video/') ? 25 : 4;
  if (file.size > maxMb * 1024 * 1024) {
    input.value = '';
    if (note) note.textContent = `El archivo pesa demasiado. Máximo recomendado: ${maxMb} MB. Usa un enlace externo para videos grandes.`;
    return;
  }
  const reader = new FileReader();
  reader.onload = () => {
    blogUploadData = reader.result;
    blogUploadName = file.name;
    if (note) note.textContent = `Archivo listo: ${file.name}`;
  };
  reader.onerror = () => {
    if (note) note.textContent = 'No se pudo leer el archivo.';
  };
  reader.readAsDataURL(file);
}

// ── Hero save ─────────────────────────────
function saveHero() {
  DATA.hero = {
    t1: document.getElementById('h-t1').value,
    t2: document.getElementById('h-t2').value,
    t3: document.getElementById('h-t3').value,
    t4: document.getElementById('h-t4').value,
    desc: document.getElementById('h-desc').value,
    badge: document.getElementById('h-badge').value,
  };
  saveToStorage();
  showToast('✓ Hero guardado');
}

function populateHeroForm() {
  if (!DATA.hero) return;
  document.getElementById('h-t1').value = DATA.hero.t1;
  document.getElementById('h-t2').value = DATA.hero.t2;
  document.getElementById('h-t3').value = DATA.hero.t3;
  document.getElementById('h-t4').value = DATA.hero.t4;
  document.getElementById('h-desc').value = DATA.hero.desc;
  document.getElementById('h-badge').value = DATA.hero.badge;
}

// ── Nosotros save ─────────────────────────
function saveNosotros() {
  DATA.nosotros = {
    descripcion: document.getElementById('a-desc').value,
    mision:      document.getElementById('a-mision').value,
    vision:      document.getElementById('a-vision').value,
  };
  saveToStorage();
  showToast('✓ Nosotros guardado');
}

function populateNosotrosForm() {
  document.getElementById('a-desc').value   = DATA.nosotros.descripcion;
  document.getElementById('a-mision').value = DATA.nosotros.mision;
  document.getElementById('a-vision').value = DATA.nosotros.vision;
}

// ── Contacto save ─────────────────────────
function saveContacto() {
  DATA.contacto = {
    email:     document.getElementById('c-email').value,
    ubicacion: document.getElementById('c-loc').value,
    personas: [
      { nombre: document.getElementById('c-n1').value, telefono: document.getElementById('c-p1').value },
      { nombre: document.getElementById('c-n2').value, telefono: document.getElementById('c-p2').value },
    ]
  };
  saveToStorage();
  showToast('✓ Contacto guardado');
}

function populateContactoForm() {
  document.getElementById('c-email').value = DATA.contacto.email;
  document.getElementById('c-loc').value   = DATA.contacto.ubicacion;
  document.getElementById('c-n1').value    = DATA.contacto.personas[0].nombre;
  document.getElementById('c-p1').value    = DATA.contacto.personas[0].telefono;
  document.getElementById('c-n2').value    = DATA.contacto.personas[1].nombre;
  document.getElementById('c-p2').value    = DATA.contacto.personas[1].telefono;
}

// ── Helpers ───────────────────────────────
function typeToKey(type) {
  return { service:'services', client:'clients', blog:'blog', partner:'partners', faq:'faq',
           fabricante:'fabricantesInfo', testimonial:'testimonials', resource:'resources' }[type];
}
function esc(str) {
  return String(str).replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
