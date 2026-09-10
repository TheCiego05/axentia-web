<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Xcitium – Axentia SRL</title>
<meta name="description" content="Xcitium ZeroDwell: tecnologia de contencion que bloquea ransomware y amenazas desconocidas antes de que se ejecuten. Implementado por Axentia SRL en Republica Dominicana.">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&family=Exo+2:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --g1:#C724B1;--g2:#E8630A;--g3:#FF4D6A;
  --violet:#9B59FF;--cyan:#00D4FF;
  --grad:linear-gradient(135deg,#C724B1,#E8630A);
  --grad3:linear-gradient(135deg,#C724B1,#FF4D6A,#E8630A);
  --bg:#090B20;--bg2:#0D1030;
  --card:rgba(255,255,255,0.04);
  --w:rgba(255,255,255,1);
  --w70:rgba(255,255,255,0.70);
  --w55:rgba(255,255,255,0.55);
  --w25:rgba(255,255,255,0.25);
  --w08:rgba(255,255,255,0.08);
  --pb:rgba(199,36,177,0.25);
  --green:#00E676;
}
html{scroll-behavior:smooth}
body{font-family:'Exo 2',sans-serif;background:var(--bg);color:var(--w);overflow-x:hidden}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-thumb{background:var(--g1);border-radius:3px}
a{text-decoration:none;color:inherit}

/* NAV */
nav{position:fixed;top:0;left:0;right:0;z-index:1000;height:68px;display:flex;align-items:center;justify-content:space-between;padding:0 48px;background:rgba(9,11,32,0.96);border-bottom:1px solid rgba(199,36,177,0.25);backdrop-filter:blur(20px)}
.logo{font-family:'Rajdhani',sans-serif;font-size:1.7rem;font-weight:700;letter-spacing:3px}
.logo span{background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.nav-links{display:flex;align-items:center;gap:28px;list-style:none}
.nav-links a{font-size:.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--w55);transition:color .2s}
.nav-links a:hover,.nav-links a.active{color:var(--w)}
.nav-cta{background:var(--grad);padding:9px 20px;border-radius:7px;color:var(--w) !important;font-weight:700 !important}

/* HERO */
.hero{min-height:100vh;display:flex;align-items:center;padding:120px 60px 80px;position:relative;overflow:hidden;background:linear-gradient(160deg,#090B20 0%,#0D1030 50%,#0B0820 100%)}
.bg-grid{position:absolute;inset:0;z-index:0;background-image:linear-gradient(rgba(155,89,255,0.055) 1px,transparent 1px),linear-gradient(90deg,rgba(155,89,255,0.055) 1px,transparent 1px);background-size:50px 50px}
.glow-l{position:absolute;width:700px;height:700px;border-radius:50%;background:radial-gradient(circle,rgba(199,36,177,0.18) 0%,transparent 65%);top:-150px;left:-200px;z-index:0}
.glow-r{position:absolute;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(155,89,255,0.15) 0%,transparent 65%);bottom:-80px;right:-80px;z-index:0}
.hero-content{position:relative;z-index:1;max-width:600px}
.badge{display:inline-flex;align-items:center;gap:10px;background:rgba(199,36,177,0.12);border:1px solid rgba(199,36,177,0.40);border-radius:100px;padding:8px 20px;font-family:'JetBrains Mono',monospace;font-size:.68rem;letter-spacing:2px;color:#E080FF;text-transform:uppercase;margin-bottom:32px}
.bdot{width:7px;height:7px;border-radius:50%;background:var(--g1);box-shadow:0 0 14px var(--g1);animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.75)}}
.hero-title{font-family:'Rajdhani',sans-serif;font-size:clamp(3.2rem,6vw,6rem);font-weight:700;line-height:.93;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px}
.grad-text{background:var(--grad3);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.stroke-text{-webkit-text-stroke:2px rgba(255,255,255,0.6);color:transparent}
.hero-sub{font-size:1.05rem;color:var(--w55);line-height:1.75;max-width:520px;margin:26px 0 42px}
.hero-sub strong{color:var(--w70)}
.hero-sub .hi{color:#E080FF;font-weight:700}
.hero-btns{display:flex;gap:16px;flex-wrap:wrap}

.btn-p{background:var(--grad);color:#fff;padding:15px 34px;border-radius:8px;font-family:'Exo 2',sans-serif;font-weight:700;font-size:.9rem;letter-spacing:1px;text-transform:uppercase;border:none;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 24px rgba(199,36,177,.35);transition:all .3s}
.btn-p:hover{transform:translateY(-3px);box-shadow:0 12px 40px rgba(199,36,177,.5);filter:brightness(1.1)}
.btn-o{background:transparent;color:#fff;padding:13px 32px;border-radius:8px;font-family:'Exo 2',sans-serif;font-weight:700;font-size:.9rem;letter-spacing:1px;text-transform:uppercase;border:2px solid rgba(199,36,177,.5);cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all .3s}
.btn-o:hover{border-color:var(--g1);background:rgba(199,36,177,.1);transform:translateY(-3px)}

/* HERO VISUAL */
.hero-visual{position:absolute;right:60px;top:50%;transform:translateY(-50%);z-index:1;width:400px}
.shield-card{background:linear-gradient(145deg,rgba(30,15,60,.9),rgba(15,10,40,.95));border-radius:20px;padding:34px 30px;border:1px solid rgba(199,36,177,.38);box-shadow:0 0 70px rgba(199,36,177,.14),inset 0 0 40px rgba(155,89,255,.06);text-align:center}
.shield-logo{font-family:'Rajdhani',sans-serif;font-size:2.2rem;font-weight:700;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:4px}
.shield-sub{font-size:.8rem;color:var(--w55);margin-bottom:26px;line-height:1.5}
.nodes{display:flex;flex-direction:column;gap:11px}
.node{display:flex;align-items:center;gap:13px;background:rgba(255,255,255,0.04);border-radius:12px;padding:13px 16px;border:1px solid var(--w08);position:relative;overflow:hidden;transition:all .3s}
.node::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:var(--grad)}
.node:hover{background:rgba(199,36,177,.08);border-color:rgba(199,36,177,.3)}
.node-icon{width:40px;height:40px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.2rem;background:rgba(199,36,177,.15);border:1px solid rgba(199,36,177,.3)}
.node h5{font-size:.86rem;font-weight:700;color:var(--w);margin-bottom:2px}
.node p{font-size:.72rem;color:var(--w55)}

/* QUOTE BAND */
.quote-band{padding:40px 60px;text-align:center;background:linear-gradient(90deg,rgba(199,36,177,.08),rgba(232,99,10,.08));border-top:1px solid rgba(199,36,177,.25);border-bottom:1px solid rgba(199,36,177,.25)}
.quote-text{font-family:'Rajdhani',sans-serif;font-size:clamp(1.3rem,2.5vw,2rem);font-weight:700;color:var(--w);line-height:1.3}
.qg{background:var(--grad3);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* SECTIONS */
.sec{padding:90px 60px;background:var(--bg)}
.sec-mid{padding:90px 60px;background:var(--bg2)}
.cont{max-width:1280px;margin:0 auto}
.label{font-family:'JetBrains Mono',monospace;font-size:.7rem;letter-spacing:3px;text-transform:uppercase;margin-bottom:14px;display:flex;align-items:center;gap:10px;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.label::before{content:'';display:inline-block;width:28px;height:2px;background:var(--grad);border-radius:2px;flex-shrink:0}
.ttl{font-family:'Rajdhani',sans-serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:700;color:var(--w);letter-spacing:1px;line-height:1.1;margin-bottom:18px}
.sub{font-size:1rem;color:var(--w55);line-height:1.75;max-width:640px;margin-bottom:52px}
.tc{text-align:center}

/* STATS */
.stats{display:flex;flex-wrap:wrap;border-radius:20px;overflow:hidden;border:1px solid rgba(199,36,177,.2)}
.stat{flex:1;min-width:160px;padding:38px 20px;text-align:center;border-right:1px solid rgba(199,36,177,.15);background:rgba(255,255,255,.025);transition:background .25s}
.stat:last-child{border-right:none}
.stat:hover{background:rgba(199,36,177,.07)}
.stat-n{font-family:'Rajdhani',sans-serif;font-size:2.8rem;font-weight:700;display:block;line-height:1;margin-bottom:8px;background:var(--grad3);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.stat-l{font-size:.8rem;color:var(--w55);line-height:1.4}

/* PHASES */
.phases{display:grid;grid-template-columns:repeat(3,1fr);gap:3px;border-radius:20px;overflow:hidden}
.phase{background:rgba(255,255,255,.03);padding:34px 28px;position:relative;overflow:hidden;transition:background .3s}
.phase::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--grad3)}
.phase:hover{background:rgba(199,36,177,.06)}
.ph-icon{width:58px;height:58px;border-radius:14px;margin-bottom:20px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;background:rgba(199,36,177,.13);border:1px solid rgba(199,36,177,.35);box-shadow:0 0 20px rgba(199,36,177,.15)}
.ph-tag{font-family:'JetBrains Mono',monospace;font-size:.66rem;letter-spacing:3px;text-transform:uppercase;margin-bottom:10px;display:block;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.phase h3{font-weight:700;font-size:1.1rem;color:var(--w);margin-bottom:13px}
.phase p{font-size:.87rem;color:var(--w55);line-height:1.65}
.phase ul{list-style:none;margin-top:13px}
.phase ul li{font-size:.82rem;color:var(--w55);padding:5px 0 5px 18px;position:relative}
.phase ul li::before{content:'›';position:absolute;left:0;font-weight:700;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* ZERO TRUST CLOUD */
.zt-grid{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center}

/* CAPS */
.caps{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:15px}
.cap{background:rgba(255,255,255,.03);border-radius:16px;padding:26px;border:1px solid rgba(199,36,177,.14);transition:all .3s}
.cap:hover{background:rgba(199,36,177,.07);border-color:rgba(199,36,177,.45);transform:translateY(-4px);box-shadow:0 16px 40px rgba(199,36,177,.12)}
.cap-icon{width:52px;height:52px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:1.45rem;margin-bottom:16px;background:linear-gradient(135deg,rgba(199,36,177,.18),rgba(232,99,10,.12));border:1px solid rgba(199,36,177,.35);box-shadow:0 0 16px rgba(199,36,177,.12)}
.cap h4{font-weight:700;font-size:.98rem;color:var(--w);margin-bottom:9px}
.cap p{font-size:.83rem;color:var(--w55);line-height:1.58}

/* PLANS */
.plans{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.plan{background:rgba(255,255,255,.03);border:1px solid rgba(199,36,177,.15);border-radius:20px;padding:36px;position:relative;display:flex;flex-direction:column;transition:all .3s}
.plan:hover{border-color:rgba(199,36,177,.5);transform:translateY(-6px);box-shadow:0 20px 60px rgba(199,36,177,.15)}
.plan.feat{background:linear-gradient(160deg,rgba(199,36,177,.12),rgba(232,99,10,.06),rgba(255,255,255,.03));border:1px solid rgba(199,36,177,.55);box-shadow:0 0 40px rgba(199,36,177,.18)}
.plan-badge{position:absolute;top:-13px;left:50%;transform:translateX(-50%);background:var(--grad);color:#fff;padding:4px 18px;border-radius:20px;font-size:.72rem;font-weight:700;letter-spacing:1px;white-space:nowrap}
.plan-tier{font-family:'JetBrains Mono',monospace;font-size:.67rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.plan-name{font-family:'Rajdhani',sans-serif;font-size:1.75rem;font-weight:700;color:var(--w);margin-bottom:8px}
.plan-desc{font-size:.85rem;color:var(--w55);margin-bottom:26px;line-height:1.55}
.plan-feat{list-style:none;flex:1;margin-bottom:26px}
.plan-feat li{font-size:.87rem;color:var(--w55);padding:9px 0;border-bottom:1px solid rgba(255,255,255,.06);display:flex;gap:10px;align-items:flex-start}
.plan-feat li:last-child{border-bottom:none}
.chk{font-weight:700;flex-shrink:0;margin-top:1px;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* TABLE */
.tbl{width:100%;border-collapse:separate;border-spacing:0;border-radius:16px;overflow:hidden;border:1px solid rgba(199,36,177,.2)}
.tbl th{background:rgba(199,36,177,.12);padding:16px 20px;text-align:left;font-size:.85rem;font-weight:700;color:var(--w);border-bottom:1px solid rgba(199,36,177,.3)}
.tbl td{padding:14px 20px;font-size:.87rem;border-bottom:1px solid rgba(255,255,255,.05);color:var(--w55);background:rgba(255,255,255,.025)}
.tbl tr:last-child td{border-bottom:none}
.tbl tr:nth-child(even) td{background:rgba(255,255,255,.04)}
.bad{color:#FF5252}.good{color:var(--green)}

/* AWARDS */
.awards{display:flex;flex-wrap:wrap;justify-content:center;gap:16px}
.award{background:rgba(255,255,255,.03);border:1px solid rgba(199,36,177,.2);border-radius:14px;padding:22px 26px;text-align:center;transition:all .3s;min-width:155px}
.award:hover{border-color:rgba(199,36,177,.55);background:rgba(199,36,177,.08);transform:translateY(-4px);box-shadow:0 12px 36px rgba(199,36,177,.12)}
.award .ic{font-size:1.9rem;margin-bottom:9px}
.award h5{font-size:.8rem;font-weight:700;color:var(--w);margin-bottom:3px}
.award p{font-size:.7rem;color:var(--w25)}

/* FAQ */
.faqs{max-width:820px;margin:0 auto;display:flex;flex-direction:column;gap:11px}
.faq{background:rgba(255,255,255,.03);border:1px solid rgba(199,36,177,.15);border-radius:14px;overflow:hidden;transition:border-color .25s}
.faq:hover{border-color:rgba(199,36,177,.45)}
.fq{padding:20px 24px;cursor:pointer;font-weight:600;font-size:.95rem;color:var(--w);display:flex;justify-content:space-between;align-items:center;gap:16px}
.fq::after{content:'+';font-size:1.4rem;flex-shrink:0;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.faq.open .fq::after{content:'−'}
.fa{display:none;padding:0 24px 20px;font-size:.87rem;color:var(--w55);line-height:1.75}
.faq.open .fa{display:block}

/* CTA */
.cta{padding:90px 60px;text-align:center;background:linear-gradient(160deg,rgba(199,36,177,.1),rgba(232,99,10,.08),transparent);border-top:1px solid rgba(199,36,177,.25);position:relative;overflow:hidden}
.cta::before{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:900px;height:400px;background:radial-gradient(ellipse,rgba(199,36,177,.12) 0%,transparent 70%);pointer-events:none}
.cta h2{font-family:'Rajdhani',sans-serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:700;color:var(--w);margin-bottom:18px;position:relative}
.cta p{font-size:1rem;color:var(--w55);max-width:560px;margin:0 auto 40px;position:relative;line-height:1.7}

/* FOOTER */
footer{background:#060714;border-top:1px solid var(--w08);padding:40px 60px 24px}
.ft{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:36px;margin-bottom:36px}
.ft-brand p{font-size:.84rem;color:var(--w55);line-height:1.6;margin-top:12px}
.ft-col h5{font-weight:700;font-size:.78rem;letter-spacing:1px;text-transform:uppercase;margin-bottom:14px}
.ft-col ul{list-style:none}
.ft-col ul li{margin-bottom:9px}
.ft-col ul li a{font-size:.84rem;color:var(--w55);transition:color .2s}
.ft-col ul li a:hover{color:var(--w)}
.ft-bot{display:flex;justify-content:space-between;padding-top:22px;border-top:1px solid var(--w08);font-size:.78rem;color:var(--w25)}

@media(max-width:1100px){
  nav{padding:0 24px}
  .hero{padding:120px 30px 80px}
  .hero-visual{display:none}
  .sec,.sec-mid{padding:70px 30px}
  .phases{grid-template-columns:1fr}
  .plans{grid-template-columns:1fr}
  .zt-grid{grid-template-columns:1fr;gap:40px}
  .quote-band,.cta{padding:50px 30px}
  footer{padding:32px 24px 20px}
  .ft{grid-template-columns:1fr 1fr}
}
@media(max-width:700px){
  .nav-links{display:none}
  .stats{flex-direction:column}
  .stat{border-right:none;border-bottom:1px solid rgba(199,36,177,.15)}
  .stat:last-child{border-bottom:none}
  .ft{grid-template-columns:1fr}
}

/* ===== Axentia white technology refresh for Xcitium ===== */

:root {
  --brand-navy: #1F497D;
  --brand-blue: #4F81BD;
  --brand-sky: #2F80D1;
  --ink: #182334;
  --muted: #637083;
  --line: #D9E4F2;
  --soft: #F5F8FC;
  --soft-blue: #EAF3FC;
  --white: #FFFFFF;

  --g1: #1F497D;
  --g2: #4F81BD;
  --g3: #2F80D1;
  --violet: #4F81BD;
  --cyan: #4F81BD;
  --grad: linear-gradient(135deg, #1F497D, #4F81BD);
  --grad3: linear-gradient(135deg, #1F497D, #4F81BD, #7FAFDF);
  --bg: #FFFFFF;
  --bg2: #F5F8FC;
  --card: #FFFFFF;
  --w: #182334;
  --w70: #334155;
  --w55: #637083;
  --w25: #A8B4C4;
  --w08: rgba(31, 73, 125, 0.1);
  --pb: rgba(31, 73, 125, 0.18);
  --green: #178A4C;

  --blue-dark: #FFFFFF;
  --blue-mid: #F5F8FC;
  --blue-primary: #1F497D;
  --blue-bright: #4F81BD;
  --blue-accent: #2F80D1;
  --blue-light: #4F81BD;
  --blue-glow: #9DC6EA;
  --white-70: #637083;
  --white-40: #9AA8BA;
  --white-15: rgba(31, 73, 125, 0.15);
  --white-08: rgba(31, 73, 125, 0.08);
  --white-04: rgba(31, 73, 125, 0.04);
  --border: rgba(31, 73, 125, 0.16);
  --card-bg: #FFFFFF;
}

html,
body {
  background: #FFFFFF !important;
  color: var(--ink) !important;
  font-family: Inter, "Segoe UI", Arial, sans-serif !important;
  letter-spacing: 0 !important;
}

body::before {
  content: "";
  position: fixed;
  inset: 0;
  z-index: -1;
  background:
    linear-gradient(90deg, rgba(31, 73, 125, 0.045) 1px, transparent 1px),
    linear-gradient(rgba(31, 73, 125, 0.035) 1px, transparent 1px),
    radial-gradient(circle at 80% 10%, rgba(79, 129, 189, 0.16), transparent 30%),
    radial-gradient(circle at 8% 42%, rgba(31, 73, 125, 0.08), transparent 24%);
  background-size: 56px 56px, 56px 56px, auto, auto;
}

::-webkit-scrollbar-track { background: var(--soft) !important; }
::-webkit-scrollbar-thumb { background: var(--brand-blue) !important; }

nav,
#navbar {
  background: rgba(255, 255, 255, 0.92) !important;
  border-bottom: 1px solid rgba(31, 73, 125, 0.14) !important;
  box-shadow: 0 10px 30px rgba(31, 73, 125, 0.08) !important;
  backdrop-filter: blur(18px) !important;
}

.logo,
.nav-logo {
  color: var(--brand-navy) !important;
  letter-spacing: 1.6px !important;
}

.logo span,
.nav-logo span {
  color: var(--brand-blue) !important;
  background: none !important;
  -webkit-text-fill-color: currentColor !important;
}

.nav-links a {
  color: #5E6D82 !important;
  letter-spacing: 0.4px !important;
}

.nav-links a:hover,
.nav-links a.active {
  color: var(--brand-navy) !important;
}

.nav-cta,
.nav-links a.nav-cta,
.btn-p,
.btn-primary {
  background: var(--brand-navy) !important;
  color: #FFFFFF !important;
  border: 1px solid var(--brand-navy) !important;
  border-radius: 6px !important;
  box-shadow: 0 10px 22px rgba(31, 73, 125, 0.18) !important;
}

.nav-cta:hover,
.btn-p:hover,
.btn-primary:hover {
  background: var(--brand-blue) !important;
  border-color: var(--brand-blue) !important;
  box-shadow: 0 12px 24px rgba(79, 129, 189, 0.22) !important;
  transform: translateY(-2px) !important;
}

.btn-o,
.btn-outline {
  background: #FFFFFF !important;
  color: var(--brand-navy) !important;
  border: 1px solid rgba(31, 73, 125, 0.28) !important;
  border-radius: 6px !important;
  box-shadow: none !important;
}

.btn-o:hover,
.btn-outline:hover {
  background: var(--soft-blue) !important;
  border-color: var(--brand-blue) !important;
  transform: translateY(-2px) !important;
}

.hero,
#hero,
.page-header {
  background: linear-gradient(135deg, #FFFFFF 0%, #F5F8FC 58%, #EAF3FC 100%) !important;
  color: var(--ink) !important;
}

.hero {
  min-height: auto !important;
  padding-top: 130px !important;
}

.bg-grid,
.hero-bg-grid {
  opacity: 0.75 !important;
  background-image:
    linear-gradient(rgba(31, 73, 125, 0.06) 1px, transparent 1px),
    linear-gradient(90deg, rgba(31, 73, 125, 0.05) 1px, transparent 1px) !important;
}

.glow-l,
.glow-r,
.hero-glow {
  display: none !important;
}

.badge,
.hero-badge {
  background: var(--soft-blue) !important;
  border: 1px solid rgba(31, 73, 125, 0.18) !important;
  border-radius: 6px !important;
  color: var(--brand-navy) !important;
}

.bdot,
.badge-dot {
  background: var(--brand-blue) !important;
  box-shadow: 0 0 0 4px rgba(79, 129, 189, 0.16) !important;
}

.hero-title,
.hero-h1,
.section-title,
.ttl,
.page-header h1 {
  color: var(--ink) !important;
  font-family: "Segoe UI", Inter, Arial, sans-serif !important;
  letter-spacing: 0 !important;
  text-transform: none !important;
}

.grad-text,
.hero-h1 .accent,
.qg {
  background: none !important;
  color: var(--brand-navy) !important;
  -webkit-text-fill-color: currentColor !important;
}

.stroke-text {
  color: var(--ink) !important;
  -webkit-text-stroke: 0 !important;
}

.hero-sub,
.hero-desc,
.sub,
.section-sub,
.page-header p {
  color: var(--muted) !important;
}

.hero-sub .hi,
.hero-sub strong {
  color: var(--brand-navy) !important;
}

.section-dark,
.section-blue,
.section-gradient,
.sec,
.sec-mid {
  background: transparent !important;
}

.quote-band,
.cta,
.cta-band {
  background: linear-gradient(135deg, #EAF3FC, #FFFFFF) !important;
  border-top: 1px solid rgba(31, 73, 125, 0.12) !important;
  border-bottom: 1px solid rgba(31, 73, 125, 0.12) !important;
}

.quote-text {
  color: var(--ink) !important;
}

.label,
.section-label,
.plan-tier,
.ph-tag {
  background: none !important;
  color: var(--brand-navy) !important;
  letter-spacing: 1.2px !important;
  -webkit-text-fill-color: currentColor !important;
}

.label::before,
.section-label::before {
  background: var(--brand-blue) !important;
}

.shield-card,
.hero-card,
.service-card,
.client-card,
.partner-badge,
.stat,
.phase,
.cap,
.plan,
.value-card,
.about-stat,
.contact-form,
.contact-info,
.blog-card,
.faq,
.award {
  background: rgba(255, 255, 255, 0.86) !important;
  border: 1px solid rgba(31, 73, 125, 0.14) !important;
  border-radius: 8px !important;
  box-shadow: 0 16px 40px rgba(31, 73, 125, 0.08) !important;
  color: var(--ink) !important;
  backdrop-filter: blur(10px) !important;
}

.shield-card,
.hero-card:hover,
.service-card:hover,
.cap:hover,
.plan:hover,
.phase:hover {
  background: #FFFFFF !important;
  border-color: rgba(79, 129, 189, 0.42) !important;
  box-shadow: 0 20px 48px rgba(31, 73, 125, 0.12) !important;
}

.shield-logo {
  background: none !important;
  color: var(--brand-navy) !important;
  -webkit-text-fill-color: currentColor !important;
}

.xcitium-logo-img {
  display: block;
  width: min(220px, 80%);
  height: auto;
  margin: 0 auto 10px;
  object-fit: contain;
}

.shield-sub,
.node p,
.cap p,
.phase p,
.phase li,
.plan-desc,
.plan-feat li,
.stat-l,
.service-card p,
.service-card li,
.client-card p,
.faq .fa,
.fa,
.ft p,
.ft a,
footer p,
footer a {
  color: var(--muted) !important;
}

.node,
.contact-item {
  background: #F8FBFE !important;
  border: 1px solid rgba(31, 73, 125, 0.12) !important;
  border-radius: 8px !important;
}

.node::before,
.phase::before {
  background: var(--brand-blue) !important;
}

.node-icon,
.ph-icon,
.cap-icon,
.service-icon,
.contact-item-icon {
  background: var(--soft-blue) !important;
  border: 1px solid rgba(79, 129, 189, 0.22) !important;
  box-shadow: none !important;
  color: var(--brand-navy) !important;
}

.stat-n,
.chk {
  background: none !important;
  color: var(--brand-navy) !important;
  -webkit-text-fill-color: currentColor !important;
}

.stats,
.tbl {
  border: 1px solid rgba(31, 73, 125, 0.14) !important;
}

.tbl th {
  background: var(--soft-blue) !important;
  border-bottom: 1px solid rgba(31, 73, 125, 0.14) !important;
  color: var(--brand-navy) !important;
}

.tbl td {
  background: #FFFFFF !important;
  border-bottom: 1px solid rgba(31, 73, 125, 0.08) !important;
  color: #334155 !important;
}

.good { color: #178A4C !important; }
.bad { color: #B42318 !important; }

.plan.feat,
.plan-card.popular {
  background: linear-gradient(180deg, #FFFFFF, #F0F6FD) !important;
  border-color: rgba(79, 129, 189, 0.45) !important;
}

.plan-badge,
.plan-card.popular::before {
  background: var(--brand-blue) !important;
  border-radius: 6px !important;
  color: #FFFFFF !important;
}

.ft,
#footer,
footer {
  background: var(--soft) !important;
  border-top: 1px solid rgba(31, 73, 125, 0.12) !important;
  color: var(--ink) !important;
}

.ft-bot,
.footer-bottom {
  border-top: 1px solid rgba(31, 73, 125, 0.12) !important;
  color: var(--muted) !important;
}

input,
select,
textarea {
  background: #FFFFFF !important;
  border: 1px solid rgba(31, 73, 125, 0.18) !important;
  border-radius: 6px !important;
  color: var(--ink) !important;
}

input:focus,
select:focus,
textarea:focus {
  border-color: var(--brand-blue) !important;
  box-shadow: 0 0 0 4px rgba(79, 129, 189, 0.14) !important;
  outline: none !important;
}

@media (max-width: 900px) {
  .nav-links {
    background: #FFFFFF !important;
    border: 1px solid rgba(31, 73, 125, 0.14) !important;
    box-shadow: 0 18px 40px rgba(31, 73, 125, 0.12) !important;
  }

  .hero-visual {
    position: relative !important;
    right: auto !important;
    top: auto !important;
    width: 100% !important;
    margin-top: 42px !important;
    transform: none !important;
  }

  .phases,
  .plans,
  .zt-grid {
    grid-template-columns: 1fr !important;
  }
}


/* ===== Client and partner logo sections ===== */

body {
  background: #FFFFFF;
}

.clients-grid,
.partners-grid {
  display: grid;
  gap: 18px;
}

.clients-grid {
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
}

.partners-grid {
  grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
}

.logo-card,
.client-card.logo-card,
.partner-badge.logo-card {
  min-height: 128px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 14px;
  padding: 22px;
  background: rgba(255, 255, 255, 0.92);
  border: 1px solid rgba(31, 73, 125, 0.14);
  border-radius: 8px;
  box-shadow: 0 14px 34px rgba(31, 73, 125, 0.08);
  transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}

.logo-card:hover {
  border-color: rgba(79, 129, 189, 0.46);
  box-shadow: 0 18px 42px rgba(31, 73, 125, 0.12);
  transform: translateY(-3px);
}

.logo-frame {
  width: 100%;
  height: 62px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.client-logo-img,
.partner-logo-img {
  display: block;
  max-width: 100%;
  max-height: 58px;
  object-fit: contain;
}

.partner-logo-img {
  max-height: 52px;
}

.logo-meta,
.logo-caption {
  text-align: center;
}

.logo-meta h4 {
  margin: 0 0 4px;
  color: #182334;
  font-size: 0.95rem;
  font-weight: 700;
  line-height: 1.25;
}

.logo-meta p,
.logo-caption {
  color: #637083;
  font-size: 0.78rem;
  line-height: 1.35;
}

.partner-name-fallback {
  color: #1F497D;
  font-size: 0.95rem;
  font-weight: 700;
  text-align: center;
}

.client-card.logo-card {
  align-items: stretch;
}

.client-avatar {
  width: 54px;
  height: 54px;
  border-radius: 8px;
  background: #EAF3FC;
  color: #1F497D;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

@media (max-width: 680px) {
  .clients-grid,
  .partners-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
  }

  .logo-card,
  .client-card.logo-card,
  .partner-badge.logo-card {
    min-height: 118px;
    padding: 16px;
  }

  .logo-caption {
    display: none;
  }
}

/* ===== Xcitium dark brand palette ===== */
:root {
  --xc-bg: #080A23;
  --xc-bg-2: #0F1230;
  --xc-panel: rgba(31, 22, 55, 0.88);
  --xc-panel-2: rgba(38, 27, 67, 0.88);
  --xc-line: rgba(214, 44, 178, 0.28);
  --xc-pink: #D72CB2;
  --xc-hot: #FF4D6D;
  --xc-orange: #F26419;
  --xc-violet: #7B3FF2;
  --xc-cyan: #31D7FF;
  --xc-text: #FFFFFF;
  --xc-muted: rgba(255, 255, 255, 0.64);
  --xc-faint: rgba(255, 255, 255, 0.12);
  --g1: #D72CB2;
  --g2: #F26419;
  --g3: #FF4D6D;
  --violet: #7B3FF2;
  --cyan: #31D7FF;
  --grad: linear-gradient(135deg, #D72CB2 0%, #FF4D6D 52%, #F26419 100%);
  --grad3: linear-gradient(135deg, #D72CB2 0%, #FF4D6D 52%, #F26419 100%);
  --bg: #080A23;
  --bg2: #0F1230;
  --card: rgba(31, 22, 55, 0.88);
  --w: #FFFFFF;
  --w70: rgba(255, 255, 255, 0.78);
  --w55: rgba(255, 255, 255, 0.62);
  --w25: rgba(255, 255, 255, 0.28);
  --w08: rgba(255, 255, 255, 0.08);
  --pb: rgba(215, 44, 178, 0.28);
  --green: #31F08D;
}

html,
body {
  background: var(--xc-bg) !important;
  color: var(--xc-text) !important;
  font-family: "Exo 2", "Segoe UI", Arial, sans-serif !important;
}

body::before {
  content: "";
  position: fixed;
  inset: 0;
  z-index: -1;
  background:
    radial-gradient(circle at 0% 0%, rgba(215, 44, 178, 0.18), transparent 28%),
    radial-gradient(circle at 88% 22%, rgba(123, 63, 242, 0.16), transparent 32%),
    linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px),
    linear-gradient(160deg, #080A23 0%, #0C1030 54%, #100820 100%);
  background-size: auto, auto, 50px 50px, 50px 50px, auto;
}

nav {
  background: rgba(8, 10, 35, 0.9) !important;
  border-bottom: 1px solid rgba(215, 44, 178, 0.24) !important;
  box-shadow: 0 12px 36px rgba(0, 0, 0, 0.22) !important;
}

.logo,
.nav-links a,
.nav-links a.active,
.nav-links a:hover {
  color: var(--xc-text) !important;
}

.logo span,
.grad-text,
.qg {
  background: var(--grad) !important;
  background-clip: text !important;
  -webkit-background-clip: text !important;
  color: transparent !important;
  -webkit-text-fill-color: transparent !important;
}

.nav-links a {
  color: rgba(255, 255, 255, 0.58) !important;
}

.nav-cta,
.btn-p {
  background: var(--grad) !important;
  color: #FFFFFF !important;
  border: 1px solid rgba(255, 77, 109, 0.34) !important;
  box-shadow: 0 14px 34px rgba(215, 44, 178, 0.28) !important;
}

.btn-o {
  background: rgba(10, 11, 38, 0.62) !important;
  color: #FFFFFF !important;
  border: 1px solid rgba(215, 44, 178, 0.58) !important;
}

.btn-o:hover {
  background: rgba(215, 44, 178, 0.14) !important;
}

.hero,
.sec,
.sec-mid,
.cta {
  background: transparent !important;
}

.hero {
  min-height: 92vh !important;
}

.bg-grid {
  opacity: 1 !important;
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px) !important;
}

.glow-l,
.glow-r {
  display: block !important;
}

.glow-l {
  background: radial-gradient(circle, rgba(215, 44, 178, 0.2) 0%, transparent 68%) !important;
}

.glow-r {
  background: radial-gradient(circle, rgba(123, 63, 242, 0.17) 0%, transparent 68%) !important;
}

.badge,
.label {
  background: rgba(215, 44, 178, 0.12) !important;
  border: 1px solid rgba(215, 44, 178, 0.36) !important;
  color: #FF76DE !important;
  -webkit-text-fill-color: currentColor !important;
}

.label {
  display: inline-flex !important;
  padding: 0 !important;
  border: 0 !important;
  letter-spacing: 2.8px !important;
}

.label::before {
  background: var(--grad) !important;
}

.bdot {
  background: var(--xc-pink) !important;
  box-shadow: 0 0 14px var(--xc-pink) !important;
}

.hero-title,
.ttl,
.quote-text,
.cta h2 {
  color: #FFFFFF !important;
  font-family: "Rajdhani", "Exo 2", sans-serif !important;
  letter-spacing: 1.5px !important;
  text-transform: uppercase !important;
}

.hero-sub,
.sub,
.cta p,
.shield-sub,
.node p,
.cap p,
.phase p,
.phase li,
.plan-desc,
.plan-feat li,
.stat-l,
.award p,
.fa,
.ft-brand p,
.ft-col ul li a,
.ft-bot {
  color: var(--xc-muted) !important;
}

.stroke-text {
  color: transparent !important;
  -webkit-text-stroke: 2px rgba(255, 255, 255, 0.58) !important;
}

.shield-card,
.node,
.stat,
.phase,
.cap,
.plan,
.award,
.faq {
  background: var(--xc-panel) !important;
  border: 1px solid var(--xc-line) !important;
  border-radius: 14px !important;
  box-shadow: 0 24px 70px rgba(0, 0, 0, 0.22) !important;
  color: #FFFFFF !important;
}

.shield-card {
  background: linear-gradient(145deg, rgba(27, 15, 52, 0.94), rgba(16, 11, 40, 0.98)) !important;
  border-radius: 20px !important;
}

.node {
  background: rgba(255, 255, 255, 0.045) !important;
}

.node::before,
.phase::before {
  background: var(--grad) !important;
}

.node-icon,
.ph-icon,
.cap-icon {
  background: rgba(215, 44, 178, 0.18) !important;
  border: 1px solid rgba(215, 44, 178, 0.38) !important;
  color: #FFFFFF !important;
}

.shield-logo {
  background: var(--grad) !important;
  background-clip: text !important;
  -webkit-background-clip: text !important;
  color: transparent !important;
  -webkit-text-fill-color: transparent !important;
}

.xcitium-logo-img {
  width: min(220px, 82%) !important;
  padding: 10px 16px !important;
  margin: 0 auto 14px !important;
  background: #FFFFFF !important;
  border-radius: 10px !important;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.16) !important;
}

.quote-band {
  background: linear-gradient(90deg, rgba(215, 44, 178, 0.1), rgba(242, 100, 25, 0.08)) !important;
  border-top: 1px solid rgba(215, 44, 178, 0.25) !important;
  border-bottom: 1px solid rgba(215, 44, 178, 0.25) !important;
}

.stats,
.tbl {
  border: 1px solid rgba(215, 44, 178, 0.24) !important;
}

.stat-n,
.chk,
.plan-tier,
.ph-tag {
  background: var(--grad) !important;
  background-clip: text !important;
  -webkit-background-clip: text !important;
  color: transparent !important;
  -webkit-text-fill-color: transparent !important;
}

.tbl th {
  background: rgba(215, 44, 178, 0.16) !important;
  color: #FFFFFF !important;
  border-bottom: 1px solid rgba(215, 44, 178, 0.32) !important;
}

.tbl td {
  background: rgba(255, 255, 255, 0.035) !important;
  color: var(--xc-muted) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.07) !important;
}

.tbl td strong {
  color: #FFFFFF !important;
}

.good {
  color: #31F08D !important;
}

.bad {
  color: #FF6B7E !important;
}

.plan.feat {
  background: linear-gradient(160deg, rgba(215, 44, 178, 0.16), rgba(242, 100, 25, 0.08), rgba(255, 255, 255, 0.035)) !important;
  border-color: rgba(255, 77, 109, 0.55) !important;
}

.plan-badge {
  background: var(--grad) !important;
}

.faq.open,
.faq:hover,
.award:hover,
.cap:hover,
.plan:hover,
.phase:hover {
  border-color: rgba(255, 77, 109, 0.55) !important;
  background: rgba(42, 25, 76, 0.9) !important;
}

footer {
  background: #060714 !important;
  border-top: 1px solid rgba(215, 44, 178, 0.22) !important;
}

@media (max-width: 700px) {
  .nav-links {
    background: rgba(8, 10, 35, 0.96) !important;
  }
}

/* ===== Xcitium responsive/nav refinements ===== */
.nav-links,
#nav-links {
  background: transparent !important;
  border: 0 !important;
  box-shadow: none !important;
}

.nav-links a.nav-cta,
nav .nav-cta {
  background: var(--grad) !important;
  color: #FFFFFF !important;
  border: 1px solid rgba(255, 77, 109, 0.34) !important;
  box-shadow: 0 14px 34px rgba(215, 44, 178, 0.28) !important;
}

.hero-sub strong {
  color: rgba(255, 255, 255, 0.86) !important;
}

.hero-sub .hi {
  color: #FF6FE1 !important;
}

@media (max-width: 900px) {
  .nav-links,
  #nav-links {
    background: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
  }

  .nav-links {
    gap: 16px !important;
  }

  .nav-links a {
    font-size: 0.7rem !important;
  }
}

@media (max-width: 760px) {
  nav {
    align-items: flex-start !important;
    height: auto !important;
    min-height: 68px !important;
    padding: 18px 22px !important;
  }

  .nav-links {
    display: none !important;
  }
}

/* ===== Xcitium services dropdown ===== */
.nav-item-dropdown {
  position: relative;
}

.mega-menu {
  position: absolute;
  top: calc(100% + 18px);
  left: 50%;
  z-index: 1200;
  min-width: 520px;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
  padding: 18px;
  background: rgba(18, 12, 42, 0.98);
  border: 1px solid rgba(215, 44, 178, 0.32);
  border-radius: 12px;
  box-shadow: 0 24px 70px rgba(0, 0, 0, 0.34);
  opacity: 0;
  pointer-events: none;
  transform: translate(-50%, 8px);
  transition: opacity 0.18s ease, transform 0.18s ease;
}

.nav-item-dropdown:hover .mega-menu,
.nav-item-dropdown:focus-within .mega-menu {
  opacity: 1;
  pointer-events: auto;
  transform: translate(-50%, 0);
}

.mega-col {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.mega-label {
  color: #FF6FE1;
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 1.2px;
  margin: 0 0 6px;
  text-transform: uppercase;
}

.mega-menu a {
  padding: 9px 10px;
  border-radius: 6px;
  color: rgba(255, 255, 255, 0.72) !important;
  font-size: 0.82rem !important;
  letter-spacing: 0 !important;
  text-transform: none !important;
}

.mega-menu a:hover {
  background: rgba(215, 44, 178, 0.16);
  color: #FFFFFF !important;
}

@media (max-width: 980px) {
  .mega-menu {
    left: auto;
    right: 0;
    min-width: min(520px, 92vw);
    transform: translate(0, 8px);
  }

  .nav-item-dropdown:hover .mega-menu,
  .nav-item-dropdown:focus-within .mega-menu {
    transform: translate(0, 0);
  }
}

</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="/index.php" class="logo">A<span>X</span>ENTIA</a>
  <ul class="nav-links">
    <li><a href="/pages/xcitium.php" class="active">Xcitium</a></li>
    <li><a href="/pages/nosotros.php">Nosotros</a></li>
    <li class="nav-item-dropdown">
      <a href="/pages/servicios.php">Servicios</a>
      <div class="mega-menu">
        <div class="mega-col">
          <span class="mega-label">Servicios</span>
          <a href="/pages/servicios.php">Todos los servicios</a>
          <a href="/pages/soporte.php">Soporte gestionado</a>
          <a href="/pages/servicios.php#ciberseguridad">Ciberseguridad</a>
          <a href="/pages/servicios.php#infraestructura">Infraestructura IT</a>
          <a href="/pages/servicios.php#nube">Nube y continuidad</a>
        </div>
        <div class="mega-col">
          <span class="mega-label">Fabricantes</span>
          <a href="/pages/fabricantes.php">Ver todos</a>
          <a href="/pages/fabricantes/microsoft.php">Microsoft</a>
          <a href="/pages/fabricantes/fortinet.php">Fortinet</a>
          <a href="/pages/fabricantes/xcitium.php">Xcitium</a>
          <a href="/pages/fabricantes/veeam.php">Veeam</a>
        </div>
      </div>
    </li>
    <li><a href="/pages/soporte.php">Soporte</a></li>
    <li><a href="/pages/socios.php">Socios</a></li>
    <li><a href="/pages/blog.php">Blog</a></li>
    <li><a href="/pages/contacto.php" class="nav-cta">Contáctanos</a></li>
  </ul>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="bg-grid"></div>
  <div class="glow-l"></div>
  <div class="glow-r"></div>
  <div class="hero-content">
    <div class="badge"><span class="bdot"></span>Distribuidor Autorizado · República Dominicana</div>
    <h1 class="hero-title">
      <span class="grad-text">XCITIUM</span><br>
      ZERO TRUST<br>
      <span class="stroke-text">CYBERSECURITY</span>
    </h1>
    <p class="hero-sub">
      La plataforma <strong>#1 Zero Trust</strong> con tecnología patentada
      <strong>ZeroDwell™</strong> que detiene el ransomware antes de que se ejecute.
      Más de <strong>85 millones</strong> de endpoints protegidos globalmente.
      <span class="hi">Axentia es tu distribuidor autorizado en República Dominicana.</span>
    </p>
    <div class="hero-btns">
      <a href="/pages/contacto.php" class="btn-p">🛡️ Solicitar Demo</a>
      <a href="/pages/contacto.php" class="btn-o">Cotizar Licencias</a>
    </div>
  </div>
  <div class="hero-visual">
    <div class="shield-card">
      <img class="xcitium-logo-img" src="../assets/logos/partners/xcitium.png" alt="Xcitium">
      <div class="shield-sub">Zero-Trust Solutions<br>Now Extended to Cloud Workloads</div>
      <div class="nodes">
        <div class="node"><div class="node-icon">🖥️</div><div><h5>Endpoint Security</h5><p>ZeroDwell™ en cada dispositivo</p></div></div>
        <div class="node"><div class="node-icon">🌐</div><div><h5>Network Security</h5><p>Firewall, segmentación y visibilidad</p></div></div>
        <div class="node"><div class="node-icon">☁️</div><div><h5>Cloud Security (CNAPP)</h5><p>Protección nativa para workloads</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- QUOTE -->
<div class="quote-band">
  <div class="quote-text">
    "Detección <span class="qg">≠</span> Protección. Nadie puede evitar que el malware <em>entre</em>,
    pero Xcitium evita que <span class="qg">cause daño</span>."
  </div>
</div>

<!-- STATS -->
<section class="sec">
  <div class="cont">
    <div class="tc" style="margin-bottom:52px">
      <div class="label" style="justify-content:center">Performance Transparency</div>
      <h2 class="ttl tc">Resultados en <span class="grad-text">tiempo real</span></h2>
      <p style="color:var(--w55);font-size:.95rem;max-width:560px;margin:0 auto;line-height:1.7">El nuevo malware siempre comienza como "Desconocido". ZeroDwell™ los contiene antes de causar daño.</p>
    </div>
    <div class="stats">
      <div class="stat"><span class="stat-n">85M+</span><span class="stat-l">Endpoints Protegidos Globalmente</span></div>
      <div class="stat"><span class="stat-n">0%</span><span class="stat-l">Dispositivos con Infección o Brecha</span></div>
      <div class="stat"><span class="stat-n">88%</span><span class="stat-l">Estado Conocido Bueno</span></div>
      <div class="stat"><span class="stat-n">10%</span><span class="stat-l">En Contención (monitoreados)</span></div>
      <div class="stat"><span class="stat-n">3%</span><span class="stat-l">Desconocidos = Malware</span></div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="sec-mid">
  <div class="cont">
    <div class="label">Tecnología Patentada</div>
    <h2 class="ttl">¿Cómo funciona <span class="grad-text">ZeroDwell™?</span></h2>
    <p class="sub">Tres fases que garantizan cero daño, sin importar si la amenaza es conocida o desconocida.</p>
    <div class="phases">
      <div class="phase">
        <div class="ph-icon">🚫</div>
        <span class="ph-tag">Fase 01 · Pre-Ejecución</span>
        <h3>Lo conocido malo — Bloqueado</h3>
        <p>Antes de ejecutarse, las amenazas conocidas son bloqueadas por múltiples capas de protección.</p>
        <ul><li>NextGen EDR</li><li>Host Intrusion Prevention (HIPS)</li><li>Host Firewall</li><li>VirusScope — Análisis Estático</li><li>Application Control</li></ul>
      </div>
      <div class="phase">
        <div class="ph-icon">📦</div>
        <span class="ph-tag">Fase 02 · En Ejecución</span>
        <h3>Lo desconocido — Contenido</h3>
        <p>Los archivos desconocidos se ejecutan dentro de <strong style="color:#fff">Recursos Virtuales</strong> aislados a nivel kernel. NO pueden cifrar archivos, robar datos ni modificar sistemas.</p>
      </div>
      <div class="phase">
        <div class="ph-icon">🔬</div>
        <span class="ph-tag">Fase 03 · Post-Ejecución</span>
        <h3>Análisis y Veredicto</h3>
        <p>Los elementos contenidos son analizados con IA + analistas humanos expertos.</p>
        <ul><li>Desconocido Bueno → Whitelisted</li><li>Desconocido Malo → Blacklisted</li><li>Cero daño durante todo el proceso</li></ul>
      </div>
    </div>
  </div>
</section>

<!-- ZERO TRUST CLOUD -->
<section class="sec">
  <div class="cont">
    <div class="zt-grid">
      <div>
        <div class="label">Zero Trust de Endpoint hasta la Nube</div>
        <h2 class="ttl">Un solo motor,<br><span class="grad-text">visibilidad completa</span></h2>
        <p style="color:var(--w55);font-size:.95rem;line-height:1.75;margin-bottom:30px">Xcitium extiende la protección Zero Trust desde el endpoint hasta los workloads en la nube bajo un solo panel de vidrio.</p>
        <div style="display:flex;flex-direction:column;gap:14px">
          <div class="node" style="border-radius:14px"><div class="node-icon">🖥️</div><div><h5>Endpoint Security</h5><p>ZeroDwell™ contiene amenazas en cada dispositivo antes de que se ejecuten.</p></div></div>
          <div class="node" style="border-radius:14px"><div class="node-icon">🌐</div><div><h5>Network Security</h5><p>Firewall, segmentación y visibilidad de tráfico en toda la red corporativa.</p></div></div>
          <div class="node" style="border-radius:14px"><div class="node-icon">☁️</div><div><h5>Cloud Security (CNAPP)</h5><p>Protección nativa para workloads en nube, DevOps e infraestructura como código.</p></div></div>
        </div>
      </div>
      <div style="text-align:center">
        <div class="shield-card">
          <div style="font-size:5rem;margin-bottom:14px">🛡️</div>
          <img class="xcitium-logo-img" src="../assets/logos/partners/xcitium.png" alt="Xcitium">
          <div class="shield-sub" style="font-size:.9rem;margin-top:6px">Zero-Trust Solutions<br>Now Extended to Cloud Workloads</div>
          <div style="margin-top:22px;padding-top:18px;border-top:1px solid rgba(199,36,177,.2);font-family:'JetBrains Mono',monospace;font-size:.67rem;letter-spacing:2px;color:rgba(255,255,255,.3);text-transform:uppercase">Distribuidor Autorizado<br>República Dominicana</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CAPABILITIES -->
<section class="sec-mid">
  <div class="cont">
    <div class="label">Plataforma Unificada</div>
    <h2 class="ttl">Capacidades de la <span class="grad-text">Plataforma</span></h2>
    <p class="sub">Zero Trust de endpoints a workloads en la nube bajo un solo panel de vidrio — Single Pane-of-Glass.</p>
    <div class="caps">
      <div class="cap"><div class="cap-icon">🔒</div><h4>ZeroDwell™ Containment</h4><p>Aísla automáticamente archivos desconocidos en contenedores virtuales a nivel kernel sin dañar recursos reales.</p></div>
      <div class="cap"><div class="cap-icon">🕵️</div><h4>MDR — SOC 24/7</h4><p>Monitoreo continuo por analistas expertos. Hunting de amenazas, investigación de incidentes y respuesta activa.</p></div>
      <div class="cap"><div class="cap-icon">🛡️</div><h4>Plataforma EPP Unificada</h4><p>Antivirus, Firewall, HIPS, Control de Aplicaciones y Análisis Estático en un solo agente ligero.</p></div>
      <div class="cap"><div class="cap-icon">🌐</div><h4>Inteligencia de Amenazas Global</h4><p>Base de datos actualizada continuamente con datos de millones de endpoints para detección proactiva.</p></div>
      <div class="cap"><div class="cap-icon">🔭</div><h4>EDR de Siguiente Generación</h4><p>Telemetría continua, árboles de procesos, conexiones de red y análisis forense completo.</p></div>
      <div class="cap"><div class="cap-icon">☁️</div><h4>Consola Cloud Unificada</h4><p>Panel único de visibilidad para endpoints, redes y workloads. Gestión centralizada sin complejidad.</p></div>
      <div class="cap"><div class="cap-icon">🚫</div><h4>Zero Trust Endpoint</h4><p>Ningún archivo se confía por defecto. Todo lo desconocido es contenido y analizado antes de ser permitido.</p></div>
      <div class="cap"><div class="cap-icon">🏗️</div><h4>CNAPP — Protección Cloud</h4><p>Cloud Native Application Protection Platform para workloads en nube, DevOps e infraestructura como código.</p></div>
      <div class="cap"><div class="cap-icon">🏢</div><h4>Multi-tenant para MSSPs</h4><p>Arquitectura escalable con aislamiento multi-tenant y monitoreo centralizado para proveedores de servicios.</p></div>
      <div class="cap"><div class="cap-icon">📱</div><h4>RMM + Patch Management</h4><p>Remote Monitoring & Management con gestión de parches para mantener sistemas seguros y actualizados.</p></div>
      <div class="cap"><div class="cap-icon">📧</div><h4>Email & Web Protection</h4><p>Protección multicapa de correo electrónico y bloqueo de sitios dañinos para tus empleados.</p></div>
      <div class="cap"><div class="cap-icon">🔍</div><h4>XDR — Detección Extendida</h4><p>Extended Detection and Response desde endpoints hasta redes y cloud bajo un solo panel de control.</p></div>
    </div>
  </div>
</section>

<!-- PLANS -->
<section class="sec">
  <div class="cont">
    <div class="label">Planes Disponibles</div>
    <h2 class="ttl">Elige tu plan <span class="grad-text">Xcitium</span></h2>
    <p class="sub">Desde protección básica hasta XDR completo con SOC 24/7. Contáctanos para cotizar.</p>
    <div class="plans">
      <div class="plan">
        <div class="plan-tier">EPP + EDR</div>
        <div class="plan-name">Xcitium Advanced</div>
        <div class="plan-desc">Protección de endpoints + Detección y Respuesta de siguiente generación.</div>
        <ul class="plan-feat">
          <li><span class="chk">✓</span>ZeroDwell™ Containment</li>
          <li><span class="chk">✓</span>NextGen EDR</li>
          <li><span class="chk">✓</span>Host Firewall & HIPS</li>
          <li><span class="chk">✓</span>VirusScope Análisis Estático</li>
          <li><span class="chk">✓</span>Control de Aplicaciones</li>
          <li><span class="chk">✓</span>Visibilidad completa del endpoint</li>
        </ul>
        <a href="/pages/contacto.php" class="btn-o" style="justify-content:center">Solicitar Cotización</a>
      </div>
      <div class="plan feat">
        <div class="plan-badge">⭐ Más Popular</div>
        <div class="plan-tier">MDR</div>
        <div class="plan-name">Xcitium Managed</div>
        <div class="plan-desc">EDR Gestionado con monitoreo 24/7 por analistas expertos en ciberseguridad.</div>
        <ul class="plan-feat">
          <li><span class="chk">✓</span>Todo lo de Advanced</li>
          <li><span class="chk">✓</span>SOC 24/7 — Ojos en pantalla</li>
          <li><span class="chk">✓</span>Hunting de amenazas activo</li>
          <li><span class="chk">✓</span>Gestión de incidentes</li>
          <li><span class="chk">✓</span>SLAs de respuesta garantizados</li>
          <li><span class="chk">✓</span>Servicios para MSPs y MSSPs</li>
        </ul>
        <a href="/pages/contacto.php" class="btn-p" style="justify-content:center">Solicitar Cotización</a>
      </div>
      <div class="plan">
        <div class="plan-tier">XDR</div>
        <div class="plan-name">Xcitium Complete</div>
        <div class="plan-desc">Detección y Respuesta Extendida — endpoints, nube y redes bajo un solo panel.</div>
        <ul class="plan-feat">
          <li><span class="chk">✓</span>Todo lo de Managed</li>
          <li><span class="chk">✓</span>Protección de Redes</li>
          <li><span class="chk">✓</span>Seguridad de Cloud (CNAPP)</li>
          <li><span class="chk">✓</span>Workloads de nube y DevOps</li>
          <li><span class="chk">✓</span>Zero Trust de endpoint a nube</li>
          <li><span class="chk">✓</span>Panel único de visibilidad</li>
        </ul>
        <a href="/pages/contacto.php" class="btn-o" style="justify-content:center">Solicitar Cotización</a>
      </div>
    </div>
  </div>
</section>

<!-- COMPARISON -->
<section class="sec-mid">
  <div class="cont">
    <div class="label">Análisis Comparativo</div>
    <h2 class="ttl">Xcitium vs. <span class="grad-text">Seguridad Tradicional</span></h2>
    <p class="sub">¿Por qué la detección sola no es suficiente para proteger tu empresa?</p>
    <div style="overflow-x:auto">
      <table class="tbl">
        <thead><tr><th>Aspecto</th><th>🔴 Seguridad Tradicional</th><th>🟢 Xcitium ZeroDwell™</th></tr></thead>
        <tbody>
          <tr><td><strong style="color:#fff">Enfoque</strong></td><td class="bad">Detección basada en firmas</td><td class="good">Contención activa ZeroDwell™</td></tr>
          <tr><td><strong style="color:#fff">Amenazas Zero-Day</strong></td><td class="bad">Vulnerable durante el lag</td><td class="good">Contenidas antes de causar daño</td></tr>
          <tr><td><strong style="color:#fff">Ransomware</strong></td><td class="bad">Detectado después del cifrado</td><td class="good">Bloqueado antes de ejecutarse</td></tr>
          <tr><td><strong style="color:#fff">Archivos desconocidos</strong></td><td class="bad">Permitidos por defecto (riesgo)</td><td class="good">Contenidos por defecto (Zero Trust)</td></tr>
          <tr><td><strong style="color:#fff">Falsos positivos</strong></td><td class="bad">Alto impacto en productividad</td><td class="good">Mínimo impacto, ejecución virtual</td></tr>
          <tr><td><strong style="color:#fff">Ataques fileless</strong></td><td class="bad">Difícil detectar sin firma</td><td class="good">Neutralizados en contenedor virtual</td></tr>
          <tr><td><strong style="color:#fff">Tiempo de respuesta</strong></td><td class="bad">Horas o días</td><td class="good">Instantáneo — pre-ejecución</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- AWARDS -->
<section class="sec">
  <div class="cont">
    <div class="tc" style="margin-bottom:50px">
      <div class="label" style="justify-content:center">Reconocimientos</div>
      <h2 class="ttl tc">Premios y <span class="grad-text">Certificaciones</span></h2>
      <p style="color:var(--w55);font-size:.92rem;text-align:center">Probado y reconocido por los expertos más exigentes de la industria.</p>
    </div>
    <div class="awards">
      <div class="award"><div class="ic">🏆</div><h5>Product of the Year 2025</h5><p>AVLAB</p></div>
      <div class="award"><div class="ic">✅</div><h5>Approved Endpoint Protection</h5><p>AV-TEST</p></div>
      <div class="award"><div class="ic">🥇</div><h5>Tech Innovators Award 2022</h5><p>CRN</p></div>
      <div class="award"><div class="ic">📊</div><h5>Competitive Strategy Leader 2022</h5><p>Frost & Sullivan</p></div>
      <div class="award"><div class="ic">🛡️</div><h5>Top Infosec Innovator 2022</h5><p>Cyber Defense Magazine</p></div>
      <div class="award"><div class="ic">🔬</div><h5>MRG Effitas Certified Q1-2024</h5><p>MRG Effitas</p></div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="sec-mid">
  <div class="cont">
    <div class="tc" style="margin-bottom:50px">
      <div class="label" style="justify-content:center">Preguntas Frecuentes</div>
      <h2 class="ttl tc">FAQ — <span class="grad-text">Xcitium</span></h2>
    </div>
    <div class="faqs">
      <div class="faq"><div class="fq" onclick="this.parentElement.classList.toggle('open')">¿Qué hace diferente a Xcitium de otros EDR?</div><div class="fa">Xcitium introduce el concepto de ZeroDwell™ Containment: los archivos desconocidos no se bloquean ni se permiten libremente, sino que se ejecutan en un entorno virtual aislado a nivel kernel. Esto significa que incluso si un archivo es malicioso, no puede causar daño real. Los EDR tradicionales dependen de la detección y actúan después del daño.</div></div>
      <div class="faq"><div class="fq" onclick="this.parentElement.classList.toggle('open')">¿Puede detectar ataques fileless y Zero-Day?</div><div class="fa">Sí. ZeroDwell™ no depende de firmas ni del conocimiento previo del malware. Al contener cualquier proceso desconocido en un entorno virtual, incluso los ataques fileless y Zero-Day quedan neutralizados antes de ejecutar código dañino en el sistema real.</div></div>
      <div class="faq"><div class="fq" onclick="this.parentElement.classList.toggle('open')">¿Es adecuado para organizaciones de cualquier tamaño?</div><div class="fa">Absolutamente. Xcitium ofrece planes escalables desde protección básica EPP+EDR hasta XDR completo con SOC 24/7. Axentia adapta la implementación al tamaño, presupuesto y sector de cada organización — pequeña, mediana, grande o gubernamental — con soporte local incluido.</div></div>
      <div class="faq"><div class="fq" onclick="this.parentElement.classList.toggle('open')">¿Cumple con estándares de compliance?</div><div class="fa">Sí, Xcitium cumple con ISO 27001, PCI DSS, HIPAA y GDPR. Cuenta con certificaciones de AV-TEST, MRG Effitas, y reconocimientos de Frost & Sullivan como líder en estrategia competitiva.</div></div>
      <div class="faq"><div class="fq" onclick="this.parentElement.classList.toggle('open')">¿Cómo afecta el rendimiento del equipo del usuario?</div><div class="fa">El impacto es mínimo. El agente de Xcitium está diseñado para ser ligero y eficiente. La contención virtual ocurre a nivel kernel de forma transparente para el usuario, sin demoras perceptibles.</div></div>
      <div class="faq"><div class="fq" onclick="this.parentElement.classList.toggle('open')">¿Qué pasa si el archivo contenido resulta ser legítimo?</div><div class="fa">El archivo se ejecuta normalmente dentro del contenedor virtual. Una vez analizado y verificado como legítimo por IA + analistas humanos, se aprueba permanentemente. El proceso es transparente para el usuario final.</div></div>
    </div>
  </div>
</section>

<!-- CTA -->
<div class="cta">
  <h2>¿Listo para eliminar el ransomware?</h2>
  <p>Axentia te ofrece licencias, implementación y soporte de Xcitium en República Dominicana. Agenda una demo sin costo.</p>
  <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;position:relative">
    <a href="/pages/contacto.php" class="btn-p">🛡️ Solicitar Demo Gratuita</a>
    <a href="/pages/contacto.php" class="btn-o">Cotizar Licencias</a>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="ft">
    <div class="ft-brand">
      <a href="/index.php" class="logo">A<span>X</span>ENTIA</a>
      <p>Conectando Ideas, Innovando el Futuro.<br>© 2025 Axentia SRL. Todos los derechos reservados.</p>
    </div>
    <div class="ft-col"><h5>Empresa</h5><ul><li><a href="/pages/nosotros.php">Nosotros</a></li><li><a href="/pages/socios.php">Socios</a></li><li><a href="/pages/blog.php">Blog</a></li><li><a href="/pages/contacto.php">Contacto</a></li></ul></div>
    <div class="ft-col"><h5>Servicios</h5><ul><li><a href="/pages/servicios.php">Ciberseguridad</a></li><li><a href="/pages/servicios.php">Infraestructura IT</a></li><li><a href="/pages/servicios.php">Gestión de Nube</a></li><li><a href="/pages/soporte.php">Soporte Gestionado</a></li></ul></div>
    <div class="ft-col"><h5>Contacto</h5><ul><li><a href="/pages/contacto.php">contacto@axentia.com.do</a></li><li><a href="/pages/contacto.php">+1 (829) 407-5537</a></li><li><a href="/pages/contacto.php">+1 (809) 432-4778</a></li><li><a href="/pages/contacto.php">Santo Domingo & Santiago</a></li></ul></div>
  </div>
  <div class="ft-bot"><p>© 2025 Axentia SRL · República Dominicana</p><p>Distribuidor Autorizado Xcitium</p></div>
</footer>

</body>
</html>
