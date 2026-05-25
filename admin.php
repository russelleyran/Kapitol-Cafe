<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KAPITOL CAFE – Admin Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0F0A06;
    --panel: #1A1008;
    --card: #231608;
    --border: rgba(200,150,62,0.2);
    --gold: #C8963E;
    --gold-light: #E5B96A;
    --cream: #FDF6EC;
    --green: #4CAF50;
    --orange: #FF9800;
    --red: #F44336;
    --blue: #2196F3;
    --text: rgba(253,246,236,0.9);
    --text-dim: rgba(253,246,236,0.5);
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:var(--bg);font-family:'DM Sans',sans-serif;color:var(--text);min-height:100vh;}

  /* SIDEBAR */
  .sidebar {
    width:220px;
    background:var(--panel);
    border-right:1px solid var(--border);
    position:fixed;top:0;left:0;bottom:0;
    display:flex;flex-direction:column;
    z-index:100;
  }
  .sidebar-brand {
    padding:24px 20px;
    border-bottom:1px solid var(--border);
  }
  .sidebar-logo { font-size:32px;margin-bottom:6px; }
  .sidebar-name {
    font-family:'Playfair Display',serif;
    color:var(--gold);
    font-size:18px;
    font-weight:700;
    letter-spacing:2px;
  }
  .sidebar-sub { font-size:11px; color:var(--text-dim); letter-spacing:2px; }

  .nav-section { padding:12px 0; }
  .nav-label { font-size:10px;color:var(--text-dim);letter-spacing:2px;padding:6px 20px;text-transform:uppercase; }
  .nav-item {
    display:flex;align-items:center;gap:10px;
    padding:10px 20px;
    color:var(--text-dim);
    cursor:pointer;
    transition:all 0.2s;
    border-left:3px solid transparent;
    font-size:14px;
  }
  .nav-item:hover { color:var(--cream);background:rgba(200,150,62,0.08); }
  .nav-item.active { color:var(--gold);border-left-color:var(--gold);background:rgba(200,150,62,0.1); }
  .nav-icon { font-size:18px;width:24px;text-align:center; }
  .nav-badge {
    margin-left:auto;background:var(--gold);color:var(--bg);
    font-size:11px;font-weight:700;
    padding:2px 7px;border-radius:10px;
    min-width:20px;text-align:center;
  }

  .sidebar-footer {
    margin-top:auto;
    padding:16px 20px;
    border-top:1px solid var(--border);
  }
  .status-dot { width:8px;height:8px;background:var(--green);border-radius:50%;animation:pulse-dot 2s infinite; display:inline-block;margin-right:6px; }
  @keyframes pulse-dot{0%,100%{opacity:1}50%{opacity:0.4}}

  /* MAIN */
  .main { margin-left:220px; padding:24px; min-height:100vh; }

  /* TOP BAR */
  .topbar {
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:24px;
  }
  .page-title {
    font-family:'Playfair Display',serif;
    font-size:28px;
    color:var(--gold);
  }
  .topbar-right { display:flex;align-items:center;gap:12px; }
  .time-display { color:var(--text-dim);font-size:13px; }
  .refresh-btn {
    background:rgba(200,150,62,0.15);
    border:1px solid var(--border);
    color:var(--gold);
    padding:8px 16px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    transition:all 0.2s;
  }
  .refresh-btn:hover{background:rgba(200,150,62,0.25);}

  /* ── SCROLL TABS ── */
  .scroll-tabs {
    display:flex; gap:4px;
    background:var(--panel);
    border:1px solid var(--border);
    border-radius:14px;
    padding:5px;
    margin-bottom:24px;
    overflow-x:auto;
    scrollbar-width:none;
    flex-wrap:nowrap;
  }
  .scroll-tabs::-webkit-scrollbar { display:none; }
  .stab {
    display:flex; align-items:center; gap:7px;
    padding:9px 18px;
    border-radius:10px;
    border:none; background:none;
    color:var(--text-dim);
    font-size:13px; font-weight:600;
    cursor:pointer;
    transition:all .2s;
    white-space:nowrap;
    flex-shrink:0;
    position:relative;
  }
  .stab:hover { color:var(--cream); background:rgba(200,150,62,0.08); }
  .stab.active {
    background:var(--gold);
    color:var(--bg);
  }
  .stab .stab-badge {
    background:var(--bg);
    color:var(--gold);
    font-size:10px; font-weight:800;
    padding:1px 6px; border-radius:10px;
    min-width:18px; text-align:center;
  }
  .stab.active .stab-badge {
    background:rgba(0,0,0,0.2);
    color:white;
  }
  .stab-icon { font-size:16px; }

  /* STATS CARDS */
  .stats-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:16px;
    margin-bottom:28px;
  }
  .stat-card {
    background:var(--card);
    border:1px solid var(--border);
    border-radius:16px;
    padding:20px;
    animation:fadeIn 0.5s ease both;
    transition:all 0.3s;
  }
  .stat-card:hover{border-color:rgba(200,150,62,0.5);transform:translateY(-2px);}
  @keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
  .stat-icon{font-size:32px;margin-bottom:10px;}
  .stat-value{font-size:28px;font-weight:700;color:var(--gold-light);}
  .stat-label{font-size:12px;color:var(--text-dim);margin-top:4px;letter-spacing:1px;text-transform:uppercase;}

  /* VIEW TABS */
  .view-tabs {
    display:flex;gap:8px;
    margin-bottom:20px;
    background:var(--panel);
    padding:6px;
    border-radius:12px;
    border:1px solid var(--border);
    width:fit-content;
  }
  .view-tab {
    padding:8px 20px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    font-weight:600;
    letter-spacing:0.5px;
    transition:all 0.2s;
    color:var(--text-dim);
    border:none;
    background:none;
  }
  .view-tab.active{background:var(--gold);color:var(--bg);}

  /* ORDERS TABLE */
  .orders-table-wrap {
    background:var(--card);
    border:1px solid var(--border);
    border-radius:16px;
    overflow:hidden;
  }
  .orders-header {
    padding:16px 20px;
    border-bottom:1px solid var(--border);
    display:flex;align-items:center;justify-content:space-between;
  }
  .orders-title{font-weight:700;font-size:15px;color:var(--cream);}
  table{width:100%;border-collapse:collapse;}
  th{padding:12px 16px;text-align:left;font-size:11px;color:var(--text-dim);letter-spacing:1px;text-transform:uppercase;border-bottom:1px solid var(--border);}
  td{padding:12px 16px;font-size:13px;border-bottom:1px solid rgba(200,150,62,0.08);}
  tr:last-child td{border-bottom:none;}
  tr:hover td{background:rgba(200,150,62,0.05);}

  .status-pill{
    padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;
    letter-spacing:0.5px;text-transform:uppercase;
  }
  .s-pending{background:rgba(255,152,0,0.15);color:#FFA726;border:1px solid rgba(255,152,0,0.3);}
  .s-confirmed{background:rgba(33,150,243,0.15);color:#42A5F5;border:1px solid rgba(33,150,243,0.3);}
  .s-preparing{background:rgba(255,87,34,0.15);color:#FF7043;border:1px solid rgba(255,87,34,0.3);}
  .s-ready{background:rgba(76,175,80,0.15);color:#66BB6A;border:1px solid rgba(76,175,80,0.3);}
  .s-served{background:rgba(156,39,176,0.15);color:#AB47BC;border:1px solid rgba(156,39,176,0.3);}
  .s-paid{background:rgba(76,175,80,0.15);color:#66BB6A;border:1px solid rgba(76,175,80,0.3);}
  .s-cancelled{background:rgba(244,67,54,0.15);color:#EF5350;border:1px solid rgba(244,67,54,0.3);}

  .action-btn {
    padding:5px 12px;
    border-radius:6px;
    border:1px solid;
    font-size:12px;
    cursor:pointer;
    transition:all 0.2s;
    margin-right:4px;
    font-weight:600;
  }
  .btn-confirm{border-color:var(--blue);color:var(--blue);background:rgba(33,150,243,0.1);}
  .btn-prepare{border-color:#FF9800;color:#FF9800;background:rgba(255,152,0,0.1);}
  .btn-ready{border-color:var(--green);color:var(--green);background:rgba(76,175,80,0.1);}
  .btn-pay{border-color:var(--gold);color:var(--gold);background:rgba(200,150,62,0.1);}
  .btn-cancel{border-color:var(--red);color:var(--red);background:rgba(244,67,54,0.1);}
  .action-btn:hover{filter:brightness(1.3);transform:scale(1.05);}

  /* KITCHEN VIEW */
  .kitchen-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:16px;
  }
  .kitchen-card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:16px;
    overflow:hidden;
    transition:all 0.3s;
    animation:slideIn 0.4s ease;
  }
  @keyframes slideIn{from{opacity:0;transform:translateX(-20px)}to{opacity:1;transform:translateX(0)}}
  .kitchen-card:hover{border-color:rgba(200,150,62,0.5);}
  .kitchen-card-header{
    padding:14px 16px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .kc-preparing .kitchen-card-header{background:rgba(255,87,34,0.15);}
  .kc-confirmed .kitchen-card-header{background:rgba(33,150,243,0.15);}
  .kitchen-order-code{font-weight:700;color:var(--gold);font-size:15px;}
  .kitchen-table{font-size:12px;color:var(--text-dim);}
  .kitchen-items{padding:12px 16px;border-bottom:1px solid var(--border);}
  .kitchen-item{
    display:flex;align-items:center;gap:8px;
    padding:6px 0;
    font-size:13px;
  }
  .kitchen-item-qty{
    background:var(--gold);color:var(--bg);
    width:24px;height:24px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-weight:700;font-size:12px;flex-shrink:0;
  }
  .kitchen-footer{padding:12px 16px;display:flex;gap:8px;}
  .kitchen-timer{font-size:12px;color:var(--text-dim);display:flex;align-items:center;gap:4px;}

  /* PAYMENT MODAL */
  .payment-modal-overlay{
    display:none;position:fixed;inset:0;
    background:rgba(0,0,0,0.8);
    z-index:500;
    align-items:center;justify-content:center;
  }
  .payment-modal-overlay.show{display:flex;animation:fadeIn 0.3s;}
  .payment-modal{
    background:var(--panel);
    border:1px solid var(--border);
    border-radius:24px;
    padding:32px;
    width:420px;
    max-width:95vw;
    text-align:center;
  }
  .pm-title{
    font-family:'Playfair Display',serif;
    color:var(--gold);font-size:24px;margin-bottom:20px;
  }
  .pm-amount{
    font-size:42px;font-weight:900;
    color:var(--gold-light);margin-bottom:24px;
  }
  .pm-methods{display:flex;gap:10px;justify-content:center;flex-wrap:wrap;margin-bottom:24px;}
  .pm-method{
    padding:8px 18px;
    border-radius:10px;
    border:1.5px solid var(--border);
    color:var(--text-dim);
    cursor:pointer;
    transition:all 0.2s;
    font-size:13px;font-weight:600;
  }
  .pm-method.selected,.pm-method:hover{border-color:var(--gold);color:var(--gold);background:rgba(200,150,62,0.1);}
  .pm-confirm{
    width:100%;padding:14px;
    background:var(--gold);color:var(--bg);
    border:none;border-radius:12px;
    font-size:15px;font-weight:700;cursor:pointer;
    transition:all 0.3s;margin-bottom:10px;
  }
  .pm-confirm:hover{background:var(--gold-light);transform:scale(1.02);}
  .pm-cancel-btn{
    width:100%;padding:10px;
    background:none;border:1px solid var(--border);
    color:var(--text-dim);border-radius:12px;
    cursor:pointer;font-size:13px;
    transition:all 0.2s;
  }
  .pm-cancel-btn:hover{border-color:var(--red);color:var(--red);}

  /* GCash QR Panel */
  .gcash-qr-panel{
    display:none;
    background:linear-gradient(145deg,#003D99,#0057CC);
    border-radius:16px;
    padding:20px 16px;
    margin-bottom:20px;
    animation:fadeIn 0.3s ease;
    position:relative;
    overflow:hidden;
  }
  .gcash-qr-panel::before{
    content:'';
    position:absolute;top:-30px;right:-30px;
    width:120px;height:120px;border-radius:50%;
    background:rgba(255,255,255,0.06);
  }
  .gcash-qr-panel.show{ display:block; }
  .gcash-header{
    display:flex;align-items:center;gap:10px;
    margin-bottom:14px;
  }
  .gcash-logo{
    background:white;border-radius:10px;
    padding:5px 10px;font-size:13px;font-weight:900;
    color:#0057CC;letter-spacing:.5px;
  }
  .gcash-title{
    color:white;font-size:14px;font-weight:700;
  }
  .gcash-sub{ color:rgba(255,255,255,0.6);font-size:11px; }
  .gcash-qr-box{
    background:white;border-radius:14px;
    padding:12px;display:inline-block;
    box-shadow:0 8px 30px rgba(0,0,0,0.3);
    margin-bottom:12px;
  }
  .gcash-info-row{
    display:flex;justify-content:space-between;align-items:center;
    background:rgba(255,255,255,0.1);
    border-radius:10px;padding:8px 12px;
    margin-bottom:6px;
  }
  .gcash-info-label{ color:rgba(255,255,255,0.6);font-size:11px; }
  .gcash-info-value{ color:white;font-weight:700;font-size:13px; }
  .gcash-scan-hint{
    color:rgba(255,255,255,0.55);font-size:11px;
    text-align:center;margin-top:8px;letter-spacing:.5px;
  }
  .gcash-amount-big{
    font-size:28px;font-weight:900;color:white;
    text-align:center;margin-bottom:14px;
    text-shadow:0 2px 10px rgba(0,0,0,0.2);
  }

  .empty-state{text-align:center;padding:60px 20px;color:var(--text-dim);}
  .empty-state-icon{font-size:60px;margin-bottom:12px;opacity:0.5;}

  /* Notification toast */
  .toast{
    position:fixed;top:20px;right:20px;
    background:var(--card);border:1px solid var(--border);
    border-radius:12px;padding:14px 20px;
    color:var(--cream);font-size:13px;
    z-index:999;
    transform:translateX(120%);
    transition:transform 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
    display:flex;align-items:center;gap:10px;
  }
  .toast.show{transform:translateX(0);}
  .toast.success{border-left:4px solid var(--green);}
  .toast.error{border-left:4px solid var(--red);}

  /* ── EXTRA ANIMATIONS ── */

  /* Sidebar slide in */
  .sidebar { animation: sidebarIn .5s cubic-bezier(.22,.68,0,1.2) both; }
  @keyframes sidebarIn { from{transform:translateX(-100%);opacity:0} to{transform:translateX(0);opacity:1} }

  /* Main content reveal */
  .main-content { animation: mainIn .5s ease .1s both; }
  @keyframes mainIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }

  /* Stat card stagger */
  .stat-card:nth-child(1){animation-delay:.05s}
  .stat-card:nth-child(2){animation-delay:.1s}
  .stat-card:nth-child(3){animation-delay:.15s}
  .stat-card:nth-child(4){animation-delay:.2s}

  /* Stat value count-up feel */
  .stat-value { animation: valueReveal .6s cubic-bezier(.175,.885,.32,1.275) .3s both; }
  @keyframes valueReveal { from{opacity:0;transform:scale(.6)} to{opacity:1;transform:scale(1)} }

  /* Stat card hover glow */
  .stat-card {
    position:relative; overflow:hidden;
  }
  .stat-card::after {
    content:'';
    position:absolute; inset:0; border-radius:16px;
    background:radial-gradient(circle at 50% 0%, rgba(200,150,62,.08), transparent 60%);
    opacity:0; transition:opacity .3s; pointer-events:none;
  }
  .stat-card:hover::after { opacity:1; }

  /* View tab active indicator */
  .view-tab { position:relative; overflow:hidden; }
  .view-tab .tab-ink {
    position:absolute; border-radius:50%;
    background:rgba(200,150,62,.2);
    transform:scale(0);
    animation:rippleOut .45s ease-out forwards;
    pointer-events:none;
  }
  @keyframes rippleOut { to{transform:scale(5);opacity:0;} }

  /* Order rows stagger */
  .order-row, tr { animation: rowIn .35s ease both; }
  @keyframes rowIn { from{opacity:0;transform:translateX(-12px)} to{opacity:1;transform:translateX(0)} }

  /* Modal entrance */
  .modal-content, .modal-box-admin {
    animation: modalReveal .4s cubic-bezier(.175,.885,.32,1.275);
  }
  @keyframes modalReveal { from{opacity:0;transform:scale(.9) translateY(20px)} to{opacity:1;transform:scale(1) translateY(0)} }

  /* Badge pulse for pending/new orders */
  .badge-pending, .status-pending {
    animation: badgePulse 2s ease-in-out infinite;
  }
  @keyframes badgePulse { 0%,100%{box-shadow:0 0 0 0 rgba(255,152,0,0)} 50%{box-shadow:0 0 0 4px rgba(255,152,0,.2)} }

  /* Button hover lift */
  .btn-action, .action-btn {
    transition:all .2s cubic-bezier(.175,.885,.32,1.275);
  }
  .btn-action:hover, .action-btn:hover { transform:translateY(-2px) scale(1.03); }
  .btn-action:active, .action-btn:active { transform:scale(.96); }

  /* Button ripple */
  .btn-primary, .btn-secondary, .btn-danger { position:relative; overflow:hidden; }
  .btn-primary .ripple, .btn-secondary .ripple, .btn-danger .ripple {
    position:absolute; border-radius:50%;
    background:rgba(255,255,255,.25);
    transform:scale(0);
    animation:rippleOut .45s ease-out forwards;
    pointer-events:none;
  }

  /* Sidebar nav item hover */
  .nav-item {
    transition: all .25s ease;
  }
  .nav-item:hover { padding-left: 18px; }

  /* Toast enhanced */
  .toast { box-shadow:0 8px 30px rgba(0,0,0,.3); }
  .toast.show { animation: toastIn .4s cubic-bezier(.175,.885,.32,1.275); }
  @keyframes toastIn { from{transform:translateX(120%) scale(.9)} to{transform:translateX(0) scale(1)} }

  /* Table row hover */
  tbody tr { transition:background .2s, transform .2s; }
  tbody tr:hover { background:rgba(200,150,62,.05) !important; transform:translateX(2px); }

  /* Search input focus */
  input[type=search]:focus, input[type=text]:focus, select:focus {
    box-shadow:0 0 0 3px rgba(200,150,62,.2);
  }

  /* Status badge glow */
  .badge-ready {
    animation: readyGlow 1.5s ease-in-out infinite;
  }
  @keyframes readyGlow { 0%,100%{box-shadow:0 0 0 0 rgba(76,175,80,0)} 50%{box-shadow:0 0 8px 3px rgba(76,175,80,.3)} }

  /* Spinner */
  .loading-spinner {
    animation: spin .7s linear infinite;
  }
  @keyframes spin { from{transform:rotate(0)} to{transform:rotate(360deg)} }


  /* ── SKELETON ── */
  .skeleton{background:linear-gradient(90deg,rgba(255,255,255,.04) 25%,rgba(255,255,255,.1) 50%,rgba(255,255,255,.04) 75%);background-size:200% 100%;animation:skeletonShimmer 1.4s infinite;border-radius:8px;}
  @keyframes skeletonShimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}
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
    <div id="splashSubtitle" style="color:rgba(253,246,236,.35);font-size:11px;letter-spacing:3px;text-transform:uppercase;margin-bottom:28px;">Admin Dashboard</div>
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
  var msgs=['Loading dashboard...', 'Fetching orders...', 'Calculating stats...', 'Dashboard ready! 📊'];
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

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="sidebar-brand">
    <div class="sidebar-logo">☕</div>
    <div class="sidebar-name">KAPITOL</div>
    <div class="sidebar-sub">ADMIN PANEL</div>
  </div>

  <div class="nav-section">
    <div class="nav-label">Overview</div>
    <div class="nav-item active" onclick="switchView('dashboard')">
      <span class="nav-icon">📊</span> Dashboard
    </div>
  </div>

  <div class="nav-section">
    <div class="nav-label">Operations</div>
    <div class="nav-item" onclick="switchView('cashier')">
      <span class="nav-icon">💰</span> Cashier
      <span class="nav-badge" id="pendingCount">0</span>
    </div>
    <div class="nav-item" onclick="switchView('kitchen')">
      <span class="nav-icon">👨‍🍳</span> Kitchen
      <span class="nav-badge" id="kitchenCount">0</span>
    </div>
    <div class="nav-item" onclick="switchView('all_orders')">
      <span class="nav-icon">📋</span> All Orders
    </div>
    <div class="nav-item" onclick="switchView('tables')">
      <span class="nav-icon">🪑</span> Tables
    </div>
  </div>

  <div class="nav-section">
    <div class="nav-label">Links</div>
    <div class="nav-item" onclick="window.open('welcome.php')">
      <span class="nav-icon">🖥️</span> Welcome Display
    </div>
    <div class="nav-item" onclick="window.open('menu.php')">
      <span class="nav-icon">🍽️</span> Menu Preview
    </div>
    <div class="nav-item" onclick="window.open('kitchen_display.php')">
      <span class="nav-icon">📺</span> Kitchen Screen
    </div>

  </div>

  <div class="sidebar-footer">
    <span class="status-dot"></span>
    <span style="font-size:12px;color:var(--text-dim)">System Online</span>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="main">
  <div class="topbar">
    <div class="page-title" id="pageTitle">Dashboard</div>
    <div class="topbar-right">
      <div class="time-display" id="timeDisplay"></div>
      <button class="refresh-btn" onclick="loadData()">⟳ Refresh</button>
    </div>
  </div>

  <!-- SCROLL TABS -->
  <div class="scroll-tabs" id="scrollTabs">
    <button class="stab active" id="stab-dashboard" onclick="switchViewTab('dashboard', this)">
      <span class="stab-icon">📊</span> Dashboard
    </button>
    <button class="stab" id="stab-cashier" onclick="switchViewTab('cashier', this)">
      <span class="stab-icon">💰</span> Cashier
      <span class="stab-badge" id="stabPending">0</span>
    </button>
    <button class="stab" id="stab-kitchen" onclick="switchViewTab('kitchen', this)">
      <span class="stab-icon">👨‍🍳</span> Kitchen
      <span class="stab-badge" id="stabKitchen">0</span>
    </button>
    <button class="stab" id="stab-all_orders" onclick="switchViewTab('all_orders', this)">
      <span class="stab-icon">📋</span> All Orders
    </button>
    <button class="stab" id="stab-tables" onclick="switchViewTab('tables', this)">
      <span class="stab-icon">🪑</span> Tables
    </button>
    <button class="stab" onclick="window.open('welcome.php')" style="opacity:.7;">
      <span class="stab-icon">🖥️</span> Welcome
    </button>
    <button class="stab" onclick="window.open('kitchen_display.php')" style="opacity:.7;">
      <span class="stab-icon">📺</span> Kitchen Screen
    </button>

  </div>

  <!-- STATS -->
  <div class="stats-grid" id="statsGrid">
    <div class="stat-card" style="animation-delay:0.0s">
      <div class="stat-icon">🧾</div>
      <div class="stat-value" id="statActive">–</div>
      <div class="stat-label">Active Orders</div>
    </div>
    <div class="stat-card" style="animation-delay:0.1s">
      <div class="stat-icon">✅</div>
      <div class="stat-value" id="statReady">–</div>
      <div class="stat-label">Ready to Serve</div>
    </div>
    <div class="stat-card" style="animation-delay:0.2s">
      <div class="stat-icon">📦</div>
      <div class="stat-value" id="statToday">–</div>
      <div class="stat-label">Orders Today</div>
    </div>
    <div class="stat-card" style="animation-delay:0.3s">
      <div class="stat-icon">💵</div>
      <div class="stat-value" id="statRevenue">–</div>
      <div class="stat-label">Revenue Today</div>
    </div>
  </div>

  <!-- VIEW TABS (for cashier/kitchen) -->
  <div class="view-tabs" id="viewTabs" style="display:none">
    <button class="view-tab" id="tab-pending" onclick="filterOrders('pending')">⏳ Pending</button>
    <button class="view-tab active" id="tab-all" onclick="filterOrders('all')">📋 All Active</button>
    <button class="view-tab" id="tab-ready" onclick="filterOrders('ready')">✅ Ready</button>
  </div>

  <!-- ORDERS TABLE VIEW -->
  <div id="ordersTableView">
    <div class="orders-table-wrap">
      <div class="orders-header">
        <div class="orders-title" id="ordersTitle">Recent Orders</div>
      </div>
      <div style="overflow-x:auto;">
        <table>
          <thead>
            <tr>
              <th>Order Code</th>
              <th>Table</th>
              <th>Customer</th>
              <th>Items</th>
              <th>Total</th>
              <th>Status</th>
              <th>Time</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="ordersBody">
            <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-dim)">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- KITCHEN VIEW -->
  <div id="kitchenView" style="display:none">
    <div class="kitchen-grid" id="kitchenGrid"></div>
  </div>

  <!-- TABLES VIEW -->
  <div id="tablesView" style="display:none">

    <!-- Toolbar -->
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
      <div style="font-size:13px;color:var(--text-dim);">Manage seating layout — add or remove tables anytime.</div>
      <div style="display:flex;gap:10px;">
        <button onclick="openAddTableModal()"
          style="display:flex;align-items:center;gap:6px;padding:10px 18px;border-radius:10px;
          background:rgba(76,175,80,0.15);border:1px solid rgba(76,175,80,0.4);
          color:#66BB6A;font-size:13px;font-weight:700;cursor:pointer;transition:all .2s;"
          onmouseover="this.style.background='rgba(76,175,80,0.28)'"
          onmouseout="this.style.background='rgba(76,175,80,0.15)'">
          ＋ Add Table
        </button>
        <button onclick="openRemoveTableModal()"
          style="display:flex;align-items:center;gap:6px;padding:10px 18px;border-radius:10px;
          background:rgba(244,67,54,0.12);border:1px solid rgba(244,67,54,0.35);
          color:#EF5350;font-size:13px;font-weight:700;cursor:pointer;transition:all .2s;"
          onmouseover="this.style.background='rgba(244,67,54,0.22)'"
          onmouseout="this.style.background='rgba(244,67,54,0.12)'">
          — Remove Table
        </button>
      </div>
    </div>

    <!-- Table cards grid -->
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;" id="tablesManageGrid"></div>
  </div>

  <!-- ══ ADD TABLE MODAL ══ -->
  <div id="addTableModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:400;
    align-items:center;justify-content:center;backdrop-filter:blur(4px);">
    <div style="background:var(--panel);border:1px solid var(--border);border-radius:20px;
      padding:28px 28px 24px;width:380px;max-width:95vw;animation:fadeIn .3s ease;">
      <div style="font-family:'Playfair Display',serif;color:var(--gold);font-size:20px;font-weight:700;margin-bottom:20px;">
        ＋ Add New Table
      </div>
      <div style="margin-bottom:14px;">
        <label style="font-size:11px;color:var(--text-dim);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px;">Table Name / Label *</label>
        <input id="newTableLabel" type="text" placeholder="e.g. Table 7, VIP Room, Patio..."
          style="width:100%;padding:11px 14px;background:var(--card);border:1.5px solid var(--border);
          border-radius:10px;color:var(--cream);font-size:14px;font-family:inherit;outline:none;"
          onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--border)'">
      </div>
      <div style="margin-bottom:14px;">
        <label style="font-size:11px;color:var(--text-dim);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px;">Table Code (short ID) *</label>
        <input id="newTableNumber" type="text" placeholder="e.g. T07, VIP1, PATIO"
          maxlength="10"
          oninput="this.value=this.value.toUpperCase().replace(/[^A-Z0-9]/,'')"
          style="width:100%;padding:11px 14px;background:var(--card);border:1.5px solid var(--border);
          border-radius:10px;color:var(--cream);font-size:14px;font-family:inherit;outline:none;letter-spacing:2px;"
          onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--border)'">
      </div>
      <div style="margin-bottom:22px;">
        <label style="font-size:11px;color:var(--text-dim);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px;">Number of Seats</label>
        <input id="newTableSeats" type="number" value="4" min="1" max="30"
          style="width:100%;padding:11px 14px;background:var(--card);border:1.5px solid var(--border);
          border-radius:10px;color:var(--cream);font-size:14px;font-family:inherit;outline:none;"
          onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--border)'">
      </div>
      <div style="font-size:11px;color:rgba(255,152,0,0.7);margin-bottom:18px;padding:8px 12px;
        background:rgba(255,152,0,0.08);border-radius:8px;border:1px solid rgba(255,152,0,0.2);">
        ⚠️ Make sure the Table Code is unique (no duplicates).
      </div>
      <div style="display:flex;gap:10px;">
        <button onclick="submitAddTable()"
          style="flex:1;padding:13px;background:var(--gold);color:var(--bg);border:none;
          border-radius:12px;font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;"
          onmouseover="this.style.filter='brightness(1.1)'" onmouseout="this.style.filter='none'">
          ✓ Add Table
        </button>
        <button onclick="closeAddTableModal()"
          style="padding:13px 18px;background:none;border:1px solid var(--border);
          color:var(--text-dim);border-radius:12px;cursor:pointer;font-size:13px;transition:all .2s;"
          onmouseover="this.style.borderColor='var(--red)';this.style.color='var(--red)'"
          onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-dim)'">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- ══ REMOVE TABLE MODAL ══ -->
  <div id="removeTableModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:400;
    align-items:center;justify-content:center;backdrop-filter:blur(4px);">
    <div style="background:var(--panel);border:1px solid var(--border);border-radius:20px;
      padding:28px 28px 24px;width:380px;max-width:95vw;animation:fadeIn .3s ease;">
      <div style="font-family:'Playfair Display',serif;color:#EF5350;font-size:20px;font-weight:700;margin-bottom:8px;">
        — Remove Table
      </div>
      <div style="font-size:13px;color:var(--text-dim);margin-bottom:20px;line-height:1.5;">
        Select a table to remove. This will hide it from the customer table selection screen.
      </div>
      <div style="margin-bottom:22px;">
        <label style="font-size:11px;color:var(--text-dim);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px;">Choose Table to Remove</label>
        <select id="removeTableSelect"
          style="width:100%;padding:12px 14px;background:var(--card);border:1.5px solid var(--border);
          border-radius:10px;color:var(--cream);font-size:14px;font-family:inherit;outline:none;cursor:pointer;"
          onfocus="this.style.borderColor='var(--red)'" onblur="this.style.borderColor='var(--border)'">
          <option value="">– Select a table –</option>
        </select>
      </div>
      <div style="font-size:11px;color:rgba(239,83,80,0.7);margin-bottom:18px;padding:8px 12px;
        background:rgba(239,83,80,0.08);border-radius:8px;border:1px solid rgba(239,83,80,0.2);">
        ⚠️ This will hide the table from customers. It will NOT delete order history.
      </div>
      <div style="display:flex;gap:10px;">
        <button onclick="submitRemoveTable()"
          style="flex:1;padding:13px;background:rgba(244,67,54,0.15);color:#EF5350;
          border:1px solid rgba(244,67,54,0.4);border-radius:12px;font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;"
          onmouseover="this.style.background='rgba(244,67,54,0.3)'" onmouseout="this.style.background='rgba(244,67,54,0.15)'">
          🗑 Remove Table
        </button>
        <button onclick="closeRemoveTableModal()"
          style="padding:13px 18px;background:none;border:1px solid var(--border);
          color:var(--text-dim);border-radius:12px;cursor:pointer;font-size:13px;transition:all .2s;"
          onmouseover="this.style.borderColor='var(--border)';this.style.color='var(--cream)'"
          onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-dim)'">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<!-- PAYMENT MODAL -->
