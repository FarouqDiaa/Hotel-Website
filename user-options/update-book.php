<?php include '../tools/connection.php';
        $booking_id = $_GET["booking_id"]; // get booking id i want to change its details
        $guestid = $_SESSION['id'];
        $meal_type=$_GET['mealType'];
        $checkout_date=$_GET['checkOutDate'];
        if(isset($_GET["booking_id"])){ 
            $sql = "UPDATE `booking` SET `meal_type`='$meal_type',`checkout_date`='$checkout_date' WHERE Booking_ID=$booking_id;";
            if($conn->query($sql) == true){
                echo "
                <div class='alert alert-success' role='alert'>
                    Your booking has been updated successfully!
                </div>
                ";
            }
            else{
                echo "ERROR: $sql <br> $conn->error";
            }
        }

 ?>