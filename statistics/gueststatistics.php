<?php
include '../tools/connection.php';

$ratingQuery = "SELECT Room_ID, AVG(room_rating) AS avg_rating FROM rate_room GROUP BY Room_ID";
$ratingResult = $conn->query($ratingQuery);

$priceQuery = "SELECT Room_ID,PricePerNight AS avg_price FROM room GROUP BY Room_ID";
$priceResult = $conn->query($priceQuery);

$capacityQuery = "SELECT Room_ID, Capacity FROM room";
$capacityResult = $conn->query($capacityQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>User Statistics</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Statistics</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navigation {
            margin-top: 20px;
        }

        body {
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .statistics-container {
            background-color: #333;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10vh;
        }


        .chart-pair {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            width: 70vw;
        }

        .chart-container {
            width: 400px;
            border: 1px solid #555;
            padding: 10px;
            border-radius: 5px;
        }

        canvas {
            width: 100%;
            max-width: 400px;
            height: auto;
        }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php include '../tools/navbar.php'; ?>
    <br>
    <div class="container text-center">
        <div class="statistics-container">
            <h2 style="color: white;">Room Statistics</h2>

            <div class="chart-pair">
                <div class="chart-container">
                    <canvas id="ratingChart" width="400" height="200"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="priceChart" width="400" height="200"></canvas>
                </div>
            </div>
            <br><br>
            <div class="chart-container">
                <canvas id="capacityChart" width="400" height="200"></canvas>
            </div>
            <script>
                var ratingData = <?php echo json_encode($ratingResult->fetch_all(MYSQLI_ASSOC)); ?>;
                var ratingCtx = document.getElementById('ratingChart').getContext('2d');
                var ratingChart = new Chart(ratingCtx, {
                    type: 'bar',
                    data: {
                        labels: ratingData.map(room => room.Room_ID),
                        datasets: [{
                            label: 'Room Rating',
                            data: ratingData.map(room => room.avg_rating),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 5
                            }
                        }
                    }
                });

                // Average Price per Night Chart
                var priceData = <?php echo json_encode($priceResult->fetch_all(MYSQLI_ASSOC)); ?>;
                var priceCtx = document.getElementById('priceChart').getContext('2d');
                var priceChart = new Chart(priceCtx, {
                    type: 'bar',
                    data: {
                        labels: priceData.map(room => room.Room_ID),
                        datasets: [{
                            label: 'Price per Night',
                            data: priceData.map(room => room.avg_price),
                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
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

                // Room Capacity Chart (Line Chart)
                var capacityData = <?php echo json_encode($capacityResult->fetch_all(MYSQLI_ASSOC)); ?>;
                var capacityCtx = document.getElementById('capacityChart').getContext('2d');
                var capacityChart = new Chart(capacityCtx, {
                    type: 'line', // Change the chart type to line
                    data: {
                        labels: capacityData.map(room => room.Room_ID),
                        datasets: [{
                            label: 'Room Capacity',
                            data: capacityData.map(room => room.Capacity),
                            borderColor: 'rgba(255, 206, 86, 1)', // Line color
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(255, 206, 86, 1)', // Point color
                            fill: false, // Do not fill the area under the line
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
            </script>
        </div>
    </div>
</body>

</html>