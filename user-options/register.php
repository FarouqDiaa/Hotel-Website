<?php include '../tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
     .container1 {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
     }
     .registration-box {
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
     }
     .form-group {
        width: 300px;
        text-align: left;
     }
     .form-group label {
        display: block;
        font-weight: bold;
     }
     a {
        color: white;
     }
     a:hover {
        color: white;
     }
     .dash {  
      background-color: #A00300;
        height: 30vh; 
        width: 100%;
        position: absolute;
        margin-top:35vh;
        z-index: -1;
     }
     .con {
        margin-left:4vw;
     }

    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php

        if(isset($_POST['username']) && isset($_POST['pass'])){    
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $passcon = $_POST['confirmpass'];
            $usertype = 0;
            if ($pass != $passcon){
              echo "
                <div class='alert alert-warning' role='alert'>
                    Password is not the same
                </div>
                ";
            }else{
      
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `guest` (`username`, `email` ,`password`, `usertype`) VALUES ('$username', '$email' , '$pass' , '$usertype')";
    
            if($conn->query($sql) == true){
                echo "
                <div class='alert alert-success' role='alert'>
                    Account successfully created welcome to our site!, Redirecting you to our login page
                </div>
                ";
                header("Location: login.php");
            }
            else{
                echo "ERROR: $sql <br> $conn->error";
            }}
        }
    ?>
  <div class="dash"></div>
    <div class="container1">
        <div class="registration-box">
            <img src="../images/ninja.png" height="200px" alt="Ninja Pic" class="mb-3">
            <form  action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter password" required>
                </div>

                <div class="form-group">
                    <label for="confirmPwd">Confirm Password:</label>
                    <input type="password" class="form-control" name="confirmpass" placeholder="Reenter password" required>
                </div>
                <br>
                <br>
                <div class="con">
                    <input type="Submit" class="btn btn-danger" value="Register" style="align-self:center;"><a href="project.php">Submit</a></input>
                </div>
                </form>
        </div>
    </div>
</body>
</html>
