/* ════════════════════════════════════════════════════
   SLIDE DATA
════════════════════════════════════════════════════ */
const SLIDES = [
  {
    img:      'https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&w=1920&q=80',
    fallback: '#1a0400',
    badge:    'Disponible Maintenant',
    brand:    'FERRARI',
    lines:    ['FERRARI', 'SF90', 'STRADALE'],
    subtitle: 'Le summum de l\'ingénierie Ferrari. 986 ch en hybride, cette hypercar repousse les limites entre voiture de route et voiture de course.',
    stats: [
      { name: 'Vitesse max', value: '340',   unit: 'km/h' },
      { name: '0 – 100',   value: '2.5',   unit: 'sec'  },
      { name: 'Puissance',     value: '986',   unit: 'hp'   },
      { name: 'Poids',    value: '1,570', unit: 'kg'   },
    ],
    basePrice: 625000,
    accent:  '#FF2D20',
    accent2: '#FF6B35',
    // YouTube: Ferrari SF90 Stradale — starts at 0:19
    filmId: 'MvVXL-vBQs0',
    filmStart: 19,
    colors: [
      { name: 'Rosso Corsa',        hex: '#CC0000' },
      { name: 'Nero Daytona',       hex: '#1C1C1C' },
      { name: 'Bianco Italia',      hex: '#EDEDE8' },
      { name: 'Blu Tour de France', hex: '#003082' },
      { name: 'Giallo Modena',      hex: '#F5C518' },
      { name: 'Verde Abetone',      hex: '#2E5339' },
    ],
  },
  {
    img:      'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=1920&q=80',
    fallback: '#00060f',
    badge:    'Hyper Exclusif',
    brand:    'BUGATTI',
    lines:    ['BUGATTI', 'CHIRON', 'SPORT'],
    subtitle: 'La Chiron est la super sportive de série la plus puissante, la plus rapide et la plus exclusive de l\'histoire de BUGATTI.',
    stats: [
      { name: 'Vitesse max', value: '420',   unit: 'km/h' },
      { name: '0 – 100',   value: '2.4',   unit: 'sec'  },
      { name: 'Puissance',     value: '1,500', unit: 'hp'   },
      { name: 'Poids',    value: '1,995', unit: 'kg'   },
    ],
    basePrice: 3200000,
    accent:  '#FF6B00',
    accent2: '#FF9500',
    // YouTube: Bugatti Chiron 0-400-0 speed record run
    filmId: 'PkkV1vLHUvQ',
    colors: [
      { name: 'Bleu Royal',     hex: '#003F8A' },
      { name: 'Nocturne',       hex: '#0A0A12' },
      { name: 'Blanc Pur',      hex: '#F5F5F0' },
      { name: 'Gris Rafale',    hex: '#7A7D80' },
      { name: 'Rouge Drapeau',  hex: '#CC0000' },
      { name: 'Sky View',       hex: '#A8D8EA' },
    ],
  },
  {
    img:      'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1920&q=80',
    fallback: '#0d0d0d',
    badge:    'Choix du Collectionneur',
    brand:    'PORSCHE',
    lines:    ['PORSCHE', '911 GT3', 'RS 4.0'],
    subtitle: 'Un flat-six 4,0 L hurlant à 9 000 tr/min. La voiture de course routière la plus emblématique de l\'histoire, perfectionnée aérodynamiquement.',
    stats: [
      { name: 'Vitesse max', value: '296',   unit: 'km/h' },
      { name: '0 – 100',   value: '3.2',   unit: 'sec'  },
      { name: 'Puissance',     value: '518',   unit: 'hp'   },
      { name: 'Poids',    value: '1,450', unit: 'kg'   },
    ],
    basePrice: 225250,
    accent:  '#C0C0C0',
    accent2: '#E8E8E8',
    // YouTube: Porsche 911 GT3 RS top speed & lap record
    filmId: '2RS07NJ6boQ',
    colors: [
      { name: 'GT Silver Metallic', hex: '#B8B8B8' },
      { name: 'Jet Black',          hex: '#1C1C1C' },
      { name: 'Carrara White',      hex: '#EDEDE8' },
      { name: 'Guards Red',         hex: '#CC0000' },
      { name: 'Racing Yellow',      hex: '#F5C518' },
      { name: 'Shark Blue',         hex: '#005B8E' },
    ],
  },
  {
    img:      'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=1920&q=80',
    fallback: '#060608',
    badge:    'Arme de Piste',
    brand:    'MERCEDES-AMG',
    lines:    ['AMG GT', 'BLACK', 'SERIES'],
    subtitle: 'La voiture de route AMG la plus puissante jamais construite. 730 ch de fureur bi-turbo, conçue pour ceux qui exigent la performance absolue.',
    stats: [
      { name: 'Vitesse max', value: '325',   unit: 'km/h' },
      { name: '0 – 100',   value: '3.2',   unit: 'sec'  },
      { name: 'Puissance',     value: '730',   unit: 'hp'   },
      { name: 'Poids',    value: '1,625', unit: 'kg'   },
    ],
    basePrice: 325000,
    accent:  '#00B4FF',
    accent2: '#0078FF',
    // YouTube: Mercedes-AMG GT Black Series Nürburgring record
    filmId: '_bQvSiSWVeU',
    colors: [
      { name: 'Obsidian Black',  hex: '#0D0D0D' },
      { name: 'Selenite Grey',   hex: '#8A8A8A' },
      { name: 'Iridium Silver',  hex: '#C0C0C0' },
      { name: 'Diamond White',   hex: '#EDEDE8' },
      { name: 'AMG Red',         hex: '#CC0000' },
      { name: 'Spectral Blue',   hex: '#003D7A' },
    ],
  },
];

const STEP_NAMES = ['Extérieur', 'Jantes', 'Intérieur', 'Performance', 'Récapitulatif'];

const WHEEL_OPTIONS = [
  { name: 'Forgé Standard',  desc: 'Jantes forgées légères 20" en alliage',              price: 0,    spokes: 5  },
  { name: 'Sport Aéro',      desc: 'Alliage sport aérodynamique 21", profil anti-traînée', price: 3500, spokes: 10 },
  { name: 'Forgé Carbone',   desc: 'Forgé carbone ultra-léger 21", −7 kg',               price: 8900, spokes: 3  },
];

const INTERIOR_OPTIONS = [
  { name: 'Intérieur Sport', icon: '🏁', desc: 'Sièges sport Alcantara, garnitures carbone, volant sport, coutures rouges', price: 0    },
  { name: 'Pack Luxe',       icon: '✦',  desc: 'Cuir Nappa intégral, incrustations bois, sièges massants chauffants, éclairage ambiant', price: 4200 },
  { name: 'Spec Racing',     icon: '⬡',  desc: 'Préparation arceau FIA, fixations harnais 6 points, baquets racing carbone', price: 7800 },
];

