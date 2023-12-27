<?php include '../tools/connection.php';
include '../tools/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<style>
    .form-control::placeholder {
        color: white;
    }

    .event-box {
        background-color: #222;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .event-img {
        margin-bottom: 20px;
    }

    .event-options {
        margin-top: 10px;
    }
</style>

<body style="background-color: rgb(5,5,5);">
    <?php
    if (isset($_POST['addEvent'])) {
        if (isset($_POST['eventName'], $_POST['eventDate'], $_POST['description'])) {
            $eventName = $_POST['eventName'];
            $eventDate = $_POST['eventDate'];
            $description = $_POST['description'];
            $managerId = $_SESSION['id'];

            $insertQuery = "INSERT INTO `event` (`event_name`, `eventDate`, `description`, `manager_ID`) 
                                VALUES ('$eventName', '$eventDate', '$description', '$managerId')";

            if ($conn->query($insertQuery) == true) {
                echo "
                    <div class='alert alert-success' role='alert'>
                        Event added successfully!
                    </div>
                    ";
            } else {
                echo "ERROR: $insertQuery <br> $conn->error";
            }
        }
    }

    // Remove Event
    if (isset($_POST['removeEvent'])) {
        if (isset($_POST['eventId'])) {
            $eventId = $_POST['eventId'];

            $deleteQuery = "DELETE FROM `event` WHERE `event_ID` = '$eventId'";

            if ($conn->query($deleteQuery) == true) {
                echo "
                    <div class='alert alert-success' role='alert'>
                        Event removed successfully!
                    </div>
                    ";
            } else {
                echo "ERROR: $deleteQuery <br> $conn->error";
            }
        }
    }
    ?>

    <div class="container1 text-center">
        <div class="event-box">
            <img src="../images/ninja.png" alt="Event Image" class="event-img" height="100px">
            <h2 style="color:ea4f4c;">Manage Events</h2>

            <form action="" method="post">
                <div class="form-group event-options">
                    <label for="eventName" class="p-2">Event Name:</label>
                    <input style="color: black;" type="text" class="form-control" name="eventName"
                        placeholder="Enter Event Name" style="color:white;" required>
                </div>
                <div class="form-group event-options">
                    <label for="eventDate" class="p-2">Event Date:</label>
                    <input style="color: white;" type="date" class="form-control" name="eventDate" placeholder="Enter Event Date" required>
                </div>
                <div class="form-group event-options">
                    <label for="description" class="p-2">Description:</label>
                    <textarea class="form-control" name="description" placeholder="Enter Event Description"
                        required></textarea>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Add Event" name="addEvent">
                </div>
            </form>

            <!-- Remove Event Form -->
            <form action="" method="post">
                <div class="form-group event-options">
                    <label for="eventId" class="p-2">Select Event:</label>
                    <select class="form-control" name="eventId" required>
                        <?php

                        $eventsQuery = "SELECT * FROM `event`";
                        $result = $conn->query($eventsQuery);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $eventId = $row['event_ID'];
                                $eventName = $row['event_name'];

                                echo "<option value='$eventId'>$eventName</option>";
                            }
                        } else {
                            echo "<option value=''>No events available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Remove Event" name="removeEvent">
                </div>
            </form>
        </div>
    </div>
</body>

</html>