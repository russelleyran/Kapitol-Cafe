<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>KAPITOL CAFE – Choose Your Table</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --espresso: #1A0A00;
    --brown:    #3B1F0E;
    --gold:     #C8963E;
    --gold-lt:  #E5B96A;
    --cream:    #FDF6EC;
    --foam:     #F5ECD7;
    --green:    #2E7D32;
    --green-lt: #4CAF50;
    --red:      #C62828;
    --red-lt:   #EF5350;
    --gray:     #888;
  }
  * { margin:0; padding:0; box-sizing:border-box; -webkit-tap-highlight-color:transparent; }
  html, body { min-height:100vh; background:#F7F0E6; font-family:'DM Sans',sans-serif; }

  /* ── HEADER ── */
  .header {
    background: var(--espresso);
    padding: 18px 20px 16px;
    text-align: center;
    position: sticky; top:0; z-index:100;
    box-shadow: 0 4px 24px rgba(0,0,0,0.35);
  }
  .header-logo { font-size:26px; }
  .header-name {
    font-family:'Playfair Display',serif;
    color: var(--gold);
    font-size: 20px;
    font-weight: 900;
    letter-spacing: 3px;
    display: inline;
    margin-left: 8px;
  }
  .header-sub {
    color: rgba(253,246,236,0.45);
    font-size: 11px;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-top: 4px;
  }

  /* ── PAGE BODY ── */
  .page-body { padding: 24px 16px 100px; max-width: 480px; margin: 0 auto; }

  /* ── INTRO ── */
  .intro-box {
    background: var(--espresso);
    border-radius: 20px;
    padding: 20px 20px 18px;
    margin-bottom: 22px;
    text-align: center;
    animation: fadeDown .5s ease;
  }
  @keyframes fadeDown { from{opacity:0;transform:translateY(-16px)} to{opacity:1;transform:translateY(0)} }
  .intro-title {
    font-family:'Playfair Display',serif;
    color: var(--gold);
    font-size: 22px;
    margin-bottom: 6px;
  }
  .intro-sub { color:rgba(253,246,236,0.55); font-size:13px; line-height:1.55; }

  /* ── LEGEND ── */
  .legend {
    display: flex; gap: 14px; justify-content: center;
    margin-bottom: 18px;
    animation: fadeUp .5s ease .1s both;
  }
  .legend-item {
    display: flex; align-items:center; gap:6px;
    font-size: 12px; color:#666; font-weight:500;
  }
  .legend-dot {
    width:12px; height:12px; border-radius:50%;
    flex-shrink:0;
  }
  .dot-available { background: var(--green-lt); }
  .dot-occupied  { background: var(--red-lt); }

  /* ── TABLE GRID ── */
  .tables-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    animation: fadeUp .5s ease .15s both;
  }
  @keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }

  /* ── TABLE CARD ── */
  .table-card {
    background: white;
    border-radius: 20px;
    padding: 20px 14px 16px;
    text-align: center;
    cursor: pointer;
    border: 2.5px solid transparent;
    box-shadow: 0 2px 14px rgba(0,0,0,0.07);
    transition: all .3s cubic-bezier(.175,.885,.32,1.275);
    position: relative;
    overflow: hidden;
    animation: popIn .4s ease both;
  }
  @keyframes popIn { from{opacity:0;transform:scale(.88)} to{opacity:1;transform:scale(1)} }

  .table-card.available {
    border-color: rgba(76,175,80,0.3);
  }
  .table-card.available:hover, .table-card.available:active {
    border-color: var(--green-lt);
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 14px 40px rgba(46,125,50,0.18);
  }
  .table-card.occupied {
    border-color: rgba(239,83,80,0.2);
    opacity: .75;
    cursor: default;
  }
  .table-card.occupied:hover { transform: none; box-shadow: 0 2px 14px rgba(0,0,0,0.07); }

  /* status stripe at top */
  .table-card::before {
    content:'';
    position:absolute; top:0; left:0; right:0;
    height: 5px;
    border-radius: 20px 20px 0 0;
  }
  .table-card.available::before { background: linear-gradient(90deg, var(--green), var(--green-lt)); }
  .table-card.occupied::before  { background: linear-gradient(90deg, var(--red), var(--red-lt)); }

  .table-icon { font-size:38px; margin-bottom:8px; display:block; }
  .table-num {
    font-family:'Playfair Display',serif;
    font-size:22px; font-weight:900;
    color: var(--espresso);
    margin-bottom:4px;
  }
  .seats-txt { font-size:12px; color:#aaa; margin-bottom:10px; }

  .status-badge {
    display: inline-flex; align-items:center; gap:5px;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 12px; font-weight: 700;
    letter-spacing:.5px;
  }
  .badge-available {
    background: rgba(76,175,80,0.12);
    border: 1.5px solid rgba(76,175,80,0.4);
    color: var(--green);
  }
  .badge-occupied {
    background: rgba(239,83,80,0.1);
    border: 1.5px solid rgba(239,83,80,0.3);
    color: var(--red-lt);
  }
  .status-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
  }
  .dot-av { background: var(--green-lt); animation: blink 1.4s infinite; }
  .dot-oc { background: var(--red-lt); }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }

  /* ── CONFIRM MODAL ── */
  .modal-overlay {
    display:none; position:fixed; inset:0;
    background:rgba(0,0,0,0.55);
    z-index:300;
    backdrop-filter:blur(4px);
    align-items:flex-end; justify-content:center;
  }
  .modal-overlay.show { display:flex; animation:fadeIn .25s ease; }
  @keyframes fadeIn{from{opacity:0}to{opacity:1}}
  .modal-box {
    background:white;
    border-radius:28px 28px 0 0;
    width:100%; max-width:480px;
    padding:28px 24px 36px;
    animation:slideUp .35s cubic-bezier(.175,.885,.32,1.275);
  }
  @keyframes slideUp{from{transform:translateY(100%)}to{transform:translateY(0)}}
  .modal-handle {
    width:40px;height:4px;background:#ddd;border-radius:4px;
    margin:0 auto 20px;
  }
  .modal-table-name {
    font-family:'Playfair Display',serif;
    font-size:28px; color:var(--espresso); font-weight:900;
    margin-bottom:4px; text-align:center;
  }
  .modal-seats { text-align:center; color:#aaa; font-size:13px; margin-bottom:20px; }
  .modal-detail-row {
    display:flex; justify-content:space-between;
    padding:10px 0;
    border-bottom:1px solid var(--foam);
    font-size:14px;
  }
  .modal-detail-row:last-of-type { border:none; }
  .modal-detail-label { color:#888; }
  .modal-detail-value { font-weight:600; color:var(--espresso); }
  .modal-confirm-btn {
    width:100%; padding:16px;
    background:var(--espresso);
    color:var(--gold);
    border:none; border-radius:16px;
    font-size:16px; font-weight:700;
    letter-spacing:.5px;
    cursor:pointer;
    margin-top:20px;
    transition:all .25s;
    text-transform:uppercase;
  }
  .modal-confirm-btn:hover { background:var(--brown); transform:scale(1.02); }
  .modal-cancel-btn {
    width:100%; padding:12px;
    background:none; border:1.5px solid #eee;
    color:#aaa; border-radius:14px;
    font-size:14px; cursor:pointer;
    margin-top:10px; transition:all .2s;
  }
  .modal-cancel-btn:hover { border-color:#ccc; color:#666; }

  /* ── TAKE OUT BOX ── */
  .takeout-box {
    background: linear-gradient(135deg, var(--espresso), var(--brown));
    border: 2px solid var(--gold);
    border-radius: 20px;
    padding: 18px 20px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 14px;
    animation: fadeUp .5s ease .05s both;
    box-shadow: 0 6px 24px rgba(200,150,62,0.2);
  }
  .takeout-icon { font-size: 38px; flex-shrink:0; }
  .takeout-text { flex: 1; }
  .takeout-title {
    font-family:'Playfair Display',serif;
    font-size: 18px;
    color: var(--gold);
    font-weight: 900;
    margin-bottom: 2px;
  }
  .takeout-sub { font-size: 12px; color: rgba(253,246,236,0.6); }
  .takeout-btn {
    background: var(--gold);
    color: var(--espresso);
    border: none;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
    transition: all .25s;
    flex-shrink: 0;
  }
  .takeout-btn:hover { background: var(--gold-lt); transform: scale(1.06); }

  /* ── OR DIVIDER ── */
  .or-divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    animation: fadeUp .5s ease .08s both;
  }
  .or-line { flex:1; height:1px; background: rgba(59,31,14,0.18); }
  .or-label {
    font-size: 12px;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    white-space: nowrap;
    font-weight: 600;
  }


  .occ-note {
    background: #FFF3E0;
    border: 1.5px solid #FFB74D;
    border-radius: 14px;
    padding: 14px 16px;
    margin-bottom: 20px;
    font-size:13px; color:#E65100;
    display:none;
    animation:fadeDown .4s ease;
  }
  .occ-note.show { display:block; }

  /* ── REFRESH ── */
  .refresh-row {
    display:flex; align-items:center; justify-content:center; gap:8px;
    margin-bottom:16px;
    animation: fadeUp .5s ease .2s both;
  }
  .refresh-btn {
    background:none; border:1.5px solid rgba(59,31,14,0.2);
    color:var(--brown); padding:6px 16px; border-radius:30px;
    font-size:12px; font-weight:600; cursor:pointer; transition:all .2s;
    display:flex;align-items:center;gap:5px;
  }
  .refresh-btn:hover { background:var(--espresso); color:var(--gold); border-color:var(--espresso); }
  .refresh-spin { display:inline-block; }
  .spinning { animation:spin .7s linear infinite; }
  @keyframes spin{from{transform:rotate(0)}to{transform:rotate(360deg)}}
  .last-updated { font-size:11px; color:#aaa; }

  /* ── PAGE ENTER TRANSITION ── */
  @keyframes pageReveal {
    from { opacity:0; transform:translateY(30px); }
    to   { opacity:1; transform:translateY(0); }
  }
  .page-body { animation: pageReveal .55s cubic-bezier(.22,.68,0,1.2) both; }

  /* ── HEADER SLIDE DOWN ── */
  .header {
    animation: headerSlide .45s cubic-bezier(.22,.68,0,1.2) both;
  }
  @keyframes headerSlide {
    from { transform: translateY(-100%); opacity:0; }
    to   { transform: translateY(0);     opacity:1; }
  }

  /* ── TABLE CARD HOVER GLOW ── */
  .table-card.available {
    transition: all .35s cubic-bezier(.175,.885,.32,1.275);
  }
  .table-card.available::after {
    content:'';
    position:absolute; inset:0; border-radius:20px;
    background: radial-gradient(circle at 50% 80%, rgba(76,175,80,0.12), transparent 70%);
    opacity:0; transition:opacity .3s;
  }
  .table-card.available:hover::after,
  .table-card.available:active::after { opacity:1; }

  /* ── RIPPLE ON CLICK ── */
  .ripple {
    position:absolute; border-radius:50%;
    background:rgba(76,175,80,0.35);
    transform:scale(0);
    animation:rippleOut .55s ease-out forwards;
    pointer-events:none;
  }
  @keyframes rippleOut {
    to { transform:scale(4); opacity:0; }
  }

  /* ── SHAKE FOR OCCUPIED ── */
  @keyframes shake {
    0%,100%{ transform:translateX(0); }
    20%{ transform:translateX(-8px); }
    40%{ transform:translateX(8px); }
    60%{ transform:translateX(-6px); }
    80%{ transform:translateX(6px); }
  }
  .shake { animation:shake .4s ease both; }

  /* ── MODAL ENTRANCE ── */
  .modal-box {
    animation: modalUp .4s cubic-bezier(.175,.885,.32,1.275);
  }
  @keyframes modalUp {
    from { transform:translateY(100%) scale(.97); opacity:.6; }
    to   { transform:translateY(0) scale(1);     opacity:1; }
  }

  /* ── TAKEOUT BOX PULSE ── */
  .takeout-box {
    transition: transform .3s, box-shadow .3s;
  }
  .takeout-box:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow: 0 14px 40px rgba(200,150,62,0.3);
  }

  /* ── STATUS BADGE GLOW ── */
  .badge-available {
    animation: availGlow 2.5s ease-in-out infinite;
  }
  @keyframes availGlow {
    0%,100%{ box-shadow:0 0 0 0 rgba(76,175,80,0); }
    50%    { box-shadow:0 0 8px 2px rgba(76,175,80,0.3); }
  }

  /* ── STAGGER CARDS ── */
  .table-card:nth-child(1) { animation-delay:.05s; }
  .table-card:nth-child(2) { animation-delay:.1s; }
  .table-card:nth-child(3) { animation-delay:.15s; }
  .table-card:nth-child(4) { animation-delay:.2s; }
  .table-card:nth-child(5) { animation-delay:.25s; }
  .table-card:nth-child(6) { animation-delay:.3s; }

  /* ── CONFIRM BUTTON PRESS ── */
  .modal-confirm-btn:active { transform:scale(.97); }
  .modal-confirm-btn.loading {
    position:relative; overflow:hidden;
  }
  .modal-confirm-btn.loading::after {
    content:'';
    position:absolute; left:-100%; top:0; bottom:0; width:200%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent);
    animation: shimmer 1s infinite;
  }
  @keyframes shimmer { to { left:100%; } }

  /* ── LOADING ── */
  .loading-state { text-align:center; padding:60px 20px; color:#aaa; }
  .loading-spinner {
    width:40px;height:40px;
    border:3px solid rgba(200,150,62,0.2);
    border-top-color:var(--gold);
    border-radius:50%;
    animation:spin .8s linear infinite;
    margin:0 auto 14px;
  }

  /* ── BOTTOM BAR ── */
  .bottom-bar {
    position:fixed; bottom:0; left:0; right:0;
    background:var(--espresso);
    padding:12px 20px;
    text-align:center;
    font-size:12px;
    color:rgba(253,246,236,0.4);
    letter-spacing:.5px;
    z-index:50;
  }
  .bottom-bar span { color:var(--gold); font-weight:600; }

  /* ── SKELETON LOADER ── */
  .skeleton{background:linear-gradient(90deg,#ede5d8 25%,#f5ede0 50%,#ede5d8 75%);background-size:200% 100%;animation:skeletonShimmer 1.4s infinite;border-radius:10px;}
  @keyframes skeletonShimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}
  .skel-table-card{background:white;border-radius:20px;padding:20px 14px 16px;box-shadow:0 2px 14px rgba(0,0,0,.07);display:flex;flex-direction:column;align-items:center;gap:10px;}
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">Loading Tables</div>
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
  var msgs=['Checking table status...', 'Loading tables...', 'Almost ready...', 'Pick your seat! 🪑'];
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

<div class="header">
  <span class="header-logo">☕</span>
  <span class="header-name">KAPITOL CAFE</span>
  <div class="header-sub">Choose your table</div>
</div>

<div class="page-body">

  <div class="intro-box">
    <div class="intro-title">🪑 Find Your Seat!</div>
    <div class="intro-sub">Select your table below.<br><strong style="color:var(--green-lt)">Green</strong> = available &nbsp;·&nbsp; <strong style="color:var(--red-lt)">Red</strong> = occupied.</div>
  </div>

  <!-- TAKE OUT OPTION -->
  <div class="takeout-box">
    <div class="takeout-icon">🥡</div>
    <div class="takeout-text">
      <div class="takeout-title">Take Out?</div>
      <div class="takeout-sub">Order now and pick up at the counter</div>
    </div>
    <button class="takeout-btn" onclick="proceedTakeOut()">Order →</button>
  </div>

  <div class="or-divider">
    <div class="or-line"></div>
    <span class="or-label">or dine in</span>
    <div class="or-line"></div>
  </div>

  <div class="occ-note" id="occNote">
    ⚠️ That table is currently occupied. Please choose an available table (green).
  </div>

  <div class="refresh-row">
    <button class="refresh-btn" onclick="loadTables()">
      <span class="refresh-spin" id="refreshIcon">⟳</span> Refresh
    </button>
    <span class="last-updated" id="lastUpdated"></span>
  </div>

  <div class="legend">
    <div class="legend-item"><div class="legend-dot dot-available"></div> Available</div>
    <div class="legend-item"><div class="legend-dot dot-occupied"></div> Occupied</div>
  </div>

  <div id="tablesGrid" class="tables-grid">
    <div class="loading-state" style="grid-column:1/-1">
      <div class="loading-spinner"></div>
      <p>Loading table status...</p>
    </div>
  </div>

</div>

<!-- CONFIRM MODAL -->
<div class="modal-overlay" id="confirmModal">
  <div class="modal-box">
    <div class="modal-handle"></div>
    <div class="modal-table-name" id="modalTableName">–</div>
    <div class="modal-seats" id="modalSeats">–</div>
    <div class="modal-detail-row">
      <span class="modal-detail-label">Status</span>
      <span class="modal-detail-value" style="color:var(--green)" id="modalStatus">Available ✓</span>
    </div>
    <div class="modal-detail-row">
      <span class="modal-detail-label">Pwesto</span>
      <span class="modal-detail-value" id="modalSeatsFull">–</span>
    </div>
    <button class="modal-confirm-btn" id="modalConfirmBtn" onclick="proceedToMenu()">
      🍽️ Order at this table!
    </button>
    <button class="modal-cancel-btn" onclick="closeModal()">Go Back</button>
  </div>
</div>

<div class="bottom-bar">
  Powered by <span>KAPITOL CAFE</span> POS System
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';

// Fallback demo tables if API is unavailable
const DEMO_TABLES = [
  {table_number:'T01', seats:4, status:'available', label:'Table 1'},
  {table_number:'T02', seats:4, status:'available', label:'Table 2'},
  {table_number:'T03', seats:6, status:'occupied',  label:'Table 3'},
  {table_number:'T04', seats:2, status:'available', label:'Table 4'},
  {table_number:'T05', seats:8, status:'available', label:'Table 5'},
  {table_number:'BAR', seats:3, status:'occupied',  label:'Bar Counter'},
];

let selectedTable = null;

async function loadTables() {
  const icon = document.getElementById('refreshIcon');
  icon.classList.add('spinning');

  let tables = [];
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=get_tables`);
    const data = await res.json();
    if (data.success && data.data.length) {
      tables = data.data;
    } else {
      tables = DEMO_TABLES;
    }
  } catch(e) {
    tables = DEMO_TABLES;
  }

  renderTables(tables);
  if(window._hideSplash) window._hideSplash();
  icon.classList.remove('spinning');

  const now = new Date();
  document.getElementById('lastUpdated').textContent =
    'Updated: ' + now.toLocaleTimeString('en-PH', {hour:'2-digit', minute:'2-digit'});
}

function renderTables(tables) {
  const grid = document.getElementById('tablesGrid');
  grid.innerHTML = '';

  if (!tables.length) {
    grid.innerHTML = '<div class="loading-state" style="grid-column:1/-1"><p>No tables available.</p></div>';
    return;
  }

  tables.forEach((t, i) => {
    const isAvailable = t.status === 'available';
    const label = t.label || ('Table ' + t.table_number);

    const card = document.createElement('div');
    card.className = 'table-card ' + (isAvailable ? 'available' : 'occupied');
    card.style.animationDelay = (i * 0.06) + 's';
    card.innerHTML = `
      <span class="table-icon">${isAvailable ? '🪑' : '🔴'}</span>
      <div class="table-num">${label}</div>
      <div class="seats-txt">👥 ${t.seats} seats</div>
      <span class="status-badge ${isAvailable ? 'badge-available' : 'badge-occupied'}">
        <span class="status-dot ${isAvailable ? 'dot-av' : 'dot-oc'}"></span>
        ${isAvailable ? 'Available' : 'Occupied'}
      </span>
    `;

    card.addEventListener('click', (e) => {
      // Ripple
      if (isAvailable) {
        const r = document.createElement('span');
        r.className = 'ripple';
        const rect = card.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px`;
        card.appendChild(r);
        setTimeout(() => r.remove(), 600);
      }
      selectTable(t, isAvailable);
    });
    grid.appendChild(card);
  });
}

