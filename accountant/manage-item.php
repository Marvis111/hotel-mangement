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
    
</style>
<body>
    <div class="row" style="margin: 0;"> 
        <div class="nav-section">
    <a class="navbar-brand mr-4" href="/"  style="display: flex;justify-content: center;margin: 10px 15px;">
        <img src="{{ url_for('static', filename='logo.png') }}" width="auto" height="50px"/>
    </a>
    <br>
    <ul>
        <li ><a href="index.php"><i class="icon-dashboard"></i>Dashboard</a></li>
        <li><a href="upload-item.php"><i class="icon-key"></i>Upload Items</a></li>
        <li class="active"><a href="manage-item.php"><i class="icon-users"></i>Manage Members</a></li>
        <li><a href="payment.php"><i class="icon-book"></i>Payments</a></li>
        <li><a href="expenses.php"><i class="icon-bell"></i>Expenses</a></li>
        <li><a href="#"><i class="icon-power-off"></i>Logout</a></li>
    </ul>
</div>
<section class="main-section" style="width:calc(100% - 260px)">
    <div class="intro-div">
        <b>Dashboard</b>
        <span id="time" class="time"></span>
    </div>
    <br>
    
        <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#receptionist">Receptionist</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#office">Front Office</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#cocktail">Cocktail</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#bar">Bar</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#resturant">Resturant</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="receptionist">
  <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Rooms</label> 
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
        include '../init.php';
        $sql = "SELECT * FROM admin WHERE category='Receptionist' ";
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
                   <a class='dropdown-item' href='backend-data/create-admin-add.php?delete=".$row['id']."&type=Receptionist'>Delete</a>
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
    </tbody>
  </table>
 </div>
  <div class="tab-pane container fade" id="office">
        <table class="table table-striped">
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
        include '../receptionist/init.php';
        $sql = "SELECT * FROM admin WHERE category='Front Office' ";
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
                   <a class='dropdown-item' href='backend-data/create-admin-add.php?delete=".$row['id']."&type=Receptionist'>Delete</a>
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
    </tbody>
  </table>
  </div>
  <div class="tab-pane container fade" id="cocktail">
  <?php 
        include '../receptionist/init.php';
        $sql = "SELECT * FROM admin WHERE category='Cocktail' ";
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
                   <a class='dropdown-item' href='backend-data/create-admin-add.php?delete=".$row['id']."&type=Receptionist'>Delete</a>
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
  </div>
  <div class="tab-pane container fade" id="bar">
  <?php 
        include '../receptionist/init.php';
        $sql = "SELECT * FROM admin WHERE category='Bar' ";
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
                   <a class='dropdown-item' href='backend-data/create-admin-add.php?delete=".$row['id']."&type=Receptionist'>Delete</a>
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
  </div>
  <div class="tab-pane container fade" id="resturant">
  <?php 
        include '../receptionist/init.php';
        $sql = "SELECT * FROM admin WHERE category='Resturant' ";
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
                   <a class='dropdown-item' href='backend-data/create-admin-add.php?delete=".$row['id']."&type=Receptionist'>Delete</a>
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

    
