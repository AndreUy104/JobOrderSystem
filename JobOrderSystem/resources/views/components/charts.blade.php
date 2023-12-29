@props(['monthlySales', 'monthTotalSales'])
<div class="row">
    <div class="col">
        <button class="btn btn-info" onclick="printCharts()">Print Charts</button>
    </div>
</div>
<br/>
<div class="row">
    <!-- Line Chart for Total Sales -->
    <div class="col chart-container">
        <canvas id="LineChart" style="width:100%;max-width:800px;margin: auto"></canvas>
    </div>

    <!-- Bar Chart for Total Order Counts -->
    <div class="col chart-container">
        <canvas id="monthlySalesBarChart" style="width:100%;max-width:800px;margin: auto"></canvas>
    </div>

    <!-- Hidden container for print-friendly charts -->
    <div id="printableCharts" style="display:none;">
        <canvas id="printChartCanvas"></canvas>
        <canvas id="printBarChartCanvas"></canvas>
    </div>
</div>

<style>
    .chart-container {
        margin: 20px; /* Adjust the margin as needed */
    }
</style>

<script>
    // Assuming you have passed $monthlySales and $monthTotalSales from your controller
    const months = @json($monthlySales->pluck('month'));
    const salesData = @json($monthlySales->pluck('total'));
    const orderCounts = @json($monthTotalSales->pluck('count'));

    // Line chart for Total Sales
    const LineChart = new Chart("LineChart", {
        type: "line",
        data: {
            labels: months,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,0.5)",
                borderColor: "rgba(0,0,255,1.0)",
                pointBackgroundColor: "rgba(0,0,255,1.0)",
                pointBorderWidth: 2,
                pointRadius: 6,
                data: salesData
            }]
        },
        options: {
            legend: { display: false },
            scales: {
                x: [{
                    grid: { display: false }
                }],
                y: [{
                    ticks: {
                        beginAtZero: true,
                        min: Math.min(...salesData) - 2,
                        max: Math.max(...salesData) + 2
                    },
                    grid: { color: "rgba(0, 0, 0, 0.1)" }
                }]
            },
            title: {
                display: true,
                text: "Total Sales per Month"
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Sales: ' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            }
        }
    });

    //Bar chart for Total Order Counts
    const monthlySalesBarChart = new Chart("monthlySalesBarChart", {
        type: "bar",
        data: {
            labels: months,
            datasets: [{
                backgroundColor: "rgba(0,0,255,0.7)",
                borderColor: "rgba(0,0,255,1.0)",
                borderWidth: 1,
                data: orderCounts
            }]
        },
        options: {
            scales: {
                x: [{
                    grid: { display: false }
                }],
                y: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    },
                    grid: { color: "rgba(0, 0, 0, 0.1)" }
                }]
            },
            title: {
                display: true,
                text: "Total Count of Sales per Month"
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            }
        }
    });

    function printCharts() {
        // Create a print-friendly version of the Line Chart in a hidden container
        const printChartCanvas = document.getElementById('printChartCanvas');
        const printableChart = new Chart(printChartCanvas, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,0.5)",
                    borderColor: "rgba(0,0,255,1.0)",
                    pointBackgroundColor: "rgba(0,0,255,1.0)",
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    data: salesData
                }]
            },
            options: {
                legend: { display: false },
                scales: {
                    x: [{
                        grid: { display: false }
                    }],
                    y: [{
                        ticks: {
                            beginAtZero: true,
                            min: Math.min(...salesData) - 2,
                            max: Math.max(...salesData) + 2
                        },
                        grid: { color: "rgba(0, 0, 0, 0.1)" }
                    }]
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Sales: ' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                }
            }
        });

        // Create a print-friendly version of the Bar Chart in a hidden container
        const printBarChartCanvas = document.getElementById('printBarChartCanvas');
        const printableBarChart = new Chart(printBarChartCanvas, {
            type: "bar",
            data: {
                labels: months,
                datasets: [{
                    backgroundColor: "rgba(0,0,255,0.7)",
                    borderColor: "rgba(0,0,255,1.0)",
                    borderWidth: 1,
                    data: orderCounts
                }]
            },
            options: {
                scales: {
                    x: [{
                        grid: { display: false }
                    }],
                    y: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        },
                        grid: { color: "rgba(0, 0, 0, 0.1)" }
                    }]
                }
            }
        });

        // Show the hidden container with the print-friendly charts
        document.getElementById('printableCharts').style.display = 'block';

        // Trigger the print dialog
        window.print();

        // Hide the print-friendly version after printing
        document.getElementById('printableCharts').style.display = 'none';
    }
</script>
