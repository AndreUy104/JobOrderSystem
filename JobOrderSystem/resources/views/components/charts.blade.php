<div class="row">
    <div class="col">
        <canvas id="myChart" style="width:100%;max-width:800px;margin: auto"></canvas>
    </div>
    <script>
        const xValues = ["Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Oct" , "Nov" , "Dec" ];
        const yValues = [7,8,8,9,9,9,10,11,14,14,15];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 6, max:16}}],
                }
            }
        });
    </script>
</div>
