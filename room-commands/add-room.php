<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    
<?php 
include '../tools/connection.php';
include '../tools/navbar.php';
if(isset($_POST["room_submit"])){
    $room_id = $_POST["room_ID"];
    $room_price = $_POST["price"];
    $numofbeds = $_POST["nbeds"];
    $capacity = $_POST["cap"];
    $desc = $_POST["desc"];
    $room_image = $_FILES["room_image"]["name"];
    $room_img_tmp = $_FILES["room_image"]["tmp_name"];
    $folder = "../images/".$room_image;
    $availability = 1;

    $sql = "INSERT INTO room (Room_ID, room_pic, room_desription, `num of beds`, PricePerNight, avalability, capacity) VALUES ($room_id,'$room_image', '$desc' ,$numofbeds , $room_price, $availability, $capacity);";

    if($conn->query($sql) == true){
        echo "
        <br><br><br>
        <div class='alert alert-success' role='alert'>
            Your course has been added successfully!
        </div>
        ";
        move_uploaded_file($room_img_tmp, $folder);
    }
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
}
?>
<br>
    <div class="container mt-5" >
        <h1>Add Room</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Room ID:</label>
                <input type="number" class="form-control" id="number" name="room_ID" required>
            </div>
            <div class="form-group">
                <label for="price">PricePerNight:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="nbeds">Number of beds:</label>
                <input type="number" class="form-control" id="nbeds" name="nbeds" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <select class="form-control" aria-label="Capacity" name="cap" required>
                    <option selected> Select type</option>
                    <option value="1"> Single</option>
                    <option value="2"> Double</option>
                    <option value="4"> Sweet</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="desc" rows="4" required></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="image">Room Image:</label>
                <input type="file" class="form-control-file" id="customfile" name="room_image" required>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" name="room_submit" value="Add Room">
        </form>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
