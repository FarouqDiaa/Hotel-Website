<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    
<?php 
include '../includes/connection.php';
include '../includes/navbar.php';
/*
if(isset($_POST["room_submit"])){
    $course_name = $_POST["course_name"];
    $course_price = $_POST["course_price"];
    $course_code = $_POST["course_code"];
    $course_instructor = $_POST["course_instructor"];
    $course_desc = $_POST["course_desc"];
    $course_image = $_FILES["course_image"]["name"];
    $c_img_tmp = $_FILES["course_image"]["tmp_name"];
    $folder = "../coursesimg/".$course_image;

    $sql = "INSERT INTO courses (course_name, course_price, course_desc, course_image, course_code) VALUES ('$course_name', $course_price, '$course_desc', '$course_image', '$course_code')";

    if($conn->query($sql) == true){
        echo "
        <br><br><br>
        <div class='alert alert-success' role='alert'>
            Your course has been added successfully!
        </div>
        ";
        move_uploaded_file($c_img_tmp, $folder);
    }
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
}*/
?>
<br>
    <div class="container mt-5" >
        <h1>Add Room</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Course Name:</label>
                <input type="text" class="form-control" id="name" name="course_name" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="course_price" required>
            </div>
            <div class="form-group">
                <label for="code">Course Code:</label>
                <input type="text" class="form-control" id="code" name="course_code" required>
            </div>
            <div class="form-group">
                <label for="instructor">Instructor:</label>
                <select class="form-control" aria-label="Instructor" name="course_instructor" required>
                    <option selected> Select Instructor</option>
                    <option value="1"> Inst. 1</option>
                    <option value="2"> Inst. 2</option>
                    <option value="3"> Inst. 3</option>
                    <option value="4"> Inst. 4</option>
                    <option value="5"> Inst. 5</option>
                    <option value="6"> Inst. 6</option>
                </select>

            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="course_desc" rows="4" required></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="image">Course Image:</label>
                <input type="file" class="form-control-file" id="customfile" name="course_image" required>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" name="course_submit" value="Add Course">
        </form>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
