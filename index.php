<?php include 'tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ninja Egyptian Hotel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/style.css"/>

</head>
<style>
  .maincontainer{
    border-width: 0 5px 5px 5px;
    border-style: none solid solid solid;
    border-color: transparent #B00200 transparent #B00200;
    padding: 20px;
    margin: 10px 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    border-radius: 10px;
  }
  #sponsorsCarousel img {
            height: 300px;
            object-fit: cover;
        }
  </style>
<body style="background-color: rgb(5,5,5); ">
<?php include 'tools/navbarhome.php'; ?>
<br>
<div class="maincontainer" style="background-color:rgba(15,15,15,0.6)">
        <h1 style="text-align: center; color: #FFF; padding: 20px;" id="sponsors">Sponsors</h1>

        <div class="container mt-5">
    <div id="sponsorsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $sql = "SELECT * FROM `sponser`";
            $result = $conn->query($sql);

            $firstItem = true;

            while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='carousel-item " . ($firstItem ? 'active' : '') . "'>
                        <img src='images/" . $row['pic'] . "' class='d-block w-100' alt='Sponsor'>
                    </div>
                ";

                $firstItem = false;
            }
            ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#sponsorsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#sponsorsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
    </div>
    
    <div style="text-align: center; background-color: #B00200; padding: 10px;">
        <a href="#events" style="color: white; margin-right: 20px;">Events</a>
        <a href="#offers" style="color: white; margin-right: 20px;">Offers</a>
        <a href="#Singlerooms" style="color: white; margin-right: 20px;">Single Rooms</a>
        <a href="#Doublerooms" style="color: white; margin-right: 20px;">Double Rooms</a>
        <a href="#Sweets" style="color: white; margin-right: 20px;">Sweets</a>
    </div>
    <h1 style="text-align: center; color: #FFF; padding: 20px;" id="events">Events</h1>
    <div class="con2" style="background-color: #900200">
    <br>
    <div class="row">
    <?php
                            $sql = "SELECT * FROM `event`";
                            $result = $conn->query($sql);
                            $eventCount = 0;
                            while($row = $result->fetch_assoc()){
                                if ($eventCount % 3 === 0) {
                                    echo '<br>'; 
                                }
                                echo "
                                <div class='col-md-6'>
                                    <div class='card mx-auto' style='box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white; width:60vh;'>
                                        <div class='card-body text-center'>
                                            <h3 class='card-title' style='color: white;'>". $row["event_name"] ."</h3>
                                            <h3 class='card-title' style='color: white;'>". $row["eventDate"] ."</h3>
                                            <p class='card-text'>". $row["description"] ."</p>
                                        </div>
                                    </div>
                                </div>
                            ";
                            
                            
                                $eventCount++;

                            }

            
            ?>
    
    </div>
    </div>
    <h1 style="text-align: center; color: #FFF; padding: 20px;" id="Offers">Offers</h1>
    <div class="con2" style="background-color:#B00200">
    <br>
    <div class="container mt-5">
        <div class="row">
        <?php
                            $sql = "SELECT * FROM `offer`";
                            $result = $conn->query($sql);
                            $eventCount = 0;
                            while($row = $result->fetch_assoc()){
                                if ($eventCount % 3 === 0) {
                                    echo '<br>'; 
                                }
                                echo "
                                <div class='col-md-6'>
                                    <div class='card mx-auto' style='box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white; width:60vh;'>
                                        <div class='card-body text-center'>
                                            <h3 class='card-title' style='color: white;'>". $row["offer_name"] ."</h3>
                                            <h3 class='card-title' style='color: white;'>". $row["discount_percentage"] ."%</h3>
                                            <h5 class='card-title' style='color: white;'> Start Date: ". $row["start_date"] ."</h5>
                                            <h5 class='card-title' style='color: white;'> Start Date: ". $row["start_date"] ."</h5>
                                            <p class='card-text'>". $row["desription"] ."</p>
                                        </div>
                                    </div>
                                </div>
                            ";
                            
                            
                                $eventCount++;

                            }

            
            ?>
    </div>
    </div>