<div class="payment-modal-overlay" id="paymentModal">
  <div class="payment-modal">
    <div class="pm-title">💳 Process Payment</div>
    <div class="pm-amount" id="pmAmount">₱0.00</div>
    <div style="color:var(--text-dim);font-size:13px;margin-bottom:16px;">
      <strong style="color:var(--cream)" id="pmOrderCode">–</strong> · Table <span id="pmTable">–</span>
    </div>
    <div class="pm-methods">
      <div class="pm-method selected" onclick="selectMethod(this,'cash')">💵 Cash</div>
      <div class="pm-method" onclick="selectMethod(this,'gcash')">📱 GCash</div>
      <div class="pm-method" onclick="selectMethod(this,'maya')">💜 Maya</div>
      <div class="pm-method" onclick="selectMethod(this,'card')">💳 Card</div>
    </div>

    <!-- GCash QR Panel — shows when GCash is selected -->
    <div class="gcash-qr-panel" id="gcashQrPanel">
      <div class="gcash-header">
        <div class="gcash-logo">GCash</div>
        <div>
          <div class="gcash-title">Scan to Pay via GCash</div>
          <div class="gcash-sub">Customer scans this QR with their GCash app</div>
        </div>
      </div>
      <div class="gcash-amount-big" id="gcashAmountDisplay">₱0.00</div>
      <div style="text-align:center;">
        <div class="gcash-qr-box">
          <div id="gcashQrCode"></div>
        </div>
      </div>
      <div class="gcash-info-row">
        <span class="gcash-info-label">Send to</span>
        <span class="gcash-info-value" id="gcashNumber">09XX-XXX-XXXX</span>
      </div>
      <div class="gcash-info-row">
        <span class="gcash-info-label">Account Name</span>
        <span class="gcash-info-value">Kapitol Cafe</span>
      </div>
      <div class="gcash-info-row">
        <span class="gcash-info-label">Reference</span>
        <span class="gcash-info-value" id="gcashRef">–</span>
      </div>
      <div class="gcash-scan-hint">📱 Open GCash → Pay QR → Enter exact amount → Screenshot receipt</div>
    </div>

    <button class="pm-confirm" onclick="confirmPayment()">✓ Confirm Payment Received</button>
    <button class="pm-cancel-btn" onclick="closePayment()">Cancel</button>
  </div>
