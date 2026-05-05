<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CARTHA CARS — L'Excellence Automobile</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --gold:     #C9A84C;
      --orange:   #FF6B35;
      --bg:       #000;
      --text-dim: rgba(255,255,255,0.55);
    }

    html { height: 100%; scroll-behavior: smooth; }
    body {
      min-height: 100%;
      overflow: hidden; /* locked during intro — JS unlocks after */
      background: var(--bg);
      color: #fff;
      font-family: 'Rajdhani', sans-serif;
    }

    /* ── CANVAS PARTICLES ─────────────────── */
    #particles {
      position: fixed;
      inset: 0;
      z-index: 0;
      pointer-events: none;
    }

    /* ── PARALLAX GRADIENT ────────────────── */
    #bg-gradient {
      position: fixed;
      inset: -60px;
      z-index: 1;
      pointer-events: none;
      background: radial-gradient(ellipse 120% 80% at 50% 60%, #0a0e1a 0%, #000 70%);
      will-change: transform;
      transition: transform 0.12s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* ── VIGNETTE ─────────────────────────── */
    .vignette {
      position: fixed;
      inset: 0;
      z-index: 2;
      pointer-events: none;
      background: radial-gradient(ellipse 80% 80% at 50% 50%, transparent 40%, rgba(0,0,0,0.65) 100%);
    }

    /* ── INTRO SCREEN ─────────────────────── */
    #intro {
      position: fixed;
      inset: 0;
      z-index: 100;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: #000;
      transition: opacity 1.2s ease, visibility 1.2s ease;
    }
    #intro.fade-out {
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
    }

    #intro-logo {
      width: 130px; height: 130px;
      object-fit: contain;
      opacity: 0;
      filter: drop-shadow(0 0 0px transparent);
      transform: scale(0.7);
      animation:
        logoFadeIn 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.5s  forwards,
        logoPulse  0.6s cubic-bezier(0.22, 1, 0.36, 1) 1.1s  forwards,
        logoGlow   2.4s ease-in-out                    1.6s  infinite alternate;
    }
    @keyframes logoFadeIn {
      to { opacity: 1; transform: scale(1.1); filter: drop-shadow(0 0 22px #C9A84C) drop-shadow(0 0 8px rgba(255,107,53,0.5)); }
    }
    @keyframes logoPulse {
      0%   { transform: scale(1.1); }
      50%  { transform: scale(1.18); }
      100% { transform: scale(1.0); }
    }
    @keyframes logoGlow {
      from { filter: drop-shadow(0 0 18px #C9A84C) drop-shadow(0 0 6px rgba(255,107,53,0.4)); }
      to   { filter: drop-shadow(0 0 34px #C9A84C) drop-shadow(0 0 14px rgba(255,107,53,0.7)); }
    }

    #intro-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(56px, 10vw, 120px);
      letter-spacing: 0.25em;
      color: #fff;
      margin-top: 28px;
      display: flex;
      overflow: hidden;
    }
    #intro-title .letter {
      display: inline-block;
      opacity: 0;
      transform: translateY(40px);
      animation: letterDrop 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    #intro-title .space { display: inline-block; width: 0.35em; }
    @keyframes letterDrop { to { opacity: 1; transform: translateY(0); } }

    #intro-sub {
      font-family: 'Space Mono', monospace;
      font-size: clamp(10px, 1.6vw, 14px);
      letter-spacing: 0.3em;
      text-transform: uppercase;
      color: var(--text-dim);
      margin-top: 16px;
      opacity: 0;
      animation: fadeUp 0.8s ease forwards 2.9s;
    }
    #intro-line {
      width: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--orange), transparent);
      margin-top: 18px;
      animation: lineExpand 0.9s cubic-bezier(0.22, 1, 0.36, 1) forwards 3.5s;
    }
    @keyframes lineExpand { to { width: min(380px, 60vw); } }

    #intro-skip {
      position: absolute;
      bottom: 38px; right: 44px;
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.25em;
      color: rgba(255,255,255,0.2);
      cursor: pointer;
      text-transform: uppercase;
      transition: color 0.3s;
      animation: fadeUp 1s ease forwards 4s;
      opacity: 0;
    }
    #intro-skip:hover { color: rgba(255,255,255,0.55); }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── MAIN WRAPPER ─────────────────────── */
    #main {
      position: relative;
      z-index: 10;
      opacity: 0;
      visibility: hidden;
      transition: opacity 1.4s ease 0.2s, visibility 0s linear 0s;
    }
    #main.visible {
      opacity: 1;
      visibility: visible;
    }

    /* ── NAV ──────────────────────────────── */
    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 200;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 28px 52px;
      background: transparent;
      border-bottom: 1px solid transparent;
      transition: background .4s ease, padding .35s ease, border-color .4s ease, backdrop-filter .4s ease;
    }
    nav.scrolled {
      background: rgba(0,0,0,.88);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-color: rgba(255,255,255,.07);
      padding: 18px 52px;
    }
    .nav-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .nav-brand img {
      height: 40px;
      width: auto;
      filter: drop-shadow(0 0 6px rgba(201,168,76,0.5));
    }
    .nav-brand-name {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 22px;
      letter-spacing: 0.2em;
      color: #fff;
    }
    .nav-links {
      display: flex;
      align-items: center;
      gap: 36px;
      list-style: none;
    }
    .nav-links a {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--text-dim);
      text-decoration: none;
      transition: color 0.3s;
    }
    .nav-links a:hover { color: #fff; }
    .nav-links button.nav-btn {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--text-dim);
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      transition: color 0.3s;
    }
    .nav-links button.nav-btn:hover { color: #fff; }
    .nav-cta-link {
      border: 1px solid var(--orange);
      padding: 8px 20px;
      color: var(--orange) !important;
      clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
      transition: background 0.3s, color 0.3s !important;
    }
    .nav-cta-link:hover { background: var(--orange) !important; color: #fff !important; }

    /* ── HERO SECTION ─────────────────────── */
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 160px 52px 140px;
    }

    .hero-eyebrow {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      letter-spacing: 0.4em;
      text-transform: uppercase;
      color: var(--orange);
      margin-bottom: 44px;
    }

    .hero-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(72px, 13vw, 180px);
      line-height: 0.88;
      letter-spacing: 0.05em;
      color: #fff;
      margin-bottom: 52px;
    }
    .hero-title span {
      display: block;
      background: linear-gradient(135deg, #fff 30%, #C9A84C 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-sub {
      font-family: 'Rajdhani', sans-serif;
      font-size: clamp(17px, 2vw, 22px);
      font-weight: 300;
      color: var(--text-dim);
      letter-spacing: 0.08em;
      max-width: 580px;
      margin: 0 auto 64px;
      line-height: 1.7;
    }

    .hero-actions {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: center;
    }
    .btn-primary {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      text-decoration: none;
      color: #fff;
      background: var(--orange);
      padding: 18px 42px;
      clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
      transition: filter 0.3s, transform 0.3s;
    }
    .btn-primary:hover { filter: brightness(1.15); transform: translateY(-2px); }
    .btn-secondary {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      text-decoration: none;
      color: #fff;
      background: transparent;
      border: 1px solid rgba(255,255,255,0.3);
      padding: 18px 42px;
      clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
      transition: border-color 0.3s, background 0.3s, transform 0.3s;
    }
    .btn-secondary:hover { border-color: rgba(255,255,255,0.7); background: rgba(255,255,255,0.05); transform: translateY(-2px); }

    /* Scroll hint inside hero */
    .scroll-hint {
      position: absolute;
      bottom: 48px; left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      opacity: 0;
      animation: fadeUp 1s ease forwards 0.6s;
    }
    .scroll-hint span {
      font-family: 'Space Mono', monospace;
      font-size: 8px;
      letter-spacing: 0.3em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.2);
    }
    .scroll-line {
      width: 1px; height: 52px;
      background: linear-gradient(to bottom, var(--orange), transparent);
      animation: scrollPulse 2s ease-in-out infinite;
    }
    @keyframes scrollPulse {
      0%,100% { opacity: 0.3; transform: scaleY(1); }
      50%      { opacity: 1;   transform: scaleY(1.15); }
    }

    /* ── CATEGORIES SECTION ───────────────── */
    .categories-section {
      background: #000;
      padding: 120px 52px 140px;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    .section-eyebrow {
      display: block;
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.45em;
      text-transform: uppercase;
      color: var(--orange);
      margin-bottom: 20px;
    }

    .section-heading {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(36px, 6vw, 72px);
      letter-spacing: 0.07em;
      color: #fff;
      line-height: 1;
      margin-bottom: 16px;
    }

    .section-rule {
      width: 60px; height: 2px;
      background: linear-gradient(90deg, var(--orange), #FFA040);
      margin: 0 auto 80px;
      border-radius: 1px;
    }

    .categories-grid {
      display: flex;
      gap: 24px;
      justify-content: center;
      flex-wrap: wrap;
      max-width: 1140px;
      margin: 0 auto;
    }

    .cat-card {
      flex: 1;
      min-width: 280px;
      max-width: 360px;
      min-height: 400px;
      border: 1px solid rgba(255,255,255,0.1);
      background: rgba(255,255,255,0.03);
      padding: 44px 36px 36px;
      cursor: pointer;
      text-decoration: none;
      clip-path: polygon(0 0,calc(100% - 14px) 0,100% 14px,100% 100%,14px 100%,0 calc(100% - 14px));
      transition: border-color 0.4s, background 0.4s, transform 0.4s;
      backdrop-filter: blur(6px);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: left;
    }
    .cat-card:hover {
      border-color: var(--orange);
      background: rgba(255,107,53,0.06);
      transform: translateY(-8px);
    }

    .cat-card-top { display: flex; flex-direction: column; }

    .cat-card-number {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 13px;
      letter-spacing: 0.3em;
      color: var(--orange);
      margin-bottom: 32px;
      opacity: 0.7;
    }

    .cat-card-label {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 52px;
      letter-spacing: 0.08em;
      color: #fff;
      line-height: 0.95;
      margin-bottom: 20px;
    }

    .cat-card-desc {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--text-dim);
      line-height: 1.8;
    }

    .cat-card-ghost {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 100px;
      color: rgba(255,255,255,0.03);
      line-height: 1;
      letter-spacing: 0;
      margin-top: 16px;
      align-self: flex-end;
    }

    .cat-card-bottom {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 28px;
    }

    .cat-card-cta {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      color: var(--orange);
      opacity: 0;
      transform: translateX(-6px);
      transition: opacity 0.35s, transform 0.35s;
    }
    .cat-card-line {
      flex: 1;
      height: 1px;
      background: var(--orange);
      opacity: 0;
      transform: scaleX(0);
      transform-origin: left;
      transition: opacity 0.35s, transform 0.35s;
    }
    .cat-card-arrow {
      font-size: 14px;
      color: var(--orange);
      opacity: 0;
      transform: translateX(-4px);
      transition: opacity 0.35s, transform 0.35s;
    }
    .cat-card:hover .cat-card-cta,
    .cat-card:hover .cat-card-line,
    .cat-card:hover .cat-card-arrow {
      opacity: 1;
      transform: translateX(0) scaleX(1);
    }

    /* ── INFO BAR ─────────────────────────── */
    .info-bar {
      background: #000;
      border-top: 1px solid rgba(255,255,255,0.06);
      border-bottom: 1px solid rgba(255,255,255,0.06);
      display: flex;
      align-items: stretch;
      position: relative;
      z-index: 1;
    }
    .stat-item {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 52px 16px;
      border-right: 1px solid rgba(255,255,255,0.06);
      gap: 8px;
    }
    .stat-item:last-child { border-right: none; }
    .stat-num {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 52px;
      letter-spacing: 0.05em;
      color: var(--orange);
      line-height: 1;
    }
    .stat-label {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--text-dim);
    }

    /* ── FOOTER STRIP ─────────────────────── */
    .footer-strip {
      background: #000;
      border-top: 1px solid rgba(255,255,255,0.05);
      padding: 64px 52px;
      display: flex;
      justify-content: center;
      gap: 80px;
      flex-wrap: wrap;
      position: relative;
      z-index: 1;
    }
    .footer-item {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.22);
      text-align: center;
    }
    .footer-item strong {
      display: block;
      color: rgba(255,255,255,0.5);
      font-size: 10px;
      margin-bottom: 6px;
      font-weight: 400;
    }

    /* ── PAGE TRANSITION ──────────────────── */
    #pageTransition {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: #000;
      opacity: 1;
      pointer-events: all;
      transition: opacity .5s ease;
    }
    #pageTransition.pt-out { opacity: 0; pointer-events: none; }

    /* ── NOS PARTENAIRES MODAL ────────────── */
    .partners-overlay {
      position: fixed; inset: 0; z-index: 2000;
      background: rgba(0,0,0,.85);
      backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
      display: flex; align-items: center; justify-content: center;
      padding: 20px; opacity: 0; pointer-events: none;
      transition: opacity .35s ease;
    }
    .partners-overlay.open { opacity: 1; pointer-events: all; }
    .partners-modal {
      background: #0e0e12;
      border: 1px solid rgba(255,255,255,.1);
      border-left: 2px solid var(--orange);
      max-width: 780px; width: 100%; max-height: 90vh;
      overflow-y: auto; padding: 36px 40px; position: relative;
      transform: translateY(22px);
      transition: transform .35s cubic-bezier(.25,.46,.45,.94);
    }
    .partners-overlay.open .partners-modal { transform: translateY(0); }
    .partners-close {
      position: absolute; top: 16px; right: 16px;
      background: transparent; border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.4); width: 32px; height: 32px;
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; cursor: pointer;
      transition: color .25s, border-color .25s;
    }
    .partners-close:hover { color: #fff; border-color: rgba(255,255,255,.38); }
    .partners-eyebrow {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .32em; text-transform: uppercase;
      color: var(--orange); margin-bottom: 5px;
    }
    .partners-title {
      font-family: 'Bebas Neue', sans-serif; font-size: 28px;
      letter-spacing: .06em; color: #fff; line-height: 1; margin-bottom: 26px;
    }
    .partners-rule { height: 1px; background: rgba(255,255,255,.07); margin-bottom: 22px; }
    .partners-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
    }
    .partner-card {
      background: #111117; border: 1px solid rgba(255,255,255,.07);
      padding: 20px; transition: border-color .3s, box-shadow .3s;
    }
    .partner-card:hover {
      border-color: rgba(255,107,53,.35);
      box-shadow: 0 0 20px rgba(255,107,53,.1);
    }
    .partner-name {
      font-family: 'Bebas Neue', sans-serif; font-size: 17px;
      letter-spacing: .06em; color: #fff; margin-bottom: 5px; line-height: 1.1;
    }
    .partner-spec {
      font-family: 'Rajdhani', sans-serif; font-size: 13px;
      color: var(--orange); margin-bottom: 8px; font-weight: 500;
    }
    .partner-addr {
      font-family: 'Rajdhani', sans-serif; font-size: 12px;
      color: rgba(255,255,255,.38); margin-bottom: 14px; line-height: 1.5;
    }
    .btn-partner-wa {
      display: inline-flex; align-items: center; gap: 7px;
      font-family: 'Space Mono', monospace; font-size: 8px;
      letter-spacing: .18em; text-transform: uppercase;
      background: rgba(37,211,102,.1); color: #25D366;
      border: 1px solid rgba(37,211,102,.3); padding: 9px 14px;
      text-decoration: none;
      transition: background .3s, border-color .3s;
      clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
    }
    .btn-partner-wa:hover { background: rgba(37,211,102,.2); border-color: rgba(37,211,102,.55); }
    @media (max-width: 600px) {
      .partners-modal  { padding: 28px 20px; }
      .partners-grid   { grid-template-columns: 1fr; }
    }

    /* ── RESPONSIVE ───────────────────────── */
    @media (max-width: 900px) {
      .categories-grid { gap: 16px; }
      .cat-card { min-width: 240px; min-height: 340px; padding: 32px 28px 28px; }
      .cat-card-label { font-size: 40px; }
      .cat-card-ghost { font-size: 72px; }
    }
    @media (max-width: 768px) {
      nav { padding: 20px 24px; }
      nav.scrolled { padding: 14px 24px; }
      .nav-links { display: none; }
      .hero { padding: 120px 24px 120px; }
      .hero-eyebrow { margin-bottom: 28px; }
      .hero-title { margin-bottom: 36px; }
      .hero-sub { margin-bottom: 44px; }
      .categories-section { padding: 80px 20px 100px; }
      .section-rule { margin-bottom: 52px; }
      .cat-card { min-width: 100%; max-width: 100%; min-height: 300px; }
      .stat-item { padding: 36px 12px; }
      .stat-num { font-size: 40px; }
      .info-bar { flex-wrap: wrap; }
      .stat-item { flex: 1 1 50%; border-bottom: 1px solid rgba(255,255,255,0.06); }
      .footer-strip { gap: 40px; padding: 48px 24px; }
    }
  </style>
