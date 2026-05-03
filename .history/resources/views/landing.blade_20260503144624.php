<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PO-Management by CuanPilot — Kelola Pre-Order dengan Mudah</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root {
    --purple: #6C5CE7;
    --purple-dark: #2D1B69;
    --purple-deeper: #1A0F3C;
    --purple-mid: #4834C4;
    --purple-light: #A29BFE;
    --purple-pale: #EDE9FF;
    --accent: #00D2B4;
    --accent2: #FFD166;
    --white: #FFFFFF;
    --gray-100: #F8F7FF;
    --gray-200: #EDE9FF;
    --gray-500: #8B7FB8;
    --gray-700: #3D3060;
    --text-dark: #1A0F3C;
    --text-muted: #7B6FA8;
    --font: 'Plus Jakarta Sans', sans-serif;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body { font-family: var(--font); background: #fff; color: var(--text-dark); overflow-x: hidden; }

  /* NAVBAR */
  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 5%; height: 68px;
    background: rgba(26, 15, 60, 0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }
  .nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
  .nav-logo-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--purple); display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 900; color: white; letter-spacing: -0.5px;
  }
  .nav-logo-text { font-size: 18px; font-weight: 800; color: white; }
  .nav-links { display: flex; align-items: center; gap: 32px; }
  .nav-links a { color: rgba(255,255,255,0.75); text-decoration: none; font-size: 14px; font-weight: 500; transition: color .2s; }
  .nav-links a:hover { color: white; }
  .nav-cta {
    background: var(--purple); color: white; border: none;
    padding: 10px 22px; border-radius: 10px; font-size: 14px; font-weight: 700;
    cursor: pointer; font-family: var(--font); transition: background .2s, transform .15s;
    text-decoration: none;
  }
  .nav-cta:hover { background: var(--purple-mid); transform: translateY(-1px); }

  /* HERO */
  .hero {
    min-height: 100vh; padding: 120px 5% 80px;
    background: var(--purple-deeper);
    position: relative; overflow: hidden;
    display: flex; align-items: center;
  }
  .hero::before {
    content: ''; position: absolute; top: -200px; right: -100px;
    width: 700px; height: 700px; border-radius: 50%;
    background: radial-gradient(circle, rgba(108,92,231,0.35) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero::after {
    content: ''; position: absolute; bottom: -150px; left: -150px;
    width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,210,180,0.12) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; width: 100%; position: relative; z-index: 1; }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(108,92,231,0.2); border: 1px solid rgba(108,92,231,0.4);
    color: var(--purple-light); padding: 8px 16px; border-radius: 99px;
    font-size: 13px; font-weight: 600; margin-bottom: 28px;
  }
  .hero-badge span { width: 7px; height: 7px; border-radius: 50%; background: var(--accent); display: inline-block; }
  .hero h1 { font-size: clamp(34px, 5vw, 60px); font-weight: 900; line-height: 1.1; color: white; margin-bottom: 20px; }
  .hero h1 em { color: var(--purple-light); font-style: normal; }
  .hero-sub { font-size: 17px; color: rgba(255,255,255,0.65); line-height: 1.7; margin-bottom: 36px; max-width: 480px; }
  .hero-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
  .btn-primary {
    background: var(--purple); color: white; border: none;
    padding: 15px 30px; border-radius: 12px; font-size: 15px; font-weight: 700;
    cursor: pointer; font-family: var(--font); transition: all .2s;
    text-decoration: none; display: inline-block;
  }
  .btn-primary:hover { background: var(--purple-mid); transform: translateY(-2px); }
  .btn-outline {
    background: transparent; color: white;
    border: 1.5px solid rgba(255,255,255,0.3);
    padding: 15px 30px; border-radius: 12px; font-size: 15px; font-weight: 600;
    cursor: pointer; font-family: var(--font); transition: all .2s;
    text-decoration: none; display: inline-block;
  }
  .btn-outline:hover { border-color: white; background: rgba(255,255,255,0.06); }
  .hero-mockup {
    background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px; overflow: hidden; aspect-ratio: 16/10;
    display: flex; align-items: center; justify-content: center;
    position: relative;
  }
  .mockup-screen {
    background: #0D0728; border-radius: 16px; padding: 20px;
    width: 90%; border: 1px solid rgba(108,92,231,0.3);
  }
  .mockup-header { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
  .mockup-dot { width: 8px; height: 8px; border-radius: 50%; }
  .mockup-title { font-size: 12px; font-weight: 700; color: white; }
  .mockup-stat-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 12px; }
  .mockup-stat { background: rgba(108,92,231,0.2); border-radius: 8px; padding: 10px; }
  .mockup-stat-label { font-size: 9px; color: rgba(255,255,255,0.5); margin-bottom: 4px; }
  .mockup-stat-val { font-size: 14px; font-weight: 800; color: white; }
  .mockup-stat-val.green { color: var(--accent); }
  .mockup-order-item { display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.04); border-radius: 8px; padding: 8px 10px; margin-bottom: 6px; }
  .mockup-avatar { width: 26px; height: 26px; border-radius: 50%; background: var(--purple); font-size: 9px; font-weight: 700; color: white; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .mockup-order-name { font-size: 11px; font-weight: 600; color: white; }
  .mockup-order-sub { font-size: 9px; color: rgba(255,255,255,0.4); }
  .mockup-badge { font-size: 8px; font-weight: 700; padding: 2px 7px; border-radius: 99px; margin-left: auto; }
  .badge-masuk { background: rgba(255,209,102,0.2); color: var(--accent2); }
  .badge-kirim { background: rgba(0,210,180,0.2); color: var(--accent); }

  /* STATS */
  .stats-bar {
    background: var(--purple-dark); padding: 32px 5%;
    display: grid; grid-template-columns: repeat(3, 1fr);
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }
  .stat-item { text-align: center; padding: 16px; }
  .stat-item + .stat-item { border-left: 1px solid rgba(255,255,255,0.08); }
  .stat-num { font-size: 36px; font-weight: 900; color: white; line-height: 1; }
  .stat-num span { color: var(--purple-light); }
  .stat-label { font-size: 13px; color: rgba(255,255,255,0.5); margin-top: 6px; font-weight: 500; }

  /* PAIN POINT */
  .pain { padding: 90px 5%; background: #fff; }
  .section-label { font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--purple); margin-bottom: 14px; }
  .section-title { font-size: clamp(28px, 4vw, 44px); font-weight: 900; color: var(--text-dark); line-height: 1.15; margin-bottom: 16px; }
  .section-sub { font-size: 16px; color: var(--text-muted); max-width: 560px; line-height: 1.7; }
  .pain-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 48px; }
  .pain-card {
    background: #FFF8F8; border: 1px solid #FFE0E0; border-radius: 16px; padding: 28px;
    position: relative; overflow: hidden;
  }
  .pain-icon { font-size: 28px; margin-bottom: 14px; }
  .pain-title { font-size: 16px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px; }
  .pain-desc { font-size: 14px; color: var(--text-muted); line-height: 1.6; }
  .pain-x { position: absolute; top: 16px; right: 16px; width: 24px; height: 24px; border-radius: 50%; background: #FFE0E0; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #E74C3C; font-weight: 900; }

  /* FEATURES */
  .features { padding: 90px 5%; background: var(--gray-100); }
  .features-header { text-align: center; margin-bottom: 56px; }
  .feat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
  .feat-card {
    background: white; border: 1px solid rgba(108,92,231,0.1); border-radius: 20px;
    padding: 28px; transition: transform .2s, box-shadow .2s;
  }
  .feat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(108,92,231,0.12); }
  .feat-card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px; }
  .feat-icon-wrap { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
  .feat-badge { font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 99px; }
  .feat-title { font-size: 17px; font-weight: 800; color: var(--text-dark); margin-bottom: 10px; }
  .feat-desc { font-size: 14px; color: var(--text-muted); line-height: 1.65; }
  .feat-list { margin-top: 14px; list-style: none; }
  .feat-list li { font-size: 13px; color: var(--text-muted); padding: 4px 0; display: flex; align-items: center; gap: 8px; }
  .feat-list li::before { content: '✓'; color: var(--purple); font-weight: 800; font-size: 12px; }

  /* HOW IT WORKS */
  .how { padding: 90px 5%; background: white; }
  .how-header { text-align: center; margin-bottom: 56px; }
  .steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; position: relative; }
  .steps::before {
    content: ''; position: absolute; top: 32px; left: calc(16% + 32px); right: calc(16% + 32px);
    height: 2px; background: linear-gradient(90deg, var(--purple) 0%, var(--purple-light) 100%);
    z-index: 0;
  }
  .step { text-align: center; position: relative; z-index: 1; }
  .step-num {
    width: 64px; height: 64px; border-radius: 50%;
    background: var(--purple); color: white; font-size: 22px; font-weight: 900;
    display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;
    border: 4px solid white; box-shadow: 0 0 0 3px var(--purple);
  }
  .step-title { font-size: 17px; font-weight: 800; color: var(--text-dark); margin-bottom: 10px; }
  .step-desc { font-size: 14px; color: var(--text-muted); line-height: 1.65; }

  /* TESTIMONIALS */
  .testi { padding: 90px 5%; background: var(--purple-deeper); }
  .testi-header { text-align: center; margin-bottom: 48px; }
  .testi-header .section-title { color: white; }
  .testi-header .section-label { color: var(--purple-light); }
  .testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .testi-card {
    background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px; padding: 28px;
  }
  .testi-stars { color: var(--accent2); font-size: 14px; margin-bottom: 14px; }
  .testi-text { font-size: 14px; color: rgba(255,255,255,0.75); line-height: 1.7; margin-bottom: 20px; font-style: italic; }
  .testi-author { display: flex; align-items: center; gap: 12px; }
  .testi-avatar { width: 42px; height: 42px; border-radius: 50%; background: var(--purple); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; color: white; flex-shrink: 0; }
  .testi-name { font-size: 14px; font-weight: 700; color: white; }
  .testi-biz { font-size: 12px; color: var(--purple-light); }

  /* PRICING */
  .pricing { padding: 90px 5%; background: var(--gray-100); }
  .pricing-header { text-align: center; margin-bottom: 48px; }
  .pricing-card-wrap { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; max-width: 1000px; margin: 0 auto; align-items: stretch; }
  .pricing-card {
    background: var(--purple-deeper); border-radius: 24px; padding: 40px;
    position: relative; overflow: hidden; border: 1px solid rgba(108,92,231,0.3);
    display: flex; flex-direction: column;
  }
  .pricing-card.starter {
    background: white; border: 2px solid var(--purple-pale);
  }
  .pricing-card.starter .pricing-price, .pricing-card.starter .pricing-features li { color: var(--text-dark); }
  .pricing-card.starter .pricing-features li { border-bottom-color: var(--gray-200); }
  .pricing-card.starter .pricing-slot-text { color: var(--text-muted); }
  .pricing-card.starter .btn-buy { background: var(--purple-pale); color: var(--purple); }
  .pricing-card.starter .btn-buy:hover { background: var(--gray-200); }

  .pricing-card::before {
    content: ''; position: absolute; top: -80px; right: -80px;
    width: 300px; height: 300px; border-radius: 50%;
    background: radial-gradient(circle, rgba(108,92,231,0.3) 0%, transparent 70%);
  }
  .pricing-lifetime-badge {
    display: inline-block; background: var(--accent2); color: #1A0F3C;
    font-size: 12px; font-weight: 800; padding: 5px 14px; border-radius: 99px;
    margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px;
  }
  .pricing-starter-badge {
    display: inline-block; background: var(--purple-pale); color: var(--purple);
    font-size: 12px; font-weight: 800; padding: 5px 14px; border-radius: 99px;
    margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px;
  }
  .pricing-price { font-size: 56px; font-weight: 900; color: white; line-height: 1; margin-bottom: 8px; }
  .pricing-price sub { font-size: 20px; font-weight: 700; vertical-align: super; }
  .pricing-original { font-size: 16px; color: rgba(255,255,255,0.4); text-decoration: line-through; margin-bottom: 6px; }
  .pricing-starter-sub { font-size: 16px; color: var(--text-muted); margin-bottom: 6px; }
  .pricing-save { display: inline-block; background: rgba(0,210,180,0.2); color: var(--accent); font-size: 13px; font-weight: 700; padding: 4px 12px; border-radius: 99px; margin-bottom: 20px; }
  .pricing-slot-wrap { margin-bottom: 28px; }
  .pricing-slot-text { font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 8px; }
  .pricing-slot-text strong { color: var(--accent2); }
  .pricing-bar { height: 8px; background: rgba(255,255,255,0.1); border-radius: 99px; overflow: hidden; }
  .pricing-card.starter .pricing-bar { background: var(--gray-100); }
  .pricing-bar-fill { height: 100%; background: linear-gradient(90deg, var(--purple-light), var(--accent)); width: 30%; border-radius: 99px; }
  .pricing-slot-count { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 6px; }
  .pricing-features { list-style: none; margin-bottom: 32px; flex-grow: 1; }
  .pricing-features li { display: flex; align-items: center; gap: 10px; font-size: 14px; color: rgba(255,255,255,0.8); padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.06); }
  .pricing-features li:last-child { border-bottom: none; }
  .pricing-features li::before { content: '✓'; width: 20px; height: 20px; border-radius: 50%; background: rgba(0,210,180,0.2); color: var(--accent); font-size: 11px; font-weight: 900; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .btn-buy {
    display: block; width: 100%; background: var(--purple); color: white;
    border: none; padding: 18px; border-radius: 14px; font-size: 16px; font-weight: 800;
    cursor: pointer; font-family: var(--font); transition: all .2s;
    text-decoration: none; text-align: center;
  }
  .btn-buy:hover { background: var(--purple-mid); transform: translateY(-2px); }

  /* FAQ */
  .faq { padding: 90px 5%; background: white; max-width: 760px; margin: 0 auto; }
  .faq-header { text-align: center; margin-bottom: 48px; }
  .faq-item { border-bottom: 1px solid rgba(108,92,231,0.12); }
  .faq-q {
    width: 100%; background: none; border: none; text-align: left;
    padding: 20px 0; font-size: 16px; font-weight: 700; color: var(--text-dark);
    cursor: pointer; font-family: var(--font);
    display: flex; justify-content: space-between; align-items: center; gap: 16px;
  }
  .faq-q .arrow { font-size: 18px; color: var(--purple); transition: transform .25s; flex-shrink: 0; }
  .faq-q.open .arrow { transform: rotate(45deg); }
  .faq-a { font-size: 14px; color: var(--text-muted); line-height: 1.75; max-height: 0; overflow: hidden; transition: max-height .35s ease, padding .25s; }
  .faq-a.open { max-height: 200px; padding-bottom: 18px; }

  /* CTA FINAL */
  .cta-final {
    padding: 90px 5%; text-align: center;
    background: var(--purple-deeper); position: relative; overflow: hidden;
  }
  .cta-final::before {
    content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
    width: 600px; height: 600px; border-radius: 50%;
    background: radial-gradient(circle, rgba(108,92,231,0.25) 0%, transparent 70%);
  }
  .cta-final h2 { font-size: clamp(28px, 4vw, 48px); font-weight: 900; color: white; margin-bottom: 16px; position: relative; }
  .cta-final p { font-size: 16px; color: rgba(255,255,255,0.6); margin-bottom: 36px; position: relative; }
  .cta-final .btn-primary { font-size: 16px; padding: 18px 40px; position: relative; }

  /* FOOTER */
  footer { background: #0D0728; padding: 40px 5%; border-top: 1px solid rgba(255,255,255,0.06); }
  .footer-inner { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; }
  .footer-links { display: flex; gap: 24px; }
  .footer-links a { font-size: 13px; color: rgba(255,255,255,0.4); text-decoration: none; transition: color .2s; }
  .footer-links a:hover { color: rgba(255,255,255,0.8); }
  .footer-copy { font-size: 12px; color: rgba(255,255,255,0.3); }

  /* STICKY BAR */
  .sticky-bar {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 200;
    background: var(--purple-dark); border-top: 1px solid rgba(255,255,255,0.1);
    padding: 14px 5%;
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    transform: translateY(100%); transition: transform .4s ease;
  }
  .sticky-bar.show { transform: translateY(0); }
  .sticky-left { display: flex; align-items: center; gap: 10px; }
  .sticky-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); animation: pulse 1.5s infinite; }
  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }
  .sticky-label { font-size: 13px; font-weight: 700; color: var(--purple-light); }
  .sticky-price { font-size: 20px; font-weight: 900; color: white; }
  .sticky-ori { font-size: 13px; color: rgba(255,255,255,0.4); text-decoration: line-through; margin-left: 8px; }
  .sticky-cta {
    background: var(--purple); color: white; border: none;
    padding: 12px 28px; border-radius: 10px; font-size: 15px; font-weight: 800;
    cursor: pointer; font-family: var(--font); white-space: nowrap;
    transition: background .2s; text-decoration: none;
  }
  .sticky-cta:hover { background: var(--purple-mid); }

  /* RESPONSIVE */
  @media (max-width: 900px) {
    .hero-inner { grid-template-columns: 1fr; }
    .hero-mockup { display: none; }
    .pain-grid, .steps, .testi-grid { grid-template-columns: 1fr; }
    .steps::before { display: none; }
    .nav-links { display: none; }
    .sticky-ori { display: none; }
    .pricing-card-wrap { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <a href="#" class="nav-logo">
    <div class="nav-logo-icon">CP</div>
    <div class="flex flex-col">
      <span class="text-white text-[13px] md:text-base font-[900] tracking-tighter leading-none uppercase">PO-Management</span>
      <span class="text-[8px] md:text-[10px] font-bold text-purple-light tracking-widest uppercase leading-none mt-1">by CuanPilot</span>
    </div>
  </a>
  <div class="nav-links">
    <a href="#fitur">Fitur</a>
    <a href="#harga">Harga</a>
    <a href="#faq">FAQ</a>
    <a href="#testimoni">Testimoni</a>
  </div>
  <a href="{{ route('register') }}" class="nav-cta">Coba Gratis</a>
</nav>

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-inner">
    <div>
      <div class="hero-badge"><span></span> Aplikasi Pre-Order untuk Semua Bisnis Makanan</div>
      <h1>Pre-Order Makin <em>Rapi,</em> Bisnis Makin <em>Untung</em></h1>
      <p class="hero-sub">Daftar sekarang dan nikmati kemudahan kelola PO. Kirim invoice ke WhatsApp pembeli otomatis. Cocok untuk katering, aqiqah, pastry, seafood, dan lainnya.</p>
      <div class="hero-buttons">
        <a href="{{ route('register') }}" class="btn-primary">Coba Gratis Sekarang</a>
        <a href="#harga" class="btn-outline">Lihat Paket Lifetime</a>
      </div>
    </div>
    <div class="hero-mockup">
      <div class="mockup-screen">
        <div class="mockup-header">
          <div class="mockup-dot" style="background:#E74C3C"></div>
          <div class="mockup-dot" style="background:#F39C12;margin-left:4px"></div>
          <div class="mockup-dot" style="background:#2ECC71;margin-left:4px"></div>
          <span class="mockup-title" style="margin-left:8px">CuanPilot — Dashboard</span>
        </div>
        <div class="mockup-stat-row">
          <div class="mockup-stat">
            <div class="mockup-stat-label">Omzet Bulan Ini</div>
            <div class="mockup-stat-val">Rp 4,2jt</div>
          </div>
          <div class="mockup-stat">
            <div class="mockup-stat-label">PO Aktif</div>
            <div class="mockup-stat-val">8</div>
          </div>
          <div class="mockup-stat">
            <div class="mockup-stat-label">Margin</div>
            <div class="mockup-stat-val green">42%</div>
          </div>
        </div>
        <div class="mockup-order-item">
          <div class="mockup-avatar">SR</div>
          <div><div class="mockup-order-name">Siti — Aqiqah</div><div class="mockup-order-sub">80 porsi Nasi Kotak</div></div>
          <div class="mockup-badge badge-masuk">Masuk</div>
        </div>
        <div class="mockup-order-item">
          <div class="mockup-avatar" style="background:#00b894">DW</div>
          <div><div class="mockup-order-name">Dewi — Pastry</div><div class="mockup-order-sub">50 box Kue Kering</div></div>
          <div class="mockup-badge badge-kirim">Siap Kirim</div>
        </div>
        <div class="mockup-order-item">
          <div class="mockup-avatar" style="background:#e17055">PH</div>
          <div><div class="mockup-order-name">Pak Hendra — Seafood</div><div class="mockup-order-sub">30 paket Frozen Pack</div></div>
          <div class="mockup-badge badge-masuk">Produksi</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
  <div class="stat-item">
    <div class="stat-num">500<span>+</span></div>
    <div class="stat-label">Pengguna Aktif</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">10rb<span>+</span></div>
    <div class="stat-label">Order Dikelola</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">4.9<span>★</span></div>
    <div class="stat-label">Rating Pengguna</div>
  </div>
</div>

<!-- PAIN POINT -->
<section class="pain">
  <div class="section-label">Masalah yang Sering Terjadi</div>
  <div class="section-title">Masih Kelola Pre-Order<br>Pakai WhatsApp & Catatan Manual?</div>
  <p class="section-sub">Mau jualan katering, pastry, seafood, hampers, atau apapun — kalau masih manual, pasti udah pernah ngalamin ini.</p>
  <div class="pain-grid">
    <div class="pain-card">
      <div class="pain-x">✕</div>
      <div class="pain-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#E74C3C" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="9" y1="15" x2="9.01" y2="15" stroke-width="3"/><line x1="15" y1="15" x2="15.01" y2="15" stroke-width="3"/></svg>
      </div>
      <div class="pain-title">Pesanan Berantakan & Lupa Deadline</div>
      <p class="pain-desc">Order masuk dari mana-mana, catatan manual berantakan, dan sering lupa deadline kirim yang bikin pelanggan komplain.</p>
    </div>
    <div class="pain-card">
      <div class="pain-x">✕</div>
      <div class="pain-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#E74C3C" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16" stroke-width="3"/></svg>
      </div>
      <div class="pain-title">Bingung Hitung Keuntungan & HPP</div>
      <p class="pain-desc">Nggak tau harga pokok produksi per porsi, jual murah tapi nggak tau untung berapa — bisnis jalan tapi margin gelap.</p>
    </div>
    <div class="pain-card">
      <div class="pain-x">✕</div>
      <div class="pain-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#E74C3C" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg>
      </div>
      <div class="pain-title">Invoice Harus Ketik Ulang Manual</div>
      <p class="pain-desc">Tiap ada order baru harus ketik invoice dari awal, format beda-beda, dan sering ada yang lupa dikirim ke pembeli.</p>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="features" id="fitur">
  <div class="features-header">
    <div class="section-label">Fitur Lengkap</div>
    <div class="section-title">Semua yang Kamu Butuhkan<br>Ada di CuanPilot</div>
    <p class="section-sub" style="margin: 0 auto; text-align:center">Satu aplikasi untuk semua jenis pre-order makanan — katering, aqiqah, pastry, seafood, hampers, dan lainnya.</p>
  </div>
  <div class="feat-grid">
    <div class="feat-card">
      <div class="feat-card-top">
        <div class="feat-icon-wrap" style="background:#EDE9FF">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4834C4" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 17h7M17 14v7"/></svg>
        </div>
        <span class="feat-badge" style="background:#EDE9FF;color:#4834C4">Dashboard</span>
      </div>
      <div class="feat-title">Dashboard Bisnis Real-time</div>
      <p class="feat-desc">Pantau omzet, PO aktif, margin keuntungan, dan deadline order dalam satu layar sekilas pandang.</p>
      <ul class="feat-list">
        <li>Omzet bulan ini vs bulan lalu</li>
        <li>Jumlah PO aktif & deadline dekat</li>
        <li>Margin rata-rata bisnis</li>
      </ul>
    </div>
    <div class="feat-card">
      <div class="feat-card-top">
        <div class="feat-icon-wrap" style="background:#E0F5FF">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0369A1" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <span class="feat-badge" style="background:#E0F5FF;color:#0369A1">Tracking</span>
      </div>
      <div class="feat-title">Tracking Order 5 Tahap</div>
      <p class="feat-desc">Kelola status setiap order dari masuk sampai selesai dengan sistem tahap yang jelas dan mudah diupdate.</p>
      <ul class="feat-list">
        <li>Masuk → Konfirmasi → Produksi</li>
        <li>Siap Kirim → Selesai</li>
        <li>Filter order per status</li>
      </ul>
    </div>
    <div class="feat-card">
      <div class="feat-card-top">
        <div class="feat-icon-wrap" style="background:#ECFDF5">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#065F46" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
        </div>
        <span class="feat-badge" style="background:#ECFDF5;color:#065F46">Invoice WA</span>
      </div>
      <div class="feat-title">Invoice WhatsApp 1 Klik</div>
      <p class="feat-desc">Kirim invoice otomatis ke pembeli via WhatsApp. Template bisa dikustomisasi sesuai kebutuhan tokomu.</p>
      <ul class="feat-list">
        <li>Template invoice kustomisasi</li>
        <li>Auto-isi nama, porsi, total, DP</li>
        <li>Preview WA sebelum dikirim</li>
      </ul>
    </div>
    <div class="feat-card">
      <div class="feat-card-top">
        <div class="feat-icon-wrap" style="background:#FFFBEB">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#92400E" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <span class="feat-badge" style="background:#FFFBEB;color:#92400E">Kalkulator</span>
      </div>
      <div class="feat-title">Kalkulator HPP & Margin</div>
      <p class="feat-desc">Hitung harga pokok produksi per porsi secara akurat dan tentukan harga jual yang tepat agar bisnis selalu untung.</p>
      <ul class="feat-list">
        <li>Input bahan baku & porsi resep</li>
        <li>HPP per porsi otomatis</li>
        <li>Indikator margin sehat / bahaya</li>
      </ul>
    </div>
    <div class="feat-card">
      <div class="feat-card-top">
        <div class="feat-icon-wrap" style="background:#FFF0F3">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9D174D" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
        </div>
        <span class="feat-badge" style="background:#FFF0F3;color:#9D174D">Laporan</span>
      </div>
      <div class="feat-title">Laporan & Export Excel</div>
      <p class="feat-desc">Lihat performa bisnis bulanan secara lengkap dan export laporan ke Excel untuk pembukuan yang rapi.</p>
      <ul class="feat-list">
        <li>Omzet, pesanan, & margin bulanan</li>
        <li>Menu terlaris periode ini</li>
        <li>Export laporan ke Excel</li>
      </ul>
    </div>
    <div class="feat-card">
      <div class="feat-card-top">
        <div class="feat-icon-wrap" style="background:#F5F3FF">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#5B21B6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 3H8a2 2 0 0 0-2 2v2h12V5a2 2 0 0 0-2-2z"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
        </div>
        <span class="feat-badge" style="background:#F5F3FF;color:#5B21B6">Pengaturan</span>
      </div>
      <div class="feat-title">Setup Toko & Katalog Produk</div>
      <p class="feat-desc">Atur nama toko, katalog menu, harga, dan master add-on dengan mudah sesuai kebutuhan bisnismu.</p>
      <ul class="feat-list">
        <li>Katalog menu dengan harga</li>
        <li>Master add-on (topping, extra)</li>
        <li>Info bisnis & WA toko</li>
      </ul>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="how">
  <div class="how-header">
    <div class="section-label">Cara Kerja</div>
    <div class="section-title">Mulai dalam 3 Langkah Mudah</div>
  </div>
  <div class="steps">
    <div class="step">
      <div class="step-num">1</div>
      <div class="step-title">Daftar Akun Gratis</div>
      <p class="step-desc">Daftar langsung di aplikasi, isi info toko, katalog menu, dan harga produk dalam hitungan menit.</p>
    </div>
    <div class="step">
      <div class="step-num">2</div>
      <div class="step-title">Tambah & Kelola Order</div>
      <p class="step-desc">Input pre-order masuk, update status produksi, dan kirim invoice otomatis ke pembeli via WhatsApp.</p>
    </div>
    <div class="step">
      <div class="step-num">3</div>
      <div class="step-title">Pantau & Evaluasi Bisnis</div>
      <p class="step-desc">Cek dashboard, lihat laporan bulanan, analisa margin, dan kembangkan bisnis berdasarkan data nyata.</p>
    </div>
  </div>
</section>

<!-- TESTIMONI -->
<section class="testi" id="testimoni">
  <div class="testi-header">
    <div class="section-label">Testimoni</div>
    <div class="section-title">Dipercaya Ratusan Pebisnis Kuliner</div>
  </div>
  <div class="testi-grid">
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Usaha pastry saya makin teratur sejak pakai CuanPilot. Order lebaran kemarin ratusan boks, semua kekelola rapi. Invoice WA langsung kekirim otomatis, pelanggan happy!"</p>
      <div class="testi-author">
        <div class="testi-avatar">SR</div>
        <div>
          <div class="testi-name">Siti Rahayu</div>
          <div class="testi-biz">Pastry & Kue Rumahan, Bandung</div>
        </div>
      </div>
    </div>
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Fitur kalkulator HPP-nya ini yang bikin saya sadar selama ini jual seafood frozen terlalu murah. Margin saya naik drastis setelah tau harga pokok yang bener!"</p>
      <div class="testi-author">
        <div class="testi-avatar" style="background:#0984e3">BH</div>
        <div>
          <div class="testi-name">Budi Hartono</div>
          <div class="testi-biz">Frozen Seafood PO, Jakarta</div>
        </div>
      </div>
    </div>
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Katering aqiqah saya sekarang jauh lebih profesional. Dari input order, update status produksi, sampai laporan bulanan — semua ada. Harga 99rb lifetime itu worth it banget!"</p>
      <div class="testi-author">
        <div class="testi-avatar" style="background:#00b894">DW</div>
        <div>
          <div class="testi-name">Dewi Wulandari</div>
          <div class="testi-biz">Catering Aqiqah Bu Dewi, Surabaya</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PRICING -->
<section class="pricing" id="harga">
  <div class="pricing-header">
    <div class="section-label">Harga</div>
    <div class="section-title">Pilih Paket yang Sesuai<br>Kebutuhan Bisnismu</div>
    <p class="section-sub" style="margin:0 auto;text-align:center">Mulai gratis untuk mencoba fitur-fitur keren kami.</p>
  </div>
  <div class="pricing-card-wrap">

    <!-- STARTER CARD -->
    <div class="pricing-card starter">
      <div class="pricing-starter-badge">Starter — Uji Coba</div>
      <div class="pricing-price">Rp 0</div>
      <div class="pricing-starter-sub">Gratis Selamanya</div>
      <div class="pricing-save" style="background:#F0F0F0;color:#666">Coba Semua Fitur</div>
      <div class="pricing-slot-wrap">
        <div class="pricing-slot-text">Sempurna untuk yang baru memulai</div>
        <div class="pricing-bar"><div class="pricing-bar-fill" style="width: 100%; background: #CCC"></div></div>
      </div>
      <ul class="pricing-features">
        <li>Dashboard bisnis real-time</li>
        <li>Tracking order 5 tahap</li>
        <li>Invoice WhatsApp 1 klik</li>
        <li>Maksimal <strong>10 Transaksi</strong></li>
        <li>Master Katalog menu</li>
        <li>Laporan Omzet dasar</li>
        <li>Akses via HP & komputer</li>
      </ul>
      <a href="{{ route('register') }}" class="btn-buy">Daftar Gratis →</a>
    </div>

    <!-- LIFETIME CARD -->
    <div class="pricing-card">
      <div class="pricing-lifetime-badge">Early Bird — Lifetime Deal</div>
      <div class="pricing-price"><sub>Rp</sub> 99.000</div>
      <div class="pricing-original">Rp 499.000</div>
      <div class="pricing-save">Hemat 80%</div>
      <div class="pricing-slot-wrap">
        <div class="pricing-slot-text"><strong>Hanya 12 slot lagi</strong> di harga ini — setelahnya naik!</div>
        <div class="pricing-bar"><div class="pricing-bar-fill" style="width: 84%"></div></div>
        <div class="pricing-slot-count">38 dari 50 slot Early Bird terpakai</div>
      </div>
      <ul class="pricing-features">
        <li><strong>Semua Fitur Starter</strong></li>
        <li><strong>Transaksi Tanpa Batas</strong></li>
        <li>Kalkulator HPP & margin</li>
        <li>Laporan & export Excel</li>
        <li>Master add-on lengkap</li>
        <li>Update gratis selamanya</li>
        <li>Support Prioritas WA</li>
      </ul>
      <a href="{{ route('checkout') }}" class="btn-buy" target="_blank">Beli Sekarang — Rp 99.000 →</a>
    </div>

  </div>
</section>

<!-- FAQ -->
<section class="faq" id="faq">
  <div class="faq-header">
    <div class="section-label">FAQ</div>
    <div class="section-title">Pertanyaan yang Sering Ditanya</div>
  </div>
  <div class="faq-item">
    <button class="faq-q" onclick="toggleFaq(this)">Apakah CuanPilot bisa dipakai di HP? <span class="arrow">+</span></button>
    <div class="faq-a">Ya! CuanPilot adalah aplikasi berbasis web yang sangat responsif, sehingga nyaman digunakan baik di Laptop maupun Smartphone (Android/iOS).</div>
  </div>
  <div class="faq-item">
    <button class="faq-q" onclick="toggleFaq(this)">Beneran ada paket gratis? <span class="arrow">+</span></button>
    <div class="faq-a">Ya! Kamu bisa pakai paket Starter secara gratis selamanya untuk maksimal 10 transaksi. Ini cocok banget buat kamu yang mau coba-coba dulu fiturnya sebelum pindah ke Lifetime.</div>
  </div>
  <div class="faq-item">
    <button class="faq-q" onclick="toggleFaq(this)">Apa itu Lifetime Deal? Beneran selamanya? <span class="arrow">+</span></button>
    <div class="faq-a">Ya, beneran selamanya! Bayar sekali dan kamu bisa pakai CuanPilot tanpa biaya bulanan atau tahunan tambahan. Update fitur baru juga gratis untuk pengguna lifetime.</div>
  </div>
  <div class="faq-item">
    <button class="faq-q" onclick="toggleFaq(this)">Bagaimana cara kirim invoice ke WA? <span class="arrow">+</span></button>
    <div class="faq-a">Setelah Anda memasukkan data pesanan, cukup klik tombol "Kirim Invoice". Aplikasi akan otomatis membuka WhatsApp dengan rincian pesanan yang sudah terformat rapi.</div>
  </div>
  <div class="faq-item">
    <button class="faq-q" onclick="toggleFaq(this)">Apakah data pesanan saya aman? <span class="arrow">+</span></button>
    <div class="faq-a">Data kamu tersimpan dengan aman di server kami. Setiap akun terisolasi dan hanya bisa diakses oleh kamu sendiri. Kami tidak pernah membagikan data ke pihak ketiga.</div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="cta-final">
  <h2>Siap Kelola Pre-Order<br>Lebih Profesional?</h2>
  <p>Mulai dengan paket Starter GRATIS atau langsung amankan paket Lifetime.<br>Katering, pastry, seafood, aqiqah, hampers — semua bisa.</p>
  <a href="{{ route('register') }}" class="btn-primary">Daftar Gratis Sekarang</a>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <a href="#" class="nav-logo">
      <div class="nav-logo-icon">CP</div>
      <div class="flex flex-col text-left">
        <span class="text-white text-base font-[900] tracking-tight leading-none uppercase">PO-Management</span>
        <br>
        <span class="text-[9px] font-bold text-purple-light tracking-widest uppercase leading-none mt-1">by CuanPilot</span>
      </div>
    </a>
    <div class="footer-links">
      <a href="#fitur">Fitur</a>
      <a href="#harga">Harga</a>
      <a href="#faq">FAQ</a>
      <a href="#testimoni">Testimoni</a>
    </div>
    <div class="footer-copy">© 2026 PO-Management by CuanPilot. All rights reserved.</div>
  </div>
</footer>

<!-- STICKY BAR -->
<div class="sticky-bar" id="stickyBar">
  <div class="sticky-left">
    <div class="sticky-dot"></div>
    <span class="sticky-label">Lifetime Deal Promo</span>
  </div>
  <div style="display:flex;align-items:baseline;gap:6px">
    <span class="sticky-price">Rp 99.000</span>
    <span class="sticky-ori">Rp 499.000</span>
  </div>
  <a href="{{ route('checkout') }}" class="sticky-cta" target="_blank">Amankan Slot →</a>
</div>

<script>
  function toggleFaq(btn) {
    const ans = btn.nextElementSibling;
    const isOpen = ans.classList.contains('open');
    document.querySelectorAll('.faq-a').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-q').forEach(q => q.classList.remove('open'));
    if (!isOpen) { ans.classList.add('open'); btn.classList.add('open'); }
  }

  const sticky = document.getElementById('stickyBar');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 400) sticky.classList.add('show');
    else sticky.classList.remove('show');
  });
</script>
</body>
</html>
