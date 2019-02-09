let time = [];
let temperatures = [];
let humidities = [];
let smokes = [];

fetch(`src/php/ajax/charts.php`, { method: 'get' })
    .then(response => response.json())
    .then(response => {
        response.forEach(data => {
            time.push(data.captureTime);
            temperatures.push(data.temperature);
            humidities.push(data.humidity);
            smokes.push(data.smoke);
        });

        // Création du graphique de température
        let ctxTemperature = document.querySelector('#chartTemperature').getContext('2d');
        let chartTemperature = new Chart(ctxTemperature, {
            type: 'line',
            data: {
                labels: time,
                datasets: [
                    {
                        data: temperatures,
                        label: "Température",
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)'
                    },
                ],
            },
            options: {
                maintainAspectRatio: false
            }
        });

        // Création du graphique d'humidité
        let ctxHumidity = document.querySelector('#chartHumidity').getContext('2d');
        ctxHumidity.height = 300;
        let chartHumidity = new Chart(ctxHumidity, {
            type: 'line',
            data: {
                labels: time,
                datasets: [
                    {
                        data: humidities,
                        label: "Humidité",
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    }
                ]
            },
            options: {
                maintainAspectRatio: false
            }
        });

        // Création du graphique de monoxyde
        let ctxSmoke = document.querySelector('#chartSmoke').getContext('2d');
        let chartSmoke = new Chart(ctxSmoke, {
            type: 'line',
            data: {
                labels: time,
                datasets: [
                    {
                        data: smokes,
                        label: "Fumée",
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)'
                    }
                ]
            },
            options: {
                maintainAspectRatio: false
            }
        });

    });




