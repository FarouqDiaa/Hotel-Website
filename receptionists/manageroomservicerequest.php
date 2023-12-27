<?php include '../tools/connection.php'; 
include '../tools/navbarhome.php';?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Room Service Requests</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .manage-box {
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .manage-img {
            margin-bottom: 20px; 
        }
        .manage-options {
            margin-top: 10px;
        }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php
        
        $staffQuery = "SELECT roomservice_ID, FName FROM staff WHERE roomservice_ID IS NOT NULL";
        $staffResult = $conn->query($staffQuery);

        
        $servicesQuery = "SELECT guest_ID, service_ID FROM request_service";
        $servicesResult = $conn->query($servicesQuery);

        
        $roomID = null;

        
        $staffID = null;

        
        if(isset($_POST['assignService'])){
            if(isset($_POST['serviceID'], $_POST['staffID'])){
                $serviceID = $_POST['serviceID'];
                $staffID = $_POST['staffID'];

                
                if ($servicesResult->num_rows > 0) {
                    
                    $guestIDQuery = "SELECT guest_ID FROM request_service WHERE service_ID = '$serviceID'";
                    $guestIDResult = $conn->query($guestIDQuery);
                    
                    if ($guestIDRow = $guestIDResult->fetch_assoc()) {
                        $guestID = $guestIDRow['guest_ID'];
                    }

                    
                    $roomidQuery = "SELECT Room_ID FROM book_room 
                                    WHERE Booking_ID IN (SELECT Booking_ID FROM booking WHERE guest_ID = '$guestID')";
                    $roomidResult = $conn->query($roomidQuery);

                    while ($roomidRow = $roomidResult->fetch_assoc()) {
                        $roomID = $roomidRow['Room_ID'];
                    }

                    
                    $maxOrderIDQuery = "SELECT MAX(order_ID) AS maxOrderID FROM roomserviceorder 
                                        WHERE staff_ID = '$staffID'";
                    $maxOrderIDResult = $conn->query($maxOrderIDQuery);
                    $maxOrderIDRow = $maxOrderIDResult->fetch_assoc();
                    $orderID = $maxOrderIDRow['maxOrderID'] + 1;

                    
                    $insertQuery = "INSERT INTO roomserviceorder (service_ID, staff_ID, room_ID, order_ID, is_finished) 
                                    VALUES ('$serviceID', '$staffID', '$roomID', '$orderID', 0)";
                    
                    
                    $deleteQuery = "DELETE FROM request_service WHERE service_ID = '$serviceID' AND guest_ID = '$guestID'";
                    
                    if($conn->query($insertQuery)&&$conn->query($deleteQuery)){
                        echo "
                        <div class='alert alert-success' role='alert'>
                            Service assigned successfully!
                        </div>
                        ";
                    } else {
                        echo "ERROR: $insertQuery <br> $conn->error";
                    }
                } else {
                    echo "
                    <div class='alert alert-danger' role='alert'>
                        No available services to assign.
                    </div>
                    ";
                }
            }
        }
    ?>

    <div class="container1 text-center">
        
        <div class="manage-box">
            <img src="../images/ninja.png" alt="Manage Image" class="manage-img" height="100px">
            <h2>Manage Room Service Requests</h2>

            
            <form action="" method="post">
                <div class="form-group manage-options">
                    <label for="serviceID" class="p-2">Select Service:</label>
                    <select class="form-control" name="serviceID" required>
                        <?php
                            while ($serviceRow = $servicesResult->fetch_assoc()) {
                                $serviceID = $serviceRow['service_ID'];
                                $guestID = $serviceRow['guest_ID'];

                                echo "<option value='$serviceID'>guestID $guestID request serviceID $serviceID</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group manage-options">
                    <label for="staffID" class="p-2">Select Staff:</label>
                    <select class="form-control" name="staffID" required>
                        <?php
                            // Reset the staffResult pointer to the beginning
                            $staffResult->data_seek(0);

                            while ($staffRow = $staffResult->fetch_assoc()) {
                                $currentStaffID = $staffRow['roomservice_ID'];
                                $staffName = $staffRow['FName'];

                                $countQuery = "SELECT COUNT(*) AS service_count FROM roomserviceorder 
                                                WHERE staff_ID = '$currentStaffID' AND is_finished = 0";
                                $countResult = $conn->query($countQuery);
                                $countRow = $countResult->fetch_assoc();
                                $serviceCount = $countRow['service_count'];

                                echo "<option value='$currentStaffID'>$staffName (Services: $serviceCount)</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Assign Service" name="assignService">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
