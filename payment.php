<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KAPITOL CAFE – Payment</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<style>
  :root{
    --espresso:#1A0A00;--brown:#3B1F0E;--gold:#C8963E;
    --gold-light:#E5B96A;--cream:#FDF6EC;--foam:#F5ECD7;
    --green:#2E7D32;--gcash:#0066CC;--maya:#6B21A8;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:var(--espresso);font-family:'DM Sans',sans-serif;color:var(--cream);min-height:100vh;}

  /* BG */
  .bg-deco{position:fixed;inset:0;pointer-events:none;overflow:hidden;}
  .bg-deco::before{content:'';position:absolute;top:-200px;left:-200px;width:700px;height:700px;background:radial-gradient(circle,rgba(200,150,62,0.08),transparent);border-radius:50%;}
  .bg-deco::after{content:'';position:absolute;bottom:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(200,150,62,0.05),transparent);border-radius:50%;}

  .payment-container{
    max-width:500px;margin:0 auto;
    padding:40px 20px;
    min-height:100vh;
    display:flex;flex-direction:column;
    position:relative;z-index:10;
  }

  /* HEADER */
  .pay-header{text-align:center;margin-bottom:32px;animation:fadeDown 0.6s ease;}
  @keyframes fadeDown{from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:translateY(0)}}
  .pay-logo{font-size:48px;margin-bottom:8px;}
  .pay-brand{font-family:'Playfair Display',serif;color:var(--gold);font-size:28px;letter-spacing:3px;font-weight:900;}
  .pay-sub{color:rgba(253,246,236,0.5);font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-top:4px;}

  /* ORDER SUMMARY */
  .order-summary{
    background:rgba(253,246,236,0.05);
    border:1px solid rgba(200,150,62,0.2);
    border-radius:20px;
    padding:20px;
    margin-bottom:24px;
    animation:fadeUp 0.6s ease 0.1s both;
  }
  @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  .summary-row{
    display:flex;justify-content:space-between;
    padding:8px 0;border-bottom:1px solid rgba(253,246,236,0.08);
    font-size:14px;
  }
  .summary-row:last-child{border:none;}
  .summary-label{color:rgba(253,246,236,0.5);}
  .summary-value{font-weight:600;color:var(--cream);}
  .total-row{
    display:flex;justify-content:space-between;align-items:center;
    padding:14px 0 0;
    margin-top:4px;
    border-top:1px solid rgba(200,150,62,0.3);
  }
  .total-label{color:var(--cream);font-weight:600;font-size:15px;}
  .total-amount{font-size:32px;font-weight:900;color:var(--gold-light);}

  /* PAYMENT METHOD TABS */
  .method-tabs{
    display:flex;gap:8px;margin-bottom:20px;
    animation:fadeUp 0.6s ease 0.2s both;
  }
  .method-tab{
    flex:1;padding:12px 8px;text-align:center;
    background:rgba(253,246,236,0.05);
    border:1.5px solid rgba(200,150,62,0.2);
    border-radius:12px;cursor:pointer;transition:all 0.3s;
    font-size:13px;font-weight:600;color:rgba(253,246,236,0.6);
  }
  .method-tab:hover{border-color:var(--gold);color:var(--cream);}
  .method-tab.active{background:rgba(200,150,62,0.15);border-color:var(--gold);color:var(--gold);}
  .method-icon{font-size:24px;display:block;margin-bottom:4px;}

  /* QR PAYMENT CARD */
  .qr-card{
    background:rgba(253,246,236,0.05);
    border:1px solid rgba(200,150,62,0.25);
    border-radius:24px;
    padding:28px;
    text-align:center;
    animation:fadeUp 0.6s ease 0.3s both;
    margin-bottom:20px;
  }
  .qr-payment-header{
    margin-bottom:20px;
  }
  .qr-method-name{
    font-family:'Playfair Display',serif;
    font-size:22px;font-weight:700;
    margin-bottom:4px;
  }
  .qr-account{font-size:13px;color:rgba(253,246,236,0.6);}
  .qr-wrapper-pay{
    background:white;border-radius:20px;padding:16px;
    display:inline-block;margin-bottom:16px;
    box-shadow:0 0 60px rgba(200,150,62,0.3);
    animation:glow 2s ease-in-out infinite;
  }
  @keyframes glow{
    0%,100%{box-shadow:0 0 30px rgba(200,150,62,0.2);}
    50%{box-shadow:0 0 60px rgba(200,150,62,0.5);}
  }
  .qr-instructions{color:rgba(253,246,236,0.7);font-size:13px;line-height:1.6;}
  .qr-amount-display{
    background:rgba(200,150,62,0.15);
    border:1px solid rgba(200,150,62,0.4);
    border-radius:12px;
    padding:10px 20px;
    margin:14px auto;
    display:inline-block;
    color:var(--gold-light);
    font-size:20px;font-weight:900;
  }

  /* CASH PAYMENT */
  .cash-card{
    background:rgba(253,246,236,0.05);
    border:1px solid rgba(200,150,62,0.25);
    border-radius:24px;
    padding:28px;
    text-align:center;
    animation:fadeUp 0.6s ease 0.3s both;
    margin-bottom:20px;
  }
  .cash-icon{font-size:80px;margin-bottom:16px;}
  .cash-msg{color:var(--cream);font-size:16px;margin-bottom:8px;}
  .cash-msg strong{color:var(--gold);}

  /* STATUS STEPS */
  .status-steps{
    display:flex;gap:0;margin-bottom:24px;
    animation:fadeUp 0.6s ease 0.4s both;
  }
  .step{
    flex:1;text-align:center;position:relative;
    padding:0 4px;
  }
  .step::after{
    content:'';position:absolute;
    top:16px;left:60%;width:80%;height:2px;
    background:rgba(200,150,62,0.2);
  }
  .step:last-child::after{display:none;}
  .step-dot{
    width:32px;height:32px;border-radius:50%;
    border:2px solid rgba(200,150,62,0.3);
    margin:0 auto 6px;
    display:flex;align-items:center;justify-content:center;
    font-size:14px;
    position:relative;z-index:1;
    transition:all 0.5s;
  }
  .step.active .step-dot{border-color:var(--gold);background:rgba(200,150,62,0.2);}
  .step.done .step-dot{background:var(--gold);border-color:var(--gold);color:var(--espresso);}
  .step-label{font-size:10px;color:rgba(253,246,236,0.5);letter-spacing:0.5px;}
  .step.active .step-label,.step.done .step-label{color:var(--gold);}

  /* Footer note */
  .pay-note{
    text-align:center;
    color:rgba(253,246,236,0.4);
    font-size:12px;
    margin-top:auto;
    padding-top:20px;
    animation:fadeUp 0.6s ease 0.6s both;
  }

  /* Paid success */
  .paid-screen{
    display:none;
    text-align:center;
    padding:40px 20px;
    animation:scaleIn 0.6s cubic-bezier(0.175,0.885,0.32,1.275);
  }
  @keyframes scaleIn{from{opacity:0;transform:scale(0.8)}to{opacity:1;transform:scale(1)}}
  .paid-screen.show{display:block;}
  .paid-icon{font-size:100px;margin-bottom:20px;}
  .paid-title{font-family:'Playfair Display',serif;font-size:36px;color:var(--gold);margin-bottom:8px;}
  .paid-msg{color:rgba(253,246,236,0.7);font-size:15px;line-height:1.7;}
  .paid-code{
    background:rgba(200,150,62,0.15);border:1px solid var(--gold);
    border-radius:14px;padding:12px 24px;
    margin:20px auto;display:inline-block;
    font-family:'Playfair Display',serif;font-size:28px;color:var(--gold);font-weight:700;
  }

  /* ── EXTRA ANIMATIONS ── */

  /* Staggered QR card panel switch */
  .qr-card, .cash-card {
    animation: panelReveal .4s cubic-bezier(.175,.885,.32,1.275) both;
  }
  @keyframes panelReveal {
    from{ opacity:0; transform:translateY(16px) scale(.97); }
    to  { opacity:1; transform:translateY(0)    scale(1); }
  }

  /* Method tab press */
  .method-tab { position:relative; overflow:hidden; }
  .method-tab .tab-ink {
    position:absolute; border-radius:50%;
    background:rgba(200,150,62,.2);
    transform:scale(0);
    animation:rippleOut .4s ease-out forwards;
    pointer-events:none;
  }
  @keyframes rippleOut { to{ transform:scale(5); opacity:0; } }

  /* QR glow pulse */
  .qr-wrapper-pay {
    animation: qrPulse 3s ease-in-out infinite;
  }
  @keyframes qrPulse {
    0%,100%{ box-shadow:0 0 30px rgba(200,150,62,.2); }
    50%    { box-shadow:0 0 60px rgba(200,150,62,.5); }
  }

  /* Amount display pop */
  .qr-amount-display {
    animation: amountPop .6s cubic-bezier(.175,.885,.32,1.275) .4s both;
  }
  @keyframes amountPop {
    from{ transform:scale(.7); opacity:0; }
    to  { transform:scale(1);  opacity:1; }
  }

  /* Step dots cascade */
  .step:nth-child(1) .step-dot { animation: dotIn .4s ease .05s both; }
  .step:nth-child(2) .step-dot { animation: dotIn .4s ease .15s both; }
  .step:nth-child(3) .step-dot { animation: dotIn .4s ease .25s both; }
  .step:nth-child(4) .step-dot { animation: dotIn .4s ease .35s both; }
  @keyframes dotIn {
    from{ transform:scale(0); opacity:0; }
    to  { transform:scale(1); opacity:1; }
  }

  /* Page header fade */
  .pay-header { animation: fadeDown .5s ease both; }
  @keyframes fadeDown {
    from{ opacity:0; transform:translateY(-18px); }
    to  { opacity:1; transform:translateY(0); }
  }

  /* Order summary slide */
  #orderSummary { animation: fadeUp .5s ease .15s both; }
  @keyframes fadeUp {
    from{ opacity:0; transform:translateY(16px); }
    to  { opacity:1; transform:translateY(0); }
  }

  /* Success screen */
  #paidScreen .paid-screen {
    animation: scaleReveal .6s cubic-bezier(.175,.885,.32,1.275) both;
  }
  @keyframes scaleReveal {
    from{ opacity:0; transform:scale(.85); }
    to  { opacity:1; transform:scale(1); }
  }

  /* Total amount counter feel */
  .total-amount {
    animation: countUp .5s ease .3s both;
  }
  @keyframes countUp {
    from{ opacity:0; transform:translateY(10px); }
    to  { opacity:1; transform:translateY(0); }
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">Payment Gateway</div>
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
  var msgs=['Loading payment details...', 'Generating QR code...', 'Almost ready...', 'Payment ready! 💳'];
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
<div class="bg-deco"></div>

<div class="payment-container" id="paymentContainer">

  <div class="pay-header">
    <div class="pay-logo">☕</div>
    <div class="pay-brand">KAPITOL CAFE</div>
    <div class="pay-sub">Secure Payment</div>
  </div>

  <!-- PROGRESS STEPS -->
  <div class="status-steps">
    <div class="step done"><div class="step-dot">✓</div><div class="step-label">Order</div></div>
    <div class="step done"><div class="step-dot">✓</div><div class="step-label">Prepare</div></div>
    <div class="step active"><div class="step-dot">💳</div><div class="step-label">Pay</div></div>
    <div class="step"><div class="step-dot">🍽️</div><div class="step-label">Enjoy</div></div>
  </div>

  <!-- ORDER SUMMARY -->
  <div class="order-summary" id="orderSummary">
    <div class="summary-row"><span class="summary-label">Order Code</span><span class="summary-value" id="dispCode">Loading...</span></div>
    <div class="summary-row"><span class="summary-label">Table</span><span class="summary-value" id="dispTable">–</span></div>
    <div class="summary-row"><span class="summary-label">Customer</span><span class="summary-value" id="dispName">–</span></div>
    <div class="total-row">
      <span class="total-label">Total Amount</span>
      <span class="total-amount" id="dispTotal">₱0.00</span>
    </div>
  </div>

  <!-- PAYMENT METHOD TABS -->
  <div class="method-tabs">
    <div class="method-tab active" onclick="selectPayMethod('gcash', this)">
      <span class="method-icon">📱</span>GCash
    </div>
    <div class="method-tab" onclick="selectPayMethod('maya', this)">
      <span class="method-icon">💜</span>Maya
    </div>
    <div class="method-tab" onclick="selectPayMethod('cash', this)">
      <span class="method-icon">💵</span>Cash
    </div>
  </div>

  <!-- GCASH QR -->
  <div class="qr-card" id="gcash-panel">
    <div class="qr-payment-header">
      <div class="qr-method-name" style="color:#0066CC">📱 GCash Payment</div>
      <div class="qr-account">Send to: <strong>09XX-XXX-XXXX</strong> · Kapitol Cafe</div>
    </div>
    <div class="qr-amount-display" id="gcashAmount">₱0.00</div>
    <div class="qr-wrapper-pay"><div id="gcashQR"></div></div>
    <div class="qr-instructions">
      Open GCash → Scan QR → Enter exact amount → Send<br>
      <strong style="color:#FFA726">Screenshot your receipt as proof of payment.</strong>
    </div>
  </div>

  <!-- MAYA QR -->
  <div class="qr-card" id="maya-panel" style="display:none">
    <div class="qr-payment-header">
      <div class="qr-method-name" style="color:#6B21A8">💜 Maya Payment</div>
      <div class="qr-account">Send to: <strong>09XX-XXX-XXXX</strong> · Kapitol Cafe</div>
    </div>
    <div class="qr-amount-display" id="mayaAmount">₱0.00</div>
    <div class="qr-wrapper-pay"><div id="mayaQR"></div></div>
    <div class="qr-instructions">
      Open Maya App → Scan QR → Confirm amount → Pay<br>
      <strong style="color:#FFA726">Screenshot your receipt as proof of payment.</strong>
    </div>
  </div>

  <!-- CASH -->
  <div class="cash-card" id="cash-panel" style="display:none">
    <div class="cash-icon">💵</div>
    <div class="cash-msg">Please proceed to the <strong>cashier counter</strong><br>and present your order code.</div>
    <div style="background:rgba(200,150,62,0.15);border:1px solid var(--gold);border-radius:12px;padding:12px 24px;margin:16px auto;display:inline-block;">
      <div style="font-size:12px;color:rgba(253,246,236,0.5);letter-spacing:2px;text-transform:uppercase;">Your Order Code</div>
      <div style="font-family:'Playfair Display',serif;font-size:28px;color:var(--gold);font-weight:700;" id="cashCode">–</div>
    </div>
    <div style="font-size:13px;color:rgba(253,246,236,0.5);margin-top:8px;">Amount Due: <strong style="color:var(--gold-light)" id="cashAmount">₱0.00</strong></div>
  </div>

  <div class="pay-note">🔒 All transactions are secure. Thank you for dining with us!</div>
</div>

<!-- SUCCESS -->
<div class="payment-container" id="paidScreen" style="display:none">
  <div class="paid-screen show">
    <div class="paid-icon">🎉</div>
    <div class="paid-title">Payment Received!</div>
    <p class="paid-msg">Thank you for dining at<br><strong style="color:var(--gold)">KAPITOL CAFE</strong><br>We hope to see you again! ☕</p>
    <div class="paid-code" id="paidCode">–</div>
    <p class="paid-msg" style="font-size:13px;margin-top:8px;">Your receipt code · Visit us again!</p>
    <button onclick="window.location.href='menu.php'"
      style="margin-top:24px;background:var(--gold);color:var(--espresso);border:none;padding:14px 32px;border-radius:30px;font-weight:700;font-size:15px;cursor:pointer;transition:all 0.3s;">
      ☕ Order Again
    </button>
  </div>
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';
const params = new URLSearchParams(window.location.search);
const orderId = params.get('order_id');
const orderCode = params.get('code') || 'KAP-DEMO01';
const tableNum = params.get('table') || 'T01';
const totalAmt = parseFloat(params.get('total') || '0');
const customerName = params.get('name') || 'Guest';

// Fill in data
document.getElementById('dispCode').textContent = orderCode;
document.getElementById('dispTable').textContent = tableNum;
document.getElementById('dispName').textContent = customerName;
document.getElementById('dispTotal').textContent = '₱' + totalAmt.toFixed(2);
document.getElementById('gcashAmount').textContent = '₱' + totalAmt.toFixed(2);
document.getElementById('mayaAmount').textContent = '₱' + totalAmt.toFixed(2);
document.getElementById('cashAmount').textContent = '₱' + totalAmt.toFixed(2);
document.getElementById('cashCode').textContent = orderCode;

// Generate GCash QR (simulated with payment data string)
const gcashData = `GCash Payment\nAmount: PHP ${totalAmt.toFixed(2)}\nTo: Kapitol Cafe\nRef: ${orderCode}`;
new QRCode(document.getElementById('gcashQR'), {
  text: gcashData, width:200, height:200,
  colorDark:'#0066CC', colorLight:'#FFFFFF',
  correctLevel: QRCode.CorrectLevel.M
});

// Generate Maya QR
const mayaData = `Maya Payment\nAmount: PHP ${totalAmt.toFixed(2)}\nTo: Kapitol Cafe\nRef: ${orderCode}`;
new QRCode(document.getElementById('mayaQR'), {
  text: mayaData, width:200, height:200,
  colorDark:'#6B21A8', colorLight:'#FFFFFF',
  correctLevel: QRCode.CorrectLevel.M
});

function selectPayMethod(method, el){
  document.querySelectorAll('.method-tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  // Ripple ink
  const ink = document.createElement('span');
  ink.className = 'tab-ink';
  ink.style.cssText = `width:${el.offsetWidth}px;height:${el.offsetHeight}px;left:0;top:0;`;
  el.appendChild(ink);
  setTimeout(()=>ink.remove(), 450);
  // Hide all panels
  ['gcash-panel','maya-panel','cash-panel'].forEach(id=>{
    const p = document.getElementById(id);
    p.style.display='none';
  });
  const panel = document.getElementById(method+'-panel');
  panel.style.display='block';
  panel.style.animation='none';
  requestAnimationFrame(()=>{ panel.style.animation='panelReveal .4s cubic-bezier(.175,.885,.32,1.275) both'; });
}

// Demo: mark as paid after 30s (for demo purposes)
// In production, this would be handled by webhook or manual cashier confirmation
</script>

<script>window.addEventListener('load', function(){ setTimeout(function(){ if(window._hideSplash) window._hideSplash(); }, 400); });</script>
</body>
</html>
