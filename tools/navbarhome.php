<style>
.navbar {
  position: fixed;
  display: flex;
  width: 100%;
  height: 10vh;
  z-index: 1000;
  align-items: center;
  justify-content: space-between;
  padding: 20px;
  background-color: #222;
  box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.25);
  color: white;
  text-transform: uppercase;
  overflow: hidden;
}
.logoWrapper {
    display: flex;
}
.ninja {
      font-weight: bold;
}

.hotel {
      padding-left: 4px;
      color: #ea4f4c;
}

.navigation {
    display: flex;
    list-style-type: none;
}

.li {
      opacity: 1;
      list-style-type: none;
      color: white;
      text-decoration: none;
      transition: all 0.3s ease-in-out;
}

    .parent {
      padding: 0 10px;
      cursor: pointer;

      .link {
        position: relative;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        color: white;

        &:hover {
          color: #ea4f4c;
        }

        .fa-minus {
          opacity: 0;
          transition: all 0.3s ease-in-out;
          position: absolute;
          left: -16px;
          top: 3px;
        }

        .fa-plus {
          opacity: 1;
          transition: all 0.3s ease-in-out;
        }

        .fas {
          color: #ea4f4c;
          margin: -2px 4px 0;
          font-size: 10px;
          transition: all 0.3s ease-in-out;
        }
      }
    }

    .subnavigation {
      display: none;
      list-style-type: none;
      width: 500px;
      position: absolute;
      top: 40%;
      left: 25%;
      margin: auto;
      transition: all 0.3s ease-in-out;
      background-color: #222;

      li a {
        font-size: 17px;
        padding: 0 5px;
      }
    }

.active.parent {
  transform: translate(-40px, -25px);
  .link {
    font-size: 12px;

    .fa-minus {
      opacity: 1 !important;
      font-size: 8px;
    }

    .fa-plus {
      opacity: 0 !important;
    }
  }

  .subnavigation {
    display: flex;
  }
}

.active#clients {
  .subnavigation {
    transform: translate(-150px, 17px);
  }
}

.active#services {
  .subnavigation {
    transform: translate(-290px, 17px);
  }
}

.invisible {
  opacity: 0 !important;
  transform: translate(50px, 0);
}