</div>

<div class="toast" id="toast"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
const SITE_URL = 'http://192.168.137.1/kapitol_cafe';
let allOrders = [];
let currentView = 'dashboard';
let currentFilter = 'all';
let paymentOrderId = null;
let paymentMethod = 'cash';

// ── SCROLL TAB SWITCHER ──
function switchViewTab(view, tabEl) {
  // Update scroll tab active state
  document.querySelectorAll('.stab').forEach(t => t.classList.remove('active'));
  if (tabEl) tabEl.classList.add('active');
  // Also sync sidebar
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  // Delegate to original switchView
  switchViewInternal(view);
}

function switchView(view){
  // Called from sidebar — also update tab
  const tabEl = document.getElementById('stab-' + view);
  document.querySelectorAll('.stab').forEach(t => t.classList.remove('active'));
  if (tabEl) tabEl.classList.add('active');
  switchViewInternal(view);
}

function switchViewInternal(view){
  currentView = view;
  // Update sidebar active state if triggered from sidebar
  if (typeof event !== 'undefined' && event && event.currentTarget) {
    document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
    event.currentTarget.classList.add('active');
  }

  const titles = {
    dashboard:'Dashboard', cashier:'Cashier – Order Management',
    kitchen:'Kitchen View', all_orders:'All Orders', tables:'Table Management'
  };
  document.getElementById('pageTitle').textContent = titles[view]||view;

  const tableView = document.getElementById('ordersTableView');
  const kitchenView = document.getElementById('kitchenView');
  const tablesView = document.getElementById('tablesView');
  const viewTabs = document.getElementById('viewTabs');

  tableView.style.display='none';
  kitchenView.style.display='none';
  tablesView.style.display='none';
  viewTabs.style.display='none';

  if(view === 'kitchen'){
    kitchenView.style.display='block';
    renderKitchen();
  } else if(view === 'tables'){
    tablesView.style.display='block';
    loadTablesManage();
  } else {
    tableView.style.display='block';
    if(view==='cashier') viewTabs.style.display='flex';
    renderOrders();
  }
}

