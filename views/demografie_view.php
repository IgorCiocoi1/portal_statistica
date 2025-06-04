<?php require_once '../controllers/DemografieController.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Demografice - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/demografie.css">
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
        <a href="http://localhost/portal_statistica/views/demografie_view.php" class="active-link"><img src="../assets/img/demography.png" alt="Demografie"><span>Demografie</span></a>
        <a href="http://localhost/portal_statistica/views/sanatate_view.php"><img src="../assets/img/health.png" alt="Sănătate"><span>Sănătate</span></a>
        <a href="http://localhost/portal_statistica/views/casatorii_view.php"><img src="../assets/img/marriage.png" alt="Căsătorii"><span>Căsătorii</span></a>
        <a href="http://localhost/portal_statistica/views/ocupare_view.php"><img src="../assets/img/work.png" alt="Ocupare"><span>Ocupare</span></a>
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

<main class="content-area">
  <section class="demografie-hero">
    <div class="demografie-hero-box">
      <h1 class="demografie-title">Statistici Demografice</h1>
      <hr class="demografie-line">
      <p class="demografie-description">
        Vizualizează evoluția populației tinere din Republica Moldova și predicțiile automate până în anul 2030.
        Graficele afișează tendințele pentru categoriile demografice: sex și mediu de reședință.
      </p>
    </div>
  </section>

  <hr class="section-divider">

  <section class="chart-wrapper">
    <div class="tab-container">
      <div class="tab-buttons">
        <button class="tab-btn active" data-mode="data">Date reale</button>
        <button class="tab-btn" data-mode="comparatie">Comparație</button>
        <button class="tab-btn" data-mode="predictie">Predicții</button>
      </div>
    </div>

    <div class="filters-bar">
      <div class="filter-group" id="filterSex">
        <label for="sexSelect">Sex:</label>
        <select id="sexSelect">
          <option value="Feminin">Feminin</option>
          <option value="Masculin">Masculin</option>
        </select>
      </div>

      <div class="filter-group" id="filterLocalitate">
        <label for="localitateSelect">Localitate:</label>
        <select id="localitateSelect">
          <option value="Urban">Urban</option>
          <option value="Rural">Rural</option>
        </select>
      </div>

      <div class="filter-group" id="taraFilterContainer" style="display: none;">
        <label>Compară cu:</label>
        <div class="flag-selector" id="taraFlags">
          <img src="../assets/img/flag_romania.png" data-tara="Romania" class="flag-img selected" alt="România">
          <img src="../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
          <img src="../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
          <img src="../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
        </div>
        <input type="hidden" id="taraSelectHidden" value="Romania">
      </div>
    </div>

    <div class="chart-area" id="chart-panel">
      <div class="chart-status" id="chartStatus"></div>
      <canvas id="unifiedChart"></canvas>
      <canvas id="predictiiChart" style="display:none;"></canvas>
    </div>
  </section>

    <hr class="section-divider">

