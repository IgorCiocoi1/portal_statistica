<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Ocupare - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/ocupare.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="index.php" class="logo">
        <img src="../assets/img/logo.png" alt="Logo">
        <span>Portal Statistică</span>
    </a>
    <nav>
        <a href="http://localhost/portal_statistica/index.php"><img src="../assets/img/home.png" alt="Acasă"><span>Acasă</span></a>
        <a href="http://localhost/portal_statistica/views/educatie_view.php"><img src="../assets/img/education.png" alt="Educație"><span>Educație</span></a>
        <a href="http://localhost/portal_statistica/views/demografie_view.php"><img src="../assets/img/demography.png" alt="Demografie"><span>Demografie</span></a>
        <a href="http://localhost/portal_statistica/views/sanatate_view.php"><img src="../assets/img/health.png" alt="Sănătate"><span>Sănătate</span></a>
        <a href="http://localhost/portal_statistica/views/casatorii_view.php"><img src="../assets/img/marriage.png" alt="Căsătorii"><span>Căsătorii</span></a>
        <a href="http://localhost/portal_statistica/views/ocupare_view.php" class="active-link"><img src="../assets/img/work.png" alt="Ocupare"><span>Ocupare</span></a>
    </nav>
</div>


  <!-- Header -->
  <header>
    <div class="site-name">
      <img src="../assets/img/logo.png" alt="Logo">
      <div class="title">
        <span class="blue">Portal</span>
        <span class="dark">Statistică</span>
      </div>
    </div>
  </header>

<main class="content-area" id="main-content">
    <section class="educatie-hero">
        <div class="educatie-hero-box">
            <h1 class="educatie-title">Statistici Ocupare</h1>
            <hr class="educatie-line">
            <p class="educatie-description">Vizualizează evoluția angajării tinerilor în Republica Moldova în funcție de indicatori.</p>
        </div>
    </section>

    <hr class="section-divider">

    <section class="chart-wrapper">
        <div class="tab-container">
            <div class="tab-buttons">
        <button class="tab-btn active" onclick="loadRealData()">Date reale</button>
        <button class="tab-btn" onclick="loadComparisonData()">Comparație</button>
        <button class="tab-btn" onclick="loadPredictionData()">Predicție</button>
            </div>
        </div>

        <div class="filters-bar" id="filters-bar">
  <div class="filter-group">
    <label for="indicatorSelect">Indicator:</label>
    <select id="indicatorSelect">
      <option value="Numar_angajati" selected>Angajați</option>
      <option value="Numar_someri">Șomeri</option>
      <option value="Numar_neactivi">Neactivi</option>
    </select>
  </div>

  <div class="filter-group" id="taraFilterContainer" style="display: none;">
    <label for="taraFlags">Compară cu:</label>
    <div class="flag-selector" id="taraFlags" onclick="updateCountry(event)">
      <img src="../assets/img/flag_romania.png" data-tara="Romania" class="flag-img" alt="România">
      <img src="../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
      <img src="../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
      <img src="../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
    </div>
    <input type="hidden" id="taraSelectHidden" value="Romania">
  </div>
</div>


    <div class="chart-container" id="chart-panel">
      <div class="chart-status" id="chartStatus"></div>
      <canvas id="unifiedChart"></canvas>
    </div>

    <div class="filters-bar" id="filters-predictie" style="display:none">
  <div class="filter-group">
    <label for="indicatorPredictie">Indicator:</label>
    <select id="indicatorPredictie">
      <option value="">Toți</option> 
      <option value="Numar_angajati">Angajați</option>
      <option value="Numar_someri">Șomeri</option>
      <option value="Numar_neactivi">Neactivi</option>
    </select>
  </div>
