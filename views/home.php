<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <title>Portal Statistică</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/home.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <a href="index.php" class="logo">
      <img src="assets/img/logo.png" alt="Logo">
      <span>Portal Statistică</span>
    </a>
    <a href="index.php" class="active-link"><img src="assets/img/home.png" alt="Acasă"><span>Acasă</span></a>
    <a href="http://localhost/portal_statistica/views/educatie_view.php"><img src="assets/img/education.png" alt="Educație"><span>Educație</span></a>
    <a href="http://localhost/portal_statistica/views/demografie_view.php"><img src="assets/img/demography.png" alt="Demografie"><span>Demografie</span></a>
    <a href="http://localhost/portal_statistica/views/sanatate_view.php"><img src="assets/img/health.png" alt="Sănătate"><span>Sănătate</span></a>
    <a href="http://localhost/portal_statistica/views/casatorii_view.php"><img src="assets/img/marriage.png" alt="Căsătorii"><span>Căsătorii</span></a>
    <a href="http://localhost/portal_statistica/views/ocupare_view.php"><img src="assets/img/work.png" alt="Ocupare"><span>Ocupare</span></a>
  </div>

  <!-- Header -->
  <header>
    <div class="site-name">
      <img src="assets/img/logo.png" alt="Logo">
      <div class="title">
        <span class="blue">Portal</span>
        <span class="dark">Statistică</span>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-background">
      <div class="hero-text">
        <h1>Analiza comportamentului tinerilor</h1>
        <p>Date statistice. Vizualizări grafice. Preziceri</p>
      </div>
    </div>
  </section>

 <div class="hr-divider"></div>

  <!-- CARDS -->
  <section class="cards-section">
    <div class="card" style="background-image: url('assets/img/educatie.png');" onclick="location.href='http://localhost/portal_statistica/views/educatie_view.php'">
      <div class="card-content">
        <h3>Educație</h3>
        <div class="line"></div>
        <p>Statistici despre accesul tinerilor la educație.</p>
      </div>
    </div>
    <div class="card" style="background-image: url('assets/img/demografie.png');" onclick="location.href='http://localhost/portal_statistica/views/demografie_view.php'">
      <div class="card-content">
        <h3>Demografie</h3>
        <div class="line"></div>
        <p>Structura populației tinere pe regiuni și vârste.</p>
      </div>
    </div>
    <div class="card" style="background-image: url('assets/img/sanatate.png');" onclick="location.href='http://localhost/portal_statistica/views/sanatate_view.php'">
      <div class="card-content">
        <h3>Sănătate</h3>
        <div class="line"></div>
        <p>Starea de sănătate și accesul la servicii medicale.</p>
      </div>
    </div>
  </section>

  <!-- LINIA -->
  <div class="hr-divider"></div>

  <!-- A DOUA SECȚIUNE DE CARDURI -->
  <section class="cards-section">
    <div class="card" style="background-image: url('assets/img/casatorii.png');" onclick="location.href='http://localhost/portal_statistica/views/casatorii_view.php'">
      <div class="card-content">
        <h3>Căsătorii</h3>
        <div class="line"></div>
        <p>Analiza ratelor de căsătorie și divorț în rândul tinerilor.</p>
      </div>
    </div>
    <div class="card" style="background-image: url('assets/img/ocupare.png');" onclick="location.href='http://localhost/portal_statistica/views/ocupare_view.php'">
      <div class="card-content">
        <h3>Ocupare</h3>
        <div class="line"></div>
        <p>Statistici despre angajarea și ocuparea forței de muncă.</p>
      </div>
    </div>
  </section>

  <!-- LINIA -->
  <div class="hr-divider"></div>

  <!-- REPORT BOX -->
    <div class="charts-container">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-content">
                <h1 class="main-title">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-right: 15px;">
                        <path d="M3 3v18h18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.7 8L12 14.7L9 11.7L3.3 17.4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 8h3.7v3.7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Analytics Dashboard
                </h1>
                <p class="main-description">
                    Explorează datele statistice comprehensive prin visualizări interactive și dinamice. 
                    Analizează tendințele demografice, educaționale și sociale prin charturi avansate și rapoarte detaliate.
                </p>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" stroke="white" stroke-width="2"/>
                                <path d="M8 7h8M8 11h8M8 15h6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="stat-number">5</div>
                        <div class="stat-label">Categorii</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 20V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 20V4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 20v-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="stat-number">5</div>
                        <div class="stat-label">Grafice</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <ellipse cx="12" cy="5" rx="9" ry="3" stroke="white" stroke-width="2"/>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3" stroke="white" stroke-width="2"/>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" stroke="white" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Date</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23 4v6h-6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="stat-number">Real-time</div>
                        <div class="stat-label">Actualizare</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Section -->
        <div class="chart-navigation">
            <div class="nav-buttons">
                <button class="nav-btn active" data-section="educatie">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Educație
                </button>
                <button class="nav-btn" data-section="demografie">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Demografie
                </button>
                <button class="nav-btn" data-section="sanatate">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Sănătate
                </button>
                <button class="nav-btn" data-section="casatorii">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Căsătorii
                </button>
                <button class="nav-btn" data-section="ocupare">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                        <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Ocupare
                </button>
            </div>
        </div>

        <!-- Chart Content -->
        <div class="chart-content">
            <!-- Educație Section -->
            <div id="chart-educatie" class="chart-section active">
                <div class="chart-wrapper">
                    <iframe src="views/charts/educatie_chart.php" class="chart-iframe"></iframe>
                </div>
            </div>

            <!-- Demografie Section -->
            <div id="chart-demografie" class="chart-section">
                <div class="chart-wrapper">
                    <iframe src="views/charts/demografie_chart.php" class="chart-iframe"></iframe>
                </div>
            </div>

            <!-- Sănătate Section -->
            <div id="chart-sanatate" class="chart-section">
                <div class="chart-wrapper">
                    <iframe src="views/charts/sanatate_chart.php" class="chart-iframe"></iframe>
                </div>
            </div>

            <!-- Căsătorii Section -->
            <div id="chart-casatorii" class="chart-section">
                <div class="chart-wrapper">
                    <iframe src="views/charts/casatorii_chart.php" class="chart-iframe"></iframe>
                </div>
            </div>

            <!-- Ocupare Section -->
            <div id="chart-ocupare" class="chart-section">
                <div class="chart-wrapper">
                    <iframe src="views/charts/ocupare_chart.php" class="chart-iframe"></iframe>
                </div>
            </div>
        </div>
    </div>

  <div class="hr-divider"></div>

  <!-- DESPRE APLICAȚIE -->