<section class="statistici-cheie">
 <title>Informații Demografice Relevante</title>
    <style>
    </style>
    <section class="statistici-cheie">
        <h2 class="statistici-title">Informații Demografice Relevante</h2>
        <div class="info-grid">
            
            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <!-- Bloc urban -->
                        <path d="M5 21V7C5 6.46957 5.21071 5.96086 5.58579 5.58579C5.96086 5.21071 6.46957 5 7 5H13C13.5304 5 14.0391 5.21071 14.4142 5.58579C14.7893 5.96086 15 6.46957 15 7V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <!-- Ferestrele blocului -->
                        <path d="M8 8H10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 16H10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <!-- Casa rurala -->
                        <path d="M19 21V13L22 10L19 7V5H17V7L15 10L18 13V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Mediul de trai</h3>
                    <p>50.3% dintre tineri locuiesc în mediul urban, iar 49.7% în mediul rural.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Icon pentru repartizare pe sexe -->
                        <!-- Simbol feminin -->
                        <circle cx="9" cy="9" r="4" stroke="white" stroke-width="2"/>
                        <path d="M9 13V20" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M6 17H12" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <!-- Simbol masculin -->
                        <circle cx="17" cy="14" r="3" stroke="white" stroke-width="2"/>
                        <path d="M17 11V7" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M19 9L15 9" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Repartizare pe sexe</h3>
                    <p>Fetele reprezintă 51.8% din populația tânără, băieții 48.2%.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Icon pentru studii superioare -->
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 7V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 10V15C7 16.0609 7.42143 17.0783 8.17157 17.8284C8.92172 18.5786 9.93913 19 11 19H13C14.0609 19 15.0783 18.5786 15.8284 17.8284C16.5786 17.0783 17 16.0609 17 15V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 22V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Studii superioare</h3>
                    <p>Doar 37% dintre tineri au absolvit o formă de învățământ superior în 2024.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Icon pentru evoluție demografică -->
                        <path d="M3 3V21H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20 8L16 12L13 9L7 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 8H20V11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="7" cy="15" r="2" stroke="white" stroke-width="1.5" fill="none"/>
                    </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Evoluție demografică</h3>
                    <p>Populația tânără a scăzut cu aproximativ 9.8% între 2004 și 2024.</p>
                </div>
            </div>

        </div>
    </section>

<hr class="section-divider">

<section class="context-box">
  <div class="context-text">
    <div class="title-container">
      <h2 class=" ">Despre Contextul Demografic</h2>
      <div class="title-decoration"></div>
    </div>
    <p class="context-description">
      Tinerii din Republica Moldova reprezintă o categorie socială în continuă transformare. Analiza datelor demografice din ultimii ani relevă schimbări semnificative în distribuția acestora în funcție de sex, vârstă, localitate și nivel de educație.
      Platforma noastră aduce o perspectivă vizuală, analitică și predictivă asupra acestor tendințe, contribuind la o mai bună înțelegere a fenomenelor sociale.
    </p>
    <ul class="context-list">
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="25" fill="#7b4397" />
  <path d="M13 37L19 28L25 31L31 20L38 25" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none" />
  <circle cx="13" cy="37" r="2.5" fill="white" />
  <circle cx="19" cy="28" r="2.5" fill="white" />
  <circle cx="25" cy="31" r="2.5" fill="white" />
  <circle cx="31" cy="20" r="2.5" fill="white" />
  <circle cx="38" cy="25" r="2.5" fill="white" />
</svg>
        </div>
        <span class="item-text">Tendințe demografice clare și actualizate</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="25" fill="#7b4397" />
  <rect x="12" y="17" width="26" height="20" rx="2" stroke="white" stroke-width="2" fill="none" />
  <line x1="12" y1="22" x2="38" y2="22" stroke="white" stroke-width="2" />
  <line x1="18" y1="17" x2="18" y2="37" stroke="white" stroke-width="2" />
  <path d="M15 33L20 28L25 31L32 24L38 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="2 1" fill="none" />
</svg>
        </div>
        <span class="item-text">Date reale combinate cu modele predictive</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="25" fill="#7b4397" />
  <circle cx="25" cy="25" r="15" stroke="white" stroke-width="2" fill="none" />
  <path d="M10 25h30" stroke="white" stroke-width="1.5" />
  <path d="M25 10v30" stroke="white" stroke-width="1.5" />
  <path d="M25 25 M15 20h5v10h10v-15h-5" stroke="white" stroke-width="2" fill="none" />
  <path d="M16 14c-4 3-6 7-6 11 M34 36c-4 3-8 4-12 4" stroke="white" stroke-width="1.5" fill="none" />
</svg>
        </div>
        <span class="item-text">Comparabilitate internațională</span>
      </li>
    </ul>
  </div>

  <div class="context-image-wrapper">
    <div class="image-decoration"></div>
    <div class="context-image">
      <div class="image-overlay"></div>
      <img src="../assets/img/populatie_info.png" alt="Context educațional">
      <div class="floating-badge">Date 2024</div>
    </div>
    <div class="dots-decoration"></div>
  </div>
