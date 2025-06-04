<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Căsătorii - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/casatorii.css">
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
        <a href="http://localhost/portal_statistica/views/casatorii_view.php" class="active-link"><img src="../assets/img/marriage.png" alt="Căsătorii"><span>Căsătorii</span></a>
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
            <h1 class="educatie-title">Statistici Căsătorii</h1>
            <hr class="educatie-line">
            <p class="educatie-description">
                Vizualizează evoluția căsătoriilor și divorțurilor în Republica Moldova și comparațiile internaționale.
            </p>
        </div>
    </section>

    <hr class="section-divider">
    
    <section class="chart-wrapper">
        <div class="tab-container">
            <div class="tab-buttons">
                <button class="tab-btn active" onclick="loadRealData()">Date reale</button>
                <button class="tab-btn" onclick="loadComparisonData()">Comparație</button>
                <button class="tab-btn" onclick="loadPredictionData()">Predicții</button>
            </div>
        </div>

        <div class="filters-bar" id="filters-bar">
            <div class="filter-group">
                <label for="indicatorSelect">Indicator:</label>
                <select id="indicatorSelect">
                    <option value="Numar_casatorii" selected>Număr Căsătorii</option>
                    <option value="Numar_divorturi">Număr Divorțuri</option>
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

        <div class="chart-container" id="chart-panel" role="tabpanel" aria-labelledby="tab-data">
            <div class="chart-status" id="chartStatus"></div> 
            <canvas id="unifiedChart"></canvas> 
        </div>
    </section>

    <hr class="section-divider">

<section class="statistici-cheie">
 <title>Informații Relevante despre Căsătorii și Divorțuri</title>
    <style>
    </style>
    <section class="statistici-cheie">
        <h2 class="statistici-title">Informații Relevante despre Căsătorii și Divorțuri</h2>
        <div class="info-grid">
            
            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- First Ring (Left) -->
    <circle cx="8" cy="12" r="3" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Second Ring (Right) - Interlocked with first -->
    <circle cx="14" cy="12" r="3" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Growth Arrow -->
    <path d="M18 9L21 6M21 6L18 3M21 6H17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Heart symbol -->
    <path d="M11 18C11 18 8 16 8 14C8 13 9 12 10 12C10.5 12 10.9 12.3 11 12.8C11.1 12.3 11.5 12 12 12C13 12 14 13 14 14C14 16 11 18 11 18Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Număr căsătorii în creștere</h3>
                    <p>În 2024, numărul căsătoriilor în Republica Moldova a înregistrat o creștere de 8% față de anul precedent.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Chart backdrop -->
    <rect x="3" y="5" width="18" height="14" rx="1" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Decreasing trend line -->
    <path d="M3 10L7 12L11 11L15 9L19 8L21 7" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Down arrow -->
    <path d="M18 13L21 16" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M21 13L21 16L18 16" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Family symbols (simplified) -->
    <circle cx="6" cy="17" r="1.5" stroke="#ffffff" stroke-width="1.5"/>
    <circle cx="10" cy="17" r="1.5" stroke="#ffffff" stroke-width="1.5"/>
    <path d="M8 21L8 19" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M6 19C6 19 8 19 10 19" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Rata divorțurilor</h3>
                    <p>Rata divorțurilor a scăzut cu 5% în ultimii cinci ani, indicând stabilitate familială mai mare.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- City buildings (Urban) -->
    <rect x="3" y="10" width="4" height="11" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <rect x="7" y="7" width="4" height="14" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <rect x="11" y="9" width="3" height="12" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Windows -->
    <path d="M4 13H6M4 16H6M8 10H10M8 13H10M8 16H10M12 12H13M12 15H13" stroke="#ffffff" stroke-width="1" stroke-linecap="round"/>
    <!-- Rural house -->
    <path d="M17 21V15H22V21" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15 15L19.5 10L24 15" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Comparison arrow -->
    <path d="M14 6L18 4L14 2" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 4L18 4" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Diferențe Urban vs Rural</h3>
                    <p>Căsătoriile în mediul urban sunt cu 12% mai frecvente comparativ cu mediul rural în 2024.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Age group chart -->
    <path d="M3 21H21" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6 21V17" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 21V10" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14 21V14" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M18 21V16" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Age labels (simplified) -->
    <path d="M6 13C6 13 6 12 7 12" stroke="#ffffff" stroke-width="1" stroke-linecap="round"/>
    <path d="M10 7C10 7 12 5 14 7" stroke="#ffffff" stroke-width="1" stroke-linecap="round"/>
    <!-- Wedding couple on top of highest bar -->
    <circle cx="10" cy="7" r="1.5" stroke="#ffffff" stroke-width="1"/>
    <circle cx="13" cy="7" r="1.5" stroke="#ffffff" stroke-width="1"/>
    <path d="M11.5 5C11.5 5 10 6 11.5 7" stroke="#ffffff" stroke-width="1" stroke-linecap="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Tendințe pe grupe de vârstă</h3>
                    <p>Tinerii între 25-30 de ani au cea mai mare rată a căsătoriilor în ultimii ani.</p>
                </div>
            </div>

        </div>
    </section>

