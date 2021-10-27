<?php
    include '../init.php';
    $adminid = $_POST["id"];
	$sql = "SELECT * FROM `admin` where id='$adminid'";
	$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $username= $row["username"];
	            $fullname= $row["fullname"];
	            $rolecode = $row['category'];
	            $status= $row["status"];
            }
        }
	
	?>
	<form role="form" class="form-horizontal" method="post" action="functions/admin_master.php?do=update" enctype="multipart/form-data">
	<input type="hidden" name="adminid" value="<?php echo $adminid?>" />

	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">Update Admin</h4>
	</div>
	<div class="modal-body">
			
			<div class="form-group clearfix">
				<label class="col-md-3 control-label">Username </label>
				<div class="col-md-9">
					<input type="text" class="form-control" required name="username" placeholder="Enter Username" value="<?php echo $username; ?>">
				</div>
			</div>

			<div class="form-group clearfix">
				<label class="col-md-3 control-label">Full Name </label>
				<div class="col-md-9">
					<input type="text" class="form-control" required name="fullname" placeholder="Enter Full Name" value="<?php echo $fullname; ?>">
				</div>
			</div>
            
			
			<div class="form-group clearfix">
				<label class="col-md-4 control-label">Status</label>
				<div class="col-md-4">
					<select class="form-control" name="status" placeholder="">
					<option value="Enabled" <?php if($status=='Enabled'){ echo 'selected'; }?>>Enable</option>
					<option value="Disabled" <?php if($status=='Disabled'){ echo 'selected'; }?>>Disable</option>
					</select>
				</div>
			</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-danger btn-sm button-continue-shopping" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary btn-sm button-checkout">Submit</button>
	</div>
	</form>