</style>
<?php
if (session_id() == ''){session_start();}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["usertype"]) && $_SESSION["usertype"] ==0){
    echo"

    <nav class='navbar navbar-expand-lg navbar-dark'>
    <div class='container'>
        <div class='navbar-brand'>
            <img src='images/ninja.png' height='60vh' alt='Ninja Pic'>
        </div>
        <div class='logoWrapper'>
        <span class='ninja'>Ninja</span>
        <span class='hotel'>Hotel</span>
        </div>
        
        <div class='collapse navbar-collapse justify-content-end' id='navbarNav'>
        <ul class='navigation'>
        <li class='parent'><a class='link' href='index.php'>Home</a></li>
        <li class='parent' id='clients'>
          <a class='link' href='#'><i class='fas fa-minus'></i> Rooms <i class='fas fa-plus'></i></a>
          <ul class='subnavigation'>
            <li><a class='link' href='index.php#Singlerooms'>Single Rooms</a></li>
            <li><a class='link' href='index.php#Doublerooms'>Double Rooms</a></li>
            <li><a class='link' href='index.php#Sweets'>Sweets</a></li>
          </ul>
        </li>
        <li class='parent' id='services'>
          <a class='link' href='#'><i class='fas fa-minus'></i> Services <i class='fas fa-plus'></i></a>
          <ul class='subnavigation'>
            <li><a class='link' href='user-options/makecomplain.php'>Complaints</a></li>
            <li><a class='link' href='user-options/requestroomservice.php'>Requested Service</a></li>
          </ul>
        </li>
      <li class='parent'>
      <a class='link' href='user-options/guest-profile.php?guest_ID=". $_SESSION["id"]."'>
              <img src='../images/user.png' height='30vh' alt='user'>
      </a></li>
                    <li class='parent'>
                        <a class='link' href='user-options/logout.php'>Log Out</a>
                    </li>
        </ul>
                
        </div>
    </div>
</nav>";
}elseif (isset($_SESSION["usertype"]) && $_SESSION["usertype"] ==1)
{
    echo"
    <nav class='navbar navbar-expand-lg navbar-dark'>
    <div class='container'>
        <div class='navbar-brand'>
            <img src='images/ninja.png' height='60vh' alt='Ninja Pic'>
        </div>
        <div class='logoWrapper'>
        <span class='ninja'>Ninja</span>
        <span class='hotel'>Hotel</span>
        </div>
        
        <div class='collapse navbar-collapse justify-content-end' id='navbarNav'>
        <ul class='navigation'>
        <li class='parent'><a class='link' href='index.php'>Home</a></li>
        <li class='parent'><a class='link' href='handle-req.php'>Handle Requests</a></li>
      <li class='parent'>
      <a class='link' href='user-options/staff-profile.php?ID=". $_SESSION["id"]."'>
              <img src='images/user.png' height='40vh' alt='user'>
      </a></li>
      <li class='parent'>
      <a class='link' href='user-options/logout.php'>Log Out</a>
      </li>
    </ul>
    </div>
    </div>
</nav>";
}elseif (isset($_SESSION["usertype"]) && $_SESSION["usertype"] ==2)
{
  echo"

  <nav class='navbar navbar-expand-lg navbar-dark'>
  <div class='container'>
      <div class='navbar-brand'>
          <img src='images/ninja.png' height='60vh' alt='Ninja Pic'>
      </div>
      <div class='logoWrapper'>
      <span class='ninja'>Ninja</span>
      <span class='hotel'>Hotel</span>
      </div>
      
      <div class='collapse navbar-collapse justify-content-end' id='navbarNav'>
      <ul class='navigation'>
      <li class='parent'><a class='link' href='index.php'>Home</a></li>
      <li class='parent'><a class='link' href='receptionists/room-availability.php'>Rooms</a></li>
      <li class='parent'><a class='link' href='receptionists/bookings.php'>Bookings</a></li>
      <li class='parent'><a class='link' href='receptionists/complains.php'>Handle Complains</a></li>
      <li class='parent'><a class='link' href='receptionists/manageroomservicerequest.php'>Requests</a></li>
      <li class='parent'>
    <a class='link' href='user-options/staff-profile.php?ID=". $_SESSION["id"]."'>
            <img src='images/user.png' height='30vh' alt='user'>
    </a></li>
                  <li class='parent'>
                      <a class='link' href='user-options/logout.php'>Log Out</a>
                  </li>
      </ul>
              
      </div>
  </div>
</nav>";
}elseif (isset($_SESSION["usertype"]) && $_SESSION["usertype"] ==3)
{
  echo"

  <nav class='navbar navbar-expand-lg navbar-dark'>
  <div class='container'>
      <div class='navbar-brand'>
          <img src='images/ninja.png' height='60vh' alt='Ninja Pic'>
      </div>
      <div class='logoWrapper'>
      <span class='ninja'>Ninja</span>
      <span class='hotel'>Hotel</span>
      </div>
      
      <div class='collapse navbar-collapse justify-content-end' id='navbarNav'>
      <ul class='navigation'>
      <li class='parent'><a class='link' href='index.php'>Home</a></li>
      <li class='parent'><a class='link' href='manager/mangescheduleevents.php'>Events</a></li>
      <li class='parent'><a class='link' href='manager/setbonus.php'>Bonus</a></li>
      <li class='parent'><a class='link' href='manager/setsalary.php'>Salary</a></li>
      <li class='parent'><a class='link' href='manager/track-sponsorship.php'>Sponsors</a></li>
      <li class='parent'>
    <a class='link' href='user-options/staff-profile.php?ID=". $_SESSION["id"]."'>
            <img src='images/user.png' height='30vh' alt='user'>
    </a></li>
                  <li class='parent'>
                      <a class='link' href='user-options/logout.php'>Log Out</a>
                  </li>
      </ul>
              
      </div>
  </div>
</nav>";
}else{
    echo"<nav class='navbar navbar-expand-lg navbar-dark'>
    <div class='container'>
        <div class='navbar-brand'>
            <img src='images/ninja.png' height='60vh' alt='Ninja Pic'>
        </div>
        <div class='logoWrapper'>
        <span class='ninja'>Ninja</span>
        <span class='hotel'>Hotel</span>
        </div>
        
        <div class='collapse navbar-collapse justify-content-end' id='navbarNav'>
        <ul class='navigation'>
        <li class='parent'><a class='link' href='index.php'>Home</a></li>
        <li class='parent' id='clients'>
          <a class='link' href='#'><i class='fas fa-minus'></i> Rooms <i class='fas fa-plus'></i></a>
          <ul class='subnavigation'>
            <li><a class='link' href='index.php#Singlerooms'>Single Rooms</a></li>
            <li><a class='link' href='index.php#Doublerooms'>Double Rooms</a></li>
            <li><a class='link' href='index.php#Sweets'>Sweets</a></li>
          </ul>
        </li> 
        <li class='parent'><a class='link' href='about-us.php'>About Us</a></li>
        <li class='parent'><a class='link' href='user-options/login.php'>Log In</a></li>
      </ul>
        </div>
    </div>
</nav>";
}
?>
  <script src="js/jquery.js"></script>

<script>
var clients = document.getElementById('clients');
var services = document.getElementById('services');

clients.addEventListener('click', function() {
  $(clients).toggleClass("active");
  $(".parent:not(#clients)").toggleClass("invisible");
}, false);

services.addEventListener('click', function() {
  $(services).toggleClass("active");
  $(".parent:not(#services)").toggleClass("invisible");
}, false);
</script>