</div>
<h1 style="text-align: center; color: #FFF; padding: 20px;" id="Singlerooms">Single Rooms</h1>
<div class="con2" style="background-color:#B00200">
    <br>
    <div class="row">
    <?php
                            $sql = "SELECT * FROM room WHERE capacity = 1";
                            $result = $conn->query($sql);
                            $roomCount = 0;
                            while($row = $result->fetch_assoc()){
                                if ($roomCount % 3 === 0) {
                                    echo '<br>'; 
                                }
                                echo "
                                <div class='col-md-6'>
                                    <div class='card mx-auto' style='box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white; height:60vh; width:60vh;'>
                                        <img src='images/". $row["room_pic"] ."' class='card-img-top mx-auto d-block' alt='Image not available' style='height:40vh; width:40vh;' />
                                        <div class='card-body text-center'>
                                            <h3 class='card-title' style='color: white;''>". $row["Room_ID"] ."</h3>
                                            <p class='card-text'>". $row["room_desription"] ."</p>
                                            <a href='room-commands/room-details.php?rid=". $row["Room_ID"] ."' class='btn btn-danger'>View Details</a>
                                        </div>
                                    </div>
                                </div>
                            ";
                            
                            
                                $roomCount++;

                            }

            
            ?>
    
    </div>
    </div>
    <h1 style="text-align: center; color: #FFF; padding: 20px;" id="Doublerooms">Double Rooms</h1>
<div class="con2" style="background-color:#B00200">
    <br>
    <div class="row">
    <?php
                            $sql = "SELECT * FROM room WHERE capacity = 2";
                            $result = $conn->query($sql);
                            $roomCount = 0;
                            while($row = $result->fetch_assoc()){
                                if ($roomCount % 3 === 0) {
                                    echo '<br>'; 
                                }
                                echo "
                                <div class='col-md-6'>
                                    <div class='card mx-auto' style='box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white; height:60vh; width:60vh;'>
                                        <img src='images/". $row["room_pic"] ."' class='card-img-top mx-auto d-block' alt='Image not available' style='height:40vh; width:40vh;' />
                                        <div class='card-body text-center'>
                                            <h3 class='card-title' style='color: white;''>". $row["Room_ID"] ."</h3>
                                            <p class='card-text'>". $row["room_desription"] ."</p>
                                            <a href='room-commands/room-details.php?rid=". $row["Room_ID"] ."' class='btn btn-danger'>View Details</a>
                                        </div>
                                    </div>
                                </div>
                            ";
                            
                            
                                $roomCount++;

                            }

            
            ?>
    
    </div>
    </div>
    <h1 style="text-align: center; color: #FFF; padding: 20px;" id="Sweets">Sweets</h1>
<div class="con2" style="background-color:#B00200">
    <br>
    <div class="row">
    <?php
                            $sql = "SELECT * FROM room WHERE capacity > 2";
                            $result = $conn->query($sql);
                            $roomCount = 0;
                            while($row = $result->fetch_assoc()){
                                if ($roomCount % 3 === 0) {
                                    echo '<br>'; 
                                }
                                echo "
                                <div class='col-md-6'>
                                    <div class='card mx-auto' style='box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white; height:60vh; width:60vh;'>
                                        <img src='images/". $row["room_pic"] ."' class='card-img-top mx-auto d-block' alt='Image not available' style='height:40vh; width:40vh;' />
                                        <div class='card-body text-center'>
                                            <h3 class='card-title' style='color: white;''>". $row["Room_ID"] ."</h3>
                                            <p class='card-text'>". $row["room_desription"] ."</p>
                                            <a href='room-commands/room-details.php?rid=". $row["Room_ID"] ."' class='btn btn-danger'>View Details</a>
                                        </div>
                                    </div>
                                </div>
                            ";
                            
                            
                                $roomCount++;

                            }

            
            ?>
    
    </div>
    </div>
</div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
<?php include 'tools/footer.php'?>
</html>
