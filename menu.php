<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>KAPITOL CAFE – Menu</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --brown: #3B1F0E;
    --gold: #C8963E;
    --cream: #FDF6EC;
    --espresso: #1A0A00;
    --latte: #D4A96A;
    --foam: #F5ECD7;
    --green: #2E7D32;
    --red: #C62828;
  }
  * { margin:0;padding:0;box-sizing:border-box; }
  html,body { height:100%; background:var(--cream); font-family:'DM Sans',sans-serif; }

  /* TOP HEADER */
  .header {
    background: var(--espresso);
    padding: 16px 20px;
    display: flex; align-items:center; justify-content:space-between;
    position: sticky; top:0; z-index:100;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  }
  .header-brand { display:flex; align-items:center; gap:10px; }
  .header-logo { font-size:28px; }
  .header-name {
    font-family:'Playfair Display',serif;
    color: var(--gold);
    font-size:20px;
    font-weight:700;
    letter-spacing:2px;
  }
  .header-table {
    background: rgba(200,150,62,0.2);
    border: 1px solid var(--gold);
    color: var(--gold);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
  }

  /* HERO BANNER */
  .hero-banner {
    background: linear-gradient(135deg, var(--espresso) 0%, var(--brown) 100%);
    padding: 24px 20px;
    text-align: center;
    animation: fadeDown 0.6s ease;
  }
  @keyframes fadeDown {
    from{opacity:0;transform:translateY(-20px)} to{opacity:1;transform:translateY(0)}
  }
  .hero-banner h2 {
    font-family:'Playfair Display',serif;
    color: var(--cream);
    font-size: clamp(22px,5vw,32px);
    margin-bottom: 6px;
  }
  .hero-banner p { color:rgba(253,246,236,0.6); font-size:13px; }

  /* CATEGORY TABS */
  .cat-nav {
    background: white;
    padding: 12px 0;
    overflow-x: auto;
    white-space: nowrap;
    border-bottom: 2px solid var(--foam);
    position: sticky; top:65px; z-index:90;
    scrollbar-width:none;
  }
  .cat-nav::-webkit-scrollbar { display:none; }
  .cat-btn {
    display: inline-flex; align-items:center; gap:6px;
    padding: 8px 18px;
    margin: 0 4px;
    border-radius: 30px;
    border: 1.5px solid var(--foam);
    background: white;
    color: #666;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.25s;
    white-space: nowrap;
  }
  .cat-btn.active, .cat-btn:hover {
    background: var(--espresso);
    color: var(--gold);
    border-color: var(--espresso);
    transform: scale(1.05);
  }

  /* MENU ITEMS */
  .menu-section { padding: 20px 16px; }
  .section-header {
    display: flex; align-items:center; gap:10px;
    margin-bottom: 16px;
  }
  .section-title {
    font-family:'Playfair Display',serif;
    font-size:22px;
    color: var(--espresso);
    font-weight:700;
  }
  .section-icon { font-size:24px; }

  .menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 14px;
  }

  .menu-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    transition: all 0.3s cubic-bezier(0.175,0.885,0.32,1.275);
    cursor: pointer;
    position: relative;
    animation: popIn 0.4s ease both;
  }
  @keyframes popIn {
    from{opacity:0;transform:scale(0.85)} to{opacity:1;transform:scale(1)}
  }
  .menu-card:hover, .menu-card:active {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 10px 30px rgba(59,31,14,0.15);
  }
  .menu-card.added {
    animation: addedAnim 0.5s ease;
  }
  @keyframes addedAnim {
    0%{transform:scale(1)} 30%{transform:scale(1.1)} 60%{transform:scale(0.95)} 100%{transform:scale(1)}
  }

  .card-emoji {
    background: linear-gradient(135deg, var(--foam), #FFF8F0);
    height: 110px;
    display: flex; align-items:center; justify-content:center;
    font-size:44px;
    transition: transform .35s ease;
    overflow: hidden;
    position: relative;
  }
  .card-emoji img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
    display: block;
  }
  .menu-card:hover .card-emoji img { transform: scale(1.1); }
  .menu-card:hover .card-emoji { transform: none; }

  /* ── EXTRA ANIMATIONS ── */

  /* Page reveal */
  @keyframes pageIn {
    from{ opacity:0; transform:translateY(28px); }
    to  { opacity:1; transform:translateY(0); }
  }
  #menuContainer { animation: pageIn .55s ease both; }

  /* Hero banner */
  .hero-banner { animation: heroReveal .6s cubic-bezier(.22,.68,0,1.2) both; }
  @keyframes heroReveal {
    from{ opacity:0; transform:scale(.97) translateY(-12px); }
    to  { opacity:1; transform:scale(1)   translateY(0); }
  }

  /* Category nav slide */
  .cat-nav { animation: slideRight .45s ease .1s both; }
  @keyframes slideRight {
    from{ opacity:0; transform:translateX(-18px); }
    to  { opacity:1; transform:translateX(0); }
  }

  /* Tab underline indicator */
  .cat-btn { position:relative; overflow:hidden; }
  .cat-btn::after {
    content:''; position:absolute; bottom:0; left:50%; right:50%;
    height:2px; background:var(--gold);
    transition: left .25s, right .25s;
  }
  .cat-btn.active::after { left:10%; right:10%; }

  /* Tab click ripple */
  .cat-btn .tab-ripple {
    position:absolute; border-radius:50%;
    background:rgba(200,150,62,.25);
    transform:scale(0);
    animation:rippleOut .45s ease-out forwards;
    pointer-events:none;
  }
  @keyframes rippleOut { to{ transform:scale(5); opacity:0; } }

  /* Card hover glow */
  .menu-card::before {
    content:''; position:absolute; inset:0;
    background:radial-gradient(circle at 50% 0%, rgba(200,150,62,.1), transparent 60%);
    opacity:0; transition:opacity .3s; pointer-events:none;
  }
  .menu-card:hover::before { opacity:1; }

  /* Add button burst */
  .add-btn { position:relative; overflow:hidden; }
  .add-btn .burst {
    position:absolute; border-radius:50%;
    width:100%; height:100%; top:0; left:0;
    background:rgba(255,255,255,.3);
    transform:scale(0);
    animation:burst .4s ease-out forwards;
    pointer-events:none;
  }
  @keyframes burst { to{ transform:scale(2.5); opacity:0; } }

  /* Cart bar bounce */
  .cart-bar.visible { animation: cartBounce .5s cubic-bezier(.175,.885,.32,1.275); }
  @keyframes cartBounce {
    0%  { transform:translateY(100%); }
    70% { transform:translateY(-6px); }
    100%{ transform:translateY(0); }
  }

  /* Cart item slide */
  .cart-item { animation: itemSlide .3s ease both; }
  @keyframes itemSlide {
    from{ opacity:0; transform:translateX(-16px); }
    to  { opacity:1; transform:translateX(0); }
  }

  /* Section scroll reveal */
  .menu-section { opacity:0; transform:translateY(20px); transition: opacity .5s ease, transform .5s ease; }
  .menu-section.visible { opacity:1; transform:translateY(0); }

  /* Place order shimmer */
  .place-order-btn { position:relative; overflow:hidden; }
  .place-order-btn.loading::after {
    content:''; position:absolute; inset:0;
    background:linear-gradient(90deg,transparent,rgba(255,255,255,.15),transparent);
    animation:loadShimmer 1s infinite;
  }
  @keyframes loadShimmer { from{transform:translateX(-100%)} to{transform:translateX(100%)} }

  /* Success screen */
  .success-overlay.show { animation: successReveal .6s cubic-bezier(.175,.885,.32,1.275) both; }
  @keyframes successReveal {
    from{ opacity:0; transform:scale(.95); }
    to  { opacity:1; transform:scale(1); }
  }

  /* Modal slide */
  .modal-box { animation: modalUp .4s cubic-bezier(.175,.885,.32,1.275); }
  @keyframes modalUp {
    from{ transform:translateY(100%) scale(.97); opacity:.6; }
    to  { transform:translateY(0) scale(1); opacity:1; }
  }

  /* Header entrance */
  .header { animation: headerSlide .4s cubic-bezier(.22,.68,0,1.2) both; }
  @keyframes headerSlide {
    from{ transform:translateY(-100%); opacity:0; }
    to  { transform:translateY(0);     opacity:1; }
  }

  /* Qty button press */
  .qty-btn:active { transform:scale(.85); }

  /* Price pop on hover */
  .card-price { transition:transform .2s; display:inline-block; }
  .menu-card:hover .card-price { transform:scale(1.08); }
  .card-body { padding: 10px 12px 12px; }
  .card-name {
    font-weight:600; font-size:13px;
    color:var(--espresso);
    margin-bottom:4px;
    line-height:1.3;
  }
  .card-desc {
    font-size:11px; color:#999;
    margin-bottom:8px;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }
  .card-footer {
    display:flex; align-items:center; justify-content:space-between;
  }
  .card-price {
    font-weight:700; color:var(--brown);
    font-size:15px;
  }
  .add-btn {
    width:60px;height:60px;
    background:var(--espresso);
    color:var(--gold);
    border:none;
    border-radius:50%;
    font-size:26px;
    cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    transition: all 0.2s;
    line-height:1;
    box-shadow: 0 2px 8px rgba(0,0,0,0.18);
    flex-shrink:0;
  }
  .add-btn:hover { background:var(--brown); transform:scale(1.15); }
  .add-btn:active { transform:scale(0.93); }
  .featured-badge {
    position:absolute; top:8px; left:8px;
    background:var(--gold);
    color:var(--espresso);
    font-size:9px; font-weight:700;
    padding:2px 7px; border-radius:10px;
    letter-spacing:0.5px;
    text-transform:uppercase;
  }

  /* CART */
  .cart-bar {
    position: fixed; bottom:0; left:0; right:0;
    background: var(--espresso);
    padding: 14px 20px;
    display: flex; align-items:center; justify-content:space-between;
    transform: translateY(100%);
    transition: transform 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
    z-index:200;
    box-shadow: 0 -4px 30px rgba(0,0,0,0.4);
  }
  .cart-bar.visible { transform:translateY(0); }
  .cart-info { color:white; }
  .cart-count { font-size:13px; opacity:0.7; }
  .cart-total { font-size:20px; font-weight:700; color:var(--gold); }
  .view-cart-btn {
    background: var(--gold);
    color: var(--espresso);
    border:none; padding:12px 24px;
    border-radius:30px;
    font-weight:700; font-size:14px;
    cursor:pointer;
    transition:all 0.2s;
    letter-spacing:0.5px;
  }
  .view-cart-btn:hover { background:var(--latte); transform:scale(1.05); }

  /* CART MODAL */
  .modal-overlay {
    display:none;
    position:fixed;inset:0;
    background:rgba(0,0,0,0.6);
    z-index:300;
    backdrop-filter:blur(4px);
    animation:fadeIn 0.3s ease;
  }
  @keyframes fadeIn{from{opacity:0}to{opacity:1}}
  .modal-overlay.show { display:flex; align-items:flex-end; justify-content:center; }
  .modal-box {
    background:white;
    border-radius:24px 24px 0 0;
    width:100%;
    max-width:600px;
    max-height:85vh;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    animation:slideUp 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
  }
  @keyframes slideUp{from{transform:translateY(100%)}to{transform:translateY(0)}}

  .modal-header {
    padding:20px;
    border-bottom:1px solid var(--foam);
    display:flex;align-items:center;justify-content:space-between;
  }
  .modal-title {
    font-family:'Playfair Display',serif;
    font-size:22px;
    color:var(--espresso);
    font-weight:700;
  }
  .close-btn {
    width:32px;height:32px;
    background:var(--foam);
    border:none;border-radius:50%;
    font-size:18px;cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    transition:all 0.2s;
  }
  .close-btn:hover{background:#ddd;transform:rotate(90deg);}

  .cart-items { overflow-y:auto; flex:1; padding:16px 20px; }
  .cart-item {
    display:flex;align-items:center;gap:12px;
    padding:12px 0;
    border-bottom:1px solid var(--foam);
    animation:slideIn 0.3s ease;
  }
  @keyframes slideIn{from{opacity:0;transform:translateX(-20px)}to{opacity:1;transform:translateX(0)}}
  .ci-emoji{font-size:32px;}
  .ci-info{flex:1;}
  .ci-name{font-weight:600;font-size:14px;color:var(--espresso);}
  .ci-price{font-size:13px;color:#888;}
  .ci-controls{display:flex;align-items:center;gap:8px;}
  .qty-btn{width:28px;height:28px;border-radius:50%;border:1.5px solid var(--foam);background:white;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;}
  .qty-btn:hover{background:var(--espresso);color:var(--gold);border-color:var(--espresso);}
  .qty-num{font-weight:700;color:var(--espresso);min-width:20px;text-align:center;}

  .cart-footer{padding:20px;border-top:1px solid var(--foam);}
  .notes-input{
    width:100%;padding:12px;
    border:1.5px solid var(--foam);
    border-radius:12px;
    font-family:inherit;
    font-size:13px;
    margin-bottom:12px;
    outline:none;
    transition:border-color 0.2s;
  }
  .notes-input:focus{border-color:var(--gold);}

  .name-input{
    width:100%;padding:12px;
    border:1.5px solid var(--foam);
    border-radius:12px;
    font-family:inherit;
    font-size:13px;
    margin-bottom:12px;
    outline:none;
    transition:border-color 0.2s;
  }
  .name-input:focus{border-color:var(--gold);}

  .order-total-row{
    display:flex;justify-content:space-between;align-items:center;
    margin-bottom:14px;
  }
  .order-total-label{font-weight:600;font-size:15px;color:var(--espresso);}
  .order-total-amount{font-weight:900;font-size:22px;color:var(--gold);}

  .place-order-btn{
    width:100%;padding:16px;
    background:var(--espresso);
    color:var(--gold);
    border:none;border-radius:16px;
    font-size:16px;font-weight:700;
    letter-spacing:1px;
    cursor:pointer;
    transition:all 0.3s;
    text-transform:uppercase;
  }
  .place-order-btn:hover{background:var(--brown);transform:scale(1.02);}
  .place-order-btn:disabled{opacity:0.5;cursor:not-allowed;transform:none;}

  /* SUCCESS SCREEN */
  .success-overlay {
    display:none;
    position:fixed;inset:0;
    background: linear-gradient(135deg, var(--espresso), var(--brown));
    z-index:500;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:40px;
  }
  .success-overlay.show{display:flex;animation:fadeIn 0.5s ease;}
  .success-icon{font-size:80px;animation:bounceIn 0.8s ease both;margin-bottom:20px;}
  @keyframes bounceIn{
    0%{transform:scale(0);opacity:0}
    60%{transform:scale(1.2);opacity:1}
    100%{transform:scale(1)}
  }
  .success-code{
    background:rgba(200,150,62,0.2);
    border:2px solid var(--gold);
    border-radius:16px;
    padding:16px 32px;
    margin:20px 0;
    animation:fadeUp 0.6s ease 0.3s both;
  }
  .success-code-label{color:rgba(253,246,236,0.6);font-size:12px;letter-spacing:2px;text-transform:uppercase;}
  .success-code-num{font-family:'Playfair Display',serif;font-size:36px;font-weight:900;color:var(--gold);}
  .success-msg{color:var(--cream);font-size:16px;opacity:0.85;animation:fadeUp 0.6s ease 0.5s both;}
  @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  .back-btn{
    margin-top:24px;
    background:var(--gold);
    color:var(--espresso);
    border:none;
    padding:14px 32px;
    border-radius:30px;
    font-weight:700;
    font-size:15px;
    cursor:pointer;
    animation:fadeUp 0.6s ease 0.7s both;
    transition:all 0.3s;
  }
  .back-btn:hover{transform:scale(1.05);}

  .empty-cart{text-align:center;padding:40px 20px;color:#aaa;}
  .empty-cart-icon{font-size:60px;margin-bottom:12px;}

  /* ── SKELETON LOADER ── */
  .skeleton { background:linear-gradient(90deg,#f0e8d8 25%,#f8f2e8 50%,#f0e8d8 75%);background-size:200% 100%;animation:skeletonShimmer 1.4s infinite;border-radius:10px; }
  @keyframes skeletonShimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
  .skel-card { background:white;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06); }
  .skel-img  { height:110px; }
  .skel-body { padding:10px 12px 14px; }
  .skel-line { height:12px;margin-bottom:8px; }
  .skel-line.short{ width:60%; }
  .skel-line.price{ width:40%;height:16px; }
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">Loading Menu</div>
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
  var msgs=['Brewing your experience...', 'Loading the menu...', 'Almost ready...', 'Welcome! ☕'];
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
  <div class="header-brand">
    <span class="header-logo">☕</span>
    <span class="header-name">KAPITOL</span>
  </div>
  <div class="header-table" id="tableLabel">Table –</div>
</div>

<div class="hero-banner">
  <h2>What would you like today?</h2>
  <p>Fresh brews & delicious bites, made just for you ✨</p>
</div>

<nav class="cat-nav" id="catNav"></nav>

<div id="menuContainer"></div>

<div class="cart-bar" id="cartBar">
  <div class="cart-info">
    <div class="cart-count" id="cartCount">0 items</div>
    <div class="cart-total" id="cartTotal">₱0.00</div>
  </div>
  <button class="view-cart-btn" onclick="openCart()">🛒 View Order</button>
</div>

<!-- Cart Modal -->
<div class="modal-overlay" id="cartModal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title">🛒 Your Order</div>
      <button class="close-btn" onclick="closeCart()">✕</button>
    </div>
    <div class="cart-items" id="cartItemsList"></div>
    <div class="cart-footer">
      <input class="name-input" type="text" id="customerName" placeholder="Your name (optional)">
      <input class="notes-input" type="text" id="orderNotes" placeholder="Special requests (e.g. less ice, no sugar)">
      <div class="order-total-row">
        <span class="order-total-label">Total</span>
        <span class="order-total-amount" id="modalTotal">₱0.00</span>
      </div>
      <button class="place-order-btn" id="placeOrderBtn" onclick="placeOrder()">✓ Place Order</button>
    </div>
  </div>
</div>

<!-- Success Screen -->
<div class="success-overlay" id="successOverlay">
  <div class="success-icon">🎉</div>
  <h2 style="font-family:'Playfair Display',serif;color:var(--gold);font-size:32px;margin-bottom:8px;">Order Placed!</h2>
  <p style="color:rgba(253,246,236,0.7);font-size:14px;">Your order has been received.</p>
  <div class="success-code">
    <div class="success-code-label">Order Code</div>
    <div class="success-code-num" id="successCode">–</div>
  </div>
  <p class="success-msg">Keep this code to track your order status. ☕</p>
  <button class="back-btn" id="trackBtn" onclick="goTrack()" style="background:var(--gold);margin-bottom:10px;">📍 Track My Order</button>
  <button class="back-btn" onclick="resetOrder()" style="background:rgba(253,246,236,0.15);border:1.5px solid rgba(253,246,236,0.3);font-size:13px;padding:10px 24px;">Order More</button>
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';
let cart = {};
let menuData = {};
const emojiMap = {
  'Hot Coffee':'☕','Iced Coffee':'🧊','Non-Coffee':'🧋',
  'Pastries':'🥐','Rice Meals':'🍱','Snacks':'🍟'
};
// Maps item names to their image files inside the images/ folder
const photoMap = {
  'Kapitol Espresso': 'images/Kapitol_Espresso.jpg',
  'Americano':        'images/Americano.jpeg',
  'Cappuccino':       'images/Cappuccino.jpg',
  'Caramel Macchiato':'images/Caramel_Macchiato.jpg',
  'Café Latte':       'images/Cafe_Latte.jpg',
  'White Mocha':      'images/White_Mocha.jpg',
  'Iced Latte':       'images/Cafe_Latte.jpg',
  'Cold Brew':        'images/Cold_Brew.jpg',
  'Iced Caramel':     'images/Iced_Caramel.jpg',
  'Iced Mocha':       'images/Iced_Mocha.jpg',
  'Chocolate Frost':  'images/Chocolate_Frost.jpg',
  'Mango Sago':      'images/mango_sago.jpg',
  'Matcha Latte':     'images/Matcha_Latte.jpg',
  'Strawberry Milk':  'images/Strawberry_Milk.jpg',
  'Blueberry Muffin': 'images/Blueberry_Muffin.jpg',
  'Butter Croissant': 'images/Butter_Croissant.png',
  'Cheese Danish':    'images/Cheese_Danish.jpg',
  'Club Sandwich Meal':'images/Club_Sandwich_Meal.jpg',
  'Kapitol Rice Bowl': 'images/Kapitol_Rice_Bowl.jpg',
  'Silog Meal':        'images/Silog_Meal.jpg',
  'Nachos Supreme':    'images/Nachos_Supreme.jpg',
  'Waffle Fries':      'images/waffle_Fries.jpg',
};

// Get table from URL
const params = new URLSearchParams(window.location.search);
const tableNum = params.get('table') || 'Walk-in';
const tableLabel = params.get('label') || tableNum;
document.getElementById('tableLabel').textContent = decodeURIComponent(tableLabel);

async function loadMenu() {
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=get_menu`);
    const data = await res.json();
    menuData = data.data;
    renderMenu();
    if(window._hideSplash) window._hideSplash();
  } catch(e) {
    // Show warning that we're in offline/demo mode
    console.warn('API unreachable, loading demo menu:', e.message);
    const banner = document.createElement('div');
    banner.style.cssText = 'background:#C62828;color:white;text-align:center;padding:10px;font-size:13px;position:fixed;top:65px;left:0;right:0;z-index:200;';
    banner.textContent = '⚠️ Cannot reach server. Make sure your phone is on the same WiFi as the cafe PC.';
    document.body.appendChild(banner);
    menuData = getDemoMenu();
    renderMenu();
    if(window._hideSplash) window._hideSplash();
  }
}

function getDemoMenu() {
  return {
    'Hot Coffee': { icon:'☕', items:[
      {id:1,name:'Kapitol Espresso',description:'Rich double-shot espresso',price:79,is_featured:1},
      {id:2,name:'Americano',description:'Espresso with hot water',price:89,is_featured:0},
      {id:3,name:'Cappuccino',description:'Espresso with foam',price:99,is_featured:1},
      {id:4,name:'Caramel Macchiato',description:'Vanilla, milk, espresso, caramel',price:125,is_featured:1},
      {id:5,name:'Café Latte',description:'Smooth espresso with steamed milk',price:110,is_featured:0},
      {id:6,name:'White Mocha',description:'White chocolate with espresso & milk',price:120,is_featured:1},
    ]},
    'Iced Coffee': { icon:'🧊', items:[
      {id:7,name:'Iced Latte',description:'Chilled espresso with milk',price:115,is_featured:1},
      {id:9,name:'Cold Brew',description:'Slow-steeped 12hr brew',price:140,is_featured:1},
    ]},
    'Non-Coffee': { icon:'🧋', items:[
      {id:11,name:'Matcha Latte',description:'Japanese matcha with oat milk',price:130,is_featured:1},
      {id:14,name:'Mango Sago',description:'Tropical mango with tapioca',price:120,is_featured:1},
    ]},
    'Pastries': { icon:'🥐', items:[
      {id:15,name:'Butter Croissant',description:'Flaky golden croissant',price:65,is_featured:1},
      {id:16,name:'Blueberry Muffin',description:'Moist muffin',price:75,is_featured:0},
    ]},
    'Rice Meals': { icon:'🍱', items:[
      {id:18,name:'Kapitol Rice Bowl',description:'Chicken teriyaki with rice',price:185,is_featured:1},
      {id:20,name:'Club Sandwich Meal',description:'Triple-decker with fries',price:210,is_featured:1},
    ]},
    'Snacks': { icon:'🍟', items:[
      {id:21,name:'Waffle Fries',description:'Crispy waffle-cut fries',price:95,is_featured:0},
      {id:22,name:'Nachos Supreme',description:'Loaded nachos',price:120,is_featured:1},
    ]},
  };
}

function renderMenu() {
  const nav = document.getElementById('catNav');
  const container = document.getElementById('menuContainer');
  nav.innerHTML = ''; container.innerHTML = '';

  const cats = Object.keys(menuData);
  cats.forEach((cat, i) => {
    const { icon, items } = menuData[cat];
    // Nav tab
    const tab = document.createElement('button');
    tab.className = 'cat-btn' + (i===0?' active':'');
    tab.innerHTML = `${icon} ${cat}`;
    tab.onclick = () => {
      document.querySelectorAll('.cat-btn').forEach(b=>b.classList.remove('active'));
      tab.classList.add('active');
      // Tab ripple
      const r = document.createElement('span');
      r.className = 'tab-ripple';
      r.style.cssText = `width:${tab.offsetWidth}px;height:${tab.offsetHeight}px;left:0;top:0;`;
      tab.appendChild(r);
      setTimeout(()=>r.remove(), 500);
      document.getElementById('sec-' + cat).scrollIntoView({behavior:'smooth',block:'start'});
    };
    nav.appendChild(tab);

    // Section
    const sec = document.createElement('div');
    sec.className = 'menu-section';
    sec.id = 'sec-' + cat;
    sec.innerHTML = `<div class="section-header"><span class="section-icon">${icon}</span><h2 class="section-title">${cat}</h2></div>`;
    const grid = document.createElement('div');
    grid.className = 'menu-grid';
    items.forEach((item, idx) => {
      const card = document.createElement('div');
      card.className = 'menu-card';
      card.style.animationDelay = (idx*0.05)+'s';
      const em = emojiMap[cat] || '🍽️';
      // Use image_url from DB first, then fall back to local photoMap, then emoji
      const photo = (item.image_url && item.image_url.trim()) ? item.image_url : (photoMap[item.name] || null);
      const cardTopHtml = photo
        ? `<div class="card-emoji"><img src="${photo}" alt="${item.name}" loading="lazy" onerror="this.parentElement.innerHTML='${em}'"></div>`
        : `<div class="card-emoji">${em}</div>`;
      card.innerHTML = `
        ${item.is_featured ? '<span class="featured-badge">⭐ Featured</span>' : ''}
        ${cardTopHtml}
        <div class="card-body">
          <div class="card-name">${item.name}</div>
          <div class="card-desc">${item.description||''}</div>
          <div class="card-footer">
            <span class="card-price">₱${parseFloat(item.price).toFixed(2)}</span>
            <button class="add-btn" onclick="addToCart(${item.id},'${item.name}',${item.price},'${em}',event)">+</button>
          </div>
        </div>
      `;
      card.onclick = (e) => {
        if(e.target.classList.contains('add-btn')) return;
        addToCart(item.id, item.name, item.price, em, e);
      };
      grid.appendChild(card);
    });
    sec.appendChild(grid);
    container.appendChild(sec);
  });

  // Scroll reveal for sections
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.07 });
  document.querySelectorAll('.menu-section').forEach(s => observer.observe(s));
}

function addToCart(id, name, price, emoji, e) {
  if (!cart[id]) cart[id] = {id, name, price, emoji, qty:0};
  cart[id].qty++;
  updateCartBar();
  // Burst on add button
  const btn = e.target.closest('.add-btn') || e.target.closest('.menu-card');
  if (btn && btn.classList.contains('add-btn')) {
    const burst = document.createElement('span');
    burst.className = 'burst';
    btn.appendChild(burst);
    setTimeout(() => burst.remove(), 450);
  }
  btn.classList.add('added');
  setTimeout(()=>btn.classList.remove('added'),500);
}

function updateCartBar() {
  let count = 0, total = 0;
  Object.values(cart).forEach(i=>{count+=i.qty;total+=i.price*i.qty;});
  document.getElementById('cartCount').textContent = count + ' item' + (count!==1?'s':'');
  document.getElementById('cartTotal').textContent = '₱' + total.toFixed(2);
  const bar = document.getElementById('cartBar');
  if(count>0) bar.classList.add('visible'); else bar.classList.remove('visible');
}

function openCart() {
  renderCartItems();
  document.getElementById('cartModal').classList.add('show');
}
function closeCart() {
  document.getElementById('cartModal').classList.remove('show');
}

function renderCartItems() {
  const list = document.getElementById('cartItemsList');
  const items = Object.values(cart).filter(i=>i.qty>0);
  if(!items.length) {
    list.innerHTML = '<div class="empty-cart"><div class="empty-cart-icon">🛒</div><p>Your cart is empty</p></div>';
    document.getElementById('modalTotal').textContent='₱0.00';
    return;
  }
  list.innerHTML='';
  let total=0;
  items.forEach(item=>{
    total+=item.price*item.qty;
    const div=document.createElement('div');
    div.className='cart-item';
    div.innerHTML=`
      <span class="ci-emoji">${item.emoji}</span>
      <div class="ci-info">
        <div class="ci-name">${item.name}</div>
        <div class="ci-price">₱${item.price.toFixed(2)} each</div>
      </div>
      <div class="ci-controls">
        <button class="qty-btn" onclick="changeQty(${item.id},-1)">−</button>
        <span class="qty-num">${item.qty}</span>
        <button class="qty-btn" onclick="changeQty(${item.id},1)">+</button>
      </div>
    `;
    list.appendChild(div);
  });
  document.getElementById('modalTotal').textContent='₱'+total.toFixed(2);
}

function changeQty(id,delta){
  if(!cart[id])return;
  cart[id].qty+=delta;
  if(cart[id].qty<=0)delete cart[id];
  updateCartBar();
  renderCartItems();
}

async function placeOrder() {
  const items = Object.values(cart).filter(i=>i.qty>0);
  if(!items.length) return;
  const btn = document.getElementById('placeOrderBtn');
  btn.disabled=true; btn.textContent='⏳ Placing order...'; btn.classList.add('loading');
  const payload = {
    table_number: tableNum,
    customer_name: document.getElementById('customerName').value || 'Guest',
    notes: document.getElementById('orderNotes').value,
    items: items.map(i=>({id:i.id,name:i.name,price:i.price,quantity:i.qty}))
  };
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=place_order`,{
      method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)
    });
    const data = await res.json();
    if(data.success){
      document.getElementById('successCode').textContent = data.order_code;
      document.getElementById('successOverlay').classList.add('show');
      window._lastOrderCode = data.order_code;
      closeCart();
    }
  } catch(e) {
    alert('❌ Could not connect to server. Please check your WiFi connection and try again.\n\nError: ' + e.message);
  }
  btn.disabled=false; btn.textContent='✓ Place Order';
}

function resetOrder(){
  cart={};
  updateCartBar();
  document.getElementById('successOverlay').classList.remove('show');
  document.getElementById('customerName').value='';
  document.getElementById('orderNotes').value='';
}

function goTrack(){
  const code = window._lastOrderCode || document.getElementById('successCode').textContent;
  if(code && code !== '–'){
    window.location.href = SITE_URL + '/order_track.php?code=' + encodeURIComponent(code) + '&table=' + encodeURIComponent(tableNum);
  }
}


// Show skeleton cards while loading
(function(){
  var container = document.getElementById('menuContainer');
  if(!container) return;
  var html = '';
  for(var s=0;s<3;s++){
    html += '<div style="padding:20px 16px"><div style="height:28px;width:140px;border-radius:8px;margin-bottom:16px;" class="skeleton"></div><div class="menu-grid">';
    for(var i=0;i<4;i++){
      html += '<div class="skel-card"><div class="skeleton skel-img"></div><div class="skel-body"><div class="skeleton skel-line"></div><div class="skeleton skel-line short"></div><div class="skeleton skel-line price"></div></div></div>';
    }
    html += '</div></div>';
  }
  container.innerHTML = html;
})();

loadMenu();
</script>
</body>
</html>
