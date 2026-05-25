<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KAPITOL CAFE</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;0,700;1,300;1,600&family=Josefin+Sans:wght@200;300;400;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<style>
:root {
  --ink:#0D0600; --espresso:#160901; --gold:#C8963E; --gold-lt:#E8B86D;
  --gold-dim:#8A6428; --amber:#F5C842; --cream:#FDF6EC; --latte:#D4A96A;
  --border:rgba(200,150,62,0.22);
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html,body{width:100%;height:100%;overflow:hidden;background:var(--ink);font-family:'Josefin Sans',sans-serif;cursor:none;}
.cursor{position:fixed;pointer-events:none;z-index:9999;width:10px;height:10px;border-radius:50%;background:var(--gold);transform:translate(-50%,-50%);transition:width .3s,height .3s;mix-blend-mode:screen;}
.cursor-ring{position:fixed;pointer-events:none;z-index:9998;width:36px;height:36px;border-radius:50%;border:1.5px solid rgba(200,150,62,0.5);transform:translate(-50%,-50%);transition:transform .15s ease-out,width .3s,height .3s;}
#particleCanvas{position:fixed;inset:0;z-index:0;pointer-events:none;}
body::before{content:'';position:fixed;inset:0;z-index:1;pointer-events:none;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");opacity:.025;}
body::after{content:'';position:fixed;inset:0;z-index:2;pointer-events:none;background:radial-gradient(ellipse 90% 90% at 50% 50%,transparent 35%,rgba(5,2,0,0.8) 100%);}
.ambient{position:fixed;border-radius:50%;pointer-events:none;z-index:1;filter:blur(80px);}
.amb-1{width:900px;height:600px;background:radial-gradient(ellipse,rgba(180,100,20,0.2),transparent 70%);top:-200px;left:-200px;animation:aF1 12s ease-in-out infinite;}
.amb-2{width:700px;height:700px;background:radial-gradient(ellipse,rgba(200,150,62,0.12),transparent 70%);bottom:-200px;right:-100px;animation:aF2 15s ease-in-out infinite;}
.amb-3{width:500px;height:500px;background:radial-gradient(ellipse,rgba(245,200,66,0.08),transparent 70%);top:40%;left:40%;animation:aF3 10s ease-in-out infinite;}
@keyframes aF1{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(60px,-40px) scale(1.1)}}
@keyframes aF2{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(-80px,-60px) scale(1.15)}}
@keyframes aF3{0%,100%{transform:translate(-50%,-50%) scale(1)}50%{transform:translate(-50%,-50%) scale(1.4)}}
.curtain{position:fixed;inset:0;z-index:500;background:var(--ink);animation:curtainUp 1s cubic-bezier(.76,0,.24,1) .1s forwards;}
@keyframes curtainUp{to{transform:translateY(-100%)}}
.steam-group{position:fixed;pointer-events:none;z-index:3;}
.steam-wisp{position:absolute;bottom:0;width:3px;border-radius:50%;background:linear-gradient(to top,rgba(255,255,255,0.15),transparent);animation:steamRise var(--dur,4s) ease-in var(--delay,0s) infinite;}
@keyframes steamRise{0%{height:0;opacity:0;transform:scaleX(1) translateX(0);}20%{opacity:.7;}60%{opacity:.4;transform:scaleX(2.5) translateX(var(--drift,10px));}100%{height:120px;opacity:0;transform:scaleX(3) translateX(var(--drift,10px)) translateY(-140px);}}
.clock-badge{position:fixed;top:22px;right:28px;z-index:100;text-align:right;opacity:0;animation:revUp .6s ease 1.4s forwards;}
.clock-time{font-family:'Cormorant Garamond',serif;font-size:30px;font-weight:300;color:rgba(253,246,236,0.65);letter-spacing:2px;}
.clock-date{font-size:10px;letter-spacing:3px;color:rgba(253,246,236,0.22);text-transform:uppercase;margin-top:2px;}
.wifi-badge{position:fixed;top:22px;left:28px;z-index:100;display:flex;align-items:center;gap:8px;background:rgba(200,150,62,0.07);border:1px solid rgba(200,150,62,0.18);border-radius:30px;padding:8px 16px;opacity:0;animation:revUp .6s ease 1.5s forwards;}
.wifi-icon{font-size:14px;}.wifi-text{font-size:11px;color:rgba(253,246,236,0.4);letter-spacing:1px;}.wifi-text strong{color:var(--latte);font-weight:600;}
@keyframes revUp{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}