const INTERIOR_TYPE_OPTIONS = [
  { id:'pf', name:'Cuir Pleine Fleur', price:8000  },
  { id:'np', name:'Cuir Nappa',        price:12000 },
  { id:'al', name:'Alcantara',          price:10000 },
  { id:'bc', name:'Bois et Cuir',      price:9000  },
  { id:'cc', name:'Carbone et Cuir',   price:15000 },
];

const PERF_OPTIONS = [
  { name: 'Système Launch Control',    desc: 'Séquence de départ arrêté optimisée',                     price: 2100 },
  { name: 'Freins Céramique Composite', desc: 'Disques carbone-céramique, étriers 6 pistons, −18 kg',  price: 6500 },
  { name: 'Échappement Titane',        desc: 'Échappement sport titane Akrapovič, −7 kg',               price: 4300 },
];

const TICKER_ITEMS = [
  { label: 'Ferrari SF90 Stradale',              val: '986 CH'    },
  { label: 'Bugatti Chiron Sport',               val: '1 500 CH'  },
  { label: 'Porsche 911 GT3 RS 4.0',            val: '518 CH'    },
  { label: 'Mercedes-AMG GT Black Series',       val: '730 CH'    },
  { label: 'Nouvelles Configurations Disponibles', val: 'Configurer' },
  { label: 'Réserver un Essai',                  val: 'Tunis HQ'  },
  { label: 'Meilleur 0–100',                    val: '2,4 sec'   },
  { label: 'Record de Vitesse Max',              val: '420 km/h'  },
  { label: 'Freins Céramique Carbone',           val: '+$6 500'   },
  { label: 'Échappement Titane',                 val: '+$4 300'   },
];

/* ════════════════════════════════════════════════════
   GLOBAL STATE
════════════════════════════════════════════════════ */
let current   = 0;
let animating = false;
const N = SLIDES.length;

// Configurator
const configState = {
  open:        false,
  slideIdx:    -1,
  step:        0,
  color:         null,
  wheel:         null,
  interior:      null,
  interiorType:  null,
  performance:   new Set(),
};

// Other modals
let filmOpen       = false;
let contactOpen    = false;
let quoteOpen      = false;
let showroomsOpen  = false;
let financingOpen  = false;
let testdriveOpen  = false;

function anyModalOpen() {
  return configState.open || filmOpen || contactOpen || quoteOpen || showroomsOpen || financingOpen || testdriveOpen
    || !!window.viewerOpen;
}

/* ════════════════════════════════════════════════════
   DOM REFS
════════════════════════════════════════════════════ */
const bgTrack        = document.getElementById('bgTrack');
const indicatorsEl   = document.getElementById('indicators');
const tickerInner    = document.getElementById('tickerInner');
const progressBar    = document.getElementById('progressBar');
const configOverlay  = document.getElementById('configOverlay');
const configContent  = document.getElementById('configContent');
const configStepsBar = document.getElementById('configStepsBar');
const configCarName  = document.getElementById('configCarName');
const configPrev     = document.getElementById('configPrev');
const configNext     = document.getElementById('configNext');
const totalPriceEl   = document.getElementById('configTotalPrice');
const toastEl        = document.getElementById('toast');
const filmOverlay    = document.getElementById('filmOverlay');
const filmIframe     = document.getElementById('filmIframe');
const contactOverlay = document.getElementById('contactOverlay');
const quoteOverlay   = document.getElementById('quoteOverlay');
const quoteDetails   = document.getElementById('quoteDetails');

/* ════════════════════════════════════════════════════
   BUILD DOM — BG TRACK, INDICATORS, TICKER, STEP BAR
════════════════════════════════════════════════════ */
document.documentElement.style.setProperty('--slide-count', N);

SLIDES.forEach((s, i) => {
  const slide = document.createElement('div');
  slide.className = 'bg-slide';
  slide.style.background = s.fallback;
  const para = document.createElement('div');
  para.className = 'bg-parallax';
  para.id = `para-${i}`;
  const img = document.createElement('img');
  img.src = s.img;
  img.alt = s.lines.join(' ');
  img.draggable = false;
  para.appendChild(img);
  slide.appendChild(para);
  bgTrack.appendChild(slide);
});

SLIDES.forEach((_, i) => {
  const d = document.createElement('div');
  d.className = 'ind-dot' + (i === 0 ? ' active' : '');
  d.addEventListener('click', () => goTo(i));
  indicatorsEl.appendChild(d);
});

[...TICKER_ITEMS, ...TICKER_ITEMS].forEach(t => {
  const el = document.createElement('span');
  el.className = 'ticker-item';
  el.innerHTML = `${t.label} <b>— ${t.val} —</b>`;
  tickerInner.appendChild(el);
});

document.getElementById('counterTotal').textContent = String(N).padStart(2, '0');

STEP_NAMES.forEach((name, i) => {
  const step = document.createElement('div');
  step.className = 'config-step' + (i === 0 ? ' active' : '');
  step.id = `cstep-${i}`;
  step.innerHTML = `
    <div class="config-step-num">${i + 1}</div>
    <span class="config-step-label">${name}</span>`;
  configStepsBar.appendChild(step);
});

// Connector line overlaid behind step circles
const stepsConn = document.createElement('div');
stepsConn.className = 'config-steps-connector';
stepsConn.innerHTML = '<div class="config-steps-connector-fill" id="stepsConnFill"></div>';
configStepsBar.appendChild(stepsConn);

/* ════════════════════════════════════════════════════
   PALETTE
════════════════════════════════════════════════════ */
function applyPalette(s) {
  document.documentElement.style.setProperty('--accent',  s.accent);
  document.documentElement.style.setProperty('--accent2', s.accent2);
  const hl3 = document.getElementById('hl3');
  if (hl3) hl3.style.backgroundImage =
    `linear-gradient(90deg,${s.accent} 0%,${s.accent2} 100%)`;
}

/* ════════════════════════════════════════════════════
   FILL SLIDE CONTENT
════════════════════════════════════════════════════ */
function fillContent(idx) {
  const s = SLIDES[idx];
  document.getElementById('badgeText').textContent = s.badge;
  document.getElementById('hl1').textContent       = s.lines[0];
  document.getElementById('hl2').textContent       = s.lines[1];
  document.getElementById('hl3').textContent       = s.lines[2];
  document.getElementById('subtitle').textContent  = s.subtitle;
  document.getElementById('basePrice').textContent = formatPrice(s.basePrice);
  document.getElementById('counterCurrent').textContent = String(idx + 1).padStart(2, '0');

  const rows = document.getElementById('statsRows');
  rows.innerHTML = '';
  s.stats.forEach(st => {
    rows.insertAdjacentHTML('beforeend', `
      <div class="stat-row">
        <span class="stat-name">${st.name}</span>
        <div class="stat-val-wrap">
          <span class="stat-value">${st.value}</span>
          <span class="stat-unit">${st.unit}</span>
        </div>
      </div>`);
  });
}

