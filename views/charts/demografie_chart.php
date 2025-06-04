<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Demografice - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/demografie.css">
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
          <img src="../../assets/img/flag_romania.png" data-tara="Romania" class="flag-img selected" alt="România">
          <img src="../../assets/img/flag_germania.png" data-tara="Germania" class="flag-img" alt="Germania">
          <img src="../../assets/img/flag_italia.png" data-tara="Italia" class="flag-img" alt="Italia">
          <img src="../../assets/img/flag_franta.png" data-tara="Franta" class="flag-img" alt="Franța">
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
        url = `../../controllers/DemografieController.php?action=getData&sex=${sex}&localitate=${loc}`;
    } else if (currentMode === "comparatie") {
        url = `../../controllers/DemografieController.php?action=getComparatieData&tara=${currentTara}&sex=${sex}`;
    } else if (currentMode === "predictie") {
        url = `../../controllers/predictii_demografie.php?sex=${sex}`;
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