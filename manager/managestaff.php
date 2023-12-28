<?php
include '../tools/connection.php';
include '../tools/navbar.php';

if (isset($_POST['addStaff'])) {
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $age = $_POST['age'];
    $phone = $_POST['phone_number'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $working_hours = $_POST['working_hours'];
    $manager_ID = 1;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    if ($position === "Room Service") {
        $insertQuery = "INSERT INTO `staff`(`FName`, `LName`, `age`, `phone_number`, `position`, `salary`, `working_hours`, `manager_ID`, `username`) VALUES ('$FName','$LName','$age',' $phone','$position',$salary,$working_hours,$manager_ID,'$username')";
        if ($conn->query($insertQuery) == true) {
        } else {
            echo "ERROR: $insertQuery <br> $conn->error";
        }
        $insertQuery = "UPDATE `staff` SET roomservice_ID= (SELECT max(staff_ID) FROM staff) WHERE username='$username';";
    } else {
        $insertQuery = "INSERT INTO `staff`(`FName`, `LName`, `age`, `phone_number`, `position`, `salary`, `working_hours`, `manager_ID`, `username`) VALUES ('$FName','$LName','$age',' $phone','$position',$salary,$working_hours,$manager_ID,'$username')";
    }

    $insertQuery2 = "INSERT INTO `account`(`username`, `password`, `type`) VALUES ('$username','$password','$type')";
    if ($conn->query($insertQuery) == true) {
        if ($conn->query($insertQuery2) == true) {
            echo "
            <div class='alert alert-success' role='alert'>
                Staff added successfully!
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-warning' role='alert'>
                Staff addition failed
            </div>
            ";
            echo "ERROR: $insertQuery2 <br> $conn->error";
        }
    } else {
        echo "
        <div class='alert alert-warning' role='alert'>
            Staff addition failed
        </div>
        ";
        echo "ERROR: $insertQuery <br> $conn->error";
    }
}

if (isset($_POST['removeStaff'])) {
    $staffIDToRemove = $_POST['staffIDToRemove'];
    $deleteQuery = "DELETE FROM `staff` WHERE staff_ID=$staffIDToRemove";

    if ($conn->query($deleteQuery) == true) {
        echo "
        <div class='alert alert-success' role='alert'>
            Staff removed successfully!
        </div>
        ";
    } else {
        echo "ERROR: $deleteQuery <br> $conn->error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<style>
    .navigation {
        margin-top: 20px;
    }

    .staff-box {
        background-color: #222;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
        color: #fff;
    }

    .staff-img {
        margin-bottom: 20px;
    }

    .btn-danger,
    .btn-success {
        width: 150px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    /* Set background color of textboxes to white */
    input[type="text"],
    input[type="number"],
    input[type="password"] {
        background-color: #fff;
    }
</style>

<body style="background-color: rgb(5,5,5);">
    <div class="container1 text-center">
        <div class="staff-box">
            <img src="../images/ninja.png" alt="Staff Image" class="staff-img" height="100px">
            <h2 style="color:ea4f4c;">Manage Staff</h2>

            <form action="" method="post">
                <h3 class="p-3">Add Staff</h3>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" name="FName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" name="LName" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" name="age" required>
                </div>
                <div class="form-group">
                    <label for="phone number">Phone number:</label>
                    <input type="number" class="form-control" name="phone_number" required>
                </div>
                <div class="form-group">
                    <label for="age">Position:</label>
                    <input type="text" class="form-control" name="position" required>
                </div>
                <div class="form-group">
                    <label for="age">Salary:</label>
                    <input type="number" class="form-control" name="salary" required>
                </div>
                <div class="form-group">
                    <label for="age">Working Hours:</label>
                    <input type="number" class="form-control" name="working_hours" required>
                </div>
                <div class="form-group">
                    <label for="age">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="age">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label for="age">Type:</label>
                    <input type="text" class="form-control" name="type" required>
                </div>
                <button type="submit" class="btn btn-success" name="addStaff">Add Staff</button>
            </form>

            <form action="" method="post">
                <h3 class="p-3">Remove Staff</h3>
                <div class="form-group">
                    <label for="staffIDToRemove">Select Staff ID to Remove:</label>
                    <select class="form-control" name="staffIDToRemove" required>
                        <?php
                        $staffQuery = "SELECT staff_ID FROM staff";
                        $staffResult = $conn->query($staffQuery);

                        while ($row = $staffResult->fetch_assoc()) {
                            $staffID = $row['staff_ID'];
                            echo "<option value='$staffID'>$staffID</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger" name="removeStaff">Remove Staff</button>

            </form>
        </div>
    </div>
</body>

</html>
