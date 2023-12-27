<?php
include '../tools/connection.php';
include '../tools/navbar.php';

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
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>

<body style="background-color:#B00200">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Room Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../images/<?php echo $row['room_pic']; ?>" alt="Room Picture" style="max-width: 100%;">
            </div>
            <div class="col-md-6">
                <h1 style='color: white;'>
                    <?php echo "Room Number: " . $row['Room_ID'] . ""; ?>
                </h1>
                <p style='color: white;'><strong>Description:</strong></p>
                <p style='color: white;'>
                    <?php echo $row['room_desription']; ?>
                </p>
                <p style='color: white;'><strong>Price:</strong>
                    <?php echo $row['PricePerNight']; ?>
                </p>
                <p style='color: white;'><strong>Number Of Beds:</strong>
                    <?php echo $row['num of beds']; ?>
                </p>
                <p style='color: white;'><strong>Capacity:</strong>
                    <?php echo $row['capacity']; ?>
                </p>
                <button class="btn btn-danger" onclick="openBookingModal()">Book Now</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="closeBookingModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control mt-2" name="type" id="mealType">
                        <option selected> Select Meal Type</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Launch">Launch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Breakfast-Launch">Breakfast and Launch</option>
                    </select>
                    <input type="date" class="form-control mt-2" id="checkOutDate" placeholder="Check-out Date"
                        name="cdate">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick=" closeBookingModal();">Close</button>
                    <button type="button" class="btn btn-danger"
                        onclick="closeBookingModal(); redirectToBookPage(<?php echo $row['Room_ID']; ?>)">Book
                        Now</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function openBookingModal() {
            $("#bookingModal").modal('show');
        }

        function closeBookingModal() {
            $("#bookingModal").modal('hide');
        } 
        function redirectToBookPage(roomId) {
            var mealType = encodeURIComponent(document.getElementById('mealType').value);
            var originalDate = document.getElementById('checkOutDate').value;
            var dateObject = new Date(originalDate);
            var formattedDate = dateObject.toISOString().slice(0, 10);

            const today = new Date();
            const timeDifference = dateObject - today;
            const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

            var url = "book.php?rid=" + roomId + "&mealType=" + mealType + "&checkOutDate=" + formattedDate + "&duration=" + daysDifference;

            window.location.href = url;
        }

    </script>

</body>

</html>