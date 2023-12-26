<?php include '../tools/connection.php';
include '../tools/navbarhome.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sponsorships</title>
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
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php

        if(isset($_POST['addSponsorship'])){
            if(isset($_POST['sponserName'], $_POST['startDate'], $_POST['endDate'], $_POST['sponserType'])){
                $sponserName = $_POST['sponserName'];
                $startDate = $_POST['startDate'];
                $endDate = $_POST['endDate'];
                $sponserType = $_POST['sponserType'];

                
                $managerQuery = "SELECT manager_ID FROM manager ORDER BY RAND() LIMIT 1";
                $managerResult = $conn->query($managerQuery);

                if ($managerRow = $managerResult->fetch_assoc()) {
                    $managerID = $managerRow['manager_ID'];

                    
                    $insertQuery = "INSERT INTO sponser (sponserName, start_date, end_date, sponser_type, manager_ID) 
                                    VALUES ('$sponserName', '$startDate', '$endDate', '$sponserType', '$managerID')";
                    
                    if($conn->query($insertQuery)){
                        echo "
                        <div class='alert alert-success' role='alert'>
                            Sponsorship added successfully!
                        </div>
                        ";
                    } else {
                        echo "ERROR: $insertQuery <br> $conn->error";
                    }
                } else {
                    echo "No managers available.";
                }
            }
        }

        
        if(isset($_POST['deleteSponsorship'])){
            if(isset($_POST['sponserNameToDelete'])){
                $sponserNameToDelete = $_POST['sponserNameToDelete'];

                
                $deleteQuery = "DELETE FROM sponser WHERE sponserName = '$sponserNameToDelete'";
                
                if($conn->query($deleteQuery)){
                    echo "
                    <div class='alert alert-success' role='alert'>
                        Sponsorship deleted successfully!
                    </div>
                    ";
                } else {
                    echo "ERROR: $deleteQuery <br> $conn->error";
                }
            }
        }
    ?>

    <div class="container1 text-center">
        
        <div class="manage-box">
            <img src="../images/ninja.png" alt="Manage Image" class="manage-img" height="100px">
            <h2>Manage Sponsorships</h2>

            
            <form action="" method="post">
                <div class="form-group manage-options">
                    <label for="sponserName" class="p-2">Sponsor Name:</label>
                    <input type="text" class="form-control" name="sponserName" required>
                </div>
                <div class="form-group manage-options">
                    <label for="startDate" class="p-2">Start Date:</label>
                    <input type="date" class="form-control" name="startDate" required>
                </div>
                <div class="form-group manage-options">
                    <label for="endDate" class="p-2">End Date:</label>
                    <input type="date" class="form-control" name="endDate" required>
                </div>
                <div class="form-group manage-options">
                    <label for="sponserType" class="p-2">Sponsorship Type:</label>
                    <input type="text" class="form-control" name="sponserType" required>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-success p-2 m-4" value="Add Sponsorship" name="addSponsorship">
                </div>
            </form>

            <form action="" method="post">
                <div class="form-group manage-options">
                    <label for="sponserNameToDelete" class="p-2">Select Sponsorship to Delete:</label>
                    <select class="form-control" name="sponserNameToDelete" required>
                        <?php
                            $existingSponsorshipsQuery = "SELECT sponserName FROM sponser";
                            $existingSponsorshipsResult = $conn->query($existingSponsorshipsQuery);

                            while ($sponserRow = $existingSponsorshipsResult->fetch_assoc()) {
                                $sponserName = $sponserRow['sponserName'];
                                echo "<option value='$sponserName'>$sponserName</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Delete Sponsorship" name="deleteSponsorship">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