/* ════════════════════════════════════════════════════
   PAN HELPERS  (inline style + forced reflow)
════════════════════════════════════════════════════ */
const panEls = () => [
  document.getElementById('headlineBlock'),
  document.getElementById('statsCard'),
];

function panOutAnimate(dir, cb) {
  panEls().forEach(el => {
    el.style.transition = 'transform .36s cubic-bezier(.55,0,1,.45), opacity .36s ease';
    el.style.transform  = `translateY(${-dir * 40}px)`;
    el.style.opacity    = '0';
  });
  setTimeout(cb, 340);
}

function panIn(dir) {
  panEls().forEach(el => {
    el.style.transition = 'none';
    el.style.transform  = `translateY(${dir * 55}px)`;
    el.style.opacity    = '0';
    void el.offsetHeight; // forced reflow
    el.style.transition = 'transform .72s cubic-bezier(.25,.46,.45,.94), opacity .72s ease';
    el.style.transform  = 'translateY(0)';
    el.style.opacity    = '1';
  });
}

/* ════════════════════════════════════════════════════
   SLIDE NAVIGATION
════════════════════════════════════════════════════ */
function goTo(idx, dir) {
  if (animating || idx === current || anyModalOpen()) return;
  animating = true;
  const d = dir ?? (idx > current ? 1 : -1);

  panOutAnimate(d, () => {
    current = idx;
    const s = SLIDES[current];

    fillContent(current);
    applyPalette(s);

    bgTrack.style.transform = `translateX(-${current * 100}vw)`;
    progressBar.style.width = `${((current + 1) / N) * 100}%`;

    document.querySelectorAll('.ind-dot').forEach((dot, i) => {
      dot.classList.toggle('active', i === current);
    });

    panIn(-d);
    setTimeout(() => { animating = false; }, 750);
  });
}

/* ════════════════════════════════════════════════════
   INIT FIRST SLIDE
════════════════════════════════════════════════════ */
fillContent(0);
applyPalette(SLIDES[0]);
progressBar.style.width = `${(1 / N) * 100}%`;

panEls().forEach(el => {
  el.style.transform = 'translateY(55px)';
  el.style.opacity   = '0';
});
setTimeout(() => {
  panEls().forEach(el => {
    el.style.transition = 'transform .9s cubic-bezier(.25,.46,.45,.94), opacity .9s ease';
    el.style.transform  = 'translateY(0)';
    el.style.opacity    = '1';
  });
}, 200);

/* ════════════════════════════════════════════════════
   PRICE HELPERS
════════════════════════════════════════════════════ */
function formatPrice(n) {
  return '$' + n.toLocaleString('en-US');
}

function calcTotal() {
  let total = SLIDES[current].basePrice;
  if (configState.wheel        !== null) total += WHEEL_OPTIONS[configState.wheel].price;
  if (configState.interior     !== null) total += INTERIOR_OPTIONS[configState.interior].price;
  if (configState.interiorType !== null) total += INTERIOR_TYPE_OPTIONS[configState.interiorType].price;
  configState.performance.forEach(i => { total += PERF_OPTIONS[i].price; });
  return total;
}

function refreshPriceDisplay() {
  totalPriceEl.textContent = formatPrice(calcTotal());
}

/* ════════════════════════════════════════════════════
   WHEEL SVG HELPER
════════════════════════════════════════════════════ */
function wheelSVG(n) {
  const cx = 40, cy = 40, rHub = 8, rRim = 35;
  let spokes = '';
  const sw = n === 3 ? 3.5 : n <= 5 ? 2.2 : 1.4;

  if (n === 3) {
    for (let i = 0; i < 3; i++) {
      const ang = ((270 + i * 120) * Math.PI) / 180;
      const mr  = rRim * 0.55;
      const mx  = cx + mr * Math.cos(ang), my = cy + mr * Math.sin(ang);
      const a1 = ang + 0.42, a2 = ang - 0.42;
      const bx1 = cx + rRim * Math.cos(a1), by1 = cy + rRim * Math.sin(a1);
      const bx2 = cx + rRim * Math.cos(a2), by2 = cy + rRim * Math.sin(a2);
      spokes += `<line x1="${cx.toFixed(1)}" y1="${cy.toFixed(1)}" x2="${mx.toFixed(1)}" y2="${my.toFixed(1)}" stroke="currentColor" stroke-width="${sw}"/>`;
      spokes += `<line x1="${mx.toFixed(1)}" y1="${my.toFixed(1)}" x2="${bx1.toFixed(1)}" y2="${by1.toFixed(1)}" stroke="currentColor" stroke-width="${sw}"/>`;
      spokes += `<line x1="${mx.toFixed(1)}" y1="${my.toFixed(1)}" x2="${bx2.toFixed(1)}" y2="${by2.toFixed(1)}" stroke="currentColor" stroke-width="${sw}"/>`;
    }
  } else {
    for (let i = 0; i < n; i++) {
      const ang = ((270 + i * 360 / n) * Math.PI) / 180;
      spokes += `<line x1="${(cx + rHub * Math.cos(ang)).toFixed(1)}" y1="${(cy + rHub * Math.sin(ang)).toFixed(1)}" x2="${(cx + rRim * Math.cos(ang)).toFixed(1)}" y2="${(cy + rRim * Math.sin(ang)).toFixed(1)}" stroke="currentColor" stroke-width="${sw}"/>`;
    }
  }

  return `<svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
    <circle cx="${cx}" cy="${cy}" r="${rRim}" fill="none" stroke="currentColor" stroke-width="1.8"/>
    <circle cx="${cx}" cy="${cy}" r="${rHub}" fill="none" stroke="currentColor" stroke-width="1.8"/>
    ${spokes}
  </svg>`;
}

/* ════════════════════════════════════════════════════
   CONFIGURATOR — OPEN / CLOSE
════════════════════════════════════════════════════ */
function openConfigurator() {
  if (configState.slideIdx !== current) {
    configState.slideIdx    = current;
    configState.step         = 0;
    configState.color        = null;
    configState.wheel        = null;
    configState.interior     = null;
    configState.interiorType = null;
    configState.performance  = new Set();
  } else {
    configState.step = 0;
  }
  configState.open = true;
  configCarName.textContent = SLIDES[current].lines.join(' ');
  updateStepsBar();
  renderStep(configState.step);
  refreshPriceDisplay();
  configOverlay.classList.add('active');
}

function closeConfigurator() {
  configState.open = false;
  configOverlay.classList.remove('active');
}

