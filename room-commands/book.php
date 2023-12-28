<?php
include '../tools/connection.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../user-options/login.php");
    exit();
}

if (!isset($_GET['guestId'])) {
    $room_id = $_GET['rid'];
    $guestid = $_SESSION['id'];
    $duration=$_GET['duration']; 
    $meal_type=$_GET['mealType'];
    $checkin_date = date("Y-m-d"); // checkin_date is today
    $checkout_date=$_GET['checkOutDate'];
    $checkEnrollmentQuery = "SELECT * FROM `book_room` WHERE Room_ID=$room_id"; // check if selected room is empty 
    $checkResult = $conn->query($checkEnrollmentQuery);

    if ($checkResult->num_rows == 0) { // if checked room is empty make the booking for the user
        $sql2 = "SELECT `PricePerNight`FROM room WHERE Room_ID=$room_id;";
        $result = $conn->query($sql2);
        $row = $result->fetch_assoc();
        $price_night=$row["PricePerNight"];
        $payment=$duration * $price_night;
       
        $insertQuery = "INSERT INTO `booking`( `payment`, `meal_type`, `checkin_date`, `checkout_date`, `guest_ID`) VALUES ($payment,'$meal_type','$checkin_date','$checkout_date',$guestid);";
 
       
        if ($conn->query($insertQuery) === TRUE) {
            $insertQuery2="INSERT INTO `book_room`(`Room_ID`, `Booking_ID`) VALUES ($room_id,(SELECT max(Booking_ID) FROM booking));";
            if ($conn->query($insertQuery2) === TRUE)
            {
            $upd_availability="UPDATE `room` SET`avalability`=0 WHERE Room_ID=$room_id";
            if ($conn->query($upd_availability) === TRUE)    
            { header("Location: room-details.php?status=success&rid=$room_id"); 
            exit();
            }
            else 
            {
                echo "ERROR: $upd_availability <br> $conn->error";
            }
            }
            else {
            header("Location: room-details.php?status=error&message=" . urlencode($conn->error));
            exit();
            }}else {
        header("Location: room-details.php?status=error&message=" . urlencode($conn->error));
        exit();
        } 
 }else {
    header("Location: room-details.php?status=already_booked&rid=$room_id");
    exit();
 }

}else{
    $room_id = $_GET['rid'];
    $guestid=$_GET['guestId']; 
    $meal_type=$_GET['mealType'];
    $checkin_date = date("Y-m-d"); // checkin_date is today
    $checkout_date=$_GET['checkOutDate'];
    $admin = $_SESSION['id'];
    $checkEnrollmentQuery = "SELECT * FROM `book_room` WHERE Room_ID=$room_id"; // check if selected room is empty 
    $checkResult = $conn->query($checkEnrollmentQuery);

    if ($checkResult->num_rows == 0) { // if checked room is empty make the booking for the user
        $sql2 = "SELECT `PricePerNight`FROM room WHERE Room_ID=$room_id;";
        $result = $conn->query($sql2);
        $row = $result->fetch_assoc();
        $price_night=$row["PricePerNight"];
        $payment=$duration * $price_night;
       
        $insertQuery = "INSERT INTO `booking`( `payment`, `meal_type`, `checkin_date`, `checkout_date`, `staff_ID`,`guest_ID`) VALUES ($payment,'$meal_type','$checkin_date','$checkout_date', $admin,$guestid);";
 
       
        if ($conn->query($insertQuery) === TRUE) {
            $insertQuery2="INSERT INTO `book_room`(`Room_ID`, `Booking_ID`) VALUES ($room_id,(SELECT max(Booking_ID) FROM booking));";
            if ($conn->query($insertQuery2) === TRUE)
            {
            $upd_availability="UPDATE `room` SET`avalability`=0 WHERE Room_ID=$room_id";
            if ($conn->query($upd_availability) === TRUE)    
            { header("Location: room-details.php?status=success&rid=$room_id"); 
            exit();
            }
            else 
            {
                echo "ERROR: $upd_availability <br> $conn->error";
            }
            }
            else {
            header("Location: room-details.php?status=error&message=" . urlencode($conn->error));
            exit();
            }}else {
        header("Location: room-details.php?status=error&message=" . urlencode($conn->error));
        exit();
        } 
 }else {
    header("Location: room-details.php?status=already_booked&rid=$room_id");
    exit();
 }
   
}

$conn->close();
?>