<?php require_once __DIR__ . '/../includes/data-loader.php'; require_once __DIR__ . '/../includes/analytics.php'; track_pageview('soporte.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Planes de soporte IT gestionado para empresas dominicanas: monitoreo, respuesta y visitas presenciales según el nivel de tu operación.">
  <title>Soporte – Axentia SRL</title>
  <link rel="stylesheet" href="/css/style.css?v=53">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="interactive-site" style="--mp-accent: #2F80D1;">
  <?php $base = '/'; $navVariant = 'full'; include __DIR__ . '/../includes/nav.php'; ?>
<div class="page-header">
    <div class="container">
      <div class="breadcrumb"><a href="/index.php">Inicio</a> / Soporte</div>
      <div class="section-label">Servicios Continuos</div>
      <h1>Soporte Gestionado</h1>
      <p>Planes de soporte IT gestionado diseñados para empresas dominicanas. Monitoreo, respuesta y visitas presenciales incluidas según tu nivel.</p>
    </div>
  </div>

  <section class="mp-section">
    <div class="container">
      <div class="section-label">Qué incluye</div>
      <h2 class="section-title">Todo lo que cubre tu soporte gestionado</h2>
      <p class="section-sub">Más allá de "atender tickets": así protegemos tu operación día a día.</p>
      <div class="mp-textcard-grid">
        <div class="mp-textcard">
          <span class="mp-textcard-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3a9 9 0 0 1 9 9"/><circle cx="12" cy="12" r="2.5"/></svg></span>
          <h3>Monitoreo 24/7</h3>
          <p>Vigilancia continua de servidores, equipos y conectividad para detectar fallas antes de que afecten tu operación.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-textcard-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13a8 8 0 0 1 16 0"/><rect x="3" y="13" width="4" height="6" rx="1.5"/><rect x="17" y="13" width="4" height="6" rx="1.5"/><path d="M19 19v1a2 2 0 0 1-2 2h-4"/></svg></span>
          <h3>Mesa de ayuda y tickets</h3>
          <p>Canal directo para reportar incidencias, con seguimiento y prioridad de atención según el plan contratado.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-textcard-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3z"/><path d="M9.5 12l1.8 1.8L15 10.2"/></svg></span>
          <h3>Gestión de parches y actualizaciones</h3>
          <p>Mantenimiento preventivo de sistemas operativos y software crítico para reducir vulnerabilidades.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-textcard-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 18a4.5 4.5 0 0 1-.5-8.97A5.5 5.5 0 0 1 17.2 8.1 4 4 0 0 1 17 18H7z"/><path d="M12 11v6M9.5 14.5 12 12l2.5 2.5"/></svg></span>
          <h3>Respaldo y continuidad</h3>
          <p>Verificación de que tus copias de seguridad se ejecuten correctamente y estén disponibles ante una eventualidad.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-textcard-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.5 7-12a7 7 0 0 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.4"/></svg></span>
          <h3>Visitas técnicas presenciales</h3>
          <p>Soporte en sitio según tu plan, con atención directa en Santo Domingo y Santiago.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-textcard-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></svg></span>
          <h3>Reportes de operación</h3>
          <p>Visibilidad periódica del estado de tu infraestructura y las incidencias atendidas en el período.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="mp-section">
    <div class="container mp-two-col">
      <div>
        <div class="section-label">Cómo trabajamos</div>
        <h2 class="section-title">De la evaluación a la operación diaria</h2>
        <p class="section-sub">Así arrancamos cuando contratas un plan de soporte gestionado con Axentia.</p>
        <a href="/pages/contacto.php" class="btn-primary" style="margin-top:10px">Solicitar asesoría</a>
      </div>
      <div class="mp-textcard-grid two">
        <div class="mp-textcard">
          <span class="mp-step-num">01</span>
          <h3>Diagnóstico</h3>
          <p>Evaluamos tu infraestructura actual, cantidad de dispositivos y necesidades operativas.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-step-num">02</span>
          <h3>Propuesta</h3>
          <p>Recomendamos el plan que mejor se ajusta a tu operación y presupuesto.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-step-num">03</span>
          <h3>Onboarding</h3>
          <p>Instalamos las herramientas de monitoreo y dejamos documentados tus equipos y accesos.</p>
        </div>
        <div class="mp-textcard">
          <span class="mp-step-num">04</span>
          <h3>Operación continua</h3>
          <p>Damos seguimiento diario con visitas, monitoreo y mesa de ayuda según tu plan.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section-blue">
    <div class="container">
      <div class="stats-row">
        <div class="stat-item"><span class="stat-num">+4 años</span><span class="stat-label">De experiencia en soporte IT gestionado</span></div>
        <div class="stat-item"><span class="stat-num">2 sedes</span><span class="stat-label">Santo Domingo y Santiago, RD</span></div>
        <div class="stat-item"><span class="stat-num">Desde 1h</span><span class="stat-label">Tiempo de respuesta en el plan más alto</span></div>
        <div class="stat-item"><span class="stat-num">4 planes</span><span class="stat-label">Escalables según el tamaño de tu operación</span></div>
      </div>
    </div>
  </section>

  <section class="section-dark">
    <div class="container">
      <div class="support-plans">
        <div class="support-card">
          <h3>Business Support</h3>
          <div class="support-range">1 – 20 dispositivos</div>
          <ul>
            <li>2 visitas/mes</li>
            <li>Soporte remoto</li>
            <li>Gestión de tickets</li>
            <li>Monitoreo operativo</li>
            <li>Soporte preventivo</li>
          </ul>
          <a href="/pages/contacto.php" class="btn-outline" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <div class="support-card popular">
          <h3>Business Plus</h3>
          <div class="support-range">21 – 50 dispositivos</div>
          <ul>
            <li>3–4 visitas/mes</li>
            <li>Soporte prioritario</li>
            <li>Operación diaria TI</li>
            <li>Seguimiento preventivo</li>
            <li>Acompañamiento onsite</li>
          </ul>
          <a href="/pages/contacto.php" class="btn-primary" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <div class="support-card">
          <h3>Corporate Managed</h3>
          <div class="support-range">51 – 120 dispositivos</div>
          <ul>
            <li>4 visitas/mes + prioridad</li>
            <li>Gestión operativa extendida</li>
            <li>Escalamiento prioritario</li>
            <li>Coordinación técnica</li>
            <li>Reportes ejecutivos</li>
          </ul>
          <a href="/pages/contacto.php" class="btn-outline" style="justify-content:center">Solicitar Cotización</a>
        </div>
        <div class="support-card">
          <h3>Enterprise</h3>
          <div class="support-range">121+ dispositivos</div>
          <ul>
            <li>SLA dedicado</li>
            <li>Servicio personalizado</li>
            <li>Según operación y criticidad</li>
            <li>Acuerdo de nivel de servicio</li>
            <li>Gestor de cuenta asignado</li>
          </ul>
          <a href="/pages/contacto.php" class="btn-outline" style="justify-content:center">Solicitar Cotización</a>
        </div>
      </div>

      <div style="margin-top:80px">
        <div class="section-label">SLA</div>
        <h2 class="section-title">Niveles de Servicio</h2>
        <div style="overflow-x:auto">
          <table class="sla-table">
            <thead>
              <tr><th>Plan</th><th>Tiempo de respuesta</th><th>Visitas/mes</th><th>Soporte</th><th>Reportes</th></tr>
            </thead>
            <tbody>
              <tr><td>Business Support</td><td>4 horas hábiles</td><td>2</td><td>Remoto</td><td>Mensual básico</td></tr>
              <tr><td>Business Plus</td><td>2 horas hábiles</td><td>3–4</td><td>Remoto + Onsite</td><td>Mensual detallado</td></tr>
              <tr><td>Corporate Managed</td><td>1 hora hábil</td><td>4+</td><td>Prioritario</td><td>Ejecutivo mensual</td></tr>
              <tr><td>Enterprise</td><td>SLA dedicado</td><td>Según acuerdo</td><td>Dedicado</td><td>Personalizado</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <section class="section-dark">
    <div class="container">
      <div class="section-label">Por qué importa</div>
      <h2 class="section-title">Con soporte gestionado vs. sin él</h2>
      <div style="overflow-x:auto">
        <table class="sla-table manufacturer-compare-table">
          <thead>
            <tr><th>Aspecto</th><th>Sin soporte gestionado</th><th>Con Axentia</th></tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Detección de fallas</strong></td>
              <td class="cell-bad">Reactiva: te enteras cuando ya afecta la operación</td>
              <td class="cell-good">Monitoreo continuo, antes de que escale</td>
            </tr>
            <tr>
              <td><strong>Costo</strong></td>
              <td class="cell-bad">Imprevisible, factura por incidente</td>
              <td class="cell-good">Predecible, cuota mensual fija</td>
            </tr>
            <tr>
              <td><strong>Actualizaciones y parches</strong></td>
              <td class="cell-bad">Dependen de que alguien se acuerde</td>
              <td class="cell-good">Gestión programada y verificada</td>
            </tr>
            <tr>
              <td><strong>Respaldo de datos</strong></td>
              <td class="cell-bad">Sin verificación regular</td>
              <td class="cell-good">Revisado como parte del servicio</td>
            </tr>
            <tr>
              <td><strong>Visitas técnicas</strong></td>
              <td class="cell-bad">Se coordinan caso por caso</td>
              <td class="cell-good">Incluidas según el plan contratado</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="section-dark">
    <div class="container">
      <div class="section-label" style="justify-content:center">Preguntas frecuentes</div>
      <h2 class="section-title" style="text-align:center">FAQ — Soporte Gestionado</h2>
      <div class="faq-list">
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">¿Qué pasa si necesito más visitas de las incluidas en mi plan?</div>
          <div class="faq-a">Puedes solicitar visitas adicionales, que se cotizan aparte, o conversar con tu gestor sobre subir de plan si la necesidad es recurrente.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">¿El soporte cubre emergencias fuera de horario laboral?</div>
          <div class="faq-a">El soporte remoto y el monitoreo están definidos según el plan contratado. Para cobertura extendida o un SLA fuera de horario, el plan Enterprise se ajusta a un acuerdo específico con tu operación.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">¿Qué herramientas usan para el monitoreo?</div>
          <div class="faq-a">Usamos plataformas de monitoreo remoto y gestión (RMM) para supervisar equipos, servidores y conectividad, complementadas con las herramientas de ciberseguridad de nuestros fabricantes aliados.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">¿Puedo cambiar de plan más adelante?</div>
          <div class="faq-a">Sí. El plan se ajusta según cómo crece tu operación o cambia tu cantidad de dispositivos.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">¿El soporte incluye antivirus o backup?</div>
          <div class="faq-a">El soporte gestionado cubre la gestión y el monitoreo operativo. Soluciones de antivirus/EDR y backup se implementan como servicios de ciberseguridad y nube complementarios — <a href="/pages/servicios.php">ver todos los servicios</a>.</div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-band">
    <div class="container" style="text-align:center">
      <h2 class="section-title">¿Por qué Axentia SRL como su aliado operativo?</h2>
      <p class="section-sub" style="margin:0 auto 36px">Más de 4 años de experiencia, presencia en Santo Domingo y Santiago, y alianzas con las principales marcas tecnológicas del mundo.</p>
      <a href="/pages/contacto.php" class="btn-primary">Solicitar Cotización</a>
    </div>
  </section>

  <footer id="footer"></footer><?php render_data_script($DATA, $NEXT_ID); ?>
  <script src="/js/main.js?v=22"></script>
  <script>renderFooter();</script>
</body>
</html>