</div>
  </section>

  <section class="statistici-cheie">
  <h2 class="statistici-title">Informații despre Ocuparea Tinerilor</h2>
  <div class="info-grid">

    <div class="info-card">
      <div class="info-icon-container">
        <div class="info-icon-bg"></div>
        <div class="info-icon">
          <!-- Iconă educație -->
           <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 21H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5 21V16L9 10L13 14L17 8L21 12V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7 21V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 21V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15 21V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19 21V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
      <div class="info-text">
        <h3>Creșterea angajării în mediul urban</h3>
        <p>În ultimii 20 de ani, tinerii din mediul urban au prezentat o rată de angajare cu 35% mai mare decât cei din mediul rural.</p>
      </div>
    </div>

    <div class="info-card">
      <div class="info-icon-container">
        <div class="info-icon-bg"></div>
        <div class="info-icon">
          <!-- Iconă șomaj -->
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="8" r="4" stroke="white" stroke-width="2"/>
            <path d="M6 21V19C6 16.7909 7.79086 15 10 15H14C16.2091 15 18 16.7909 18 19V21" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <path d="M8 3L6 5M16 3L18 5" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <path d="M3 12H5M19 12H21" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <path d="M4 4L2 6M20 4L22 6" stroke="white" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
      <div class="info-text">
        <h3>Șomajul în rândul fetelor din rural</h3>
        <p>Fetele din zonele rurale au fost mai afectate de șomaj, cu o medie de peste 70 de cazuri anual în rândul adolescenților de 14–20 ani.</p>
      </div>
    </div>

    <div class="info-card">
      <div class="info-icon-container">
        <div class="info-icon-bg"></div>
        <div class="info-icon">
          <!-- Iconă tineri neactivi -->
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 17L9 11L13 15L21 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 7V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15 7H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="6" cy="20" r="2" stroke="white" stroke-width="2"/>
            <circle cx="12" cy="20" r="2" stroke="white" stroke-width="2"/>
            <circle cx="18" cy="20" r="2" stroke="white" stroke-width="2"/>
          </svg>
        </div>
      </div>
      <div class="info-text">
        <h3>Tineri neactivi în scădere</h3>
        <p>Procentul tinerilor neactivi a început să scadă constant după 2015, în special în rândul băieților din mediul urban.</p>
      </div>
    </div>

    <div class="info-card">
      <div class="info-icon-container">
        <div class="info-icon-bg"></div>
        <div class="info-icon">
          <!-- Iconă tendință generală -->
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="9" cy="7" r="3" stroke="white" stroke-width="2"/>
            <circle cx="15" cy="7" r="3" stroke="white" stroke-width="2"/>
            <path d="M3 21V19C3 17.3431 4.34315 16 6 16H12C13.6569 16 15 17.3431 15 19V21" stroke="white" stroke-width="2"/>
            <path d="M16 16H18C19.6569 16 21 17.3431 21 19V21" stroke="white" stroke-width="2"/>
            <path d="M12 2V4" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 2L19 4" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <path d="M6 2L5 4" stroke="white" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
      <div class="info-text">
        <h3>Tendințe generale</h3>
        <p>Majoritatea tinerilor activi economic au vârste între 18 și 24 de ani, iar nivelul de ocupare crește semnificativ după vârsta de 20 de ani.</p>
      </div>
    </div>

  </div>
</section>

<hr class="section-divider">

<section class="context-box">
  <div class="context-text">
    <div class="title-container">
      <h2>Despre Contextul Ocupării Tinerilor</h2>
      <div class="title-decoration"></div>
    </div>
    <p class="context-description">
      Ocuparea forței de muncă în rândul tinerilor din Republica Moldova reflectă schimbările economice și sociale din ultimii ani.
      Analizele noastre evidențiază diferențe notabile între sexe, medii de rezidență și grupe de vârstă, oferind o perspectivă clară asupra integrării acestora pe piața muncii.
      Platforma oferă date reale, comparații internaționale și predicții pentru viitorul profesional al tinerei generații.
    </p>
    <ul class="context-list">
      <li class="list-item">
        <div class="icon-container">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="7" r="2" stroke="currentColor" stroke-width="2"/>
                    <circle cx="15" cy="7" r="2" stroke="currentColor" stroke-width="2"/>
                    <path d="M5 20V18C5 16.3431 6.34315 15 8 15H10C11.6569 15 13 16.3431 13 18V20" stroke="currentColor" stroke-width="2"/>
                    <path d="M13 20V18C13 16.3431 14.3431 15 16 15H18C19.6569 15 21 16.3431 21 18V20" stroke="currentColor" stroke-width="2"/>
                    <path d="M3 9L6 6L9 9L12 6L15 9L18 6L21 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
        </div>
        <span class="item-text">Analize ale ocupării în funcție de vârstă și sex</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
              <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 21H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 21V7L9 3V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13 21V11L17 7V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 9V9.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 13V13.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 11V11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 15V15.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1 21H4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20 21H23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </div>
        <span class="item-text">Comparații între mediul urban și rural</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
               <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 10C21 16.075 16.075 21 10 21C3.925 21 -1 16.075 -1 10C-1 3.925 3.925 -1 10 -1C16.075 -1 21 3.925 21 10Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M21 21L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 8L8 10L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 2L6 6M18 6L22 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 2V6M12 18V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </div>
        <span class="item-text">Predicții pentru ocupare până în 2030</span>
      </li>
    </ul>
  </div>

  <div class="context-image-wrapper">
    <div class="image-decoration"></div>
    <div class="context-image">
      <div class="image-overlay"></div>
      <img src="../assets/img/ocupare_bg.png" alt="Context ocupare tineri">
      <div class="floating-badge">Date 2024</div>
    </div>
    <div class="dots-decoration"></div>
  </div>
