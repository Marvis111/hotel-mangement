<?php
include '../init.php';
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$limit = $_POST['limit'];
//
if (strlen($day) == 1) {
	$day = '0'.$day;
}
if (strlen($month) == 1) {
	$month = '0'.$month;
}
//i
//query all or by expression...
if ($day == 'All') {
	$searchExp = $year."-".$month;
}else{
	$searchExp = $year."-".$month."-".$day;
}
//2021-10-10
$TotalAmount = 0;
//initialize..
$bars = $all = $restaurant = $frontSale = $cockTail = "
<table class='table table-bordered bg-white'>    
    <thead>
      <tr>
        <th>S/N</th>
        <th>Category</th>
        <th>Invoice Id</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Price</th>
        <th>Expenditure</th>
      </tr>
    </thead>
";
	$result = " 
  <ul class='nav nav-pills'>
  <li class='nav-item'>
    <a class='nav-link active' data-toggle='pill' href='#Yall'>All</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' data-toggle='pill' href='#Ybarsales'>Bar Sales</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' data-toggle='pill' href='#Yrestasales'>Restaurant Sales</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' data-toggle='pill' href='#Yfrontsales'>Front Sales</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' data-toggle='pill' href='#Ycocksales'>Cocktail</a>
  </li>
</ul>

  ";
  //total of all ccategories of office..
  $barTotal = $resTotal = $cockTotal = $allTotal = $frontTotal = 0;
  $resExpenditure = $barExp = $cockExp = $allExp = $frontExp = 0;
  	$sql = "SELECT * FROM sales";
	$query = mysqli_query($conn,$sql);
