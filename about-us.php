<?php include 'tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Ninja Hotel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <style>
        .con2 {
            position: relative;
            z-index: 1;
            border-width: 0 5px 5px 5px;
            border-style: none solid solid solid;
            border-color: transparent #0000 #0000 #0000;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            background: rgba(100, 0, 0, 0.6);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .logo {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body style="background-color: rgb(0, 0, 0); ">
    <?php include 'tools/navbarhome.php'; ?>
<br>
    <div class="con2">
        <div class="logo-container">
            <img src="images/ninja.png" alt="Ninja" class="logo">
        </div>
        <h1 style="text-align: center; color: #FFF;">About Us</h1>
        <div class="container mt-5">
            <div class="row">
                    <p>BIO</p>
            </div>
        </div>
        <br><br><br><br>

    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
