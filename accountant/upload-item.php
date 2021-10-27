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
    input{
      margin-bottom:10px;
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
        <li class="active"><a href="upload-item.php"><i class="icon-key"></i>Upload Items</a></li>
        <li ><a href="manage-item.php"><i class="icon-users"></i>Manage Members</a></li>
        <li><a href="#"><i class="icon-book"></i>Payments</a></li>
        <li><a href="expenses.php"><i class="icon-bell"></i>Expenses</a></li>
        <li><a href="#"><i class="icon-power-off"></i>Logout</a></li>
    </ul>
</div>
<section class="main-section" style="width:calc(100% - 320px)">
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
            <button type="button" class="btn button-o btn-outline-success">Add New</button>
        </div>
    <thead>
      <tr>
        <th>Room Name</th>
        <th>Room Floor</th>
        <td>Room Capacity</td>
        <th>Room Facility </th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include '../init.php';
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
                    <th><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    action
                 </button>
                 <div class='dropdown-menu'>
                   <a class='dropdown-item' href='#' onclick=edit(".$row['id'] .")>Edit</a>
                   <a class='dropdown-item' href='delete-admin.php?delete=".$row['id']."'>Delete</a>
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
  <div id="add" class="modal" style="display: none;">
<div class="modal-dialog modal-md">
<div class="modal-content">
<form role="form" class="form-horizontal" method="post" action="delete-admin.php" enctype="multipart/form-data">
<div class="modal-header">
<button type="button" class="close button-o" data-dismiss="modal" aria-hidden="true">x</button>
</div>
<div class="modal-body modal-lg">
            <input type="text" class="form-control" placeholder="Room Name" name="room_name" />
            <input type="file" class="form-control" placeholder="Room Image" name="room_image" />
            <input type="text" class="form-control" placeholder="Room Floor" name="room_floor" />
            <input type="text" class="form-control" placeholder="Room Type" name="room_type" />
            <input type="text" class="form-control" placeholder="Bed Type" name="bed_type" />
            <input type="text" class="form-control" placeholder="Room Facility" name="room_facility" />
            <input type="text" class="form-control" placeholder="Price" name="price" />
            <input type="text" class="form-control" placeholder="Room Capacity" name="room_capacity" />
            <select class="form-control" name="status" placeholder="">
              <option value="Avaliable">Avaliable</option>
              <option value="Occupied">Occupied</option>
            </select>
            <input type="datetime-local" name="booking_date" class="form-control" />
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary btn-sm button-checkout">Submit</button>
<button type="button" class="btn button-o btn-danger btn-sm button-continue-shopping" data-dismiss="modal">Close</button>

</div>
</form>
</div>
</div>
</div>
  </div>
  <div class="tab-pane container fade" id="office">...</div>
  <div class="tab-pane container fade" id="cocktail">...</div>
  <div class="tab-pane container fade" id="bar">...</div>
  <div class="tab-pane container fade" id="resturant">...</div>
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

    