/* ════════════════════════════════════════════════════
   CONFIGURATOR — STEP BAR
════════════════════════════════════════════════════ */
function updateStepsBar() {
  STEP_NAMES.forEach((_, i) => {
    const el = document.getElementById(`cstep-${i}`);
    el.classList.toggle('active', i === configState.step);
    el.classList.toggle('done',   i <  configState.step);
  });
  configNext.textContent = configState.step === 4 ? 'Demander un Devis →' : 'Continuer →';
  configPrev.style.opacity = configState.step === 0 ? '0.3' : '1';

  const fill = document.getElementById('stepsConnFill');
  if (fill) fill.style.width = (configState.step / (STEP_NAMES.length - 1) * 100) + '%';

  const counter = document.getElementById('configStepCounter');
  if (counter) counter.textContent = `Étape ${configState.step + 1} sur ${STEP_NAMES.length}`;
}

/* ════════════════════════════════════════════════════
   CONFIGURATOR — STEP RENDERERS
════════════════════════════════════════════════════ */
function renderStep(step) {
  configContent.innerHTML = '';
  switch (step) {
    case 0: renderStep0(); break;
    case 1: renderStep1(); break;
    case 2: renderStep2(); break;
    case 3: renderStep3(); break;
    case 4: renderStep4(); break;
  }
}

function renderStep0() {
  const colors = SLIDES[current].colors;
  const sel = configState.color;
  const wrap = document.createElement('div');
  wrap.innerHTML = `
    <div class="config-section-title">Couleur Extérieure</div>
    <div class="config-section-sub">Sélectionnez votre finition extérieure</div>
    <div class="color-swatches" id="colorSwatches"></div>
    <div class="selected-color-name" id="selectedColorName">
      ${sel !== null ? colors[sel].name : '— Choisir une couleur —'}
    </div>
    <div class="config-error" id="stepError">Veuillez sélectionner une couleur pour continuer.</div>`;
  configContent.appendChild(wrap);

  const grid = document.getElementById('colorSwatches');
  colors.forEach((c, i) => {
    const card = document.createElement('div');
    card.className = 'color-swatch' + (i === sel ? ' selected' : '');
    card.innerHTML = `<div class="swatch-circle" style="background:${c.hex};"></div>
      <span class="swatch-name">${c.name}</span>`;
    card.addEventListener('click', () => {
      configState.color = i;
      document.querySelectorAll('.color-swatch').forEach((el, j) => el.classList.toggle('selected', j === i));
      document.getElementById('selectedColorName').textContent = c.name;
      document.getElementById('stepError').classList.remove('show');
    });
    grid.appendChild(card);
  });
}

function renderStep1() {
  const wrap = document.createElement('div');
  wrap.innerHTML = `
    <div class="config-section-title">Type de Jantes</div>
    <div class="config-section-sub">Choisissez votre spécification de jantes</div>
    <div class="option-cards" id="wheelCards"></div>
    <div class="config-error" id="stepError">Veuillez sélectionner un type de jantes pour continuer.</div>`;
  configContent.appendChild(wrap);

  const container = document.getElementById('wheelCards');
  WHEEL_OPTIONS.forEach((w, i) => {
    const card = document.createElement('div');
    card.className = 'option-card' + (i === configState.wheel ? ' selected' : '');
    card.innerHTML = `
      <div class="option-card-icon">${wheelSVG(w.spokes)}</div>
      <div class="option-card-info">
        <div class="option-card-name">${w.name}</div>
        <div class="option-card-desc">${w.desc}</div>
      </div>
      <div class="option-card-price">${w.price === 0 ? 'Inclus' : '+' + formatPrice(w.price)}</div>`;
    card.addEventListener('click', () => {
      configState.wheel = i;
      document.querySelectorAll('#wheelCards .option-card').forEach((el, j) => el.classList.toggle('selected', j === i));
      document.getElementById('stepError').classList.remove('show');
      refreshPriceDisplay();
    });
    container.appendChild(card);
  });
}

function renderStep2() {
  const wrap = document.createElement('div');
  wrap.innerHTML = `
    <div class="config-section-title">Intérieur</div>
    <div class="config-section-sub">Définissez l'expérience habitacle selon votre style de conduite</div>
    <div class="option-cards" id="interiorCards"></div>
    <div class="int-type-section-title">TYPE D'INTÉRIEUR</div>
    <div class="int-type-grid" id="intTypeCards"></div>
    <div class="config-error" id="stepError">Veuillez sélectionner un intérieur pour continuer.</div>`;
  configContent.appendChild(wrap);

  const container = document.getElementById('interiorCards');
  INTERIOR_OPTIONS.forEach((opt, i) => {
    const card = document.createElement('div');
    card.className = 'option-card' + (i === configState.interior ? ' selected' : '');
    card.innerHTML = `
      <div class="interior-icon">${opt.icon}</div>
      <div class="option-card-info">
        <div class="option-card-name">${opt.name}</div>
        <div class="option-card-desc">${opt.desc}</div>
      </div>
      <div class="option-card-price">${opt.price === 0 ? 'Inclus' : '+' + formatPrice(opt.price)}</div>`;
    card.addEventListener('click', () => {
      configState.interior = i;
      document.querySelectorAll('#interiorCards .option-card').forEach((el, j) => el.classList.toggle('selected', j === i));
      document.getElementById('stepError').classList.remove('show');
      refreshPriceDisplay();
    });
    container.appendChild(card);
  });

  const typeContainer = document.getElementById('intTypeCards');
  INTERIOR_TYPE_OPTIONS.forEach((opt, i) => {
    const card = document.createElement('button');
    card.type = 'button';
    card.className = 'int-type-card' + (i === configState.interiorType ? ' active' : '');
    card.innerHTML =
      '<span class="int-type-name">' + opt.name + '</span>' +
      '<span class="int-type-price">+' + formatPrice(opt.price) + '</span>';
    card.addEventListener('click', () => {
      configState.interiorType = i;
      document.querySelectorAll('#intTypeCards .int-type-card').forEach((el, j) => el.classList.toggle('active', j === i));
      refreshPriceDisplay();
    });
    typeContainer.appendChild(card);
  });
}

function renderStep3() {
  const wrap = document.createElement('div');
  wrap.innerHTML = `
    <div class="config-section-title">Pack Performance</div>
    <div class="config-section-sub">Options supplémentaires — sélectionnez librement</div>
    <div class="perf-options" id="perfOptions"></div>`;
  configContent.appendChild(wrap);

  const container = document.getElementById('perfOptions');
  PERF_OPTIONS.forEach((opt, i) => {
    const row = document.createElement('div');
    row.className = 'perf-option' + (configState.performance.has(i) ? ' selected' : '');
    row.innerHTML = `
      <div class="perf-toggle"></div>
      <div class="perf-info">
        <div class="perf-name">${opt.name}</div>
        <div class="perf-desc">${opt.desc}</div>
      </div>
      <div class="perf-price">+${formatPrice(opt.price)}</div>`;
    row.addEventListener('click', () => {
      if (configState.performance.has(i)) {
        configState.performance.delete(i);
        row.classList.remove('selected');
      } else {
        configState.performance.add(i);
        row.classList.add('selected');
      }
      refreshPriceDisplay();
    });
    container.appendChild(row);
  });
}

