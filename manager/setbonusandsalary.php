<?php
include '../tools/connection.php'; 
include '../tools/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Bonus and Salary for Staff</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .manage-box {
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .manage-img {
            margin-bottom: 20px;
        }
        .manage-options {
            margin-top: 10px;
        }
        .bonus-form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
        .bonus-form input {
            margin-right: 10px;
        }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php
        $staffQuery = "SELECT staff_ID, FName, LName, salary, working_hours, bonus, roomservice_ID FROM staff";
        $staffResult = $conn->query($staffQuery);
    ?>

    <div class="container1 text-center">
        <div class="manage-box">
            <img src="../images/ninja.png" alt="ninja Photo" class="manage-img" height="100px">
            <h2>Set Bonus and Salary for Staff</h2>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Full Name</th>
                        <th>Salary</th>
                        <th>Working Hours</th>
                        <th>Specialty</th>
                        <th>Bonus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($staffRow = $staffResult->fetch_assoc()) {
                            $staffID = $staffRow['staff_ID'];
                            $fullName = $staffRow['FName'] . ' ' . $staffRow['LName'];
                            $salary = $staffRow['salary'];
                            $workingHours = $staffRow['working_hours'];
                            $bonus = $staffRow['bonus'];
                            $roomserviceID = $staffRow['roomservice_ID'];
                            $specialty = ($roomserviceID != null) ? 'RoomService' : 'Receptionist';

                            echo "
                            <tr>
                                <td>$staffID</td>
                                <td>$fullName</td>
                                <td>$salary</td>
                                <td>$workingHours</td>
                                <td>$specialty</td>
                                <td>$bonus</td>
                                <td>
                                    <div class='bonus-form'>
                                        <form action='' method='post'>
                                            <input type='hidden' name='staffID' value='$staffID'>
                                            <input type='number' name='newSalary' placeholder='New Salary' required>
                                            <input type='submit' class='btn btn-success' name='setSalary' value='Set Salary'>
                                        </form>
                                        <form action='' method='post'>
                                            <input type='hidden' name='staffID' value='$staffID'>
                                            <input type='number' name='newBonus' placeholder='New Bonus' required>
                                            <input type='submit' class='btn btn-primary' name='setBonus' value='Set Bonus'>
                                        </form>
                                        <form action='' method='post'>
                                            <input type='hidden' name='staffID' value='$staffID'>
                                            <input type='submit' class='btn btn-warning' name='resetBonus' value='Reset Bonus'>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>

            <?php
                if(isset($_POST['setSalary'])){
                    $staffID = $_POST['staffID'];
                    $newSalary = max(0, $_POST['newSalary']); // Ensure salary is not negative

                    $updateSalaryQuery = "UPDATE staff SET salary = '$newSalary' WHERE staff_ID = '$staffID'";
                    
                    if($conn->query($updateSalaryQuery)){
                        echo "
                        <div class='alert alert-success' role='alert'>
                            Salary set successfully!
                        </div>
                        ";
                    } else {
                        echo "ERROR: $updateSalaryQuery <br> $conn->error";
                    }
                }
                
                if(isset($_POST['setBonus'])){
                    $staffID = $_POST['staffID'];
                    $newBonus = max(0, $_POST['newBonus']); // Ensure bonus is not negative

                    $updateBonusQuery = "call UPDATEBONUS($newBonus,$staffID)";
                    
                    if($conn->query($updateBonusQuery)){
                        echo "
                        <div class='alert alert-primary' role='alert'>
                            Bonus set successfully!
                        </div>
                        ";
                    } else {
                        echo "ERROR: $updateBonusQuery <br> $conn->error";
                    }
                }
                
                if(isset($_POST['resetBonus'])){
                    $staffID = $_POST['staffID'];

                    $resetBonusQuery = "UPDATE staff SET bonus = 0 WHERE staff_ID = '$staffID'";
                    
                    if($conn->query($resetBonusQuery)){
                        echo "
                        <div class='alert alert-warning' role='alert'>
                            Bonus reset successfully!
                        </div>
                        ";
                    } else {
                        echo "ERROR: $resetBonusQuery <br> $conn->error";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
