<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Căsătorii - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/casatorii.css">
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
                    <img src="../../assets/img/flag_romania.png" data-tara="Romania" class="flag-img" alt="România">
                    <img src="../../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
                    <img src="../../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
                    <img src="../../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
                </div>
                <input type="hidden" id="taraSelectHidden" value="Romania"> 
            </div>
        </div>

        <div class="chart-container" id="chart-panel" role="tabpanel" aria-labelledby="tab-data">
            <div class="chart-status" id="chartStatus"></div> 
            <canvas id="unifiedChart"></canvas> 
        </div>
    </section>

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
            url = `../../controllers/CasatoriiController.php?tip=date&indicator=${currentIndicator}`;
        } else if (currentMode === 'comparatie') {
            url = `../../controllers/CasatoriiController.php?tip=comparatie&tarea=${encodeURIComponent(currentTara)}&indicator=${currentIndicator}`;
        } else if (currentMode === 'predictie') {
            url = `../../controllers/CasatoriiController.php?tip=predictie&indicator=${currentIndicator}`;
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