<?php include 'tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: -webkit-linear-gradient(left, #9b0707, #d80808);
            color: #fff;
            padding: 40px;
        }

        .container-fluid {
            padding: 20px;
        }

        h1 {
            color: #ff5100;
            text-align: center;
            margin-bottom: 30px;
        }

        .room-card {
            background-color: #2A2727;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .room-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            max-height: 200px;
            object-fit: cover;
        }

        .room-card-body {
            padding: 20px;
        }

        .room-details p {
            line-height: 1.6;
        }

        /* Added styles for better visibility and design */
        .initial-form {
            margin-bottom: 30px;
        }

        .not-found-message {
            text-align: center;
            padding: 20px;
            background-color: #E74C3C;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <h1 class="text-warning">Room Details</h1>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Handle form submission
            if (isset($_POST['Roomnumbertext'])) {
                $roomNumber = $conn->real_escape_string($_POST['Roomnumbertext']);

                // Fetch room details based on the room number
                $sql = "SELECT * FROM room WHERE Room_ID = $roomNumber";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $roomDetails = $result->fetch_assoc();

                    // Display room details
                    echo "<div class='row'>";
                    echo "<div class='col-md-6 mx-auto'>";
                    echo "<div class='card room-card'>";
                    echo "<img id='roomImage' src='{$roomDetails['room_pic']}' class='card-img-top' alt='Room Image'>";
                    echo "<div class='card-body room-card-body'>";
                    echo "<h5 class='card-title'>Room {$roomDetails['Room_ID']}</h5>";
                    echo "<p class='card-text'>Price per Night: {$roomDetails['PricePerNight']}</p>";
                    echo "<p class='card-text'>Room Capacity: {$roomDetails['capacity']} persons</p>";
                    echo "<p class='card-text'>Number of Beds: {$roomDetails['num of beds']}</p>";
                    echo "<p class='card-text'>Description: {$roomDetails['desription']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    // Display not found message with improved styling
                    echo "<div class='not-found-message'>";
                    echo "<p>Room not found. Please check the room number and try again.</p>";
                    echo "</div>";
                }
            } else {
                echo "Please enter a Room Number.";
            }
        } else {
            // Display the form
            ?>
            <!-- Form to gather input from the user -->
            <div class="row initial-form">
                <div class="col-md-6 mx-auto">
                    <div class="card room-card">
                        <div class="card-body room-card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="roomNumber" class="p-2">Room Number:</label>
                                    <input type="number" name="Roomnumbertext" class="form-control p-2" id="roomNumber" required>
                                </div>
                                <button type="submit" class="btn btn-primary p-2">Get Room Details</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

</body>

</html>