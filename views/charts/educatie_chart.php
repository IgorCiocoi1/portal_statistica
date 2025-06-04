
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Educaționale - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/educatie.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    
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
                    <img src="../../assets/img/flag_romania.png" data-tara="Romania" class="flag-img selected" alt="România">                    
                    <img src="../../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
                    <img src="../../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
                    <img src="../../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
                </div>
                <input type="hidden" id="taraSelectHidden" value="Romania"> 
            </div>
        </div>
             <div class="chart-container" id="chart-panel" role="tabpanel" aria-labelledby="tab-data">
             <div class="chart-status" id="chartStatus"></div> <canvas id="unifiedChart"></canvas> </div>
    </section>
</body>
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
                url = `../../controllers/EducatieController.php?action=getData&tip=${encodeURIComponent(currentNivel)}`;
            } else if (currentMode === 'comparatie') {
                url = `../../controllers/EducatieController.php?action=getComparatieData&tara=${encodeURIComponent(currentTara)}`;
            } else if (currentMode === 'predictie') {
                url = '../../controllers/PredictiiController.php?action=getPredictii';
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
    
    // Moldova dataset - bare albastre
    datasets.push({
        label: `Moldova - ${currentNivel}`,
        data: mdData.map(d => d.Numar),
        backgroundColor: '#60a5fa',        // Albastru deschis
        borderColor: '#3b82f6',           // Bordură puțin mai închisă
        borderWidth: 1,
        borderRadius: 4,                  // Colțuri rotunjite
        borderSkipped: false
    });
    
    // Țara de comparație dataset - bare verzi
    datasets.push({
        label: `${currentTara} - ${currentNivel}`,
        data: compareData.map(d => d.Numar),
        backgroundColor: '#34d399',        // Verde deschis
        borderColor: '#10b981',           // Bordură verde
        borderWidth: 1,
        borderRadius: 4,                  // Colțuri rotunjite
        borderSkipped: false
    });
    
    chartTitle = `Comparație: ${currentNivel} (Moldova vs ${currentTara})`;
    
    // Configurare specifică pentru bar chart
    chartType = 'bar';  // Setează tipul la bar chart
    chartTitle = `Comparație: ${currentNivel} (Moldova vs ${currentTara})`;
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

    // Trimite datele către parent (home.php) când se cere export
window.addEventListener("message", function(event) {
  if (event.data === "getExportData") {
    const mode = document.querySelector('.tab-btn.active')?.dataset.mode;
    const nivel = document.getElementById('educatie-nivelSelect')?.value;
    const tara = document.getElementById('educatie-taraSelectHidden')?.value;

    window.parent.postMessage({
      mode: mode,
      nivel: nivel,
      tara: tara
    }, "*");
  }
});

</script>
