<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Library</title>
    <style>
    body {
      color: #FFFFFF;
      background-color: #eaecef;
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
    
    .header-book .hero a {
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
              
    form {
      background-color: #FFFFFF;
      color: #1F251C;
      width: 50%;
      padding: 15px;
      margin: 0 auto;
      margin-top: 40px;
      margin-bottom: 20px;
      border: 2px solid black;
      border-radius: 10px;
      }
    
    .btn {
      background-color: #A99D5B;
      border-color: black;
      color: white;
      margin: 0px 10px 0px 0px;
      }.btn:hover{
      background-color: white;
      color: #A99D5B;
      border-color: black;
      }

      .btn a {
        color: white;
      }.btn a:hover {
        text-decoration: none;
        color: #A99D5B;
      }

    #img {
      margin: 0 auto;
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





<?php

   ob_start();

   session_start();

   require_once 'dbconnect.php';

   // it will never let you open index(login) page if session is set

   if ( isset($_SESSION['user'])!="" ) {

    header("Location: home.php");

    exit;

   }

   $error = false;

 

 if( isset($_POST['btn-login']) ) {

 // prevent sql injections/ clear user invalid inputs

  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

 

  $pass = trim($_POST['password']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);

  // prevent sql injections / clear user invalid inputs

  if(empty($email)){

   $error = true;

   $emailError = "Please enter your email address.";

  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Please enter valid email address.";

  }

  if(empty($pass)){

   $error = true;

   $passError = "Please enter your password.";

  }

  // if there's no error, continue to login

  if (!$error) {

   $password = hash('sha256', $pass); // password hashing using SHA256

   $res=mysqli_query($conn, "SELECT user_id, first_Name, password FROM `user` WHERE email='$email'");

      $row=mysqli_fetch_array($res, MYSQLI_ASSOC);

   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

   

   
    if( $count == 1 && $row['password']==$password ) {

      $_SESSION['user'] = $row['user_id'];

      header("Location: home.php");

     } else {

      $errMSG = "Incorrect Credentials, Try again...";

     }

   }
 }

?>

<!DOCTYPE html>

<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <meta charset="UTF-8">
  
<title>Biglibrary</title>

</head>

<body>
  <div class="header-book">
    <nav class="navbar navbar-default">
      <div class="container">
      </div>

    </nav>
    <div class="hero">
      <h2><a href="home.php">WELCOME TO MY WORLD</a></h2>
    </div>

    <div class="container text-center">
      <h1 class="jumborton-heading">Sign in<i class="fas fa-sign-in-alt"></i></h1>
      <form method="post" action="
      <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

             <hr />
              <?php

              if ( isset($errMSG) ) {
                  echo $errMSG; 
            }
            ?>

             <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $user_email; ?>" maxlength="40" />
        <span class="text-danger"><?php echo $emailError; ?></span>
        <input type="password" name="password" class="form-control" placeholder="Your Password" maxlength="15" />
        <span class="text-danger"><?php echo $passError; ?></span>
        <hr />
        <button type="submit" name="btn-login" class="btn">Sign In</button>
                    <hr />
        <button class="btn"><a href="register.php">Sign Up Here</a></button>
      </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

























