
<?php
require_once '../config/database.php'; // On appelle la connexion

// On prépare la requête pour récupérer uniquement les voitures de luxe disponibles
$stmt = $pdo->prepare("SELECT * FROM cars WHERE category = 'standard' AND availability = 'available'");
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STANDARD CARS — CARTHA CARS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --accent:  #FF6B35;
      --accent2: #FFA040;
      --gold:    #C9A84C;
      --bg:      #08080b;
      --card-bg: #0e0e12;
      --border:  rgba(255,255,255,.07);
      --text-dim: rgba(255,255,255,.55);
    }

    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: #fff;
      font-family: 'Rajdhani', sans-serif;
      overflow-x: hidden;
      padding-bottom: 36px;
    }

    button { cursor: pointer; font-family: inherit; }

    /* ══════════════════ NAV ══════════════════ */
    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 300;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 24px 52px;
      background: transparent;
      transition: background .45s ease, padding .35s ease, border-color .45s ease,
                  backdrop-filter .45s ease;
      border-bottom: 1px solid transparent;
    }
    nav.scrolled {
      background: rgba(8,8,11,.93);
      backdrop-filter: blur(22px);
      -webkit-backdrop-filter: blur(22px);
      border-color: rgba(255,255,255,.06);
      padding: 16px 52px;
    }
    .nav-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-family: 'Bebas Neue', cursive;
      font-size: 22px;
      letter-spacing: .14em;
      color: #fff;
      text-decoration: none;
    }
    .nav-logo img { height: 42px; width: auto; border-radius: 4px; }
    .nav-links { display: flex; gap: 36px; list-style: none; }
    .nav-links a, .nav-links button.nav-btn {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--text-dim);
      text-decoration: none;
      position: relative;
      transition: color .3s;
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
    }
    .nav-links a::after, .nav-links button.nav-btn::after {
      content: '';
      position: absolute;
      bottom: -4px; left: 0; right: 0;
      height: 1px;
      background: var(--accent);
      transform: scaleX(0);
      transition: transform .3s cubic-bezier(.25,.46,.45,.94);
      transform-origin: left;
    }
    .nav-links a:hover, .nav-links button.nav-btn:hover      { color: var(--accent); }
    .nav-links a.active     { color: var(--accent); }
    .nav-links a.active::after,
    .nav-links a:hover::after,
    .nav-links button.nav-btn:hover::after { transform: scaleX(1); }

    /* ══════════════════ HERO ══════════════════ */
    .hero {
      position: relative;
      height: 100vh;
      min-height: 620px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .hero-bg { position: absolute; inset: 0; z-index: 0; }
    .hero-bg img {
      width: 100%; height: 100%;
      object-fit: cover;
      animation: heroZoom 22s ease-in-out infinite alternate;
      will-change: transform;
      user-select: none;
      -webkit-user-drag: none;
    }
    @keyframes heroZoom {
      from { transform: scale(1); }
      to   { transform: scale(1.1); }
    }
    .hero-bg::after {
      content: '';
      position: absolute;
      inset: 0;
      background:
        linear-gradient(to right,  rgba(8,8,11,.72) 0%, rgba(8,8,11,.15) 55%, rgba(8,8,11,.45) 100%),
        linear-gradient(to top,    rgba(8,8,11,.96) 0%, transparent 45%),
        linear-gradient(to bottom, rgba(8,8,11,.60) 0%, transparent 30%);
    }
    .hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 0 24px;
      margin-top: -50px;
    }
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 9px;
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: .28em;
      text-transform: uppercase;
      color: rgba(255,255,255,.55);
      margin-bottom: 22px;
    }
    .hero-badge-dot {
      width: 7px; height: 7px;
      border-radius: 50%;
      background: var(--accent);
      flex-shrink: 0;
      animation: pulseDot 1.6s ease-in-out infinite;
    }
    @keyframes pulseDot {
      0%, 100% { opacity: 1; transform: scale(1); }
      50%       { opacity: .4; transform: scale(.6); }
    }
    .hero-title {
      font-family: 'Bebas Neue', cursive;
      font-size: clamp(82px, 14vw, 185px);
      line-height: .86;
      letter-spacing: .04em;
      margin-bottom: 24px;
    }
    .ht-solid  { display: block; color: #fff; }
    .ht-outline { display: block; color: transparent; -webkit-text-stroke: 2px var(--accent); }
    .hero-subtitle {
      font-family: 'Rajdhani', sans-serif;
      font-size: clamp(14px, 2vw, 18px);
      font-weight: 300;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: rgba(255,255,255,.52);
    }
    .hero-scroll-hint {
      position: absolute;
      bottom: 60px; left: 50%;
      transform: translateX(-50%);
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      animation: hintFloat 2.2s ease-in-out infinite;
      pointer-events: none;
    }
    .hero-scroll-hint span {
      font-family: 'Space Mono', monospace;
      font-size: 8px;
      letter-spacing: .3em;
      text-transform: uppercase;
      color: rgba(255,255,255,.3);
    }
    .hero-scroll-line {
      width: 1px; height: 38px;
      background: linear-gradient(to bottom, rgba(255,107,53,.7), transparent);
    }
    @keyframes hintFloat {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50%       { transform: translateX(-50%) translateY(7px); }
    }

    /* ══════════════════ MODELS SECTION ══════════════════ */
    .models-section { padding: 112px 52px 104px; }
    .section-header { text-align: center; margin-bottom: 72px; }
    .section-tag {
      display: block;
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: .36em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 16px;
    }
    .section-title {
      font-family: 'Bebas Neue', cursive;
      font-size: clamp(32px, 5.5vw, 66px);
      letter-spacing: .07em;
      color: #fff;
      line-height: 1;
    }
    .section-line {
      width: 60px; height: 2px;
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      margin: 20px auto 0;
      border-radius: 1px;
    }

    /* ══════════════════ CARS GRID ══════════════════ */
    .cars-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 28px;
      justify-content: center;
      max-width: 1340px;
      margin: 0 auto;
    }
    .car-card {
      flex: 0 0 calc(33.333% - 19px);
      max-width: calc(33.333% - 19px);
      background: var(--card-bg);
      border: 1px solid var(--border);
      overflow: hidden;
      position: relative;
      transition: transform .4s cubic-bezier(.25,.46,.45,.94), box-shadow .4s ease, border-color .4s ease;
    }
    .car-card:hover {
      transform: translateY(-10px);
      border-color: rgba(255,107,53,.5);
      box-shadow:
        0 0 0 1px rgba(255,107,53,.15),
        0 0 35px rgba(255,107,53,.18),
        0 0 80px rgba(255,107,53,.06),
        0 28px 70px rgba(0,0,0,.85);
    }
    .car-img-wrap { position: relative; height: 250px; overflow: hidden; background: #141018; }
    .car-img-wrap img {
      width: 100%; height: 100%;
      object-fit: cover; object-position: center;
      display: block;
      transition: transform .7s cubic-bezier(.25,.46,.45,.94);
    }
    .car-card:hover .car-img-wrap img { transform: scale(1.07); }
    .car-img-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(14,14,18,1) 0%, rgba(14,14,18,.35) 45%, transparent 100%);
      pointer-events: none;
    }
    .car-tag {
      position: absolute; top: 14px; left: 14px;
      font-family: 'Space Mono', monospace;
      font-size: 7.5px; letter-spacing: .2em; text-transform: uppercase;
      color: #fff; background: rgba(255,107,53,.88); padding: 4px 10px;
      clip-path: polygon(0 0, calc(100% - 5px) 0, 100% 5px, 100% 100%, 5px 100%, 0 calc(100% - 5px));
    }
    .car-body { padding: 22px 22px 20px; }
    .car-name {
      font-family: 'Bebas Neue', cursive; font-size: 22px;
      letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 5px;
    }
    .car-price {
      font-family: 'Space Mono', monospace; font-size: 12px;
      letter-spacing: .07em; color: var(--accent); margin-bottom: 18px;
    }
    .car-specs { display: flex; border: 1px solid rgba(255,255,255,.06); margin-bottom: 18px; }
    .spec-item { flex: 1; padding: 11px 8px; text-align: center; border-right: 1px solid rgba(255,255,255,.06); }
    .spec-item:last-child { border-right: none; }
    .spec-label {
      display: block; font-family: 'Space Mono', monospace; font-size: 7px;
      letter-spacing: .18em; text-transform: uppercase; color: rgba(255,255,255,.28); margin-bottom: 5px;
    }
    .spec-value {
      display: block; font-family: 'Bebas Neue', cursive; font-size: 15px;
      letter-spacing: .04em; color: #fff; line-height: 1;
    }
    .car-actions { display: flex; gap: 8px; flex-wrap: wrap; }
    .btn-buy {
      flex: 1; min-width: 80px;
      font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .18em; text-transform: uppercase;
      background: var(--accent); color: #fff; border: none; padding: 11px 10px;
      transition: background .3s, transform .2s;
      clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
    }
    .btn-buy:hover { background: #ff8a50; transform: translateY(-1px); }
    .btn-cfg-trigger {
      flex: 1; min-width: 80px;
      font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .18em; text-transform: uppercase;
      background: transparent; color: rgba(255,255,255,.6);
      border: 1px solid rgba(255,255,255,.18); padding: 11px 10px;
      transition: border-color .3s, color .3s, transform .2s;
      clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
    }
    .btn-cfg-trigger:hover { border-color: var(--accent); color: var(--accent); transform: translateY(-1px); }
    .btn-test-drive {
      flex: 1; min-width: 80px;
      font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .18em; text-transform: uppercase;
      background: transparent; color: rgba(255,255,255,.55);
      border: 1px solid rgba(255,107,53,.28); padding: 11px 10px;
      transition: border-color .3s, color .3s, background .3s, transform .2s;
      clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
    }
    .btn-test-drive:hover { border-color: var(--accent); color: var(--accent); background: rgba(255,107,53,.07); transform: translateY(-1px); }

    /* ══════════════════ SHOWROOMS ══════════════════ */
    .showrooms-section {
      padding: 96px 52px;
      background: #060608;
      border-top: 1px solid rgba(255,255,255,.05);
    }
    .showrooms-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .showroom-card {
      background: #0e0e12;
      border: 1px solid rgba(255,255,255,.07);
      padding: 26px 24px;
      transition: border-color .35s, box-shadow .35s, transform .3s;
    }
    .showroom-card:hover {
      border-color: rgba(255,107,53,.4);
      box-shadow: 0 0 24px rgba(255,107,53,.12);
      transform: translateY(-4px);
    }
    .showroom-card.main-hq {
      border-color: rgba(255,107,53,.35);
      box-shadow: 0 0 18px rgba(255,107,53,.12);
    }
    .showroom-badge {
      display: inline-block;
      font-family: 'Space Mono', monospace;
      font-size: 7px; letter-spacing: .25em; text-transform: uppercase;
      color: var(--accent); border: 1px solid rgba(255,107,53,.4);
      padding: 3px 10px; margin-bottom: 14px;
    }
    .showroom-badge.hq-badge {
      background: rgba(255,107,53,.08);
    }
    .showroom-name {
      font-family: 'Bebas Neue', cursive;
      font-size: 17px; letter-spacing: .06em;
      color: #fff; margin-bottom: 10px; line-height: 1.1;
    }
    .showroom-addr {
      font-family: 'Rajdhani', sans-serif;
      font-size: 13px; color: rgba(255,255,255,.45);
      margin-bottom: 10px; line-height: 1.5;
    }
    .showroom-phone {
      font-family: 'Space Mono', monospace;
      font-size: 11px; letter-spacing: .07em;
      color: var(--accent);
    }

    /* ══════════════════ FOOTER ══════════════════ */
    footer {
      background: #050507;
      border-top: 1px solid rgba(255,255,255,.05);
      padding: 52px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 24px;
    }
    .footer-logo {
      display: flex; align-items: center; gap: 10px;
      font-family: 'Bebas Neue', cursive; font-size: 20px;
      letter-spacing: .14em; color: #fff;
    }
    .footer-logo img { height: 36px; width: auto; border-radius: 3px; }
    .footer-phone { font-family: 'Space Mono', monospace; font-size: 13px; letter-spacing: .12em; color: var(--accent); }
    .footer-copy {
      font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .14em;
      text-transform: uppercase; color: rgba(255,255,255,.28); text-align: right; line-height: 1.85;
    }

    /* ══════════════════ TICKER ══════════════════ */
    .ticker-bar {
      position: fixed; bottom: 0; left: 0; right: 0;
      z-index: 400; height: 36px;
      background: rgba(0,0,0,.62);
      backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
      border-top: 1px solid rgba(255,255,255,.08);
      display: flex; align-items: center; overflow: hidden;
    }
    .ticker-label {
      flex-shrink: 0; padding: 0 18px;
      font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .28em; text-transform: uppercase;
      color: var(--accent); border-right: 1px solid rgba(255,255,255,.1);
      height: 100%; display: flex; align-items: center;
    }
    .ticker-track {
      flex: 1; overflow: hidden;
      mask-image: linear-gradient(to right, transparent, #000 2%, #000 98%, transparent);
      -webkit-mask-image: linear-gradient(to right, transparent, #000 2%, #000 98%, transparent);
    }
    .ticker-inner { display: flex; white-space: nowrap; animation: tickerScroll 60s linear infinite; }
    .ticker-item {
      font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .18em;
      text-transform: uppercase; color: rgba(255,255,255,.35); padding: 0 28px;
    }
    .ticker-item b { color: var(--accent); font-weight: 400; }
    @keyframes tickerScroll {
      from { transform: translateX(0); }
      to   { transform: translateX(-50%); }
    }

    /* ══════════════════ ACCUEIL BUTTON ══════════════════ */
    .btn-home {
      position: fixed; bottom: 50px; left: 24px; z-index: 390;
      display: inline-flex; align-items: center; gap: 7px;
      font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .2em; text-transform: uppercase;
      color: rgba(255,255,255,.55); background: rgba(8,8,11,.78);
      border: 1px solid rgba(255,255,255,.14); padding: 10px 16px;
      text-decoration: none;
      backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
      transition: color .3s, border-color .3s, background .3s;
      clip-path: polygon(0 0, calc(100% - 7px) 0, 100% 7px, 100% 100%, 7px 100%, 0 calc(100% - 7px));
    }
    .btn-home:hover { color: #fff; border-color: rgba(255,255,255,.4); background: rgba(8,8,11,.92); }

    /* ══════════════════ FADE ANIMATION ══════════════════ */
    .fade-up { opacity: 0; transform: translateY(32px); transition: opacity .8s ease, transform .8s cubic-bezier(.25,.46,.45,.94); }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* ══════════════════ RESPONSIVE ══════════════════ */
    @media (max-width: 1100px) {
      .car-card { flex: 0 0 calc(50% - 14px); max-width: calc(50% - 14px); }
      .showrooms-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
      nav, nav.scrolled      { padding: 16px 20px; }
      .nav-links             { display: none; }
      .models-section        { padding: 80px 18px 80px; }
      .showrooms-section     { padding: 64px 18px; }
      footer                 { padding: 40px 20px; flex-direction: column; align-items: flex-start; gap: 18px; }
      .footer-copy           { text-align: left; }
      .btn-home              { left: 14px; bottom: 44px; }
      .car-card              { flex: 0 0 100%; max-width: 100%; }
      .showrooms-grid        { grid-template-columns: 1fr; }
    }
    @media (max-width: 440px) {
      .hero-title  { font-size: clamp(66px, 18vw, 100px); }
      .car-actions { flex-direction: column; }
    }

    /* ══════════════════ PAGE TRANSITION ══════════════════ */
    #pageTransition {
      position: fixed; inset: 0; z-index: 9999;
      background: #08080b; opacity: 1; pointer-events: all;
      transition: opacity .5s ease;
    }
    #pageTransition.pt-out { opacity: 0; pointer-events: none; }

    /* ══════════════════ MODAL BASE ══════════════════ */
    .modal-overlay {
      position: fixed; inset: 0; z-index: 1000;
      background: rgba(0,0,0,.82);
      backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
      display: flex; align-items: center; justify-content: center;
      padding: 20px; opacity: 0; pointer-events: none;
      transition: opacity .35s ease;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal-box {
      background: #0e0e12;
      border: 1px solid rgba(255,255,255,.1);
      border-left: 2px solid var(--accent);
      width: 100%; max-height: 90vh;
      overflow-y: auto; padding: 36px 40px; position: relative;
      transform: translateY(22px);
      transition: transform .35s cubic-bezier(.25,.46,.45,.94);
    }
    .modal-overlay.open .modal-box { transform: translateY(0); }
    .modal-close-btn {
      position: absolute; top: 16px; right: 16px;
      background: transparent; border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.4); width: 32px; height: 32px;
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; line-height: 1; transition: color .25s, border-color .25s;
    }
    .modal-close-btn:hover { color: #fff; border-color: rgba(255,255,255,.38); }
    .modal-eyebrow {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .32em; text-transform: uppercase;
      color: var(--accent); margin-bottom: 5px;
    }
    .modal-title {
      font-family: 'Bebas Neue', cursive; font-size: 28px;
      letter-spacing: .06em; color: #fff; line-height: 1; margin-bottom: 26px;
    }
    .modal-rule { height: 1px; background: rgba(255,255,255,.07); margin-bottom: 22px; }
    .cfg-section-lbl {
      font-family: 'Space Mono', monospace; font-size: 8.5px;
      letter-spacing: .3em; text-transform: uppercase;
      color: rgba(255,255,255,.33); margin-bottom: 13px;
    }

    /* ══════════════════ BUY MODAL ══════════════════ */
    .buy-modal-box { max-width: 680px; }
    .buy-form-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 14px; margin-top: 22px;
    }
    .cf-full { grid-column: 1 / -1; }
    .cf-label {
      display: block; font-family: 'Space Mono', monospace; font-size: 8px;
      letter-spacing: .28em; text-transform: uppercase;
      color: rgba(255,255,255,.32); margin-bottom: 7px;
    }
    .cf-input, .cf-select-field, .cf-textarea {
      width: 100%; background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.1); color: #fff;
      font-family: 'Rajdhani', sans-serif; font-size: 15px;
      padding: 11px 14px; outline: none;
      transition: border-color .25s, background .25s;
      appearance: none; -webkit-appearance: none;
    }
    .cf-input:focus, .cf-select-field:focus, .cf-textarea:focus {
      border-color: var(--accent); background: rgba(255,107,53,.04);
    }
    .cf-textarea { resize: vertical; min-height: 90px; }
    .cf-select-field { cursor: pointer; }
    .cf-select-field option { background: #111117; }
    .buy-success {
      display: none; text-align: center; padding: 32px 0;
      font-family: 'Rajdhani', sans-serif; font-size: 17px;
      color: var(--accent); letter-spacing: .05em;
    }

    /* Color swatches */
    .color-swatches-row {
      display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 22px;
    }
    .color-swatch-btn {
      display: flex; flex-direction: column; align-items: center; gap: 6px;
      background: none; border: none; cursor: pointer;
    }
    .color-circle {
      width: 36px; height: 36px; border-radius: 50%;
      border: 2px solid transparent;
      outline: 2px solid rgba(255,255,255,.15);
      transition: border-color .25s, outline-color .25s, transform .2s;
    }
    .color-swatch-btn.active .color-circle { border-color: var(--accent); outline-color: var(--accent); }
    .color-swatch-btn:hover .color-circle  { transform: scale(1.1); }
    .color-swatch-label {
      font-family: 'Space Mono', monospace; font-size: 7px;
      letter-spacing: .12em; text-transform: uppercase;
      color: rgba(255,255,255,.4); text-align: center;
    }
    .color-swatch-btn.active .color-swatch-label { color: var(--accent); }

    /* Jantes selectable cards */
    .jante-cards-row {
      display: grid; grid-template-columns: repeat(2, 1fr);
      gap: 10px; margin-bottom: 22px;
    }
    .jante-card {
      background: #111117; border: 1px solid rgba(255,255,255,.07);
      padding: 13px 14px; cursor: pointer;
      transition: border-color .25s, box-shadow .25s, transform .2s;
      text-align: left;
    }
    .jante-card:hover { border-color: rgba(255,107,53,.32); transform: translateY(-2px); }
    .jante-card.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 1px rgba(255,107,53,.35), 0 0 14px rgba(255,107,53,.14);
    }
    .jante-card-name {
      display: block; font-family: 'Bebas Neue', cursive; font-size: 14px;
      letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 3px;
    }
    .jante-card-price {
      display: block; font-family: 'Space Mono', monospace;
      font-size: 8px; letter-spacing: .1em; color: var(--accent);
    }

    .btn-buy-send {
      width: 100%; margin-top: 4px;
      font-family: 'Space Mono', monospace; font-size: 10px;
      letter-spacing: .22em; text-transform: uppercase;
      background: var(--accent); color: #fff; border: none; padding: 15px;
      transition: background .3s;
      clip-path: polygon(0 0, calc(100% - 9px) 0, 100% 9px, 100% 100%, 9px 100%, 0 calc(100% - 9px));
    }
    .btn-buy-send:hover { background: #ff8a50; }

    /* ══════════════════ CONFIGURATOR MODAL ══════════════════ */
    .cfg-modal-box { max-width: 780px; }
    .cfg-select-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 22px; }
    .cfg-select {
      width: 100%; background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.1); color: #fff;
      font-family: 'Rajdhani', sans-serif; font-size: 14px;
      padding: 10px 13px; outline: none; cursor: pointer;
      appearance: none; -webkit-appearance: none;
      transition: border-color .25s;
    }
    .cfg-select:focus { border-color: var(--accent); }
    .cfg-select option { background: #111117; }
    .int-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 10px; margin-bottom: 26px;
    }
    .int-card {
      background: #111117; border: 1px solid rgba(255,255,255,.07);
      padding: 0; cursor: pointer; text-align: left; overflow: hidden; width: 100%;
      transition: border-color .25s, box-shadow .25s, transform .2s;
    }
    .int-card:hover  { border-color: rgba(255,107,53,.32); transform: translateY(-2px); }
    .int-card.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 1px rgba(255,107,53,.35), 0 0 16px rgba(255,107,53,.14);
    }
    .int-swatch { display: block; height: 50px; width: 100%; }
    .int-body { padding: 10px 13px 13px; }
    .int-name {
      display: block; font-family: 'Bebas Neue', cursive; font-size: 14px;
      letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 4px;
    }
    .int-desc {
      display: block; font-family: 'Rajdhani', sans-serif; font-size: 11px;
      color: rgba(255,255,255,.33); line-height: 1.4; margin-bottom: 7px;
    }
    .int-price-tag {
      display: block; font-family: 'Space Mono', monospace;
      font-size: 8.5px; letter-spacing: .06em; color: var(--accent);
    }
    .cfg-devis {
      background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.06);
      padding: 16px 18px; margin-bottom: 20px;
    }
    .dv-row { display: flex; justify-content: space-between; align-items: baseline; padding: 3px 0; }
    .dv-lbl {
      font-family: 'Space Mono', monospace; font-size: 8px;
      letter-spacing: .18em; text-transform: uppercase; color: rgba(255,255,255,.3);
    }
    .dv-val { font-family: 'Rajdhani', sans-serif; font-size: 14px; font-weight: 600; color: rgba(255,255,255,.68); }
    .dv-sep { height: 1px; background: rgba(255,255,255,.06); margin: 8px 0; }
    .dv-total-lbl {
      font-family: 'Space Mono', monospace; font-size: 8.5px;
      letter-spacing: .25em; text-transform: uppercase; color: var(--accent);
    }
    .dv-total-val { font-family: 'Bebas Neue', cursive; font-size: 22px; letter-spacing: .05em; color: var(--accent); }
    .cfg-footer { display: flex; gap: 11px; }
    .btn-cfg-ok {
      flex: 1; font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .2em; text-transform: uppercase;
      background: var(--accent); color: #fff; border: none; padding: 13px;
      transition: background .3s;
      clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    }
    .btn-cfg-ok:hover { background: #ff8a50; }
    .btn-cfg-cancel {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .2em; text-transform: uppercase;
      background: transparent; color: rgba(255,255,255,.38);
      border: 1px solid rgba(255,255,255,.13); padding: 13px 18px;
      transition: color .3s, border-color .3s;
      clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    }
    .btn-cfg-cancel:hover { color: #fff; border-color: rgba(255,255,255,.33); }

    /* ══════════════════ ESSAI ROUTIER MODAL ══════════════════ */
    .td-modal-box { max-width: 600px; }
    .td-form-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 14px; margin-top: 22px;
    }
    .td-success {
      display: none; text-align: center; padding: 32px 0;
      font-family: 'Rajdhani', sans-serif; font-size: 16px;
      color: var(--accent); letter-spacing: .04em; line-height: 1.7;
    }
    .btn-td-confirm {
      width: 100%; margin-top: 4px;
      font-family: 'Space Mono', monospace; font-size: 10px;
      letter-spacing: .22em; text-transform: uppercase;
      background: var(--accent); color: #fff; border: none; padding: 15px;
      transition: background .3s;
      clip-path: polygon(0 0, calc(100% - 9px) 0, 100% 9px, 100% 100%, 9px 100%, 0 calc(100% - 9px));
    }
    .btn-td-confirm:hover { background: #ff8a50; }

    /* ══════════════════ NOS PARTENAIRES MODAL ══════════════════ */
    .partners-modal-box { max-width: 780px; }
    .partners-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 16px; margin-top: 22px;
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
      font-family: 'Bebas Neue', cursive; font-size: 17px;
      letter-spacing: .06em; color: #fff; margin-bottom: 5px; line-height: 1.1;
    }
    .partner-spec {
      font-family: 'Rajdhani', sans-serif; font-size: 13px;
      color: var(--accent); margin-bottom: 8px; font-weight: 500;
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

    /* ══════════════════ CONTACT SECTION ══════════════════ */
    .contact-section {
      background: #060608;
      border-top: 1px solid rgba(255,255,255,.06);
      padding: 100px 52px;
    }
    .contact-inner { max-width: 1100px; margin: 0 auto; }
    .contact-header { text-align: center; margin-bottom: 64px; }
    .contact-grid {
      display: grid; grid-template-columns: 1fr 1.6fr;
      gap: 56px; align-items: start;
    }
    .contact-info-item { display: flex; flex-direction: column; gap: 4px; margin-bottom: 28px; }
    .ci-label {
      font-family: 'Space Mono', monospace; font-size: 8px;
      letter-spacing: .3em; text-transform: uppercase; color: var(--accent);
    }
    .ci-value {
      font-family: 'Rajdhani', sans-serif; font-size: 16px;
      font-weight: 500; color: rgba(255,255,255,.78); line-height: 1.45;
    }
    .contact-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .btn-contact-send {
      margin-top: 4px; width: 100%;
      font-family: 'Space Mono', monospace; font-size: 10px;
      letter-spacing: .22em; text-transform: uppercase;
      background: var(--accent); color: #fff; border: none; padding: 15px;
      transition: background .3s;
      clip-path: polygon(0 0, calc(100% - 9px) 0, 100% 9px, 100% 100%, 9px 100%, 0 calc(100% - 9px));
    }
    .btn-contact-send:hover { background: #ff8a50; }
    .contact-success {
      display: none; text-align: center; padding: 32px 0;
      font-family: 'Rajdhani', sans-serif; font-size: 17px;
      color: var(--accent); letter-spacing: .05em;
    }
    @media (max-width: 900px) {
      .contact-grid   { grid-template-columns: 1fr; gap: 36px; }
      .contact-section { padding: 72px 24px; }
      .partners-grid  { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
      .modal-box { padding: 28px 20px; }
      .cfg-select-row, .td-form-grid { grid-template-columns: 1fr; }
      .int-grid { grid-template-columns: 1fr 1fr; }
      .contact-form-grid { grid-template-columns: 1fr; }
      .jante-cards-row { grid-template-columns: 1fr; }
    }
    @media (max-width: 380px) { .int-grid { grid-template-columns: 1fr; } }

    /* ══════════════════ BUY WIZARD ══════════════════ */
    .buy-wiz-overlay {
      position: fixed; inset: 0; z-index: 1200;
      background: #0a0a0a;
      display: flex; flex-direction: column;
      opacity: 0; pointer-events: none;
      transition: opacity .4s ease;
      overflow: hidden;
    }
    .buy-wiz-overlay.open { opacity: 1; pointer-events: all; }
    .wiz-prog-track {
      position: absolute; top: 0; left: 0; right: 0;
      height: 3px; background: rgba(255,255,255,.08); z-index: 2;
    }
    .wiz-prog-fill {
      height: 100%; background: var(--accent); width: 0%;
      transition: width .5s cubic-bezier(.25,.46,.45,.94);
    }
    .wiz-close {
      position: absolute; top: 18px; right: 20px; z-index: 10;
      width: 36px; height: 36px;
      background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.5); font-size: 14px; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: color .2s, border-color .2s;
    }
    .wiz-close:hover { color: #fff; border-color: rgba(255,255,255,.35); }
    .wiz-steps-row {
      display: flex; align-items: flex-start; justify-content: center;
      padding: 26px 64px 16px; border-bottom: 1px solid rgba(255,255,255,.06);
      flex-shrink: 0;
    }
    .wiz-step {
      display: flex; flex-direction: column; align-items: center;
      flex: 1; max-width: 90px; position: relative;
    }
    .wiz-step + .wiz-step::before {
      content: ''; position: absolute; top: 12px;
      left: calc(-50% + 13px); right: calc(50% + 13px);
      height: 1px; background: rgba(255,255,255,.1);
    }
    .wiz-step-dot {
      width: 26px; height: 26px; border-radius: 50%;
      background: #161620; border: 1.5px solid rgba(255,255,255,.16);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Space Mono', monospace; font-size: 9px; color: rgba(255,255,255,.28);
      position: relative; z-index: 1; transition: all .3s ease; margin-bottom: 6px;
    }
    .wiz-step.active .wiz-step-dot { border-color: var(--accent); color: var(--accent); box-shadow: 0 0 10px rgba(255,107,53,.3); }
    .wiz-step.done   .wiz-step-dot { background: var(--accent); border-color: var(--accent); color: #fff; }
    .wiz-step-lbl {
      font-family: 'Space Mono', monospace; font-size: 6px;
      letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.2); text-align: center;
      transition: color .3s;
    }
    .wiz-step.active .wiz-step-lbl { color: var(--accent); }
    .wiz-step.done   .wiz-step-lbl { color: rgba(255,255,255,.45); }
    .wiz-body {
      flex: 1; overflow-y: auto; padding: 36px 52px; scroll-behavior: smooth;
    }
    .wiz-nav {
      display: flex; align-items: center; gap: 12px;
      padding: 18px 52px; border-top: 1px solid rgba(255,255,255,.06);
      background: rgba(0,0,0,.5); flex-shrink: 0;
    }
    .wiz-btn-prev {
      font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .18em; text-transform: uppercase;
      background: transparent; color: rgba(255,255,255,.4);
      border: 1px solid rgba(255,255,255,.12); padding: 12px 18px; cursor: pointer;
      transition: color .25s, border-color .25s;
      clip-path: polygon(0 0,calc(100% - 6px) 0,100% 6px,100% 100%,6px 100%,0 calc(100% - 6px));
    }
    .wiz-btn-prev:hover { color: #fff; border-color: rgba(255,255,255,.33); }
    .wiz-btn-next {
      flex: 1; font-family: 'Space Mono', monospace; font-size: 10px; letter-spacing: .2em; text-transform: uppercase;
      background: var(--accent); color: #fff; border: none; padding: 14px; cursor: pointer;
      transition: filter .25s, transform .2s;
      clip-path: polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));
    }
    .wiz-btn-next:hover { filter: brightness(1.18); transform: translateY(-1px); }
    .wiz-step-header { margin-bottom: 30px; }
    .wiz-step-eyebrow { font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .3em; text-transform: uppercase; color: var(--accent); margin-bottom: 6px; }
    .wiz-step-title { font-family: 'Bebas Neue', cursive; font-size: clamp(30px, 5vw, 50px); letter-spacing: .06em; color: #fff; line-height: 1; }
    .wiz-step-sub { font-family: 'Rajdhani', sans-serif; font-size: 14px; color: rgba(255,255,255,.35); margin-top: 7px; }
    .wiz-car-display { overflow: hidden; background: #111117; border: 1px solid rgba(255,255,255,.06); max-width: 760px; }
    .wiz-car-img { width: 100%; height: 320px; object-fit: cover; display: block; filter: brightness(.88); }
    .wiz-car-info { padding: 20px 26px; background: #0e0e14; }
    .wiz-car-name-big { font-family: 'Bebas Neue', cursive; font-size: clamp(26px, 4vw, 42px); letter-spacing: .06em; color: #fff; line-height: 1; }
    .wiz-car-price-big { font-family: 'Space Mono', monospace; font-size: 15px; letter-spacing: .08em; color: var(--accent); margin-top: 6px; }
    .wiz-colors-grid { display: flex; flex-wrap: wrap; gap: 16px; }
    .wiz-color-btn { display: flex; flex-direction: column; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; padding: 6px; transition: transform .2s; }
    .wiz-color-btn:hover { transform: translateY(-2px); }
    .wiz-color-circle { width: 52px; height: 52px; border-radius: 50%; border: 2.5px solid transparent; outline: 2px solid rgba(255,255,255,.1); transition: border-color .25s, outline-color .25s, box-shadow .25s; }
    .wiz-color-btn.active .wiz-color-circle { border-color: var(--accent); outline-color: var(--accent); box-shadow: 0 0 14px rgba(255,107,53,.4); }
    .wiz-color-name { font-family: 'Space Mono', monospace; font-size: 7px; letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.38); text-align: center; }
    .wiz-color-btn.active .wiz-color-name { color: var(--accent); }
    .wiz-option-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(185px, 1fr)); gap: 12px; }
    .wiz-opt-card { background: #111117; border: 1px solid rgba(255,255,255,.07); padding: 18px 16px; cursor: pointer; text-align: left; position: relative; transition: border-color .25s, box-shadow .25s, transform .2s; }
    .wiz-opt-card:hover { border-color: rgba(255,107,53,.32); transform: translateY(-2px); }
    .wiz-opt-card.active { border-color: var(--accent); box-shadow: 0 0 0 1px rgba(255,107,53,.28), 0 0 18px rgba(255,107,53,.14); }
    .wiz-opt-card-check { display: none; position: absolute; top: 10px; right: 10px; color: var(--accent); font-size: 13px; font-weight: 700; }
    .wiz-opt-card.active .wiz-opt-card-check { display: block; }
    .wiz-opt-name { font-family: 'Bebas Neue', cursive; font-size: 17px; letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 6px; }
    .wiz-opt-price { font-family: 'Space Mono', monospace; font-size: 8.5px; letter-spacing: .07em; color: var(--accent); }
    .wiz-section-lbl { font-family: 'Space Mono', monospace; font-size: 8.5px; letter-spacing: .3em; text-transform: uppercase; color: rgba(255,255,255,.28); margin-bottom: 14px; margin-top: 28px; }
    .wiz-check-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .wiz-check-item { display: flex; align-items: center; gap: 12px; background: #111117; border: 1px solid rgba(255,255,255,.07); padding: 12px 14px; cursor: pointer; transition: border-color .25s, background .25s; }
    .wiz-check-item.checked { border-color: var(--accent); background: rgba(255,107,53,.05); }
    .wiz-checkbox { width: 15px; height: 15px; flex-shrink: 0; border: 1.5px solid rgba(255,255,255,.22); background: transparent; display: flex; align-items: center; justify-content: center; transition: border-color .25s, background .25s; }
    .wiz-check-item.checked .wiz-checkbox { border-color: var(--accent); background: var(--accent); }
    .wiz-checkbox-tick { color: #fff; font-size: 9px; display: none; }
    .wiz-check-item.checked .wiz-checkbox-tick { display: block; }
    .wiz-check-name { font-family: 'Rajdhani', sans-serif; font-size: 13px; font-weight: 500; color: #fff; }
    .wiz-check-price { font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .07em; color: var(--accent); }
    .wiz-summary-box { background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.07); padding: 22px 24px; margin-bottom: 28px; }
    .wiz-sum-rows { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 20px; margin-bottom: 14px; }
    .wiz-sum-row { display: flex; flex-direction: column; gap: 3px; }
    .wiz-sum-lbl { font-family: 'Space Mono', monospace; font-size: 7.5px; letter-spacing: .22em; text-transform: uppercase; color: rgba(255,255,255,.27); }
    .wiz-sum-val { font-family: 'Rajdhani', sans-serif; font-size: 15px; font-weight: 500; color: rgba(255,255,255,.8); }
    .wiz-sum-sep { height: 1px; background: rgba(255,255,255,.06); margin: 4px 0 12px; }
    .wiz-sum-extras { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .wiz-sum-extra-row { display: flex; justify-content: space-between; }
    .wiz-sum-extra-lbl { font-family: 'Space Mono', monospace; font-size: 7.5px; letter-spacing: .15em; color: rgba(255,255,255,.32); }
    .wiz-sum-extra-val { font-family: 'Rajdhani', sans-serif; font-size: 13px; font-weight: 500; color: rgba(255,255,255,.6); }
    .wiz-total-row { display: flex; justify-content: space-between; align-items: baseline; border-top: 1px solid rgba(255,255,255,.08); padding-top: 14px; }
    .wiz-total-lbl { font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .3em; text-transform: uppercase; color: var(--accent); }
    .wiz-total-val { font-family: 'Bebas Neue', cursive; font-size: 32px; letter-spacing: .05em; color: var(--accent); }
    .wiz-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .wiz-full { grid-column: 1 / -1; }
    .wiz-lbl { display: block; font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .28em; text-transform: uppercase; color: rgba(255,255,255,.3); margin-bottom: 7px; }
    .wiz-input, .wiz-textarea { width: 100%; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); color: #fff; font-family: 'Rajdhani', sans-serif; font-size: 15px; padding: 11px 14px; outline: none; transition: border-color .25s, background .25s; appearance: none; -webkit-appearance: none; }
    .wiz-input:focus, .wiz-textarea:focus { border-color: var(--accent); background: rgba(255,107,53,.04); }
    .wiz-textarea { resize: vertical; min-height: 80px; }
    .wiz-final-btns { display: flex; gap: 11px; margin-top: 16px; }
    .wiz-btn-devis { flex: 1; font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .18em; text-transform: uppercase; background: transparent; color: rgba(255,255,255,.55); border: 1px solid rgba(255,255,255,.18); padding: 13px; cursor: pointer; transition: color .25s, border-color .25s; clip-path: polygon(0 0,calc(100% - 7px) 0,100% 7px,100% 100%,7px 100%,0 calc(100% - 7px)); }
    .wiz-btn-devis:hover { color: #fff; border-color: rgba(255,255,255,.4); }
    .wiz-btn-confirm-buy { flex: 2; font-family: 'Space Mono', monospace; font-size: 10px; letter-spacing: .18em; text-transform: uppercase; background: var(--accent); color: #fff; border: none; padding: 13px; cursor: pointer; transition: filter .25s; clip-path: polygon(0 0,calc(100% - 7px) 0,100% 7px,100% 100%,7px 100%,0 calc(100% - 7px)); }
    .wiz-btn-confirm-buy:hover { filter: brightness(1.18); }
    .wiz-success-msg { display: none; text-align: center; padding: 40px 20px; }
    .wiz-success-check { font-size: 50px; color: var(--accent); margin-bottom: 14px; }
    .wiz-success-title { font-family: 'Bebas Neue', cursive; font-size: 36px; letter-spacing: .06em; color: #fff; margin-bottom: 10px; }
    .wiz-success-sub { font-family: 'Rajdhani', sans-serif; font-size: 16px; color: rgba(255,255,255,.45); letter-spacing: .04em; line-height: 1.7; }
    @media (max-width: 768px) {
      .wiz-body  { padding: 22px 18px; }
      .wiz-nav   { padding: 14px 18px; }
      .wiz-steps-row { padding: 18px 8px 12px; }
      .wiz-step-lbl  { font-size: 5px; }
      .wiz-option-cards  { grid-template-columns: 1fr 1fr; }
      .wiz-check-grid    { grid-template-columns: 1fr; }
      .wiz-form-grid     { grid-template-columns: 1fr; }
      .wiz-sum-rows      { grid-template-columns: 1fr; }
    }
    @media (max-width: 440px) {
      .wiz-option-cards  { grid-template-columns: 1fr; }
      .wiz-final-btns    { flex-direction: column; }
      .wiz-step + .wiz-step::before { display: none; }
    }
  </style>
</head>
<body>

  <!-- ══ NAV ══════════════════════════════════════════ -->
  <nav id="mainNav">
    <a class="nav-logo" href="../accueil.php">
      <img src="../assets/images/carthacars.jpg" alt="CARTHA CARS">
      CARTHA CARS
    </a>
    <ul class="nav-links">
      <li><a href="../index.php" data-nav>SUPERCARS</a></li>
      <li><a href="luxury.php" data-nav>LUXURY</a></li>
      <li><a href="standard.php" class="active" data-nav>STANDARD</a></li>
      <li><button class="nav-btn" id="navPartners">CONFIGURATEUR</button></li>
      <li><a href="#contact">CONTACT</a></li>
    </ul>
  </nav>

  <!-- ══ HERO ══════════════════════════════════════════ -->
  <section class="hero">
    <div class="hero-bg">
      <img src="https://images.unsplash.com/photo-1700519661966-c5af49bef4b3?w=1400&q=80" alt="Standard Cars">
    </div>
    <div class="hero-content">
      <div class="hero-badge">
        <div class="hero-badge-dot"></div>
        Collection 2025
      </div>
      <h1 class="hero-title">
        <span class="ht-solid">STANDARD</span>
        <span class="ht-outline">CARS</span>
      </h1>
      <p class="hero-subtitle">L'Excellence au Quotidien</p>
    </div>
    <div class="hero-scroll-hint">
      <span>Découvrir</span>
      <div class="hero-scroll-line"></div>
    </div>
  </section>

  <!-- ══ MODELS ════════════════════════════════════════ -->
  <section class="models-section">
    <div class="section-header fade-up">
      <span class="section-tag">Collection Standard</span>
      <h2 class="section-title">CHOISISSEZ VOTRE VÉHICULE</h2>
      <div class="section-line"></div>
    </div>
    <div class="cars-grid">

      <!-- 1 · Volkswagen Tiguan -->
      <div class="car-card fade-up">
        <div class="car-img-wrap">
          <img src="https://images.unsplash.com/photo-1655286161233-7aa3a3e39e8a?w=800&q=80" alt="Volkswagen Tiguan" loading="lazy">
          <div class="car-img-overlay"></div>
          <div class="car-tag">SUV Familial</div>
        </div>
        <div class="car-body">
          <div class="car-name">Volkswagen Tiguan</div>
          <div class="car-price">145 000 DT</div>
          <div class="car-specs">
            <div class="spec-item"><span class="spec-label">Puissance</span><span class="spec-value">150 CH</span></div>
            <div class="spec-item"><span class="spec-label">Places</span><span class="spec-value">5</span></div>
            <div class="spec-item"><span class="spec-label">Trans.</span><span class="spec-value">DSG 7R</span></div>
          </div>
          <div class="car-actions">
            <button class="btn-buy">ACHETER</button>            <button class="btn-test-drive">ESSAI</button>
          </div>
        </div>
      </div>

      <!-- 2 · Skoda Superb -->
      <div class="car-card fade-up">
        <div class="car-img-wrap">
          <img src="https://images.unsplash.com/photo-1687901882211-40f91b8957b1?w=800&q=80" alt="Skoda Superb" loading="lazy">
          <div class="car-img-overlay"></div>
          <div class="car-tag">Berline Premium</div>
        </div>
        <div class="car-body">
          <div class="car-name">Skoda Superb</div>
          <div class="car-price">125 000 DT</div>
          <div class="car-specs">
            <div class="spec-item"><span class="spec-label">Puissance</span><span class="spec-value">190 CH</span></div>
            <div class="spec-item"><span class="spec-label">Places</span><span class="spec-value">5</span></div>
            <div class="spec-item"><span class="spec-label">Trans.</span><span class="spec-value">DSG 7R</span></div>
          </div>
          <div class="car-actions">
            <button class="btn-buy">ACHETER</button>            <button class="btn-test-drive">ESSAI</button>
          </div>
        </div>
      </div>

      <!-- 3 · Mercedes CLA 200 -->
      <div class="car-card fade-up">
        <div class="car-img-wrap">
          <img src="https://images.unsplash.com/photo-1652549423957-d9c4445ee9bf?w=800&q=80" alt="Mercedes CLA 200" loading="lazy">
          <div class="car-img-overlay"></div>
          <div class="car-tag">Coupé 4 Portes</div>
        </div>
        <div class="car-body">
          <div class="car-name">Mercedes CLA 200</div>
          <div class="car-price">175 000 DT</div>
          <div class="car-specs">
            <div class="spec-item"><span class="spec-label">Puissance</span><span class="spec-value">163 CH</span></div>
            <div class="spec-item"><span class="spec-label">Places</span><span class="spec-value">5</span></div>
            <div class="spec-item"><span class="spec-label">Trans.</span><span class="spec-value">DCT 7R</span></div>
          </div>
          <div class="car-actions">
            <button class="btn-buy">ACHETER</button>            <button class="btn-test-drive">ESSAI</button>
          </div>
        </div>
      </div>

      <!-- 4 · Golf 8 GTI -->
      <div class="car-card fade-up">
        <div class="car-img-wrap">
          <img src="https://images.unsplash.com/photo-1655286655831-eec6743fcc69?w=800&q=80" alt="Golf 8 GTI" loading="lazy">
          <div class="car-img-overlay"></div>
          <div class="car-tag">Hot Hatch</div>
        </div>
        <div class="car-body">
          <div class="car-name">Golf 8 GTI</div>
          <div class="car-price">165 000 DT</div>
          <div class="car-specs">
            <div class="spec-item"><span class="spec-label">Puissance</span><span class="spec-value">245 CH</span></div>
            <div class="spec-item"><span class="spec-label">Places</span><span class="spec-value">5</span></div>
            <div class="spec-item"><span class="spec-label">Trans.</span><span class="spec-value">DSG 7R</span></div>
          </div>
          <div class="car-actions">
            <button class="btn-buy">ACHETER</button>            <button class="btn-test-drive">ESSAI</button>
          </div>
        </div>
      </div>

      <!-- 5 · Cupra Formentor -->
      <div class="car-card fade-up">
        <div class="car-img-wrap">
          <img src="https://images.unsplash.com/photo-1655288718876-6bc36152fd23?w=800&q=80" alt="Cupra Formentor" loading="lazy">
          <div class="car-img-overlay"></div>
          <div class="car-tag">SUV Sport</div>
        </div>
        <div class="car-body">
          <div class="car-name">Cupra Formentor</div>
          <div class="car-price">135 000 DT</div>
          <div class="car-specs">
            <div class="spec-item"><span class="spec-label">Puissance</span><span class="spec-value">310 CH</span></div>
            <div class="spec-item"><span class="spec-label">Places</span><span class="spec-value">5</span></div>
            <div class="spec-item"><span class="spec-label">Trans.</span><span class="spec-value">DSG 7R</span></div>
          </div>
          <div class="car-actions">
            <button class="btn-buy">ACHETER</button>            <button class="btn-test-drive">ESSAI</button>
          </div>
        </div>
      </div>

    </div><!-- /cars-grid -->
  </section>

  <!-- ══ SHOWROOMS ═════════════════════════════════════ -->
  <section class="showrooms-section">
    <div class="section-header fade-up" style="margin-bottom:52px">
      <span class="section-tag">Nos Agences</span>
      <h2 class="section-title">NOS SHOWROOMS EN TUNISIE</h2>
      <div class="section-line"></div>
    </div>
    <div class="showrooms-grid">
      <div class="showroom-card main-hq fade-up">
        <div class="showroom-badge hq-badge">SIÈGE PRINCIPAL</div>
        <div class="showroom-name">CARTHA CARS TUNIS</div>
        <div class="showroom-addr">Ave Habib Bourguiba<br>Tunis 1000</div>
        <div class="showroom-phone">+216 99 115 308</div>
      </div>
      <div class="showroom-card fade-up">
        <div class="showroom-badge">SHOWROOM</div>
        <div class="showroom-name">CARTHA CARS SFAX</div>
        <div class="showroom-addr">Ave Farhat Hached<br>Sfax 3000</div>
        <div class="showroom-phone">+216 99 115 308</div>
      </div>
      <div class="showroom-card fade-up">
        <div class="showroom-badge">SHOWROOM</div>
        <div class="showroom-name">CARTHA CARS SOUSSE</div>
        <div class="showroom-addr">Ave Mohamed V<br>Sousse 4000</div>
        <div class="showroom-phone">+216 99 115 308</div>
      </div>
      <div class="showroom-card fade-up">
        <div class="showroom-badge">SHOWROOM</div>
        <div class="showroom-name">CARTHA CARS MONASTIR</div>
        <div class="showroom-addr">Ave de l'Indépendance<br>Monastir 5000</div>
        <div class="showroom-phone">+216 99 115 308</div>
      </div>
      <div class="showroom-card fade-up">
        <div class="showroom-badge">SHOWROOM</div>
        <div class="showroom-name">CARTHA CARS NABEUL</div>
        <div class="showroom-addr">Ave Habib Thameur<br>Nabeul 8000</div>
        <div class="showroom-phone">+216 99 115 308</div>
      </div>
      <div class="showroom-card fade-up">
        <div class="showroom-badge">SHOWROOM</div>
        <div class="showroom-name">CARTHA CARS BIZERTE</div>
        <div class="showroom-addr">Ave du 7 Novembre<br>Bizerte 7000</div>
        <div class="showroom-phone">+216 99 115 308</div>
      </div>
    </div>
  </section>

  <!-- ══ CONTACT ══════════════════════════════════════ -->
  <section class="contact-section" id="contact">
    <div class="contact-inner">
      <div class="contact-header fade-up">
        <span class="section-tag">Nous Joindre</span>
        <h2 class="section-title">CONTACTEZ-NOUS</h2>
        <div class="section-line"></div>
      </div>
      <div class="contact-grid">
        <div class="contact-info">
          <div class="contact-info-item">
            <span class="ci-label">Téléphone</span>
            <span class="ci-value">+216 99 115 308</span>
          </div>
          <div class="contact-info-item">
            <span class="ci-label">Email</span>
            <span class="ci-value">contact@carthacars.com</span>
          </div>
          <div class="contact-info-item">
            <span class="ci-label">Adresse</span>
            <span class="ci-value">Avenue Habib Bourguiba<br>Tunis 1000, Tunisie</span>
          </div>
        </div>
        <div>
          <div class="contact-success" id="contactSuccess">Votre demande a été envoyée. Notre équipe vous contactera sous 24h.</div>
          <form class="contact-form-grid" id="contactForm" action="contact_process.php" method="POST" onsubmit="submitContact(event)">
            <div>
              <label class="cf-label">Nom</label>
              <input class="cf-input" type="text" name="nom" required placeholder="Votre nom">
            </div>
            <div>
              <label class="cf-label">Prénom</label>
              <input class="cf-input" type="text" name="prenom" required placeholder="Votre prénom">
            </div>
            <div>
              <label class="cf-label">Téléphone</label>
              <input class="cf-input" type="tel" name="telephone" placeholder="+216 XX XXX XXX">
            </div>
            <div>
              <label class="cf-label">Email</label>
              <input class="cf-input" type="email" name="email" required placeholder="votre@email.com">
            </div>
            <div class="cf-full">
              <label class="cf-label">Voiture souhaitée</label>
              <select class="cf-select-field" name="voiture">
                <option value="">Sélectionnez un modèle</option>
                <option>Volkswagen Tiguan</option>
                <option>Skoda Superb</option>
                <option>Mercedes CLA 200</option>
                <option>Golf 8 GTI</option>
                <option>Cupra Formentor</option>
                <option>Autre</option>
              </select>
            </div>
            <div class="cf-full">
              <label class="cf-label">Message</label>
              <textarea class="cf-textarea" name="message" required placeholder="Votre message..."></textarea>
            </div>
            <div class="cf-full">
              <button type="submit" class="btn-contact-send">ENVOYER MA DEMANDE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ FOOTER ════════════════════════════════════════ -->
  <footer>
    <div class="footer-logo">
      <img src="../assets/images/carthacars.jpg" alt="CARTHA CARS">
      CARTHA CARS
    </div>
    <div class="footer-phone">+216 99 115 308</div>
    <div class="footer-copy">© 2025 CARTHA CARS<br>Tunis, Tunisie</div>
  </footer>

  <!-- ══ TICKER ═══════════════════════════════════════ -->
  <div class="ticker-bar">
    <div class="ticker-label">STANDARD</div>
    <div class="ticker-track">
      <div class="ticker-inner" id="tickerInner"></div>
    </div>
  </div>

  <!-- ══ FIXED: ACCUEIL BUTTON ════════════════════════ -->
  <a href="../accueil.php" class="btn-home" data-nav>← ACCUEIL</a>

  <!-- ══ PAGE TRANSITION ══════════════════════════════ -->
  <div id="pageTransition"></div>

  <!-- ══════════════════════════════════════════════════
       MODALS
  ═══════════════════════════════════════════════════ -->

  <!-- BUY WIZARD MODAL -->
  <div class="buy-wiz-overlay" id="buyOverlay">
    <div class="wiz-prog-track"><div class="wiz-prog-fill" id="buyProgFill"></div></div>
    <button class="wiz-close" id="buyCloseBtn" aria-label="Fermer">✕</button>
    <div class="wiz-steps-row" id="buyStepsRow"></div>
    <div class="wiz-body" id="buyWizBody"></div>
    <div class="wiz-nav">
      <button class="wiz-btn-prev" id="buyPrev">← PRÉCÉDENT</button>
      <button class="wiz-btn-next" id="buyNext">SUIVANT →</button>
    </div>
  </div>

  <!-- CONFIGURATOR MODAL -->
  <div class="modal-overlay" id="cfgOverlay">
    <div class="modal-box cfg-modal-box">
      <button class="modal-close-btn" id="cfgCloseBtn" aria-label="Fermer">✕</button>
      <div class="modal-eyebrow">CONFIGURATEUR</div>
      <div class="modal-title" id="cfgCarTitle"></div>
      <div class="modal-rule"></div>
      <div class="cfg-select-row">
        <div>
          <div class="cfg-section-lbl">COULEUR EXTÉRIEURE</div>
          <select class="cfg-select" id="selExt">
            <option value="0">Blanc Nacré</option>
            <option value="0">Noir Brillant</option>
            <option value="1500">Gris Métallisé (+1 500 DT)</option>
            <option value="2500">Bleu Atlantique (+2 500 DT)</option>
            <option value="3000">Rouge Sunset (+3 000 DT)</option>
          </select>
        </div>
        <div>
          <div class="cfg-section-lbl">COULEUR INTÉRIEURE</div>
          <select class="cfg-select" id="selIntColor">
            <option value="0">Noir</option>
            <option value="0">Gris Anthracite</option>
            <option value="1000">Beige Sable (+1 000 DT)</option>
          </select>
        </div>
      </div>
      <div class="cfg-select-row">
        <div>
          <div class="cfg-section-lbl">MOTORISATION</div>
          <select class="cfg-select" id="selMotor">
            <option value="0">Essence de base</option>
            <option value="5000">Essence + (+5 000 DT)</option>
            <option value="8000">Hybride léger (+8 000 DT)</option>
            <option value="12000">Hybride rechargeable (+12 000 DT)</option>
          </select>
        </div>
        <div>
          <div class="cfg-section-lbl">PACK</div>
          <select class="cfg-select" id="selPack">
            <option value="0">Sans pack</option>
            <option value="4000">Pack Confort (+4 000 DT)</option>
            <option value="5500">Pack Sport (+5 500 DT)</option>
            <option value="6000">Pack Business (+6 000 DT)</option>
          </select>
        </div>
      </div>
      <div class="modal-rule"></div>
      <div class="cfg-section-lbl">TYPE D'INTÉRIEUR</div>
      <div class="int-grid" id="cfgIntGrid"></div>
      <div class="modal-rule"></div>
      <div class="cfg-section-lbl">RÉCAPITULATIF DU DEVIS</div>
      <div class="cfg-devis">
        <div class="dv-row">
          <span class="dv-lbl">Véhicule</span>
          <span class="dv-val" id="dvCarName"></span>
        </div>
        <div class="dv-row">
          <span class="dv-lbl">Prix de base</span>
          <span class="dv-val" id="dvBasePrice"></span>
        </div>
        <div class="dv-row" id="dvIntRow" style="display:none">
          <span class="dv-lbl">Type d'intérieur</span>
          <span class="dv-val" id="dvIntName"></span>
        </div>
        <div class="dv-row" id="dvDeltaRow" style="display:none">
          <span class="dv-lbl">Supplément intérieur</span>
          <span class="dv-val" id="dvDelta"></span>
        </div>
        <div class="dv-row">
          <span class="dv-lbl">Options sélectionnées</span>
          <span class="dv-val" id="dvOptsTotal">Inclus</span>
        </div>
        <div class="dv-sep"></div>
        <div class="dv-row">
          <span class="dv-total-lbl">TOTAL ESTIMÉ</span>
          <span class="dv-total-val" id="dvTotal"></span>
        </div>
      </div>
      <div class="cfg-footer">
        <button class="btn-cfg-ok" id="cfgConfirmBtn">DEMANDER UN DEVIS</button>
        <button class="btn-cfg-cancel" id="cfgCancelBtn">FERMER</button>
      </div>
    </div>
  </div>

  <!-- ESSAI ROUTIER MODAL -->
  <div class="modal-overlay" id="tdOverlay">
    <div class="modal-box td-modal-box">
      <button class="modal-close-btn" id="tdCloseBtn" aria-label="Fermer">✕</button>
      <div class="modal-eyebrow">ESSAI ROUTIER</div>
      <div class="modal-title" id="tdCarTitle"></div>
      <div class="modal-rule"></div>
      <div class="td-success" id="tdSuccess">
        Votre essai routier est confirmé.<br>Notre équipe vous contactera sous 24h.
      </div>
      <form id="tdForm" action="../reservations/create.php" method="POST" onsubmit="submitTestDrive(event)">
        <input type="hidden" name="source" value="standard">
        <div class="td-form-grid">
          <div class="cf-full">
            <label class="cf-label">Voiture souhaitée</label>
            <input class="cf-input" type="text" id="tdCarField" name="car_name" readonly>
          </div>
          <div>
            <label class="cf-label">Nom</label>
            <input class="cf-input" type="text" name="nom" required placeholder="Votre nom">
          </div>
          <div>
            <label class="cf-label">Prénom</label>
            <input class="cf-input" type="text" name="prenom" required placeholder="Votre prénom">
          </div>
          <div>
            <label class="cf-label">Téléphone</label>
            <input class="cf-input" type="tel" name="telephone" required placeholder="+216 XX XXX XXX">
          </div>
          <div>
            <label class="cf-label">Email</label>
            <input class="cf-input" type="email" name="email" required placeholder="votre@email.com">
          </div>
          <div class="cf-full">
            <label class="cf-label">Showroom préféré</label>
            <select class="cf-input cf-select-field" name="showroom" required>
              <option value="">Choisir un showroom...</option>
              <option>CARTHA CARS TUNIS — Ave Habib Bourguiba</option>
              <option>CARTHA CARS SFAX — Ave Farhat Hached</option>
              <option>CARTHA CARS SOUSSE — Ave Mohamed V</option>
              <option>CARTHA CARS MONASTIR — Ave de l'Indépendance</option>
              <option>CARTHA CARS NABEUL — Ave Habib Thameur</option>
              <option>CARTHA CARS BIZERTE — Ave du 7 Novembre</option>
            </select>
          </div>
          <div>
            <label class="cf-label">Date souhaitée</label>
            <input class="cf-input" type="date" id="tdDate" name="reservation_date" required>
          </div>
          <div>
            <label class="cf-label">Heure préférée</label>
            <select class="cf-input cf-select-field" name="reservation_time" required>
              <option value="">Choisir une heure...</option>
              <option>09:00</option>
              <option>10:00</option>
              <option>11:00</option>
              <option>14:00</option>
              <option>15:00</option>
              <option>16:00</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn-td-confirm" style="margin-top:16px">CONFIRMER L'ESSAI</button>
      </form>
    </div>
  </div>

  <!-- NOS PARTENAIRES MODAL -->
  <div class="modal-overlay" id="partnersOverlay">
    <div class="modal-box partners-modal-box">
      <button class="modal-close-btn" id="partnersCloseBtn" aria-label="Fermer">✕</button>
      <div class="modal-eyebrow">RÉSEAU DE PARTENAIRES</div>
      <div class="modal-title">NOS PARTENAIRES</div>
      <div class="modal-rule"></div>
      <div class="partners-grid">
        <div class="partner-card">
          <div class="partner-name">AutoStyle Tunis</div>
          <div class="partner-spec">Préparation sportive &amp; tuning</div>
          <div class="partner-addr">Tunis Zone Industrielle<br>+216 71 000 001</div>
          <a class="btn-partner-wa" href="https://wa.me/21671000001?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">
            ✆ CONTACTER CE PARTENAIRE
          </a>
        </div>
        <div class="partner-card">
          <div class="partner-name">Prestige Custom Sfax</div>
          <div class="partner-spec">Sellerie sur mesure &amp; intérieur luxe</div>
          <div class="partner-addr">Sfax Centre<br>+216 74 000 002</div>
          <a class="btn-partner-wa" href="https://wa.me/21674000002?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">
            ✆ CONTACTER CE PARTENAIRE
          </a>
        </div>
        <div class="partner-card">
          <div class="partner-name">TechMotor Sousse</div>
          <div class="partner-spec">Performance &amp; optimisation moteur</div>
          <div class="partner-addr">Sousse Route de Monastir<br>+216 73 000 003</div>
          <a class="btn-partner-wa" href="https://wa.me/21673000003?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">
            ✆ CONTACTER CE PARTENAIRE
          </a>
        </div>
        <div class="partner-card">
          <div class="partner-name">Elite Wrap Tunis</div>
          <div class="partner-spec">Covering &amp; wrapping premium</div>
          <div class="partner-addr">Ariana Tunis<br>+216 71 000 004</div>
          <a class="btn-partner-wa" href="https://wa.me/21671000004?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">
            ✆ CONTACTER CE PARTENAIRE
          </a>
        </div>
        <div class="partner-card">
          <div class="partner-name">CarSound Pro</div>
          <div class="partner-spec">Audio haute fidélité &amp; électronique</div>
          <div class="partner-addr">La Marsa Tunis<br>+216 71 000 005</div>
          <a class="btn-partner-wa" href="https://wa.me/21671000005?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">
            ✆ CONTACTER CE PARTENAIRE
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    /* ── Ticker ────────────────────────────────── */
    const TICKER_ITEMS = [
      { label: 'Volkswagen Tiguan',  val: '145 000 DT'      },
      { label: 'Skoda Superb',       val: '125 000 DT'      },
      { label: 'Mercedes CLA 200',   val: '175 000 DT'      },
      { label: 'Golf 8 GTI',         val: '165 000 DT'      },
      { label: 'Cupra Formentor',    val: '135 000 DT'      },
      { label: 'Essai Routier',      val: 'Sur Rendez-Vous' },
      { label: 'Financement',        val: 'Disponible'      },
      { label: 'Livraison',          val: 'Tunis & Sfax'    },
    ];
    const tickerInner = document.getElementById('tickerInner');
    [...TICKER_ITEMS, ...TICKER_ITEMS].forEach(t => {
      const el = document.createElement('span');
      el.className = 'ticker-item';
      el.innerHTML = t.label + ' <b>— ' + t.val + ' —</b>';
      tickerInner.appendChild(el);
    });

    /* ── Nav scroll ────────────────────────────── */
    const mainNav = document.getElementById('mainNav');
    const onScroll = () => mainNav.classList.toggle('scrolled', window.scrollY > 80);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* ── Fade-up animations ────────────────────── */
    const ioAll = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const idx = [...document.querySelectorAll('.fade-up')].indexOf(entry.target);
        setTimeout(() => entry.target.classList.add('visible'), Math.max(0, idx % 6) * 80);
        obs.unobserve(entry.target);
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    document.querySelectorAll('.fade-up').forEach(el => ioAll.observe(el));

    /* ── Page Transition ─────────────────────── */
    (function () {
      const pt = document.getElementById('pageTransition');
      let navigating = false;
      setTimeout(() => pt.classList.add('pt-out'), 50);
      document.querySelectorAll('[data-nav]').forEach(el => {
        el.addEventListener('click', e => {
          if (navigating) return;
          const href = el.getAttribute('href');
          if (!href || href === '#') return;
          const cur  = window.location.pathname.split('/').pop() || 'index.html';
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

    /* ── Contact form ──────────────────────────── */
    async function submitContact(e) {
      e.preventDefault();
      const form = document.getElementById('contactForm');
      const button = form.querySelector('button[type="submit"]');

      button.disabled = true;
      button.textContent = 'ENVOI...';

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: { 'Accept': 'application/json' }
        });
        const result = await response.json();
        if (!response.ok || !result.success) {
          throw new Error(result.message || 'Erreur lors de l envoi.');
        }
        form.style.display = 'none';
        document.getElementById('contactSuccess').style.display = 'block';
      } catch (err) {
        alert(err.message || 'Impossible d envoyer la demande.');
      } finally {
        button.disabled = false;
        button.textContent = 'ENVOYER MA DEMANDE';
      }
    }

    /* ── Generic modal helpers ─────────────────── */
    function openModal(id) {
      document.getElementById(id).classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
      document.getElementById(id).classList.remove('open');
      document.body.style.overflow = '';
    }
    function bindModal(overlayId, closeBtnId) {
      const ov = document.getElementById(overlayId);
      document.getElementById(closeBtnId).addEventListener('click', () => closeModal(overlayId));
      ov.addEventListener('click', e => { if (e.target === ov) closeModal(overlayId); });
      document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && ov.classList.contains('open')) closeModal(overlayId);
      });
    }

    /* ── NOS PARTENAIRES modal ─────────────────── */
    document.getElementById('navPartners').addEventListener('click', () => openModal('partnersOverlay'));
    bindModal('partnersOverlay', 'partnersCloseBtn');

    /* ── Buy Wizard ─────────────────────────────── */
    (function () {
      const OVL  = document.getElementById('buyOverlay');
      const FILL = document.getElementById('buyProgFill');
      const BODY = document.getElementById('buyWizBody');
      const PREV = document.getElementById('buyPrev');
      const NEXT = document.getElementById('buyNext');
      const SROW = document.getElementById('buyStepsRow');
      const STEP_NAMES = ['VÉHICULE','COULEUR','INTÉRIEUR','JANTES','OPTIONS','RÉCAP'];

      const CARS = [
        { name:'Volkswagen Tiguan',  base:145000, img:'https://images.unsplash.com/photo-1655286161233-7aa3a3e39e8a?w=1200&q=80' },
        { name:'Skoda Superb',       base:125000, img:'https://images.unsplash.com/photo-1687901882211-40f91b8957b1?w=1200&q=80' },
        { name:'Mercedes CLA 200',   base:175000, img:'https://images.unsplash.com/photo-1652549423957-d9c4445ee9bf?w=1200&q=80' },
        { name:'Golf 8 GTI',         base:165000, img:'https://images.unsplash.com/photo-1655286655831-eec6743fcc69?w=1200&q=80' },
        { name:'Cupra Formentor',    base:135000, img:'https://images.unsplash.com/photo-1655288718876-6bc36152fd23?w=1200&q=80' },
      ];
      const COLORS = [
        { name:'Noir Onyx',        bg:'#0a0a0a' },
        { name:'Blanc Nacré',      bg:'#f5f5f0' },
        { name:'Gris Graphite',    bg:'#4a4a4a' },
        { name:'Bleu Nuit',        bg:'#1a2744' },
        { name:'Rouge Sang',       bg:'#8b0000' },
        { name:'Argent Glacé',     bg:'linear-gradient(135deg,#c0c0c0,#e8e8e8)' },
        { name:'Vert Britannique', bg:'#1a3a2a' },
        { name:'Or Champagne',     bg:'#c9a84c' },
      ];
      const INTERIORS = [
        { name:'Tissu',              delta:0 },
        { name:'Tissu Sport',        delta:2000 },
        { name:'Simili Cuir',        delta:3500 },
        { name:'Cuir Véritable',     delta:6000 },
        { name:'Cuir et Alcantara',  delta:8500 },
      ];
      const JANTES = [
        { name:'Standard',           delta:0 },
        { name:'Sport 19"',          delta:5000 },
        { name:'Racing 21"',         delta:9000 },
        { name:'Forgées sur mesure', delta:18000 },
      ];
      const AUDIO = [
        { name:'Audio Standard',    delta:0 },
        { name:'Bose Surround',     delta:4500 },
        { name:'Bang & Olufsen',    delta:9000 },
        { name:'Burmester Premium', delta:14000 },
      ];
      const OPTS = [
        { name:'Toit panoramique',         delta:6000 },
        { name:'Caméra 360°',              delta:3000 },
        { name:'Sièges massants',          delta:5000 },
        { name:'Affichage tête haute',     delta:2500 },
        { name:'Pack éclairage ambiance',  delta:1500 },
        { name:'Vitres teintées',          delta:2000 },
        { name:'Protection céramique',     delta:4000 },
      ];

      const S = { car:0, color:0, interior:0, jantes:0, audio:0, opts:[], step:0 };

      function fmt(n) { return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g,' ') + ' DT'; }

      function updateHeader() {
        FILL.style.width = ((S.step+1)/6*100) + '%';
        SROW.querySelectorAll('.wiz-step').forEach((el,i) => {
          el.classList.toggle('done', i < S.step);
          el.classList.toggle('active', i === S.step);
        });
        PREV.style.visibility = S.step === 0 ? 'hidden' : 'visible';
        NEXT.style.display = S.step === 5 ? 'none' : '';
      }

      function animate(fn) {
        BODY.style.transition = 'none';
        BODY.style.opacity = '0';
        BODY.style.transform = 'translateX(28px)';
        requestAnimationFrame(() => requestAnimationFrame(() => {
          fn();
          BODY.style.transition = 'opacity .35s ease, transform .35s ease';
          BODY.style.opacity = '1';
          BODY.style.transform = 'translateX(0)';
        }));
      }

      function render() {
        updateHeader();
        animate(() => {
          switch (S.step) {
            case 0: rVehicle();  break;
            case 1: rColor();    break;
            case 2: rInterior(); break;
            case 3: rJantes();   break;
            case 4: rAudio();    break;
            case 5: rSummary();  break;
          }
        });
      }

      function stepHdr(num, title, sub) {
        return `<div class="wiz-step-header">
          <div class="wiz-step-eyebrow">ÉTAPE ${num}/6</div>
          <div class="wiz-step-title">${title}</div>
          <div class="wiz-step-sub">${sub}</div>
        </div>`;
      }

      function rVehicle() {
        const c = CARS[S.car];
        BODY.innerHTML = stepHdr(1,'VOTRE VÉHICULE','Votre sélection') +
          `<div class="wiz-car-display">
            <img class="wiz-car-img" src="${c.img}" alt="${c.name}">
            <div class="wiz-car-info">
              <div class="wiz-car-name-big">${c.name}</div>
              <div class="wiz-car-price-big">${fmt(c.base)}</div>
            </div>
          </div>`;
      }

      function rColor() {
        BODY.innerHTML = stepHdr(2,'COULEUR EXTÉRIEURE','Choisissez votre teinte') +
          `<div class="wiz-colors-grid">${COLORS.map((c,i) =>
            `<button class="wiz-color-btn${i===S.color?' active':''}" data-i="${i}">
              <div class="wiz-color-circle" style="background:${c.bg}"></div>
              <span class="wiz-color-name">${c.name}</span>
            </button>`).join('')}</div>`;
        BODY.querySelectorAll('.wiz-color-btn').forEach(b => b.addEventListener('click', () => {
          S.color = +b.dataset.i;
          BODY.querySelectorAll('.wiz-color-btn').forEach(x => x.classList.toggle('active', x===b));
        }));
      }

      function mkCards(items, key) {
        return `<div class="wiz-option-cards">${items.map((it,i) =>
          `<button class="wiz-opt-card${i===S[key]?' active':''}" data-i="${i}">
            <div class="wiz-opt-card-check">✓</div>
            <div class="wiz-opt-name">${it.name}</div>
            <div class="wiz-opt-price">${it.delta===0?'Inclus':'+'+fmt(it.delta)}</div>
          </button>`).join('')}</div>`;
      }

      function bindCards(key) {
        BODY.querySelectorAll('.wiz-opt-card').forEach(b => b.addEventListener('click', () => {
          S[key] = +b.dataset.i;
          BODY.querySelectorAll('.wiz-opt-card').forEach(x => x.classList.toggle('active', x===b));
        }));
      }

      function rInterior() {
        BODY.innerHTML = stepHdr(3,"TYPE D'INTÉRIEUR",'Choisissez votre sellerie') + mkCards(INTERIORS,'interior');
        bindCards('interior');
      }

      function rJantes() {
        BODY.innerHTML = stepHdr(4,'TYPE DE JANTES','Choisissez vos jantes') + mkCards(JANTES,'jantes');
        bindCards('jantes');
      }

      function rAudio() {
        BODY.innerHTML = stepHdr(5,'SYSTÈME AUDIO & OPTIONS','Personnalisez votre expérience') +
          `<div class="wiz-section-lbl">SYSTÈME AUDIO</div>` +
          mkCards(AUDIO,'audio') +
          `<div class="wiz-section-lbl" style="margin-top:28px">OPTIONS SUPPLÉMENTAIRES</div>
          <div class="wiz-check-grid">${OPTS.map((o,i) =>
            `<button class="wiz-check-item${S.opts.includes(i)?' checked':''}" data-i="${i}">
              <div class="wiz-checkbox"><div class="wiz-checkbox-tick">✓</div></div>
              <div>
                <div class="wiz-check-name">${o.name}</div>
                <div class="wiz-check-price">+${fmt(o.delta)}</div>
              </div>
            </button>`).join('')}</div>`;
        BODY.querySelectorAll('.wiz-opt-card').forEach(b => b.addEventListener('click', () => {
          S.audio = +b.dataset.i;
          BODY.querySelectorAll('.wiz-opt-card').forEach(x => x.classList.toggle('active', x===b));
        }));
        BODY.querySelectorAll('.wiz-check-item').forEach(b => b.addEventListener('click', () => {
          const idx = +b.dataset.i;
          if (S.opts.includes(idx)) S.opts = S.opts.filter(x => x!==idx);
          else S.opts.push(idx);
          b.classList.toggle('checked', S.opts.includes(idx));
        }));
      }

      function rSummary() {
        const c = CARS[S.car];
        const extraRows = [];
        if (INTERIORS[S.interior].delta>0) extraRows.push(`<div class="wiz-sum-extra-row"><span>Intérieur — ${INTERIORS[S.interior].name}</span><span>+${fmt(INTERIORS[S.interior].delta)}</span></div>`);
        if (JANTES[S.jantes].delta>0)     extraRows.push(`<div class="wiz-sum-extra-row"><span>Jantes — ${JANTES[S.jantes].name}</span><span>+${fmt(JANTES[S.jantes].delta)}</span></div>`);
        if (AUDIO[S.audio].delta>0)        extraRows.push(`<div class="wiz-sum-extra-row"><span>Audio — ${AUDIO[S.audio].name}</span><span>+${fmt(AUDIO[S.audio].delta)}</span></div>`);
        S.opts.forEach(i => extraRows.push(`<div class="wiz-sum-extra-row"><span>${OPTS[i].name}</span><span>+${fmt(OPTS[i].delta)}</span></div>`));
        const extras = INTERIORS[S.interior].delta + JANTES[S.jantes].delta + AUDIO[S.audio].delta + S.opts.reduce((a,i)=>a+OPTS[i].delta,0);
        const total  = c.base + extras;
        BODY.innerHTML = stepHdr(6,'RÉCAPITULATIF','Votre configuration complète') +
          `<div class="wiz-summary-box">
            <div class="wiz-sum-rows">
              <div class="wiz-sum-row"><span class="wiz-sum-lbl">Véhicule</span><span class="wiz-sum-val">${c.name}</span></div>
              <div class="wiz-sum-row"><span class="wiz-sum-lbl">Couleur</span><span class="wiz-sum-val">${COLORS[S.color].name}</span></div>
              <div class="wiz-sum-row"><span class="wiz-sum-lbl">Intérieur</span><span class="wiz-sum-val">${INTERIORS[S.interior].name}</span></div>
              <div class="wiz-sum-row"><span class="wiz-sum-lbl">Jantes</span><span class="wiz-sum-val">${JANTES[S.jantes].name}</span></div>
              <div class="wiz-sum-row"><span class="wiz-sum-lbl">Audio</span><span class="wiz-sum-val">${AUDIO[S.audio].name}</span></div>
            </div>
            <div class="wiz-sum-sep"></div>
            <div class="wiz-sum-row"><span class="wiz-sum-lbl">Prix de base</span><span class="wiz-sum-val">${fmt(c.base)}</span></div>
            ${extraRows.length?`<div class="wiz-sum-extras">${extraRows.join('')}</div>`:''}
            <div class="wiz-sum-sep"></div>
            <div class="wiz-total-row"><span class="wiz-total-lbl">TOTAL FINAL</span><span class="wiz-total-val">${fmt(total)}</span></div>
          </div>
          <div class="wiz-form-grid" id="wizFormGrid">
            <div><label class="wiz-lbl">Nom</label><input class="wiz-input" id="wizNom" type="text" placeholder="Votre nom"></div>
            <div><label class="wiz-lbl">Prénom</label><input class="wiz-input" id="wizPrenom" type="text" placeholder="Votre prénom"></div>
            <div><label class="wiz-lbl">Téléphone</label><input class="wiz-input" id="wizTelephone" type="tel" placeholder="+216 XX XXX XXX"></div>
            <div><label class="wiz-lbl">Email</label><input class="wiz-input" id="wizEmail" type="email" placeholder="votre@email.com"></div>
            <div class="wiz-full"><label class="wiz-lbl">Message (optionnel)</label><textarea class="wiz-textarea" id="wizMessage" placeholder="Vos souhaits particuliers..."></textarea></div>
          </div>
          <div class="wiz-final-btns" id="wizFinalBtns">
            <button class="wiz-btn-devis" id="wizDevis">DEMANDER UN DEVIS</button>
            <button class="wiz-btn-confirm-buy" id="wizConfirm">CONFIRMER L'ACHAT</button>
          </div>
          <div class="wiz-success-msg" id="wizSuccess" style="display:none">
            <div class="wiz-success-check">✓</div>
            <div class="wiz-success-title">Configuration envoyée !</div>
            <div class="wiz-success-sub">Votre configuration a été envoyée. Notre équipe vous contactera sous 24h.</div>
          </div>`;
        async function sendForm(orderType) {
          const nom = document.getElementById('wizNom').value.trim();
          const prenom = document.getElementById('wizPrenom').value.trim();
          const telephone = document.getElementById('wizTelephone').value.trim();
          const email = document.getElementById('wizEmail').value.trim();
          const message = document.getElementById('wizMessage').value.trim();
          const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

          if (!nom || !prenom || !telephone || !emailRx.test(email)) {
            alert('Veuillez remplir nom, prénom, téléphone et email valide.');
            return;
          }

          const payload = new FormData();
          payload.append('order_type', orderType);
          payload.append('source', 'standard');
          payload.append('car_name', c.name);
          payload.append('base_price', c.base);
          payload.append('total_price', total);
          payload.append('color', COLORS[S.color].name);
          payload.append('interior', INTERIORS[S.interior].name);
          payload.append('wheels', JANTES[S.jantes].name);
          payload.append('audio', AUDIO[S.audio].name);
          payload.append('options', S.opts.map(i => OPTS[i].name).join(', '));
          payload.append('nom', nom);
          payload.append('prenom', prenom);
          payload.append('telephone', telephone);
          payload.append('email', email);
          payload.append('message', message);

          const btns = document.querySelectorAll('#wizFinalBtns button');
          btns.forEach(btn => btn.disabled = true);

          try {
            const response = await fetch('../orders/create.php', { method: 'POST', body: payload, headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (!response.ok || !result.success) throw new Error(result.message || 'Erreur lors de l envoi.');

            document.getElementById('wizSuccess').style.display = 'flex';
            document.getElementById('wizFormGrid').style.display = 'none';
            document.getElementById('wizFinalBtns').style.display = 'none';
          } catch (err) {
            alert(err.message || 'Impossible d enregistrer la commande.');
          } finally {
            btns.forEach(btn => btn.disabled = false);
          }
        }
        document.getElementById('wizDevis').addEventListener('click', () => sendForm('quote'));
        document.getElementById('wizConfirm').addEventListener('click', () => sendForm('purchase'));
      }

      STEP_NAMES.forEach((name, i) => {
        const el = document.createElement('div');
        el.className = 'wiz-step';
        el.innerHTML = `<div class="wiz-step-dot">${i+1}</div><div class="wiz-step-lbl">${name}</div>`;
        SROW.appendChild(el);
      });

      function openWizard(carIdx) {
        S.car = carIdx; S.color = 0; S.interior = 0; S.jantes = 0; S.audio = 0; S.opts = []; S.step = 0;
        OVL.classList.add('open');
        document.body.style.overflow = 'hidden';
        BODY.style.opacity = '1';
        BODY.style.transform = 'none';
        render();
      }
      function closeWizard() {
        OVL.classList.remove('open');
        document.body.style.overflow = '';
      }

      document.querySelectorAll('.btn-buy').forEach((btn, i) => btn.addEventListener('click', () => openWizard(i)));
      document.getElementById('buyCloseBtn').addEventListener('click', closeWizard);
      OVL.addEventListener('click', e => { if (e.target === OVL) closeWizard(); });
      document.addEventListener('keydown', e => { if (e.key === 'Escape' && OVL.classList.contains('open')) closeWizard(); });
      PREV.addEventListener('click', () => { if (S.step > 0) { S.step--; render(); } });
      NEXT.addEventListener('click', () => { if (S.step < 5) { S.step++; render(); } });
    })();

    /* ── Configurator ──────────────────────────── */
    (function () {
      const CARS = [
        { name: 'Volkswagen Tiguan',  base: 145000 },
        { name: 'Skoda Superb',       base: 125000 },
        { name: 'Mercedes CLA 200',   base: 175000 },
        { name: 'Golf 8 GTI',         base: 165000 },
        { name: 'Cupra Formentor',    base: 135000 },
      ];
      const INTERIORS = [
        { id:'ti', name:'Tissu',             desc:'Confort quotidien',   delta:0,
          sw:'repeating-linear-gradient(0deg,rgba(255,255,255,.04) 0,rgba(255,255,255,.04) 1px,transparent 1px,transparent 5px),repeating-linear-gradient(90deg,rgba(255,255,255,.04) 0,rgba(255,255,255,.04) 1px,transparent 1px,transparent 5px),#1a2030' },
        { id:'ts', name:'Tissu Sport',       desc:'Renforts latéraux',   delta:2000,
          sw:'repeating-linear-gradient(0deg,rgba(255,107,53,.07) 0,rgba(255,107,53,.07) 2px,transparent 2px,transparent 8px),linear-gradient(135deg,#141420,#1e1e2e)' },
        { id:'sl', name:'Simili Cuir',       desc:'Élégance accessible', delta:3500,
          sw:'linear-gradient(135deg,#222228,#2e2e38 50%,#282830)' },
        { id:'cv', name:'Cuir Véritable',    desc:'Premium',             delta:6000,
          sw:'linear-gradient(135deg,#4a3020,#7a5535 50%,#5a3a22)' },
        { id:'ca', name:'Cuir et Alcantara', desc:'Sportif et raffiné',  delta:8500,
          sw:'linear-gradient(90deg,#5a3822 0%,#5a3822 50%,#1c1c22 50%,#1c1c22 100%)' },
      ];

      const intGrid  = document.getElementById('cfgIntGrid');
      const dvCar    = document.getElementById('dvCarName');
      const dvBase   = document.getElementById('dvBasePrice');
      const dvIntRow = document.getElementById('dvIntRow');
      const dvIntNm  = document.getElementById('dvIntName');
      const dvDltRow = document.getElementById('dvDeltaRow');
      const dvDlt    = document.getElementById('dvDelta');
      const dvOpts   = document.getElementById('dvOptsTotal');
      const dvTotal  = document.getElementById('dvTotal');
      const selExt   = document.getElementById('selExt');
      const selIntC  = document.getElementById('selIntColor');
      const selMotor = document.getElementById('selMotor');
      const selPack  = document.getElementById('selPack');

      let activeCar = null, activeInt = null;
      const fmt = n => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' DT';

      INTERIORS.forEach(int => {
        const card = document.createElement('button');
        card.type = 'button';
        card.className = 'int-card';
        card.dataset.id = int.id;
        card.innerHTML =
          '<div class="int-swatch" style="background:' + int.sw + '"></div>' +
          '<div class="int-body">' +
            '<span class="int-name">' + int.name + '</span>' +
            '<span class="int-desc">' + int.desc + '</span>' +
            '<span class="int-price-tag">' + (int.delta ? '+ ' + fmt(int.delta) : 'Inclus') + '</span>' +
          '</div>';
        card.addEventListener('click', () => pick(int));
        intGrid.appendChild(card);
      });

      [selExt, selIntC, selMotor, selPack].forEach(s => s.addEventListener('change', refresh));

      function selectorDelta() {
        return [selExt, selIntC, selMotor, selPack].reduce((sum, s) => sum + parseInt(s.value || 0), 0);
      }

      function pick(int) {
        activeInt = int;
        intGrid.querySelectorAll('.int-card').forEach(c => c.classList.remove('active'));
        intGrid.querySelector('[data-id="' + int.id + '"]').classList.add('active');
        refresh();
      }

      function refresh() {
        if (!activeCar) return;
        const sDelta = selectorDelta();
        if (activeInt) {
          dvIntRow.style.display = dvDltRow.style.display = '';
          dvIntNm.textContent = activeInt.name;
          dvDlt.textContent   = activeInt.delta ? '+ ' + fmt(activeInt.delta) : 'Inclus';
        } else {
          dvIntRow.style.display = dvDltRow.style.display = 'none';
        }
        dvOpts.textContent  = sDelta > 0 ? '+ ' + fmt(sDelta) : 'Inclus';
        dvTotal.textContent = fmt(activeCar.base + (activeInt ? activeInt.delta : 0) + sDelta);
      }

      function openCfg(car) {
        activeCar = car; activeInt = null;
        document.getElementById('cfgCarTitle').textContent = car.name;
        dvCar.textContent    = car.name;
        dvBase.textContent   = fmt(car.base);
        dvTotal.textContent  = fmt(car.base);
        dvOpts.textContent   = 'Inclus';
        dvIntRow.style.display = dvDltRow.style.display = 'none';
        [selExt, selIntC, selMotor, selPack].forEach(s => s.selectedIndex = 0);
        intGrid.querySelectorAll('.int-card').forEach(c => c.classList.remove('active'));
        openModal('cfgOverlay');
      }

      document.querySelectorAll('.btn-cfg-trigger').forEach((btn, i) => btn.addEventListener('click', () => openCfg(CARS[i])));
      bindModal('cfgOverlay', 'cfgCloseBtn');
      document.getElementById('cfgCancelBtn').addEventListener('click', () => closeModal('cfgOverlay'));
      document.getElementById('cfgConfirmBtn').addEventListener('click', () => closeModal('cfgOverlay'));
    })();

    /* ── Essai Routier modal ───────────────────── */
    (function () {
      const NAMES = [
        'Volkswagen Tiguan', 'Skoda Superb', 'Mercedes CLA 200',
        'Golf 8 GTI', 'Cupra Formentor',
      ];

      const tdDate = document.getElementById('tdDate');
      tdDate.min = new Date().toISOString().split('T')[0];

      function openTD(name) {
        document.getElementById('tdCarTitle').textContent = name;
        document.getElementById('tdCarField').value = name;
        document.getElementById('tdForm').style.display = '';
        document.getElementById('tdSuccess').style.display = 'none';
        openModal('tdOverlay');
      }

      document.querySelectorAll('.btn-test-drive').forEach((btn, i) => btn.addEventListener('click', () => openTD(NAMES[i])));
      bindModal('tdOverlay', 'tdCloseBtn');
    })();

    async function submitTestDrive(e) {
      e.preventDefault();
      const form = document.getElementById('tdForm');
      const button = form.querySelector('button[type="submit"]');
      button.disabled = true;
      button.textContent = 'ENVOI...';

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: { 'Accept': 'application/json' }
        });
        const result = await response.json();
        if (!response.ok || !result.success) throw new Error(result.message || 'Erreur lors de l envoi.');
        form.style.display = 'none';
        document.getElementById('tdSuccess').style.display = 'block';
      } catch (err) {
        alert(err.message || 'Impossible d enregistrer la réservation.');
      } finally {
        button.disabled = false;
        button.textContent = "CONFIRMER L'ESSAI";
      }
    }
  </script>

</body>
</html>
