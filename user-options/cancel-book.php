<?php
include '../tools/connection.php';

if (!isset($_SESSION["id"])) {
    header("Location: ../user-options/login.php");
    exit();
}

$booking_id = $_GET["booking_id"];
$delete_booking_sql = "DELETE FROM book_room WHERE Booking_ID=$booking_id;";

if ($conn->query($delete_booking_sql) === TRUE) {
    $checkout_date = date("Y-m-d");
    $upd_checkout_sql = "UPDATE `booking` SET `checkout_date`='$checkout_date' WHERE Booking_ID=$booking_id;";

    if ($conn->query($upd_checkout_sql) === TRUE) {
        echo "
            <div class='alert alert-success' role='alert'>
                Your Booking has been deleted successfully!
            </div>
            ";
        
        $sql = "SELECT `Room_ID` FROM `book_room` WHERE Booking_ID=$booking_id";
        $result = $conn->query($sql);
        
        if ($row = $result->fetch_assoc()) {
            $upd_availability = "UPDATE `room` SET `avalability`=1 WHERE Room_ID=" . $row["Room_ID"] . "";
            
            if ($conn->query($upd_availability) === TRUE) {
                echo "Booking deleted successfully!";
                header("Location: guestprofile.php");
                exit();
            } else {
                echo "ERROR: $upd_availability <br> " . $conn->error;
            }
        } else {
            echo "No Rooms";
        }
    } else {
        echo "ERROR: $upd_checkout_sql <br> " . $conn->error;
    }
} else {
    echo "ERROR: booking <br> " . $conn->error;
}
?>