async function loadTablesManage(){
  const grid = document.getElementById('tablesManageGrid');
  grid.innerHTML = '<p style="color:var(--text-dim);grid-column:1/-1;padding:20px">Loading...</p>';
  let tables = [];
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=get_tables`);
    const data = await res.json();
    tables = data.data || [];
  } catch(e) {
    tables = [
      {table_number:'T01',seats:4,status:'available',label:'Table 1'},
      {table_number:'T02',seats:4,status:'available',label:'Table 2'},
      {table_number:'T03',seats:6,status:'occupied', label:'Table 3'},
      {table_number:'T04',seats:2,status:'available',label:'Table 4'},
      {table_number:'T05',seats:8,status:'available',label:'Table 5'},
      {table_number:'BAR',seats:3,status:'occupied', label:'Bar Counter'},
    ];
  }
  grid.innerHTML = '';
  tables.forEach(t => {
    const isAv = t.status === 'available';
    const label = t.label || ('Table '+t.table_number);
    const card = document.createElement('div');
    card.style.cssText = `background:var(--card);border:1px solid ${isAv?'rgba(76,175,80,0.4)':'rgba(244,67,54,0.3)'};border-radius:16px;padding:20px;text-align:center;transition:all .3s;`;
    card.innerHTML = `
      <div style="font-size:36px;margin-bottom:10px">${isAv?'🪑':'🔴'}</div>
      <div style="font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);margin-bottom:4px">${label}</div>
      <div style="font-size:12px;color:var(--text-dim);margin-bottom:14px">👥 ${t.seats} seats</div>
      <div style="display:inline-block;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:700;margin-bottom:14px;
        background:${isAv?'rgba(76,175,80,0.15)':'rgba(244,67,54,0.15)'};
        border:1px solid ${isAv?'rgba(76,175,80,0.4)':'rgba(244,67,54,0.3)'};
        color:${isAv?'#66BB6A':'#EF5350'}">
        ${isAv?'● Available':'● Occupied'}
      </div><br>
      <button onclick="toggleTableStatus('${t.table_number}','${isAv?'occupied':'available'}')"
        style="padding:8px 18px;border-radius:10px;border:1px solid ${isAv?'rgba(244,67,54,0.5)':'rgba(76,175,80,0.5)'};
        background:${isAv?'rgba(244,67,54,0.1)':'rgba(76,175,80,0.1)'};
        color:${isAv?'#EF5350':'#66BB6A'};font-size:12px;font-weight:700;cursor:pointer;transition:all .2s">
        ${isAv?'🔴 Mark Occupied':'✅ Mark Available'}
      </button>
    `;
    grid.appendChild(card);
  });
}

async function toggleTableStatus(tableNum, newStatus){
  try {
    await fetch(`${SITE_URL}/api/api.php?action=update_table_status`, {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({table_number: tableNum, status: newStatus})
    });
  } catch(e) {}
  showToast(`Table ${tableNum} marked as ${newStatus}`, 'success');
  loadTablesManage();
}

// ── ADD TABLE ──
let _allTablesList = [];

function openAddTableModal(){
  document.getElementById('newTableLabel').value='';
  document.getElementById('newTableNumber').value='';
  document.getElementById('newTableSeats').value='4';
  const modal = document.getElementById('addTableModal');
  modal.style.display='flex';
  setTimeout(()=>document.getElementById('newTableLabel').focus(), 150);
}
function closeAddTableModal(){
  document.getElementById('addTableModal').style.display='none';
}

async function submitAddTable(){
  const label  = document.getElementById('newTableLabel').value.trim();
  const num    = document.getElementById('newTableNumber').value.trim().toUpperCase();
  const seats  = parseInt(document.getElementById('newTableSeats').value) || 4;
  if(!label){ showToast('Please enter a table name.','error'); return; }
  if(!num)  { showToast('Please enter a table code.','error'); return; }
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=add_table`,{
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({table_number:num, label:label, seats:seats})
    });
    const data = await res.json();
    if(data.success){
      showToast(`✅ "${label}" (${num}) added successfully!`, 'success');
      closeAddTableModal();
      loadTablesManage();
    } else {
      showToast('❌ ' + (data.message||'Failed to add table.'), 'error');
    }
  } catch(e){
    showToast('❌ Could not connect to server.', 'error');
  }
}