<hr class="section-divider">

<section class="context-box">
  <div class="context-text">
    <div class="title-container">
      <h2 class=" ">Despre Contextul Căsătoriilor și Divorțurilor</h2>
      <div class="title-decoration"></div>
    </div>
    <p class="context-description">
Căsătoriile și divorțurile reprezintă aspecte fundamentale ale dinamicii sociale din Republica Moldova. Analiza datelor pe aceste teme oferă perspective importante privind evoluția relațiilor familiale, influențate de factori demografici și socio-economici.
      Platforma noastră oferă o viziune clară și detaliată asupra acestor tendințe, facilitând înțelegerea și compararea datelor pe plan național și internațional.
    </p>
    <ul class="context-list">
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Fundalul rotund în stil auriu-maro similar cu butonul din imagine -->
  <circle cx="25" cy="25" r="25" fill="#c8961f" />
  
  <!-- Grafic tendințe cu linii albe -->
  <path d="M10 35h30" stroke="white" stroke-width="2" />
  <path d="M10 35v-20" stroke="white" stroke-width="2" />
  <path d="M10 15l30 0" stroke="white" stroke-width="2" />
  <path d="M40 15v20" stroke="white" stroke-width="2" />
  <path d="M10 35l5-8l5 3l6-10l4 5l5-7l5-3" stroke="white" stroke-width="2" fill="none" />
  
  <!-- Puncte pe grafic -->
  <circle cx="15" cy="27" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="20" cy="30" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="26" cy="20" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="30" cy="25" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="35" cy="18" r="2" stroke="white" stroke-width="1.5" fill="white" />
  
  <!-- Linie punctată reprezentând tendința -->
  <path d="M13 35c0 0 2-12 12-12s12 12 12 12" stroke="white" stroke-width="1.5" stroke-dasharray="2 1" fill="none" />
</svg>
        </div>
        <span class="item-text">Tendințe actualizate privind căsătoriile și divorțurile</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Fundalul rotund în stil auriu-maro similar cu butonul din imagine -->
  <circle cx="25" cy="25" r="25" fill="#c8961f" />
  
  <!-- Icon persoană (reprezintă date demografice) -->
  <circle cx="18" cy="15" r="4" stroke="white" stroke-width="2" fill="none" />
  <path d="M16 19l-4 15" stroke="white" stroke-width="2" />
  <path d="M20 19l4 15" stroke="white" stroke-width="2" />
  <path d="M12 26h16" stroke="white" stroke-width="2" />
  
  <!-- Simbol pentru modelare predictivă/matematică -->
  <path d="M30 18l6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
  <path d="M36 18l-6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
  
  <!-- Cerc cu plus (adăugare date/integrare) -->
  <path d="M32 32a6 6 0 1 0 0 12 6 6 0 0 0 0-12z" stroke="white" stroke-width="2" fill="none" />
  <path d="M32 34v5" stroke="white" stroke-width="2" />
  <path d="M29.5 37h5" stroke="white" stroke-width="2" />
