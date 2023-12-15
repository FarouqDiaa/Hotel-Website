<?php include '../tools/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title><link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../icons/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
<style>
      h2{
        color: black;
        text-shadow: 0.5px 0.5px 0.5px black;
      }
      
      h3{
        color: Black;
        text-shadow: 0.5px 0.5px 0.5px black;
      }
      h4{
        color: black;
        text-shadow: 0.3px 0.3px 0.3px rgb(58, 58, 245);
        text-decoration: underline;
      }
      .container1{
        width: 100vw;
        display: flex;
        flex-direction: row;
      }
      .categories{
        align-self:center ;
      }
      .container4{
        background-color: rgb(235, 235, 248);
        border-radius: 5px;
      }
      tr{
        background-color: rgb(235, 235, 248);
      }
      table{
        border-radius: 10px;
      }
      tbody{
        border-radius: 3px;
      }
</style>
</head>
<body>
<?php include '../tools/navbar.php'; ?>
<br><br><br>
    <h2>Rooms</h2>

    <div class="container4">
        <h3>Currently Rented</h3>
        <p>You are renting the following rooms:</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Room ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = $_SESSION["id"];
                /*$sql = "SELECT * FROM users_courses
                INNER JOIN courses ON users_courses.cid = courses.course_id
                INNER JOIN users ON users_courses.uid = users.id
                WHERE uid = $id";
                $result = $conn->query($sql);
                $n = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $n . "</td><td>" . $row["course_name"] . "</td></tr>";
                    $n++;
                }*/
                ?>
            </tbody>
        </table>
    </div>

    <div class="container4">
        <h3>Available Rooms</h3>
        <p>You can rent the following rooms: </p>
        <?php
        /*$sql = "SELECT * FROM courses";
        $result = $conn->query($sql);
        echo "<table class='table table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Course Name</th>
                </tr>
              </thead>
              <tbody>";
        $n = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $n . "</td><td>" . $row["course_name"] . "</td></tr>";
            $n++;
        }
        echo "</tbody></table>";*/
        ?>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>