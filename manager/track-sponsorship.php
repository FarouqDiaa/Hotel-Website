<?php include '../tools/connection.php';
include '../tools/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsors</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .manage-box {
        background-color: #222;
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

<body style="background-color: rgb(5,5,5);">
    <?php

    if (isset($_POST['addSponsorship'])) {
        if (isset($_POST['sponserName'], $_POST['startDate'], $_POST['endDate'], $_POST['sponserType'])) {
            $sponserName = $_POST['sponserName'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $sponserType = $_POST['sponserType'];
            $sponsor_image = $_FILES["sponsor_image"]["name"];
            $sponsor_img_tmp = $_FILES["sponsor_image"]["tmp_name"];
            $folder = "../images/" . $sponsor_image;

          
            $managerQuery = "SELECT manager_ID FROM manager ORDER BY RAND() LIMIT 1";
            $managerResult = $conn->query($managerQuery);

            if ($managerRow = $managerResult->fetch_assoc()) {
                $managerID = $managerRow['manager_ID'];


                $insertQuery = "INSERT INTO sponser (sponserName, start_date, end_date, sponser_type, manager_ID,pic) 
                                    VALUES ('$sponserName', '$startDate', '$endDate', '$sponserType', '$managerID',$sponsor_image)";

                if ($conn->query($insertQuery)) {
                    echo "
                        <div class='alert alert-success' role='alert'>
                            Sponsorship added successfully!
                        </div>
                        ";
                    move_uploaded_file($sponsor_img_tmp, $folder);

                } else {
                    echo "ERROR: $insertQuery <br> $conn->error";
                }
            } else {
                echo "No managers available.";
            }
        }
    }


    if (isset($_POST['deleteSponsorship'])) {
        if (isset($_POST['sponserNameToDelete'])) {
            $sponserNameToDelete = $_POST['sponserNameToDelete'];


            $deleteQuery = "DELETE FROM sponser WHERE sponserName = '$sponserNameToDelete'";

            if ($conn->query($deleteQuery)) {
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
            <h2 style="color:ea4f4c;">Manage Sponsorships</h2>


            <form action="" method="post">
                <div class="form-group manage-options">
                    <label for="sponserName" class="p-2" style="color:ea4f4c;">Sponsor Name:</label>
                    <input type="text" class="form-control" name="sponserName" style="color:000;" required>
                </div>
                <div class="form-group manage-options">
                    <label for="startDate" class="p-2" style="color:ea4f4c;">Start Date:</label>
                    <input type="date" class="form-control" name="startDate" style="color:000;" required>
                </div>
                <div class="form-group manage-options">
                    <label for="endDate" class="p-2" style="color:ea4f4c; ">End Date:</label>
                    <input type="date" class="form-control" name="endDate" style="color:000;" required>
                </div>
                <div class="form-group manage-options">
                    <label for="sponserType" class="p-2" style="color:ea4f4c;">Sponsorship Type:</label>
                    <input type="text" class="form-control" name="sponserType" style="color:000;" required>
                </div>

                <div class="form-group">
                    <label for="image">Sponsor Image:</label>
                    <input type="file" class="form-control-file" id="customfile" name="sponsor_image" required>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Add Sponsorship" name="addSponsorship">
                </div>
            </form>

            <form action="" method="post">
                <div class="form-group manage-options">
                    <label for="sponserNameToDelete" class="p-2" style="color:ea4f4c;">Select Sponsorship to
                        Delete:</label>
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
                    <input type="submit" class="btn btn-danger p-2 m-4" value="Delete Sponsorship"
                        name="deleteSponsorship">
                </div>
            </form>
        </div>
    </div>
</body>

</html>