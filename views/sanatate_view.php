<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Sănătate - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/sanatate.css">
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
        <a href="http://localhost/portal_statistica/views/sanatate_view.php" class="active-link"><img src="../assets/img/health.png" alt="Sănătate"><span>Sănătate</span></a>
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
    <section class="sanatate-hero">
        <div class="sanatate-hero-box">
            <h1 class="sanatate-title">Sănătatea tinerilor din Republica Moldova</h1>
            <hr class="sanatate-line">
            <p class="sanatate-description">Monitorizarea cazurilor de boli cronice, spitalizări și implicarea în activități sportive.</p>
        </div>
    </section>

    <hr class="section-divider">

    <section class="chart-box-modern">
        <div class="tab-container">
            <div class="tab-buttons">
                <button class="tab-btn active" onclick="showTab('data')">Date</button>
                <button class="tab-btn" onclick="showTab('comparatie')">Comparație</button>
                <button class="tab-btn" onclick="showTab('predictie')">Predicție</button>
            </div>
        </div>

        <div class="chart-toggle" id="filters-data">
            <button class="chart-btn active" onclick="setTipDate('boli')">Boli și spitalizări</button>
            <button class="chart-btn" onclick="setTipDate('sport')">Activitate sportivă</button>
        </div>

        <div class="filters-bar" id="filters-comparatie" style="display:none">
            <div class="filter-group">
                <label for="indicator-comparatie">Indicator:</label>
                <select id="indicator-comparatie">
                    <option value="Numar_cazuri_boli_cronice">Boli cronice</option>
                    <option value="Numar_cazuri_boli_respiratorii">Boli respiratorii</option>
                    <option value="Numar_spitalizari">Spitalizări</option>
                    <option value="Sport_de_performanta">Sport performanță</option>
                    <option value="Sport_ca_hobby">Sport ca hobby</option>
                </select>
            </div>
            <div class="flag-selector">
                <img src="../assets/img/flag_romania.png" class="flag-img" data-tara="Romania" title="România">
                <img src="../assets/img/flag_germania.png" class="flag-img selected" data-tara="Germania" title="Germania">
                <img src="../assets/img/flag_italia.png" class="flag-img" data-tara="Italia" title="Italia">
                <img src="../assets/img/flag_franta.png" class="flag-img" data-tara="Franta" title="Franța">
            </div>
        </div>

        <div class="filters-bar" id="filters-predictie" style="display:none">
            <div class="filter-group">
                <label for="indicator-predictie">Indicator:</label>
<select id="indicator-predictie">
  <option value="Boli_cronice">Boli cronice</option>
  <option value="Boli_respiratorii">Boli respiratorii</option>
  <option value="Spitalizari">Spitalizări</option>
  <option value="Sport_performanta">Sport performanță</option>
  <option value="Sport_ca_hobby">Sport ca hobby</option>
</select>

            </div>
        </div>

        <div class="chart-container">
            <canvas id="unifiedChart"></canvas>
            <div class="chart-status loading">Se încarcă...</div>
                </div>
    </section>

    <hr class="section-divider">

