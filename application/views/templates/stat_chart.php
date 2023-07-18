<?php
//formatting months array to fit chart.js
$views = array();


//Push zero 12 times
for ($i = 1; $i <= 12; $i++) {
    array_push($views, 0);
}

for ($i = 1; $i <= 12; $i++) {
    foreach ($statistics['views_by_month'] as $value) {
        if ($value['month'] == $i) {
            $views[$i] = $value['views'];
        }
    }
}

?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: ["Start","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Augt", "Sep", "Oct", "Nov", "Dec","End"],
            datasets: [{
                    label: "Views",
                    fill:false,
                    lineTension:0,
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?= json_encode(array_values($views)); ?>,
                }]
        },
        // Configuration options go here
        options: {
            fill:false,
            legend: {
                display: false
            }
        }
    });
</script>
