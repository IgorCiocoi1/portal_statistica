<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Ocupare - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/ocupare.css">
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
      <img src="../../assets/img/flag_romania.png" data-tara="Romania" class="flag-img" alt="România">
      <img src="../../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
      <img src="../../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
      <img src="../../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
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
      url = `../../controllers/OcupareController.php?tip=date&indicator=${currentIndicator}`;
    } else if (currentMode === 'comparatie') {
      url = `../../controllers/OcupareController.php?tip=comparatie&tarea=${currentTara}&indicator=${currentIndicator}`;
    } else {
      url = `../../controllers/OcupareController.php?tip=predictie&indicator=${currentIndicator}`;
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