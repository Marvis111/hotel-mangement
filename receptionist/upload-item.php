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
    .form-control{
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
        <li class="active"><a href="upload-item.php"><i class="icon-key"></i>Book Rooms</a></li>
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
    <h1>Book room </h1>
    <div class="row">
        <div class="table-responsive">
    <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Admins</label> 
            <button type="button" class="btn button-o btn-outline-success">Add New</button>
        </div>
    <thead>
      <tr>
        <th>Surname</th>
        <th>Lastname</th>
        <th>Address</th>
        <th>Email</th>
        <th>Room name</th>  
        <th>Duration</td>
        <th>People</td>
        <th>Price</td>
        <th>Total</td>
      </tr>
    </thead>
    <tbody>
      <?php 
        include 'init.php';
        $sql = "SELECT *
        FROM reservations
        INNER JOIN rooms
        ON reservations.room_id = rooms.id;";
        $result = $conn->query($sql);
        $count = 0;
        $data_posted = '';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row['client_surname'] ."</td>
                    <td>". $row['client_lastname'] ."</td>
                    <td>". $row['client_address'] ."</td>
                    <td>". $row['client_email'] ."</td>
                    <td>". $row['room_name'] ."</td>
                    <td>". $row['duration'] ."</td>
                    <td>". $row['people'] ."</td>
                    <td>". $row['price'] ."</td>
                    <td>". intval($row['room_name']) * intval($row['duration']) ."</td>
                    <td> <a href='preview-data.php?delete=". $row['id'] ."' ><button type='button' class='btn btn-primary btn-sm'>Delete</button>  </a> </td>
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
    <div class="tab-pane container active" id="home">
    <div class="">
     <form method="POST" action="report.php" target='_blank'>
       <button type="submit" name="printforcustomer" class="btn btn-success">
         Print for Customer
       </button>
        <button type="submit" class="btn btn-primary" name="printforaccountant">
         Print for Accoutant
       </button>
     </form>
    </div>
  </div>
</section>
    
    </div>
<div id="add" class="modal" style="display: none;">
<div class="modal-dialog modal-md">
<div class="modal-content">
<form role="form" class="form-horizontal" method="post" action="preview-data.php" enctype="multipart/form-data">
<div class="modal-header">
<button type="button" class="close button-o" data-dismiss="modal" aria-hidden="true">x</button>
</div>
<div class="modal-body modal-lg">
        <input type="text" placeholder="Client SurName" class="form-control" name="client_surname" />
        <input type="text" placeholder="Client LastName" class="form-control" name="client_lastname" />
        <input type="text" placeholder="Client Address" class="form-control" name="client_address" />
        <input type="text" placeholder="Client Email" class="form-control" name="client_email" />
        <label>Rooms </label>
        <select placeholder="Client Name" class="form-control" name="room_id">
            <?php
                include 'init.php';
                $sql = "SELECT * FROM rooms where status='Available' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['id']."'>".$row['room_name']." </option>";
                    }
                } 
                else { echo ""; }
                $conn->close();
            ?>
        </select>
        
        <input type="text" placeholder="How many Nights" class="form-control" name="duration" />
        <input type="text" placeholder="No of People" class="form-control" name="people" />
        <button class="form-control bg-success text-white"> Submit </button>
    
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
      $('.button-o').on('click',function(){
          $('#add').slideToggle();
      })
    </script>
</body>
</html>

    
