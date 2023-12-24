<?php include '../tools/connection.php'; ?>

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


        // INSERT INTO `feedback`(`feedback_ID`, `guest_ID`, `feedbackDate`, `rating`, `comments`, `manager_ID`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')


        if(isset($_POST['feedbacksubmit']) ){  // make input called submit to insert feedback when user click on it  
             $guest_ID = $_SESSION['id'];
             $rating = $_POST["feedbackrating"];
             $comments = $_POST["feedbackcomment"];
             $feedbackDate=date("Y-m-d");
             

    $sql = "INSERT INTO `feedback`(`guest_ID`, `feedbackDate`, `rating`, `comments`, `manager_ID`) VALUES ( $guest_ID, '$feedbackDate', $rating, '$comments', 1)";

            if($conn->query($sql) == true){
                echo "
                <div class='alert alert-success' role='alert'>
                    Thank you for your feedback!
                </div>
                ";
            } else {
                echo "ERROR: $sql <br> $conn->error";
            }
        }
    ?>


    <div class="container1 text-center">
        <!-- Feedback box -->
        <div class="feedback-box">
            <img src="../images/ninja.png" alt="Feedback Image" class="feedback-img" height="100px">
            <h2>Leave Your Feedback</h2>
            <form action="" method="post">
                <div class="form-group rating">
                    <label for="rating" class="p-2">Rating:</label>
                    <select class="form-control" name="feedbackrating" required>
                        <option value="5">5 stars</option>
                        <option value="4">4 stars</option>
                        <option value="3">3 stars</option>
                        <option value="2">2 stars</option>
                        <option value="1">1 star</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment" class="p-2">Comment:</label>
                    <textarea class="form-control txtarea" name="feedbackcomment" placeholder="Leave your comment here" required></textarea>
                </div>
                <div class="con">
                    <input type="submit" class="btn btn-danger p-2 m-4" name="feedbacksubmit" value="Submit Feedback">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
