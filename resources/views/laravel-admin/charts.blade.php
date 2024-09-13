<!DOCTYPE html>
<html>
<head>
    <title>Charts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.4.2/chroma.min.js"></script>
    <style>
        .chart-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .chart-container > div {
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <div>
            <canvas id="revenueByDateChart" width="400" height="400"></canvas>
        </div>
        <div>
            <canvas id="revenueByRoomTypeChart" width="400" height="400"></canvas>
        </div>
        <div>
            <canvas id="revenueByStatusChart" width="400" height="400"></canvas>
        </div>
        <div>
            <canvas id="revenueByUserChart" width="400" height="400"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

    $(function () {
        var ctx1 = document.getElementById("revenueByDateChart").getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Total Revenue by Date',
                    data: @json($revenues),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById("revenueByRoomTypeChart").getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($roomTypes),
                datasets: [{
                    label: 'Total Revenue by Room Type',
                    data: @json($revenues),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx3 = document.getElementById("revenueByStatusChart").getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($statuses),
                datasets: [{
                    label: 'Total Revenue by Status',
                    data: @json($revenues),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': Rp ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        var ctx4 = document.getElementById("revenueByUserChart").getContext('2d');
        var numStatuses = @json(count($users));

        function generateColors(count) {
        return chroma.scale(['Red', 'Yellow'])
            .mode('lab')
            .colors(count);
        }

        var colors = generateColors(numStatuses);

        new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: @json($users),
                datasets: [{
                    label: 'Total Revenue by User',
                    data: @json($revenues),
                    backgroundColor: colors.map(color => chroma(color).alpha(0.2).css()),
                    borderColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': Rp ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }

        });
        console.log('Number of users:', numStatuses);
        console.log('Number of colors:', colors.length);
        console.log('Number of data points:', @json($revenues).length);
    });
    </script>
</body>
</html>
