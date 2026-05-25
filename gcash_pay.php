<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>GCash Payment – Kapitol Cafe</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,600&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --gcash-dark:  #001A6E;
    --gcash-mid:   #003399;
    --gcash-blue:  #0057CC;
    --gcash-light: #1A7FFF;
    --gcash-sky:   #5AAAFF;
    --white:       #FFFFFF;
    --soft:        rgba(255,255,255,0.12);
    --softer:      rgba(255,255,255,0.07);
    --gold:        #F5C842;
    --green:       #00C853;
  }

  *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; -webkit-tap-highlight-color:transparent; }
  html, body {
    min-height:100vh; width:100%;
    font-family:'DM Sans', sans-serif;
    background: linear-gradient(160deg, var(--gcash-dark) 0%, var(--gcash-mid) 50%, var(--gcash-blue) 100%);
    overflow-x:hidden;
    position:relative;
  }

  /* ── ANIMATED BG BLOBS ── */
  .blob {
    position:fixed; border-radius:50%;
    filter:blur(60px); pointer-events:none; z-index:0;
  }
  .blob-1 {
    width:400px; height:400px;
    background:radial-gradient(circle, rgba(26,127,255,0.35), transparent);
    top:-100px; left:-100px;
    animation:blobMove1 10s ease-in-out infinite;
  }
  .blob-2 {
    width:350px; height:350px;
    background:radial-gradient(circle, rgba(0,200,83,0.15), transparent);
    bottom:-80px; right:-80px;
    animation:blobMove2 12s ease-in-out infinite;
  }
  .blob-3 {
    width:250px; height:250px;
    background:radial-gradient(circle, rgba(245,200,66,0.12), transparent);
    top:40%; left:40%; transform:translate(-50%,-50%);
    animation:blobMove3 8s ease-in-out infinite;
  }
  @keyframes blobMove1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(40px,30px)} }
  @keyframes blobMove2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-30px,-40px)} }
  @keyframes blobMove3 { 0%,100%{transform:translate(-50%,-50%) scale(1)} 50%{transform:translate(-50%,-50%) scale(1.3)} }

  /* ── NOISE TEXTURE ── */
  body::before {
    content:'';
    position:fixed; inset:0; z-index:0; pointer-events:none;
    background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
    opacity:.025;
  }

  /* ── CONFETTI CANVAS ── */
  #confetti { position:fixed; inset:0; z-index:1; pointer-events:none; }

  /* ── FLOATING EMOJI PARTICLES ── */
  .floaters { position:fixed; inset:0; z-index:2; pointer-events:none; overflow:hidden; }
  .floater {
    position:absolute; bottom:-40px;
    font-size:20px;
    animation:floatUp var(--d,7s) ease-in var(--delay,0s) both;
    opacity:0;
  }
  @keyframes floatUp {
    0%  { transform:translateY(0) rotate(0deg); opacity:0; }
    10% { opacity:.7; }
    85% { opacity:.3; }
    100%{ transform:translateY(-110vh) rotate(var(--spin,200deg)); opacity:0; }
  }

  /* ── MAIN CARD ── */
  .page-wrap {
    position:relative; z-index:10;
    min-height:100vh;
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    padding:40px 20px 50px;
  }

  .card {
    width:100%; max-width:380px;
    display:flex; flex-direction:column;
    align-items:center;
  }

  /* ── GCASH LOGO BADGE ── */
  .gcash-brand {
    display:flex; align-items:center; gap:10px;
    margin-bottom:32px;
    animation:slideDown .7s cubic-bezier(.175,.885,.32,1.275) .1s both;
  }
  @keyframes slideDown { from{opacity:0;transform:translateY(-24px)} to{opacity:1;transform:translateY(0)} }
  .brand-logo {
    background:white;
    border-radius:12px;
    padding:7px 14px;
    font-size:18px; font-weight:900;
    color:var(--gcash-blue);
    letter-spacing:1px;
    box-shadow:0 4px 20px rgba(0,0,0,0.25);
  }
  .brand-x { color:rgba(255,255,255,0.4); font-size:14px; }
  .cafe-badge {
    background:var(--soft);
    border:1px solid rgba(255,255,255,0.2);
    border-radius:10px; padding:6px 14px;
    font-size:13px; color:rgba(255,255,255,0.85);
    font-weight:600; letter-spacing:.5px;
  }

  /* ── BIG CHECK ICON ── */
  .check-wrap {
    position:relative; margin-bottom:20px;
    animation:popIn .8s cubic-bezier(.175,.885,.32,1.275) .3s both;
  }
  @keyframes popIn { 0%{transform:scale(0) rotate(-30deg);opacity:0} 70%{transform:scale(1.15) rotate(4deg)} 100%{transform:scale(1) rotate(0);opacity:1} }

  .check-circle {
    width:100px; height:100px;
    border-radius:50%;
    background:linear-gradient(135deg, var(--green), #00E676);
    display:flex; align-items:center; justify-content:center;
    box-shadow:
      0 0 0 10px rgba(0,200,83,0.15),
      0 0 0 20px rgba(0,200,83,0.07),
      0 20px 50px rgba(0,0,0,0.3);
    animation:checkPulse 2.5s ease-in-out infinite;
  }
  @keyframes checkPulse {
    0%,100%{ box-shadow:0 0 0 10px rgba(0,200,83,0.15),0 0 0 20px rgba(0,200,83,0.07),0 20px 50px rgba(0,0,0,0.3); }
    50%{ box-shadow:0 0 0 16px rgba(0,200,83,0.2),0 0 0 30px rgba(0,200,83,0.06),0 20px 50px rgba(0,0,0,0.3); }
  }
  .check-icon { font-size:48px; line-height:1; }

  /* ── HEADING ── */
  .sent-title {
    font-family:'Playfair Display', serif;
    font-size:clamp(28px,8vw,38px);
    font-weight:900; color:white;
    text-align:center; margin-bottom:6px;
    line-height:1.15;
    text-shadow:0 2px 20px rgba(0,0,0,0.3);
    animation:fadeUp .7s ease .5s both;
  }
  .sent-title em { font-style:italic; color:var(--gold); }

  .sent-sub {
    font-size:14px; color:rgba(255,255,255,0.6);
    text-align:center; margin-bottom:28px;
    line-height:1.6;
    animation:fadeUp .7s ease .6s both;
  }

  /* ── RECEIPT CARD ── */
  .receipt {
    width:100%;
    background:var(--soft);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:20px;
    overflow:hidden;
    margin-bottom:24px;
    animation:fadeUp .7s ease .65s both;
    backdrop-filter:blur(10px);
  }
  .receipt-header {
    background:rgba(255,255,255,0.08);
    padding:12px 18px;
    display:flex; align-items:center; gap:8px;
    border-bottom:1px solid rgba(255,255,255,0.1);
  }
  .receipt-header-icon { font-size:16px; }
  .receipt-header-text {
    font-size:11px; letter-spacing:2px;
    text-transform:uppercase; color:rgba(255,255,255,0.5);
    font-weight:600;
  }
  .receipt-row {
    display:flex; justify-content:space-between; align-items:center;
    padding:11px 18px;
    border-bottom:1px solid rgba(255,255,255,0.06);
  }
  .receipt-row:last-child { border:none; }
  .r-label { font-size:12px; color:rgba(255,255,255,0.45); }
  .r-value { font-size:13px; font-weight:600; color:rgba(255,255,255,0.9); }
  .r-value.amount {
    font-family:'Playfair Display',serif;
    font-size:22px; font-weight:900;
    color:var(--gold);
  }
  .r-value.green { color:var(--green); }

  /* ── STATUS PILL ── */
  .status-pill {
    display:inline-flex; align-items:center; gap:6px;
    background:rgba(0,200,83,0.15);
    border:1px solid rgba(0,200,83,0.4);
    border-radius:30px; padding:5px 14px;
    font-size:12px; font-weight:700; color:var(--green);
    letter-spacing:.5px;
    animation:fadeUp .6s ease .75s both;
    margin-bottom:28px;
  }
  .status-dot {
    width:7px; height:7px; border-radius:50%;
    background:var(--green);
    animation:blink 1.4s infinite;
  }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }

  /* ── IMPORTANT NOTE ── */
  .note-box {
    width:100%;
    background:rgba(245,200,66,0.1);
    border:1px solid rgba(245,200,66,0.3);
    border-radius:14px; padding:12px 16px;
    margin-bottom:24px;
    animation:fadeUp .7s ease .8s both;
  }
  .note-box p {
    font-size:12px; color:rgba(255,255,255,0.7);
    line-height:1.6;
  }
  .note-box strong { color:var(--gold); }

  /* ── BUTTONS ── */
  .btn-wrap {
    width:100%;
    display:flex; flex-direction:column; gap:10px;
    animation:fadeUp .7s ease .9s both;
  }

  .btn-exit {
    width:100%; padding:16px;
    background:white; color:var(--gcash-blue);
    border:none; border-radius:14px;
    font-size:15px; font-weight:700;
    cursor:pointer; letter-spacing:.3px;
    transition:all .25s;
    display:flex; align-items:center; justify-content:center; gap:8px;
    box-shadow:0 8px 30px rgba(0,0,0,0.25);
  }
  .btn-exit:hover { background:#F0F4FF; transform:scale(1.02); }
  .btn-exit:active { transform:scale(.98); }

  .btn-secondary {
    width:100%; padding:13px;
    background:var(--softer);
    border:1px solid rgba(255,255,255,0.18);
    color:rgba(255,255,255,0.65);
    border-radius:14px; font-size:13px;
    cursor:pointer; transition:all .2s;
  }
  .btn-secondary:hover { background:var(--soft); color:white; }

  /* ── BOTTOM SAFE HINT ── */
  .bottom-hint {
    margin-top:20px;
    font-size:11px; color:rgba(255,255,255,0.2);
    text-align:center; letter-spacing:.5px;
    animation:fadeUp .6s ease 1s both;
  }

  @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }

  /* ── SCREENSHOT REMINDER ── */
  .screenshot-reminder {
    width:100%;
    display:flex; align-items:center; gap:10px;
    background:rgba(255,255,255,0.06);
    border:1px dashed rgba(255,255,255,0.2);
    border-radius:12px; padding:11px 14px;
    margin-bottom:20px;
    animation:fadeUp .7s ease .85s both;
  }
  .sr-icon { font-size:22px; flex-shrink:0; }
  .sr-text { font-size:12px; color:rgba(255,255,255,0.55); line-height:1.5; }
  .sr-text strong { color:rgba(255,255,255,0.85); }