</section>

<hr class="section-divider">

<section class="context-box export-section">
  <div class="export-container">
    <div class="export-card">
      <div class="export-wrapper">

        <!-- Imagine stânga -->
        <div class="export-image-column">
          <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
          </div>
          <img src="../assets/img/export_ocupare.png" alt="Export date ocupare" class="export-image">
        </div>

        <!-- Conținut dreapta -->
        <div class="export-content-column">
          <div class="export-intro" id="exportIntro-ocupare">
            <h2 class="export-title">Exportă datele despre ocupare</h2>
            <p class="export-description">
              Accesează și descarcă date statistice despre ocuparea tinerilor în Republica Moldova. Alege parametrii doriți și exportă în format CSV sau Excel.
            </p>
            <button class="export-button" id="showExportBtn-ocupare">
              <i class="fas fa-database export-button-icon"></i>
              Exportă date
            </button>
          </div>

          <div class="export-interface" id="exportInterface-ocupare">
            <button class="export-back" id="backToIntroBtn-ocupare">
              <i class="fas fa-arrow-left"></i> Înapoi
            </button>

            <!-- Taburi -->
            <div class="export-tabs">
              <button class="export-tab active" data-tab="reale">Date reale</button>
              <button class="export-tab" data-tab="comparatie">Comparație</button>
              <button class="export-tab" data-tab="predictie">Predicție</button>
            </div>

            <!-- Conținut: Date reale -->
            <div class="tab-content active" id="reale">
              <form action="../core/export_ocupare.php" method="get" class="export-form">
<div class="form-group">
  <label class="form-label">An:</label>
  <select name="an" class="form-select">
    <option value="">Toți anii</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Sex:</label>
                  <select name="sex" class="form-select">
                    <option value="">Toți</option>
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Localitate:</label>
                  <select name="localitate" class="form-select">
                    <option value="">Toate</option>
                    <option value="Urban">Urban</option>
                    <option value="Rural">Rural</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Vârstă:</label>
                  <select name="varsta" class="form-select">
                    <option value="">Toate</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Format:</label>
                  <select name="format" class="form-select">
                    <option value="xlsx">Excel</option>
                    <option value="csv">CSV</option>
                  </select>
                </div>
                <button type="submit" class="form-submit">
                  <i class="fas fa-download"></i> Descarcă datele
                </button>
              </form>
            </div>

            <!-- Conținut: Comparație -->
            <div class="tab-content" id="comparatie">
              <form action="../controllers/export_comparatie_ocupare.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label">Țara:</label>
                  <select name="tara" class="form-select">
                    <option value="">Toate</option> <!-- Adăugat -->
                    <option value="Romania">România</option>
                    <option value="Germania">Germania</option>
                    <option value="Italia">Italia</option>
                    <option value="Franta">Franța</option>
                  </select>
                </div>
<div class="form-group">
  <label class="form-label">Indicator:</label>
  <select name="indicator" class="form-select">
    <option value="">Toți indicatorii</option>
    <option value="Numar_angajati">Angajați</option>
    <option value="Numar_someri">Șomeri</option>
    <option value="Numar_neactivi">Neactivi</option>
  </select>