/* CENTERED STAGE */
.stage{position:relative;z-index:10;width:100vw;height:100vh;display:grid;grid-template-rows:1fr auto;overflow:hidden;}
.center-panel{display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:16px 24px 8px;}

/* BRAND */
.brand-area{margin-bottom:clamp(8px,1.5vh,18px);opacity:0;transform:translateY(-28px);animation:revDown 1s cubic-bezier(.175,.885,.32,1.275) .2s forwards;}
.brand-logo{display:block;width:clamp(90px,12vw,150px);height:auto;margin:0 auto clamp(6px,1vh,12px);filter:drop-shadow(0 0 18px rgba(200,150,62,0.45)) drop-shadow(0 0 40px rgba(200,150,62,0.18));animation:logoFloat 4s ease-in-out infinite;}
@keyframes logoFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
@keyframes revDown{to{opacity:1;transform:translateY(0)}}
.brand-eyebrow{display:flex;align-items:center;gap:12px;justify-content:center;margin-bottom:8px;}
.ey-line{width:36px;height:1px;background:linear-gradient(to right,transparent,var(--gold-dim));}
.ey-line.r{background:linear-gradient(to left,transparent,var(--gold-dim));}
.ey-text{font-size:10px;letter-spacing:5px;color:var(--gold-dim);text-transform:uppercase;font-weight:600;}
.ey-dot{width:3px;height:3px;border-radius:50%;background:var(--gold);animation:blink 2s infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
.brand-name{font-family:'Cormorant Garamond',serif;font-size:clamp(48px,7.5vw,90px);font-weight:700;line-height:.95;color:var(--gold);letter-spacing:-1px;text-shadow:0 0 60px rgba(200,150,62,0.45),0 0 120px rgba(200,150,62,0.15);}
.brand-name em{font-style:italic;font-weight:300;color:var(--gold-lt);}
.brand-sub{font-size:11px;letter-spacing:8px;color:rgba(253,246,236,0.28);text-transform:uppercase;margin-top:8px;}

/* QR CENTERPIECE */
.qr-center{opacity:0;transform:scale(.9);animation:qrIn 1.2s cubic-bezier(.175,.885,.32,1.275) .45s forwards;position:relative;margin-bottom:clamp(6px,1.2vh,14px);}
@keyframes qrIn{to{opacity:1;transform:scale(1)}}
.qr-halo{position:absolute;top:50%;left:50%;border-radius:50%;border:1px solid rgba(200,150,62,0.09);pointer-events:none;}
.qr-halo-1{width:400px;height:400px;transform:translate(-50%,-50%);animation:spin 40s linear infinite;}
.qr-halo-2{width:320px;height:320px;transform:translate(-50%,-50%);animation:spin 28s linear infinite reverse;border-color:rgba(200,150,62,0.06);}
.qr-halo-3{width:240px;height:240px;transform:translate(-50%,-50%);animation:spin 18s linear infinite;border-color:rgba(200,150,62,0.13);}
.qr-halo::after{content:'';position:absolute;top:-4px;left:50%;width:8px;height:8px;margin-left:-4px;border-radius:50%;background:var(--gold-dim);}
@keyframes spin{to{transform:translate(-50%,-50%) rotate(360deg)}}
.qr-label-row{display:flex;align-items:center;gap:10px;justify-content:center;margin-bottom:clamp(10px,1.8vh,18px);position:relative;z-index:5;}
.ql{flex:1;height:1px;max-width:50px;background:linear-gradient(to right,transparent,var(--border));}
.ql.r{background:linear-gradient(to left,transparent,var(--border));}
.ql-text{font-size:10px;letter-spacing:4px;color:var(--gold-dim);text-transform:uppercase;font-weight:700;}
.qr-shine{position:relative;display:inline-block;z-index:5;}
.qr-shine::before{content:'';position:absolute;inset:-20px;border-radius:32px;z-index:0;background:radial-gradient(ellipse 60% 40% at 50% 0%,rgba(245,200,66,0.35),transparent 60%),radial-gradient(ellipse 80% 60% at 50% 100%,rgba(200,100,20,0.3),transparent 60%);animation:shineGlow 3s ease-in-out infinite;}
@keyframes shineGlow{0%,100%{filter:blur(14px);opacity:.7}50%{filter:blur(22px);opacity:1}}
.scan-pulse{position:absolute;inset:-20px;border-radius:30px;border:2px solid rgba(200,150,62,0.28);animation:pRing 2.2s ease-out infinite;}
.scan-pulse:nth-child(2){animation-delay:.75s;}.scan-pulse:nth-child(3){animation-delay:1.5s;}
@keyframes pRing{0%{transform:scale(1);opacity:.6}100%{transform:scale(1.2);opacity:0}}
.qr-frame{position:relative;z-index:2;background:linear-gradient(145deg,#FFFDF8,#F8EDD8);border-radius:24px;padding:clamp(14px,2vw,22px);box-shadow:0 0 0 1px rgba(200,150,62,0.45),0 0 0 5px rgba(200,150,62,0.08),0 30px 80px rgba(0,0,0,0.65),0 0 60px rgba(200,150,62,0.18),inset 0 1px 0 rgba(255,255,255,0.9);overflow:hidden;}
.qr-frame::before,.qr-frame::after,.qr-corners::before,.qr-corners::after{content:'';position:absolute;width:22px;height:22px;border-color:var(--gold);border-style:solid;}
.qr-frame::before{top:8px;left:8px;border-width:2.5px 0 0 2.5px;border-radius:5px 0 0 0;}
.qr-frame::after{top:8px;right:8px;border-width:2.5px 2.5px 0 0;border-radius:0 5px 0 0;}
.qr-corners::before{bottom:8px;left:8px;border-width:0 0 2.5px 2.5px;border-radius:0 0 0 5px;}
.qr-corners::after{bottom:8px;right:8px;border-width:0 2.5px 2.5px 0;border-radius:0 0 5px 0;}
.scan-line{position:absolute;left:14px;right:14px;height:2px;background:linear-gradient(to right,transparent,rgba(200,150,62,0.9),transparent);box-shadow:0 0 10px rgba(200,150,62,0.7);animation:scanAnim 2.5s ease-in-out infinite;z-index:10;}
@keyframes scanAnim{0%{top:14px;opacity:0}8%{opacity:1}92%{opacity:1}100%{top:calc(100% - 14px);opacity:0}}
.qr-logo-overlay{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:white;border-radius:8px;padding:5px;font-size:20px;line-height:1;box-shadow:0 2px 8px rgba(0,0,0,0.15);z-index:5;}
.qr-cta{margin-top:clamp(8px,1.5vh,16px);position:relative;z-index:5;}
.qr-cta-main{font-family:'Cormorant Garamond',serif;font-size:clamp(16px,2.2vw,26px);font-weight:600;color:var(--cream);line-height:1.3;}
.qr-cta-main em{color:var(--amber);font-style:italic;}
.qr-cta-sub{font-size:11px;color:rgba(253,246,236,0.32);letter-spacing:2px;margin-top:4px;text-transform:uppercase;}

/* STEP PILLS */
.step-pills{display:flex;gap:8px;margin-top:clamp(6px,1.2vh,14px);flex-wrap:wrap;justify-content:center;opacity:0;animation:revUp .8s ease 1.1s forwards;position:relative;z-index:5;}
.pill{display:flex;align-items:center;gap:5px;background:rgba(255,255,255,0.04);border:1px solid rgba(200,150,62,0.15);border-radius:30px;padding:6px 14px;font-size:11px;color:rgba(253,246,236,0.5);letter-spacing:.5px;transition:all .3s;}
.pill:hover{background:rgba(200,150,62,0.1);border-color:rgba(200,150,62,0.4);color:var(--latte);}
.pill-num{width:18px;height:18px;border-radius:50%;background:rgba(200,150,62,0.2);color:var(--gold);font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;}

/* FEATURED STRIP */
.feat-strip{display:flex;gap:10px;justify-content:center;flex-wrap:nowrap;margin-top:clamp(6px,1.2vh,14px);opacity:0;animation:revUp .8s ease 1.25s forwards;overflow:hidden;max-width:100%;position:relative;z-index:5;}
.feat-chip{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.04);border:1px solid var(--border);border-radius:12px;padding:8px 14px;transition:all .35s cubic-bezier(.175,.885,.32,1.275);cursor:default;flex-shrink:0;position:relative;overflow:hidden;}
.feat-chip::before{content:'';position:absolute;inset:0;border-radius:12px;background:linear-gradient(135deg,rgba(200,150,62,0.12),transparent);opacity:0;transition:opacity .3s;}
.feat-chip:hover{border-color:rgba(200,150,62,0.55);transform:translateY(-4px) scale(1.03);box-shadow:0 14px 40px rgba(0,0,0,0.4);}
.feat-chip:hover::before{opacity:1;}
.feat-chip-badge{position:absolute;top:5px;right:5px;background:var(--gold);color:var(--ink);font-size:7px;font-weight:700;padding:2px 6px;border-radius:20px;letter-spacing:.5px;}
.fc-emoji{font-size:22px;flex-shrink:0;}.fc-info{text-align:left;}
.fc-name{font-size:11px;font-weight:600;color:var(--cream);line-height:1.2;}
.fc-price{font-family:'Cormorant Garamond',serif;font-size:15px;font-weight:700;color:var(--gold);}

/* INFO ROW */
.info-row{display:flex;gap:20px;justify-content:center;flex-wrap:wrap;margin-top:clamp(5px,1vh,12px);opacity:0;animation:revUp .7s ease 1.4s forwards;position:relative;z-index:5;}
.info-chip{display:flex;align-items:center;gap:6px;font-size:11px;color:rgba(253,246,236,0.35);letter-spacing:.5px;}
.info-chip strong{color:rgba(253,246,236,0.6);font-weight:600;}

/* TICKER */
.ticker-wrap{border-top:1px solid rgba(200,150,62,0.12);background:rgba(10,5,0,0.85);overflow:hidden;position:relative;z-index:10;}
.ticker-wrap::before,.ticker-wrap::after{content:'';position:absolute;top:0;bottom:0;width:100px;z-index:2;pointer-events:none;}
.ticker-wrap::before{left:0;background:linear-gradient(to right,rgba(10,5,0,0.95),transparent);}
.ticker-wrap::after{right:0;background:linear-gradient(to left,rgba(10,5,0,0.95),transparent);}
.ticker-inner{display:flex;align-items:center;white-space:nowrap;animation:ticker 32s linear infinite;padding:11px 0;}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.t-item{display:inline-flex;align-items:center;gap:7px;padding:0 30px;font-size:12px;letter-spacing:1px;color:rgba(253,246,236,0.38);border-right:1px solid rgba(200,150,62,0.1);}
.t-item:last-child{border:none;}.t-name{color:var(--latte);font-weight:600;}.t-price{color:var(--gold);font-weight:700;}.t-sep{color:rgba(200,150,62,0.3);}
</style>
</head>
<body>
<div class="curtain"></div>
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>
<canvas id="particleCanvas"></canvas>
<div class="ambient amb-1"></div>
<div class="ambient amb-2"></div>
<div class="ambient amb-3"></div>
<div class="steam-group" style="left:8%;bottom:60px;">
  <div class="steam-wisp" style="left:0;height:60px;--dur:3.5s;--delay:0s;--drift:8px;"></div>
  <div class="steam-wisp" style="left:12px;height:80px;--dur:4s;--delay:1.1s;--drift:-6px;"></div>
  <div class="steam-wisp" style="left:24px;height:50px;--dur:3s;--delay:2.2s;--drift:10px;"></div>
</div>
<div class="clock-badge"><div class="clock-time" id="clockTime">--:--</div><div class="clock-date" id="clockDate"></div></div>
<div class="wifi-badge"><span class="wifi-icon">📶</span><span class="wifi-text"><strong>Free WiFi</strong> · Kapitol Cafe (Pasword: 00000000)</span></div>

<div class="stage">
  <div class="center-panel">
    <!-- BIG CENTERED QR -->
    <div class="qr-center">
      <div class="qr-halo qr-halo-1"></div>
      <div class="qr-halo qr-halo-2"></div>
      <div class="qr-halo qr-halo-3"></div>
      <div class="qr-label-row">
        <div class="ql"></div>
        <span class="ql-text">📱 Scan to Order</span>
        <div class="ql r"></div>
      </div>
      <div class="qr-shine">
        <div class="scan-pulse"></div>
        <div class="scan-pulse"></div>
        <div class="scan-pulse"></div>
        <div class="qr-frame">
          <div class="qr-corners"></div>
          <div class="scan-line"></div>
          <div id="mainQR"></div>
          <div class="qr-logo-overlay">☕</div>
        </div>
      </div>
      <div class="qr-cta">
        <div class="qr-cta-main">Point your camera &amp; <em>tap!</em></div>
        <div class="qr-cta-sub">Choose your table · Browse the menu · Order</div>
      </div>
    </div>

    <!-- STEPS -->
    <div class="step-pills">
      <div class="pill"><span class="pill-num">1</span>Scan QR</div>
      <div class="pill"><span class="pill-num">2</span>Choose Table</div>
      <div class="pill"><span class="pill-num">3</span>Order</div>
      <div class="pill"><span class="pill-num">4</span>Enjoy ☕</div>
    </div>

    <!-- FEATURED -->
    <div class="feat-strip">
      <div class="feat-chip"><div class="feat-chip-badge">⭐</div><span class="fc-emoji">☕</span><div class="fc-info"><div class="fc-name">Kapitol Espresso</div><div class="fc-price">₱79</div></div></div>
      <div class="feat-chip"><div class="feat-chip-badge">🔥</div><span class="fc-emoji">🧊</span><div class="fc-info"><div class="fc-name">Cold Brew</div><div class="fc-price">₱140</div></div></div>
      <div class="feat-chip"><span class="fc-emoji">🧋</span><div class="fc-info"><div class="fc-name">Matcha Latte</div><div class="fc-price">₱130</div></div></div>
      <div class="feat-chip"><div class="feat-chip-badge">🍱</div><span class="fc-emoji">🍱</span><div class="fc-info"><div class="fc-name">Rice Bowl</div><div class="fc-price">₱185</div></div></div>
      <div class="feat-chip"><span class="fc-emoji">🥐</span><div class="fc-info"><div class="fc-name">Butter Croissant</div><div class="fc-price">₱65</div></div></div>
    </div>

    <!-- INFO -->
    <div class="info-row">
      <div class="info-chip">🕐 <span>Open <strong>7AM – 10PM</strong> Daily</span></div>
      <div class="info-chip">📍 <span>Dine-in &amp; <strong>Takeout</strong></span></div>
      <div class="info-chip">💳 <span>GCash &amp; <strong>Maya</strong> accepted</span></div>
    </div>

  </div>

  <!-- TICKER -->
  <div class="ticker-wrap"><div class="ticker-inner" id="tickerInner"></div></div>
</div>

<script>
const SITE_URL='http://192.168.137.1/kapitol_cafe';
new QRCode(document.getElementById('mainQR'),{text:SITE_URL+'/table_select.php',width:280,height:280,colorDark:'#1A0A00',colorLight:'#FFFDF8',correctLevel:QRCode.CorrectLevel.H});
function updateClock(){const n=new Date();document.getElementById('clockTime').textContent=n.toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit'});document.getElementById('clockDate').textContent=n.toLocaleDateString('en-PH',{weekday:'long',month:'long',day:'numeric',year:'numeric'});}
updateClock();setInterval(updateClock,1000);
const cur=document.getElementById('cursor'),ring=document.getElementById('cursorRing');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;});
(function aC(){cur.style.left=mx+'px';cur.style.top=my+'px';rx+=(mx-rx)*.12;ry+=(my-ry)*.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(aC);})();
document.querySelectorAll('.feat-chip,.pill').forEach(el=>{el.addEventListener('mouseenter',()=>{cur.style.width='20px';cur.style.height='20px';ring.style.width='56px';ring.style.height='56px';});el.addEventListener('mouseleave',()=>{cur.style.width='10px';cur.style.height='10px';ring.style.width='36px';ring.style.height='36px';});});
const canvas=document.getElementById('particleCanvas'),ctx=canvas.getContext('2d');
let W,H;
function rc(){W=canvas.width=window.innerWidth;H=canvas.height=window.innerHeight;}
rc();window.addEventListener('resize',rc);
const EM=['☕','✦','·','◦','⋆'];
class P{constructor(){this.reset(true);}reset(init=false){this.x=Math.random()*W;this.y=init?Math.random()*H:H+20;this.size=Math.random()*10+4;this.vy=-(Math.random()*.4+.1);this.vx=(Math.random()-.5)*.3;this.op=0;this.maxOp=Math.random()*.18+.04;this.fi=true;this.life=0;this.ml=Math.random()*300+200;this.em=EM[Math.floor(Math.random()*EM.length)];this.rot=Math.random()*Math.PI*2;this.rs=(Math.random()-.5)*.01;}
update(){this.life++;this.y+=this.vy;this.x+=this.vx;this.rot+=this.rs;if(this.fi){this.op=Math.min(this.op+.004,this.maxOp);if(this.op>=this.maxOp)this.fi=false;}else this.op-=.0008;if(this.op<=0||this.life>this.ml)this.reset();}
draw(){ctx.save();ctx.globalAlpha=this.op;ctx.translate(this.x,this.y);ctx.rotate(this.rot);ctx.font=this.size+'px serif';ctx.textAlign='center';ctx.textBaseline='middle';ctx.fillText(this.em,0,0);ctx.restore();}}
const parts=Array.from({length:60},()=>new P());
(function anim(){ctx.clearRect(0,0,W,H);parts.forEach(p=>{p.update();p.draw();});requestAnimationFrame(anim);})();
const ti=[{e:'☕',n:'Kapitol Espresso',p:'₱79'},{e:'🧊',n:'Cold Brew',p:'₱140'},{e:'🧋',n:'Matcha Latte',p:'₱130'},{e:'🍱',n:'Kapitol Rice Bowl',p:'₱185'},{e:'🥐',n:'Butter Croissant',p:'₱65'},{e:'🍟',n:'Nachos Supreme',p:'₱120'},{e:'☕',n:'Caramel Macchiato',p:'₱125'},{e:'🍱',n:'Club Sandwich Meal',p:'₱210'},{e:'⭐',n:'Open 7AM–10PM',p:'Daily'},{e:'📶',n:'Free WiFi',p:'KapitolCafe_Guest'}];
const inner=document.getElementById('tickerInner');
[...ti,...ti].forEach(t=>{const el=document.createElement('div');el.className='t-item';el.innerHTML=t.e+' <span class="t-name">'+t.n+'</span><span class="t-sep">·</span><span class="t-price">'+t.p+'</span>';inner.appendChild(el);});
</script>
</body>
</html>