function renderStep4() {
  const s            = SLIDES[current];
  const color        = configState.color        !== null ? s.colors[configState.color].name : '—';
  const wheel        = configState.wheel        !== null ? WHEEL_OPTIONS[configState.wheel].name : '—';
  const interior     = configState.interior     !== null ? INTERIOR_OPTIONS[configState.interior].name : '—';
  const interiorType = configState.interiorType !== null ? INTERIOR_TYPE_OPTIONS[configState.interiorType].name : '—';
  const wheelPx      = configState.wheel        !== null ? WHEEL_OPTIONS[configState.wheel].price : 0;
  const intPx        = configState.interior     !== null ? INTERIOR_OPTIONS[configState.interior].price : 0;
  const intTypePx    = configState.interiorType !== null ? INTERIOR_TYPE_OPTIONS[configState.interiorType].price : 0;
  const total        = calcTotal();

  let perfHTML = '';
  if (configState.performance.size === 0) {
    perfHTML = `<div class="summary-row">
      <span class="summary-row-label">Packs Performance</span>
      <span class="summary-row-value">Aucune sélection</span>
    </div>`;
  } else {
    configState.performance.forEach(i => {
      const p = PERF_OPTIONS[i];
      perfHTML += `<div class="summary-row">
        <span class="summary-row-label">${p.name}</span>
        <span class="summary-row-value accent">+${formatPrice(p.price)}</span>
      </div>`;
    });
  }

  const wrap = document.createElement('div');
  wrap.innerHTML = `
    <div class="config-section-title">Récapitulatif</div>
    <div class="config-section-sub">Vérifiez vos choix avant de demander un devis</div>

    <div class="summary-section">
      <div class="summary-section-title">Véhicule</div>
      <div class="summary-row">
        <span class="summary-row-label">${s.lines.join(' ')}</span>
        <span class="summary-row-value">${formatPrice(s.basePrice)}</span>
      </div>
    </div>

    <div class="summary-section">
      <div class="summary-section-title">Extérieur</div>
      <div class="summary-row">
        <span class="summary-row-label">Couleur : ${color}</span>
        <span class="summary-row-value">Inclus</span>
      </div>
      <div class="summary-row">
        <span class="summary-row-label">Jantes : ${wheel}</span>
        <span class="summary-row-value ${wheelPx > 0 ? 'accent' : ''}">${wheelPx > 0 ? '+' + formatPrice(wheelPx) : 'Inclus'}</span>
      </div>
    </div>

    <div class="summary-section">
      <div class="summary-section-title">Intérieur</div>
      <div class="summary-row">
        <span class="summary-row-label">${interior}</span>
        <span class="summary-row-value ${intPx > 0 ? 'accent' : ''}">${intPx > 0 ? '+' + formatPrice(intPx) : 'Inclus'}</span>
      </div>
      <div class="summary-row">
        <span class="summary-row-label">Matière : ${interiorType}</span>
        <span class="summary-row-value ${intTypePx > 0 ? 'accent' : ''}">${intTypePx > 0 ? '+' + formatPrice(intTypePx) : '—'}</span>
      </div>
    </div>

    <div class="summary-section">
      <div class="summary-section-title">Performance</div>
      ${perfHTML}
    </div>

    <div class="summary-total">
      <span class="summary-total-label">Total</span>
      <span class="summary-total-value">${formatPrice(total)}</span>
    </div>

    <div class="summary-cta-group">
      <button class="summary-btn-primary" id="summaryQuote">Demander un Devis</button>
      <button class="summary-btn-secondary" id="summarySave">↓ Sauvegarder (.txt)</button>
      <button class="summary-btn-share" id="summaryShare">⊕ Partager</button>
    </div>`;
  configContent.appendChild(wrap);

  document.getElementById('summaryQuote').addEventListener('click', () => {
    closeConfigurator();
    openQuote();
  });

  document.getElementById('summarySave').addEventListener('click', () => {
    downloadConfig();
  });

  document.getElementById('summaryShare').addEventListener('click', () => {
    shareConfig();
  });
}

/* ════════════════════════════════════════════════════
   STEP NAVIGATION + VALIDATION
════════════════════════════════════════════════════ */
function validateStep(step) {
  if (step === 0 && configState.color    === null) return false;
  if (step === 1 && configState.wheel    === null) return false;
  if (step === 2 && configState.interior === null) return false;
  return true;
}

function nextStep() {
  if (configState.step === 4) return; // handled by "Request Quote" button inside step 4
  if (!validateStep(configState.step)) {
    const err = document.getElementById('stepError');
    if (err) err.classList.add('show');
    return;
  }
  configState.step++;
  updateStepsBar();
  renderStep(configState.step);
  configContent.scrollTop = 0;
  refreshPriceDisplay();
}

function prevStep() {
  if (configState.step === 0) return;
  configState.step--;
  updateStepsBar();
  renderStep(configState.step);
  configContent.scrollTop = 0;
  refreshPriceDisplay();
}

/* ════════════════════════════════════════════════════
   FILM MODAL
════════════════════════════════════════════════════ */
function openFilm() {
  const s = SLIDES[current];
  const start = s.filmStart ? '&start=' + s.filmStart : '';
  filmIframe.src = 'https://www.youtube.com/embed/' + s.filmId + '?autoplay=1&rel=0' + start;
  filmOpen = true;
  document.getElementById('filmModal').style.display = 'flex';
}

function closeFilm() {
  filmOpen = false;
  document.getElementById('filmModal').style.display = 'none';
  filmIframe.src = '';
}

/* ════════════════════════════════════════════════════
   CONTACT MODAL + FORM VALIDATION
════════════════════════════════════════════════════ */
function openContact() {
  contactOpen = true;
  contactOverlay.classList.add('active');
  // Reset form to initial state each time
  const form    = document.getElementById('contactForm');
  const success = document.getElementById('formSuccess');
  if (form)    { form.reset(); form.style.display = ''; }
  if (success) { success.classList.remove('show'); }
  clearFormErrors();
}

function closeContact() {
  contactOpen = false;
  contactOverlay.classList.remove('active');
}

function clearFormErrors() {
  ['fname','femail','fmessage'].forEach(id => {
    const inp = document.getElementById(id);
    const err = document.getElementById(id + 'Err');
    if (inp) inp.classList.remove('error');
    if (err) err.textContent = '';
  });
}

function setFieldError(id, msg) {
  const inp = document.getElementById(id);
  const err = document.getElementById(id + 'Err');
  if (inp) inp.classList.add('error');
  if (err) err.textContent = msg;
}