</div>

                <div class="form-group">
                  <label class="form-label">Format:</label>
                  <select name="format" class="form-select">
                    <option value="csv" selected>CSV</option>
                    <option value="xlsx">Excel</option>
                  </select>
                </div>
                <button type="submit" class="form-submit">
                  <i class="fas fa-download"></i> Descarcă comparația
                </button>
              </form>
            </div>

            <!-- Conținut: Predicție -->
            <div class="tab-content" id="predictie">
              <form action="../models/export/export_predictii_ocupare.php" method="get" class="export-form">
<div class="form-group">
  <label class="form-label">An:</label>
  <select name="an" class="form-select">
    <option value="">Toți anii</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030!</option>
  </select>
</div>

                <div class="form-group">
                  <label class="form-label">Format:</label>
                  <select name="format" class="form-select">
                    <option value="csv">CSV</option>
                    <option value="xlsx">Excel</option>
                  </select>
                </div>
                <button type="submit" class="form-submit">
                  <i class="fas fa-download"></i> Descarcă predicțiile
                </button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


</main>

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-left">
      <p class="footer-copy">© 2025 <strong>Portal Statistică</strong></p>
      <p class="footer-sub">Creat pentru analiza comportamentului tinerilor din Republica Moldova.</p>
    </div>
    <div class="footer-right">
      <a href="mailto:contact@portalstatistica.md" class="footer-link">
        <i class="fas fa-envelope"></i> contact@portalstatistica.md
      </a>
      <a href="https://utm.md" target="_blank" class="footer-link">
        <i class="fas fa-graduation-cap"></i> UTM
      </a>
    </div>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
  let currentMode = 'data';
  let currentTara = 'Romania';
  let currentIndicator = 'Numar_angajati';
  let unifiedChart;

  const chartCanvas = document.getElementById('unifiedChart');
  const indicatorSelect = document.getElementById('indicatorSelect');
  const indicatorPredictie = document.getElementById('indicatorPredictie');
  const chartStatus = document.getElementById('chartStatus');
  const flagImages = document.querySelectorAll('.flag-img');
  const taraHiddenInput = document.getElementById('taraSelectHidden');
  const taraFilterContainer = document.getElementById('taraFilterContainer');
  const tabButtons = document.querySelectorAll('.tab-btn');
  const predictieFilter = document.getElementById('filters-predictie');

  const showLoading = () => {
    chartStatus.textContent = 'Se încarcă datele...';
    chartStatus.style.display = 'block';
    taraFilterContainer.style.display = currentMode === 'comparatie' ? 'flex' : 'none';
    predictieFilter.style.display = currentMode === 'predictie' ? 'flex' : 'none';
  };

  const hideLoading = () => {
    chartStatus.textContent = '';
    chartStatus.style.display = 'none';
  };

  const updateActiveTab = () => {
    tabButtons.forEach(btn => btn.classList.remove('active'));
    if (currentMode === 'data') tabButtons[0].classList.add('active');
    else if (currentMode === 'comparatie') tabButtons[1].classList.add('active');
    else if (currentMode === 'predictie') tabButtons[2].classList.add('active');
  };

  const updateChart = async () => {
    showLoading();
    updateActiveTab();

    let url = '';
    if (currentMode === 'data') {
      url = `../controllers/OcupareController.php?tip=date&indicator=${currentIndicator}`;
    } else if (currentMode === 'comparatie') {
      url = `../controllers/OcupareController.php?tip=comparatie&tarea=${currentTara}&indicator=${currentIndicator}`;
    } else {
      url = `../controllers/OcupareController.php?tip=predictie&indicator=${currentIndicator}`;
    }

    try {
      const response = await fetch(url);
      const data = await response.json();
      if (!Array.isArray(data) || data.length === 0) throw new Error("Datele nu au fost returnate corect.");

      const labels = data.map(row => row.Anul);
      let datasets = [];

      if (currentMode === 'comparatie') {
        const mdData = labels.map(an => {
          const entry = data.find(d => d.Tara === 'Moldova' && d.Anul === an);
          return entry ? parseInt(entry.Numar || 0) : 0;
        });
        const compData = labels.map(an => {
          const entry = data.find(d => d.Tara === currentTara && d.Anul === an);
          return entry ? parseInt(entry.Numar || 0) : 0;
        });

        datasets = [
          {
            label: 'Moldova',
            data: mdData,
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.15)',
            fill: true
          },
          {
            label: currentTara,
            data: compData,
            borderColor: '#059669',
            backgroundColor: 'rgba(5, 150, 105, 0.15)',
            fill: true
          }
        ];
      } else {
        const values = data.map(row => parseInt(row.Numar || row.Valoare || 0));
        datasets = [{
          label: currentMode === 'predictie' ? `Predicție ${getIndicatorLabel(currentIndicator)}` : getIndicatorLabel(currentIndicator),
          data: values,
          borderColor: '#10b981',
          backgroundColor: 'rgba(16, 185, 129, 0.2)',
          fill: true,
          tension: 0.4,
          pointRadius: 4,
          pointHoverRadius: 6
        }];
      }

      if (unifiedChart) unifiedChart.destroy();
      unifiedChart = new Chart(chartCanvas, {
        type: 'line',
        data: { labels: labels, datasets: datasets },
        options: {
          responsive: true,
          plugins: {
            title: {
              display: true,
              text: currentMode === 'comparatie' ? `Comparație ${getIndicatorLabel(currentIndicator)}`
                  : currentMode === 'predictie' ? `Predicție ${getIndicatorLabel(currentIndicator)}`
                  : `Evoluție ${getIndicatorLabel(currentIndicator)}`
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: { precision: 0 }
            }
          }
        }
      });

      hideLoading();
    } catch (err) {
      chartStatus.textContent = 'Eroare la încărcarea datelor.';
      console.error(err);
    }
  };

  const getIndicatorLabel = (indicator) => {
    switch (indicator) {
      case 'Numar_angajati': return 'Angajați';
      case 'Numar_someri': return 'Șomeri';
      case 'Numar_neactivi': return 'Neactivi';
      default: return indicator;
    }
  };

  window.loadRealData = () => { currentMode = 'data'; updateChart(); };
  window.loadComparisonData = () => { currentMode = 'comparatie'; updateChart(); };
  window.loadPredictionData = () => { currentMode = 'predictie'; updateChart(); };

  window.updateCountry = (e) => {
    const flag = e.target.closest('.flag-img');
    if (flag) {
      currentTara = flag.dataset.tara;
      taraHiddenInput.value = currentTara;
      flagImages.forEach(img => img.classList.remove('selected'));
      flag.classList.add('selected');
      updateChart();
    }
  };

  indicatorSelect.addEventListener('change', (e) => {
    currentIndicator = e.target.value;
    updateChart();
  });

  indicatorPredictie?.addEventListener('change', (e) => {
    currentIndicator = e.target.value;
    updateChart();
  });

  updateChart(); // inițializare
});

