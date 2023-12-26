<?php
include '../tools/connection.php';
include '../tools/navbarhome.php';


$ageQuery = "SELECT COUNT(*) AS count, 
                    CASE
                        WHEN age < 20 THEN 'Less than 20'
                        WHEN age BETWEEN 20 AND 40 THEN '20-40'
                        WHEN age BETWEEN 40 AND 60 THEN '40-60'
                        ELSE 'Greater than 60'
                    END AS age_group
             FROM guest
             GROUP BY age_group";

$genderQuery = "SELECT COUNT(*) AS count, gender FROM guest GROUP BY gender";

$ageResult = $conn->query($ageQuery);
$genderResult = $conn->query($genderQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Statistics</title>
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
            <h2>Guest Statistics</h2>
            
            
            <canvas id="ageChart" width="40" height="20"></canvas>

            
            <canvas id="genderChart" width="20" height="10"></canvas>

            <script>
                
                var ageCtx = document.getElementById('ageChart').getContext('2d');
                var ageChart = new Chart(ageCtx, {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php
                            while ($row = $ageResult->fetch_assoc()) {
                                echo "'{$row['age_group']}', ";
                            }
                            ?>
                        ],
                        
                        datasets: [{
                            label: 'Number of Guests in each age',
                            data: [
                                <?php
                                $ageResult->data_seek(0);
                                while ($row = $ageResult->fetch_assoc()) {
                                    echo "{$row['count']}, ";
                                }
                                ?>
                            ],
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

                
                var genderCtx = document.getElementById('genderChart').getContext('2d');
                var genderChart = new Chart(genderCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Male', 'Female'],
                        datasets: [{
                            data: [
                                <?php
                                while ($row = $genderResult->fetch_assoc()) {
                                    echo "{$row['count']}, ";
                                }
                                ?>
                            ],
                            backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)'],
                        }]
                    },
                    
                });
            </script>
        </div>
    </div>
</body>
</html>