</head>
<body>

<!-- PARTICLES -->
<canvas id="particles"></canvas>

<!-- PARALLAX GRADIENT -->
<div id="bg-gradient"></div>

<!-- VIGNETTE -->
<div class="vignette"></div>

<!-- ══ INTRO ════════════════════════════════ -->
<div id="intro">
  <img id="intro-logo" src="assets/images/carthacars.jpg" alt="Cartha Cars" />
  <div id="intro-title" aria-label="CARTHA CARS"></div>
  <p id="intro-sub">L'Excellence Automobile en Tunisie</p>
  <div id="intro-line"></div>
  <span id="intro-skip" role="button" tabindex="0">Passer →</span>
</div>

<!-- ══ MAIN ═════════════════════════════════ -->
<div id="main">

  <!-- NAV -->
  <nav id="mainNav">
    <a class="nav-brand" href="accueil.php">
      <img src="assets/images/carthacars.jpg" alt="Cartha Cars" />
      <span class="nav-brand-name">CARTHA CARS</span>
    </a>
    <ul class="nav-links">
      <li><a href="index.php" data-nav>Modèles</a></li>
      <li><button class="nav-btn" id="navPartners">Configurateur</button></li>
      <li><a href="index.php" data-nav>Showrooms</a></li>
      <li><a href="index.php" class="nav-cta-link" data-nav>Contact</a></li>
    </ul>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <p class="hero-eyebrow">Tunisie · Excellence · Prestige</p>
    <h1 class="hero-title">
      <span>CARTHA</span>
      <span>CARS</span>
    </h1>
    <p class="hero-sub">Des véhicules d'exception pour ceux qui refusent le compromis. Découvrez notre collection exclusive en Tunisie.</p>
    <div class="hero-actions">
      <a class="btn-primary" href="#categories">Découvrir les Modèles</a>
    </div>
    <div class="scroll-hint">
      <div class="scroll-line"></div>
      <span>Explorer</span>
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="categories-section" id="categories">
    <span class="section-eyebrow">Explorer nos collections</span>
    <h2 class="section-heading">NOS UNIVERS</h2>
    <div class="section-rule"></div>

    <div class="categories-grid">

      <a class="cat-card" href="index.php" data-nav>
        <div class="cat-card-top">
          <span class="cat-card-number">01</span>
          <span class="cat-card-label">SUPER<br>CARS</span>
          <span class="cat-card-desc">Performances extrêmes.<br>Adrénaline pure.</span>
          <span class="cat-card-ghost">SC</span>
        </div>
        <div class="cat-card-bottom">
          <span class="cat-card-cta">Découvrir</span>
          <span class="cat-card-line"></span>
          <span class="cat-card-arrow">→</span>
        </div>
      </a>

      <a class="cat-card" href="pages/luxury.php" data-nav>
        <div class="cat-card-top">
          <span class="cat-card-number">02</span>
          <span class="cat-card-label">LUXURY</span>
          <span class="cat-card-desc">Raffinement absolu.<br>Élégance intemporelle.</span>
          <span class="cat-card-ghost">LX</span>
        </div>
        <div class="cat-card-bottom">
          <span class="cat-card-cta">Découvrir</span>
          <span class="cat-card-line"></span>
          <span class="cat-card-arrow">→</span>
        </div>
      </a>

      <a class="cat-card" href="pages/standard.php" data-nav>
        <div class="cat-card-top">
          <span class="cat-card-number">03</span>
          <span class="cat-card-label">STAN<br>DARD</span>
          <span class="cat-card-desc">Excellence quotidienne.<br>Qualité accessible.</span>
          <span class="cat-card-ghost">ST</span>
        </div>
        <div class="cat-card-bottom">
          <span class="cat-card-cta">Découvrir</span>
          <span class="cat-card-line"></span>
          <span class="cat-card-arrow">→</span>
        </div>
      </a>

    </div>
  </section>

  <!-- INFO BAR -->
  <div class="info-bar">
    <div class="stat-item">
      <span class="stat-num">15</span>
      <span class="stat-label">Modèles</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">9</span>
      <span class="stat-label">Showrooms</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">320</span>
      <span class="stat-label">km/h max</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">24/7</span>
      <span class="stat-label">Support</span>
    </div>
  </div>

  <!-- FOOTER STRIP -->
  <div class="footer-strip">
    <div class="footer-item">
      <strong>Siège Tunis</strong>
      Avenue Habib Bourguiba, Tunis 1000
    </div>
    <div class="footer-item">
      <strong>Téléphone</strong>
      +216 99 115 308
    </div>
    <div class="footer-item">
      <strong>Email</strong>
      contact@carthacars.com
    </div>
  </div>