</svg>
        </div>
        <span class="item-text">Date reale integrate cu modele predictive</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Fundalul rotund în stil auriu-maro similar cu butonul din imagine -->
  <circle cx="25" cy="25" r="25" fill="#c8961f" />
  
  <!-- Icon calendar/tabel (vizualizare date) -->
  <rect x="12" y="14" width="26" height="22" rx="2" stroke="white" stroke-width="2" fill="none" />
  <path d="M12 22h26" stroke="white" stroke-width="2" />
  
  <!-- Rânduri de date în tabel -->
  <path d="M15 18h4" stroke="white" stroke-width="2" />
  <path d="M23 18h4" stroke="white" stroke-width="2" />
  <path d="M31 18h4" stroke="white" stroke-width="2" />
  <path d="M15 26h4" stroke="white" stroke-width="2" />
  <path d="M23 26h4" stroke="white" stroke-width="2" />
  <path d="M31 26h4" stroke="white" stroke-width="2" />
  <path d="M15 30h4" stroke="white" stroke-width="2" />
  <path d="M23 30h4" stroke="white" stroke-width="2" />
  <path d="M31 30h4" stroke="white" stroke-width="2" />
  
  <!-- Simboluri de conectare/comparabilitate -->
  <path d="M15 34l20 0" stroke="white" stroke-width="2" />
  <path d="M22 36l6 0" stroke="white" stroke-width="2" />
  
  <!-- Simbol pentru comparație internațională -->
  <path d="M38 25v8" stroke="white" stroke-width="2" />
  <path d="M38 25l6 0" stroke="white" stroke-width="2" />
  <path d="M38 33l6 0" stroke="white" stroke-width="2" />
  <path d="M41 25v8" stroke="white" stroke-width="2" />
</svg>
        </div>
        <span class="item-text">Comparabilitate internațională și regională</span>
      </li>
    </ul>
  </div>

  <div class="context-image-wrapper">
    <div class="image-decoration"></div>
    <div class="context-image">
      <div class="image-overlay"></div>
      <img src="../assets/img/casatorii_banner.jpg" alt="Context educațional">
      <div class="floating-badge">Date 2024</div>
    </div>
    <div class="dots-decoration"></div>
  </div>
</section>

<hr class="section-divider">