<section class="statistici-cheie">
 <title>Informații Relevante despre Sănătatea Tinerilor</title>
    <style>
    </style>
    <section class="statistici-cheie">
        <h2 class="statistici-title">Informații Relevante despre Sănătatea Tinerilor</h2>
        <div class="info-grid">
            
            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Iconică spital -->
    <rect x="4" y="4" width="16" height="17" rx="2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Crucea spitalului -->
    <path d="M12 8V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M8 12H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Liniile de bază -->
    <path d="M3 21H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Spitalizări frecvente</h3>
                    <p>În 2024, peste 22% dintre tineri au fost internați cel puțin o dată pentru afecțiuni cronice sau accidentări.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Plămân stâng -->
    <path d="M8 6C8 6 4 8 4 12C4 16 6 18 8 18C10 18 10 16 10 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Plămân drept -->
    <path d="M16 6C16 6 20 8 20 12C20 16 18 18 16 18C14 18 14 16 14 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Trahee -->
    <path d="M12 4V14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Bronhii principale -->
    <path d="M12 14L10 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M12 14L14 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Simbolul orașului (sugerând mediul urban) -->
    <path d="M12 21L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9 21L9 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15 21L15 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Boli respiratorii</h3>
                    <p>Afecțiunile respiratorii reprezintă cauza principală a îmbolnăvirii în rândul tinerilor din mediul urban.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Medalie/Trofeu -->
    <circle cx="12" cy="9" r="6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Numărul 1 în medalie -->
    <path d="M12 6V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 6L12 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Panglicile medaliei -->
    <path d="M9 15L7 21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15 15L17 21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Stele indicând performanța -->
    <path d="M17 7L19 5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M7 7L5 5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Sport de performanță</h3>
                    <p>Doar 7% dintre tineri sunt implicați în activități sportive de performanță în mod constant.</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon-container">
                    <div class="info-icon-bg"></div>
                    <div class="info-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Persoană care face sport -->
    <circle cx="12" cy="6" r="3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Corpul -->
    <path d="M12 9V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Mâini -->
    <path d="M8 12L16 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Picioare -->
    <path d="M9 21L12 16L15 21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Simbol sănătate (inimă) -->
    <path d="M18 8C19 9 19 11 18 12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6 8C5 9 5 11 6 12L8 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </div>
                </div>
                <div class="info-text">
                    <h3>Sport ca hobby</h3>
                    <p>În 2024, peste 42% dintre tineri practică regulat sport ca formă de menținere a sănătății.</p>
                </div>
            </div>

        </div>
    </section>

<hr class="section-divider">

<section class="context-box">
  <div class="context-text">
    <div class="title-container">
      <h2 class=" ">Despre Contextul Sănătății Tinerilor</h2>
      <div class="title-decoration"></div>
    </div>
    <p class="context-description">
      Sănătatea tinerilor din Republica Moldova reflectă o serie de provocări și evoluții în domeniul medical și al stilului de viață. Analiza detaliată a cazurilor de îmbolnăvire, spitalizări și implicarea în activități sportive evidențiază diferențe semnificative între medii, genuri și grupe de vârstă.
  Platforma oferă o perspectivă vizuală asupra acestor date, ajutând la înțelegerea stării de sănătate și a nivelului de activitate fizică în rândul tinerilor.
    </p>
    <ul class="context-list">
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="25" fill="#e53935" />
  <path d="M10 35h30" stroke="white" stroke-width="2" />
  <path d="M10 35v-20" stroke="white" stroke-width="2" />
  <path d="M10 15l30 0" stroke="white" stroke-width="2" />
  <path d="M40 15v20" stroke="white" stroke-width="2" />
  <path d="M10 35l5-8l5 3l6-10l4 5l5-7l5-3" stroke="white" stroke-width="2" fill="none" />
  <circle cx="15" cy="27" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="20" cy="30" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="26" cy="20" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="30" cy="25" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <circle cx="35" cy="18" r="2" stroke="white" stroke-width="1.5" fill="white" />
  <path d="M13 35c0 0 2-12 12-12s12 12 12 12" stroke="white" stroke-width="1.5" stroke-dasharray="2 1" fill="none" />
</svg>
        </div>
        <span class="item-text">Statistici actualizate despre afecțiuni și spitalizări</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="25" fill="#e53935" />
  <circle cx="18" cy="15" r="4" stroke="white" stroke-width="2" fill="none" />
  <path d="M16 19l-4 15" stroke="white" stroke-width="2" />
  <path d="M20 19l4 15" stroke="white" stroke-width="2" />
  <path d="M12 26h16" stroke="white" stroke-width="2" />
  <path d="M30 18l6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
  <path d="M36 18l-6 6" stroke="white" stroke-width="2" stroke-linecap="round" />
  <path d="M32 32a6 6 0 1 0 0 12 6 6 0 0 0 0-12z" stroke="white" stroke-width="2" fill="none" />
  <path d="M32 34v5" stroke="white" stroke-width="2" />
  <path d="M29.5 37h5" stroke="white" stroke-width="2" />
