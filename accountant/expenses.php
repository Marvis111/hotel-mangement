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
        <li><a href="upload-item.php"><i class="icon-key"></i>Upload Items</a></li>
        <li ><a href="manage-item.php"><i class="icon-users"></i>Manage Members</a></li>
        <li><a href="payment.php"><i class="icon-book"></i>Payments</a></li>
        <li class="active" ><a href="expenses.php"><i class="icon-bell"></i>Expenses</a></li>
        <li><a href="#"><i class="icon-power-off"></i>Logout</a></li>
    </ul>
</div>
<section class="main-section" style="width:calc(100% - 320px)">
    <div class="intro-div">
        <b>Dashboard</b>
        <span id="time" class="time"></span>
    </div>
    <br>
    <div style="display:flex">
    <b> Filter: 
    </b>
    <table class="table">
        <tr>
          <th>no of row </th>
          <th>day </th>
          <th>month</th>
          <th> year </th>
        </tr>
        <tr>
          <td>
          <form action="delete-admin.php" method="POST">
        <select class="form-control submiter" name="number">
          <option>15</option>
          <option>25</option>
          <option>50</option>
          <option>100</option>
          <option>500</option>
        </select>
      </form>
         </td>
         <td>
         <form action="delete-admin.php" method="POST">
          <input class="form-control submiter" type="text" placeholder="1 - 30" />
        </form>
         </td>
         <td>
         <select class="form-control">
          <option value="01">January</option>
          <option value="02">Febuary</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">October</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
         </td>
         <td>
         <select class="form-control">
          <option>2021</option>
          <option>2022</option>
          <option>2023</option>
          <option>2024</option>
          <option>2025</option>
        </select>
         </td>
        </tr>
      </table>
  </div>
  <hr>
  <table class="table table-bordered bg-white">
        <div style="width:100%;display: flex;justify-content: space-between;">
            <label>View Rooms</label> 
            <button type="button" class="btn button-o btn-outline-success">Add New</button>
        </div>
    <thead>
      <tr>
        <th> S/N </th>
        <th>Time</th>
        <th>Price</th>
        <td>Expense Detail</td>
        <th>Department </th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include '../init.php';
        $sql = "SELECT * FROM `expenditure`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row['id'] ."</td>
                    <td>". $row['timestamp'] ."</td>
                    <td>". $row['price'] ."</td>
                    <td>". $row['expense_name'] ."</td>
                    <td>". $row['department'] ."</td>
                    <th><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    action
                 </button>
                 <div class='dropdown-menu'>
                   <a class='dropdown-item' href='#' onclick=edit(".$row['id'] .")>Edit</a>
                   <a class='dropdown-item' href='delete-admin.php?deleter=".$row['id']."'>Delete</a>
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
    <input type="text" class="form-control" placeholder="Price" name="price" />
    <input type="text" class="form-control" placeholder="Expense Name" name="expense_name" />
    <select class="form-control" placeholder="Department" name="department">
        <option value="Receptionist"> Receptionist </option>
        <option value="Front Office"> Front Office </option>
        <option value="Bar"> Bar </option>
        <option value="Cocktail"> Cocktail </option>
    </select>
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
    $('.submiter').on('change', function(){
        $(this).parent('form').submit();
    })
    </script>
</body>
</html>

    
