<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Statistici Sănătate - Portal Statistică</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/sanatate.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

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
                <img src="../../assets/img/flag_romania.png" class="flag-img" data-tara="Romania" title="România">
                <img src="../../assets/img/flag_germania.png" class="flag-img selected" data-tara="Germania" title="Germania">
                <img src="../../assets/img/flag_italia.png" class="flag-img" data-tara="Italia" title="Italia">
                <img src="../../assets/img/flag_franta.png" class="flag-img" data-tara="Franta" title="Franța">
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
    let url = '../../controllers/SanatateController.php?tip=' + tip;

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