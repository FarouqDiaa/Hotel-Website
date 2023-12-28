<?php include '../tools/connection.php' ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Profile</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php
    if (!isset($_SESSION["loggedin"])) {
        header("Location: login.php");
    }

    include '../tools/navbar.php';
    ?>

    <?php

    $id = $_GET['id'];
    $sql = "SELECT * FROM manager WHERE manager_ID=$id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if (isset($_POST['delete_button'])) {
        $SID = $_SESSION['id'];
        $sql = "DELETE FROM `account`
        WHERE `username` IN (SELECT `username` FROM `manager` WHERE manager_ID = $SID);";
        $conn->query($sql);
        $sql = "DELETE FROM `manager` WHERE manager_ID=$SID";

        if ($conn->query($sql) == true) {
            echo "
                <div class='alert alert-success' role='alert'>
                    Your profile has been deleted successfully!
                </div>
                <script>
                    setTimeout(function(){
                        window.location.href = '../user-options/logout.php';
                    }, 2000);
                </script>
            ";
        } else {
            echo "ERROR: $sql <br> $conn->error";
        }
    }

    ?>
    <br>
    <section style="background-color: white;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manager Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="../images/user.png" alt="User Profile Picture" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <br><br>
                            <?php echo "" . $_SESSION['username'] . "" ?>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["FName"] . "&nbsp" . $row["LName"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["email"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["phone"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Date Of Birth</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["dateOfBirth"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0" id="currentPassword">
                                        <?php echo "" . $_SESSION['password'] . "" ?>
                                    </p>
                                    <input type="password" class="form-control" id="newPassword" style="display: none;">
                                    <button class="btn btn-primary" id="editPasswordBtn" onclick="togglePasswordEdit()">
                                        Edit
                                    </button>
                                    <button class="btn btn-success" id="savePasswordBtn" style="display: none;"
                                        onclick="saveNewPassword()">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form method="post">
                        <button type="submit" name="delete_button" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Delete Account
                        </button>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>
    <script>
        function togglePasswordEdit() {
            document.getElementById('currentPassword').style.display = 'none';
            document.getElementById('newPassword').style.display = 'block';
            document.getElementById('editPasswordBtn').style.display = 'none';
            document.getElementById('savePasswordBtn').style.display = 'block';
        }

        function saveNewPassword() {
            var newPassword = document.getElementById('newPassword').value;

            $.ajax({
                type: 'POST',
                url: 'update_password.php',
                data: { newPassword: newPassword },
                success: function (response) {
                    console.log(response);

                    document.getElementById('currentPassword').innerText = newPassword;
                    document.getElementById('currentPassword').style.display = 'block';
                    document.getElementById('newPassword').style.display = 'none';
                    document.getElementById('editPasswordBtn').style.display = 'block';
                    document.getElementById('savePasswordBtn').style.display = 'none';
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }</script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>