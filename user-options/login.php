<?php include '../tools/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
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
        position: relative;
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
    </style>
</head>
<body style="background-color: rgb(5,5,5);">
<?php
         if(isset($_POST['username']) && isset($_POST['pass'])){
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            
            $sql = "SELECT * FROM `account` WHERE `username` = '$username'";
            
            $result = $conn->query($sql);

            if($result->num_rows >= 1){
                $row = $result->fetch_assoc();
                if($pass=== $row['password']){
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    if($row['type'] == 0){
                        $sql2 = "SELECT * FROM `has_account` WHERE `username` = '$username'";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        $_SESSION['id'] = $row2['guest_ID'] ;
                        $_SESSION['usertype'] = 0;

                    }elseif($row['type'] == 3){
                        $sql3 = "SELECT * FROM `manager` WHERE `username` = '$username'";
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_assoc();
                        $_SESSION['id'] = $row3['manager_ID'] ;
                        $_SESSION['usertype'] = 3;
                    }else{
                        $sql4 = "SELECT * FROM `staff` WHERE `username` = '$username'";
                        $result4 = $conn->query($sql4);
                        $row4 = $result4->fetch_assoc();
                        $_SESSION['id'] = $row4['staff_ID'] ;
                        $_SESSION['usertype'] = $row['type'];
                    }
                    if ($_SESSION['usertype'] == 0){
                    header("Location: guest-profile.php?id=". $_SESSION['id'] ."");
                }
                else{
                    header("Location: ../index.php?id=". $_SESSION['id'] ."");
                };
                }
                else{

                    echo "
                    <div class='alert alert-warning' role='alert'>
                        Wrong Password
                    </div>
                    ";
                }
            }
            else{
                echo "
                <div class='alert alert-warning' role='alert'>
                    User doesn't exist
                </div>
                ";
            }
        }
    ?>
<div class="dash"></div>
    <div class="container1">
        <div class="registration-box">
            <img src="../images/ninja.png" height="200px" alt="Ninja Pic" class="mb-3">
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="username" class="form-control" name="username" placeholder="Enter Username" style="background-color: white;">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter Password" style="background-color: white;">
                </div>
                <br>
                <br>
                <div class="con">
                    <input style="width:7vw;font-family: Arial, sans-serif;" type="submit" class="btn btn-danger" value="Log In">&nbsp
                    <a style="width:7vw;font-family: Arial, sans-serif;" class="btn btn-danger" href="register.php">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