// ── REMOVE TABLE ──
async function openRemoveTableModal(){
  // Load fresh table list into the select
  let tables = [];
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=get_tables`);
    const data = await res.json();
    tables = data.data || [];
  } catch(e){ tables = _allTablesList; }

  const sel = document.getElementById('removeTableSelect');
  sel.innerHTML = '<option value="">– Select a table –</option>';
  tables.forEach(t=>{
    const opt = document.createElement('option');
    opt.value = t.table_number;
    opt.textContent = `${t.label||t.table_number}  (${t.table_number})  · ${t.seats} seats · ${t.status}`;
    sel.appendChild(opt);
  });

  document.getElementById('removeTableModal').style.display='flex';
}
function closeRemoveTableModal(){
  document.getElementById('removeTableModal').style.display='none';
}

async function submitRemoveTable(){
  const num = document.getElementById('removeTableSelect').value;
  if(!num){ showToast('Please select a table to remove.','error'); return; }
  const label = document.getElementById('removeTableSelect').selectedOptions[0]?.text || num;
  if(!confirm(`Remove "${label}"? This will hide it from customers.`)) return;
  try {
    const res = await fetch(`${SITE_URL}/api/api.php?action=remove_table`,{
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({table_number:num})
    });
    const data = await res.json();
    if(data.success){
      showToast(`🗑 Table "${num}" removed.`, 'success');
      closeRemoveTableModal();
      loadTablesManage();
    } else {
      showToast('❌ ' + (data.message||'Failed to remove table.'), 'error');
    }
  } catch(e){
    showToast('❌ Could not connect to server.', 'error');
  }
}

// Close modals on overlay click
document.getElementById('addTableModal').addEventListener('click',function(e){if(e.target===this)closeAddTableModal();});
document.getElementById('removeTableModal').addEventListener('click',function(e){if(e.target===this)closeRemoveTableModal();});

function filterOrders(f){
  currentFilter = f;
  document.querySelectorAll('.view-tab').forEach(t=>t.classList.remove('active'));
  document.getElementById('tab-'+f)?.classList.add('active');
  renderOrders();
}

function getDemoOrders(){
  return [
    {id:1,order_code:'KAP-A1B2C3',table_number:'T01',customer_name:'Maria',
     items_summary:'2x Iced Latte, 1x Butter Croissant',total_amount:195,
     status:'pending',payment_status:'unpaid',created_at:new Date(Date.now()-5*60000).toISOString()},
    {id:2,order_code:'KAP-D4E5F6',table_number:'T03',customer_name:'Juan',
     items_summary:'1x Cold Brew, 2x Nachos Supreme',total_amount:380,
     status:'preparing',payment_status:'unpaid',created_at:new Date(Date.now()-12*60000).toISOString()},
    {id:3,order_code:'KAP-G7H8I9',table_number:'T02',customer_name:'Ana',
     items_summary:'3x Cappuccino, 1x Club Sandwich Meal',total_amount:507,
     status:'ready',payment_status:'unpaid',created_at:new Date(Date.now()-18*60000).toISOString()},
    {id:4,order_code:'KAP-J1K2L3',table_number:'BAR',customer_name:'Pedro',
     items_summary:'1x Matcha Latte, 2x Cheese Danish',total_amount:290,
     status:'confirmed',payment_status:'unpaid',created_at:new Date(Date.now()-8*60000).toISOString()},
  ];
}

async function loadData(){
  try{
    const [ordersRes, statsRes] = await Promise.all([
      fetch(`${SITE_URL}/api/api.php?action=get_orders`),
      fetch(`${SITE_URL}/api/api.php?action=stats`)
    ]);
    const ordersData = await ordersRes.json();
    const statsData = await statsRes.json();
    allOrders = ordersData.data || [];
    updateStats(statsData.data);
  } catch(e){
    allOrders = getDemoOrders();
    updateStats({today:{cnt:12,revenue:4850},active:3,ready:1});
  }
  updateBadges();
  if(currentView==='kitchen') renderKitchen();
  else renderOrders();
  if(window._hideSplash) window._hideSplash();
}

function updateStats(data){
  document.getElementById('statActive').textContent = data.active || 0;
  document.getElementById('statReady').textContent = data.ready || 0;
  document.getElementById('statToday').textContent = data.today?.cnt || 0;
  document.getElementById('statRevenue').textContent = '₱' + parseFloat(data.today?.revenue||0).toLocaleString('en-PH',{minimumFractionDigits:2});
}

function updateBadges(){
  const pending = allOrders.filter(o=>o.status==='pending').length;
  const kitchen = allOrders.filter(o=>['confirmed','preparing'].includes(o.status)).length;
  document.getElementById('pendingCount').textContent = pending;
  document.getElementById('kitchenCount').textContent = kitchen;
  // Update scroll tab badges
  const sp = document.getElementById('stabPending');
  const sk = document.getElementById('stabKitchen');
  if (sp) sp.textContent = pending;
  if (sk) sk.textContent = kitchen;
}

function getStatusActions(order){
  const s = order.status;
  let btns = '';
  if(s==='pending') btns += `<button class="action-btn btn-confirm" onclick="updateStatus(${order.id},'confirmed')">✓ Confirm</button>`;
  if(s==='confirmed') btns += `<button class="action-btn btn-prepare" onclick="updateStatus(${order.id},'preparing')">🍳 Prepare</button>`;
  if(s==='preparing') btns += `<button class="action-btn btn-ready" onclick="updateStatus(${order.id},'ready')">✅ Ready</button>`;
  if(s==='ready') btns += `<button class="action-btn btn-ready" onclick="updateStatus(${order.id},'served')">🍽️ Served</button>`;
  if(['served','ready'].includes(s) && order.payment_status==='unpaid')
    btns += `<button class="action-btn btn-pay" onclick="openPayment(${order.id},'${order.order_code}','${order.table_number}',${order.total_amount})">💳 Pay</button>`;
  if(!['paid','cancelled'].includes(s))
    btns += `<button class="action-btn btn-cancel" onclick="updateStatus(${order.id},'cancelled')">✕</button>`;
  return btns;
}

function timeAgo(dateStr){
  const diff = Math.floor((Date.now()-new Date(dateStr))/1000);
  if(diff<60) return diff+'s ago';
  if(diff<3600) return Math.floor(diff/60)+'m ago';
  return Math.floor(diff/3600)+'h ago';
}

function renderOrders(){
  let orders = [...allOrders];
  if(currentView==='cashier'||currentFilter!=='all'){
    if(currentFilter==='pending') orders=orders.filter(o=>o.status==='pending');
    else if(currentFilter==='ready') orders=orders.filter(o=>o.status==='ready');
  }
  const tbody = document.getElementById('ordersBody');
  if(!orders.length){
    tbody.innerHTML='<tr><td colspan="8"><div class="empty-state"><div class="empty-state-icon">📭</div><p>No orders found</p></div></td></tr>';
    return;
  }
  tbody.innerHTML = orders.map(o=>`
    <tr>
      <td><strong style="color:var(--gold)">${o.order_code}</strong></td>
      <td>${o.table_number}</td>
      <td>${o.customer_name}</td>
      <td style="max-width:220px;font-size:12px;color:var(--text-dim)">${o.items_summary||'–'}</td>
      <td><strong>₱${parseFloat(o.total_amount).toFixed(2)}</strong></td>
      <td><span class="status-pill s-${o.status}">${o.status}</span></td>
      <td style="color:var(--text-dim);font-size:12px">${timeAgo(o.created_at)}</td>
      <td>${getStatusActions(o)}</td>
    </tr>
  `).join('');
}

function renderKitchen(){
  const grid = document.getElementById('kitchenGrid');
  const orders = allOrders.filter(o=>['confirmed','preparing'].includes(o.status));
  if(!orders.length){
    grid.innerHTML='<div class="empty-state"><div class="empty-state-icon">🍳</div><p>No active orders in kitchen</p></div>';
    return;
  }
  grid.innerHTML = orders.map(o=>`
    <div class="kitchen-card kc-${o.status}">
      <div class="kitchen-card-header">
        <div>
          <div class="kitchen-order-code">${o.order_code}</div>
          <div class="kitchen-table">Table ${o.table_number} · ${o.customer_name}</div>
        </div>
        <span class="status-pill s-${o.status}">${o.status}</span>
      </div>
      <div class="kitchen-items">
        ${(o.items_summary||'').split(', ').map(item=>{
          const m = item.match(/^(\d+)x (.+)$/);
          if(!m) return `<div class="kitchen-item"><span class="kitchen-item-qty">1</span><span>${item}</span></div>`;
          return `<div class="kitchen-item"><span class="kitchen-item-qty">${m[1]}</span><span>${m[2]}</span></div>`;
        }).join('')}
      </div>
      <div class="kitchen-footer">
        ${o.status==='confirmed'?`<button class="action-btn btn-prepare" onclick="updateStatus(${o.id},'preparing')">🍳 Start Cooking</button>`:''}
        ${o.status==='preparing'?`<button class="action-btn btn-ready" onclick="updateStatus(${o.id},'ready')">✅ Mark Ready</button>`:''}
        <span class="kitchen-timer">⏱ ${timeAgo(o.created_at)}</span>
      </div>
    </div>
  `).join('');
}

async function updateStatus(orderId, status){
  try{
    await fetch(`${SITE_URL}/api/api.php?action=update_status`,{
      method:'POST',headers:{'Content-Type':'application/json'},
      body:JSON.stringify({order_id:orderId,status})
    });
  } catch(e){}
  const order = allOrders.find(o=>o.id===orderId);
  if(order) order.status=status;
  updateBadges();
  if(currentView==='kitchen') renderKitchen(); else renderOrders();
  showToast(`Order status updated to ${status}`, 'success');
}

const GCASH_NUMBER = '09XX-XXX-XXXX'; // ← Update with your real GCash number
let _gcashQrInstance = null;
let _currentAmount = 0;
let _currentCode = '';

function openPayment(id, code, table, amount){
  paymentOrderId = id;
  _currentAmount = parseFloat(amount);
  _currentCode = code;
  document.getElementById('pmAmount').textContent = '₱'+_currentAmount.toFixed(2);
  document.getElementById('pmOrderCode').textContent = code;
  document.getElementById('pmTable').textContent = table;
  document.getElementById('gcashNumber').textContent = GCASH_NUMBER;
  // Reset to cash on open
  document.querySelectorAll('.pm-method').forEach(m=>m.classList.remove('selected'));
  document.querySelector('.pm-method').classList.add('selected');
  paymentMethod = 'cash';
  document.getElementById('gcashQrPanel').classList.remove('show');
  document.getElementById('paymentModal').classList.add('show');
}
function closePayment(){
  document.getElementById('paymentModal').classList.remove('show');
  document.getElementById('gcashQrPanel').classList.remove('show');
}
function selectMethod(el, method){
  document.querySelectorAll('.pm-method').forEach(m=>m.classList.remove('selected'));
  el.classList.add('selected');
  paymentMethod = method;
  const panel = document.getElementById('gcashQrPanel');
  if(method === 'gcash'){
    panel.classList.add('show');
    buildGcashQR(_currentAmount, _currentCode);
  } else {
    panel.classList.remove('show');
  }
}

function buildGcashQR(amount, ref){
  // Update display
  document.getElementById('gcashAmountDisplay').textContent = '₱' + amount.toFixed(2);
  document.getElementById('gcashRef').textContent = ref;
  // QR points to gcash_pay.php — customer lands on a "Payment Sent" confirmation page
  const qrUrl = SITE_URL + '/gcash_pay.php'
    + '?amount=' + encodeURIComponent(amount.toFixed(2))
    + '&ref='    + encodeURIComponent(ref)
    + '&to='     + encodeURIComponent(GCASH_NUMBER);
  // Clear old QR
  const container = document.getElementById('gcashQrCode');
  container.innerHTML = '';
  _gcashQrInstance = new QRCode(container, {
    text: qrUrl,
    width: 180, height: 180,
    colorDark: '#003D99',
    colorLight: '#FFFFFF',
    correctLevel: QRCode.CorrectLevel.H
  });
}
async function confirmPayment(){
  try{
    await fetch(`${SITE_URL}/api/api.php?action=mark_paid`,{
      method:'POST',headers:{'Content-Type':'application/json'},
      body:JSON.stringify({order_id:paymentOrderId,method:paymentMethod})
    });
  } catch(e){}
  const order = allOrders.find(o=>o.id===paymentOrderId);
  if(order){order.status='paid';order.payment_status='paid';}
  closePayment();
  allOrders = allOrders.filter(o=>o.id!==paymentOrderId);
  updateBadges(); renderOrders();
  showToast('Payment confirmed! 💚', 'success');
}

function showToast(msg, type='success'){
  const t = document.getElementById('toast');
  t.textContent = (type==='success'?'✅ ':'❌ ') + msg;
  t.className = `toast ${type} show`;
  setTimeout(()=>t.classList.remove('show'), 3000);
}

function updateTime(){
  const now = new Date();
  document.getElementById('timeDisplay').textContent =
    now.toLocaleDateString('en-PH',{weekday:'short',month:'short',day:'numeric'}) +
    ' · ' + now.toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit'});
}

// Init
loadData();
updateTime();
setInterval(updateTime, 1000);
setInterval(loadData, 15000); // auto-refresh every 15s

// ── Button ripple effect ──
document.addEventListener('click', function(e) {
  const btn = e.target.closest('.btn-primary, .btn-secondary, .btn-danger, .btn-action, .action-btn');
  if (!btn) return;
  const r = document.createElement('span');
  r.className = 'ripple';
  const rect = btn.getBoundingClientRect();
  const size = Math.max(rect.width, rect.height);
  r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;position:absolute;`;
  btn.appendChild(r);
  setTimeout(()=>r.remove(), 500);
});

// ── View tab ink effect ──
document.addEventListener('click', function(e) {
  const tab = e.target.closest('.view-tab');
  if (!tab) return;
  const ink = document.createElement('span');
  ink.className = 'tab-ink';
  const rect = tab.getBoundingClientRect();
  const size = Math.max(rect.width, rect.height);
  ink.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;position:absolute;`;
  tab.appendChild(ink);
  setTimeout(()=>ink.remove(), 500);
});
</script>
</body>
</html>