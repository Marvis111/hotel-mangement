<?php 
  include '../init.php';
  include '../backend-data/reportController.php';
?>
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
</head>
<style>
    .calendar_weekdays div, .calendar_content div{
        padding: 8px 0px !important;
    }
    
</style>
<body>
    <div class="row" style="margin: 0;"  > 
        <div class="nav-section">
    <a class="navbar-brand mr-4" href="/"  style="display: flex;justify-content: center;margin: 10px 15px;">
        <img src="{{ url_for('static', filename='logo.png') }}" width="auto" height="50px"/>
    </a>
    <br>
    <ul >
        <li ><a href="index.php"><i class="icon-dashboard"></i>Dashboard</a></li>
        <li ><a href="upload-item.php"><i class="icon-key"></i>Upload Items</a></li>
        <li ><a href="update-item.php"><i class="icon-users"></i>Update Items</a></li>
        <li ><a href="manage-item.php"><i class="icon-users"></i>Manage Members</a></li>
        <li class="active"><a href="payment.php"><i class="icon-book"></i>Payments</a></li>
        <li><a href="expenses.php"><i class="icon-bell"></i>Expenses</a></li>
        <li><a href="#"><i class="icon-power-off"></i>Logout</a></li>
    </ul>
</div>
<section class="main-section" style="width:calc(100% - 320px);">
  <div class="report" style="margin:20px;">
    <span>Report</span>
  </div>
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
          <form >
        <select class="form-control" id='limit'>
          <option value='15'>15</option>
          <option value='25'>25</option>
          <option value='50'>50</option>
          <option value='100'>100</option>
          <option value='500'>500</option>
        </select>
      </form>
         </td>
         <td>
         <select class="form-control" id='days'>
          
        </select>
         </td>
         <td>
         <select class="form-control" id='months'>
          
        </select>
         </td>
         <td>
         <select class="form-control" id='years'>
        </select>
         </td>
        </tr>
      </table>
  </div>
  <hr>

<!-- Tab panes -->
<div id='report-contaier'></div>
<!-- END 
-->
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
          dispatchYearData(2015,2021,'January',2021);

              var day = $("#days").val(),
              month = $("#months").val(),
              limit = $("#limit").val(),
              year = $("#years").val();
              fetchReport(day,month,year,limit);
            
             $(document).on('change','#days',(e)=>{
              var cday = $("#days").val(),
              cmonth = $("#months").val(),
              climit = $("#limit").val(),
              cyear = $("#years").val();
    
              fetchReport(cday,cmonth,cyear,climit);
             })

            $(document).on('change','#months',(e)=>{
             // dispatchYearData(2015,2021,monthByIndex(e.target.value),2021);
             var nday = $("#days").val(),
              nmonth = $("#months").val(),
              nlimit = $("#limit").val(),
              nyear = $("#years").val();
              fetchReport(nday,nmonth,nyear,nlimit);
            });
            $(document).on('change','#years',(e)=>{
              var yday = $("#days").val(),
              ymonth = $("#months").val(),
              ylimit = $("#limit").val(),
              yyear = $("#years").val();
              console.log(e.target.value,ylimit);
          //  dispatchYearData(2015,2021,$("#months").val(),e.target.value);
              fetchReport(yday,ymonth,yyear,ylimit);
            });
      });

//auto send data...
function fetchReport(day,month,year,limit){
    $.ajax({
      url:"../backend-data/fetchreport.php",
      method:"POST",
      data:{day,month,year,limit},
      success:(data)=>{
          $("#report-contaier").html(data);
      }
    })
}
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
//
function dispatchData(data,locationId){
   var select ='';
  if (locationId == 'days') {
    select = "<option value='All'>All</option>";
  }
  for (var i = 0; i < data.length; i++) {
    if (locationId == 'days' || locationId == 'months') {
     select += "<option value="+(i+1)+">"+data[i]+"</option>";
  }else{
    select += "<option value="+(data[i])+">"+data[i]+"</option>";
  }
  }
   $("#"+locationId).html(select);
}
//6
function monthByIndex(index){
  var months = ['January','February','March','April','May',
  'June','July','August','September','October','November','December'];
  var month;
  for (let i = 0; i < months.length; i++) {
    if (index == i) {
      month = months[index - 1];
    }
  }
    return month;
}
//4
function dispatchYearData(fromYr,toYr,defMonth,SelectedYear){
  years = range(fromYr,toYr).sort(function(a, b){return b - a});
  var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
   dispatchData(months,'months');
   dispatchData(years,'years');
  yearMonths = yearData(toYr);
  for(monthData in yearMonths){
                for(month  in yearMonths[monthData]){
                     if (defMonth === month) {
                           dispatchData(yearMonths[monthData][month]['Days'],'days');
                      } 
                  }
  }
}

//3
function yearData(year){
  var monthandDays = [];
  var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  for(moth in months){
      monthandDays.push({[months[moth]]:{Days:fetchDays(months[moth],year)}});
  }
  return monthandDays;
}

//2
function fetchDays(month,year){
  var thirtyDays = ['September','April','June','November'];
  var Days;
  //february
     if (month == 'February'){
      if (year%2== 0) {
        Days = range(28);
      }else{
        Days = range(29);
      }
     }else{
     for(m in thirtyDays){
      if (thirtyDays[m] === month) {
        Days = range(30);
      }else{
        Days = range(31);
      }
     }
   }
     return Days;
}
//1
function range(start,end){
  var arr = [];
  if (end == undefined) {
    for(var i =1;i <= start;i++){
      arr.push(i);
    }
  }else{
  for (var i = start; i <= end; i++) {
     arr.push(i);
  }
  }
  return arr;
}
/*


     

*/



    </script>


</body>
</html>

    