</style>
</head>
<body>

<!-- Ambient blobs -->
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<!-- Confetti canvas -->
<canvas id="confetti"></canvas>

<!-- Floating emoji particles -->
<div class="floaters" id="floaters"></div>

<div class="page-wrap">
  <div class="card">

    <!-- Brand header -->
    <div class="gcash-brand">
      <div class="brand-logo">GCash</div>
      <span class="brand-x">×</span>
      <div class="cafe-badge">☕ Kapitol Cafe</div>
    </div>

    <!-- Big check -->
    <div class="check-wrap">
      <div class="check-circle">
        <span class="check-icon">✓</span>
      </div>
    </div>

    <!-- Heading -->
    <h1 class="sent-title">Payment <em>Sent!</em></h1>
    <p class="sent-sub">Your GCash payment has been<br>successfully sent to Kapitol Cafe.</p>

    <!-- Status pill -->
    <div class="status-pill">
      <span class="status-dot"></span>
      PAYMENT SENT
    </div>

    <!-- Receipt -->
    <div class="receipt">
      <div class="receipt-header">
        <span class="receipt-header-icon">🧾</span>
        <span class="receipt-header-text">Transaction Summary</span>
      </div>
      <div class="receipt-row">
        <span class="r-label">Amount</span>
        <span class="r-value amount" id="dispAmount">₱0.00</span>
      </div>
      <div class="receipt-row">
        <span class="r-label">Sent To</span>
        <span class="r-value" id="dispTo">–</span>
      </div>
      <div class="receipt-row">
        <span class="r-label">Merchant</span>
        <span class="r-value">Kapitol Cafe ☕</span>
      </div>
      <div class="receipt-row">
        <span class="r-label">Reference</span>
        <span class="r-value" id="dispRef">–</span>
      </div>
      <div class="receipt-row">
        <span class="r-label">Date & Time</span>
        <span class="r-value" id="dispTime">–</span>
      </div>
      <div class="receipt-row">
        <span class="r-label">Status</span>
        <span class="r-value green">✓ Completed</span>
      </div>
    </div>

    <!-- Screenshot reminder -->
    <div class="screenshot-reminder">
      <span class="sr-icon">📸</span>
      <p class="sr-text"><strong>Save your proof of payment.</strong> Take a screenshot and show it to the cashier to confirm your payment.</p>
    </div>

    <!-- Important note -->
    <div class="note-box">
      <p>⚠️ <strong>Important:</strong> Please show this screen or your GCash receipt to our cashier for final payment confirmation. Thank you!</p>
    </div>

    <!-- Buttons -->
    <div class="btn-wrap">
      <button class="btn-exit" onclick="exitPage()">
        🚪 Done — Exit
      </button>
      <button class="btn-secondary" onclick="goMenu()">
        ☕ Back to Menu
      </button>
    </div>

    <div class="bottom-hint">You can safely close this page after payment.</div>

  </div>
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';
const params   = new URLSearchParams(window.location.search);
const amount   = params.get('amount') || '0.00';
const ref      = params.get('ref')    || '–';
const to       = params.get('to')     || '09XX-XXX-XXXX';