</section>

<hr class="section-divider">

<section class="context-box export-section">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="export-container">
    <div class="export-card">
      <div class="export-wrapper">
        <!-- Coloana stângă cu imagine și efecte -->
        <div class="export-image-column">
          <!-- Particule decorative -->
          <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
          </div>
          <img src="../assets/img/export.png" alt="Date educaționale" class="export-image">
        </div>
        
        <!-- Coloana dreaptă cu conținut -->
        <div class="export-content-column">
          <!-- Conținut inițial -->
          <div class="export-intro" id="exportIntro">
            <h2 class="export-title">Exportă date demogarfice</h2>
            <p class="export-description">
              Tinerii din Republica Moldova reprezintă o categorie socială în continuă transformare.
              Accesează datele demografice despre aceștia și descarcă-le în format Excel sau CSV.
              Poți filtra după an, sex, localitate și vârstă.
            </p>
            <button class="export-button" id="showExportBtn">
              <i class="fas fa-database export-button-icon"></i>
              Exportă date
            </button>
          </div>
          
          <!-- Interfața de export (inițial ascunsă) -->
          <div class="export-interface" id="exportInterface">
            <button class="export-back" id="backToIntroBtn">
              <i class="fas fa-arrow-left"></i> Înapoi
            </button>
            
            <!-- Taburi export -->
            <div class="export-tabs">
              <button class="export-tab active" data-tab="reale">
                <i class="fas fa-table export-tab-icon"></i> Date reale
              </button>
              <button class="export-tab" data-tab="comparatie">
                <i class="fas fa-chart-bar export-tab-icon"></i> Comparație
              </button>
              <button class="export-tab" data-tab="predictie">
                <i class="fas fa-chart-line export-tab-icon"></i> Predicție
              </button>
            </div>
            
            <!-- Conținut taburi -->
            <div class="tab-content active" id="reale">
              <form action="../core/export_demografie.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label" for="an-reale">An:</label>
                  <select id="an-reale" name="an" class="form-select">
                    <option value="">Toți</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="sex-reale">Sex:</label>
                  <select id="sex-reale" name="sex" class="form-select">
                    <option value="">Toți</option>
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="localitate-reale">Localitate:</label>
                  <select id="localitate-reale" name="localitate" class="form-select">
                    <option value="">Toate</option>
                    <option value="Urban">Urban</option>
                    <option value="Rural">Rural</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="varsta-reale">Vârstă:</label>
                  <select id="varsta-reale" name="varsta" class="form-select">
                    <option value="">Toate</option>
                    <option value="14">14 ani</option>
                    <option value="15">15 ani</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="nivel-reale">Nivel de studii:</label>
                  <select id="nivel-reale" name="nivel_de_studii" class="form-select">
                    <option value="">Toate</option>
                    <option value="Fara studii">Fără studii</option>
                    <option value="Gimnaziale">Gimnaziale</option>
                    <option value="Liceale">Liceale</option>
                    <option value="Profesionale">Profesionale</option>
                    <option value="Superioare">Superioare</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="format-reale">Format:</label>
                  <select id="format-reale" name="format" class="form-select">
                    <option value="xlsx">Excel</option>
                    <option value="csv">CSV</option>
                  </select>
                </div>
                
                <button type="submit" class="form-submit">
                  <i class="fas fa-download"></i> Descarcă datele
                </button>
              </form>
            </div>
            
            <div class="tab-content" id="comparatie">
              <form action="../controllers/export_comparatie_demografie.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label" for="tara-comp">Țara:</label>
                  <select id="tara-comp" name="tara" class="form-select">
                     <option value="">Toate</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Romania">România</option>
                    <option value="Italia">Italia</option>
                    <option value="Germania">Germania</option>
                    <option value="Franta">Franța</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="nivel-comp">Nivel de studii:</label>
                  <select id="nivel-comp" name="nivel_de_studii" class="form-select">
                    <option value="">Toate</option>
                    <option value="Fara studii">Fără studii</option>
                    <option value="Gimnaziale">Gimnaziale</option>
                    <option value="Liceale">Liceale</option>
                    <option value="Profesionale">Profesionale</option>
                    <option value="Superioare">Superioare</option>
                  </select>
                </div>
                
    <div class="form-group">
      <label class="form-label" for="format-comp">Format:</label>
      <select id="format-comp" name="format" class="form-select">
        <option value="csv" selected>CSV</option>
        <option value="xlsx">Excel</option>
      </select>
    </div>
                
                <button type="submit" class="form-submit">
                  <i class="fas fa-download"></i> Descarcă datele
                </button>
              </form>
            </div>
            
            <div class="tab-content" id="predictie">
              <form action="../models/export/export_predictii_demografie.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label" for="an-pred">An:</label>
                  <select id="an-pred" name="an" class="form-select">
                    <option value="">Toți</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                  </select>
                </div>

                    <div class="form-group">
      <label class="form-label" for="sex-pred">Sex:</label>
      <select id="sex-pred" name="sex" class="form-select">
        <option value="">Toți</option>
        <option value="Masculin">Masculin</option>
        <option value="Feminin">Feminin</option>
      </select>
    </div>
                
    <div class="form-group">
      <label class="form-label" for="format-pred">Format:</label>
      <select id="format-pred" name="format" class="form-select">
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
let currentMode = 'data';
let currentTara = 'Romania';
let unifiedChart = null;
let predictiiChart = null;