function validateContactForm() {
  clearFormErrors();
  let valid = true;
  const name    = (document.getElementById('fname')?.value    || '').trim();
  const email   = (document.getElementById('femail')?.value   || '').trim();
  const message = (document.getElementById('fmessage')?.value || '').trim();
  const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

  if (name.length < 2) {
    setFieldError('fname', 'Veuillez saisir votre nom complet (min. 2 caractères).');
    valid = false;
  }
  if (!emailRx.test(email)) {
    setFieldError('femail', 'Veuillez saisir une adresse e-mail valide.');
    valid = false;
  }
  if (message.length < 10) {
    setFieldError('fmessage', 'Le message doit contenir au moins 10 caractères.');
    valid = false;
  }
  return valid;
}

/* ════════════════════════════════════════════════════
   QUOTE CONFIRMATION MODAL
════════════════════════════════════════════════════ */
function openQuote() {
  const s        = SLIDES[current];
  const color        = configState.color        !== null ? s.colors[configState.color].name : 'Non sélectionné';
  const wheel        = configState.wheel        !== null ? WHEEL_OPTIONS[configState.wheel].name : 'Non sélectionné';
  const interior     = configState.interior     !== null ? INTERIOR_OPTIONS[configState.interior].name : 'Non sélectionné';
  const interiorType = configState.interiorType !== null ? INTERIOR_TYPE_OPTIONS[configState.interiorType].name : 'Non sélectionné';
  const perfList     = configState.performance.size > 0
    ? [...configState.performance].map(i => PERF_OPTIONS[i].name).join(', ')
    : 'Aucune';
  const total = calcTotal();

  const rows = [
    { label: 'Véhicule',         value: s.lines.join(' ')      },
    { label: 'Couleur',          value: color                  },
    { label: 'Jantes',           value: wheel                  },
    { label: 'Intérieur',        value: interior               },
    { label: 'Matière intérieur', value: interiorType          },
    { label: 'Performance',      value: perfList               },
    { label: 'Total',            value: formatPrice(total), accent: true },
  ];

  quoteDetails.innerHTML = rows.map(r => `
    <div class="quote-detail-row">
      <span class="quote-detail-label">${r.label}</span>
      <span class="quote-detail-value${r.accent ? ' accent' : ''}">${r.value}</span>
    </div>`).join('');

  quoteOpen = true;
  quoteOverlay.classList.add('active');
}

function closeQuote() {
  quoteOpen = false;
  quoteOverlay.classList.remove('active');
}

/* ════════════════════════════════════════════════════
   DOWNLOAD CONFIG AS .TXT
════════════════════════════════════════════════════ */
function downloadConfig() {
  const s        = SLIDES[current];
  const color        = configState.color        !== null ? s.colors[configState.color].name : 'Non sélectionné';
  const wheel        = configState.wheel        !== null ? WHEEL_OPTIONS[configState.wheel].name : 'Non sélectionné';
  const wheelPx      = configState.wheel        !== null ? WHEEL_OPTIONS[configState.wheel].price : 0;
  const interior     = configState.interior     !== null ? INTERIOR_OPTIONS[configState.interior].name : 'Non sélectionné';
  const intPx        = configState.interior     !== null ? INTERIOR_OPTIONS[configState.interior].price : 0;
  const interiorType = configState.interiorType !== null ? INTERIOR_TYPE_OPTIONS[configState.interiorType].name : 'Non sélectionné';
  const intTypePx    = configState.interiorType !== null ? INTERIOR_TYPE_OPTIONS[configState.interiorType].price : 0;
  const perfLines = configState.performance.size > 0
    ? [...configState.performance].map(i => `  • ${PERF_OPTIONS[i].name}  (+${formatPrice(PERF_OPTIONS[i].price)})`).join('\n')
    : '  Aucune sélection';
  const total = calcTotal();

  const txt = `
╔══════════════════════════════════════════════════╗
║            CARTHA CARS                           ║
║          Récapitulatif de Configuration          ║
╚══════════════════════════════════════════════════╝

  Généré le  : ${new Date().toLocaleString('fr-FR')}
  Référence  : CARTHA-${Date.now().toString(36).toUpperCase()}

──────────────────────────────────────────────────
  VÉHICULE
──────────────────────────────────────────────────
  ${s.lines.join(' ')}
  Moteur      : ${s.stats.find(x => x.name === 'Puissance')?.value} ${s.stats.find(x => x.name === 'Puissance')?.unit}
  Vitesse max : ${s.stats.find(x => x.name === 'Vitesse max')?.value} ${s.stats.find(x => x.name === 'Vitesse max')?.unit}
  Prix de base: ${formatPrice(s.basePrice)}

──────────────────────────────────────────────────
  EXTÉRIEUR
──────────────────────────────────────────────────
  Couleur : ${color}
  Jantes  : ${wheel}${wheelPx > 0 ? `  (+${formatPrice(wheelPx)})` : '  (Inclus)'}

──────────────────────────────────────────────────
  INTÉRIEUR
──────────────────────────────────────────────────
  ${interior}${intPx > 0 ? `  (+${formatPrice(intPx)})` : '  (Inclus)'}
  Matière : ${interiorType}${intTypePx > 0 ? `  (+${formatPrice(intTypePx)})` : ''}

──────────────────────────────────────────────────
  OPTIONS PERFORMANCE
──────────────────────────────────────────────────
${perfLines}

══════════════════════════════════════════════════
  TOTAL CONFIGURATION : ${formatPrice(total)}
══════════════════════════════════════════════════

  Contact   : contact@carthacars.com
  Tél.      : +216 99 115 308
  Adresse   : Avenue Habib Bourguiba,
              Tunis 1000, Tunisie
`.trimStart();

  const blob = new Blob([txt], { type: 'text/plain;charset=utf-8' });
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a');
  a.href     = url;
  a.download = `CARTHA-${s.lines[0]}-${s.lines[1].replace(/\s/g, '-')}-Config.txt`;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);

  showToast('Configuration sauvegardée en .txt.');
}

/* ════════════════════════════════════════════════════
   TOAST
════════════════════════════════════════════════════ */
let toastTimer = null;

function showToast(msg) {
  toastEl.textContent = msg;
  toastEl.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toastEl.classList.remove('show'), 4000);
}

/* ════════════════════════════════════════════════════
   CLOSE ANY OPEN MODAL (helper for Escape / overlay click)
════════════════════════════════════════════════════ */
function closeTopModal() {
  if (configState.open)    { closeConfigurator();        return; }
  if (filmOpen)            { closeFilm();                return; }
  if (contactOpen)         { closeContact();             return; }
  if (quoteOpen)           { closeQuote();               return; }
  if (showroomsOpen)       { closeShowrooms();           return; }
  if (financingOpen)       { closeFinancing();           return; }
  if (testdriveOpen)       { closeTestDrive();           return; }
  if (window.viewerOpen)   { window.closeViewer?.();     return; }
}