// Fill receipt
document.getElementById('dispAmount').textContent = '₱' + parseFloat(amount).toFixed(2);
document.getElementById('dispTo').textContent     = to + ' (Kapitol Cafe)';
document.getElementById('dispRef').textContent    = ref;
document.getElementById('dispTime').textContent   = new Date().toLocaleString('en-PH', {
  month:'short', day:'numeric', year:'numeric',
  hour:'2-digit', minute:'2-digit'
});

// ── CONFETTI ──
(function(){
  const canvas = document.getElementById('confetti');
  const ctx    = canvas.getContext('2d');
  canvas.width  = window.innerWidth;
  canvas.height = window.innerHeight;

  const colors = ['#00C853','#1A7FFF','#F5C842','#FFFFFF','#5AAAFF','#00E676','#FFD700'];
  const pieces = Array.from({length:100}, () => ({
    x:     Math.random() * canvas.width,
    y:     Math.random() * canvas.height - canvas.height,
    w:     Math.random() * 9 + 4,
    h:     Math.random() * 5 + 2,
    color: colors[Math.floor(Math.random() * colors.length)],
    rot:   Math.random() * Math.PI * 2,
    rotS:  (Math.random() - .5) * .12,
    vx:    (Math.random() - .5) * 2.5,
    vy:    Math.random() * 3.5 + 1.5,
    alpha: 1,
  }));

  let frame = 0;
  function draw(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    pieces.forEach(p => {
      ctx.save();
      ctx.globalAlpha = p.alpha;
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
      ctx.restore();
      p.x += p.vx; p.y += p.vy; p.rot += p.rotS;
      if (frame > 70) p.alpha -= 0.007;
    });
    frame++;
    if (frame < 180) requestAnimationFrame(draw);
  }
  draw();
})();

// ── FLOATING EMOJIS ──
(function(){
  const container = document.getElementById('floaters');
  const emojis = ['✅','💸','☕','✨','💚','🎉','💙','💰','☕','🌟'];
  emojis.forEach((em, i) => {
    const el = document.createElement('div');
    el.className = 'floater';
    el.textContent = em;
    el.style.cssText =
      `left:${5 + i * 9.5}%;` +
      `--d:${5 + Math.random()*4}s;` +
      `--delay:${Math.random()*2}s;` +
      `--spin:${(Math.random()>.5?1:-1)*180}deg`;
    container.appendChild(el);
  });
})();

// ── BUTTONS ──
function exitPage(){
  window.close();
  setTimeout(() => { window.location.href = SITE_URL + '/goodbye.php'; }, 300);
}

function goMenu(){
  window.location.href = SITE_URL + '/table_select.php';
}
</script>
</body>
</html>
