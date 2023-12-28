<?php include '../tools/connection.php';
include '../tools/navbarhome.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Schedule Events</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .event-box {
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .event-img {
            margin-bottom: 20px; /* Adjust as needed */
        }
        .event-options {
            margin-top: 10px;
        }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php
        // Add staff
        if(isset($_POST['addstaff'])){
            if(isset($_POST['eventName'], $_POST['eventDate'], $_POST['description'])){
                $FName = $_POST['FName'];
                $LName = $_POST['LName'];
                $age = $_POST['age'];
                $phone = $_POST['phone_number'];
                $position = $_POST['position'];
                $salary = $_POST['salary'];
                $working_hours=$_POST['working_hours'];
                $manager_ID = 1;
                $username = $_POST['username'];
                $password=$_POST['password'];
                if($position==="Room Service")
                 {$roomservice_id = $_POST['roomservice_id'];
                 }
                 $type=$_POST['type'];
                

                $insertQuery = "INSERT INTO `staff`( `FName`, `LName`, `age`, `phone_number`, `position`, `salary`, `working_hours`,`manager_ID`, `username`, `roomservice_ID`) VALUES ('$FName','$LName','$age',' $phone','$position',$salary,$working_hours,$manager_ID,$username,$roomservice_id)";
                $insertQuery2="INSERT INTO `account`(`username`, `password`, `type`) VALUES ('$username','$password','$type')";
                if($conn->query($insertQuery) == true ){
                    if($conn->query($insertQuery2) == true)
                    {
                    echo "
                    <div class='alert alert-success' role='alert'>
                        staff added successfully!
                    </div>
                    ";
                    }
                    else 
                    {
                        echo "
                    <div class='alert alert-warning' role='alert'>
                        staff addition failed
                    </div>
                    ";
                        echo "ERROR: $insertQuery2 <br> $conn->error";  
                    }
                } else {
                    echo "
                    <div class='alert alert-warning' role='alert'>
                        staff addition failed
                    </div>
                    ";
                    echo "ERROR: $insertQuery <br> $conn->error";
                }

                

            }
        }

        // Remove Event
        if(isset($_POST['removeEvent'])){
            if(isset($_POST['eventId'])){
                $eventId = $_POST['eventId'];

                $deleteQuery = "DELETE FROM `staff` WHERE staff_ID=$staffID";
                
                if($conn->query($deleteQuery) == true){
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
        <!-- Event box -->
        <div class="event-box">
            <img src="../images/ninja.png" alt="Event Image" class="event-img" height="100px">
            <h2>Manage Schedule Events</h2>

            <!-- Add Event Form -->
            <form action="" method="post">
                <div class="form-group event-options">
                    <label for="eventName" class="p-2">Event Name:</label>
                    <input type="text" class="form-control" name="eventName" placeholder="Enter Event Name" required>
                </div>
                <div class="form-group event-options">
                    <label for="eventDate" class="p-2">Event Date:</label>
                    <input type="date" class="form-control" name="eventDate" required>
                </div>
                <div class="form-group event-options">
                    <label for="description" class="p-2">Description:</label>
                    <textarea class="form-control" name="description" placeholder="Enter Event Description" required></textarea>
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