/* ════════════════════════════════════════════════════
   MOUSE PARALLAX
════════════════════════════════════════════════════ */
window.addEventListener('mousemove', e => {
  if (anyModalOpen()) return;
  const mx = (e.clientX / window.innerWidth  - .5) * 2;
  const my = (e.clientY / window.innerHeight - .5) * 2;
  const para = document.getElementById(`para-${current}`);
  if (para) para.style.transform = `translate(${mx * -14}px, ${my * -10}px)`;
});

/* ════════════════════════════════════════════════════
   SCROLL NAVIGATION
════════════════════════════════════════════════════ */
let lastWheel = 0;

window.addEventListener('wheel', e => {
  if (anyModalOpen()) return;
  e.preventDefault();
  const now = Date.now();
  if (now - lastWheel < 900) return;
  lastWheel = now;
  if (e.deltaY > 0 && current < N - 1) goTo(current + 1,  1);
  if (e.deltaY < 0 && current > 0)     goTo(current - 1, -1);
}, { passive: false });

/* ════════════════════════════════════════════════════
   KEYBOARD NAVIGATION
════════════════════════════════════════════════════ */
window.addEventListener('keydown', e => {
  if (e.key === 'Escape') { closeTopModal(); return; }
  if (anyModalOpen()) return;
  if (e.key === 'ArrowRight' || e.key === 'ArrowDown') { if (current < N - 1) goTo(current + 1,  1); }
  if (e.key === 'ArrowLeft'  || e.key === 'ArrowUp')   { if (current > 0)     goTo(current - 1, -1); }
});

/* ════════════════════════════════════════════════════
   TOUCH / SWIPE NAVIGATION
════════════════════════════════════════════════════ */
let touchStartX = 0, touchStartY = 0;

window.addEventListener('touchstart', e => {
  touchStartX = e.touches[0].clientX;
  touchStartY = e.touches[0].clientY;
}, { passive: true });

window.addEventListener('touchend', e => {
  if (anyModalOpen()) return;
  const dx = e.changedTouches[0].clientX - touchStartX;
  const dy = e.changedTouches[0].clientY - touchStartY;
  if (Math.abs(dx) < Math.abs(dy) || Math.abs(dx) < 50) return;
  if (dx < 0 && current < N - 1) goTo(current + 1,  1);
  if (dx > 0 && current > 0)     goTo(current - 1, -1);
}, { passive: true });

/* ════════════════════════════════════════════════════
   EVENT LISTENERS — MAIN CTA BUTTONS
════════════════════════════════════════════════════ */
document.getElementById('ctaConfig').addEventListener('click', openConfigurator);
document.getElementById('ctaFilm').addEventListener('click', openFilm);

/* ════════════════════════════════════════════════════
   EVENT LISTENERS — CONFIGURATOR
════════════════════════════════════════════════════ */
document.getElementById('configClose').addEventListener('click', closeConfigurator);
document.getElementById('configBackdrop').addEventListener('click', closeConfigurator);
configNext.addEventListener('click', nextStep);
configPrev.addEventListener('click', prevStep);

/* ════════════════════════════════════════════════════
   EVENT LISTENERS — FILM MODAL
════════════════════════════════════════════════════ */
document.getElementById('filmClose').addEventListener('click', closeFilm);
document.getElementById('filmModal').addEventListener('click', function(e) {
  if (e.target === this) closeFilm();
});

/* ════════════════════════════════════════════════════
   EVENT LISTENERS — CONTACT MODAL + FORM
════════════════════════════════════════════════════ */
document.getElementById('contactClose').addEventListener('click', closeContact);
document.getElementById('contactBackdrop').addEventListener('click', closeContact);

document.getElementById('contactForm').addEventListener('submit', async e => {
  e.preventDefault();
  if (!validateContactForm()) return;

  const form    = document.getElementById('contactForm');
  const success = document.getElementById('formSuccess');
  const submit  = form.querySelector('button[type="submit"]');

  submit.disabled = true;
  submit.textContent = 'Envoi...';

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
    success.classList.add('show');
  } catch (err) {
    setFieldError('fmessage', err.message || 'Impossible d envoyer le message.');
  } finally {
    submit.disabled = false;
    submit.textContent = 'Envoyer ->';
  }
});

// Clear individual field errors on input
['fname', 'femail', 'fmessage'].forEach(id => {
  const el = document.getElementById(id);
  if (el) {
    el.addEventListener('input', () => {
      el.classList.remove('error');
      const errEl = document.getElementById(id + 'Err');
      if (errEl) errEl.textContent = '';
    });
  }
});

/* ════════════════════════════════════════════════════
   EVENT LISTENERS — QUOTE MODAL
════════════════════════════════════════════════════ */
document.getElementById('quoteClose').addEventListener('click', closeQuote);
document.getElementById('quoteBackdrop').addEventListener('click', closeQuote);
document.getElementById('quoteDone').addEventListener('click', closeQuote);

/* ════════════════════════════════════════════════════
   EVENT LISTENERS — NAV LINKS
════════════════════════════════════════════════════ */
document.getElementById('navContact').addEventListener('click', e => {
  e.preventDefault();
  openContact();
});

document.getElementById('navConfigure').addEventListener('click', e => {
  e.preventDefault();
  openConfigurator();
});

document.getElementById('navCta').addEventListener('click', () => {
  openContact();
});

document.getElementById('navModels').addEventListener('click', e => {
  e.preventDefault();
  closeTopModal();
  // Cycle to next slide as a "browse models" gesture
  goTo(current < N - 1 ? current + 1 : 0, 1);
});

document.getElementById('navHeritage').addEventListener('click', e => {
  e.preventDefault();
  showToast('Section Héritage — bientôt disponible.');
});

document.getElementById('nav3dView').addEventListener('click', e => {
  e.preventDefault();
  if (window.openViewer) window.openViewer();
});

/* ════════════════════════════════════════════════════
   SHOWROOMS MODAL
════════════════════════════════════════════════════ */
const showroomsOverlay = document.getElementById('showroomsOverlay');

function openShowrooms() {
  showroomsOpen = true;
  showroomsOverlay.classList.add('active');
  initShowroomsAnimations();
}

function closeShowrooms() {
  showroomsOpen = false;
  showroomsOverlay.classList.remove('active');
}

document.getElementById('navShowrooms').addEventListener('click', e => {
  e.preventDefault();
  openShowrooms();
});

document.getElementById('showroomsClose').addEventListener('click', closeShowrooms);
document.getElementById('showroomsBackdrop').addEventListener('click', closeShowrooms);

/* ════════════════════════════════════════════════════
   SCROLL ANIMATIONS — SHOWROOMS
════════════════════════════════════════════════════ */
function initShowroomsAnimations() {
  document.querySelectorAll('.showroom-card').forEach((card, i) => {
    card.classList.remove('sr-anim');
    card.style.animationDelay = '0ms';
    void card.offsetWidth;
    const delay = i * 60;
    card.style.animationDelay = delay + 'ms';
    card.classList.add('sr-anim');
    setTimeout(() => {
      card.classList.remove('sr-anim');
      card.style.animationDelay = '';
    }, delay + 550);
  });
}