<section class="about-section">
        <div class="geometric-overlay">
            <div class="floating-shape circle"></div>
            <div class="floating-shape square"></div>
            <div class="floating-shape triangle"></div>
        </div>
        
        <div class="about-container">
            <!-- Header Section cu titlu și descriere -->
            <div class="header-section">
                <h2 class="main-title">Despre aplicație</h2>
                <p class="main-description">
                    „Portal Statistică" este o aplicație web inovatoare dedicată analizării comportamentului 
                    tinerilor din Republica Moldova. Această platformă modernă oferă date structurate și 
                    vizualizări interactive pe domenii precum educația, demografia, sănătatea, 
                    ocuparea forței de muncă și impactul tehnologiei.
                </p>
            </div>

            <!-- Features Section cu iconuri în linie -->
            <div class="features-section">
                <div class="features-box">
                    <div class="features-icons-row">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4zm2.5 2.25h-15A2.25 2.25 0 0 1 .25 17V4A2.25 2.25 0 0 1 2.5 1.75h15A2.25 2.25 0 0 1 19.75 4v13a2.25 2.25 0 0 1-2.25 2.25z"/>
                            </svg>
                        </div>
                        
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6h-6z"/>
                            </svg>
                        </div>
                        
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6L23 9l-11-6zM18.82 9L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                            </svg>
                        </div>
                        
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2V8c0-1.11.89-2 2-2h16z"/>
                            </svg>
                        </div>
                        
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h3l1 1h8l1-1h3c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 13H4V5h16v11z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="features-description">
                        <h3 class="features-title">Caracteristici Principale</h3>
                        <p class="features-text">
                            Platforma oferă analize statistice detaliate, vizualizări interactive, 
                            date despre educație, informații privind ocuparea forței de muncă și 
                            evaluarea impactului tehnologic asupra tinerilor din Moldova.
                        </p>
                    </div>
                </div>

                <div class="bottom-banner">
                    <div class="banner-text">
                        Platformă modernă pentru înțelegerea realităților tineretului moldovenesc
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-container">
      <p>&copy; 2025 Portal Statistică.</p>
      <p>Creat pentru analiza comportamentului tinerilor din Republica Moldova.</p>
    </div>
  </footer>

  <script>
    document.getElementById('sectiuneSelect').addEventListener('change', function () {
      const selected = this.value;
      document.querySelectorAll('.chart-section').forEach(section => {
        section.style.display = 'none';
      });
      document.getElementById('chart-' + selected).style.display = 'block';
    });
  </script>

<script>
  document.getElementById("export-btn").addEventListener("click", function () {
    const sectiune = document.getElementById("sectiuneSelect").value;
    const iframe = document.querySelector(`#chart-${sectiune} iframe`);

    // Ascultă mesajul primit de la iframe
    window.addEventListener("message", function handleExportMessage(e) {
      const mode = e.data.mode || 'data';
      let param = '';

      if (sectiune === 'educatie') {
        if (mode === 'data') param = e.data.nivel;
        else if (mode === 'comparatie') param = e.data.tara;
      }

      const url = `controllers/export_controller.php?sectiune=${sectiune}&mode=${mode}&param=${encodeURIComponent(param)}`;
      window.open(url, '_blank');

      // Eliminăm listener-ul după ce l-am folosit
      window.removeEventListener("message", handleExportMessage);
    });

    // Trimitem cererea către iframe să ne dea valorile curente
    iframe.contentWindow.postMessage("getExportData", "*");
  });
</script>

   <script>
        // Chart navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navButtons = document.querySelectorAll('.nav-btn');
            const chartSections = document.querySelectorAll('.chart-section');

            navButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetSection = this.getAttribute('data-section');

                    // Remove active class from all buttons and sections
                    navButtons.forEach(btn => btn.classList.remove('active'));
                    chartSections.forEach(section => section.classList.remove('active'));

                    // Add active class to clicked button and corresponding section
                    this.classList.add('active');
                    document.getElementById(`chart-${targetSection}`).classList.add('active');
                });
            });
        });
    </script>






</body>
</html>