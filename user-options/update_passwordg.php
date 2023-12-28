<?php
include '../tools/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['newPassword'];
    $id = $_SESSION['id'];
    $updateSql = "UPDATE `account` SET `password` = $newPassword WHERE `username` IN (SELECT `username` FROM `has_account` WHERE guest_ID = $id);";
    if ($conn->query($updateSql) === TRUE) {
        echo "Password updated successfully!";
        $_SESSION['password']=$newPassword;   

    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}
?>