const chartCanvas = document.getElementById("unifiedChart");
const predictiiCanvas = document.getElementById("predictiiChart");
const chartStatus = document.getElementById("chartStatus");
const sexSelect = document.getElementById("sexSelect");
const localitateSelect = document.getElementById("localitateSelect");
const tabButtons = document.querySelectorAll(".tab-btn");
const flagSelector = document.getElementById("taraFlags");
const taraHiddenInput = document.getElementById("taraSelectHidden");
const taraFilterContainer = document.getElementById("taraFilterContainer");
const localitateFilter = document.getElementById("filterLocalitate");

function showStatus(text) {
    chartStatus.textContent = text;
    chartStatus.style.display = "flex";
}
function hideStatus() {
    chartStatus.textContent = "";
    chartStatus.style.display = "none";
}

function fetchData() {
    showStatus("Se încarcă...");
    const sex = sexSelect.value;
    const loc = localitateSelect.value;
    let url = "";

    if (currentMode === "data") {
        url = `../controllers/DemografieController.php?action=getData&sex=${sex}&localitate=${loc}`;
    } else if (currentMode === "comparatie") {
        url = `../controllers/DemografieController.php?action=getComparatieData&tara=${currentTara}&sex=${sex}`;
    } else if (currentMode === "predictie") {
        url = `../controllers/predictii_demografie.php?sex=${sex}`;
    }

    fetch(url)
        .then(res => res.json())
        .then(data => {
            buildChart(data);
            hideStatus();
        })
        .catch(err => {
            showStatus("Eroare la încărcare date.");
            console.error(err);
        });
}


