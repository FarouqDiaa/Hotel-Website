<?php
include '../tools/connection.php';
include '../tools/navbar.php';
if (isset($_POST["course_submit"]) && isset($_SESSION['id'])) {
    $serviceId = $_POST["service_ID"];
    $guestId = $_SESSION['id'];
    $insertQuery = "INSERT INTO `request_service` (`guest_ID`, `service_ID`) VALUES ('$guestId', '$serviceId')";

    if ($conn->query($insertQuery) == true) {
        echo "
        <div class='alert alert-success' role='alert'>
            Your service request has been submitted successfully!
        </div>
        ";
    } else {
        echo "ERROR: $insertQuery <br> $conn->error";
    }
}

$sql = "SELECT * FROM service";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Service</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .service-box {
        background-color: #222;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .service-img {
        margin-bottom: 20px;
    }

    .service-options {
        margin-top: 10px;
    }
</style>

<body style="background-color: rgb(5,5,5);">
    <div class="container1 text-center">
        <div class="service-box">
            <img src="../images/ninja.png" alt="Service Image" class="service-img" height="100px">
            <h2 style="color:ea4f4c;">Request Room Service</h2>

            <form action="" method="post">
                <div class="form-group">
                    <label for="service" class="p-2">Service:</label>
                    <select class="form-control" id="service" name="service_ID" required>
                        <option value="" disabled class="p-2">Select service</option>
                        <option value="1" <?php echo ($row["service_ID"] == 1) ? "selected" : ""; ?>>Room Service-250EGP
                        </option>
                        <option value="2" <?php echo ($row["service_ID"] == 2) ? "selected" : ""; ?>>Laundry-100EGP
                        </option>
                        <option value="3" <?php echo ($row["service_ID"] == 3) ? "selected" : ""; ?>>Car Rental-3000EGP
                        </option>
                        <option value="4" <?php echo ($row["service_ID"] == 4) ? "selected" : ""; ?>>Airport
                            Transfer-550EGP</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger p-2 m-3" name="course_submit">Request Service</button>
            </form>
        </div>
    </div>
</body>

</html>