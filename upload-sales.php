<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="assets/fonts/icomoon/style.css">
    <link rel="stylesheet" type="text/css" href="assets/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="assets/style.css">
    <title> ACT Dashboard</title>
</head>
<style>
    .calendar_weekdays div, .calendar_content div{
        padding: 8px 0px !important;
    }
    
</style>


<body>
    <div class="row" style="margin: 0;"> 
        <div class="nav-section">
    <a class="navbar-brand mr-4" href="/"  style="display: flex;justify-content: center;margin: 10px 15px;">
        <img src="#" width="auto" height="50px"/>
    </a>
    <br>
    <ul>
        <li><a href="index.php"><i class="icon-dashboard"></i>Dashboard</a></li>
        <li class="active"><a href="upload-sales.php"><i class="icon-key"></i>Upload Sales</a></li>
        <li><a href="#"><i class="icon-users"></i>Manage Admins</a></li>
        <li><a href="#"><i class="icon-users"></i>Manage Members</a></li>
        <li><a href="#"><i class="icon-money"></i>Create Bills</a></li>
        <li><a href="#"><i class="icon-book"></i>Payments</a></li>
        <li><a href="#"><i class="icon-bell"></i>Notifications</a></li>
        <li><a href="#"><i class="icon-power-off"></i>Logout</a></li>
    </ul>
</div>
<section class="main-section">
    <div class="intro-div">
        <b>Dashboard</b>
        <span id="time" class="time"></span>
    </div>
    <br>
    



</section>
        
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
      $(document).ready(function () {
'use strict';
$("#datatable-buttons").length && $("#datatable-buttons").DataTable({
    dom: "Bfrtip",
    buttons: [
    {
        extend: "csv",
        text:'Export to CSV',
        className: "btn-sm"
    }, {
        extend: "excel",
        className: "btn-sm"
    },],
    language: {
        paginate: {
          next: '<i class="fa fa-arrow-right">', // or '???'
          previous: '<i class="fa fa-arrow-left">' // or '???' 
        }
    },
    "drawCallback": function( settings ) {
        $(".edit").click(function(){
            // Instantiate new modal
        });
    }
});
});

    </script>
</body>
</html>

    
