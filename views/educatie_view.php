<?php require_once '../controllers/EducatieController.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Educaționale - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/educatie.css">
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
        <a href="http://localhost/portal_statistica/views/educatie_view.php" class="active-link"><img src="../assets/img/education.png" alt="Educație"><span>Educație</span></a>
        <a href="http://localhost/portal_statistica/views/demografie_view.php"><img src="../assets/img/demography.png" alt="Demografie"><span>Demografie</span></a>
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

<main class="content-area" id="main-content">
    <section class="educatie-hero">
        <div class="educatie-hero-box">
            <h1 class="educatie-title">Statistici Educaționale</h1>
            <hr class="educatie-line">
            <p class="educatie-description">
                Vizualizează evoluția nivelului de educație în Republica Moldova și predicțiile automate până în anul 2030.
                Graficele afișează tendințele pentru nivelurile: fără studii, gimnaziale, liceale, profesionale și superioare.
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
            <div class="filter-group" id="filterNivel">
                <label for="nivelSelectGeneral">Nivel studii:</label>
                <select id="nivelSelectGeneral">
                    <option value="Fara studii">Fără studii</option>
                    <option value="Gimnaziale">Gimnaziale</option>
                    <option value="Liceale">Liceale</option>
                    <option value="Profesionale">Profesionale</option>
                    <option value="Superioare">Superioare</option>
                </select>
            </div>

            <div class="filter-group" id="taraFilterContainer" style="display: none;">
                <label for="taraFlags">Compară cu:</label>
                <div class="flag-selector" id="taraFlags">
                    <img src="../assets/img/flag_romania.png" data-tara="Romania" class="flag-img selected" alt="România">                    
                    <img src="../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
                    <img src="../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
                    <img src="../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
                </div>
                <input type="hidden" id="taraSelectHidden" value="Romania"> 
            </div>
        </div>
             <div class="chart-container" id="chart-panel" role="tabpanel" aria-labelledby="tab-data">
             <div class="chart-status" id="chartStatus"></div> <canvas id="unifiedChart"></canvas> </div>
    </section>

    <hr class="section-divider">

<section class="statistici-cheie">
 <title>Informații Educaționale Relevante</title>
    <style>
    </style>
    <section class="statistici-cheie">
        <h2 class="statistici-title">Informații Educaționale Relevante</h2>
        <div class="info-grid">
            
            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Absolvenți de studii superioare</h3>
                    <p>În 2024, aproximativ 37% dintre tinerii din Moldova au absolvit studii superioare.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 19.5C4 18.837 4.26339 18.2011 4.73223 17.7322C5.20107 17.2634 5.83696 17 6.5 17H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.5 2H20V22H6.5C5.83696 22 5.20107 21.7366 4.73223 21.2678C4.26339 20.7989 4 20.163 4 19.5V4.5C4 3.83696 4.26339 3.20107 4.73223 2.73223C5.20107 2.26339 5.83696 2 6.5 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 10H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 14H12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Rata de promovare</h3>
                    <p>Peste 80% dintre tinerii care au finalizat liceul în 2024 au promovat examenele de bacalaureat.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5 21V7L13 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 21V11L13 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 9V9.01" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 13V13.01" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 17V17.01" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Educație profesională</h3>
                    <p>Aproximativ 28% dintre tineri au ales o formă de educație profesională în 2024.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 20V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 20V4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 20V14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Evoluția nivelului de studii</h3>
                    <p>Proporția tinerilor cu studii superioare a crescut cu 12% în ultimul deceniu.</p>
                </div>
            </div>

        </div>
    </section>

<hr class="section-divider">