</div><!-- /main -->

<!-- NOS PARTENAIRES MODAL -->
<div class="partners-overlay" id="partnersOverlay">
  <div class="partners-modal">
    <button class="partners-close" id="partnersClose">✕</button>
    <div class="partners-eyebrow">RÉSEAU DE PARTENAIRES</div>
    <div class="partners-title">NOS PARTENAIRES</div>
    <div class="partners-rule"></div>
    <div class="partners-grid">
      <div class="partner-card">
        <div class="partner-name">AutoStyle Tunis</div>
        <div class="partner-spec">Préparation sportive &amp; tuning</div>
        <div class="partner-addr">Tunis Zone Industrielle<br>+216 71 000 001</div>
        <a class="btn-partner-wa" href="https://wa.me/21671000001?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
      </div>
      <div class="partner-card">
        <div class="partner-name">Prestige Custom Sfax</div>
        <div class="partner-spec">Sellerie sur mesure &amp; intérieur luxe</div>
        <div class="partner-addr">Sfax Centre<br>+216 74 000 002</div>
        <a class="btn-partner-wa" href="https://wa.me/21674000002?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
      </div>
      <div class="partner-card">
        <div class="partner-name">TechMotor Sousse</div>
        <div class="partner-spec">Performance &amp; optimisation moteur</div>
        <div class="partner-addr">Sousse Route de Monastir<br>+216 73 000 003</div>
        <a class="btn-partner-wa" href="https://wa.me/21673000003?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
      </div>
      <div class="partner-card">
        <div class="partner-name">Elite Wrap Tunis</div>
        <div class="partner-spec">Covering &amp; wrapping premium</div>
        <div class="partner-addr">Ariana Tunis<br>+216 71 000 004</div>
        <a class="btn-partner-wa" href="https://wa.me/21671000004?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
      </div>
      <div class="partner-card">
        <div class="partner-name">CarSound Pro</div>
        <div class="partner-spec">Audio haute fidélité &amp; électronique</div>
        <div class="partner-addr">La Marsa Tunis<br>+216 71 000 005</div>
        <a class="btn-partner-wa" href="https://wa.me/21671000005?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
      </div>
    </div>
  </div>
