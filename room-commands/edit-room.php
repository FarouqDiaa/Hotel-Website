<?php include '../includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <br><br>
    <?php
        $booking_id = $_GET["booking_id"]; // get booking id i want to change its details

        if(isset($_POST["book_submit"])&& isset($_GET["booking_id"])){ // make button to update booking 
            $room_id = $_GET['cid']; // if the user want to change the room TODO : make text box to take room id to change to from user
            $guestid = $_SESSION['id'];
            $payment_money=$_POST['payment']; //TODO :make textbox called payment take the amount of money from user
            $meal_type=$_POST['meal_type'];//TODO :make textbox called meal_type take the meal_type from user
            $checkout_date=$_POST['checkout_date'];//TODO :make textbox called checkout_date take the checkout_date from user
            $address=$_POST['address'];//TODO:make textbox called address take the address from user
                
            $sql = "UPDATE `booking` SET `payment`=$payment_money,`meal_type`='$meal_type',`checkout_date`='$checkout_date',`address`='$address',`guest_ID`='$guestid' WHERE Booking_ID=$booking_id";


            if($conn->query($sql) == true){
                echo "
                <div class='alert alert-success' role='alert'>
                    Your booking has been updated successfully!
                </div>
                ";
                //move_uploaded_file($c_img_tmp, $folder); donot know if you will need it @farouq
            }
            else{
                echo "ERROR: $sql <br> $conn->error";
            }
        }


        // $sql = "SELECT * FROM courses WHERE course_id = $course_id";

        // $result = $conn->query($sql);

        // $row = $result->fetch_assoc(); // donot know if you will need it @farouq
    ?>
    <div class="container mt-5">
    <h1>Edit Course</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Course Name:</label>
            <input type="text" class="form-control" id="name" name="course_name" value="<?php echo $row["course_name"] ?>" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="course_price" value="<?php echo $row["course_price"] ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="code">Course Code:</label>
                <input type="text" class="form-control" id="code" name="course_code" value="<?php echo $row["course_code"] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="instructor">Instructor:</label>
            <select class="form-control" id="instructor" name="course_instructor" required>
                <option value="" disabled>Select Instructor</option>
                <option value="1" <?php echo ($row["course_instructor"] == 1) ? "selected" : ""; ?>>Inst. 1</option>
                <option value="2" <?php echo ($row["course_instructor"] == 2) ? "selected" : ""; ?>>Inst. 2</option>
                <option value="3" <?php echo ($row["course_instructor"] == 3) ? "selected" : ""; ?>>Inst. 3</option>
                <option value="4" <?php echo ($row["course_instructor"] == 4) ? "selected" : ""; ?>>Inst. 4</option>
                <option value="5" <?php echo ($row["course_instructor"] == 5) ? "selected" : ""; ?>>Inst. 5</option>
                <option value="6" <?php echo ($row["course_instructor"] == 6) ? "selected" : ""; ?>>Inst. 6</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="course_desc" rows="4" required><?php echo $row["course_desc"]; ?></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="image">Course Image:</label>
            <input type="file" class="form-control-file" id="image" name="course_image" >
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="course_submit">Update Course</button>
    </form>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>