</svg>
        </div>
        <span class="item-text">Informații despre activitatea sportivă</span>
      </li>
      <li class="list-item">
        <div class="icon-container">
<svg class="icon" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="25" fill="#e53935" />
  <rect x="12" y="14" width="26" height="22" rx="2" stroke="white" stroke-width="2" fill="none" />
  <path d="M12 22h26" stroke="white" stroke-width="2" />
  <path d="M15 18h4" stroke="white" stroke-width="2" />
  <path d="M23 18h4" stroke="white" stroke-width="2" />
  <path d="M31 18h4" stroke="white" stroke-width="2" />
  <path d="M15 26h4" stroke="white" stroke-width="2" />
  <path d="M23 26h4" stroke="white" stroke-width="2" />
  <path d="M31 26h4" stroke="white" stroke-width="2" />
  <path d="M15 30h4" stroke="white" stroke-width="2" />
  <path d="M23 30h4" stroke="white" stroke-width="2" />
  <path d="M31 30h4" stroke="white" stroke-width="2" />
  <path d="M15 34l20 0" stroke="white" stroke-width="2" />
  <path d="M22 36l6 0" stroke="white" stroke-width="2" />
  <path d="M38 25v8" stroke="white" stroke-width="2" />
  <path d="M38 25l6 0" stroke="white" stroke-width="2" />
  <path d="M38 33l6 0" stroke="white" stroke-width="2" />
  <path d="M41 25v8" stroke="white" stroke-width="2" />
</svg>
        </div>
        <span class="item-text">Date reale integrate cu modele de predicție</span>
      </li>
    </ul>
  </div>

  <div class="context-image-wrapper">
    <div class="image-decoration"></div>
    <div class="context-image">
      <div class="image-overlay"></div>
      <img src="../assets/img/health_bg.png" alt="Context educațional">
      <div class="floating-badge">Date 2024</div>
    </div>
    <div class="dots-decoration"></div>
  </div>
</section>


<hr class="section-divider">

