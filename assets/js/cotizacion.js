/* CalculAI — Cotizador interactivo (solo cotizacion.html) */

'use strict';

const QUOTE_PRICES = {
  usuario: 1000,
  agente: 2000,
  igualaSetup: 20000,
  igualaPorEmpresa: 1000,
  medico: 2000,
  marketing: 2000,
};

function formatRD(n) {
  return 'RD$ ' + Math.round(n).toLocaleString('es-DO');
}

function initCotizador() {
  const usuarios = document.getElementById('q-usuarios');
  const agente = document.getElementById('q-agente');
  const iguala = document.getElementById('q-iguala');
  const igualaGroup = document.getElementById('q-iguala-group');
  const empresas = document.getElementById('q-empresas');
  const medico = document.getElementById('q-medico');
  const marketing = document.getElementById('q-marketing');
  const tokenRadios = document.querySelectorAll('input[name="q-tokens"]');

  const linesEl = document.getElementById('q-lines');
  const totalMesEl = document.getElementById('q-total-mes');
  const totalOnceRow = document.getElementById('q-total-once-row');
  const totalOnceEl = document.getElementById('q-total-once');

  if (!usuarios || !linesEl) return;

  function selectedTokenPackage() {
    const checked = document.querySelector('input[name="q-tokens"]:checked');
    return checked ? parseInt(checked.value, 10) : 0;
  }

  function recalc() {
    iguala.checked ? igualaGroup.classList.add('show') : igualaGroup.classList.remove('show');

    const lines = [];
    let totalMes = 0;
    let totalOnce = 0;

    const numUsuarios = Math.max(1, parseInt(usuarios.value, 10) || 1);
    const licencia = numUsuarios * QUOTE_PRICES.usuario;
    lines.push([`Licencia base × ${numUsuarios} usuario(s)`, licencia]);
    totalMes += licencia;

    if (agente.checked) {
      lines.push(['Agente de IA (5,000 tokens incluidos)', QUOTE_PRICES.agente]);
      totalMes += QUOTE_PRICES.agente;
    }

    const tokenPkg = selectedTokenPackage();
    if (tokenPkg > 0) {
      lines.push(['Paquete adicional de tokens IA', tokenPkg]);
      totalMes += tokenPkg;
    }

    if (iguala.checked) {
      const numEmpresas = Math.max(1, parseInt(empresas.value, 10) || 1);
      const igualaMensual = numEmpresas * QUOTE_PRICES.igualaPorEmpresa;
      lines.push([`Modo Iguala × ${numEmpresas} empresa(s)`, igualaMensual]);
      totalMes += igualaMensual;
      totalOnce += QUOTE_PRICES.igualaSetup;
    }

    if (medico.checked) {
      lines.push(['Módulo Médico', QUOTE_PRICES.medico]);
      totalMes += QUOTE_PRICES.medico;
    }

    if (marketing.checked) {
      lines.push(['Módulo de Marketing', QUOTE_PRICES.marketing]);
      totalMes += QUOTE_PRICES.marketing;
    }

    linesEl.innerHTML = lines.map(([label, amount]) =>
      `<div class="quote-line"><span>${label}</span><span>${formatRD(amount)}</span></div>`
    ).join('');
    totalMesEl.textContent = formatRD(totalMes);

    if (totalOnce > 0) {
      totalOnceRow.style.display = 'flex';
      totalOnceEl.textContent = formatRD(totalOnce);
    } else {
      totalOnceRow.style.display = 'none';
    }

    return { lines, totalMes, totalOnce };
  }

  [usuarios, empresas].forEach(el => el.addEventListener('input', recalc));
  [agente, iguala, medico, marketing].forEach(el => el.addEventListener('change', recalc));
  tokenRadios.forEach(el => el.addEventListener('change', recalc));

  recalc();

  const printBtn = document.getElementById('q-print-btn');
  if (printBtn) {
    printBtn.addEventListener('click', () => {
      const { lines, totalMes, totalOnce } = recalc();
      document.getElementById('q-print-date').textContent = new Date().toLocaleDateString('es-DO');
      document.getElementById('q-print-lines').innerHTML = lines.map(([label, amount]) =>
        `<div class="quote-line"><span>${label}</span><span>${formatRD(amount)}</span></div>`
      ).join('');
      document.getElementById('q-print-total-mes').textContent = formatRD(totalMes);
      const onceRow = document.getElementById('q-print-total-once-row');
      if (totalOnce > 0) {
        onceRow.style.display = 'flex';
        document.getElementById('q-print-total-once').textContent = formatRD(totalOnce);
      } else {
        onceRow.style.display = 'none';
      }
      window.print();
      if (typeof trackEvent === 'function') trackEvent('cotizacion_pdf_download');
    });
  }
}

document.addEventListener('DOMContentLoaded', initCotizador);
