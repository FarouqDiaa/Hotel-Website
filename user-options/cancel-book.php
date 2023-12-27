<?php
    include '../includes/connection.php';

    if (!isset($_SESSION["id"])) {
        header("Location: ../user-options/login.php");
        exit();
    }
    $booking_id = $_GET["booking_id"];
    if(isset($_POST["cancel"])&& isset($_GET["booking_id"]))// TODO: make cancel button 
{
    $delete_booking_sql = "DELETE FROM book_room WHERE Booking_ID=$booking_id";

        if ($conn->query($delete_courses_sql) === TRUE) {
            $checkout_date = date("Y-m-d");
            $upd_checkout_sql="UPDATE `booking` SET `checkout_date`=$checkout_date WHERE Booking_ID=$booking_id;";

            if ($conn->query($upd_checkout_sql) === TRUE){
            echo "
            <div class='alert alert-success' role='alert'>
                Your Booking has been deleted successfully!
            </div>
            ";
            header("Location: ../dashboard.php");
            }
            else {
                echo "ERROR: $upd_checkout_sql <br> $conn->error";
            }
        } else {
            echo "ERROR: $delete_courses_sql <br> $conn->error";
        }
     
}
?>