<section class="context-box export-section">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <div class="export-container">
    <div class="export-card">
      <div class="export-wrapper">
        <!-- Coloana stângă cu imagine și efecte -->
        <div class="export-image-column">
          <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
          </div>
          <img src="../assets/img/export_sanatate.png" alt="Export sănătate" class="export-image">
        </div>

        <!-- Coloana dreaptă cu conținut -->
        <div class="export-content-column">
          <!-- Introducere -->
          <div class="export-intro" id="exportIntro-sanatate">
            <h2 class="export-title">Exportă date despre sănătate</h2>
            <p class="export-description">
              Sănătatea tinerilor din Republica Moldova oferă informații esențiale pentru înțelegerea nevoilor lor.
              Poți descărca date privind bolile cronice, spitalizările și activitatea sportivă în format Excel sau CSV.
              Se pot aplica filtre precum anul, sexul, localitatea și vârsta.
            </p>
            <button class="export-button" id="showExportBtn-sanatate">
              <i class="fas fa-database export-button-icon"></i>
              Exportă date
            </button>
          </div>

          <!-- Interfața de export -->
          <div class="export-interface" id="exportInterface-sanatate">
            <button class="export-back" id="backToIntroBtn-sanatate">
              <i class="fas fa-arrow-left"></i> Înapoi
            </button>

            <div class="export-tabs">
              <button class="export-tab active" data-tab="reale-sanatate">
                <i class="fas fa-table export-tab-icon"></i> Date reale
              </button>
              <button class="export-tab" data-tab="comparatie-sanatate">
                <i class="fas fa-chart-bar export-tab-icon"></i> Comparație
              </button>
              <button class="export-tab" data-tab="predictie-sanatate">
                <i class="fas fa-chart-line export-tab-icon"></i> Predicție
              </button>
            </div>

            <!-- Tab: Date reale -->
            <div class="tab-content active" id="reale-sanatate">
              <form action="../core/export_sanatate.php" method="get" class="export-form">
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
    <option value="">Toate vârstele</option>
    <?php for ($v = 14; $v <= 23; $v++): ?>
      <option value="<?= $v ?>"><?= $v ?> ani</option>
    <?php endfor; ?>
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

            <!-- Tab: Comparație -->
            <div class="tab-content" id="comparatie-sanatate">
              <form action="../controllers/export_comparatie_sanatate.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label">Țara:</label>
                  <select name="tara" class="form-select">
                    <option value="">Toate țările</option> <!-- Adăugat -->
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
                    <option value="">Toți indicatorii</option> <!-- Adăugat -->
                    <option value="Numar_cazuri_boli_cronice">Boli cronice</option>
                    <option value="Numar_cazuri_boli_respiratorii">Boli respiratorii</option>
                    <option value="Numar_spitalizari">Spitalizări</option>
                    <option value="Sport_de_performanta">Sport de performanță</option>
                    <option value="Sport_ca_hobby">Sport ca hobby</option>
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

            <!-- Tab: Predicție -->
            <div class="tab-content" id="predictie-sanatate">
              <form action="../models/export/export_predictii_sanatate.php" method="get" class="export-form">
                <div class="form-group">
                  <label class="form-label">An:</label>
                  <select name="an" class="form-select">
                    <option value="">Toți anii</option> <!-- Adăugat -->
                    <?php for ($i = 2025; $i <= 2030; $i++): ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Indicator:</label>
                  <select name="indicator" class="form-select">
                    <option value="">Toți indicatorii</option>
                    <option value="Boli_cronice">Boli cronice</option>
                    <option value="Boli_respiratorii">Boli respiratorii</option>
                    <option value="Spitalizari">Spitalizări</option>
                    <option value="Sport_performanta">Sport de performanță</option>
                    <option value="Sport_ca_hobby">Sport ca hobby</option>
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
let tipDate = 'boli';
let taraSelectata = 'România';
let myChart;

