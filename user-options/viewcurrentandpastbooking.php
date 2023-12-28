<?php
    include '../includes/connection.php';  
    include '../includes/navbar.php';

    if (!isset($_SESSION["id"])) {
        header("Location: ../useroptions/login.php");
        exit();
    }
    if (isset($_SESSION['id'])&& isset($_POST['view_booking']) ) { // TODO : make button view booking to
                                                                  // view guest his bookings when click on it
       
        $guestid = $_SESSION['id']; 
        $sql = "SELECT `Booking_ID`, `payment`, `meal_type`, `checkin_date`, `checkout_date`, `address` FROM `booking` WHERE guest_ID=$guestid;";
        
        $result = $conn->query($sql);
        
        echo "<table class='table table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Booking_ID</th>
                  <th>price</th>
                  <th>meal_type</th>
                  <th>checkin_date</th>
                  <th>checkout_date</th>
                  <th>address</th>
                </tr>
              </thead>
              <tbody>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Booking_ID"] . "</td><td>" . $row["payment"] . "</td></td>". $row["meal_type"] . "</td></td>". $row["checkin_date"] . "</td></td>". $row["checkout_date"] . "</td></td>". $row["address"] . "</td></tr>";
            
        }
        echo "</tbody></table>";
        

    
        
    }
    
?>
<!-- update for viewcurrent page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../coursesimg/<?php echo $row['course_image']; ?>" alt="<?php echo $row['course_image']; ?>" style="max-width: 100%;">
            </div>
            <div class="col-md-6">
                <h1><?php echo $row['course_name']; ?></h1>
                <p><strong>Instructor:</strong> Instructor Name</p>
                <p><strong>Description:</strong></p>
                <p><?php echo $row['course_desc']; ?></p>
                <p><strong>Price:</strong> <?php echo $row['course_price']; ?></p>
                <p><strong>Course Code:</strong> <?php echo $row['course_code']; ?></p>
                <a href="enroll.php?cid=<?php echo $row['course_id']; ?>" class="btn btn-primary">Enroll Now</a>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
