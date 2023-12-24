<?php include '../tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Room Service</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .service-box {
            background-color: #f4f4f4;
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
</head>


<body style="background-color: rgb(5,5,5);">
    <?php
        if(isset($_POST['serviceId'])&& $_POST['requestsubmit']){
            $guestId = 5;
            $serviceId = $_POST['serviceId'];

            // Fetch the price of the selected service
            $priceQuery = "SELECT price FROM `service` WHERE service_ID = $serviceId";
            $result = $conn->query($priceQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $price = $row['price'];

                $insertQuery = "INSERT INTO `request_service` (`guest_ID`, `service_ID`) VALUES ('$guestId', '$serviceId')";
                if($conn->query($insertQuery) == true){
                    echo "
                    <div class='alert alert-success' role='alert'>
                        Room service requested successfully!
                    </div>
                    ";
                } else {
                    echo "ERROR: $insertQuery <br> $conn->error";
                }
            }
        }
    ?>

    <div class="container1 text-center">
        <div class="service-box">
            <img src="../images/ninja.png" alt="Service Image" class="service-img" height="100px">
            <h2>Request Room Service</h2>

            <form action="" method="post">
                <div class="form-group service-options">
                    <label for="serviceId" class="p-2">Select Service:</label>
                    <select class="form-control" name="serviceId" required>
                        <?php
                            $servicesQuery = "SELECT * FROM `service`";
                            $result = $conn->query($servicesQuery);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $serviceId = $row['service_ID'];
                                    $serviceName = $row['service_name'];
                                    $price = $row['price'];

                                    echo "<option value='$serviceId' >$serviceName - $price EGP</option>";
                                }
                            } else {
                                echo "<option value=''>No services available</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4"  name="requestsubmit" value="Request Service">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