/* ════════════════════════════════════════════════════
   FINANCING CALCULATOR
════════════════════════════════════════════════════ */
const financingOverlay = document.getElementById('financingOverlay');
let finDuration = 36;

function calcMonthly(price, downPct, months, apr) {
  const principal = price * (1 - downPct / 100);
  const r = apr / 100 / 12;
  if (r === 0) return principal / months;
  return principal * r * Math.pow(1 + r, months) / (Math.pow(1 + r, months) - 1);
}

function updateFinancingDisplay() {
  const price    = SLIDES[current].basePrice;
  const downPct  = parseInt(document.getElementById('finDownSlider')?.value || 20);
  const monthly  = calcMonthly(price, downPct, finDuration, 4.9);
  const downAmt  = price * downPct / 100;
  const loan     = price - downAmt;
  const totalPay = monthly * finDuration + downAmt;
  const interest = totalPay - price;

  const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
  set('finCarPrice',    formatPrice(price));
  set('finDownPct',     downPct + '%');
  set('finDownValue',   formatPrice(Math.round(downAmt)));
  set('finMonthly',     formatPrice(Math.round(monthly)));
  set('finBrkPrice',    formatPrice(price));
  set('finBrkDown',     formatPrice(Math.round(downAmt)));
  set('finBrkLoan',     formatPrice(Math.round(loan)));
  set('finBrkInterest', formatPrice(Math.round(interest)));
  set('finBrkTotal',    formatPrice(Math.round(totalPay)));
}

function openFinancing() {
  financingOpen = true;
  financingOverlay.classList.add('active');
  updateFinancingDisplay();
}

function closeFinancing() {
  financingOpen = false;
  financingOverlay.classList.remove('active');
}

document.getElementById('financingClose').addEventListener('click', closeFinancing);
document.getElementById('financingBackdrop').addEventListener('click', closeFinancing);
document.getElementById('navFinancing').addEventListener('click', e => {
  e.preventDefault();
  openFinancing();
});

document.getElementById('finDownSlider').addEventListener('input', updateFinancingDisplay);

document.getElementById('finDurationGrid').addEventListener('click', e => {
  const btn = e.target.closest('.financing-duration-btn');
  if (!btn) return;
  finDuration = parseInt(btn.dataset.months);
  document.querySelectorAll('.financing-duration-btn').forEach(b => b.classList.toggle('active', b === btn));
  updateFinancingDisplay();
});

/* ════════════════════════════════════════════════════
   TEST DRIVE MODAL
════════════════════════════════════════════════════ */
const testdriveOverlay = document.getElementById('testdriveOverlay');

function openTestDrive() {
  testdriveOpen = true;
  testdriveOverlay.classList.add('active');
  // Auto-fill car
  const carEl = document.getElementById('tdcar');
  if (carEl) carEl.value = SLIDES[current].lines.join(' ');
  // Reset form
  const form    = document.getElementById('testdriveForm');
  const success = document.getElementById('testdriveSuccess');
  if (form)    { form.reset(); form.style.display = ''; if (carEl) carEl.value = SLIDES[current].lines.join(' '); }
  if (success) { success.classList.remove('show'); }
  clearTDErrors();
  // Set min date to tomorrow
  const dateEl = document.getElementById('tddate');
  if (dateEl) {
    const tomorrow = new Date(); tomorrow.setDate(tomorrow.getDate() + 1);
    dateEl.min = tomorrow.toISOString().split('T')[0];
  }
}

function closeTestDrive() {
  testdriveOpen = false;
  testdriveOverlay.classList.remove('active');
}

function clearTDErrors() {
  ['tdname','tdemail','tdshowroom','tddate'].forEach(id => {
    const inp = document.getElementById(id);
    const err = document.getElementById(id + 'Err');
    if (inp) inp.classList.remove('error');
    if (err) err.textContent = '';
  });
}

function setTDError(id, msg) {
  const inp = document.getElementById(id);
  const err = document.getElementById(id + 'Err');
  if (inp) inp.classList.add('error');
  if (err) err.textContent = msg;
}

function validateTestDrive() {
  clearTDErrors();
  let valid = true;
  const name     = (document.getElementById('tdname')?.value     || '').trim();
  const email    = (document.getElementById('tdemail')?.value    || '').trim();
  const showroom = (document.getElementById('tdshowroom')?.value || '').trim();
  const date     = (document.getElementById('tddate')?.value     || '').trim();
  const emailRx  = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

  if (name.length < 2)      { setTDError('tdname',     'Veuillez saisir votre nom complet.'); valid = false; }
  if (!emailRx.test(email)) { setTDError('tdemail',    'Veuillez saisir un e-mail valide.'); valid = false; }
  if (!showroom)            { setTDError('tdshowroom', 'Veuillez sélectionner un showroom.'); valid = false; }
  if (!date)                { setTDError('tddate',     'Veuillez sélectionner une date.'); valid = false; }
  return valid;
}

document.getElementById('testdriveClose').addEventListener('click', closeTestDrive);
document.getElementById('testdriveBackdrop').addEventListener('click', closeTestDrive);
document.getElementById('ctaTestDrive').addEventListener('click', openTestDrive);

document.getElementById('testdriveForm').addEventListener('submit', e => {
  e.preventDefault();
  if (!validateTestDrive()) return;
  document.getElementById('testdriveForm').style.display = 'none';
  document.getElementById('testdriveSuccess').classList.add('show');
});

['tdname','tdemail','tdshowroom','tddate'].forEach(id => {
  const el = document.getElementById(id);
  if (!el) return;
  el.addEventListener('change', () => {
    el.classList.remove('error');
    const err = document.getElementById(id + 'Err');
    if (err) err.textContent = '';
  });
});

/* ════════════════════════════════════════════════════
   SHARE CONFIGURATION
════════════════════════════════════════════════════ */
function shareConfig() {
  const s = SLIDES[current];
  const params = new URLSearchParams({
    slide:       current,
    car:         s.lines.join('-'),
    color:       configState.color    ?? '',
    wheel:       configState.wheel    ?? '',
    interior:    configState.interior ?? '',
    performance: [...configState.performance].join(','),
  });
  const url = `${location.origin}${location.pathname}?${params.toString()}`;
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(() => showToast('Lien copié !'));
  } else {
    const ta = document.createElement('textarea');
    ta.value = url;
    ta.style.cssText = 'position:fixed;top:-9999px';
    document.body.appendChild(ta);
    ta.select();
    document.execCommand('copy');
    document.body.removeChild(ta);
    showToast('Lien copié !');
  }
}
