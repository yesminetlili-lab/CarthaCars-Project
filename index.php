<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CARTHA CARS — Configurez votre Rêve</title>
  <script type="importmap">
  {
    "imports": {
      "three":          "https://cdn.jsdelivr.net/npm/three@0.169.0/build/three.module.min.js",
      "three/addons/":  "https://cdn.jsdelivr.net/npm/three@0.169.0/examples/jsm/"
    }
  }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Page-nav active state */
    .nav-links a.active { color: var(--accent) !important; }
    .nav-links a.active::after {
      content: '';
      position: absolute;
      bottom: -4px; left: 0; right: 0;
      height: 1px;
      background: var(--accent);
      transform: scaleX(1) !important;
    }
    /* ACCUEIL fixed button */
    .btn-home {
      position: fixed;
      bottom: 50px; left: 24px;
      z-index: 390;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: rgba(255,255,255,.55);
      background: rgba(0,0,0,.78);
      border: 1px solid rgba(255,255,255,.14);
      padding: 10px 16px;
      text-decoration: none;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      transition: color .3s, border-color .3s, background .3s;
      clip-path: polygon(0 0,calc(100% - 7px) 0,100% 7px,100% 100%,7px 100%,0 calc(100% - 7px));
    }
    .btn-home:hover { color: #fff; border-color: rgba(255,255,255,.4); background: rgba(0,0,0,.92); }
    /* Page transition overlay */
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

    /* ACHETER button in CTA group */
    .btn-buy-cta {
      font-family: 'Space Mono', monospace;
      font-size: 10px; letter-spacing: .18em; text-transform: uppercase;
      background: var(--accent2); color: #fff; border: none;
      padding: 13px 28px; cursor: pointer;
      clip-path: polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));
      transition: filter .3s, transform .2s;
    }
    .btn-buy-cta:hover { filter: brightness(1.2); transform: translateY(-2px); }

    /* ACHETER modal (buy-overlay) */
    .buy-overlay-idx {
      position: fixed; inset: 0; z-index: 1100;
      background: rgba(0,0,0,.85);
      backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
      display: flex; align-items: center; justify-content: center;
      padding: 20px; opacity: 0; pointer-events: none;
      transition: opacity .35s ease;
    }
    .buy-overlay-idx.open { opacity: 1; pointer-events: all; }
    .buy-modal-idx {
      background: #0e0e12;
      border: 1px solid rgba(255,255,255,.1);
      border-left: 2px solid var(--accent);
      max-width: 680px; width: 100%; max-height: 90vh;
      overflow-y: auto; padding: 36px 40px; position: relative;
      transform: translateY(22px);
      transition: transform .35s cubic-bezier(.25,.46,.45,.94);
    }
    .buy-overlay-idx.open .buy-modal-idx { transform: translateY(0); }
    .buy-modal-idx .m-close {
      position: absolute; top: 16px; right: 16px;
      background: transparent; border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.4); width: 32px; height: 32px;
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; cursor: pointer; transition: color .25s, border-color .25s;
    }
    .buy-modal-idx .m-close:hover { color: #fff; border-color: rgba(255,255,255,.38); }
    .buy-modal-idx .m-eyebrow {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .32em; text-transform: uppercase; color: var(--accent); margin-bottom: 5px;
    }
    .buy-modal-idx .m-title {
      font-family: 'Bebas Neue', cursive; font-size: 28px;
      letter-spacing: .06em; color: #fff; line-height: 1; margin-bottom: 26px;
    }
    .buy-modal-idx .m-rule { height: 1px; background: rgba(255,255,255,.07); margin-bottom: 22px; }
    .buy-modal-idx .m-lbl {
      font-family: 'Space Mono', monospace; font-size: 8.5px;
      letter-spacing: .3em; text-transform: uppercase; color: rgba(255,255,255,.33); margin-bottom: 12px;
    }
    .buy-form-g { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 22px; }
    .buy-form-g .full { grid-column: 1 / -1; }
    .b-lbl {
      display: block; font-family: 'Space Mono', monospace; font-size: 8px;
      letter-spacing: .28em; text-transform: uppercase; color: rgba(255,255,255,.32); margin-bottom: 7px;
    }
    .b-input, .b-textarea {
      width: 100%; background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.1); color: #fff;
      font-family: 'Rajdhani', sans-serif; font-size: 15px;
      padding: 11px 14px; outline: none;
      transition: border-color .25s, background .25s;
      appearance: none; -webkit-appearance: none;
    }
    .b-input:focus, .b-textarea:focus { border-color: var(--accent); background: rgba(255,45,32,.04); }
    .b-textarea { resize: vertical; min-height: 80px; }
    .b-swatches { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 22px; }
    .b-swatch {
      display: flex; flex-direction: column; align-items: center; gap: 6px;
      background: none; border: none; cursor: pointer;
    }
    .b-circle {
      width: 34px; height: 34px; border-radius: 50%;
      border: 2px solid transparent; outline: 2px solid rgba(255,255,255,.15);
      transition: border-color .25s, outline-color .25s, transform .2s;
    }
    .b-swatch.active .b-circle { border-color: var(--accent); outline-color: var(--accent); }
    .b-swatch:hover .b-circle  { transform: scale(1.1); }
    .b-swatch-lbl {
      font-family: 'Space Mono', monospace; font-size: 7px;
      letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.4);
    }
    .b-swatch.active .b-swatch-lbl { color: var(--accent); }
    .b-jantes { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 22px; }
    .b-jante {
      background: #111117; border: 1px solid rgba(255,255,255,.07);
      padding: 13px 14px; cursor: pointer; text-align: left;
      transition: border-color .25s, box-shadow .25s, transform .2s;
    }
    .b-jante:hover { border-color: rgba(255,45,32,.32); transform: translateY(-2px); }
    .b-jante.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 1px rgba(255,45,32,.35), 0 0 14px rgba(255,45,32,.14);
    }
    .b-jante-name {
      display: block; font-family: 'Bebas Neue', cursive; font-size: 14px;
      letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 3px;
    }
    .b-jante-price {
      display: block; font-family: 'Space Mono', monospace;
      font-size: 8px; letter-spacing: .1em; color: var(--accent);
    }
    .btn-buy-submit {
      width: 100%; margin-top: 4px;
      font-family: 'Space Mono', monospace; font-size: 10px;
      letter-spacing: .22em; text-transform: uppercase;
      background: var(--accent2); color: #fff; border: none; padding: 15px;
      cursor: pointer; transition: filter .3s;
      clip-path: polygon(0 0,calc(100% - 9px) 0,100% 9px,100% 100%,9px 100%,0 calc(100% - 9px));
    }
    .btn-buy-submit:hover { filter: brightness(1.2); }
    .buy-success-msg {
      display: none; text-align: center; padding: 32px 0;
      font-family: 'Rajdhani', sans-serif; font-size: 17px;
      color: var(--accent2); letter-spacing: .05em;
    }

    /* NOS PARTENAIRES modal */
    .partners-ov {
      position: fixed; inset: 0; z-index: 1100;
      background: rgba(0,0,0,.85);
      backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
      display: flex; align-items: center; justify-content: center;
      padding: 20px; opacity: 0; pointer-events: none;
      transition: opacity .35s ease;
    }
    .partners-ov.open { opacity: 1; pointer-events: all; }
    .partners-box {
      background: #0e0e12;
      border: 1px solid rgba(255,255,255,.1);
      border-left: 2px solid var(--accent);
      max-width: 780px; width: 100%; max-height: 90vh;
      overflow-y: auto; padding: 36px 40px; position: relative;
      transform: translateY(22px);
      transition: transform .35s cubic-bezier(.25,.46,.45,.94);
    }
    .partners-ov.open .partners-box { transform: translateY(0); }
    .p-close {
      position: absolute; top: 16px; right: 16px;
      background: transparent; border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.4); width: 32px; height: 32px;
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; cursor: pointer; transition: color .25s, border-color .25s;
    }
    .p-close:hover { color: #fff; border-color: rgba(255,255,255,.38); }
    .p-eyebrow {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .32em; text-transform: uppercase; color: var(--accent); margin-bottom: 5px;
    }
    .p-title {
      font-family: 'Bebas Neue', cursive; font-size: 28px;
      letter-spacing: .06em; color: #fff; line-height: 1; margin-bottom: 26px;
    }
    .p-rule { height: 1px; background: rgba(255,255,255,.07); margin-bottom: 22px; }
    .p-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 8px; }
    .p-card {
      background: #111117; border: 1px solid rgba(255,255,255,.07);
      padding: 20px; transition: border-color .3s, box-shadow .3s;
    }
    .p-card:hover { border-color: rgba(255,45,32,.35); box-shadow: 0 0 20px rgba(255,45,32,.1); }
    .p-name {
      font-family: 'Bebas Neue', cursive; font-size: 17px;
      letter-spacing: .06em; color: #fff; margin-bottom: 5px; line-height: 1.1;
    }
    .p-spec {
      font-family: 'Rajdhani', sans-serif; font-size: 13px;
      color: var(--accent2); margin-bottom: 8px; font-weight: 500;
    }
    .p-addr {
      font-family: 'Rajdhani', sans-serif; font-size: 12px;
      color: rgba(255,255,255,.38); margin-bottom: 14px; line-height: 1.5;
    }
    .p-wa {
      display: inline-flex; align-items: center; gap: 7px;
      font-family: 'Space Mono', monospace; font-size: 8px;
      letter-spacing: .18em; text-transform: uppercase;
      background: rgba(37,211,102,.1); color: #25D366;
      border: 1px solid rgba(37,211,102,.3); padding: 9px 14px;
      text-decoration: none;
      transition: background .3s, border-color .3s;
      clip-path: polygon(0 0,calc(100% - 6px) 0,100% 6px,100% 100%,6px 100%,0 calc(100% - 6px));
    }
    .p-wa:hover { background: rgba(37,211,102,.2); border-color: rgba(37,211,102,.55); }
    @media (max-width: 600px) {
      .buy-modal-idx { padding: 28px 20px; }
      .buy-form-g { grid-template-columns: 1fr; }
      .b-jantes  { grid-template-columns: 1fr; }
      .partners-box { padding: 28px 20px; }
      .p-grid { grid-template-columns: 1fr; }
    }
    /* Interior type cards in configurator step 2 */
    .int-type-section-title {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .3em; text-transform: uppercase;
      color: rgba(255,255,255,.35); margin: 22px 0 12px;
    }
    .int-type-grid {
      display: grid; grid-template-columns: repeat(auto-fill, minmax(145px, 1fr));
      gap: 10px; margin-bottom: 8px;
    }
    .int-type-card {
      background: #0d0d12; border: 1px solid rgba(255,255,255,.08);
      padding: 14px; cursor: pointer; text-align: left;
      transition: border-color .25s, box-shadow .25s, transform .2s;
    }
    .int-type-card:hover  { border-color: rgba(255,45,32,.35); transform: translateY(-2px); }
    .int-type-card.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 1px rgba(255,45,32,.35), 0 0 14px rgba(255,45,32,.15);
    }
    .int-type-name {
      display: block; font-family: 'Bebas Neue', cursive; font-size: 14px;
      letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 4px;
    }
    .int-type-price {
      display: block; font-family: 'Space Mono', monospace;
      font-size: 8px; letter-spacing: .08em; color: var(--accent);
    }

    /* Nav btn style */
    .nav-links .nav-btn-text {
      font-family: 'Space Mono', monospace; font-size: 9px;
      letter-spacing: .2em; text-transform: uppercase;
      color: rgba(255,255,255,.55); background: none; border: none;
      padding: 0; cursor: pointer; transition: color .3s;
    }
    .nav-links .nav-btn-text:hover { color: var(--accent); }

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
    .wiz-prog-track { position: absolute; top: 0; left: 0; right: 0; height: 3px; background: rgba(255,255,255,.08); z-index: 2; }
    .wiz-prog-fill { height: 100%; background: var(--accent2); width: 0%; transition: width .5s cubic-bezier(.25,.46,.45,.94); }
    .wiz-close { position: absolute; top: 18px; right: 20px; z-index: 10; width: 36px; height: 36px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.14); color: rgba(255,255,255,.5); font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: color .2s, border-color .2s; }
    .wiz-close:hover { color: #fff; border-color: rgba(255,255,255,.35); }
    .wiz-steps-row { display: flex; align-items: flex-start; justify-content: center; padding: 26px 64px 16px; border-bottom: 1px solid rgba(255,255,255,.06); flex-shrink: 0; }
    .wiz-step { display: flex; flex-direction: column; align-items: center; flex: 1; max-width: 90px; position: relative; }
    .wiz-step + .wiz-step::before { content: ''; position: absolute; top: 12px; left: calc(-50% + 13px); right: calc(50% + 13px); height: 1px; background: rgba(255,255,255,.1); }
    .wiz-step-dot { width: 26px; height: 26px; border-radius: 50%; background: #161620; border: 1.5px solid rgba(255,255,255,.16); display: flex; align-items: center; justify-content: center; font-family: 'Space Mono', monospace; font-size: 9px; color: rgba(255,255,255,.28); position: relative; z-index: 1; transition: all .3s ease; margin-bottom: 6px; }
    .wiz-step.active .wiz-step-dot { border-color: var(--accent2); color: var(--accent2); box-shadow: 0 0 10px rgba(255,107,53,.3); }
    .wiz-step.done   .wiz-step-dot { background: var(--accent2); border-color: var(--accent2); color: #fff; }
    .wiz-step-lbl { font-family: 'Space Mono', monospace; font-size: 6px; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.2); text-align: center; transition: color .3s; }
    .wiz-step.active .wiz-step-lbl { color: var(--accent2); }
    .wiz-step.done   .wiz-step-lbl { color: rgba(255,255,255,.45); }
    .wiz-body { flex: 1; overflow-y: auto; padding: 36px 52px; scroll-behavior: smooth; }
    .wiz-nav { display: flex; align-items: center; gap: 12px; padding: 18px 52px; border-top: 1px solid rgba(255,255,255,.06); background: rgba(0,0,0,.5); flex-shrink: 0; }
    .wiz-btn-prev { font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .18em; text-transform: uppercase; background: transparent; color: rgba(255,255,255,.4); border: 1px solid rgba(255,255,255,.12); padding: 12px 18px; cursor: pointer; transition: color .25s, border-color .25s; clip-path: polygon(0 0,calc(100% - 6px) 0,100% 6px,100% 100%,6px 100%,0 calc(100% - 6px)); }
    .wiz-btn-prev:hover { color: #fff; border-color: rgba(255,255,255,.33); }
    .wiz-btn-next { flex: 1; font-family: 'Space Mono', monospace; font-size: 10px; letter-spacing: .2em; text-transform: uppercase; background: var(--accent2); color: #fff; border: none; padding: 14px; cursor: pointer; transition: filter .25s, transform .2s; clip-path: polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px)); }
    .wiz-btn-next:hover { filter: brightness(1.18); transform: translateY(-1px); }
    .wiz-step-header { margin-bottom: 30px; }
    .wiz-step-eyebrow { font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .3em; text-transform: uppercase; color: var(--accent2); margin-bottom: 6px; }
    .wiz-step-title { font-family: 'Bebas Neue', cursive; font-size: clamp(30px, 5vw, 50px); letter-spacing: .06em; color: #fff; line-height: 1; }
    .wiz-step-sub { font-family: 'Rajdhani', sans-serif; font-size: 14px; color: rgba(255,255,255,.35); margin-top: 7px; }
    .wiz-car-display { overflow: hidden; background: #111117; border: 1px solid rgba(255,255,255,.06); max-width: 760px; }
    .wiz-car-img { width: 100%; height: 320px; object-fit: cover; display: block; filter: brightness(.88); }
    .wiz-car-info { padding: 20px 26px; background: #0e0e14; }
    .wiz-car-name-big { font-family: 'Bebas Neue', cursive; font-size: clamp(26px, 4vw, 42px); letter-spacing: .06em; color: #fff; line-height: 1; }
    .wiz-car-price-big { font-family: 'Space Mono', monospace; font-size: 15px; letter-spacing: .08em; color: var(--accent2); margin-top: 6px; }
    .wiz-colors-grid { display: flex; flex-wrap: wrap; gap: 16px; }
    .wiz-color-btn { display: flex; flex-direction: column; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; padding: 6px; transition: transform .2s; }
    .wiz-color-btn:hover { transform: translateY(-2px); }
    .wiz-color-circle { width: 52px; height: 52px; border-radius: 50%; border: 2.5px solid transparent; outline: 2px solid rgba(255,255,255,.1); transition: border-color .25s, outline-color .25s, box-shadow .25s; }
    .wiz-color-btn.active .wiz-color-circle { border-color: var(--accent2); outline-color: var(--accent2); box-shadow: 0 0 14px rgba(255,107,53,.4); }
    .wiz-color-name { font-family: 'Space Mono', monospace; font-size: 7px; letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.38); text-align: center; }
    .wiz-color-btn.active .wiz-color-name { color: var(--accent2); }
    .wiz-option-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(185px, 1fr)); gap: 12px; }
    .wiz-opt-card { background: #111117; border: 1px solid rgba(255,255,255,.07); padding: 18px 16px; cursor: pointer; text-align: left; position: relative; transition: border-color .25s, box-shadow .25s, transform .2s; }
    .wiz-opt-card:hover { border-color: rgba(255,107,53,.32); transform: translateY(-2px); }
    .wiz-opt-card.active { border-color: var(--accent2); box-shadow: 0 0 0 1px rgba(255,107,53,.28), 0 0 18px rgba(255,107,53,.14); }
    .wiz-opt-card-check { display: none; position: absolute; top: 10px; right: 10px; color: var(--accent2); font-size: 13px; font-weight: 700; }
    .wiz-opt-card.active .wiz-opt-card-check { display: block; }
    .wiz-opt-name { font-family: 'Bebas Neue', cursive; font-size: 17px; letter-spacing: .05em; color: #fff; line-height: 1; margin-bottom: 6px; }
    .wiz-opt-price { font-family: 'Space Mono', monospace; font-size: 8.5px; letter-spacing: .07em; color: var(--accent2); }
    .wiz-section-lbl { font-family: 'Space Mono', monospace; font-size: 8.5px; letter-spacing: .3em; text-transform: uppercase; color: rgba(255,255,255,.28); margin-bottom: 14px; margin-top: 28px; }
    .wiz-check-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .wiz-check-item { display: flex; align-items: center; gap: 12px; background: #111117; border: 1px solid rgba(255,255,255,.07); padding: 12px 14px; cursor: pointer; transition: border-color .25s, background .25s; }
    .wiz-check-item.checked { border-color: var(--accent2); background: rgba(255,107,53,.05); }
    .wiz-checkbox { width: 15px; height: 15px; flex-shrink: 0; border: 1.5px solid rgba(255,255,255,.22); background: transparent; display: flex; align-items: center; justify-content: center; transition: border-color .25s, background .25s; }
    .wiz-check-item.checked .wiz-checkbox { border-color: var(--accent2); background: var(--accent2); }
    .wiz-checkbox-tick { color: #fff; font-size: 9px; display: none; }
    .wiz-check-item.checked .wiz-checkbox-tick { display: block; }
    .wiz-check-name { font-family: 'Rajdhani', sans-serif; font-size: 13px; font-weight: 500; color: #fff; }
    .wiz-check-price { font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .07em; color: var(--accent2); }
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
    .wiz-total-lbl { font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .3em; text-transform: uppercase; color: var(--accent2); }
    .wiz-total-val { font-family: 'Bebas Neue', cursive; font-size: 32px; letter-spacing: .05em; color: var(--accent2); }
    .wiz-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .wiz-full { grid-column: 1 / -1; }
    .wiz-lbl { display: block; font-family: 'Space Mono', monospace; font-size: 8px; letter-spacing: .28em; text-transform: uppercase; color: rgba(255,255,255,.3); margin-bottom: 7px; }
    .wiz-input, .wiz-textarea { width: 100%; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); color: #fff; font-family: 'Rajdhani', sans-serif; font-size: 15px; padding: 11px 14px; outline: none; transition: border-color .25s, background .25s; appearance: none; -webkit-appearance: none; }
    .wiz-input:focus, .wiz-textarea:focus { border-color: var(--accent2); background: rgba(255,107,53,.04); }
    .wiz-textarea { resize: vertical; min-height: 80px; }
    .wiz-final-btns { display: flex; gap: 11px; margin-top: 16px; }
    .wiz-btn-devis { flex: 1; font-family: 'Space Mono', monospace; font-size: 9px; letter-spacing: .18em; text-transform: uppercase; background: transparent; color: rgba(255,255,255,.55); border: 1px solid rgba(255,255,255,.18); padding: 13px; cursor: pointer; transition: color .25s, border-color .25s; clip-path: polygon(0 0,calc(100% - 7px) 0,100% 7px,100% 100%,7px 100%,0 calc(100% - 7px)); }
    .wiz-btn-devis:hover { color: #fff; border-color: rgba(255,255,255,.4); }
    .wiz-btn-confirm-buy { flex: 2; font-family: 'Space Mono', monospace; font-size: 10px; letter-spacing: .18em; text-transform: uppercase; background: var(--accent2); color: #fff; border: none; padding: 13px; cursor: pointer; transition: filter .25s; clip-path: polygon(0 0,calc(100% - 7px) 0,100% 7px,100% 100%,7px 100%,0 calc(100% - 7px)); }
    .wiz-btn-confirm-buy:hover { filter: brightness(1.18); }
    .wiz-success-msg { display: none; text-align: center; padding: 40px 20px; }
    .wiz-success-check { font-size: 50px; color: var(--accent2); margin-bottom: 14px; }
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

  <!-- ── BG TRACK ────────────────────────── -->
  <div id="bgTrack"></div>

  <!-- ── NAV ───────────────────────────────── -->
  <nav>
    <div class="nav-logo"><img src="assets/images/carthacars.jpg" alt="CARTHA CARS" class="nav-logo-img">CARTHA<em>.</em>CARS</div>
    <ul class="nav-links">
      <li><a href="index.php" class="active">SUPERCARS</a></li>
      <li><a href="pages/luxury.php" data-nav>LUXURY</a></li>
      <li><a href="pages/standard.php" data-nav>STANDARD</a></li>
      <li><button class="nav-btn-text" id="navPartners">CONFIGURATEUR</button></li>
      <li><a href="#" id="navContact">CONTACT</a></li>
    </ul>
    <!-- Hidden anchors preserved so script.js getElementById calls don't error -->
    <a href="#" id="navModels"    style="display:none" tabindex="-1"></a>
    <a href="#" id="navConfigure" style="display:none" tabindex="-1"></a>
    <a href="#" id="nav3dView"    style="display:none" tabindex="-1"></a>
    <a href="#" id="navShowrooms" style="display:none" tabindex="-1"></a>
    <a href="#" id="navHeritage"  style="display:none" tabindex="-1"></a>
    <button class="nav-cta-outline" id="navFinancing">Financement</button>
    <button class="nav-cta" id="navCta">Essai Routier</button>
  </nav>
  <div class="nav-underline"></div>

  <!-- ── CORNER BRACKETS ──────────────────── -->
  <div class="bracket tl"></div>
  <div class="bracket tr"></div>
  <div class="bracket bl"></div>
  <div class="bracket br"></div>

  <!-- ── PROGRESS BAR ─────────────────────── -->
  <div id="progressBar"></div>

  <!-- ── SLIDE INDICATORS ─────────────────── -->
  <div id="indicators"></div>

  <!-- ── SLIDE COUNTER ────────────────────── -->
  <div class="slide-counter">
    <span id="counterCurrent">01</span>
    <span class="counter-sep"> / </span>
    <span id="counterTotal">04</span>
  </div>

  <!-- ── MAIN CONTENT ──────────────────────── -->
  <div id="content">

    <div id="headlineBlock">
      <div class="badge">
        <div class="badge-dot"></div>
        <span id="badgeText">Disponible Maintenant</span>
      </div>
      <div class="headline">
        <span class="hl-solid"    id="hl1">FERRARI</span>
        <span class="hl-outline"  id="hl2">SF90</span>
        <span class="hl-gradient" id="hl3">STRADALE</span>
      </div>
      <p class="subtitle" id="subtitle">The pinnacle of Ferrari engineering.</p>
      <div class="cta-group">
        <button class="btn-buy-cta"   id="ctaBuy">Acheter</button>
        <button class="btn-primary"   id="ctaConfig" style="display:none">Configurer</button>
        <button class="btn-secondary" id="ctaFilm">Voir le Film</button>
        <button class="btn-secondary" id="ctaTestDrive">Essai Routier</button>
      </div>
    </div>

    <div id="statsCard">
      <div class="stats-label">Caractéristiques</div>
      <div id="statsRows"></div>
      <div class="stats-base-price">
        <span class="stats-price-label">À partir de</span>
        <span class="stats-price-value" id="basePrice">$625,000</span>
      </div>
    </div>

  </div>

  <!-- ── TICKER BAR ────────────────────────── -->
  <div class="ticker-bar">
    <div class="ticker-label">En&nbsp;Direct</div>
    <div class="ticker-track">
      <div class="ticker-inner" id="tickerInner"></div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       CONFIGURATOR PANEL
  ══════════════════════════════════════════ -->
  <div id="configOverlay" class="config-overlay">
    <div class="config-backdrop" id="configBackdrop"></div>
    <div id="configPanel" class="config-panel">

      <div class="config-header">
        <div class="config-header-info">
          <span class="config-header-label">Configuration de</span>
          <span class="config-header-car" id="configCarName">FERRARI SF90 STRADALE</span>
        </div>
        <button class="config-close" id="configClose" aria-label="Close">✕</button>
      </div>

      <div class="config-steps-bar" id="configStepsBar"></div>
      <div class="config-step-counter" id="configStepCounter">Étape 1 sur 5</div>
      <div class="config-content" id="configContent"></div>

      <div class="config-footer">
        <div class="config-price-wrap">
          <span class="config-price-label">Configuration Totale</span>
          <span class="config-price-value" id="configTotalPrice">$625,000</span>
        </div>
        <div class="config-nav-buttons">
          <button class="config-btn-prev" id="configPrev">← Retour</button>
          <button class="config-btn-next" id="configNext">Continuer →</button>
        </div>
      </div>

    </div>
  </div>

  <!-- ══════════════════════════════════════════
       FILM MODAL
  ══════════════════════════════════════════ -->
  <div id="filmModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.95); z-index:99999; align-items:center; justify-content:center;">
    <button id="filmClose" aria-label="Close film" style="position:absolute; top:20px; right:24px; width:44px; height:44px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.3); color:#fff; font-size:20px; cursor:pointer; display:flex; align-items:center; justify-content:center; z-index:1; font-family:monospace; line-height:1;">✕</button>
    <div style="width:min(960px,94vw); position:relative; padding-top:min(54vw,540px);">
      <iframe id="filmIframe" src="" frameborder="0"
        allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
        allowfullscreen title="CARTHA CARS Film"
        style="position:absolute; inset:0; width:100%; height:100%; border:none;"></iframe>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       CONTACT MODAL
  ══════════════════════════════════════════ -->
  <div id="contactOverlay" class="modal-overlay">
    <div class="modal-backdrop" id="contactBackdrop"></div>

    <div class="contact-modal">

      <div class="contact-modal-header">
        <div>
          <span class="modal-label">CARTHA CARS</span>
          <div class="modal-title-text">Nous Contacter</div>
        </div>
        <button class="config-close" id="contactClose" aria-label="Fermer">✕</button>
      </div>

      <div class="contact-body">

        <!-- LEFT — FORMULAIRE DE CONTACT -->
        <div class="contact-left">
          <form id="contactForm" action="pages/contact_process.php" method="POST" novalidate>
            <div class="form-group">
              <label class="form-label" for="fname">Nom complet</label>
              <input class="form-input" type="text" id="fname" name="nom" placeholder="Votre nom complet" autocomplete="name">
              <span class="form-error" id="fnameErr"></span>
            </div>
            <div class="form-group">
              <label class="form-label" for="femail">Adresse e-mail</label>
              <input class="form-input" type="email" id="femail" name="email" placeholder="votre@email.com" autocomplete="email">
              <span class="form-error" id="femailErr"></span>
            </div>
            <div class="form-group">
              <label class="form-label" for="fphone">
                Téléphone <span class="form-optional">(optionnel)</span>
              </label>
              <input class="form-input" type="tel" id="fphone" name="telephone" placeholder="+216 99 115 308" autocomplete="tel">
            </div>
            <div class="form-group">
              <label class="form-label" for="fmessage">Message</label>
              <textarea class="form-input form-textarea" id="fmessage" name="message"
                placeholder="Parlez-nous de votre configuration idéale..." rows="4"></textarea>
              <span class="form-error" id="fmessageErr"></span>
            </div>
            <button type="submit" class="form-submit">Envoyer →</button>
          </form>

          <div id="formSuccess" class="form-success">
            <div class="form-success-check">✓</div>
            <div class="form-success-title">Message Reçu</div>
            <div class="form-success-sub">
              Notre équipe vous contactera sous 24 heures pour discuter de votre demande.
            </div>
          </div>
        </div>

        <!-- RIGHT — INFOS + DIRECTION -->
        <div class="contact-right">

          <div class="contact-info-section">
            <div class="contact-info-group">
              <div class="contact-info-label">Siège Social</div>
              <div class="contact-info-value">Avenue Habib Bourguiba<br>Tunis 1000, Tunisie</div>
            </div>
            <div class="contact-info-group">
              <div class="contact-info-label">Téléphone</div>
              <div class="contact-info-value">+216 99 115 308</div>
            </div>
            <div class="contact-info-group">
              <div class="contact-info-label">E-mail</div>
              <div class="contact-info-value">contact@carthacars.com</div>
            </div>
          </div>

          <div class="founders-section">
            <div class="founders-header">Direction</div>
            <div class="founders-grid">

              <div class="founder-card">
                <div class="founder-avatar">YT</div>
                <div class="founder-info">
                  <div class="founder-name">Yasmine Tlili</div>
                  <div class="founder-title">Co-Fondateur &amp; PDG</div>
                </div>
              </div>

              <div class="founder-card">
                <div class="founder-avatar">RB</div>
                <div class="founder-info">
                  <div class="founder-name">Ranim Boudhrioua</div>
                  <div class="founder-title">Co-Fondateur &amp; Directeur Technique</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       QUOTE CONFIRMATION MODAL
  ══════════════════════════════════════════ -->
  <div id="quoteOverlay" class="modal-overlay">
    <div class="modal-backdrop" id="quoteBackdrop"></div>
    <div class="quote-modal">
      <button class="config-close quote-close-btn" id="quoteClose" aria-label="Close">✕</button>
      <div class="quote-check">✓</div>
      <div class="quote-title">Devis Soumis</div>
      <div class="quote-sub">
        Nos spécialistes vous contacteront sous 24 heures pour discuter de votre configuration sur mesure.
      </div>
      <div class="quote-details" id="quoteDetails"></div>
      <button class="quote-done-btn" id="quoteDone">Continuer</button>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       FINANCING CALCULATOR MODAL
  ══════════════════════════════════════════ -->
  <div id="financingOverlay" class="modal-overlay">
    <div class="modal-backdrop" id="financingBackdrop"></div>
    <div class="financing-modal">

      <div class="contact-modal-header">
        <div>
          <span class="modal-label">CARTHA CARS</span>
          <div class="modal-title-text">Calculateur de Financement</div>
        </div>
        <button class="config-close" id="financingClose" aria-label="Fermer">✕</button>
      </div>

      <div class="financing-body">

        <div class="financing-field">
          <label class="financing-label">Prix du Véhicule</label>
          <div class="financing-value-display" id="finCarPrice">$625,000</div>
          <div class="financing-hint">Renseigné automatiquement</div>
        </div>

        <div class="financing-field">
          <label class="financing-label">Apport initial — <span id="finDownPct">20%</span></label>
          <div class="financing-value-display" id="finDownValue">$125,000</div>
          <input type="range" class="financing-slider" id="finDownSlider" min="10" max="80" value="20" step="5">
          <div class="financing-slider-bounds">
            <span>10%</span><span>80%</span>
          </div>
        </div>

        <div class="financing-field">
          <label class="financing-label">Durée du Prêt</label>
          <div class="financing-duration-grid" id="finDurationGrid">
            <button type="button" class="financing-duration-btn" data-months="24">24 mois</button>
            <button type="button" class="financing-duration-btn active" data-months="36">36 mois</button>
            <button type="button" class="financing-duration-btn" data-months="48">48 mois</button>
            <button type="button" class="financing-duration-btn" data-months="60">60 mois</button>
          </div>
        </div>

        <div class="financing-field">
          <label class="financing-label">Taux Annuel Fixe</label>
          <div class="financing-rate-row">
            <div class="financing-rate-badge">4,9%</div>
            <div class="financing-hint">TAEG — fixe pour toute la durée</div>
          </div>
        </div>

        <div class="financing-result">
          <div class="financing-monthly">
            <div class="financing-monthly-label">Mensualité Estimée</div>
            <div class="financing-monthly-value" id="finMonthly">—</div>
            <div class="financing-monthly-sub">Capital + intérêts</div>
          </div>
          <div class="financing-breakdown">
            <div class="financing-breakdown-row">
              <span class="financing-breakdown-label">Prix du véhicule</span>
              <span class="financing-breakdown-value" id="finBrkPrice">—</span>
            </div>
            <div class="financing-breakdown-row">
              <span class="financing-breakdown-label">Apport initial</span>
              <span class="financing-breakdown-value" id="finBrkDown">—</span>
            </div>
            <div class="financing-breakdown-row">
              <span class="financing-breakdown-label">Montant emprunté</span>
              <span class="financing-breakdown-value" id="finBrkLoan">—</span>
            </div>
            <div class="financing-breakdown-row">
              <span class="financing-breakdown-label">Total des intérêts</span>
              <span class="financing-breakdown-value" id="finBrkInterest">—</span>
            </div>
            <div class="financing-breakdown-row">
              <span class="financing-breakdown-label">Coût total</span>
              <span class="financing-breakdown-value" id="finBrkTotal">—</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       TEST DRIVE MODAL
  ══════════════════════════════════════════ -->
  <div id="testdriveOverlay" class="modal-overlay">
    <div class="modal-backdrop" id="testdriveBackdrop"></div>
    <div class="testdrive-modal">

      <div class="contact-modal-header">
        <div>
          <span class="modal-label">CARTHA CARS</span>
          <div class="modal-title-text">Réserver un Essai</div>
        </div>
        <button class="config-close" id="testdriveClose" aria-label="Fermer">✕</button>
      </div>

      <div class="testdrive-body">

        <form id="testdriveForm" novalidate>
          <div class="form-group">
            <label class="form-label" for="tdname">Nom complet</label>
            <input class="form-input" type="text" id="tdname" placeholder="Votre nom complet" autocomplete="name">
            <span class="form-error" id="tdnameErr"></span>
          </div>
          <div class="form-group">
            <label class="form-label" for="tdemail">Adresse e-mail</label>
            <input class="form-input" type="email" id="tdemail" placeholder="votre@email.com" autocomplete="email">
            <span class="form-error" id="tdemailErr"></span>
          </div>
          <div class="form-group">
            <label class="form-label" for="tdphone">
              Téléphone <span class="form-optional">(optionnel)</span>
            </label>
            <input class="form-input" type="tel" id="tdphone" placeholder="+216 99 115 308" autocomplete="tel">
          </div>
          <div class="form-group">
            <label class="form-label" for="tdcar">Véhicule Souhaité</label>
            <input class="form-input" type="text" id="tdcar" readonly style="cursor:default;opacity:.75;">
          </div>
          <div class="form-group">
            <label class="form-label" for="tdshowroom">Showroom Préféré</label>
            <select class="form-input" id="tdshowroom">
              <option value="">Choisir un showroom…</option>
              <option value="Tunis">CARTHA CARS TUNIS — Ave Habib Bourguiba</option>
              <option value="Sfax">CARTHA CARS SFAX — Ave Farhat Hached</option>
              <option value="Sousse">CARTHA CARS SOUSSE — Ave Mohamed V</option>
              <option value="Monastir">CARTHA CARS MONASTIR — Ave de l'Indépendance</option>
              <option value="Nabeul">CARTHA CARS NABEUL — Ave Habib Thameur</option>
              <option value="Bizerte">CARTHA CARS BIZERTE — Ave du 7 Novembre</option>
            </select>
            <span class="form-error" id="tdshowroomErr"></span>
          </div>
          <div class="form-group">
            <label class="form-label" for="tddate">Date Souhaitée</label>
            <input class="form-input" type="date" id="tddate">
            <span class="form-error" id="tddateErr"></span>
          </div>
          <button type="submit" class="form-submit">Confirmer la Réservation →</button>
        </form>

        <div id="testdriveSuccess" class="testdrive-success">
          <div class="form-success-check">✓</div>
          <div class="form-success-title">Réservation Confirmée</div>
          <div class="form-success-sub">
            Notre équipe vous contactera sous 24 heures pour confirmer votre rendez-vous d'essai.
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       SHOWROOMS OVERLAY
  ══════════════════════════════════════════ -->
  <div id="showroomsOverlay" class="modal-overlay">
    <div class="modal-backdrop" id="showroomsBackdrop"></div>

    <div class="showrooms-modal">

      <div class="showrooms-header">
        <div>
          <span class="modal-label">Réseau Mondial</span>
          <div class="modal-title-text">Nos Showrooms</div>
        </div>
        <button class="config-close" id="showroomsClose" aria-label="Close">✕</button>
      </div>

      <div class="showrooms-grid">

        <div class="showroom-card showroom-card--hq">
          <div class="showroom-hq-badge">SIÈGE PRINCIPAL</div>
          <div class="showroom-flag">🇹🇳</div>
          <div class="showroom-city">Tunis</div>
          <div class="showroom-country">CARTHA CARS TUNIS</div>
          <div class="showroom-address">Ave Habib Bourguiba, Tunis 1000</div>
          <div class="showroom-phone">+216 99 115 308</div>
          <div class="showroom-hours">Lun – Sam &nbsp;9h00 – 19h00</div>
          <a class="showroom-btn" href="https://maps.google.com/?q=Avenue+Habib+Bourguiba+Tunis+Tunisia" target="_blank" rel="noopener">Itinéraire →</a>
        </div>

        <div class="showroom-card">
          <div class="showroom-flag">🇹🇳</div>
          <div class="showroom-city">Sfax</div>
          <div class="showroom-country">CARTHA CARS SFAX</div>
          <div class="showroom-address">Ave Farhat Hached, Sfax 3000</div>
          <div class="showroom-phone">+216 99 115 308</div>
          <div class="showroom-hours">Lun – Sam &nbsp;9h00 – 19h00</div>
          <a class="showroom-btn" href="https://maps.google.com/?q=Avenue+Farhat+Hached+Sfax+Tunisia" target="_blank" rel="noopener">Itinéraire →</a>
        </div>

        <div class="showroom-card">
          <div class="showroom-flag">🇹🇳</div>
          <div class="showroom-city">Sousse</div>
          <div class="showroom-country">CARTHA CARS SOUSSE</div>
          <div class="showroom-address">Ave Mohamed V, Sousse 4000</div>
          <div class="showroom-phone">+216 99 115 308</div>
          <div class="showroom-hours">Lun – Sam &nbsp;9h00 – 19h00</div>
          <a class="showroom-btn" href="https://maps.google.com/?q=Avenue+Mohamed+V+Sousse+Tunisia" target="_blank" rel="noopener">Itinéraire →</a>
        </div>

        <div class="showroom-card">
          <div class="showroom-flag">🇹🇳</div>
          <div class="showroom-city">Monastir</div>
          <div class="showroom-country">CARTHA CARS MONASTIR</div>
          <div class="showroom-address">Ave de l'Indépendance, Monastir 5000</div>
          <div class="showroom-phone">+216 99 115 308</div>
          <div class="showroom-hours">Lun – Sam &nbsp;9h00 – 19h00</div>
          <a class="showroom-btn" href="https://maps.google.com/?q=Avenue+de+l+Independance+Monastir+Tunisia" target="_blank" rel="noopener">Itinéraire →</a>
        </div>

        <div class="showroom-card">
          <div class="showroom-flag">🇹🇳</div>
          <div class="showroom-city">Nabeul</div>
          <div class="showroom-country">CARTHA CARS NABEUL</div>
          <div class="showroom-address">Ave Habib Thameur, Nabeul 8000</div>
          <div class="showroom-phone">+216 99 115 308</div>
          <div class="showroom-hours">Lun – Sam &nbsp;9h00 – 19h00</div>
          <a class="showroom-btn" href="https://maps.google.com/?q=Avenue+Habib+Thameur+Nabeul+Tunisia" target="_blank" rel="noopener">Itinéraire →</a>
        </div>

        <div class="showroom-card">
          <div class="showroom-flag">🇹🇳</div>
          <div class="showroom-city">Bizerte</div>
          <div class="showroom-country">CARTHA CARS BIZERTE</div>
          <div class="showroom-address">Ave du 7 Novembre, Bizerte 7000</div>
          <div class="showroom-phone">+216 99 115 308</div>
          <div class="showroom-hours">Lun – Sam &nbsp;9h00 – 19h00</div>
          <a class="showroom-btn" href="https://maps.google.com/?q=Avenue+du+7+Novembre+Bizerte+Tunisia" target="_blank" rel="noopener">Itinéraire →</a>
        </div>

      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       3D VIEWER SECTION
  ══════════════════════════════════════════ -->
  <div id="viewerOverlay" class="viewer-overlay">

    <!-- Three.js canvas — fills the whole overlay -->
    <canvas id="viewerCanvas"></canvas>

    <!-- Floating UI layer -->
    <div class="viewer-ui">
      <div class="viewer-top">
        <div class="viewer-top-row">
          <div>
            <div class="viewer-top-label" id="viewerCarLabel">FERRARI SF90 STRADALE</div>
            <div class="viewer-title">3D<em>.</em>VIEW</div>
          </div>
          <button class="viewer-close-btn" id="viewerClose" aria-label="Close 3D view">✕</button>
        </div>
        <div class="viewer-selector">
          <button class="viewer-sel-btn active" data-car="0">FERRARI SF90</button>
          <button class="viewer-sel-btn" data-car="1">PORSCHE 911</button>
          <button class="viewer-sel-btn" data-car="2">BUGATTI CHIRON</button>
          <button class="viewer-sel-btn" data-car="3">MERCEDES AMG GT</button>
        </div>
      </div>
      <div class="viewer-bottom">
        <div class="viewer-hint" id="viewerHint">
          <span class="viewer-hint-icon">⟳</span>
          FAITES GLISSER POUR EXPLORER
        </div>
      </div>
    </div>

    <!-- Loading indicator -->
    <div class="viewer-loader" id="viewerLoader">
      <div class="viewer-loader-label">Chargement du modèle 3D</div>
      <div class="viewer-loader-track">
        <div class="viewer-loader-fill" id="viewerLoaderFill"></div>
      </div>
    </div>

  </div>

  <!-- ── TOAST ─────────────────────────────── -->
  <div id="toast" class="toast"></div>

  <script src="script.js?v=3"></script>

  <!-- 3D VIEWER — ES module (deferred, runs after script.js) -->
  <script type="module">
  import * as THREE            from 'three';
  import { GLTFLoader }        from 'three/addons/loaders/GLTFLoader.js';
  import { DRACOLoader }       from 'three/addons/loaders/DRACOLoader.js';
  import { OrbitControls }     from 'three/addons/controls/OrbitControls.js';

  const CARS = [
    { label: 'FERRARI SF90 STRADALE',  file: 'assets/models/2020_ferrari_sf90_stradale.glb'   },
    { label: 'PORSCHE 911 CARRERA 4S', file: 'assets/models/free_porsche_911_carrera_4s.glb'  },
    { label: 'BUGATTI CHIRON',         file: 'assets/models/bugatti_chiron_top_edition.glb'    },
    { label: 'MERCEDES AMG GT',        file: 'assets/models/mercedes_amg_gt.glb'              },
  ];

  const overlay  = document.getElementById('viewerOverlay');
  const canvas   = document.getElementById('viewerCanvas');
  const hintEl   = document.getElementById('viewerHint');
  const loaderEl = document.getElementById('viewerLoader');
  const fillEl   = document.getElementById('viewerLoaderFill');
  const labelEl  = document.getElementById('viewerCarLabel');
  const closeBtn = document.getElementById('viewerClose');
  const selBtns  = document.querySelectorAll('.viewer-sel-btn');

  let renderer, scene, camera, controls, animId;
  let carModel    = null;
  let autoRotate  = true;
  let initialized = false;
  let activeIdx   = 0;
  let loading     = false;

  // Shared loaders — created once at module level
  const draco = new DRACOLoader();
  draco.setDecoderPath('https://cdn.jsdelivr.net/npm/three@0.169.0/examples/jsm/libs/draco/');
  const gltfLoader = new GLTFLoader();
  gltfLoader.setDRACOLoader(draco);

  /* ─── Scene setup ─────────────────────────────────── */
  function initScene() {
    const W = canvas.clientWidth;
    const H = canvas.clientHeight;

    renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(W, H, false);
    renderer.outputColorSpace    = THREE.SRGBColorSpace;
    renderer.shadowMap.enabled   = true;
    renderer.shadowMap.type      = THREE.PCFSoftShadowMap;
    renderer.toneMapping         = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.4;

    scene = new THREE.Scene();
    scene.background = new THREE.Color(0x07070a);
    scene.fog        = new THREE.FogExp2(0x07070a, 0.032);

    camera = new THREE.PerspectiveCamera(38, W / H, 0.1, 200);
    camera.position.set(5, 2.5, 8);

    scene.add(new THREE.HemisphereLight(0xfff0e0, 0x080814, 0.7));

    const key = new THREE.DirectionalLight(0xfff4e0, 3.2);
    key.position.set(6, 10, 6);
    key.castShadow = true;
    key.shadow.mapSize.set(2048, 2048);
    key.shadow.camera.near   =  0.5;
    key.shadow.camera.far    = 40;
    key.shadow.camera.left   = -8;
    key.shadow.camera.right  =  8;
    key.shadow.camera.top    =  8;
    key.shadow.camera.bottom = -8;
    key.shadow.bias = -0.001;
    scene.add(key);

    const fill = new THREE.DirectionalLight(0x6080ff, 1.2);
    fill.position.set(-8, 4, 2);
    scene.add(fill);

    const rim = new THREE.DirectionalLight(0xff8040, 2.0);
    rim.position.set(0, 5, -10);
    scene.add(rim);

    const under = new THREE.PointLight(0xff3010, 2.5, 10, 2);
    under.position.set(0, -0.5, 0);
    scene.add(under);

    const floorMat = new THREE.MeshStandardMaterial({ color: 0x080812, roughness: 0.12, metalness: 0.95 });
    const floor    = new THREE.Mesh(new THREE.PlaneGeometry(50, 50), floorMat);
    floor.rotation.x = -Math.PI / 2;
    floor.receiveShadow = true;
    scene.add(floor);

    controls = new OrbitControls(camera, canvas);
    controls.enableDamping = true;
    controls.dampingFactor = 0.06;
    controls.minDistance   = 2;
    controls.maxDistance   = 22;
    controls.maxPolarAngle = Math.PI / 2 - 0.04;
    controls.target.set(0, 0.8, 0);
    controls.update();
    controls.addEventListener('start', dismissHint);

    window.addEventListener('resize', onResize);
    animate();
    loadCar(0);
  }

  /* ─── Dispose model ───────────────────────────────── */
  function disposeModel(model) {
    if (!model) return;
    model.traverse(child => {
      if (child.isMesh) {
        child.geometry?.dispose();
        if (Array.isArray(child.material)) {
          child.material.forEach(m => m.dispose());
        } else {
          child.material?.dispose();
        }
      }
    });
    scene.remove(model);
  }

  /* ─── Load car by index ───────────────────────────── */
  function loadCar(idx) {
    if (loading || (idx === activeIdx && carModel)) return;
    loading = true;

    selBtns.forEach((btn, i) => btn.classList.toggle('active', i === idx));
    if (labelEl) labelEl.textContent = CARS[idx].label;

    loaderEl.classList.remove('viewer-loader--gone');
    if (fillEl) fillEl.style.width = '0%';
    const loaderLbl = loaderEl.querySelector('.viewer-loader-label');
    if (loaderLbl) loaderLbl.textContent = 'Chargement du modèle 3D';

    disposeModel(carModel);
    carModel = null;

    gltfLoader.load(
      CARS[idx].file,
      gltf => {
        activeIdx = idx;
        loading   = false;
        carModel  = gltf.scene;

        const box    = new THREE.Box3().setFromObject(carModel);
        const center = box.getCenter(new THREE.Vector3());
        const size   = box.getSize(new THREE.Vector3());
        carModel.position.x -= center.x;
        carModel.position.z -= center.z;
        carModel.position.y -= box.min.y;

        carModel.traverse(child => {
          if (child.isMesh) { child.castShadow = true; child.receiveShadow = true; }
        });
        scene.add(carModel);

        const span = Math.max(size.x, size.z);
        camera.position.set(span * 1.2, span * 0.5, span * 1.8);
        controls.target.set(0, size.y * 0.38, 0);
        controls.minDistance = span * 0.4;
        controls.maxDistance = span * 5;
        controls.update();

        autoRotate = true;
        loaderEl.classList.add('viewer-loader--gone');
      },
      xhr => {
        if (xhr.total && fillEl) fillEl.style.width = (xhr.loaded / xhr.total * 100) + '%';
      },
      err => {
        console.error('GLB load error:', err);
        loading = false;
        if (loaderLbl) loaderLbl.textContent = 'Modèle indisponible.';
      }
    );
  }

  /* ─── Hint ────────────────────────────────────────── */
  function dismissHint() {
    autoRotate = false;
    hintEl.classList.add('viewer-hint--out');
    controls.removeEventListener('start', dismissHint);
  }

  /* ─── Render loop ─────────────────────────────────── */
  function animate() {
    animId = requestAnimationFrame(animate);
    if (autoRotate && carModel) carModel.rotation.y += 0.004;
    controls.update();
    renderer.render(scene, camera);
  }

  function onResize() {
    if (!renderer) return;
    const W = canvas.clientWidth, H = canvas.clientHeight;
    camera.aspect = W / H;
    camera.updateProjectionMatrix();
    renderer.setSize(W, H, false);
  }

  /* ─── Open / Close ────────────────────────────────── */
  function openViewer() {
    overlay.classList.add('active');
    window.viewerOpen = true;
    if (!initialized) {
      initialized = true;
      setTimeout(initScene, 0);
    } else {
      autoRotate = true;
      if (!animId) animate();
    }
  }

  function closeViewer() {
    overlay.classList.remove('active');
    window.viewerOpen = false;
    if (animId) { cancelAnimationFrame(animId); animId = null; }
  }

  window.openViewer  = openViewer;
  window.closeViewer = closeViewer;
  window.viewerOpen  = false;

  closeBtn.addEventListener('click', closeViewer);

  selBtns.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      if (!loading && i !== activeIdx) loadCar(i);
    });
  });
  </script>

  <!-- ACHETER WIZARD MODAL -->
  <div class="buy-wiz-overlay" id="buyOverlayIdx">
    <div class="wiz-prog-track"><div class="wiz-prog-fill" id="buyProgFillIdx"></div></div>
    <button class="wiz-close" id="buyCloseIdx" aria-label="Fermer">✕</button>
    <div class="wiz-steps-row" id="buyStepsRowIdx"></div>
    <div class="wiz-body" id="buyWizBodyIdx"></div>
    <div class="wiz-nav">
      <button class="wiz-btn-prev" id="buyPrevIdx">← PRÉCÉDENT</button>
      <button class="wiz-btn-next" id="buyNextIdx">SUIVANT →</button>
    </div>
  </div>

  <!-- NOS PARTENAIRES MODAL -->
  <div class="partners-ov" id="partnersOvIdx">
    <div class="partners-box">
      <button class="p-close" id="partnersCloseIdx">✕</button>
      <div class="p-eyebrow">RÉSEAU DE PARTENAIRES</div>
      <div class="p-title">NOS PARTENAIRES</div>
      <div class="p-rule"></div>
      <div class="p-grid">
        <div class="p-card">
          <div class="p-name">AutoStyle Tunis</div>
          <div class="p-spec">Préparation sportive &amp; tuning</div>
          <div class="p-addr">Tunis Zone Industrielle<br>+216 71 000 001</div>
          <a class="p-wa" href="https://wa.me/21671000001?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
        </div>
        <div class="p-card">
          <div class="p-name">Prestige Custom Sfax</div>
          <div class="p-spec">Sellerie sur mesure &amp; intérieur luxe</div>
          <div class="p-addr">Sfax Centre<br>+216 74 000 002</div>
          <a class="p-wa" href="https://wa.me/21674000002?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
        </div>
        <div class="p-card">
          <div class="p-name">TechMotor Sousse</div>
          <div class="p-spec">Performance &amp; optimisation moteur</div>
          <div class="p-addr">Sousse Route de Monastir<br>+216 73 000 003</div>
          <a class="p-wa" href="https://wa.me/21673000003?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
        </div>
        <div class="p-card">
          <div class="p-name">Elite Wrap Tunis</div>
          <div class="p-spec">Covering &amp; wrapping premium</div>
          <div class="p-addr">Ariana Tunis<br>+216 71 000 004</div>
          <a class="p-wa" href="https://wa.me/21671000004?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
        </div>
        <div class="p-card">
          <div class="p-name">CarSound Pro</div>
          <div class="p-spec">Audio haute fidélité &amp; électronique</div>
          <div class="p-addr">La Marsa Tunis<br>+216 71 000 005</div>
          <a class="p-wa" href="https://wa.me/21671000005?text=Bonjour%2C%20je%20souhaite%20personnaliser%20mon%20v%C3%A9hicule%20CarthaCars" target="_blank" rel="noopener">✆ CONTACTER CE PARTENAIRE</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ACCUEIL button -->
  <a href="accueil.php" class="btn-home" data-nav>← ACCUEIL</a>

  <!-- Page transition overlay -->
  <div id="pageTransition"></div>

  <script>
  /* ── ACHETER WIZARD ─────────────────────────── */
  (function () {
    const OVL  = document.getElementById('buyOverlayIdx');
    const FILL = document.getElementById('buyProgFillIdx');
    const BODY = document.getElementById('buyWizBodyIdx');
    const PREV = document.getElementById('buyPrevIdx');
    const NEXT = document.getElementById('buyNextIdx');
    const SROW = document.getElementById('buyStepsRowIdx');
    const STEP_NAMES = ['VÉHICULE','COULEUR','INTÉRIEUR','JANTES','OPTIONS','RÉCAP'];

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
      { name:'Cuir Pleine Fleur', delta:8000 },
      { name:'Cuir Nappa',        delta:12000 },
      { name:'Alcantara',         delta:10000 },
      { name:'Bois et Cuir',      delta:9000 },
      { name:'Carbone et Cuir',   delta:15000 },
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

    const S = { color:0, interior:0, jantes:0, audio:0, opts:[], step:0, carName:'', carBase:0, carImg:'' };

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
      BODY.innerHTML = stepHdr(1,'VOTRE VÉHICULE','Votre sélection') +
        `<div class="wiz-car-display">
          <img class="wiz-car-img" src="${S.carImg}" alt="${S.carName}">
          <div class="wiz-car-info">
            <div class="wiz-car-name-big">${S.carName}</div>
            <div class="wiz-car-price-big">${fmt(S.carBase)}</div>
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
      const extraRows = [];
      if (INTERIORS[S.interior].delta>0) extraRows.push(`<div class="wiz-sum-extra-row"><span>Intérieur — ${INTERIORS[S.interior].name}</span><span>+${fmt(INTERIORS[S.interior].delta)}</span></div>`);
      if (JANTES[S.jantes].delta>0)     extraRows.push(`<div class="wiz-sum-extra-row"><span>Jantes — ${JANTES[S.jantes].name}</span><span>+${fmt(JANTES[S.jantes].delta)}</span></div>`);
      if (AUDIO[S.audio].delta>0)        extraRows.push(`<div class="wiz-sum-extra-row"><span>Audio — ${AUDIO[S.audio].name}</span><span>+${fmt(AUDIO[S.audio].delta)}</span></div>`);
      S.opts.forEach(i => extraRows.push(`<div class="wiz-sum-extra-row"><span>${OPTS[i].name}</span><span>+${fmt(OPTS[i].delta)}</span></div>`));
      const extras = INTERIORS[S.interior].delta + JANTES[S.jantes].delta + AUDIO[S.audio].delta + S.opts.reduce((a,i)=>a+OPTS[i].delta,0);
      const total  = S.carBase + extras;
      BODY.innerHTML = stepHdr(6,'RÉCAPITULATIF','Votre configuration complète') +
        `<div class="wiz-summary-box">
          <div class="wiz-sum-rows">
            <div class="wiz-sum-row"><span class="wiz-sum-lbl">Véhicule</span><span class="wiz-sum-val">${S.carName}</span></div>
            <div class="wiz-sum-row"><span class="wiz-sum-lbl">Couleur</span><span class="wiz-sum-val">${COLORS[S.color].name}</span></div>
            <div class="wiz-sum-row"><span class="wiz-sum-lbl">Intérieur</span><span class="wiz-sum-val">${INTERIORS[S.interior].name}</span></div>
            <div class="wiz-sum-row"><span class="wiz-sum-lbl">Jantes</span><span class="wiz-sum-val">${JANTES[S.jantes].name}</span></div>
            <div class="wiz-sum-row"><span class="wiz-sum-lbl">Audio</span><span class="wiz-sum-val">${AUDIO[S.audio].name}</span></div>
          </div>
          <div class="wiz-sum-sep"></div>
          <div class="wiz-sum-row"><span class="wiz-sum-lbl">Prix de base</span><span class="wiz-sum-val">${fmt(S.carBase)}</span></div>
          ${extraRows.length?`<div class="wiz-sum-extras">${extraRows.join('')}</div>`:''}
          <div class="wiz-sum-sep"></div>
          <div class="wiz-total-row"><span class="wiz-total-lbl">TOTAL FINAL</span><span class="wiz-total-val">${fmt(total)}</span></div>
        </div>
        <div class="wiz-form-grid" id="wizFormGridIdx">
          <div><label class="wiz-lbl">Nom</label><input class="wiz-input" id="wizNomIdx" type="text" placeholder="Votre nom"></div>
          <div><label class="wiz-lbl">Prénom</label><input class="wiz-input" id="wizPrenomIdx" type="text" placeholder="Votre prénom"></div>
          <div><label class="wiz-lbl">Téléphone</label><input class="wiz-input" id="wizTelephoneIdx" type="tel" placeholder="+216 XX XXX XXX"></div>
          <div><label class="wiz-lbl">Email</label><input class="wiz-input" id="wizEmailIdx" type="email" placeholder="votre@email.com"></div>
          <div class="wiz-full"><label class="wiz-lbl">Message (optionnel)</label><textarea class="wiz-textarea" id="wizMessageIdx" placeholder="Vos souhaits particuliers..."></textarea></div>
        </div>
        <div class="wiz-final-btns" id="wizFinalBtnsIdx">
          <button class="wiz-btn-devis" id="wizDevisIdx">DEMANDER UN DEVIS</button>
          <button class="wiz-btn-confirm-buy" id="wizConfirmIdx">CONFIRMER L'ACHAT</button>
        </div>
        <div class="wiz-success-msg" id="wizSuccessIdx" style="display:none">
          <div class="wiz-success-check">✓</div>
          <div class="wiz-success-title">Configuration envoyée !</div>
          <div class="wiz-success-sub">Votre configuration a été envoyée. Notre équipe vous contactera sous 24h.</div>
        </div>`;
      async function sendForm(orderType) {
        const nom = document.getElementById('wizNomIdx').value.trim();
        const prenom = document.getElementById('wizPrenomIdx').value.trim();
        const telephone = document.getElementById('wizTelephoneIdx').value.trim();
        const email = document.getElementById('wizEmailIdx').value.trim();
        const message = document.getElementById('wizMessageIdx').value.trim();
        const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

        if (!nom || !prenom || !telephone || !emailRx.test(email)) {
          alert('Veuillez remplir nom, prénom, téléphone et email valide.');
          return;
        }

        const payload = new FormData();
        payload.append('order_type', orderType);
        payload.append('source', 'supercars');
        payload.append('car_name', S.carName);
        payload.append('base_price', S.carBase);
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

        const btns = document.querySelectorAll('#wizFinalBtnsIdx button');
        btns.forEach(btn => btn.disabled = true);

        try {
          const response = await fetch('orders/create.php', { method: 'POST', body: payload, headers: { 'Accept': 'application/json' } });
          const result = await response.json();
          if (!response.ok || !result.success) throw new Error(result.message || 'Erreur lors de l envoi.');

          document.getElementById('wizSuccessIdx').style.display = 'flex';
          document.getElementById('wizFormGridIdx').style.display = 'none';
          document.getElementById('wizFinalBtnsIdx').style.display = 'none';
        } catch (err) {
          alert(err.message || 'Impossible d enregistrer la commande.');
        } finally {
          btns.forEach(btn => btn.disabled = false);
        }
      }
      document.getElementById('wizDevisIdx').addEventListener('click', () => sendForm('quote'));
      document.getElementById('wizConfirmIdx').addEventListener('click', () => sendForm('purchase'));
    }

    STEP_NAMES.forEach((name, i) => {
      const el = document.createElement('div');
      el.className = 'wiz-step';
      el.innerHTML = `<div class="wiz-step-dot">${i+1}</div><div class="wiz-step-lbl">${name}</div>`;
      SROW.appendChild(el);
    });

    function openWizard() {
      const slide = (typeof SLIDES !== 'undefined' && typeof current !== 'undefined') ? SLIDES[current] : null;
      S.carName = slide ? slide.lines.join(' ') : '';
      S.carBase = slide ? slide.basePrice : 0;
      S.carImg  = slide ? slide.img : '';
      S.color = 0; S.interior = 0; S.jantes = 0; S.audio = 0; S.opts = []; S.step = 0;
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

    const ctaBuy = document.getElementById('ctaBuy');
    if (ctaBuy) ctaBuy.addEventListener('click', openWizard);
    document.getElementById('buyCloseIdx').addEventListener('click', closeWizard);
    OVL.addEventListener('click', e => { if (e.target === OVL) closeWizard(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && OVL.classList.contains('open')) closeWizard(); });
    PREV.addEventListener('click', () => { if (S.step > 0) { S.step--; render(); } });
    NEXT.addEventListener('click', () => { if (S.step < 5) { S.step++; render(); } });
  })();

  /* ── NOS PARTENAIRES MODAL ─────────────────── */
  (function () {
    const ov  = document.getElementById('partnersOvIdx');
    const cls = document.getElementById('partnersCloseIdx');
    const btn = document.getElementById('navPartners');
    function open()  { ov.classList.add('open');    document.body.style.overflow = 'hidden'; }
    function close() { ov.classList.remove('open'); document.body.style.overflow = ''; }
    if (btn) btn.addEventListener('click', open);
    cls.addEventListener('click', close);
    ov.addEventListener('click', e => { if (e.target === ov) close(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && ov.classList.contains('open')) close(); });
  })();

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
  </script>
</body>
</html>
