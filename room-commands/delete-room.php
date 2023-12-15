<?php
    include '../includes/connection.php';

    $course_id = $_GET["cid"];
    
    $delete_users_courses_sql = "DELETE FROM users_courses WHERE cid = $course_id";
    
    if ($conn->query($delete_users_courses_sql) === TRUE) {
        $delete_courses_sql = "DELETE FROM courses WHERE course_id = $course_id";
        
        if ($conn->query($delete_courses_sql) === TRUE) {
            echo "
            <div class='alert alert-success' role='alert'>
                Your course has been deleted successfully!
            </div>
            ";
            header("Location: ../dashboard.php");
        } else {
            echo "ERROR: $delete_courses_sql <br> $conn->error";
        }
    } else {
        echo "ERROR: $delete_users_courses_sql <br> $conn->error";
    }
?>
