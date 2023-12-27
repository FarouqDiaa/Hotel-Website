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
        width: 40%;
     }
     body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}
     .registration-box {
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        width: 100%;
     }
     .form-group {
    width: 100%;
    text-align: left;
    margin-bottom: 15px;
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
            $passport_ID = $_POST['passport_ID'];
            $nationality = $_POST['nationality'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $FName = $_POST['FName'];
            $LName = $_POST['LName'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $card_number= $_POST['card_number'];
            $usertype = 0;
            $sqlreg = "SELECT * FROM `account` WHERE username = '$username'";
            $check = $conn->query($sqlreg);
            if (!$check) {
                die("Error: " . $conn->error);
            }
            
            if ($pass != $passcon){
              echo "
                <div class='alert alert-warning' role='alert'>
                    Password is not the same
                </div>
                ";
            }else  if ($check->num_rows > 0) {
                echo "<div class='alert alert-danger' role='alert'>Username Exists</div>";
            } else{
      
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `guest`(`passport_ID`, `nationality`, `phone`, `email`, `address`, `FName`, `LName`, `gender`, `age`, `card_number`) VALUES ('$passport_ID','$nationality','$phone','$email','$address','$FName','$LName','$gender','$age','$card_number')";
    
            if($conn->query($sql) == true){
                $sql2 = "INSERT INTO `account`(`username`, `password`, `type`) VALUES ('$username','$pass','$usertype')";
                $conn->query($sql2);
                $sql4 = "INSERT INTO `has_account`(`username`, `guest_ID`) VALUES ('$username',(SELECT max(guest_ID) FROM guest))";
                $conn->query($sql4);
                echo "
                <div class='alert alert-success' role='alert'>
                    Account successfully created welcome to our hotel!, Redirecting you to our login page
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
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label for="Fname">First Name:</label>
                    <input type="text" class="form-control" name="FName" placeholder="First Name" required>
                </div>
                <div class="col-md-6">
                    <label for="Lname">Last Name:</label>
                    <input type="text" class="form-control" name="LName" placeholder="Last Name" required>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter password" required>
                </div>
            
                <div class="col-md-6">
                    <label for="confirmPwd">Confirm Password:</label>
                    <input type="password" class="form-control" name="confirmpass" placeholder="Reenter password" required>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label for="passport">Passport ID:</label>
                    <input type="text" class="form-control" name="passport_ID" placeholder="Enter ID" required>
                </div>
                <div class="col-md-6">
                    <label for="nationality">Nationality:</label>
                    <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality" required>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label for="nationality">Phone Number (+2):</label>
                    <input type="number" class="form-control" name="phone" placeholder="Enter Phone Number (Egyptian)" required>
                </div>
                <div class="col-md-6">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" name="age" placeholder="Age" required>
                </div>
                <div class="col-md-6">
                    <label for="cardnumber">Card Number:</label>
                    <input type="number" class="form-control" name="card_number" placeholder="Card Number" required>
                </div>
                </div>
                <div class="form-group">
                    <label for="Gender">Gender:</label>
                    <select class="form-control" name="gender" required>
                        <option selected>Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="con">
                    <input type="Submit" class="btn btn-danger" value="Register" style="align-self:center;"><a href="index.php">Submit</a></input>
                </div>
                </form>
        </div>
    </div>
</body>
</html>
