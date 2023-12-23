<?php
include '../includes/connection.php';

if (!isset($_SESSION["id"])) {
    header("Location: ../useroptions/login.php");
    exit();
}

if (isset($_GET['cid'])) {
    $room_id = $_GET['cid'];
    $guestid = $_SESSION['id'];
    $payment_money=$_POST['payment']; //TODO :make textbox called payment take the amount of money from user
    $meal_type=$_POST['meal_type'];//TODO :make textbox called meal_type take the meal_type from user
    $checkin_date = date("Y-m-d"); // checkin_date is today
    $checkout_date=$_POST['checkout_date'];//TODO :make textbox called checkout_date take the checkout_date from user
    $address=$_POST['address'];//TODO :make textbox called address take the address from user

    


    $checkEnrollmentQuery = "SELECT * FROM `book_room` WHERE Room_ID=$room_id"; // check if selected room is empty 
    $checkResult = $conn->query($checkEnrollmentQuery);

    if ($checkResult->num_rows == 0) { // if checked room is empty make the booking for the user
        $insertQuery = "INSERT INTO `booking`( `payment`, `meal_type`, `checkin_date`, `checkout_date`, `address`, `guest_ID`) VALUES ('$payment_money','$meal_type','$checkin_date','$checkout_date','$address',$guestid);";
        
        if ($conn->query($insertQuery) === TRUE) {
            $insertQuery2="INSERT INTO `book_room`(`Room_ID`, `Booking_ID`) VALUES ($room_id,(SELECT max(Booking_ID) FROM booking));";
            if ($conn->query($insertQuery2) === TRUE)
            {
                echo "
                <div class='alert alert-success' role='alert'>
                    room booked successfully
                </div>
                ";
            header("Location: coursedetails.php?status=success&cid=$course_id"); // donot  understand what that doing
            exit();
            }

        } else {
            header("Location: coursedetails.php?status=error&message=" . urlencode($conn->error));// donot  understand location : etc
            exit();
        }
    } else {
        header("Location: coursedetails.php?status=already_enrolled&cid=$course_id");// donot  understand what that doing
        exit();
    }} else {
        header("Location: coursedetails.php?status=invalid_cid");// donot  understand what that doing
exit();
}

$conn->close();
?>