function setTipDate(value) {
    tipDate = value;
    document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.chart-btn[onclick*='${value}']`).classList.add('active');
    fetchChartData('data');
}

function fetchChartData(tip) {
    let url = '../controllers/SanatateController.php?tip=' + tip;

    if (tip === 'predictie') {
        const indicator = document.getElementById('indicator-predictie').value;
        url += '&indicator=' + indicator;
    } else if (tip === 'comparatie') {
        const indicator = document.getElementById('indicator-comparatie').value;
        url += '&indicator=' + indicator + '&tara=' + encodeURIComponent(taraSelectata);
    } else {
        url += '&sex=Masculin&localitate=Urban';
    }

    document.querySelector('.chart-status.loading').style.opacity = '1';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.querySelector('.chart-status.loading').style.opacity = '0';
            if (tip === 'comparatie') updateChartComparatie(data);
            else if (tip === 'predictie') updatePredictieChart(data);
            else updateChart(data);
        })
        .catch(error => {
            document.querySelector('.chart-status.loading').style.opacity = '0';
            document.querySelector('.chart-status.error').style.opacity = '1';
        });
}

function updateChart(data) {
    const labels = data.map(r => r.Anul);
    let datasets;

    if (tipDate === 'boli') {
        datasets = [
            { label: 'Boli cronice', data: data.map(r => r.Numar_cazuri_boli_cronice), borderWidth: 2 },
            { label: 'Boli respiratorii', data: data.map(r => r.Numar_cazuri_boli_respiratorii), borderWidth: 2 },
            { label: 'Spitalizări', data: data.map(r => r.Numar_spitalizari), borderWidth: 2 }
        ];
    } else {
        datasets = [
            { label: 'Sport de performanță', data: data.map(r => r.Sport_de_performanta), borderWidth: 2 },
            { label: 'Sport ca hobby', data: data.map(r => r.Sport_ca_hobby), borderWidth: 2 }
        ];
    }

    if (myChart) myChart.destroy();
    myChart = new Chart(document.getElementById('unifiedChart'), {
        type: 'line',
        data: { labels: labels, datasets: datasets },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
}

function updateChartComparatie(data) {
    const labels = [...new Set(data.map(r => r.Anul))];
    const tara1 = 'Moldova';
    const tara2 = taraSelectata;

    const valoriT1 = labels.map(an => {
        const r = data.find(x => x.Anul == an && x.Tara === tara1);
        return r ? parseFloat(r.Valoare) : null;
    });
    const valoriT2 = labels.map(an => {
        const r = data.find(x => x.Anul == an && x.Tara === tara2);
        return r ? parseFloat(r.Valoare) : null;
    });

   if (myChart) myChart.destroy();
    myChart = new Chart(document.getElementById('unifiedChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: tara1,
                    data: valoriT1,
                    borderWidth: 2,
                    borderColor: '#e74c3c', // roșu
                    backgroundColor: 'rgba(231, 76, 60, 0.15)', // fundal ușor roșu
                    fill: true,
                    tension: 0.4
                },
                {
                    label: tara2,
                    data: valoriT2,
                    borderWidth: 2,
                    borderColor: '#c0392b', // roșu închis
                    backgroundColor: 'rgba(192, 57, 43, 0.15)', // fundal roșu închis
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
}

function updatePredictieChart(data) {
    const indicator = document.getElementById('indicator-predictie').value;

    const labels = data.map(row => row.Anul);
    const valori = data.map(row => parseInt(row[indicator]) || 0); // fallback la 0 dacă e gol

    if (myChart) myChart.destroy();
    myChart = new Chart(document.getElementById('unifiedChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Predicție',
                data: valori,
                borderColor: '#e74c3c',
                backgroundColor: 'rgba(231, 76, 60, 0.15)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}



const flags = document.querySelectorAll('.flag-img');
flags.forEach(flag => {
    flag.addEventListener('click', () => {
        flags.forEach(f => f.classList.remove('selected'));
        flag.classList.add('selected');
        taraSelectata = flag.dataset.tara;
        fetchChartData('comparatie');
    });
});

document.getElementById('indicator-comparatie').addEventListener('change', () => fetchChartData('comparatie'));
document.getElementById('indicator-predictie').addEventListener('change', () => fetchChartData('predictie'));

function showTab(tab) {
    document.getElementById('filters-data').style.display = tab === 'data' ? 'flex' : 'none';
    document.getElementById('filters-comparatie').style.display = tab === 'comparatie' ? 'flex' : 'none';
    document.getElementById('filters-predictie').style.display = tab === 'predictie' ? 'flex' : 'none';

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.tab-btn[onclick*="${tab}"]`).classList.add('active');

    fetchChartData(tab); // <- asta e cheia
}


window.onload = () => {
    showTab('data');
};
</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const showBtn = document.getElementById("showExportBtn-sanatate");
    const backBtn = document.getElementById("backToIntroBtn-sanatate");
    const introBox = document.getElementById("exportIntro-sanatate");
    const exportBox = document.getElementById("exportInterface-sanatate");

    showBtn.addEventListener("click", () => {
      introBox.classList.add("hidden");
      exportBox.classList.add("visible");
    });

    backBtn.addEventListener("click", () => {
      exportBox.classList.remove("visible");
      introBox.classList.remove("hidden");
    });

    const tabButtons = document.querySelectorAll(".export-tab");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach(button => {
      button.addEventListener("click", () => {
        const target = button.getAttribute("data-tab");

        tabButtons.forEach(btn => btn.classList.remove("active"));
        tabContents.forEach(content => content.classList.remove("active"));

        button.classList.add("active");
        document.getElementById(target).classList.add("active");
      });
    });
  });
</script>


</body>
</html>