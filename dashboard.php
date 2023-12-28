<?php
include 'tools/connection.php';
if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == 1) {
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <?php include 'tools/navbarhome.php'; ?>
    <br>

    <div class="container mt-5">
        <h1>Welcome to the Rooms Dashboard</h1>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Rooms</h2>
                <div class="list-group">
                    <?php
                    $sql = "SELECT * FROM room";
                    $result = $conn->query($sql);
                    echo "<div class='container'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='row mb-3 border p-3'>
                            <div class='col'>
                                <strong>Room ID:</strong> " . $row["Room_ID"] . "<br>
                                <strong>Room Description:</strong> " . $row["description"] . "<br>
                                <strong>Price Per Night:</strong> " . $row["PricePerNight"] . " $
                            </div>
                            <div class='col'>
                                <a class='btn btn-danger' href='room-commands/edit-room.php?Room_ID=" . $row["Room_ID"] . "'><i class='fas fa-edit'>Edit</i></a>
                                <a class='btn btn-outline-danger' href='room-commands/delete-room.php?Room_ID=" . $row["Room_ID"] . "'><i class='fas fa-trash-alt'>Delete</i></a>
                            </div>
                        </div>
                        ";
                    }
                    echo "</div>";
                    ?>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add a New Room</h5>
                        <p class="card-text">Click the button below to add a new room.</p>
                        <a href="room-commands/add-room.php" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i> Add Room
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
