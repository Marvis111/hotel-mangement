<?php
include 'init.php';
session_start();
if (isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
  $sql = "SELECT * FROM registable where id ='$user_id'  ";
  $query = mysqli_query($conn,$sql);
  if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
      $_SESSION['user_id'] = $row["id"];
          $_SESSION['username'] = $row["name"];
          $_SESSION['email'] = $row["email"];
          $_SESSION['department'] = $row["department"];
         
    }
       header('Location:dashboard.php');
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Login-Page</title>
	<meta content=" Web Developer with a focus on Front-end and Mobile application." name="description">
  	<meta content="Okeke , Okeke Johnpaul , john's Biography , Johnpaul's Portfolio" name="keywords">
  	<!--icons link-->
  	<link rel="stylesheet" href="assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="preload" href="/fonts/OpenSans-Regular.ttf" as='font' crossorigin='anonymous'>
    <link rel="preload" href="/fonts/OpenSans-SemiBold.ttf" as='font' crossorigin='anonymous'>
    <link rel="preload" href="/fonts/OpenSans-Bold.ttf" as='font' crossorigin='anonymous'>
    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body>
<style>
@media all and (max-width:775px){
  main{
    height:100%;
  }
  .login-box{
    padding: 14px;
  }
}
@media all and (max-width:500px){
  main{
    margin:0px;
    padding: 3% 3%;
  }
}

</style>
	<main>
  <?php 
  include 'receptionist/init.php';
  $name = $email = $username = $password = '';
  $nameErr = $passwordErr = $errormessage = '';
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $username = $passwd = ''; 
  if (isset($_POST['uname']) && isset($_POST['pswd'])) {
    $usname = test_input($_POST['uname']);
    $passwd = test_input($_POST['pswd']);
    $sqle = "SELECT * FROM admin WHERE username = '$usname' AND password = '$passwd' ";
    $resulte = $conn->query($sqle);
      if ($resulte->num_rows > 0) {
      // output data of each row
        while($row = $resulte->fetch_assoc()) {
          if (isset( $_POST['remember'])) {
            setcookie('user_id',$row['id'],time() + 86400 * 30,'/');
          }
          $_SESSION['user_id'] = $row["id"];
          $_SESSION['username'] = $row["username"];
          $_SESSION['category'] = $row["category"];
          if ($row['category'] == 'Accountant'){
                header('Location:accountant/index.php');
          }
          elseif($row['category']=='Receptionist')
               header('Location:receptionist/index.php');
        }
    } 
    else{
      $errormessage = '<div class="alert alert-danger alert-dismissible fade show" style="font-size: 14px !important;padding: .5rem 1.0rem !important;">
      <button type="button" class="close" data-dismiss="alert" style="padding: .5rem 0.4rem !important;">&times;</button>
      Invalid Username or Password</div>';
    }
  }
  $conn->close();
?>
        <div class="back"><a href="index.php"><i class="icon-arrow-left"> </i> <span class="back-key"> Back to Home Screen </span> </a> </div>
        <section class="login_container"> 
            <div class="first-phase">
                <h2> LOG IN </h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    llendus a, provident repellat totam ex reiciendis 
                    impedit maxime optio tempora, dolores nemo, dolor molestiae ipsa 
                    beatae veritatis quam! Laboriosam, repudiandae 
                    obcaecati. </p>
                <img src="assets/images/cuate.png" title=""> 
            </div>
            <div class="second-phase">
                <div class="login-box">
                    <h3>MEMBER LOGIN</h3>
                    <br>
                    <?php echo $errormessage ?>
                    <form action="login.php" method="POST" class="needs-validation" novalidate>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="icon-envelope-o"></i></span>
                            </div>
                            <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="icon-lock_outline" style="font-size: 113%;"></i></span>
                            </div>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                        </div>
                        <div class="form-group form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember"> Remember Me
                          </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                      <br>
                      <br>
                      <label style="text-align: center;">Not a member? <a href="register.php">Create Account</a></label>
                </div>
            </div>
        </section>
	</main>
</body>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	});

	// Preloader
    $(window).on('load', function() {
        if ($('#preloader').length) {
            $('#preloader').delay(100).fadeOut('slow', function() {
                $(this).remove();
            });
        }
        $(".header-container").css("transform" , "scale(1.0)");
    });
 
	
</script>
<script>
    (function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</html>
