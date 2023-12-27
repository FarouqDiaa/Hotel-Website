<?php include '../tools/connection.php';
include '../tools/navbar.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
     
     .feedback-box {
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
     }
     .feedback-img {
        margin-bottom: 20px; /* Adjust as needed */
     }
     .rating {
        margin-top: 10px;
     }
     .txtarea{
        height:100px;
     }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php

        if(isset($_POST['complainsubmit']) && isset($_SESSION['id']) ){  // make input called complain submit to insert complain when user click on it  
            // $guest_ID = $_SESSION['id'];
             $guest_ID = $_SESSION['id'];
             $description = $_POST["description"];
             $date = date("Y-m-d");
             

    $sql = " INSERT INTO `complain`(`description`, `date`,`guest_ID`) VALUES ('$description','$date',$guest_ID);";

            if($conn->query($sql) == true){
                echo "
                <div class='alert alert-success' role='alert'>
                    your complain has been submited we will try to solve it as soon as possible
                </div>
                ";
            } else {
                echo "ERROR: $sql <br> $conn->error";
            }
        }
    ?>

    <!-- update for complain page -->
    <div class="container1 text-center">
        <!-- Feedback box -->
        <div class="feedback-box">
            <img src="../images/ninja.png" alt="Feedback Image" class="feedback-img" height="100px">
            <h2>Sumbit Your Complain</h2>
            <form action="" method="post">
                
                <div class="form-group">
                    <label for="comment" class="p-2">Complain:</label>
                    <textarea class="form-control txtarea" name="description" placeholder="Leave your complain here" required></textarea>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" name="complainsubmit" value="Submit Complain">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
