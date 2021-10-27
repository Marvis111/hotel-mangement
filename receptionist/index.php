<!DOCTYPE html>
<html>
<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="../assets/fonts/icomoon/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../assets/style.css">
    <title> ACT Dashboard</title>
</head>
<style>
    .calendar_weekdays div, .calendar_content div{
        padding: 8px 0px !important;
    }
    .jumbotron{
        padding:2rem 1rem;
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
        <li><a href="upload-item.php"><i class="icon-key"></i>Book Rooms</a></li>
        <li><a href="manage-item.php"><i class="icon-users"></i>Manage Members</a></li>
        <li><a href="#"><i class="icon-book"></i>Payments</a></li>
        <li><a href="#"><i class="icon-bell"></i>Notifications</a></li>
        <li><a href="#"><i class="icon-power-off"></i>Logout</a></li>
    </ul>
</div>
<section class="main-section" style="width:calc(100% - 260px)">
    <div class="intro-div">
        <b>Dashboard</b>
        <span id="time" class="time"></span>
    </div>
    <br>
    <?php
        include '../init.php';
        $sql = "SELECT * FROM rooms";
        if ($result=mysqli_query($conn,$sql)) {
            $rowcount=mysqli_num_rows($result);
        }
        $sql1 = "SELECT * FROM rooms where status='Available'";
        if ($result=mysqli_query($conn,$sql1)) {
            $rowcount1=mysqli_num_rows($result);
        }
        $sql2 = "SELECT * FROM rooms where status='Booked'";
        if ($result=mysqli_query($conn,$sql2)) {
            $rowcount2=mysqli_num_rows($result);
        }
    ?>
    <div class="row container" style="justify-content:center;">
    <div class="col-md-3 jumbotron"> 
        <h1><?php echo $rowcount; ?></h1>
        <span> All Rooms </span>
    </div>
    <div class="col-md-1"> </div>
    <div class="col-md-3 jumbotron"> 
        <h1><?php echo $rowcount2; ?></h1>
        <span> Booked Rooms </span>
    </div>
    <div class="col-md-1"> </div>
    <div class="col-md-3 jumbotron"> 
        <h1><?php echo $rowcount1; ?></h1>
        <span> Avaliable Rooms </span>
    </div>
    </div>

    <!-- View Rooms -->
    <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Avaliable Rooms</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Booked Rooms</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">All Rooms</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">
  <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Rooms</label> 
        </div>
    <thead>
      <tr>
        <th>Room Name</th>
        <th>Room Floor</th>
        <td>Room Capacity</td>
        <th>Room Facility </th>
        <th>Price</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include 'init.php';
        $sql = "SELECT * FROM rooms where status='Available' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row['room_name'] ."</td>
                    <td>". $row['room_floor'] ."</td>
                    <td>". $row['room_capacity'] ." persons</td>
                    <td>". $row['room_facility'] ."</td>
                    <td>". $row['price'] ."</td>
                    <th><span class='label-success label'> ". $row['status'] ." </span></th>
                </tr>";
            }
        } 
        else {
            echo "";
        }
        $conn->close();
        ?>
    </tbody>
  </table>

  </div>
  <div class="tab-pane container fade" id="menu1">
  <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Rooms</label> 
        </div>
    <thead>
      <tr>
        <th>Room Name</th>
        <th>Room Floor</th>
        <td>Room Capacity</td>
        <th>Room Facility </th>
        <th>Price</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include 'init.php';
        $sql = "SELECT * FROM rooms where status='Booked' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row['room_name'] ."</td>
                    <td>". $row['room_floor'] ."</td>
                    <td>". $row['room_capacity'] ." persons</td>
                    <td>". $row['room_facility'] ."</td>
                    <td>". $row['price'] ."</td>
                    <th><span class='label-success label'> ". $row['status'] ." </span></th>
                </tr>";
            }
        } 
        else {
            echo "";
        }
        $conn->close();
        ?>
    </tbody>
  </table>
  </div>
  <div class="tab-pane container fade" id="menu2">
  <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Rooms</label> 
        </div>
    <thead>
      <tr>
        <th>Room Name</th>
        <th>Room Floor</th>
        <td>Room Capacity</td>
        <th>Room Facility </th>
        <th>Price</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include 'init.php';
        $sql = "SELECT * FROM rooms";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row['room_name'] ."</td>
                    <td>". $row['room_floor'] ."</td>
                    <td>". $row['room_capacity'] ." persons</td>
                    <td>". $row['room_facility'] ."</td>
                    <td>". $row['price'] ."</td>
                    <th><span class='label-success label'> ". $row['status'] ." </span></th>
                    
                </tr>";
            }
        } 
        else {
            echo "";
        }
        $conn->close();
        ?>
    </tbody>
  </table>
  </div>
</div>
</section>
    
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
      $(document).ready(function(){

      });
    </script>
</body>
</html>

    
