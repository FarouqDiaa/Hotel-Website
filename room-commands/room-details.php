<?php
    include '../includes/connection.php';  
    include '../includes/navbar.php';

    $id = $_GET['cid'];
    $sql = "SELECT * FROM room WHERE Room_ID=$id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    
        if ($status === 'success') {
            echo "<br><br><div class='alert alert-success' role='alert'>Successfully Enrolled!</div>";
        } elseif ($status === 'error') {
            $message = urldecode($_GET['message']);
            echo "<br><br><div class='alert alert-warning' role='alert'>Error enrolling in the course: $message</div>";
        } elseif ($status === 'already_enrolled') {
            echo "<br><br><div class='alert alert-warning' role='alert'>You are already enrolled in this course.</div>";
        } elseif ($status === 'invalid_cid') {
            echo "<br><br><div class='alert alert-warning' role='alert'>Invalid course ID.</div>";
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../coursesimg/<?php echo $row['course_image']; ?>" alt="<?php echo $row['course_image']; ?>" style="max-width: 100%;">
            </div>
            <div class="col-md-6">
                <h1><?php echo $row['course_name']; ?></h1>
                <p><strong>Instructor:</strong> Instructor Name</p>
                <p><strong>Description:</strong></p>
                <p><?php echo $row['course_desc']; ?></p>
                <p><strong>Price:</strong> <?php echo $row['course_price']; ?></p>
                <p><strong>Course Code:</strong> <?php echo $row['course_code']; ?></p>
                <a href="enroll.php?cid=<?php echo $row['course_id']; ?>" class="btn btn-primary">Enroll Now</a>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
