<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>KAPITOL CAFE – Track Your Order</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --espresso:#1A0A00; --brown:#3B1F0E; --gold:#C8963E; --gold-lt:#E5B96A;
    --cream:#FDF6EC; --foam:#F5ECD7;
    --green:#2E7D32; --green-lt:#4CAF50;
    --orange:#E65100; --orange-lt:#FF9800;
    --blue:#1565C0; --blue-lt:#42A5F5;
    --purple:#6A1B9A; --purple-lt:#AB47BC;
    --red:#C62828; --red-lt:#EF5350;
    --gray:#888;
  }
  * { margin:0; padding:0; box-sizing:border-box; -webkit-tap-highlight-color:transparent; }
  html, body { min-height:100vh; background:#F0E8D8; font-family:'DM Sans',sans-serif; }

  /* ── HEADER ── */
  .header {
    background: var(--espresso);
    padding: 16px 20px;
    display: flex; align-items:center; justify-content:space-between;
    position: sticky; top:0; z-index:100;
    box-shadow: 0 4px 24px rgba(0,0,0,0.4);
  }
  .header-left { display:flex; align-items:center; gap:10px; }
  .header-logo { font-size:26px; }
  .header-name {
    font-family:'Playfair Display',serif;
    color:var(--gold); font-size:18px; font-weight:900; letter-spacing:2px;
  }
  .header-back {
    background:rgba(200,150,62,0.15);
    border:1px solid rgba(200,150,62,0.4);
    color:var(--gold); padding:7px 14px;
    border-radius:20px; font-size:12px;
    font-weight:600; cursor:pointer;
    transition:all .2s; text-decoration:none;
    display:flex; align-items:center; gap:5px;
  }
  .header-back:hover { background:rgba(200,150,62,0.3); }

  /* ── BODY ── */
  .page-body { padding:20px 16px 100px; max-width:480px; margin:0 auto; }

  /* ── SEARCH BAR ── */
  .search-box {
    background:white; border-radius:16px; padding:16px;
    box-shadow:0 2px 16px rgba(0,0,0,0.08);
    margin-bottom:20px;
    animation: fadeDown .5s ease;
  }
  @keyframes fadeDown { from{opacity:0;transform:translateY(-14px)} to{opacity:1;transform:translateY(0)} }
  .search-label { font-size:12px; color:var(--gray); letter-spacing:1px; text-transform:uppercase; margin-bottom:8px; }
  .search-row { display:flex; gap:8px; }
  .search-input {
    flex:1; padding:11px 14px;
    border:1.5px solid #E0D5C8;
    border-radius:10px; font-family:inherit; font-size:15px;
    outline:none; transition:border-color .2s;
    text-transform:uppercase; letter-spacing:1px;
    font-weight:600; color:var(--espresso);
  }
  .search-input:focus { border-color:var(--gold); }
  .search-btn {
    background:var(--espresso); color:var(--gold);
    border:none; padding:11px 18px; border-radius:10px;
    font-size:14px; font-weight:700; cursor:pointer;
    transition:all .2s; white-space:nowrap;
  }
  .search-btn:hover { background:var(--brown); }
  .search-btn:disabled { opacity:.5; cursor:not-allowed; }

  /* ── AUTO-REFRESH BADGE ── */
  .refresh-badge {
    display:flex; align-items:center; gap:6px;
    font-size:11px; color:var(--gray);
    margin-bottom:16px; justify-content:center;
    animation: fadeUp .4s ease .1s both;
  }
  .live-dot {
    width:7px;height:7px;border-radius:50%;
    background:var(--green-lt);
    animation:blink 1.4s infinite;
  }
  @keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
  @keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

  /* ── ORDER CARD ── */
  .order-card {
    background:white; border-radius:20px;
    overflow:hidden;
    box-shadow:0 4px 24px rgba(0,0,0,0.09);
    animation: fadeUp .5s ease .05s both;
    margin-bottom:16px;
  }

  /* TOP BANNER — color changes by status */
  .order-banner {
    padding:20px 20px 18px;
    position:relative; overflow:hidden;
  }
  .order-banner::after {
    content:''; position:absolute; right:-20px; top:-20px;
    width:100px; height:100px; border-radius:50%;
    background:rgba(255,255,255,0.08);
  }
  .banner-status-icon { font-size:44px; margin-bottom:8px; display:block; }
  .banner-status-label {
    font-family:'Playfair Display',serif;
    font-size:24px; font-weight:900; color:white;
    margin-bottom:4px;
  }
  .banner-status-desc { font-size:13px; color:rgba(255,255,255,0.75); line-height:1.5; }

  .order-meta {
    padding:16px 20px;
    border-bottom:1px solid var(--foam);
    display:flex; flex-wrap:wrap; gap:12px;
  }
  .meta-chip {
    display:flex; align-items:center; gap:5px;
    background:var(--foam); border-radius:20px;
    padding:5px 12px; font-size:12px; color:#666;
  }
  .meta-chip strong { color:var(--espresso); font-weight:700; }

  /* ── PROGRESS TRACKER ── */
  .progress-section { padding:20px 20px 10px; }
  .progress-title { font-size:11px; color:var(--gray); letter-spacing:2px; text-transform:uppercase; margin-bottom:18px; }

  .steps-list { position:relative; padding-left:32px; }
  .steps-list::before {
    content:''; position:absolute; left:11px; top:12px;
    width:2px; bottom:12px;
    background:linear-gradient(to bottom, var(--green-lt) var(--fill,0%), #E0D5C8 var(--fill,0%));
    transition: --fill 1s ease;
  }

  .step-row {
    display:flex; align-items:flex-start; gap:12px;
    margin-bottom:22px; position:relative;
  }
  .step-row:last-child { margin-bottom:0; }

  .step-circle {
    width:24px; height:24px; border-radius:50%;
    flex-shrink:0; margin-left:-32px;
    display:flex; align-items:center; justify-content:center;
    font-size:13px;
    border:2.5px solid #DDD;
    background:white;
    transition:all .5s ease;
    position:relative; z-index:1;
  }
  .step-circle.done {
    background:var(--green-lt); border-color:var(--green-lt); color:white;
  }
  .step-circle.active {
    background:var(--gold); border-color:var(--gold); color:white;
    animation:stepPulse 1.5s infinite;
  }
  @keyframes stepPulse {
    0%,100%{ box-shadow:0 0 0 0 rgba(200,150,62,.6); }
    50%{ box-shadow:0 0 0 8px rgba(200,150,62,0); }
  }
  .step-circle.pending { background:white; border-color:#DDD; color:#CCC; }

  .step-content { flex:1; padding-top:2px; }
  .step-name {
    font-weight:700; font-size:14px;
    transition:color .3s;
  }
  .step-name.done { color:var(--green); }
  .step-name.active { color:var(--brown); }
  .step-name.pending { color:#BBB; }
  .step-desc { font-size:12px; color:#aaa; margin-top:2px; line-height:1.4; }
  .step-desc.active { color:#888; }
  .step-time { font-size:11px; color:#CCC; margin-top:3px; font-style:italic; }

  /* ── ITEMS LIST ── */
  .items-section {
    padding:16px 20px;
    border-top:1px solid var(--foam);
  }
  .items-title { font-size:11px; color:var(--gray); letter-spacing:2px; text-transform:uppercase; margin-bottom:12px; }
  .order-item-row {
    display:flex; align-items:center; gap:10px;
    padding:8px 0; border-bottom:1px solid var(--foam);
  }
  .order-item-row:last-child { border:none; }
  .item-qty-badge {
    background:var(--espresso); color:var(--gold);
    width:26px; height:26px; border-radius:7px;
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:900; flex-shrink:0;
  }
  .item-name { flex:1; font-size:14px; color:var(--espresso); font-weight:500; }
  .item-price { font-size:13px; color:var(--gray); }

  /* ── TOTAL ── */
  .total-section {
    padding:14px 20px 18px;
    border-top:2px solid var(--foam);
    display:flex; justify-content:space-between; align-items:center;
  }
  .total-label { font-weight:600; color:#666; font-size:14px; }
  .total-amount { font-family:'Playfair Display',serif; font-size:24px; font-weight:900; color:var(--gold); }

  /* ── PAYMENT STATUS ── */
  .payment-row {
    padding:12px 20px;
    background:var(--foam);
    display:flex; align-items:center; justify-content:space-between;
  }
  .pay-label { font-size:12px; color:#888; }
  .pay-badge {
    padding:4px 12px; border-radius:20px;
    font-size:12px; font-weight:700;
  }
  .pay-unpaid { background:rgba(239,83,80,.12); color:var(--red-lt); border:1px solid rgba(239,83,80,.3); }
  .pay-paid   { background:rgba(76,175,80,.12);  color:var(--green-lt); border:1px solid rgba(76,175,80,.3); }

  /* ── ETA BANNER ── */
  .eta-banner {
    margin:0 20px 16px;
    background:linear-gradient(135deg,rgba(200,150,62,.12),rgba(200,150,62,.05));
    border:1px solid rgba(200,150,62,.3);
    border-radius:14px; padding:12px 16px;
    display:flex; align-items:center; gap:10px;
  }
  .eta-icon { font-size:26px; }
  .eta-text { flex:1; }
  .eta-label { font-size:11px; color:var(--gray); letter-spacing:1px; text-transform:uppercase; }
  .eta-value { font-weight:700; color:var(--brown); font-size:15px; }

  /* ── EMPTY / ERROR ── */
  .empty-state {
    text-align:center; padding:60px 20px;
    background:white; border-radius:20px;
    box-shadow:0 2px 16px rgba(0,0,0,.06);
    animation:fadeUp .5s ease;
  }
  .empty-icon { font-size:64px; margin-bottom:14px; }
  .empty-title { font-family:'Playfair Display',serif; font-size:22px; color:var(--espresso); margin-bottom:8px; }
  .empty-desc { font-size:14px; color:var(--gray); line-height:1.6; }

  /* ── BOTTOM ACTION ── */
  .bottom-actions {
    position:fixed; bottom:0; left:0; right:0;
    background:white;
    border-top:1px solid var(--foam);
    padding:12px 16px;
    display:flex; gap:10px;
    box-shadow:0 -4px 20px rgba(0,0,0,.08);
    z-index:50;
  }
  .btn-menu {
    flex:1; padding:13px;
    background:var(--espresso); color:var(--gold);
    border:none; border-radius:12px;
    font-size:14px; font-weight:700; cursor:pointer;
    transition:all .2s; text-decoration:none;
    display:flex; align-items:center; justify-content:center; gap:6px;
  }
  .btn-menu:hover { background:var(--brown); }
  .btn-refresh-bottom {
    padding:13px 18px;
    background:var(--foam); color:var(--brown);
    border:1.5px solid #DDD; border-radius:12px;
    font-size:14px; font-weight:700; cursor:pointer;
    transition:all .2s;
  }
  .btn-refresh-bottom:hover { background:#E8DDD0; }

  /* ── EXTRA ANIMATIONS ── */

  /* Page entrance */
  @keyframes pageIn { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
  .page-body { animation: pageIn .5s ease both; }

  /* Header */
  .header { animation: headerDown .4s cubic-bezier(.22,.68,0,1.2) both; }
  @keyframes headerDown { from{transform:translateY(-100%);opacity:0} to{transform:translateY(0);opacity:1} }

  /* Order card reveal */
  .order-card { animation: cardReveal .55s cubic-bezier(.175,.885,.32,1.275) .1s both; }
  @keyframes cardReveal { from{opacity:0;transform:scale(.95) translateY(20px)} to{opacity:1;transform:scale(1) translateY(0)} }

  /* Status banner pulse (only for active states) */
  .order-banner.pulsing { animation: statusPulse 2.5s ease-in-out infinite; }
  @keyframes statusPulse {
    0%,100%{ box-shadow:inset 0 0 0 0 rgba(255,255,255,0); }
    50%    { box-shadow:inset 0 0 30px rgba(255,255,255,.07); }
  }

  /* Step circle pop when becoming active */
  .step-circle.active { animation: stepPop .5s cubic-bezier(.175,.885,.32,1.275) both; }
  @keyframes stepPop {
    0%  { transform:scale(.5); opacity:0; }
    70% { transform:scale(1.2); }
    100%{ transform:scale(1); opacity:1; }
  }

  /* Stagger step rows */
  .step-row:nth-child(1) { animation: fadeUp .35s ease .1s both; }
  .step-row:nth-child(2) { animation: fadeUp .35s ease .18s both; }
  .step-row:nth-child(3) { animation: fadeUp .35s ease .26s both; }
  .step-row:nth-child(4) { animation: fadeUp .35s ease .34s both; }
  .step-row:nth-child(5) { animation: fadeUp .35s ease .42s both; }
  .step-row:nth-child(6) { animation: fadeUp .35s ease .5s  both; }

  /* Order items stagger */
  .order-item-row { animation: itemIn .35s ease both; }
  .order-item-row:nth-child(1) { animation-delay:.1s; }
  .order-item-row:nth-child(2) { animation-delay:.16s; }
  .order-item-row:nth-child(3) { animation-delay:.22s; }
  .order-item-row:nth-child(4) { animation-delay:.28s; }
  .order-item-row:nth-child(5) { animation-delay:.34s; }
  @keyframes itemIn { from{opacity:0;transform:translateX(-14px)} to{opacity:1;transform:translateX(0)} }

  /* Total amount pop */
  .total-amount { animation: amtPop .5s cubic-bezier(.175,.885,.32,1.275) .4s both; }
  @keyframes amtPop { from{opacity:0;transform:scale(.7)} to{opacity:1;transform:scale(1)} }

  /* ETA banner bounce */
  .eta-banner { animation: etaBounce .6s cubic-bezier(.175,.885,.32,1.275) .3s both; }
  @keyframes etaBounce { from{opacity:0;transform:translateY(12px) scale(.96)} to{opacity:1;transform:translateY(0) scale(1)} }

  /* Bottom actions slide up */
  .bottom-actions { animation: bottomUp .45s cubic-bezier(.175,.885,.32,1.275) .35s both; }
  @keyframes bottomUp { from{transform:translateY(100%)} to{transform:translateY(0)} }

  /* Refresh spin */
  .btn-refresh-bottom.spinning { animation: spin .7s linear infinite; }

  /* Live dot ping */
  .live-dot {
    position:relative;
  }
  .live-dot::after {
    content:'';
    position:absolute; inset:-3px; border-radius:50%;
    background:var(--green-lt);
    animation:ping 1.5s ease-out infinite;
  }
  @keyframes ping { 0%{transform:scale(1);opacity:.6} 100%{transform:scale(2.2);opacity:0} }

  /* Search focus ring */
  .search-input:focus {
    box-shadow: 0 0 0 3px rgba(200,150,62,.2);
    border-color: var(--gold);
  }
  .search-btn:active { transform:scale(.96); }

  /* loading spinner */
  .spinner {
    width:36px;height:36px; margin:0 auto 14px;
    border:3px solid rgba(200,150,62,.2);
    border-top-color:var(--gold); border-radius:50%;
    animation:spin .8s linear infinite;
  }
  @keyframes spin{from{transform:rotate(0)}to{transform:rotate(360deg)}}

  /* ── THANK YOU SCREEN ── */
  .thankyou-overlay {
    display:none;
    position:fixed; inset:0; z-index:999;
    flex-direction:column;
    align-items:center; justify-content:center;
    text-align:center;
    padding:40px 24px;
    overflow:hidden;
  }
  .thankyou-overlay.show { display:flex; }

  /* Deep rich background */
  .thankyou-overlay::before {
    content:'';
    position:absolute; inset:0;
    background: linear-gradient(160deg, #0D0600 0%, #1A0A00 40%, #2A1206 100%);
    z-index:0;
  }

  /* Gold shimmer vignette */
  .thankyou-overlay::after {
    content:'';
    position:absolute; inset:0;
    background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(200,150,62,0.18) 0%, transparent 70%);
    z-index:0;
    animation: shiftGlow 4s ease-in-out infinite;
  }
  @keyframes shiftGlow {
    0%,100%{ opacity:.6; transform:scale(1); }
    50%{ opacity:1; transform:scale(1.1); }
  }

  .ty-content { position:relative; z-index:10; width:100%; max-width:400px; }

  /* Confetti canvas */
  #confettiCanvas {
    position:absolute; inset:0; z-index:1; pointer-events:none;
  }

  /* Big icon burst */
  .ty-icon-wrap {
    position:relative; display:inline-block;
    margin-bottom:24px;
  }
  .ty-icon {
    font-size:90px;
    display:block;
    animation:iconPop .8s cubic-bezier(.175,.885,.32,1.275) both;
    filter:drop-shadow(0 0 40px rgba(200,150,62,0.8));
  }
  @keyframes iconPop {
    0%{ transform:scale(0) rotate(-20deg); opacity:0; }
    60%{ transform:scale(1.2) rotate(5deg); }
    100%{ transform:scale(1) rotate(0deg); opacity:1; }
  }
  /* Ripple rings around icon */
  .ty-rings { position:absolute; inset:-20px; }
  .ty-ring {
    position:absolute; inset:0; border-radius:50%;
    border:2px solid rgba(200,150,62,0.4);
    animation:tyRing 2s ease-out infinite;
  }
  .ty-ring:nth-child(2){ animation-delay:.5s; }
  .ty-ring:nth-child(3){ animation-delay:1s; }
  @keyframes tyRing {
    0%{ transform:scale(.8); opacity:.8; }
    100%{ transform:scale(2.2); opacity:0; }
  }

  /* Main heading */
  .ty-heading {
    font-family:'Playfair Display',serif;
    font-size:clamp(28px,8vw,42px);
    font-weight:900;
    color:var(--gold);
    line-height:1.15;
    margin-bottom:8px;
    animation:fadeUp .7s ease .4s both;
    text-shadow:0 0 40px rgba(200,150,62,0.4);
  }
  .ty-heading em {
    font-style:italic;
    color:var(--gold-lt);
  }

  .ty-subheading {
    font-size:16px;
    color:rgba(253,246,236,0.65);
    margin-bottom:28px;
    line-height:1.6;
    animation:fadeUp .7s ease .55s both;
  }
  .ty-subheading strong { color:var(--latte); font-weight:600; }

  /* Receipt card */
  .ty-receipt {
    background:rgba(253,246,236,0.06);
    border:1px solid rgba(200,150,62,0.25);
    border-radius:20px;
    padding:18px 20px;
    margin-bottom:24px;
    animation:fadeUp .7s ease .65s both;
    text-align:left;
  }
  .ty-receipt-row {
    display:flex; justify-content:space-between; align-items:center;
    padding:6px 0;
    font-size:13px;
    border-bottom:1px solid rgba(253,246,236,0.06);
  }
  .ty-receipt-row:last-child { border:none; padding-bottom:0; }
  .ty-r-label { color:rgba(253,246,236,0.45); }
  .ty-r-value { color:var(--cream); font-weight:600; }
  .ty-r-value.gold { color:var(--gold); font-weight:900; font-size:16px; }

  /* Stars rating row */
  .ty-stars {
    display:flex; justify-content:center; gap:10px;
    margin-bottom:24px;
    animation:fadeUp .7s ease .75s both;
  }
  .ty-star {
    font-size:36px; cursor:pointer;
    filter:grayscale(1) opacity(.4);
    transition:all .2s cubic-bezier(.175,.885,.32,1.275);
  }
  .ty-star:hover, .ty-star.lit {
    filter:grayscale(0) opacity(1) drop-shadow(0 0 10px rgba(245,200,66,0.8));
    transform:scale(1.3);
  }
  .ty-rate-label {
    font-size:12px; color:rgba(253,246,236,0.3);
    letter-spacing:2px; text-transform:uppercase;
    margin-bottom:10px;
    animation:fadeUp .6s ease .7s both;
  }

  /* CTA buttons */
  .ty-btns {
    display:flex; flex-direction:column; gap:10px;
    animation:fadeUp .7s ease .85s both;
  }
  .ty-btn-order {
    background:var(--gold);
    color:var(--espresso);
    border:none; border-radius:14px;
    padding:15px 24px;
    font-size:15px; font-weight:700;
    cursor:pointer; letter-spacing:.5px;
    transition:all .25s;
    text-decoration:none;
    display:block;
  }
  .ty-btn-order:hover { background:var(--gold-lt); transform:scale(1.02); }

  .ty-btn-close {
    background:rgba(253,246,236,0.07);
    border:1px solid rgba(253,246,236,0.15);
    color:rgba(253,246,236,0.5);
    border-radius:14px; padding:12px 24px;
    font-size:13px; cursor:pointer;
    transition:all .2s;
  }
  .ty-btn-close:hover { background:rgba(253,246,236,0.12); color:var(--cream); }

  .ty-btn-exit {
    background: rgba(239,83,80,0.12);
    border: 1px solid rgba(239,83,80,0.3);
    color: rgba(239,83,80,0.8);
    border-radius:14px; padding:12px 24px;
    font-size:13px; font-weight:600; cursor:pointer;
    transition:all .2s; display:flex; align-items:center;
    justify-content:center; gap:7px; width:100%;
  }
  .ty-btn-exit:hover {
    background:rgba(239,83,80,0.22);
    border-color:rgba(239,83,80,0.6);
    color:#EF5350;
    transform:scale(1.01);
  }

  /* Floating coffee emojis */
  .ty-floaters { position:absolute; inset:0; pointer-events:none; z-index:2; overflow:hidden; }
  .ty-floater {
    position:absolute; font-size:24px; bottom:-40px;
    animation:floatUp var(--dur,6s) ease-in var(--delay,0s) both;
    opacity:0;
  }
  @keyframes floatUp {
    0%{ transform:translateY(0) rotate(0deg); opacity:0; }
    10%{ opacity:.7; }
    90%{ opacity:.4; }
    100%{ transform:translateY(-110vh) rotate(var(--spin,180deg)); opacity:0; }
  }

  :root { --latte:#D4A96A; --gold-lt:#E5B96A; }

  @keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }

  /* status colors */
  .bg-pending   { background:linear-gradient(135deg,#37474F,#546E7A); }
  .bg-confirmed { background:linear-gradient(135deg,var(--blue),var(--blue-lt)); }
  .bg-preparing { background:linear-gradient(135deg,var(--orange),var(--orange-lt)); }
  .bg-ready     { background:linear-gradient(135deg,var(--green),var(--green-lt)); }
  .bg-served    { background:linear-gradient(135deg,var(--purple),var(--purple-lt)); }
  .bg-paid      { background:linear-gradient(135deg,var(--green),#00897B); }
  .bg-cancelled { background:linear-gradient(135deg,var(--red),var(--red-lt)); }
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">Loading Tracker</div>
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
  var msgs=['Connecting to server...', 'Fetching your order...', 'Almost done...', 'Order found! 📋'];
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
  <div class="header-left">
    <span class="header-logo">☕</span>
    <span class="header-name">KAPITOL</span>
  </div>
  <a id="backBtn" href="#" class="header-back">← Menu</a>
</div>

<div class="page-body">

  <!-- SEARCH -->
  <div class="search-box">
    <div class="search-label">🔍 Track Your Order</div>
    <div class="search-row">
      <input class="search-input" type="text" id="codeInput"
        placeholder="e.g. KAP-A1B2C3"
        maxlength="15"
        oninput="this.value=this.value.toUpperCase()"
        onkeydown="if(event.key==='Enter') searchOrder()">
      <button class="search-btn" id="searchBtn" onclick="searchOrder()">Track</button>
    </div>
  </div>

  <!-- LIVE INDICATOR -->
  <div class="refresh-badge" id="refreshBadge" style="display:none">
    <span class="live-dot"></span>
    Auto-refreshing every 10 seconds &nbsp;·&nbsp; <span id="lastRefresh">Just updated</span>
  </div>

  <!-- CONTENT AREA -->
  <div id="contentArea">
    <div class="empty-state">
      <div class="empty-icon">🧾</div>
      <div class="empty-title">Enter Your Order Code</div>
      <div class="empty-desc">Type your order code above to see the live status of your food. You received the code after placing your order.</div>
    </div>
  </div>

</div>

<!-- ══ THANK YOU OVERLAY ══ -->
<div class="thankyou-overlay" id="tyOverlay">
  <canvas id="confettiCanvas"></canvas>
  <div class="ty-floaters" id="tyFloaters"></div>
  <div class="ty-content">

    <div class="ty-icon-wrap">
      <div class="ty-rings">
        <div class="ty-ring"></div>
        <div class="ty-ring"></div>
        <div class="ty-ring"></div>
      </div>
      <span class="ty-icon">☕</span>
    </div>

    <h1 class="ty-heading">Thanks for<br>choosing <em>Kapitol!</em></h1>
    <p class="ty-subheading">Your payment has been received.<br><strong>We hope to see you again soon!</strong></p>

    <div class="ty-receipt" id="tyReceipt">
      <div class="ty-receipt-row">
        <span class="ty-r-label">Order</span>
        <span class="ty-r-value" id="tyCode">–</span>
      </div>
      <div class="ty-receipt-row">
        <span class="ty-r-label">Table</span>
        <span class="ty-r-value" id="tyTable">–</span>
      </div>
      <div class="ty-receipt-row">
        <span class="ty-r-label">Amount Paid</span>
        <span class="ty-r-value gold" id="tyAmount">–</span>
      </div>
      <div class="ty-receipt-row">
        <span class="ty-r-label">Status</span>
        <span class="ty-r-value" style="color:#66BB6A">✓ Paid</span>
      </div>
    </div>

    <div class="ty-rate-label">Rate your experience</div>
    <div class="ty-stars" id="tyStars">
      <span class="ty-star" data-v="1">⭐</span>
      <span class="ty-star" data-v="2">⭐</span>
      <span class="ty-star" data-v="3">⭐</span>
      <span class="ty-star" data-v="4">⭐</span>
      <span class="ty-star" data-v="5">⭐</span>
    </div>

    <div class="ty-btns">
      <a class="ty-btn-order" id="tyOrderMore" href="#">🍽️ Order Again</a>
      <button class="ty-btn-close" onclick="closeThankyou()">← Back to Tracker</button>
      <button class="ty-btn-exit" onclick="exitApp()">🚪 Exit</button>
    </div>

  </div>
</div>

<!-- BOTTOM ACTIONS -->
<div class="bottom-actions" id="bottomActions" style="display:none">
  <a class="btn-menu" id="menuLink" href="#">🍽️ Order More</a>
  <button class="btn-refresh-bottom" onclick="refreshOrder()">⟳ Refresh</button>
</div>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';
const params = new URLSearchParams(window.location.search);
const urlCode  = params.get('code')  || '';
const urlTable = params.get('table') || '';

let currentCode = '';
let refreshTimer = null;

// Back link
const backHref = urlTable
  ? `${SITE_URL}/menu.php?table=${encodeURIComponent(urlTable)}`
  : `${SITE_URL}/menu.php`;
document.getElementById('backBtn').href = backHref;
document.getElementById('menuLink') && (document.getElementById('menuLink').href = backHref);

// Order steps definition
const ORDER_STEPS = [
  { key:'pending',   icon:'📋', label:'Order Received',    desc:'Your order has been sent to the counter.' },
  { key:'confirmed', icon:'✅', label:'Order Confirmed',    desc:'Staff confirmed your order is being processed.' },
  { key:'preparing', icon:'🔥', label:'Being Prepared',     desc:'Our kitchen is cooking your food right now!' },
  { key:'ready',     icon:'🔔', label:'Ready to Serve!',    desc:'Your order is done — our staff will bring it to you.' },
  { key:'served',    icon:'🍽️', label:'Served',             desc:'Enjoy your meal! Come again soon. ☕' },
  { key:'paid',      icon:'💚', label:'Completed & Paid',   desc:'Thank you for dining at Kapitol Cafe!' },
];

const CANCELLED_STEP = { key:'cancelled', icon:'❌', label:'Cancelled', desc:'This order was cancelled. Please contact our staff.' };

const STATUS_META = {
  pending:   { bg:'bg-pending',   icon:'📋', label:'Order Received',  desc:'Waiting for staff confirmation...' },
  confirmed: { bg:'bg-confirmed', icon:'✅', label:'Confirmed!',       desc:'Your order has been accepted.' },
  preparing: { bg:'bg-preparing', icon:'🍳', label:'Cooking Now!',     desc:'Our kitchen is busy making your food.' },
  ready:     { bg:'bg-ready',     icon:'🔔', label:'Ready!',           desc:'Your food is ready — being brought to your table!' },
  served:    { bg:'bg-served',    icon:'🍽️', label:'Served & Enjoyed', desc:'Bon appétit! Hope you love it.' },
  paid:      { bg:'bg-paid',      icon:'💚', label:'All Done!',        desc:'Payment received. Thank you!' },
  cancelled: { bg:'bg-cancelled', icon:'❌', label:'Cancelled',        desc:'This order was cancelled.' },
};

const ETA_MAP = {
  pending:   '5–10 minutes estimated',
  confirmed: '5–8 minutes estimated',
  preparing: '~5 minutes remaining',
  ready:     'Being brought to your table now!',
  served:    'Enjoy your meal!',
  paid:      'See you next time!',
  cancelled: '—',
};

// Auto-load if URL has code
if (urlCode) {
  document.getElementById('codeInput').value = urlCode;
  currentCode = urlCode;
  fetchOrder(urlCode);
}

async function searchOrder() {
  const code = document.getElementById('codeInput').value.trim().toUpperCase();
  if (!code) { showError('Please enter your order code.'); return; }
  currentCode = code;
  await fetchOrder(code);
}

async function refreshOrder() {
  if (currentCode) await fetchOrder(currentCode);
}

async function fetchOrder(code) {
  const btn = document.getElementById('searchBtn');
  btn.disabled = true; btn.textContent = '...';
  showLoading();

  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=track_order&code=${encodeURIComponent(code)}`);
    const data = await res.json();
    if (data.success) {
      renderOrder(data.data);
      startAutoRefresh(code);
      if(window._hideSplash) window._hideSplash();
    } else {
      showError('Order not found. Please check your code and try again.');
      stopAutoRefresh();
      if(window._hideSplash) window._hideSplash();
    }
  } catch(e) {
    showError('Cannot connect to server. Please check your WiFi connection.');
    stopAutoRefresh();
    if(window._hideSplash) window._hideSplash();
  }

  btn.disabled = false; btn.textContent = 'Track';
}

function renderOrder(order) {
  const status = order.status || 'pending';
  const meta = STATUS_META[status] || STATUS_META.pending;
  const steps = status === 'cancelled' ? [CANCELLED_STEP] : ORDER_STEPS;
  const stepIndex = steps.findIndex(s => s.key === status);

  // Bottom actions
  document.getElementById('bottomActions').style.display = 'flex';
  document.getElementById('refreshBadge').style.display = 'flex';

  // Update last refresh time
  const now = new Date();
  document.getElementById('lastRefresh').textContent =
    now.toLocaleTimeString('en-PH', {hour:'2-digit', minute:'2-digit', second:'2-digit'});

  // Build items HTML
  const itemsHtml = (order.items || []).map(item => `
    <div class="order-item-row">
      <div class="item-qty-badge">${item.quantity}</div>
      <div class="item-name">${item.name}</div>
      <div class="item-price">₱${parseFloat(item.subtotal).toFixed(2)}</div>
    </div>
  `).join('');

  // Build steps HTML
  const stepsHtml = steps.map((step, i) => {
    let circleClass = 'pending', nameClass = 'pending', circleContent = i + 1;
    if (i < stepIndex) { circleClass = 'done'; circleContent = '✓'; nameClass = 'done'; }
    else if (i === stepIndex) { circleClass = 'active'; circleContent = step.icon; nameClass = 'active'; }
    return `
      <div class="step-row">
        <div class="step-circle ${circleClass}">${circleContent}</div>
        <div class="step-content">
          <div class="step-name ${nameClass}">${step.label}</div>
          <div class="step-desc ${i === stepIndex ? 'active' : ''}">${step.desc}</div>
        </div>
      </div>
    `;
  }).join('');

  const eta = ETA_MAP[status] || '';
  const showEta = !['served','paid','cancelled'].includes(status);

  const activePulsing = ['pending','confirmed','preparing','ready'].includes(status);
  document.getElementById('contentArea').innerHTML = `
    <div class="order-card">

      <!-- STATUS BANNER -->
      <div class="order-banner ${meta.bg} ${activePulsing ? 'pulsing' : ''}">
        <span class="banner-status-icon">${meta.icon}</span>
        <div class="banner-status-label">${meta.label}</div>
        <div class="banner-status-desc">${meta.desc}</div>
      </div>

      <!-- META CHIPS -->
      <div class="order-meta">
        <div class="meta-chip">🧾 <strong>${order.order_code}</strong></div>
        <div class="meta-chip">${order.order_type === 'takeout' ? '🥡 <strong>Take Out</strong>' : '🪑 <strong>' + order.table_number + '</strong>'}</div>
        <div class="meta-chip">👤 <strong>${order.customer_name || 'Guest'}</strong></div>
        <div class="meta-chip">🕐 <strong>${formatTime(order.created_at)}</strong></div>
      </div>

      ${showEta ? `
      <!-- ETA -->
      <div class="eta-banner" style="margin-top:14px">
        <div class="eta-icon">⏱️</div>
        <div class="eta-text">
          <div class="eta-label">Estimated</div>
          <div class="eta-value">${eta}</div>
        </div>
      </div>` : ''}

      <!-- PROGRESS STEPS -->
      <div class="progress-section">
        <div class="progress-title">Order Progress</div>
        <div class="steps-list">
          ${stepsHtml}
        </div>
      </div>

      <!-- ITEMS -->
      <div class="items-section">
        <div class="items-title">Your Items</div>
        ${itemsHtml || '<div style="color:#aaa;font-size:13px">No items found.</div>'}
      </div>

      <!-- TOTAL -->
      <div class="total-section">
        <span class="total-label">Total Amount</span>
        <span class="total-amount">₱${parseFloat(order.total_amount).toFixed(2)}</span>
      </div>

      <!-- PAYMENT STATUS -->
      <div class="payment-row">
        <span class="pay-label">Payment</span>
        <span class="pay-badge ${order.payment_status === 'paid' ? 'pay-paid' : 'pay-unpaid'}">
          ${order.payment_status === 'paid' ? '✓ Paid' : '⏳ Unpaid'}
        </span>
      </div>

    </div>
  `;

  // Stop auto-refresh once served or paid
  if (['served','paid','cancelled'].includes(status)) stopAutoRefresh();

  // Show THANK YOU screen when payment is confirmed
  if (status === 'paid' && order.payment_status === 'paid') {
    // Small delay so the order card renders first, then surprise them
    setTimeout(() => showThankyou(order), 800);
  }
}

function formatTime(dateStr) {
  if (!dateStr) return '—';
  const d = new Date(dateStr);
  return d.toLocaleTimeString('en-PH', {hour:'2-digit', minute:'2-digit'});
}

function showLoading() {
  document.getElementById('contentArea').innerHTML = `
    <div class="empty-state">
      <div class="spinner"></div>
      <div class="empty-title">Looking up your order...</div>
    </div>
  `;
}

function showError(msg) {
  document.getElementById('contentArea').innerHTML = `
    <div class="empty-state">
      <div class="empty-icon">😕</div>
      <div class="empty-title">Order Not Found</div>
      <div class="empty-desc">${msg}</div>
    </div>
  `;
  document.getElementById('bottomActions').style.display = 'none';
  document.getElementById('refreshBadge').style.display = 'none';
}

// ── TRACK if we already showed thankyou ──
let tyShown = false;

function showThankyou(order) {
  if (tyShown) return;
  tyShown = true;

  // Fill receipt
  document.getElementById('tyCode').textContent = order.order_code || '–';
  document.getElementById('tyTable').textContent = order.table_number || '–';
  document.getElementById('tyAmount').textContent = '₱' + parseFloat(order.total_amount || 0).toFixed(2);
  const href = urlTable ? `${SITE_URL}/menu.php?table=${encodeURIComponent(urlTable)}` : `${SITE_URL}/menu.php`;
  document.getElementById('tyOrderMore').href = href;

  // Star rating interaction
  const stars = document.querySelectorAll('.ty-star');
  stars.forEach(s => {
    s.addEventListener('click', () => {
      const val = parseInt(s.dataset.v);
      stars.forEach((st, i) => st.classList.toggle('lit', i < val));
    });
    s.addEventListener('mouseover', () => {
      const val = parseInt(s.dataset.v);
      stars.forEach((st, i) => st.classList.toggle('lit', i < val));
    });
  });
  document.getElementById('tyStars').addEventListener('mouseleave', () => {
    const litCount = document.querySelectorAll('.ty-star.lit').length;
    if (!litCount) stars.forEach(s => s.classList.remove('lit'));
  });

  // Show overlay
  const overlay = document.getElementById('tyOverlay');
  overlay.classList.add('show');

  // Launch confetti
  launchConfetti();

  // Launch floating emojis
  launchFloaters();

  // Stop auto-refresh
  stopAutoRefresh();
}

function closeThankyou() {
  document.getElementById('tyOverlay').classList.remove('show');
}

function exitApp() {
  // Try to close the tab/window; works if opened via QR/browser
  window.close();
  // Fallback: redirect to a clean goodbye page
  setTimeout(() => {
    window.location.href = SITE_URL + '/goodbye.php';
  }, 300);
}

// ── CONFETTI ──
function launchConfetti() {
  const canvas = document.getElementById('confettiCanvas');
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const colors = ['#C8963E','#E8B86D','#F5C842','#FDF6EC','#D4A96A','#FFFFFF','#FFD700'];
  const pieces = Array.from({length:120}, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height - canvas.height,
    w: Math.random() * 10 + 5,
    h: Math.random() * 6 + 3,
    color: colors[Math.floor(Math.random()*colors.length)],
    rot: Math.random() * Math.PI * 2,
    rotSpeed: (Math.random()-.5)*.15,
    vx: (Math.random()-.5)*3,
    vy: Math.random()*4+2,
    alpha:1,
  }));

  let frame = 0;
  function draw() {
    ctx.clearRect(0,0,canvas.width,canvas.height);
    pieces.forEach(p => {
      ctx.save();
      ctx.globalAlpha = p.alpha;
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
      ctx.restore();
      p.x += p.vx; p.y += p.vy; p.rot += p.rotSpeed;
      if (frame > 80) p.alpha -= 0.008;
    });
    frame++;
    if (frame < 200) requestAnimationFrame(draw);
  }
  draw();
}

// ── FLOATING EMOJIS ──
function launchFloaters() {
  const container = document.getElementById('tyFloaters');
  container.innerHTML = '';
  const emojis = ['☕','✨','🎉','💛','☕','🌟','☕','💫','🎊','☕'];
  emojis.forEach((em, i) => {
    const el = document.createElement('div');
    el.className = 'ty-floater';
    el.textContent = em;
    el.style.cssText = `left:${8+i*9}%;--dur:${5+Math.random()*4}s;--delay:${Math.random()*2}s;--spin:${(Math.random()>.5?1:-1)*180}deg`;
    container.appendChild(el);
  });
}

function startAutoRefresh(code) {
  stopAutoRefresh();
  refreshTimer = setInterval(() => fetchOrder(code), 10000);
}

function stopAutoRefresh() {
  if (refreshTimer) { clearInterval(refreshTimer); refreshTimer = null; }
  document.getElementById('refreshBadge').style.display = 'none';
}
</script>
</body>
</html>
