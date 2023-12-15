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
                    <div class="carousel-item active">
                        <img src="images/dd-sponsor.jpg" class="d-block w-100" alt="Sponsor 1" >
                    </div>
                    <div class="carousel-item">
                        <img src="images/spiro-sponsor.jpg" class="d-block w-100" alt="Sponsor 2">
                    </div>
                    <div class="carousel-item">
                        <img src="images/v7-sponsor.jpg" class="d-block w-100" alt="Sponsor 3">
                    </div>
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

        <br>
        <br>
        <br>
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
    <br><div class="row">
    <div class="col-md-6">
        <div style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white;">
            <h3>Event 1</h3>
            <p>Event desc</p>
            <button class="btn btn-danger">More Details</button>
        </div>
    </div>
    <div class="col-md-6">
        <div style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; background-color: rgba(0, 0, 0, 0.5); color: white;">
            <h3>Event 2</h3>
            <p>Event desc</p>
            <button class="btn btn-danger">More Details</button>
        </div>
    </div>
    </div>
    </div>
</div>


<div class="con2" style="background-color:#B00200">
    <h1 style="text-align: center; color: #FFF; padding: 20px;" id="Offers">Offers</h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; display:flex; background-color: rgba(0, 0, 0, 0.5); color: white;">
                <img src="" alt="Offer" style="max-width: 100%; height: 20vh;">&nbsp&nbsp&nbsp
                <div><h3>Offer 1</h3><p>Offer desc</p></div>
                </div>
            </div>
            <div class="col-md-6">
                <div style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; margin-bottom: 20px; display:flex; background-color: rgba(0, 0, 0, 0.5); color: white;">
                <img src="" alt="Offer" style="max-width: 100%; height: 20vh;">&nbsp&nbsp&nbsp
                <div><h3>Offer 2</h3><p>Offer desc</p></div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
<?php

/*
                            $sql = "SELECT * FROM";
                            $result = $conn->query($sql);
                            $courseCount = 0;
                            while($row = $result->fetch_assoc()){
                                if ($courseCount % 3 === 0) {
                                    echo '<div class="w-100"></div><br>'; 
                                }
                                echo "
                                    <div class='col-3'>
                                        <div class='card' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);'>
                                            <img src='coursesimg/". $row["course_image"] ."' class='card-img-top' alt='". $row["course_image"] ."' style='height:40vh;' />
                                            <div class='card-body'>
                                                <h5 class='card-title'>". $row["course_name"] ."</h5>
                                                <p class='card-text'>". $row["course_desc"] ."</p>
                                                <a href='courseoptions/coursedetails.php?cid=". $row["course_id"] ."' class='btn btn-primary'>View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                ";
                                $courseCount++;

                            }

            */
            ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
<?php include 'tools/footer.php'?>
</html>