</div>

<!-- PAGE TRANSITION -->
<div id="pageTransition"></div>

<script>
/* ── PARTICLES ─────────────────────────────── */
(function () {
  const canvas = document.getElementById('particles');
  const ctx    = canvas.getContext('2d');
  let W, H, particles = [];

  function resize() {
    W = canvas.width  = window.innerWidth;
    H = canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', resize);
  resize();

  const COLORS = ['#C9A84C', '#FF6B35', '#e8c87a', '#d4884a', '#fff8e0'];

  function mkParticle() {
    return {
      x:     Math.random() * W,
      y:     H + Math.random() * 60,
      r:     0.5 + Math.random() * 1.8,
      speed: 0.3 + Math.random() * 0.7,
      drift: (Math.random() - 0.5) * 0.3,
      alpha: 0.15 + Math.random() * 0.55,
      color: COLORS[Math.floor(Math.random() * COLORS.length)],
    };
  }

  for (let i = 0; i < 90; i++) {
    const p = mkParticle();
    p.y = Math.random() * H;
    particles.push(p);
  }

  function draw() {
    ctx.clearRect(0, 0, W, H);
    for (const p of particles) {
      ctx.save();
      ctx.globalAlpha = p.alpha;
      ctx.shadowBlur  = 6;
      ctx.shadowColor = p.color;
      ctx.fillStyle   = p.color;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
      p.y     -= p.speed;
      p.x     += p.drift;
      p.alpha += (Math.random() - 0.5) * 0.01;
      p.alpha  = Math.max(0.05, Math.min(0.75, p.alpha));
      if (p.y < -10) Object.assign(p, mkParticle());
    }
    requestAnimationFrame(draw);
  }
  draw();
})();

/* ── MOUSE PARALLAX ────────────────────────── */
(function () {
  const bg = document.getElementById('bg-gradient');
  let tx = 0, ty = 0, cx = 0, cy = 0;
  window.addEventListener('mousemove', e => {
    tx = (e.clientX / window.innerWidth  - 0.5) * 18;
    ty = (e.clientY / window.innerHeight - 0.5) * 18;
  });
  (function lerp() {
    cx += (tx - cx) * 0.07;
    cy += (ty - cy) * 0.07;
    bg.style.transform = `translate(${cx}px, ${cy}px)`;
    requestAnimationFrame(lerp);
  })();
})();

/* ── INTRO SEQUENCE ────────────────────────── */
(function () {
  const titleEl = document.getElementById('intro-title');
  const introEl = document.getElementById('intro');
  const mainEl  = document.getElementById('main');
  const skipBtn = document.getElementById('intro-skip');
  const navEl   = document.getElementById('mainNav');

  'CARTHA CARS'.split('').forEach((ch, i) => {
    if (ch === ' ') {
      const sp = document.createElement('span');
      sp.className = 'space';
      titleEl.appendChild(sp);
    } else {
      const span = document.createElement('span');
      span.className = 'letter';
      span.textContent = ch;
      span.style.animationDelay = `${1.65 + i * 0.09}s`;
      titleEl.appendChild(span);
    }
  });

  function showMain() {
    introEl.classList.add('fade-out');
    setTimeout(() => {
      mainEl.classList.add('visible');
      document.body.style.overflow = 'auto';
      window.addEventListener('scroll', () => {
        navEl.classList.toggle('scrolled', window.scrollY > 60);
      }, { passive: true });
    }, 400);
  }

  const introTimer = setTimeout(showMain, 5200);
  skipBtn.addEventListener('click', () => { clearTimeout(introTimer); showMain(); });
  skipBtn.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') { clearTimeout(introTimer); showMain(); }
  });
})();

