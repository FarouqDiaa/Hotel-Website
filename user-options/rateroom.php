<?php include '../tools/connection.php'; 
include '../tools/navbarhome.php';
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Feedback</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
     .feedback-box {
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
     }
     .feedback-img {
        margin-bottom: 20px; /* Adjust as needed */
     }
     .rating {
        margin-top: 10px;
     }
     .txtarea{
        height:100px;
     }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php

        if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id']; // Replace with the actual user ID 
        $bookingQuery = "SELECT Room_ID from booking b,book_room br WHERE(b.Booking_ID=br.Booking_ID and guest_ID=$user_id);"; //update query
        $result = $conn->query($bookingQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $roomNumber = $row['Room_ID'];  // get here room number of the user that open now the page
        } else {
            echo "<br><br><div class='alert alert-success' role='alert'>you didnot reserve a room yet </div>"; // Set a default value or handle the case when no booking is found
        }
        if(isset($_POST['roomrating'])){    
            $rating = $_POST['roomrating'];

            $sql = "INSERT INTO rate_room VALUES ((SELECT Room_ID from booking b,book_room br WHERE(b.Booking_ID=br.Booking_ID and guest_ID=$user_id)),$user_id,$rating)"; //update query



            if($conn->query($sql) == true){
                echo "
                <div class='alert alert-success' role='alert'>
                    Thank you for your feedback!
                </div>
                ";
            } else {
                echo "ERROR: $sql <br> $conn->error";
            }
        }
        }
    ?>

    <div class="container1 text-center">
        <!-- Feedback box -->
        <div class="feedback-box">
            <img src="../images/ninja.png" alt="Feedback Image" class="feedback-img" height="100px">
            <h2>Room Feedback</h2>
            <form action="" method="post">
                <div class="form-group rating">
                    <label for="rating" class="p-2">Rating for room number <?php if(isset($roomNumber))echo $roomNumber; ?>:</label>
                    <select class="form-control" name="roomrating" required>
                        <option value="5">5 stars</option>
                        <option value="4">4 stars</option>
                        <option value="3">3 stars</option>
                        <option value="2">2 stars</option>
                        <option value="1">1 star</option>
                    </select>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Submit Feedback">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
