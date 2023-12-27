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
