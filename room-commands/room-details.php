<?php
    include '../includes/connection.php';  
    include '../includes/navbar.php';

    $id = $_GET['rid'];
    $sql = "SELECT * FROM room WHERE Room_ID=$id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    
        if ($status === 'success') {
            echo "<br><br><div class='alert alert-success' role='alert'>Successfully Booked!</div>";
        } elseif ($status === 'error') {
            $message = urldecode($_GET['message']);
            echo "<br><br><div class='alert alert-warning' role='alert'>Error booking this room: $message</div>";
        } elseif ($status === 'already_booked') {
            echo "<br><br><div class='alert alert-warning' role='alert'>You already booked this room.</div>";
        } elseif ($status === 'invalid_rid') {
            echo "<br><br><div class='alert alert-warning' role='alert'>Invalid Room ID.</div>";
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
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
                <img src="../images/<?php echo $row['room_pic']; ?>" alt="Room Picture" style="max-width: 100%;">
            </div>
            <div class="col-md-6">
                <h1><?php echo "Room Number: " $row['Room_ID']; ?></h1>
                <p><strong>Description:</strong></p>
                <p><?php echo $row['description']; ?></p>
                <p><strong>Price:</strong> <?php echo $row['PricePerNight']; ?></p>
                <p><strong>Number Of Beds:</strong> <?php echo $row['num of beds']; ?></p>
                <p><strong>Capacity:</strong> <?php echo $row['capacity']; ?></p>
                <a href="book.php?rid=<?php echo $row['Room_ID']; ?>" class="btn btn-danger" data-toggle="modal" data-target="#bookingModal">Book Now</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Payment" name="payment">
                    <select class="form-control mt-2">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    <input type="date" class="form-control mt-2" placeholder="Check-out Date">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Book Now</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
