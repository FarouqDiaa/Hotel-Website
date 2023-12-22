<?php include '../tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Complaints</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
     .complaint-box {
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
     }
     .complaint-img {
        margin-bottom: 20px; /* Adjust as needed */
     }
     .complaint-text {
        margin-top: 10px;
     }
     .handled {
        color: #28a745; /* Green color for handled complaints */
     }
     .unhandled {
        color: #dc3545; /* Red color for unhandled complaints */
     }
     .response-textarea {
        margin-top: 10px;
        width: 100%;
        height: 100px;
     }
    </style>
</head>

<body style="background-color: rgb(5,5,5);">
    <?php
        if(isset($_POST['handleComplaint']) && isset($_POST['complaintId'])){
            $complaintId = $_POST['complaintId'];

            
            if(isset($_POST['response'])){
                $response = $_POST['response'];

                
                $updateSql = "UPDATE `complain` SET `response` = '$response' WHERE `complain_ID` = $complaintId";
                if($conn->query($updateSql) == true){
                    echo "
                    <div class='alert alert-success' role='alert'>
                        Complaint marked as handled with response!
                    </div>
                    ";
                } else {
                    echo "ERROR: $updateSql <br> $conn->error";
                }
            } else {
                echo "
                <div class='alert alert-danger' role='alert'>
                    Please enter a response before marking as handled.
                </div>
                ";
            }
        }
    ?>

    <div class="container1 text-center">
       
        <div class="complaint-box">
            <img src="../images/ninja.png" alt="Complaint Image" class="complaint-img" height="100px">
            <h2>All Complaints</h2>
            
            <?php
                
                $complaintsQuery = "SELECT * FROM `complain`";
                $result = $conn->query($complaintsQuery);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $complaintId = $row['complain_ID'];
                        $complaintText = $row['description'];
                        $response = $row['response'];

                        
                        $class = $response ? 'handled' : 'unhandled';

                        echo "
                        <div class='complaint-text $class'>
                            <p>{$complaintText}</p>";

                        if(!$response) {
                            
                            echo "
                            <form action='' method='post'>
                                <input type='hidden' name='complaintId' value='{$complaintId}'>
                                <textarea class='form-control response-textarea' name='response' placeholder='Enter your response'></textarea>
                                <button type='submit' class='btn btn-success mt-2' name='handleComplaint'>Mark as Handled with Response</button>
                            </form>";
                        }

                        echo "
                        </div>
                        ";
                    }
                } else {
                    echo "<p>No complaints found.</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>