<section class="context-box">
  <div class="context-text">
    <div class="title-container">
      <h2 class=" ">Despre Contextul Educațional</h2>
      <div class="title-decoration"></div>
    </div>
    <p class="context-description">
      Educația tinerilor din Republica Moldova este un pilon esențial în dezvoltarea societății. Analiza datelor educaționale relevă tendințe semnificative în distribuția acestora în funcție de vârstă, sex, localitate și nivel de studii.
      Platforma noastră oferă o perspectivă vizuală și analitică asupra acestor tendințe, facilitând o mai bună înțelegere a dinamicii educaționale.
    </p>
    <ul class="context-list">
      <li class="list-item">
        <div class="icon-container">
          <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 4V10H7V4H19ZM19 12V18H7V12H19ZM21 2H5V10H3V2H1V22H3V14H5V22H21V2ZM9 6H11V8H9V6ZM9 14H11V16H9V14Z" fill="currentColor"/>
          </svg>
        </div>
        <span class="item-text">Tendințe educaționale actualizate</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
          <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 9H20M4 15H20M8 5V19M16 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5 5H19V19H5V5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="4" y="3" width="4" height="4" fill="currentColor"/>
            <rect x="16" y="3" width="4" height="4" fill="currentColor"/>
            <rect x="16" y="17" width="4" height="4" fill="currentColor"/>
            <rect x="4" y="17" width="4" height="4" fill="currentColor"/>
          </svg>
        </div>
        <span class="item-text">Date reale integrate cu modele predictive</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
          <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
            <path d="M11 11.5V6H13V11.5H18.5V13.5H13V19H11V13.5H5.5V11.5H11Z" fill="currentColor"/>
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
      <img src="../assets/img/education_info.png" alt="Context educațional">
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
          <img src="../assets/img/export_data.png" alt="Date educaționale" class="export-image">
        </div>
        
        <!-- Coloana dreaptă cu conținut -->
        <div class="export-content-column">
          <!-- Conținut inițial -->
          <div class="export-intro" id="exportIntro">
            <h2 class="export-title">Exportă date educaționale</h2>
            <p class="export-description">
              Tinerii din Republica Moldova reprezintă o categorie socială importantă.
              Accesează datele educaționale și descarcă-le în format Excel sau CSV.
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
              <form action="../core/export_educatie.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label" for="an-reale">An:</label>
                  <select id="an-reale" name="an" class="form-select">
                    <option value="">Toți</option>
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
              <form action="../controllers/export_comparatie_educatie.php" method="get" class="export-form">
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
  <label class="form-label" for="an-comp">An:</label>
  <select id="an-comp" name="an" class="form-select">
    <option value="">Toți</option>
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
                  <label class="form-label" for="format-comp">Format:</label>
                  <select id="format-comp" name="format" class="form-select">
                    <option value="csv" selected>CSV</option>
                    <option value="xlsx" selected>Excel</option>
                  </select>
                </div>
                
                <button type="submit" class="form-submit">
                  <i class="fas fa-download"></i> Descarcă datele
                </button>
              </form>
            </div>
            
            <div class="tab-content" id="predictie">
              <form action="../models/export/export_predictii_educatie.php" method="get" class="export-form">
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
    document.addEventListener('DOMContentLoaded', () => {
        let currentMode = 'data';
        let currentNivel = 'Fara studii';
        let currentTara = 'Romania';
        let unifiedChart;

        const nivelSelect = document.getElementById('nivelSelectGeneral');
        const flagSelector = document.getElementById('taraFlags');
        const taraHiddenInput = document.getElementById('taraSelectHidden');
        const flagImages = flagSelector ? flagSelector.querySelectorAll('.flag-img') : [];
        const tabButtonsContainer = document.querySelector('.tab-buttons');
        const chartCanvas = document.getElementById('unifiedChart');
        const chartContainer = chartCanvas ? chartCanvas.parentElement : null;
        const chartStatus = document.getElementById('chartStatus');

        const showLoading = () => {
            chartContainer.classList.add('is-loading');
            chartStatus.className = 'chart-status loading';
            chartStatus.textContent = 'Se încarcă datele...';
            if (currentMode === 'comparatie') {
                taraFilterContainer.style.display = 'flex';
            } else {
                taraFilterContainer.style.display = 'none';
            }
        };

        const hideStatus = () => {
            chartContainer.classList.remove('is-loading');
            chartStatus.textContent = '';
            chartStatus.className = 'chart-status';
        };

        const updateChart = async () => {
            showLoading();
            let datasets = [];
            let labels = [];
            let chartTitle = '';
            let url;

            if (currentMode === 'data') {
                url = `../controllers/EducatieController.php?action=getData&tip=${encodeURIComponent(currentNivel)}`;
            } else if (currentMode === 'comparatie') {
                url = `../controllers/EducatieController.php?action=getComparatieData&tara=${encodeURIComponent(currentTara)}`;
            } else if (currentMode === 'predictie') {
                url = '../controllers/PredictiiController.php?action=getPredictii';
            }

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (currentMode === 'data') {
    labels = data.map(row => row.Anul);
    datasets.push({
        label: currentNivel,
        data: data.map(row => row.Numar),
        borderColor: 'rgba(52, 152, 219, 1)',  // Albastru principal
        backgroundColor: 'rgba(52, 152, 219, 0.15)',
        fill: true,
        tension: 0.4,
        borderWidth: 3,
        pointRadius: 5,
        pointHoverRadius: 7
    });
    chartTitle = `Evoluție: ${currentNivel}`;
} else if (currentMode === 'comparatie') {
    const mdData = data.filter(d => d.Tara === 'Moldova');
    const compareData = data.filter(d => d.Tara === currentTara);
    labels = mdData.map(d => d.Anul);
    datasets.push({
        label: `Moldova - ${currentNivel}`,
        data: mdData.map(d => d.Numar),
        borderColor: '#3498db',  // Albastru pentru Moldova
        backgroundColor: 'rgba(52, 152, 219, 0.15)',
        fill: true,
        pointBackgroundColor: '#3498db',
        borderWidth: 3,
        pointRadius: 5,
        pointHoverRadius: 7
    });
    datasets.push({
        label: `${currentTara} - ${currentNivel}`,
        data: compareData.map(d => d.Numar),
        borderColor: '#2980b9',  // Albastru închis pentru alte țări
        backgroundColor: 'rgba(41, 128, 185, 0.15)',
        fill: true,
        pointBackgroundColor: '#2980b9',
        borderWidth: 3,
        pointRadius: 5,
        pointHoverRadius: 7
    });
    chartTitle = `Comparatie: ${currentNivel} (Moldova vs ${currentTara})`;
} else if (currentMode === 'predictie') {
    labels = data.map(row => row.Anul);
    datasets.push({
        label: `Predicție - ${currentNivel}`,
        data: data.map(row => row[currentNivel]),
        borderColor: '#2980b9',  // Albastru închis pentru predicții
        backgroundColor: 'rgba(41, 128, 185, 0.15)',
        fill: true,
        tension: 0.4,
        borderWidth: 3,
        pointRadius: 5,
        pointHoverRadius: 7
    });
    chartTitle = `Predicții: ${currentNivel}`;
}



                if (unifiedChart) unifiedChart.destroy();
                const ctx = chartCanvas.getContext('2d');
                unifiedChart = new Chart(ctx, {
                    type: 'line',
                    data: { labels, datasets },
                    options: {
                        responsive: true,
                        plugins: { title: { display: true, text: chartTitle } },
                        scales: {
                            x: { grid: { display: false } },
                            y: { grid: { color: 'rgba(200, 200, 200, 0.3)' } }
                        }
                    }
                });

                hideStatus();
            } catch (error) {
                chartStatus.textContent = 'Eroare la încărcarea datelor.';
                console.error(error);
            }
        };

        nivelSelect.addEventListener('change', (event) => {
            currentNivel = event.target.value;
            updateChart();
        });

        tabButtonsContainer.addEventListener('click', (event) => {
            const button = event.target.closest('button');
            if (button) {
                currentMode = button.dataset.mode;
                tabButtonsContainer.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                updateChart();
            }
        });

        flagSelector.addEventListener('click', (event) => {
            const flagImg = event.target.closest('.flag-img');
            if (flagImg) {
                currentTara = flagImg.dataset.tara;
                taraHiddenInput.value = currentTara;
                flagImages.forEach(img => img.classList.remove('selected'));
                flagImg.classList.add('selected');
                updateChart();
            }
        });

        updateChart();
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const showExportBtn = document.getElementById("showExportBtn");
  const exportIntro = document.getElementById("exportIntro");
  const exportInterface = document.getElementById("exportInterface");
  const backToIntroBtn = document.getElementById("backToIntroBtn");
  const exportTabs = document.querySelectorAll(".export-tab");
  const tabContents = document.querySelectorAll(".tab-content");

  showExportBtn?.addEventListener("click", () => {
    exportIntro.classList.add("hidden");
    setTimeout(() => {
      exportInterface.classList.add("visible");
    }, 300);
  });

  backToIntroBtn?.addEventListener("click", () => {
    exportInterface.classList.remove("visible");
    setTimeout(() => {
      exportIntro.classList.remove("hidden");
    }, 300);
  });

  exportTabs.forEach(tab => {
    tab.addEventListener("click", function () {
      exportTabs.forEach(t => t.classList.remove("active"));
      tabContents.forEach(c => c.classList.remove("active"));
      this.classList.add("active");
      const tabId = this.getAttribute("data-tab");
      document.getElementById(tabId)?.classList.add("active");
    });
  });
});

</script>

</body>
</html>