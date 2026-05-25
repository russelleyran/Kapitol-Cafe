<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KAPITOL CAFE – System</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --espresso:#1A0A00;--brown:#3B1F0E;--gold:#C8963E;
    --gold-light:#E5B96A;--cream:#FDF6EC;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{
    background:var(--espresso);
    font-family:'DM Sans',sans-serif;
    color:var(--cream);
    min-height:100vh;
    display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    padding:40px 20px;
  }

  .logo{font-size:72px;margin-bottom:12px;animation:pulse 2s infinite;}
  @keyframes pulse{0%,100%{filter:drop-shadow(0 0 20px rgba(200,150,62,0.4))}50%{filter:drop-shadow(0 0 40px rgba(200,150,62,0.9))}}

  h1{
    font-family:'Playfair Display',serif;
    font-size:clamp(36px,8vw,72px);
    color:var(--gold);
    letter-spacing:6px;
    text-align:center;
    margin-bottom:8px;
  }
  .tagline{color:rgba(253,246,236,0.5);letter-spacing:4px;font-size:13px;text-transform:uppercase;margin-bottom:50px;}

  .nav-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:16px;
    max-width:800px;
    width:100%;
  }
  .nav-card{
    background:rgba(253,246,236,0.05);
    border:1px solid rgba(200,150,62,0.25);
    border-radius:20px;
    padding:28px 20px;
    text-align:center;
    cursor:pointer;
    transition:all 0.35s cubic-bezier(0.175,0.885,0.32,1.275);
    text-decoration:none;
    color:inherit;
    display:block;
    animation:fadeUp 0.5s ease both;
  }
  @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  .nav-card:nth-child(1){animation-delay:0.1s}
  .nav-card:nth-child(2){animation-delay:0.2s}
  .nav-card:nth-child(3){animation-delay:0.3s}
  .nav-card:nth-child(4){animation-delay:0.4s}
  .nav-card:nth-child(5){animation-delay:0.5s}
  .nav-card:nth-child(6){animation-delay:0.6s}

  .nav-card:hover{
    background:rgba(200,150,62,0.12);
    border-color:var(--gold);
    transform:translateY(-8px) scale(1.02);
    box-shadow:0 20px 60px rgba(200,150,62,0.15);
  }

  /* ── EXTRA ANIMATIONS ── */

  /* Page entrance */
  body { animation: bgReveal .6s ease both; }
  @keyframes bgReveal { from{opacity:0} to{opacity:1} }

  /* Logo float */
  .logo { animation: logoFloat 3.5s ease-in-out infinite, pulse 2s infinite; }
  @keyframes logoFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }

  /* Title reveal */
  h1 { animation: titleReveal .7s cubic-bezier(.22,.68,0,1.2) .1s both; }
  @keyframes titleReveal { from{opacity:0;letter-spacing:20px} to{opacity:1;letter-spacing:6px} }

  /* Tagline */
  .tagline { animation: fadeUp .6s ease .3s both; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }

  /* Card ripple */
  .nav-card { position:relative; overflow:hidden; }
  .nav-card .card-ripple {
    position:absolute; border-radius:50%;
    background:rgba(200,150,62,.15);
    transform:scale(0);
    animation:cardRipple .5s ease-out forwards;
    pointer-events:none;
  }
  @keyframes cardRipple { to{ transform:scale(4); opacity:0; } }

  /* Icon hover rotate */
  .nav-icon { display:block; transition:transform .35s cubic-bezier(.175,.885,.32,1.275); }
  .nav-card:hover .nav-icon { transform:scale(1.2) rotate(-5deg); }

  /* Badge pulse */
  .nav-badge {
    animation: badgeFade .5s ease both;
    transition:background .3s, color .3s;
  }
  @keyframes badgeFade { from{opacity:0;transform:scale(.7)} to{opacity:1;transform:scale(1)} }
  .nav-card:hover .nav-badge { background:rgba(200,150,62,.3); color:var(--gold-light); }

  /* Setup section */
  .setup-section { animation: fadeUp .6s ease .9s both; }

  /* Step number pop-in */
  .step-num {
    transition:transform .2s;
  }
  .setup-step:hover .step-num { transform:scale(1.2) rotate(-5deg); }
  .nav-icon{font-size:48px;margin-bottom:14px;display:block;}
  .nav-title{font-family:'Playfair Display',serif;font-size:20px;color:var(--gold);margin-bottom:6px;font-weight:700;}
  .nav-desc{font-size:12px;color:rgba(253,246,236,0.5);line-height:1.5;}
  .nav-badge{
    display:inline-block;margin-top:10px;
    background:rgba(200,150,62,0.15);border:1px solid rgba(200,150,62,0.3);
    color:var(--gold);padding:3px 10px;border-radius:20px;font-size:11px;
  }

  .setup-section{
    margin-top:40px;
    background:rgba(253,246,236,0.04);
    border:1px solid rgba(200,150,62,0.15);
    border-radius:16px;
    padding:20px 24px;
    max-width:600px;width:100%;
    animation:fadeUp 0.6s ease 0.8s both;
  }
  .setup-title{color:var(--gold);font-weight:700;margin-bottom:12px;font-size:15px;}
  .setup-step{
    display:flex;align-items:flex-start;gap:10px;
    padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.05);
    font-size:13px;color:rgba(253,246,236,0.7);
  }
  .setup-step:last-child{border:none;}
  .step-num{
    background:var(--gold);color:var(--espresso);
    width:22px;height:22px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-weight:900;font-size:11px;flex-shrink:0;margin-top:1px;
  }
  code{
    background:rgba(200,150,62,0.15);color:var(--gold-light);
    padding:2px 6px;border-radius:4px;font-size:12px;font-family:monospace;
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">System Hub</div>
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
  var msgs=['Starting system...', 'Loading modules...', 'Almost ready...', 'System ready! ✅'];
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

<div class="logo">☕</div>
<h1>KAPITOL CAFE</h1>
<p class="tagline">Point of Sale & Order Management System</p>

<div class="nav-grid">
  <a href="welcome.php" class="nav-card">
    <span class="nav-icon">🖥️</span>
    <div class="nav-title">Welcome Display</div>
    <div class="nav-desc">Customer-facing screen with table QR codes. Use on your main monitor.</div>
    <span class="nav-badge">Customer View</span>
  </a>

  <a href="menu.php" class="nav-card">
    <span class="nav-icon">🍽️</span>
    <div class="nav-title">Menu & Order</div>
    <div class="nav-desc">Mobile-optimized menu for customers to browse and place orders.</div>
    <span class="nav-badge">Mobile Friendly</span>
  </a>

  <a href="admin.php" class="nav-card">
    <span class="nav-icon">📊</span>
    <div class="nav-title">Admin Dashboard</div>
    <div class="nav-desc">Full management panel — orders, cashier, stats, and controls.</div>
    <span class="nav-badge">Staff Only</span>
  </a>

  <a href="kitchen_display.php" class="nav-card">
    <span class="nav-icon">👨‍🍳</span>
    <div class="nav-title">Kitchen Display</div>
    <div class="nav-desc">Live order board for kitchen staff. Auto-refreshes every 10 seconds.</div>
    <span class="nav-badge">Kitchen Screen</span>
  </a>

  <a href="payment.php?code=KAP-DEMO&table=T01&total=250&name=Demo+Customer" class="nav-card">
    <span class="nav-icon">💳</span>
    <div class="nav-title">Payment Screen</div>
    <div class="nav-desc">QR payment display for GCash, Maya, and cash transactions.</div>
    <span class="nav-badge">Demo Mode</span>
  </a>

  <a href="order_track.php" class="nav-card">
    <span class="nav-icon">📍</span>
    <div class="nav-title">Order Tracker</div>
    <div class="nav-desc">Customers can track the live status of their order using their order code.</div>
    <span class="nav-badge">Customer View</span>
  </a>

  <a href="qr_generator.php" class="nav-card">
    <span class="nav-icon">🔲</span>
    <div class="nav-title">QR Generator</div>
    <div class="nav-desc">Generate and print QR codes for all tables. Export-ready layout.</div>
    <span class="nav-badge">Print Ready</span>
  </a>
</div>

<!-- SETUP INSTRUCTIONS -->
<div class="setup-section">
  <div class="setup-title">⚙️ Quick Setup Guide</div>
  <div class="setup-step"><span class="step-num">1</span><div>Start XAMPP — make sure <strong>Apache</strong> and <strong>MySQL</strong> are running.</div></div>
  <div class="setup-step"><span class="step-num">2</span><div>Copy this folder to <code>C:/xampp/htdocs/kapitol_cafe/</code></div></div>
  <div class="setup-step"><span class="step-num">3</span><div>Open <strong>phpMyAdmin</strong> → Create database <code>kapitol_cafe</code> → Import <code>database.sql</code></div></div>
  <div class="setup-step"><span class="step-num">4</span><div>Edit <code>config.php</code> if your MySQL has a password. Update <code>DB_PASS</code>.</div></div>
  <div class="setup-step"><span class="step-num">5</span><div>Open <code>http://localhost/kapitol_cafe/</code> in your browser. ✅ Done!</div></div>
  <div class="setup-step"><span class="step-num">6</span><div>For mobile ordering: connect phone to same WiFi, replace <code>localhost</code> with your PC's IP in <code>config.php</code></div></div>
</div>

<script>
document.querySelectorAll('.nav-card').forEach(card => {
  card.addEventListener('click', function(e) {
    const r = document.createElement('span');
    r.className = 'card-ripple';
    const rect = card.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;position:absolute;`;
    card.appendChild(r);
    setTimeout(()=>r.remove(), 550);
  });
});
</script>


<script>window.addEventListener('load', function(){ setTimeout(function(){ if(window._hideSplash) window._hideSplash(); }, 400); });</script>
</body>
</html>