//this will track the limit to the posted limit...
  $trackLimit = 0;
  //
	if ($query) {
		while ($row = mysqli_fetch_assoc($query)) {
			if (substr_count($row['date_posted'], $searchExp) > 0) {
				switch ($row['category']) {
          case 'Bar':
            $bars .= "
            <tr>
            <td>". $row['id'] ."</td>
            <td>". $row['category'] ."</td>
            
            <td>". $row['invoice_id'] ."</td>
            <td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
            <td>". $row['customer_email'] ." </td>
            <td>". $row['price'] ." </td>
            <td>". $row['expenditure']."</td>
        </tr>
            ";
            $barTotal += $row['price'];
            $barExp += $row['expenditure'];
            break;
          case 'Cocktail':
            $cockTail .= "
            <tr>
            <td>". $row['id'] ."</td>
            <td>". $row['category'] ."</td>
            
            <td>". $row['invoice_id'] ."</td>

            <td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
            <td>". $row['customer_email'] ." </td>
            <td>". $row['price'] ." </td>
            <td>". $row['expenditure']."</td>
        </tr>
            ";
            $cockTotal += $row['price'];
            $cockExp += $row['expenditure'];
            break;
            case 'Restaurant':
              $restaurant .= "
            <tr>
            <td>". $row['id'] ."</td>
            <td>". $row['category'] ."</td>
            
            <td>". $row['invoice_id'] ."</td>

            <td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
            <td>". $row['customer_email'] ." </td>
            <td>". $row['price'] ." </td>
            <td>". $row['expenditure']."</td>
        </tr>
            ";
            $resTotal += $row['price'];
            $resExpenditure += $row['expenditure'];
              break;
            case 'Front Office':
              $frontSale .= "
              <tr>
              <td>". $row['id'] ."</td>
              <td>". $row['category'] ."</td>
              
              <td>". $row['invoice_id'] ."</td>
  
              <td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
              <td>". $row['customer_email'] ." </td>
              <td>". $row['price'] ." </td>
              <td>". $row['expenditure']."</td>
          </tr>
              ";
              $frontTotal += $row['price'];
              $frontExp += $row['expenditure'];
              break;
          
          default:
              $all .= "";
            break;
        }
        $all .="
        <tr>
        <td>". $row['id'] ."</td>
        <td>". $row['category'] ."</td>
        <td>". $row['invoice_id'] ."</td>
        <td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
        <td>". $row['customer_email'] ." </td>
        <td>". $row['price'] ." </td>
        <td>". $row['expenditure']."</td>
        </tr>
        ";
        $allTotal += $row['price'];
        $allExp += $row['expenditure'];
      ;
			}
      $trackLimit += 1;
      if ($limit == $trackLimit) {
        break;
      }
		};
    $all .= "
    <tr>
    <td><b>TOTAL</b></td>
    <td><b>". ($allTotal - $allExp)."</b></td>
    <td></td>
    <td></td>
    <td></td>
    <td><b>". $allTotal."</b></td>
    <td><b>".$allExp."</b></td>
    </tr>
    </table> 
    <form method='POST' action='payment.php'>
    <input type='hidden' name='searchExp' value='".$searchExp."'></input>
  <input type='hidden' name='category' value='All'></input>
        <button type='submit' class='btn btn-primary' name='printreport'>
         Print Report
       </button>
     </form>
    ";
    $bars .= "
    <tr>
        <td><b>TOTAL</b></td>
        <td>". ($barTotal - $barExp)."</td>
        <td></td>
        <td></td>
        <td></td>
        <td><b>". $barTotal."</b></td>
        <td><b>".$barExp."</b></td>
    </tr>
    </table>
    <form method='POST' action='payment.php'>
    <input type='hidden' name='searchExp' value='".$searchExp."'></input>
  <input type='hidden' name='category' value='Bar'></input>
        <button type='submit' class='btn btn-primary' name='printreport'>
         Print Report
       </button>
     </form>
    ";
    $restaurant .= "
    <tr>
        <td><b>TOTAL</b></td>
        <td>". ($resTotal - $resExpenditure)."</td>
        <td></td>
        <td></td>
        <td></td>
        <td>". $resTotal."</td>
        <td><b>".$resExpenditure."</b></td>
    </tr>
    </table>
    <form method='POST' action='payment.php'>
    <input type='hidden' name='searchExp' value='".$searchExp."'></input>
  <input type='hidden' name='category' value='Restaurant'></input>
        <button type='submit' class='btn btn-primary' name='printreport'>
         Print Report
       </button>
     </form>
    ";
    $cockTail .= "
    <tr>
    <td><b>TOTAL</b></td>
    <td><b>". ($cockTotal - $cockExp)."</b></td>
    <td></td>
    <td></td>
    <td></td>
    <td>". $cockTotal."</td>
    <td><b>".$cockExp."</b></td>
    </tr>
    </table>
    <form method='POST' action='payment.php'>
    <input type='hidden' name='searchExp' value='".$searchExp."'></input>
  <input type='hidden' name='category' value='Cocktail'></input>
        <button type='submit' class='btn btn-primary' name='printreport'>
         Print Report
       </button>
     </form>
    ";
    $frontSale .= "
    <tr>
    <td><b>TOTAL</b></td>
    <td>". ($frontTotal - $frontExp)."</td>
    <td></td>
    <td></td>
    <td></td>
    <td>". $frontTotal."</td>
    <td><b>".$frontExp."</b></td>
    </tr>
    </table>
    <form method='POST' action='payment.php'>
    <input type='hidden' name='searchExp' value='".$searchExp."'></input>
  <input type='hidden' name='category' value='Front Office'></input>
        <button type='submit' class='btn btn-primary' name='printreport'>
         Print Report
       </button>
     </form> 
    ";
	}
  
	$result .= "
 <div class='tab-content'>
  <div class='tab-pane container active' id='Yall'>
    ".$all."
  </div>
<div class='tab-pane container fade' id='Ybarsales'>
".$bars."
</div>
<div class='tab-pane container fade' id='Yrestasales'>
".$restaurant."
</div>
<div class='tab-pane container fade' id='Yfrontsales'>
".$frontSale."
</div>
<div class='tab-pane container fade' id='Ycocksales'>
".$cockTail."
</div>
</div>
  ";
  echo $result;