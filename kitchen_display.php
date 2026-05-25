<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KAPITOL CAFE – Kitchen Display</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#0A0500;--card:#160B02;--border:rgba(200,150,62,0.25);
    --gold:#C8963E;--gold-light:#E5B96A;--cream:#FDF6EC;
    --green:#4CAF50;--orange:#FF9800;--red:#F44336;--blue:#2196F3;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:var(--bg);font-family:'DM Sans',sans-serif;color:var(--cream);min-height:100vh;overflow-x:hidden;}

  /* HEADER */
  header {
    background:rgba(22,11,2,0.9);
    border-bottom:2px solid var(--gold);
    padding:16px 30px;
    display:flex;align-items:center;justify-content:space-between;
    position:sticky;top:0;z-index:50;
    backdrop-filter:blur(10px);
  }
  .header-brand{display:flex;align-items:center;gap:12px;}
  .header-logo{font-size:36px;}
  .header-title{font-family:'Playfair Display',serif;color:var(--gold);font-size:26px;font-weight:900;letter-spacing:3px;}
  .header-sub{font-size:11px;color:rgba(253,246,236,0.5);letter-spacing:3px;text-transform:uppercase;}
  .header-right{text-align:right;}
  .live-badge{
    display:inline-flex;align-items:center;gap:6px;
    background:rgba(76,175,80,0.15);border:1px solid rgba(76,175,80,0.4);
    color:#81C784;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:700;
    letter-spacing:1px;margin-bottom:4px;
  }
  .live-dot{width:8px;height:8px;background:#4CAF50;border-radius:50%;animation:blink 1s infinite;}
  @keyframes blink{0%,100%{opacity:1}50%{opacity:0.2}}
  .header-time{color:rgba(253,246,236,0.5);font-size:13px;}

  /* COLUMN LAYOUT */
  .kitchen-columns {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:0;
    min-height:calc(100vh - 80px);
  }

  .column {
    border-right:1px solid var(--border);
    padding:20px 16px;
  }
  .column:last-child{border-right:none;}

  .col-header {
    display:flex;align-items:center;gap:10px;
    margin-bottom:20px;
    padding-bottom:14px;
    border-bottom:1px solid var(--border);
  }
  .col-icon{font-size:28px;}
  .col-title{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;}
  .col-count{
    margin-left:auto;
    background:var(--gold);color:var(--bg);
    font-size:14px;font-weight:900;
    width:32px;height:32px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
  }

  /* ORDER CARDS */
  .order-card {
    background:var(--card);
    border:1px solid var(--border);
    border-radius:14px;
    margin-bottom:14px;
    overflow:hidden;
    transition:all 0.3s;
    animation:slideUp 0.5s ease;
    position:relative;
  }
  @keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  .order-card:hover{border-color:rgba(200,150,62,0.5);transform:translateY(-2px);}

  /* Color-coded by urgency */
  .order-card.urgent { border-left:4px solid var(--red); }
  .order-card.normal { border-left:4px solid var(--orange); }
  .order-card.new { border-left:4px solid var(--blue); }
  .order-card.done { border-left:4px solid var(--green); }

  .oc-header{
    padding:12px 14px;
    display:flex;align-items:center;justify-content:space-between;
    background:rgba(255,255,255,0.03);
  }
  .oc-code{font-weight:900;color:var(--gold);font-size:16px;letter-spacing:1px;}
  .oc-meta{font-size:12px;color:rgba(253,246,236,0.5);}
  .oc-timer{
    font-size:18px;font-weight:900;
    padding:4px 10px;border-radius:8px;
  }
  .oc-timer.ok{color:var(--green);}
  .oc-timer.warn{color:var(--orange);}
  .oc-timer.danger{color:var(--red);animation:flashRed 1s infinite;}
  @keyframes flashRed{0%,100%{opacity:1}50%{opacity:0.4}}

  .oc-items{padding:10px 14px;}
  .oc-item{
    display:flex;align-items:center;gap:10px;
    padding:7px 0;
    border-bottom:1px solid rgba(255,255,255,0.05);
    font-size:14px;
  }
  .oc-item:last-child{border-bottom:none;}
  .oc-item.done-item{opacity:0.4;text-decoration:line-through;}
  .oc-qty{
    background:var(--gold);color:var(--bg);
    width:26px;height:26px;border-radius:6px;
    display:flex;align-items:center;justify-content:center;
    font-weight:900;font-size:13px;flex-shrink:0;
  }
  .item-check{
    margin-left:auto;
    width:22px;height:22px;
    border:2px solid rgba(255,255,255,0.2);
    border-radius:50%;
    cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    transition:all 0.2s;
  }
  .item-check.checked{background:var(--green);border-color:var(--green);}
  .item-check:hover{border-color:var(--green);}

  .oc-actions{
    padding:10px 14px;
    display:flex;gap:8px;
    background:rgba(255,255,255,0.02);
    border-top:1px solid var(--border);
  }
  .oc-btn{
    flex:1;padding:8px;border-radius:8px;border:1px solid;
    font-size:12px;font-weight:700;cursor:pointer;
    transition:all 0.2s;letter-spacing:0.5px;
  }
  .oc-btn:hover{transform:scale(1.03);}
  .btn-start{border-color:var(--orange);color:var(--orange);background:rgba(255,152,0,0.1);}
  .btn-done{border-color:var(--green);color:var(--green);background:rgba(76,175,80,0.1);}
  .btn-done:hover{background:rgba(76,175,80,0.25);}

  .takeout-tag {
    display:inline-flex; align-items:center; gap:4px;
    background:rgba(200,150,62,0.2);
    border:1px solid rgba(200,150,62,0.5);
    color:var(--gold-light);
    font-size:11px; font-weight:700;
    padding:2px 8px; border-radius:10px;
    letter-spacing:.5px;
    margin-left:6px;
  }

  .empty-col{
    text-align:center;padding:40px 20px;
    color:rgba(253,246,236,0.2);
  }
  .empty-col-icon{font-size:48px;margin-bottom:8px;opacity:0.3;}

  /* ── EXTRA ANIMATIONS ── */

  /* Page entrance */
  .kitchen-columns { animation: pageIn .5s ease both; }
  @keyframes pageIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }

  /* Header entrance */
  header { animation: headerIn .45s cubic-bezier(.22,.68,0,1.2) both; }
  @keyframes headerIn { from{transform:translateY(-100%);opacity:0} to{transform:translateY(0);opacity:1} }

  /* Order card stagger entrance */
  .order-card {
    animation: cardIn .45s cubic-bezier(.175,.885,.32,1.275) both;
  }
  @keyframes cardIn {
    from{ opacity:0; transform:scale(.92) translateY(18px); }
    to  { opacity:1; transform:scale(1)   translateY(0); }
  }

  /* Urgent card border pulse */
  .order-card.urgent {
    animation: cardIn .45s cubic-bezier(.175,.885,.32,1.275) both,
               urgentPulse 2s ease-in-out infinite .5s;
  }
  @keyframes urgentPulse {
    0%,100%{ border-left-color:var(--red); box-shadow:none; }
    50%    { border-left-color:#ff6b6b; box-shadow:-4px 0 20px rgba(244,67,54,.4); }
  }

  /* Column count badge pop on change */
  .col-count {
    transition: transform .3s cubic-bezier(.175,.885,.32,1.275), background .3s;
  }
  .col-count.changed {
    animation: countPop .4s cubic-bezier(.175,.885,.32,1.275);
  }
  @keyframes countPop {
    0%  { transform:scale(1); }
    50% { transform:scale(1.4); background:#fff; color:#1A0A00; }
    100%{ transform:scale(1); }
  }

  /* Item check ✓ animation */
  .item-check.checked {
    animation: checkPop .3s cubic-bezier(.175,.885,.32,1.275);
  }
  @keyframes checkPop {
    0%  { transform:scale(0); }
    70% { transform:scale(1.25); }
    100%{ transform:scale(1); }
  }

  /* Action buttons hover lift */
  .oc-btn {
    transition: all .2s cubic-bezier(.175,.885,.32,1.275);
  }
  .oc-btn:active { transform:scale(.94) !important; }

  /* Timer danger extra flash */
  .oc-timer.danger {
    animation: flashRed 1s infinite, shake .5s ease-in-out infinite 2s;
  }
  @keyframes shake {
    0%,100%{ transform:translateX(0); }
    25%    { transform:translateX(-3px); }
    75%    { transform:translateX(3px); }
  }

  /* Ready banner drop */
  .ready-banner.show {
    animation: dropIn .5s cubic-bezier(.175,.885,.32,1.275);
  }
  @keyframes dropIn {
    from{ opacity:0; transform:translateX(-50%) translateY(-30px) scale(.9); }
    to  { opacity:1; transform:translateX(-50%) translateY(0)      scale(1); }
  }

  /* New order column highlight flash */
  .column.highlight {
    animation: colFlash .6s ease;
  }
  @keyframes colFlash {
    0%,100%{ background:transparent; }
    50%    { background:rgba(33,150,243,.06); }
  }

  /* Stats bar numbers */
  .stats-bar span { transition:all .3s ease; display:inline-block; }
  .stats-bar span.pop { animation: numPop .35s cubic-bezier(.175,.885,.32,1.275); }
  @keyframes numPop { 0%{transform:scale(1)} 50%{transform:scale(1.5);color:#fff} 100%{transform:scale(1)} }

  /* Clock smooth tick */
  #clockDisplay { transition:opacity .1s; }

  /* READY NOTIFICATION BANNER */
  .ready-banner {
    display:none;
    position:fixed;top:80px;left:50%;transform:translateX(-50%);
    background:rgba(76,175,80,0.95);
    color:white;
    padding:16px 32px;
    border-radius:16px;
    font-size:18px;font-weight:700;
    z-index:200;
    animation:dropIn 0.5s cubic-bezier(0.175,0.885,0.32,1.275);
    box-shadow:0 10px 40px rgba(0,0,0,0.4);
  }
  .ready-banner.show{display:block;}
  @keyframes dropIn{from{opacity:0;transform:translateX(-50%) translateY(-30px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}

  /* TICKER */
  .stats-bar{
    background:rgba(200,150,62,0.08);
    border-top:1px solid var(--border);
    padding:10px 20px;
    display:flex;gap:40px;
    font-size:13px;color:rgba(253,246,236,0.6);
  }
  .stats-bar span{color:var(--gold);font-weight:700;}
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">Kitchen Display</div>
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
  var msgs=['Connecting to kitchen...', 'Loading orders...', 'Almost ready...', 'Kitchen display live! 🍳'];
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

<header>
  <div class="header-brand">
    <div class="header-logo">🍳</div>
    <div>
      <div class="header-title">KITCHEN DISPLAY</div>
      <div class="header-sub">Kapitol Cafe · Live Orders</div>
    </div>
  </div>
  <div class="header-right">
    <div class="live-badge"><span class="live-dot"></span>LIVE</div>
    <div class="header-time" id="clockDisplay">–</div>
  </div>
</header>

<div class="ready-banner" id="readyBanner"></div>

<div class="kitchen-columns">
  <!-- INCOMING -->
  <div class="column">
    <div class="col-header">
      <span class="col-icon">📥</span>
      <span class="col-title">Incoming</span>
      <span class="col-count" id="incomingCount">0</span>
    </div>
    <div id="incomingOrders"></div>
  </div>

  <!-- PREPARING -->
  <div class="column">
    <div class="col-header">
      <span class="col-icon">🔥</span>
      <span class="col-title" style="color:#FF9800">Preparing</span>
      <span class="col-count" id="preparingCount">0</span>
    </div>
    <div id="preparingOrders"></div>
  </div>

  <!-- READY -->
  <div class="column">
    <div class="col-header">
      <span class="col-icon">✅</span>
      <span class="col-title" style="color:#4CAF50">Ready</span>
      <span class="col-count" id="readyCount">0</span>
    </div>
    <div id="readyOrders"></div>
  </div>
</div>

<div class="stats-bar">
  <div>Active: <span id="sbActive">0</span></div>
  <div>Ready to Serve: <span id="sbReady">0</span></div>
  <div>Completed Today: <span id="sbDone">0</span></div>
  <div>Auto-refresh: <span>every 10s</span></div>
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';
let orders = [];
let itemChecked = {};
let timers = {};

function getDemoOrders(){
  return [
    {id:1,order_code:'KAP-A1B2C3',table_number:'T01',customer_name:'Maria',
     items:[{name:'Iced Latte',quantity:2},{name:'Butter Croissant',quantity:1}],
     status:'confirmed',created_at:new Date(Date.now()-5*60000).toISOString()},
    {id:2,order_code:'KAP-D4E5F6',table_number:'T03',customer_name:'Juan',
     items:[{name:'Cold Brew',quantity:1},{name:'Nachos Supreme',quantity:2}],
     status:'preparing',created_at:new Date(Date.now()-15*60000).toISOString()},
    {id:3,order_code:'KAP-G7H8I9',table_number:'T02',customer_name:'Ana',
     items:[{name:'Cappuccino',quantity:3},{name:'Club Sandwich Meal',quantity:1}],
     status:'ready',created_at:new Date(Date.now()-25*60000).toISOString()},
    {id:4,order_code:'KAP-J1K2L3',table_number:'BAR',customer_name:'Pedro',
     items:[{name:'Matcha Latte',quantity:1},{name:'Cheese Danish',quantity:2}],
     status:'confirmed',created_at:new Date(Date.now()-2*60000).toISOString()},
  ];
}

async function loadOrders(){
  try{
    const res = await fetch(`${SITE_URL}/api/api.php?action=get_orders`);
    const data = await res.json();
    // Need full items per order
    orders = data.data || [];
  } catch(e){
    orders = getDemoOrders();
  }
  renderAll();
  if(window._hideSplash) window._hideSplash();
}

function getMinutes(dateStr){
  return Math.floor((Date.now()-new Date(dateStr))/60000);
}

function formatTimer(mins){
  if(mins<1) return '<1m';
  if(mins<60) return mins+'m';
  return Math.floor(mins/60)+'h '+( mins%60)+'m';
}

function timerClass(mins){
  if(mins<8) return 'ok';
  if(mins<15) return 'warn';
  return 'danger';
}

function urgencyClass(mins){
  if(mins<5) return 'new';
  if(mins<15) return 'normal';
  return 'urgent';
}

function renderOrderCard(o, showActions, idx=0){
  const mins = getMinutes(o.created_at);
  const tc = timerClass(mins);
  const uc = urgencyClass(mins);
  const items = o.items || (o.items_summary||'').split(', ').map(s=>{
    const m=s.match(/^(\d+)x (.+)$/);
    return m?{quantity:parseInt(m[1]),name:m[2]}:{quantity:1,name:s};
  });

  const itemsHtml = items.map((item,i)=>{
    const key = `${o.id}-${i}`;
    const checked = itemChecked[key];
    return `<div class="oc-item ${checked?'done-item':''}">
      <span class="oc-qty">${item.quantity}</span>
      <span>${item.name}</span>
      <span class="item-check ${checked?'checked':''}" onclick="toggleItem('${key}', this)">
        ${checked?'✓':''}
      </span>
    </div>`;
  }).join('');

  let actionBtns = '';
  if(o.status==='confirmed') actionBtns=`<button class="oc-btn btn-start" onclick="updateStatus(${o.id},'preparing')">🔥 START COOKING</button>`;
  if(o.status==='preparing') actionBtns=`<button class="oc-btn btn-done" onclick="updateStatus(${o.id},'ready')">✅ MARK READY</button>`;

  return `<div class="order-card ${uc}" style="animation-delay:${idx*0.07}s">
    <div class="oc-header">
      <div>
        <div class="oc-code">${o.order_code}</div>
        <div class="oc-meta">
          ${o.order_type === 'takeout' ? 'Table –' : 'Table ' + o.table_number} · ${o.customer_name||'Guest'}
          ${o.order_type === 'takeout' ? '<span class="takeout-tag">🥡 TAKE OUT</span>' : ''}
        </div>
      </div>
      <div class="oc-timer ${tc}">${formatTimer(mins)}</div>
    </div>
    <div class="oc-items">${itemsHtml}</div>
    ${showActions?`<div class="oc-actions">${actionBtns}</div>`:''}
  </div>`;
}

function renderAll(){
  const incoming = orders.filter(o=>o.status==='confirmed');
  const preparing = orders.filter(o=>o.status==='preparing');
  const ready = orders.filter(o=>o.status==='ready');

  // Animate count badges when value changes
  const animateCount = (id, newVal) => {
    const el = document.getElementById(id);
    const old = el.textContent;
    el.textContent = newVal;
    if (old !== String(newVal)) {
      el.classList.remove('changed');
      requestAnimationFrame(() => {
        requestAnimationFrame(() => el.classList.add('changed'));
      });
      setTimeout(() => el.classList.remove('changed'), 450);
    }
  };
  animateCount('incomingCount', incoming.length);
  animateCount('preparingCount', preparing.length);
  animateCount('readyCount', ready.length);

  document.getElementById('incomingOrders').innerHTML =
    incoming.length ? incoming.map((o,i)=>renderOrderCard(o,true,i)).join('') :
    '<div class="empty-col"><div class="empty-col-icon">📭</div><p>No incoming orders</p></div>';

  document.getElementById('preparingOrders').innerHTML =
    preparing.length ? preparing.map((o,i)=>renderOrderCard(o,true,i)).join('') :
    '<div class="empty-col"><div class="empty-col-icon">😴</div><p>Nothing cooking yet</p></div>';

  document.getElementById('readyOrders').innerHTML =
    ready.length ? ready.map((o,i)=>renderOrderCard(o,false,i)).join('') :
    '<div class="empty-col"><div class="empty-col-icon">⏳</div><p>None ready yet</p></div>';

  // Animate stats
  const animateStat = (id, val) => {
    const el = document.getElementById(id);
    el.textContent = val;
    el.classList.remove('pop');
    requestAnimationFrame(()=>{ requestAnimationFrame(()=>el.classList.add('pop')); });
    setTimeout(()=>el.classList.remove('pop'),400);
  };
  animateStat('sbActive', incoming.length + preparing.length);
  animateStat('sbReady', ready.length);
}

function toggleItem(key, el){
  itemChecked[key] = !itemChecked[key];
  el.classList.toggle('checked');
  el.textContent = itemChecked[key]?'✓':'';
  el.closest('.oc-item').classList.toggle('done-item');
}

async function updateStatus(id, status){
  try{
    await fetch(`${SITE_URL}/api/api.php?action=update_status`,{
      method:'POST',headers:{'Content-Type':'application/json'},
      body:JSON.stringify({order_id:id,status})
    });
  } catch(e){}
  const o = orders.find(x=>x.id===id);
  if(o){
    o.status=status;
    if(status==='ready'){
      showReadyBanner(`🔔 Order ${o.order_code} – Table ${o.table_number} is READY!`);
    }
  }
  renderAll();
}

function showReadyBanner(msg){
  const b = document.getElementById('readyBanner');
  b.textContent = msg;
  b.classList.add('show');
  setTimeout(()=>b.classList.remove('show'),5000);
}

function updateClock(){
  const now = new Date();
  document.getElementById('clockDisplay').textContent =
    now.toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit',second:'2-digit'}) +
    ' · ' + now.toLocaleDateString('en-PH',{weekday:'long',month:'long',day:'numeric'});
}

loadOrders();
updateClock();
setInterval(updateClock, 1000);
setInterval(loadOrders, 10000);
</script>
</body>
</html>