function buildChart(data) {
    if (unifiedChart) unifiedChart.destroy();
    if (predictiiChart) predictiiChart.destroy();

    chartCanvas.style.display = currentMode !== 'predictie' ? 'block' : 'none';
    predictiiCanvas.style.display = currentMode === 'predictie' ? 'block' : 'none';

    let ctx, labels = [], datasets = [], titleText = '';

    if (currentMode === 'predictie') {
        ctx = predictiiCanvas.getContext("2d");
        labels = data.map(d => d.Anul);
        const values = data.map(d => d.Numar);
        titleText = "Predicții Demografice (2025–2030)";
        predictiiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: "Populație (prezisă)",
                    data: values,
                    backgroundColor: "rgba(155, 89, 182, 0.2)",
                    borderColor: "rgba(155, 89, 182, 1)",
                    fill: true,
                    tension: 0.4
                }]
            }
        });
        return;
    }

    ctx = chartCanvas.getContext("2d");

    if (currentMode === "comparatie") {
        const mdData = data.filter(d => d.Tara === "Moldova");
        const taraData = data.filter(d => d.Tara === currentTara);
        labels = [...new Set([...mdData.map(d => d.Anul), ...taraData.map(d => d.Anul)])].sort();
        const valuesMoldova = labels.map(an => mdData.find(d => d.Anul == an)?.Numar || null);
        const valuesTara = labels.map(an => taraData.find(d => d.Anul == an)?.Numar || null);
        titleText = "Evoluție Demografică (comparație)";

        datasets.push({
            label: "Moldova",
            data: valuesMoldova,
            borderColor: "rgba(155, 89, 182, 1)",
            backgroundColor: "rgba(155, 89, 182, 0.2)",
            fill: false
        });
        datasets.push({
            label: currentTara,
            data: valuesTara,
            borderColor: "rgba(255, 159, 67, 1)",
            backgroundColor: "rgba(255, 159, 67, 0.2)",
            fill: false
        });
    } else {
        labels = data.map(row => row.Anul);
        const values = data.map(row => row.Numar);
        titleText = "Evoluție Demografică (date reale)";
        datasets.push({
            label: "Populație",
            data: values,
            fill: true,
            backgroundColor: "rgba(255, 159, 67, 0.2)",
            borderColor: "rgba(255, 159, 67, 1)",
            tension: 0.4
        });
    }

    unifiedChart = new Chart(ctx, {
        type: "line",
        data: { labels, datasets }
    });
}

sexSelect.addEventListener("change", fetchData);
localitateSelect.addEventListener("change", fetchData);
tabButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        tabButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        currentMode = btn.dataset.mode;

        taraFilterContainer.style.display = currentMode === 'comparatie' ? 'flex' : 'none';
        localitateFilter.style.display = currentMode === 'data' ? 'flex' : 'none';

        fetchData();
    });
});

flagSelector.addEventListener('click', e => {
    const img = e.target.closest('.flag-img');
    if (img && img.dataset.tara && img.dataset.tara !== currentTara) {
        currentTara = img.dataset.tara;
        taraHiddenInput.value = currentTara;
        document.querySelectorAll('.flag-img').forEach(i => i.classList.remove('selected'));
        img.classList.add('selected');
        if (currentMode === 'comparatie') fetchData();
    }
});

document.addEventListener("DOMContentLoaded", fetchData);
</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const showExportBtn = document.getElementById("showExportBtn");
    const backToIntroBtn = document.getElementById("backToIntroBtn");

    const exportIntro = document.getElementById("exportIntro");
    const exportInterface = document.getElementById("exportInterface");

    const exportTabs = document.querySelectorAll(".export-tab");
    const tabContents = document.querySelectorAll(".tab-content");

    // Afișează interfața de export când se apasă pe buton
    showExportBtn.addEventListener("click", () => {
      exportIntro.classList.add("hidden");
      exportInterface.classList.add("visible");
    });

    // Înapoi la introducere
    backToIntroBtn.addEventListener("click", () => {
      exportIntro.classList.remove("hidden");
      exportInterface.classList.remove("visible");
    });

    // Comutarea între taburi
    exportTabs.forEach(tab => {
      tab.addEventListener("click", () => {
        exportTabs.forEach(t => t.classList.remove("active"));
        tabContents.forEach(c => c.classList.remove("active"));

        tab.classList.add("active");
        const selectedTab = tab.getAttribute("data-tab");
        document.getElementById(selectedTab).classList.add("active");
      });
    });
  });
</script>


</body>
</html>