/* ── NOS PARTENAIRES MODAL ─────────────────── */
(function () {
  const ov  = document.getElementById('partnersOverlay');
  const btn = document.getElementById('navPartners');
  const cls = document.getElementById('partnersClose');
  function open()  { ov.classList.add('open');    document.body.style.overflow = 'hidden'; }
  function close() { ov.classList.remove('open'); document.body.style.overflow = ''; }
  btn.addEventListener('click', open);
  cls.addEventListener('click', close);
  ov.addEventListener('click', e => { if (e.target === ov) close(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape' && ov.classList.contains('open')) close(); });
})();

/* ── PAGE TRANSITION ───────────────────────── */
(function () {
  const pt = document.getElementById('pageTransition');
  let navigating = false;
  setTimeout(() => pt.classList.add('pt-out'), 50);
  document.querySelectorAll('[data-nav]').forEach(el => {
    el.addEventListener('click', e => {
      if (navigating) return;
      const href = el.getAttribute('href');
      if (!href || href === '#') return;
      const cur  = window.location.pathname.split('/').pop() || 'accueil.php';
      const dest = href.split('#')[0].split('/').pop();
      if (dest && dest !== cur) {
        navigating = true;
        e.preventDefault();
        pt.classList.remove('pt-out');
        setTimeout(() => { window.location.href = href; }, 500);
      }
    });
  });
})();
</script>
</body>
</html>
