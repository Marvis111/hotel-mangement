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
        <img src="{{ url_for('static', filename='logo.png') }}" width="auto" height="50px"/>
    </a>
    <br>
    <ul>
        <li class="active"><a href="index.php"><i class="icon-dashboard"></i>Dashboard</a></li>
        <li><a href="upload-sales.php"><i class="icon-key"></i>Upload Sales</a></li>
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
    <h1> <?php echo $_GET['type']; ?></h1>
    <hr>
    <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Admins</label> 
            <button type="button" class="btn button-o btn-outline-success">Add New</button>
        </div>
    <thead>
      <tr>
        <th>Username</th>
        <th>fullname</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include 'init.php';
        $type = $_GET['type'];
        $sql = "SELECT * FROM admin WHERE category='$type' ";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row['username'] ."</td>
                    <td>". $row['fullname'] ."</td>
                    <th><span class='label-success label'> ". $row['status'] ." </span></th>
                    <th><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    action
                 </button>
                 <div class='dropdown-menu'>
                   <a class='dropdown-item' href='#' onclick=edit(".$row['id'] .")>Edit</a>
                   <a class='dropdown-item' href='backend-data/create-admin-add.php?delete=".$row['id']."&type=".$type."'>Delete</a>
                 </div>
                    </th>
                </tr>";
            }
        } 
        else {
            echo "";
        }
        $conn->close();
        ?>
      <?php
        if(isset($_GET['error'])){
            echo $_GET['error'];
        }
        else if (isset($_GET['msg'])){
            echo $_GET['msg'];
        }
      ?>
    </tbody>
  </table>
</section>
    
    </div>
<div id="add" class="modal" style="display: none;">
<div class="modal-dialog modal-md">
<div class="modal-content">
<form role="form" class="form-horizontal" method="post" action="backend-data/create-admin-add.php" enctype="multipart/form-data">
<div class="modal-header">
<button type="button" class="close button-o" data-dismiss="modal" aria-hidden="true">x</button>
</div>
<div class="modal-body modal-lg">
            <div class="form-group clearfix">
                <label class="col-md-3 control-label">Username </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" required name="username" placeholder="Enter Username">
                </div>
            </div>

            <div class="form-group clearfix">
                <label class="col-md-3 control-label">Password </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" required name="password" placeholder="Enter Password">
                </div>
            </div>

            <div class="form-group clearfix">
                <label class="col-md-3 control-label">Full Name </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" required name="fullname" placeholder="Enter Full Name">
                </div>
            </div>
            <input type="hidden" name="category" value="<?php echo $_GET['type'] ?>">
            
            <div class="form-group clearfix">
                <label class="col-md-3 control-label">Status</label>
                <div class="col-md-9">
                    <select class="form-control" name="status" placeholder="">
                    <option value="Enable">Enable</option>
                    <option value="Disable">Disable</option>
                    </select>
                </div>
            </div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary btn-sm button-checkout">Submit</button>
<button type="button" class="btn button-o btn-danger btn-sm button-continue-shopping" data-dismiss="modal">Close</button>

</div>
</form>
</div>
</div>
</div>

<div id="edit" class="modal" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="ajaxdiv">
        
</div>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
      $(document).ready(function(){

      });
      $('.button-o').on('click', function(){
        $("#add").slideToggle();
      });
      function edit(id) {
    $.ajax({
        type: 'POST',
        url:'backend-data/admin-update.php',
        data:'id='+id,
        success:function(msg){
            $("#ajaxdiv").html(msg);
            $('#edit').slideToggle();
        }
    });
}
    </script>
</body>
</html>

    
