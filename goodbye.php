<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>KAPITOL CAFE – See You Again!</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --espresso:#1A0A00; --gold:#C8963E; --gold-lt:#E5B96A;
    --cream:#FDF6EC; --latte:#D4A96A;
  }
  * { margin:0; padding:0; box-sizing:border-box; }
  html, body {
    min-height:100vh; width:100%;
    background: linear-gradient(160deg, #0D0600, #1A0A00, #2A1206);
    font-family:'DM Sans',sans-serif;
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    text-align:center; padding:40px 24px;
    overflow:hidden;
  }

  /* Ambient glow */
  body::after {
    content:'';
    position:fixed; inset:0; pointer-events:none;
    background:radial-gradient(ellipse 60% 50% at 50% 50%, rgba(200,150,62,0.14), transparent 70%);
    animation:glow 4s ease-in-out infinite;
  }
  @keyframes glow { 0%,100%{opacity:.6} 50%{opacity:1} }

  .content { position:relative; z-index:10; max-width:360px; }

  .icon {
    font-size:88px;
    display:block; margin-bottom:20px;
    animation:popIn .8s cubic-bezier(.175,.885,.32,1.275) .1s both;
    filter:drop-shadow(0 0 30px rgba(200,150,62,0.7));
  }
  @keyframes popIn {
    0%{ transform:scale(0); opacity:0; }
    70%{ transform:scale(1.15); }
    100%{ transform:scale(1); opacity:1; }
  }

  h1 {
    font-family:'Playfair Display',serif;
    font-size:clamp(28px,8vw,40px);
    font-weight:900; color:var(--gold);
    line-height:1.2; margin-bottom:12px;
    animation:fadeUp .7s ease .4s both;
    text-shadow:0 0 40px rgba(200,150,62,0.35);
  }
  h1 em { font-style:italic; color:var(--gold-lt); }

  p {
    color:rgba(253,246,236,0.55);
    font-size:15px; line-height:1.7;
    margin-bottom:32px;
    animation:fadeUp .7s ease .55s both;
  }
  p strong { color:var(--latte); font-weight:600; }

  .divider {
    display:flex; align-items:center; gap:12px;
    margin-bottom:28px;
    animation:fadeUp .6s ease .6s both;
  }
  .divider-line { flex:1; height:1px; background:rgba(200,150,62,0.2); }
  .divider-icon { color:var(--gold); font-size:16px; opacity:.6; }

  .info-row {
    display:flex; flex-direction:column; gap:10px; margin-bottom:32px;
    animation:fadeUp .7s ease .65s both;
  }
  .info-chip {
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(200,150,62,0.18);
    border-radius:12px; padding:11px 16px;
    display:flex; align-items:center; gap:10px;
    font-size:13px; color:rgba(253,246,236,0.5);
  }
  .info-chip span { font-size:20px; }
  .info-chip strong { color:rgba(253,246,236,0.8); }

  .btn-wrap { animation:fadeUp .7s ease .8s both; }
  .btn-back {
    display:inline-block;
    background:var(--gold); color:var(--espresso);
    border:none; border-radius:14px;
    padding:15px 36px;
    font-size:15px; font-weight:700;
    cursor:pointer; text-decoration:none;
    transition:all .25s; letter-spacing:.3px;
  }
  .btn-back:hover { background:var(--gold-lt); transform:scale(1.04); }

  /* ── EXTRA ANIMATIONS ── */

  /* Content reveal */
  .content { animation: contentReveal .7s cubic-bezier(.175,.885,.32,1.275) .2s both; }
  @keyframes contentReveal {
    from{ opacity:0; transform:scale(.9) translateY(30px); }
    to  { opacity:1; transform:scale(1)  translateY(0); }
  }

  /* Icon hover wiggle */
  .icon { cursor:default; transition:transform .35s cubic-bezier(.175,.885,.32,1.275); }
  .icon:hover { transform:scale(1.25) rotate(15deg); }

  /* Info chips hover lift */
  .info-chip { transition:all .25s ease; cursor:default; }
  .info-chip:hover {
    background:rgba(255,255,255,.08);
    border-color:rgba(200,150,62,.45);
    transform:translateX(5px);
  }

  /* Button ripple */
  .btn-back { position:relative; overflow:hidden; }
  .btn-back .btn-ripple {
    position:absolute; border-radius:50%;
    background:rgba(255,255,255,.3);
    transform:scale(0);
    animation:rippleOut .5s ease-out forwards;
    pointer-events:none;
  }
  @keyframes rippleOut { to{transform:scale(4);opacity:0;} }

  /* Divider line draw animation */
  .divider-line { animation: lineGrow .8s ease .7s both; transform-origin:center; }
  @keyframes lineGrow { from{transform:scaleX(0)} to{transform:scaleX(1)} }

  /* Stars also twinkle */
  .star { animation:starFloat var(--d,6s) ease-in var(--delay,0s) infinite, twinkle 2s ease-in-out var(--delay,0s) infinite; }
  @keyframes twinkle { 0%,100%{filter:brightness(1)} 50%{filter:brightness(2.5)} }

  .note {
    margin-top:16px;
    font-size:11px; color:rgba(253,246,236,0.2);
    letter-spacing:.5px;
    animation:fadeUp .6s ease .9s both;
  }

  @keyframes fadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }

  /* floating stars */
  .star { position:fixed; pointer-events:none; font-size:18px; animation:starFloat var(--d,6s) ease-in var(--delay,0s) infinite; opacity:0; }
  @keyframes starFloat {
    0%{ transform:translateY(0) rotate(0); opacity:0; }
    15%{ opacity:.5; }
    85%{ opacity:.2; }
    100%{ transform:translateY(-100vh) rotate(360deg); opacity:0; }
  }
</style>
</head>
<body>

<!-- Floating stars bg -->
<script>
['✦','·','⋆','✧','☕'].forEach((s,i)=>{
  for(let j=0;j<3;j++){
    const el=document.createElement('div');
    el.className='star';
    el.textContent=s;
    el.style.cssText=`left:${10+i*18+j*5}%;bottom:-20px;--d:${5+Math.random()*5}s;--delay:${Math.random()*4}s`;
    document.body.appendChild(el);
  }
});

// Ripple on btn-back
document.querySelectorAll('.btn-back, .btn-wrap a').forEach(btn => {
  btn.addEventListener('click', function(e) {
    const r = document.createElement('span');
    r.className = 'btn-ripple';
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;`;
    btn.appendChild(r);
    setTimeout(()=>r.remove(), 550);
  });
});
</script>

<div class="content">
  <span class="icon">👋</span>

  <h1>See you <em>again</em><br>soon!</h1>
  <p>Thank you for dining at<br><strong>Kapitol Cafe</strong>.<br>It was a pleasure serving you today. ☕</p>

  <div class="divider">
    <div class="divider-line"></div>
    <div class="divider-icon">✦</div>
    <div class="divider-line"></div>
  </div>

  <div class="info-row">
    <div class="info-chip"><span>🕐</span> Open daily <strong>7AM – 10PM</strong></div>
    <div class="info-chip"><span>📶</span> Free WiFi · <strong>Kapitol Cafe (Password: 00000000)</strong></div>
    <div class="info-chip"><span>💳</span> GCash &amp; Maya <strong>accepted</strong></div>
  </div>

  <div class="btn-wrap">
    <a class="btn-back" href="http://192.168.137.1/kapitol_cafe/table_select.php">☕ Order Again</a>
  </div>
  <div class="note">You can safely close this tab now.</div>
</div>

</body>
</html>