function loadPredictionData() {
  const indicator = document.getElementById('indicatorPredictie').value;
  const an = document.getElementById('anSelect')?.value || ''; // ← opțional
  const url = `../controllers/OcupareController.php?tip=predictie&indicator=${indicator}&an=${an}`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      updatePredictieChart(data);
    });
}

</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const showExportBtn = document.getElementById("showExportBtn-ocupare");
  const exportIntro = document.getElementById("exportIntro-ocupare");
  const exportInterface = document.getElementById("exportInterface-ocupare");
  const backToIntroBtn = document.getElementById("backToIntroBtn-ocupare");
  const exportTabs = document.querySelectorAll(".export-tab");
  const tabContents = document.querySelectorAll(".tab-content");

  // Afișează interfața de export
  showExportBtn?.addEventListener("click", () => {
    exportIntro.classList.add("hidden");
    setTimeout(() => {
      exportInterface.classList.add("visible");
    }, 300);
  });

  // Înapoi la introducere
  backToIntroBtn?.addEventListener("click", () => {
    exportInterface.classList.remove("visible");
    setTimeout(() => {
      exportIntro.classList.remove("hidden");
    }, 300);
  });

  // Schimbare taburi
  exportTabs.forEach(tab => {
    tab.addEventListener("click", function () {
      exportTabs.forEach(t => t.classList.remove("active"));
      tabContents.forEach(c => c.classList.remove("active"));

      this.classList.add("active");
      const tabId = this.getAttribute("data-tab");
      const content = document.getElementById(tabId);
      if (content) content.classList.add("active");
    });
  });
});
</script>






</body>
</html>