<section class="context-box export-section">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <div class="export-container">
    <div class="export-card">
      <div class="export-wrapper">
        <!-- Imagine stângă -->
        <div class="export-image-column">
          <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
          </div>
          <img src="../assets/img/export_casatorii.png" alt="Export căsătorii/divorțuri" class="export-image">
        </div>

        <!-- Conținut dreapta -->
        <div class="export-content-column">
          <!-- Intro -->
          <div class="export-intro" id="exportIntro-casatorii">
            <h2 class="export-title">Exportă date despre căsătorii și divorțuri</h2>
            <p class="export-description">
              Datele privind căsătoriile și divorțurile în Republica Moldova pot fi accesate și descărcate în format Excel sau CSV.
              Poți filtra după an, sex și tipul indicatorului (căsătorii/divorțuri).
            </p>
            <button class="export-button" id="showExportBtn-casatorii">
              <i class="fas fa-database export-button-icon"></i>
              Exportă date
            </button>
          </div>

          <!-- Interfață Export -->
          <div class="export-interface" id="exportInterface-casatorii">
            <button class="export-back" id="backToIntroBtn-casatorii">
              <i class="fas fa-arrow-left"></i> Înapoi
            </button>

            <div class="export-tabs">
              <button class="export-tab active" data-tab="reale-casatorii">
                <i class="fas fa-table export-tab-icon"></i> Date reale
              </button>
              <button class="export-tab" data-tab="comparatie-casatorii">
                <i class="fas fa-chart-bar export-tab-icon"></i> Comparație
              </button>
              <button class="export-tab" data-tab="predictie-casatorii">
                <i class="fas fa-chart-line export-tab-icon"></i> Predicție
              </button>
            </div>

            <!-- TAB: Date Reale -->
            <div class="tab-content active" id="reale-casatorii">
              <form action="../core/export_casatorii.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label">An:</label>
                  <select name="an" class="form-select">
                    <option value="">Toți anii</option>
                    <?php for ($i = 2004; $i <= 2024; $i++): ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
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
                  <label class="form-label">Indicator:</label>
                  <select name="indicator" class="form-select">
                    <option value="">Toți</option>
                    <option value="Numar_casatorii">Număr Căsătorii</option>
                    <option value="Numar_divorturi">Număr Divorțuri</option>
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

            <!-- TAB: Comparație -->
            <div class="tab-content" id="comparatie-casatorii">
              <form action="../controllers/export_comparatie_casatorii.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label">Țara:</label>
                  <select name="tara" class="form-select">
                    <option value="">Toate</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Romania">România</option>
                    <option value="Italia">Italia</option>
                    <option value="Germania">Germania</option>
                    <option value="Franta">Franța</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Indicator:</label>
                  <select name="indicator" class="form-select">
                    <option value="">Toți</option>
                    <option value="Numar_casatorii">Număr Căsătorii</option>
                    <option value="Numar_divorturi">Număr Divorțuri</option>
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
                  <i class="fas fa-download"></i> Descarcă datele
                </button>
              </form>
            </div>

            <!-- TAB: Predicție -->
            <div class="tab-content" id="predictie-casatorii">
              <form action="../models/export/export_predictii_casatorii.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label">An:</label>
                  <select name="an" class="form-select">
                    <option value="">Toți anii</option>
                    <?php for ($i = 2025; $i <= 2030; $i++): ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Indicator:</label>
                  <select name="indicator" class="form-select">
                    <option value="">Toți</option>
                    <option value="Numar_casatorii">Număr Căsătorii</option>
                    <option value="Numar_divorturi">Număr Divorțuri</option>
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
    let currentMode = 'data'; // 'data', 'comparatie', 'predictie'
    let currentTara = 'Romania';
    let currentIndicator = 'Numar_casatorii';
    let unifiedChart;

    const indicatorSelect = document.getElementById('indicatorSelect');
    const flagSelector = document.getElementById('taraFlags');
    const taraHiddenInput = document.getElementById('taraSelectHidden');
    const flagImages = flagSelector ? flagSelector.querySelectorAll('.flag-img') : [];
    const tabButtons = document.querySelectorAll('.tab-btn');
    const chartCanvas = document.getElementById('unifiedChart');
    const chartContainer = chartCanvas ? chartCanvas.parentElement : null;
    const chartStatus = document.getElementById('chartStatus');
    const taraFilterContainer = document.getElementById('taraFilterContainer');

    // Definirea culorilor din root pentru charturile noastre
    const primaryColor = '#d4af37'; // --primary-color - auriu
    const accentColor = '#b8860b';  // --accent-color - auriu închis
    const borderColor = '#daa520';  // --border-color - goldenrod
    const borderLight = '#cd853f';  // --border-light - peru

    const updateActiveTab = () => {
        tabButtons.forEach(btn => btn.classList.remove('active'));
        if (currentMode === 'data') {
            tabButtons[0].classList.add('active');
        } else if (currentMode === 'comparatie') {
            tabButtons[1].classList.add('active');
        } else if (currentMode === 'predictie') {
            tabButtons[2].classList.add('active');
        }
    };

    const showLoading = () => {
        chartContainer.classList.add('is-loading');
        chartStatus.textContent = 'Se încarcă datele...';
        chartStatus.style.display = 'flex';
        taraFilterContainer.style.display = currentMode === 'comparatie' ? 'flex' : 'none';
    };

    const hideLoading = () => {
        chartContainer.classList.remove('is-loading');
        chartStatus.textContent = '';
        chartStatus.style.display = 'none';
    };

    const updateChart = async () => {
        showLoading();
        updateActiveTab();

        let url;
        if (currentMode === 'data') {
            url = `../controllers/CasatoriiController.php?tip=date&indicator=${currentIndicator}`;
        } else if (currentMode === 'comparatie') {
            url = `../controllers/CasatoriiController.php?tip=comparatie&tarea=${encodeURIComponent(currentTara)}&indicator=${currentIndicator}`;
        } else if (currentMode === 'predictie') {
            url = `../controllers/CasatoriiController.php?tip=predictie&indicator=${currentIndicator}`;
        }

        try {
            const response = await fetch(url);
            const data = await response.json();

            const labels = [...new Set(data.map(row => row.Anul))].sort((a, b) => a - b);

            let datasets = [];

            if (currentMode === 'comparatie') {
                const moldovaData = data.filter(item => item.Tara === 'Moldova');
                const compareData = data.filter(item => item.Tara === currentTara);

                const moldovaValues = moldovaData.map(row => parseInt(row.Numar || 0));
                const compareValues = compareData.map(row => parseInt(row.Numar || 0));

                datasets.push({
                    label: 'Moldova',
                    data: moldovaValues,
                    borderColor: primaryColor, // Auriu
                    backgroundColor: 'rgba(212, 175, 55, 0.15)', // Auriu transparent
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 7
                });

                datasets.push({
                    label: currentTara,
                    data: compareValues,
                    borderColor: accentColor, // Auriu închis
                    backgroundColor: 'rgba(184, 134, 11, 0.15)', // Auriu închis transparent
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 7
                });

            } else {
                // Pentru data si predictie, un singur dataset
                const values = data.map(row => parseInt(row.Numar || 0));
                datasets.push({
                    label: currentMode === 'predictie'
                        ? 'Predicție'
                        : (currentIndicator === 'Numar_casatorii' ? 'Căsătorii' : 'Divorțuri'),
                    data: values,
                    borderColor: currentMode === 'predictie' ? borderLight : primaryColor, // Peru pentru predictie, Auriu pentru date
                    backgroundColor: currentMode === 'predictie' 
                        ? 'rgba(205, 133, 63, 0.15)' // Peru transparent
                        : 'rgba(212, 175, 55, 0.15)', // Auriu transparent
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 7
                });
            }

            if (unifiedChart) unifiedChart.destroy();

            const ctx = chartCanvas.getContext('2d');
            unifiedChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: currentMode === 'predictie'
                                ? `Predicție ${currentIndicator === 'Numar_casatorii' ? 'căsătorii' : 'divorțuri'} 2025-2030`
                                : `Evoluție ${currentIndicator === 'Numar_casatorii' ? 'căsătorii' : 'divorțuri'}`
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: 'rgba(200, 200, 200, 0.3)' } }
                    }
                }
            });

            hideLoading();
        } catch (error) {
            chartStatus.textContent = 'Eroare la încărcarea datelor.';
            console.error(error);
        }
    };

    window.loadRealData = () => {
        currentMode = 'data';
        updateChart();
    };

    window.loadComparisonData = () => {
        currentMode = 'comparatie';
        updateChart();
    };

    window.loadPredictionData = () => {
        currentMode = 'predictie';
        updateChart();
    };

    window.updateCountry = (event) => {
        const flagImg = event.target.closest('.flag-img');
        if (flagImg) {
            currentTara = flagImg.dataset.tara;
            taraHiddenInput.value = currentTara;
            flagImages.forEach(img => img.classList.remove('selected'));
            flagImg.classList.add('selected');
            updateChart();
        }
    };

    indicatorSelect.addEventListener('change', (e) => {
        currentIndicator = e.target.value;
        updateChart();
    });

    // Inițializare
    updateChart();
});
</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const showExportBtn = document.getElementById("showExportBtn-casatorii");
    const exportIntro = document.getElementById("exportIntro-casatorii");
    const exportInterface = document.getElementById("exportInterface-casatorii");
    const backBtn = document.getElementById("backToIntroBtn-casatorii");

    // Afișează interfața de export și ascunde introducerea
    showExportBtn.addEventListener("click", () => {
      exportIntro.classList.add("hidden");
      exportInterface.classList.add("visible");
      exportInterface.style.display = "flex";
    });

    // Revine la introducere
    backBtn.addEventListener("click", () => {
      exportIntro.classList.remove("hidden");
      exportInterface.classList.remove("visible");
      exportInterface.style.display = "none";
    });

    // Gestionarea tab-urilor
    const tabs = document.querySelectorAll(".export-tab");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
      tab.addEventListener("click", () => {
        const targetId = tab.getAttribute("data-tab");

        // Elimină clasele active de pe toate tab-urile și conținuturile
        tabs.forEach(t => t.classList.remove("active"));
        contents.forEach(c => c.classList.remove("active"));

        // Activează tab-ul și conținutul corespunzător
        tab.classList.add("active");
        document.getElementById(targetId).classList.add("active");
      });
    });
  });
</script>


</body>
</html>