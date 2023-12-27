<?php
include '../tools/connection.php';
include '../tools/navbar.php';

// Fetch data for room ratings
$ratingQuery = "SELECT Room_ID, AVG(room_rating) AS avg_rating FROM rate_room GROUP BY Room_ID";
$ratingResult = $conn->query($ratingQuery);

// Fetch data for average price per night
$priceQuery = "SELECT Room_ID, AVG(PricePerNight) AS avg_price FROM room GROUP BY Room_ID";
$priceResult = $conn->query($priceQuery);

// Fetch data for room capacity
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
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Statistics</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .statistics-box {
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <div class="container1 text-center">
        <div class="statistics-box">
            <h2>Room Statistics</h2>
            
            <!-- Room Rating Chart -->
            <canvas id="ratingChart" width="40" height="20"></canvas>

            <!-- Average Price per Night Chart -->
            <canvas id="priceChart" width="20" height="10"></canvas>

            <!-- Room Capacity Chart -->
            <canvas id="capacityChart" width="20" height="10"></canvas>

            <script>
                // Room Rating Chart
                var ratingData = <?php echo json_encode($ratingResult->fetch_all(MYSQLI_ASSOC)); ?>;
                var ratingCtx = document.getElementById('ratingChart').getContext('2d');
                var ratingChart = new Chart(ratingCtx, {
                    type: 'bar', // Change the chart type to bar
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
