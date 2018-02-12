<?php

	ob_start();

	session_start();

	require_once 'dbconnect.php';

	// if session is not set this will redirect to login page

	if( !isset($_SESSION['user']) ) {

		header("Location: index.php");

		exit;

	}

	// select logged-in users detail

	$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);

 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>

<html>

<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  	
  	<title>BigLibrary</title>
  	<style type="text/css">
      body {
        font-family: 'Open Sans', sans-serif;
      }

      .header-book {
        color: white;
        background: url("background.jpg") no-repeat;
        background-size: cover;
        background-position: bottom;
        background-size: cover;
        padding-bottom: 100px;
    }
    
    .header-book .navbar-nav > li > a {
        color: white;
        font-size: 18px;
        border-radius: 10px;
    }
    
    .header-book .navbar {
        margin-bottom: 0px;
        padding-top: 20px;
        padding-bottom: 20px;
        width: 100%;
        border-bottom: none;
        background-color: transparent;
        min-width: 300px;
        border: none;
    }
    
    .header-book .navbar-default .navbar-nav > .open > a,
    .header-book .navbar-default .navbar-nav > .open > a:focus,
    .header-book .navbar-default .navbar-nav > .open > a:hover {
        color: #ccc;
        background-color: transparent;
    }
    
    .header-book .nav > li > a:focus,
    .header-book .nav > li > a:hover {
        color: #ccc;
        background-color: transparent;
    }
    
    .header-book .navbar-nav > li {
        margin-right: 20px;
    }
    
    .header-book .navbar-nav {
        margin-top: 12px;
    }
    
    .header-book .navbar-toggle {
        background-color: transparent !important;
        margin-top: 20px;
        border: 1px solid #fff;
    }
    
    
    
    .header-book .navbar-brand {
        color: white;
        font-size: 20px;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    
    .header-book .navbar-brand:hover {
        color: #ccc;
        text-transform: lowercase;
    }

    .header-book ul li {
      list-style-type: none;
    }
    
    .header-book .hero {
        text-align: center;
        margin-top: 80px;
        margin-bottom: 50px;
    }
    
    .header-book .hero h2 {
        color: white;
        font-weight: bold;
        font-size: 60px;
        margin-bottom: 36px;
        letter-spacing: 10px;
    }

    .header-book .hero h2 a {
        color: white;
        font-weight: bold;
        font-size: 60px;
        margin-bottom: 36px;
        letter-spacing: 10px;
    }.header-book .hero a:hover {
      text-decoration: none;
      text-transform: lowercase;
    }
    
    
    .header-book .hero p {
        color: white;
        font-size: 22px;
        max-width: 660px;
        margin: 0 auto;
        line-height: 1.5;
    }


      .main {
        background-image: url(paper.jpg);
        background-size: contain;
      }
      .card {
        height: 600px;
        margin: 35px 20px 20px 20px;
        text-align: center;
      }

      .card:hover {
        -ms-transform: scale(1.1, 1.1);
        /* IE 9 */
        -webkit-transform: scale(1.1, 1.1);
        /* Safari */
        transform: scale(1.1, 1.1);
        /* Standard syntax */
      }

      .card .card-text {
        max-height: 100px;
      }

      .nav-tabs {
        width: 40%;
        margin: 0 auto;
      }

      #myTab {
        padding: 5px;
        border: none;
      }

      .nav-tabs .nav-link {
        margin-left: 25px;
        text-align: center;
        color: #1E3247;
        font-size: 23px;
      }

      .nav-tabs .nav-link:hover {
        border: none;
        text-transform: lowercase;
      }

      center {
        width: 100%;
      }

      span {
        line-height: 1.2;
      }

      @media screen and (max-width: 767px) {
      

        .hero {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .hero h2 {
            font-size: 42px;
        }
        }

    </style>
	
</head>

<body>

	<div class="header-book">
		<nav class="navbar navbar-default">
		<div class="container">

		</div>
	</nav>
	<div class="hero">
		<h2><a href="home.php">WELCOME TO MY WORLD</a></h2>

		<ul>
			<li><p><?php echo $userRow['email'];
			?></p></li>
			<li><a class="navbar-brand" href="logout.php?logout">Sign Out</a></li>
		</ul>
	</div>

	</div>




			
			
		<div class="cntainer">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" date-toggle="tab" href="#all" role="tab" aria-controls="ALL">ALL</a>
				</li>
				<li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#book" role="tab" aria-controls="profile" aria-selected="false ">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#dvd" role="tab" aria-controls="contact" aria-selected="false">Dvds</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cd" role="tab" aria-controls="contact" aria-selected="false">Cds</a>
        </li>
      </ul>
  </div>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">

    	<?php

    	$sql1 ="SELECT * FROM media ";
    	$result1 = $conn->query($sql1);

    	if ($result1->num_row > 0) {
    		echo '
    		<main role="main" class="main">
    		<div class="album py-5">
    		<div class="container">
    		<div class="row">
    		 ';

    		 while($row1 = $result1 ->fetch_assoc()) {
	echo '
	<div class="col-md-4">
	<div class="card">
	<img class="card-img-top" src='.$row1["image"].' alt="Card image cap">
                        <div class="card-body ">
                          <h5 class="card-title">'.$row1["title"].'</h5>
                          <p class="card-text ">'.$row1["description"].'</p>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">'.$row1["ISBN"].'</li>
                        </ul>
                    </div>
                  </div>
                  ';
}
echo " </div>
            </div>
        </div>
      </main>"; } else { echo "0 results"; }
              ?>

        </div>
        <div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="profile-tab">
		
		<?php 

          $sql2 = "SELECT * FROM media WHERE type='book'";
          $result2 = $conn->query($sql2);

          if ($result2->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 ">
                  <div class="container">
                    <div class="row">
                    ';
                     while($row2 = $result2->fetch_assoc()) {
                echo '
             
                    <div class="col-md-4">
                       <div class="card">
                        <img class="card-img-top" src='.$row2["image"].' alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">'.$row2["title"].'</h5>
                          <p class="card-text">'.$row2["description"].'</p>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">'.$row2["ISBN"].'</li>
                        </ul>
                      </div>
                    </div>
                      ';
              }
                 echo "
                     </div>
                    </div>
                  </div>
                </main>";
           } else {
              echo "0 results";
 
    	}

    	  ?>

    	  </div>
    <div class="tab-pane fade" id="cd" role="tabpanel" aria-labelledby="contact-tab">

    	 <?php

          $sql3 = "SELECT * FROM media WHERE type='cd'";
          $result3 = $conn->query($sql3);

          if ($result3->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 ">
                  <div class="container">
                  <div class="row">
                    ';
                     while($row3 = $result3->fetch_assoc()) {
                echo '
             
                    <div class="col-md-4">
                      <div class="card">
                        <img class="card-img-top" src='.$row3["image"].' alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">'.$row3["title"].'</h5>
                            <p class="card-text">'.$row3["description"].'</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">'.$row3["ISBN"].'</li>
                        </ul>
                      </div>
                    </div>
                      ';
              }
                 echo "
                     </div>
                    </div>
                  </div>
                </main>";
           } else {
              echo "0 results";
          }

          ?>
          </div>
    <div class="tab-pane fade" id="dvd" role="tabpanel" aria-labelledby="contact-tab">
      <?php

          $sql4 = "SELECT * FROM media WHERE type='dvd'";
          $result4 = $conn->query($sql4);

          if ($result4->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 ">
                  <div class="container">
              <div class="row">
                    ';

              while($row4 = $result4->fetch_assoc()) {
                echo '
             
                 <div class="col-md-4">
                       <div class="card">
                          <img class="card-img-top" src='.$row4["image"].' alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">'.$row4["title"].'</h5>
                              <p class="card-text">'.$row4["description"].'</p>
                           </div>
                           <ul class="list-group list-group-flush">
                             <li class="list-group-item">'.$row4["ISBN"].'</li>
                          </ul>
                        </div>
                    </div>
                      ';
              }
                 echo "
                     </div>
                    </div>
                  </div>
                </main>";
           } else {
              echo "0 results";
          }

          ?>



          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
          crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
          crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin="anonymous"></script>
  </body>

  </html>

  <?php ob_end_flush(); ?>

