function selectTable(table, isAvailable) {
  if (!isAvailable) {
    const note = document.getElementById('occNote');
    note.classList.add('show');
    setTimeout(() => note.classList.remove('show'), 3500);
    // Shake the card
    const cards = document.querySelectorAll('.table-card.occupied');
    cards.forEach(c => {
      c.classList.add('shake');
      setTimeout(() => c.classList.remove('shake'), 450);
    });
    return;
  }

  selectedTable = table;
  const label = table.label || ('Table ' + table.table_number);
  document.getElementById('modalTableName').textContent = label;
  document.getElementById('modalSeats').textContent = '👥 ' + table.seats + ' seats';
  document.getElementById('modalStatus').textContent = 'Available ✓';
  document.getElementById('modalSeatsFull').textContent = table.seats + ' seats';
  document.getElementById('confirmModal').classList.add('show');
}

function closeModal() {
  document.getElementById('confirmModal').classList.remove('show');
  selectedTable = null;
}

async function proceedToMenu() {
  if (!selectedTable) return;

  const btn = document.getElementById('modalConfirmBtn');
  btn.textContent = '⏳ Please wait...';
  btn.disabled = true;
  btn.classList.add('loading');

  // Mark table as occupied in DB
  try {
    await fetch(`${SITE_URL}/api/api.php?action=update_table_status`, {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify({
        table_number: selectedTable.table_number,
        status: 'occupied'
      })
    });
  } catch(e) {
    // Continue even if offline
  }

  // Redirect to menu with table info
  const label = encodeURIComponent(selectedTable.label || selectedTable.table_number);
  window.location.href = `${SITE_URL}/menu.php?table=${selectedTable.table_number}&label=${label}`;
}

function proceedTakeOut() {
  window.location.href = `${SITE_URL}/menu.php?table=TAKEOUT&label=Take+Out&order_type=takeout`;
}

// Close modal on overlay tap
document.getElementById('confirmModal').addEventListener('click', function(e){
  if (e.target === this) closeModal();
});

// Init

// Skeleton while tables load
(function(){
  var grid = document.getElementById('tablesGrid');
  if(!grid) return;
  var html = '';
  for(var i=0;i<6;i++){
    html += '<div class="skel-table-card"><div class="skeleton" style="width:48px;height:48px;border-radius:50%;"></div><div class="skeleton" style="width:80%;height:16px;"></div><div class="skeleton" style="width:50%;height:11px;"></div><div class="skeleton" style="width:70%;height:28px;border-radius:20px;"></div></div>';
  }
  grid.innerHTML = html;
})();

loadTables();

// Auto-refresh every 20 seconds
setInterval(loadTables, 20000);
</script>
</body>
</html>
