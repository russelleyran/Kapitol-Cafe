<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KAPITOL CAFE – QR Generator</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<style>
  :root{
    --espresso:#1A0A00;--brown:#3B1F0E;--gold:#C8963E;
    --cream:#FDF6EC;--foam:#F5ECD7;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:#F0E8D8;font-family:'DM Sans',sans-serif;padding:30px;}

  h1{
    font-family:'Playfair Display',serif;
    text-align:center;color:var(--espresso);
    font-size:32px;margin-bottom:8px;
  }
  .subtitle{text-align:center;color:#666;font-size:14px;margin-bottom:30px;}

  .controls{
    background:white;border-radius:16px;padding:20px;
    max-width:700px;margin:0 auto 30px;
    box-shadow:0 2px 20px rgba(0,0,0,0.08);
    display:flex;flex-wrap:wrap;gap:12px;align-items:center;
  }
  .ctrl-group{display:flex;flex-direction:column;gap:4px;flex:1;min-width:150px;}
  .ctrl-label{font-size:12px;color:#888;letter-spacing:1px;text-transform:uppercase;}
  .ctrl-input{
    padding:8px 12px;border:1.5px solid #ddd;border-radius:8px;
    font-family:inherit;font-size:14px;outline:none;
    transition:border-color 0.2s;
  }
  .ctrl-input:focus{border-color:var(--gold);}

  .btn{
    padding:10px 24px;border-radius:10px;border:none;
    cursor:pointer;font-weight:700;font-size:14px;
    transition:all 0.2s;
  }
  .btn-generate{background:var(--espresso);color:var(--gold);}
  .btn-generate:hover{background:var(--brown);}
  .btn-print{background:var(--gold);color:var(--espresso);}
  .btn-print:hover{filter:brightness(1.1);}

  /* ── EXTRA ANIMATIONS ── */

  /* Page entrance */
  @keyframes pageIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
  h1 { animation: pageIn .5s ease both; }
  .subtitle { animation: pageIn .5s ease .1s both; }
  .controls { animation: pageIn .5s ease .15s both; }

  /* QR card grid stagger */
  .qr-print-card {
    animation: cardPop .45s cubic-bezier(.175,.885,.32,1.275) both;
    transition: transform .3s cubic-bezier(.175,.885,.32,1.275), box-shadow .3s;
  }
  @keyframes cardPop { from{opacity:0;transform:scale(.85)} to{opacity:1;transform:scale(1)} }

  /* Card hover lift with glow */
  .qr-print-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 50px rgba(59,31,14,.2);
  }

  /* QR wrapper glow on hover */
  .card-qr {
    transition: box-shadow .3s ease;
  }
  .qr-print-card:hover .card-qr {
    box-shadow: 0 0 20px rgba(200,150,62,.35);
  }

  /* Buttons */
  .btn { position:relative; overflow:hidden; transition:all .2s; }
  .btn:active { transform:scale(.96); }
  .btn .ripple {
    position:absolute; border-radius:50%;
    background:rgba(255,255,255,.25);
    transform:scale(0);
    animation:rippleOut .45s ease-out forwards;
    pointer-events:none;
  }
  @keyframes rippleOut { to{transform:scale(5);opacity:0;} }

  /* Scan text pulse */
  .card-scan-text {
    animation: scanPulse 2s ease-in-out infinite;
  }
  @keyframes scanPulse { 0%,100%{opacity:.7} 50%{opacity:1} }

  /* Custom section */
  .custom-section { animation: pageIn .5s ease .3s both; }

  /* Custom QR card pop */
  #customQROutput .qr-print-card {
    animation: customCardIn .5s cubic-bezier(.175,.885,.32,1.275) both;
  }
  @keyframes customCardIn {
    from{opacity:0;transform:scale(.7) rotate(-3deg)} to{opacity:1;transform:scale(1) rotate(0)}
  }

  /* QR PRINT CARDS */
  .qr-print-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:20px;
    max-width:900px;margin:0 auto;
  }

  .qr-print-card{
    background:white;
    border-radius:16px;
    padding:20px;
    text-align:center;
    box-shadow:0 4px 20px rgba(0,0,0,0.1);
    transition:transform 0.3s;
    page-break-inside:avoid;
  }
  .qr-print-card:hover{transform:translateY(-4px);}

  .card-header{
    background:linear-gradient(135deg,var(--espresso),var(--brown));
    margin:-20px -20px 16px;
    padding:16px;
    border-radius:16px 16px 0 0;
  }
  .card-cafe-name{
    font-family:'Playfair Display',serif;
    color:var(--gold);font-size:16px;font-weight:900;
    letter-spacing:2px;
  }
  .card-logo{font-size:28px;margin-bottom:4px;}

  .card-qr{
    background:white;
    border-radius:10px;
    padding:10px;
    display:inline-block;
    margin-bottom:14px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
  }
  .card-table-num{
    font-family:'Playfair Display',serif;
    font-size:24px;color:var(--espresso);font-weight:900;
    margin-bottom:4px;
  }
  .card-scan-text{font-size:11px;color:#888;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;}
  .card-url{font-size:10px;color:#aaa;word-break:break-all;line-height:1.4;}

  .card-footer{
    margin:12px -20px -20px;
    padding:10px 16px;
    background:var(--foam);
    border-radius:0 0 16px 16px;
    font-size:11px;color:#888;
    letter-spacing:0.5px;
  }

  /* CUSTOM QR SECTION */
  .custom-section{
    max-width:700px;margin:30px auto 0;
    background:white;border-radius:16px;padding:24px;
    box-shadow:0 2px 20px rgba(0,0,0,0.08);
  }
  .custom-section h2{font-family:'Playfair Display',serif;color:var(--espresso);margin-bottom:16px;}
  .custom-input-row{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;}
  .custom-input{
    flex:1;min-width:200px;
    padding:10px 14px;border:1.5px solid #ddd;border-radius:10px;
    font-family:inherit;font-size:14px;outline:none;
  }
  .custom-input:focus{border-color:var(--gold);}
  #customQROutput{display:flex;justify-content:center;margin-top:16px;}

  @media print {
    body{background:white;padding:0;}
    .controls,.custom-section,.btn,.subtitle h1{display:none!important;}
    h1{display:none!important;}
    .qr-print-grid{grid-template-columns:repeat(3,1fr);gap:10px;max-width:100%;}
    .qr-print-card{box-shadow:none;border:1px solid #ddd;}
  }
</style>
</head>
<body>

<!-- ═══════════════════════════════════════ -->
<!-- KAPITOL CAFE SPLASH LOADER             -->
<!-- ═══════════════════════════════════════ -->
<div id="splashLoader" style="position:fixed;inset:0;z-index:99999;background:linear-gradient(160deg,#0D0600,#1A0A00,#2A1206);display:flex;flex-direction:column;align-items:center;justify-content:center;font-family:'DM Sans',sans-serif;transition:opacity .55s ease,transform .55s ease;">
  <canvas id="splashCanvas" style="position:absolute;inset:0;pointer-events:none;"></canvas>
  <div style="position:relative;z-index:10;text-align:center;padding:0 20px;">
    <div style="font-size:72px;margin-bottom:16px;filter:drop-shadow(0 0 30px rgba(200,150,62,.7));animation:splashCupFloat 2s ease-in-out infinite;">☕</div>
    <div style="font-family:'Playfair Display',serif;color:#C8963E;font-size:26px;font-weight:900;letter-spacing:4px;margin-bottom:4px;text-shadow:0 0 40px rgba(200,150,62,.4);">KAPITOL CAFE</div>
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">QR Generator</div>
    <div style="width:220px;height:3px;background:rgba(200,150,62,.12);border-radius:10px;overflow:hidden;margin:0 auto 14px;box-shadow:inset 0 0 8px rgba(0,0,0,.3);">
      <div id="splashBar" style="height:100%;width:0%;background:linear-gradient(90deg,#C8963E,#E5B96A,#C8963E);background-size:200%;border-radius:10px;transition:width .12s ease;box-shadow:0 0 10px rgba(200,150,62,.6);animation:splashBarShimmer 1.5s linear infinite;"></div>
    </div>
    <div id="splashMsg" style="font-size:12px;color:rgba(253,246,236,.3);letter-spacing:1px;min-height:18px;transition:opacity .3s;">Brewing your experience...</div>
    <!-- Steam wisps -->
    <div style="position:absolute;top:-80px;left:50%;transform:translateX(-50%);display:flex;gap:8px;pointer-events:none;">
      <div style="width:3px;height:40px;background:linear-gradient(to top,rgba(255,255,255,.12),transparent);border-radius:50%;animation:splashSteam1 2.5s ease-in-out infinite;"></div>
      <div style="width:3px;height:55px;background:linear-gradient(to top,rgba(255,255,255,.1),transparent);border-radius:50%;animation:splashSteam2 2.8s ease-in-out infinite .4s;"></div>
      <div style="width:3px;height:35px;background:linear-gradient(to top,rgba(255,255,255,.08),transparent);border-radius:50%;animation:splashSteam1 2.2s ease-in-out infinite .9s;"></div>
    </div>
  </div>
</div>
<style>
@keyframes splashCupFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes splashBarShimmer{0%{background-position:200%}100%{background-position:-200%}}
@keyframes splashSteam1{0%{transform:translateY(0) scaleX(1) rotate(0);opacity:0}15%{opacity:.7}70%{opacity:.3;transform:translateY(-50px) scaleX(2.5) rotate(5deg)}100%{transform:translateY(-80px) scaleX(3) rotate(10deg);opacity:0}}
@keyframes splashSteam2{0%{transform:translateY(0) scaleX(1);opacity:0}15%{opacity:.5}70%{opacity:.2;transform:translateY(-60px) scaleX(2) rotate(-5deg)}100%{transform:translateY(-90px) scaleX(2.5);opacity:0}}
</style>
<script>
(function(){
  var canvas=document.getElementById('splashCanvas'),ctx=canvas.getContext('2d');
  canvas.width=window.innerWidth;canvas.height=window.innerHeight;
  var emojis=['☕','✦','·','⋆','✧','◦'];
  var particles=Array.from({length:28},function(){return{x:Math.random()*canvas.width,y:Math.random()*canvas.height+canvas.height*0.5,em:emojis[Math.floor(Math.random()*emojis.length)],size:Math.random()*12+5,speed:Math.random()*.35+.12,op:Math.random()*.14+.03,drift:(Math.random()-.5)*.25};});
  var animRunning=true;
  (function draw(){if(!animRunning)return;ctx.clearRect(0,0,canvas.width,canvas.height);particles.forEach(function(p){ctx.globalAlpha=p.op;ctx.font=p.size+'px serif';ctx.fillText(p.em,p.x,p.y);p.y-=p.speed;p.x+=p.drift;if(p.y<-20){p.y=canvas.height+20;p.x=Math.random()*canvas.width;}});requestAnimationFrame(draw);})();
  var bar=document.getElementById('splashBar');
  var msgEl=document.getElementById('splashMsg');
  var subtitleEl=document.getElementById('splashSubtitle');
  var msgs=['Generating QR codes...', 'Building print layout...', 'Almost ready...', 'QR codes ready! 🔲'];
  var startTime=Date.now();
  var minDuration=3000;
  var interval=setInterval(function(){
    var elapsed=Date.now()-startTime;
    var pct=Math.min((elapsed/minDuration)*88,88);
    bar.style.width=pct+'%';
    var mi=Math.min(Math.floor((pct/100)*msgs.length),msgs.length-1);
    msgEl.textContent=msgs[mi];
  },80);
  window._splashReady=false;
  window._hideSplash=function(){
    if(window._splashReady)return;
    var elapsed=Date.now()-startTime;
    var wait=Math.max(0,minDuration-elapsed);
    setTimeout(function(){
      window._splashReady=true;
      clearInterval(interval);
      animRunning=false;
      bar.style.transition='width .4s ease';
      bar.style.width='100%';
      msgEl.textContent='Welcome to Kapitol Cafe! ☕';
      setTimeout(function(){
        var el=document.getElementById('splashLoader');
        if(el){el.style.opacity='0';el.style.transform='scale(1.04)';setTimeout(function(){if(el.parentNode)el.parentNode.removeChild(el);},540);}
      },320);
    },wait);
  };
})();
</script>

<h1>☕ QR Code Generator</h1>
<p class="subtitle">Generate and print QR codes for all tables — Kapitol Cafe</p>

<div class="controls">
  <div class="ctrl-group">
    <label class="ctrl-label">Base URL</label>
    <input class="ctrl-input" type="text" id="baseUrl" value="http://192.168.137.1/kapitol_cafe/menu.php" style="min-width:260px">
  </div>
  <div class="ctrl-group">
    <label class="ctrl-label">QR Size (px)</label>
    <input class="ctrl-input" type="number" id="qrSize" value="150" min="80" max="300">
  </div>
  <button class="btn btn-generate" onclick="generateAll()">⟳ Regenerate</button>
  <button class="btn btn-print" onclick="window.print()">🖨️ Print All</button>
</div>

<div class="qr-print-grid" id="qrPrintGrid"></div>

<!-- CUSTOM QR GENERATOR -->
<div class="custom-section">
  <h2>🔧 Custom QR Code</h2>
  <div class="custom-input-row">
    <input class="custom-input" type="text" id="customText" placeholder="Enter any text or URL to generate QR...">
    <input class="custom-input" type="text" id="customLabel" placeholder="Label (e.g. 'Special Event')">
    <button class="btn btn-generate" onclick="generateCustom()">Generate</button>
  </div>
  <div id="customQROutput"></div>
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';

const tables = [
  {table:'T01',token:'table_t01_k4pit0l_2024',seats:4,label:'Table 1'},
  {table:'T02',token:'table_t02_k4pit0l_2024',seats:4,label:'Table 2'},
  {table:'T03',token:'table_t03_k4pit0l_2024',seats:6,label:'Table 3'},
  {table:'T04',token:'table_t04_k4pit0l_2024',seats:2,label:'Table 4'},
  {table:'T05',token:'table_t05_k4pit0l_2024',seats:8,label:'Table 5'},
  {table:'BAR',token:'table_bar_k4pit0l_2024',seats:3,label:'Bar Counter'},
  {table:'WIFI',token:'',seats:0,label:'WiFi / General Menu',isWifi:true},
];

function generateAll(){
  const baseUrl = document.getElementById('baseUrl').value;
  const size = parseInt(document.getElementById('qrSize').value) || 150;
  const grid = document.getElementById('qrPrintGrid');
  grid.innerHTML='';

  tables.forEach((t,i) => {
    const url = t.isWifi ? baseUrl : `${baseUrl}?table=${t.table}&token=${t.token}`;

    const card = document.createElement('div');
    card.className='qr-print-card';
    card.innerHTML = `
      <div class="card-header">
        <div class="card-logo">☕</div>
        <div class="card-cafe-name">KAPITOL CAFE</div>
      </div>
      <div class="card-qr" id="qr-print-${t.table}"></div>
      <div class="card-table-num">${t.label}</div>
      <div class="card-scan-text">📱 Scan to Order</div>
      <div class="card-url">${url}</div>
      <div class="card-footer">${t.isWifi?'🌐 General Menu Access':`👥 ${t.seats} Seats`}</div>
    `;
    card.style.animationDelay = (i * 0.06) + 's';
    grid.appendChild(card);

    // Delay to ensure DOM is ready
    setTimeout(()=>{
      new QRCode(document.getElementById(`qr-print-${t.table}`), {
        text: url,
        width: size, height: size,
        colorDark: '#3B1F0E',
        colorLight: '#FFFFFF',
        correctLevel: QRCode.CorrectLevel.H
      });
    }, i * 50);
  });
}

function generateCustom(){
  const text = document.getElementById('customText').value.trim();
  const label = document.getElementById('customLabel').value.trim() || 'Custom QR';
  if(!text) return;

  const out = document.getElementById('customQROutput');
  out.innerHTML=`
    <div class="qr-print-card" style="max-width:220px">
      <div class="card-header">
        <div class="card-logo">☕</div>
        <div class="card-cafe-name">KAPITOL CAFE</div>
      </div>
      <div class="card-qr" id="customQRDiv"></div>
      <div class="card-table-num" style="font-size:16px">${label}</div>
      <div class="card-url">${text}</div>
    </div>
  `;
  new QRCode(document.getElementById('customQRDiv'), {
    text: text, width:180, height:180,
    colorDark:'#3B1F0E', colorLight:'#FFFFFF',
    correctLevel: QRCode.CorrectLevel.H
  });
}

generateAll();
setTimeout(function(){ if(window._hideSplash) window._hideSplash(); }, 500);

// Button ripples
document.querySelectorAll('.btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    const r = document.createElement('span');
    r.className = 'ripple';
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;`;
    btn.appendChild(r);
    setTimeout(()=>r.remove(), 500);
  });
});
</script>
</body>
</html>
