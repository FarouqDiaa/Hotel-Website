<?php
include '../tools/connection.php';
include '../tools/navbar.php';

$availabilityQuery = "SELECT * FROM room";
$availabilityResult = $conn->query($availabilityQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Room Availability</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<style>
    .room-box {
        background-color: #222;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
        color: #fff;
    }

    .room-img {
        margin-bottom: 20px;
    }

    .btn-success {
        width: 150px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .availability {
        color: #28a745; /* Green color for available rooms */
    }

    .unavailability {
        color: #dc3545; /* Red color for unavailable rooms */
    }
</style>

<body style="background-color: rgb(5,5,5);">
    <div class="container1 text-center">
        <div class="room-box">
            
            <h2 style="color:ea4f4c;">Check Room Availability</h2>

            <?php
            if ($availabilityResult->num_rows > 0) {
                while ($row = $availabilityResult->fetch_assoc()) {
                    $availability = $row['avalability'];
                    $availabilityClass = $availability ? 'availability' : 'unavailability';

                    echo "
                        <div class='room-text $availabilityClass'>
                            <p class='$availabilityClass'>" . ($availability ? 'Room Available' : 'Room Not Available') . "</p>
                        </div>
                    ";
                }
            } else {
                echo "<p>No rooms found.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
