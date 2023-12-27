<?php include '../tools/connection.php' ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    $sql = "SELECT * FROM guest WHERE guest_ID=$id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if (isset($_POST['delete_button'])) {  // TODO : make input called delete button to delete_button  when user click on it  
    
        $guest_ID = $_SESSION['id'];  // TODO :check for any thing should be done using html and css
        $sql = "DELETE FROM `guest` WHERE guest_ID=$guest_ID"; // deleting user profile
    
        if ($conn->query($sql) == true) {
            echo "
                <div class='alert alert-success' role='alert'>
                    your profile deleted successfuly!
                </div>
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
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["address"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Passport ID</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["passport_ID"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nationality</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["nationality"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["gender"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Age</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["age"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Card Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "" . $row["card_number"] . "" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <strong><br>&nbsp&nbsp Rented Rooms: <strong>
                                        <div class="card-body">
                                            <?php
                                                $guestid = $_SESSION['id'];
                                                $sql = "SELECT `Booking_ID`, `payment`, `meal_type`, `checkin_date`, `checkout_date`, `address` FROM `booking` WHERE guest_ID=$guestid;";

                                                $result = $conn->query($sql);

                                                echo "<table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <th>#</th>
                                                <th>Booking_ID</th>
                                                <th>Price</th>
                                                <th>Meal_type</th>
                                                <th>Checkin_date</th>
                                                <th>Checkout_date</th>
                                                <th>Address</th>
                                                </tr>
                                                </thead>
                                                <tbody>";

                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr><td>" . $row["Booking_ID"] . "</td><td>" . $row["payment"] . "</td></td>" . $row["meal_type"] . "</td></td>" . $row["checkin_date"] . "</td></td>" . $row["checkout_date"] . "</td></td>" . $row["address"] . "</td></tr>";

                                                }
                                                echo "</tbody></table>";

                                            ?>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

</html>