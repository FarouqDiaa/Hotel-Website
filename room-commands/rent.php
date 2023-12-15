<?php
include '../includes/connection.php';

if (!isset($_SESSION["id"])) {
    header("Location: ../useroptions/login.php");
    exit();
}

if (isset($_GET['cid'])) {
    $course_id = $_GET['cid'];
    $userid = $_SESSION['id'];
    $checkEnrollmentQuery = "SELECT * FROM users_courses WHERE uid = $userid AND cid = $course_id";
    $checkResult = $conn->query($checkEnrollmentQuery);

    if ($checkResult->num_rows == 0) {
        $insertQuery = "INSERT INTO users_courses (uid, cid) VALUES ($userid, $course_id)";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: coursedetails.php?status=success&cid=$course_id");
            exit();

        } else {
            header("Location: coursedetails.php?status=error&message=" . urlencode($conn->error));
            exit();
        }
    } else {
        header("Location: coursedetails.php?status=already_enrolled&cid=$course_id");
        exit();
    }} else {
        header("Location: coursedetails.php?status=invalid_cid");
exit();
}

$conn->close();
?>
