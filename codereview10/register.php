<?php

 ob_start();

 session_start(); // start a new session or continues the previous

 if( isset($_SESSION['user'])!="" ){

  header("Location: home.php"); // redirects to home.php

 }

 include_once 'dbconnect.php';


 $error = false;


 if ( isset($_POST['btn-signup']) ) {

 

  // sanitize user input to prevent sql injection

  $name = trim($_POST['first_name']);

  $name = strip_tags($name);

  $name = htmlspecialchars($name);

  $last_name = trim($_POST['last_name']);
  $last_name = strip_tags($last_name);
  $last_name = htmlspecialchars($last_name);

 

  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

 

  $password = trim($_POST['password']);

  $password = strip_tags($password);

  $password = htmlspecialchars($password);

 

  // basic name validation

  if (empty($name)) {

   $error = true;

   $nameError = "Please enter your full name.";

  } else if (strlen($name) < 3) {

   $error = true;

   $nameError = "Name must have atleat 3 characters.";

  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {

   $error = true;

   $nameError = "Name must contain alphabets and space.";

  }

 

  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Please enter valid email address.";

  } else {

   // check whether the email exist or not

   $query = "SELECT email FROM user WHERE email='$email'";

   $result = mysqli_query($conn, $query);

   $count = mysqli_num_rows($result);

   if($count!=0){

    $error = true;

    $emailError = "Provided Email is already in use.";

   }

  }


  // password validation

  if (empty($password)){

   $error = true;

   $passError = "Please enter password.";

  } else if(strlen($password) < 6) {

   $error = true;

   $passError = "Password must have atleast 6 characters.";

  }

 

  // password encrypt using SHA256();

  $password =  hash('sha256', $password);

 

  // if there's no error, continue to signup

  if( !$error ) {

   

   $query = "INSERT INTO `user` first_name,last_name,email,password VALUES('$name','$last_name','$email','$password')";

   $res = mysqli_query($conn, $query);

   

   if ($res) {

    $errTyp = "success";

    $errMSG = "Successfully registered, you may login now";

    unset($name);
    unset($last_name);

    unset($email);

    unset($password);

   } else {

    $errTyp = "danger";

    $errMSG = "Something went wrong, try again later...";

   }
 

  }


 }

?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="UTF-8">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">     
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


        <style type="text/css">



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
    
    .header-book .hero  a {
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
      margin: 0px 10px 0px 0px;
      }.btn:hover{
      background-color: white;
      color: #A99D5B;
      border-color: black;
      }

    #img {
      margin: 0 auto;
      }
      
    .chang{
      color: #FFFFFF;
      }.chang:hover{
      color: #FFFFFF;
      text-decoration: none;
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
</div>

  <section>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    <h2>Sign Up</h2>
    <hr />

    <?php
      if ( isset($errMSG) ) {
    ?>
            
      <div class="alert">

    <?php echo $errMSG; ?>
      </div>

    <?php 
    }
    ?>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="first_name">First name</label>
        <input type="text" class="form-control" id="validationCustom01" placeholder="First Name" name="first_name" value="<?php echo $name ?>" required />

        <span class="text-danger"><?php echo $nameError; ?></span>

    </div>
      <div class="form-group col-md-6">
        <label for="last_name">Last name</label>
        <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name" name="last_name" value="<?php echo $last_name ?>" />
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="emailAddress">Email</label>
          <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required value="<?php echo $email ?>" />
          <span class="text-danger"><?php echo $emailError; ?></span>
        </div>

        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password"  maxlength="15" required />
          <span class="text-danger"><?php echo $passError; ?></span>
        </div>
    </div> 

    <button type="submit" class="btn btn-primary" style="padding-left: 30%; text-align: center; padding-right: 30%;" name="btn-signup">Register</button>
    <button class="btn btn-primary"><a href="index.php" class="chang">Login</button>
    
  </form>
  </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php ob_end_flush(); ?>


