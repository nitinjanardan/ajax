<?php 
	$con = mysqli_connect("localhost","root","123456","practice");
	extract($_POST);

		// fetchinf from database and printing in table
	if(isset($_POST['read']))
	{
		$data ='<table class="table table-bordered ">
					<tr>
						<th>S.No</th>
						<th>Week Name</th>
						<th>Ads</th>
						<th>Revenue</th>
						<th>Edit Action </th>
						<th>Delete Action </th>
					</tr>';
		$qry="SELECT * FROM `dummy`";
		$result = mysqli_query($con,$qry);
		
			$counter = 1;
			while($row = mysqli_fetch_array($result))
			{
				$data .='<tr>
							<td>'.$counter.'</td>
							<td>'.$row['week_name'].'</td>
							<td>'.$row['ads'].'</td>
							<td>'.$row['revenue'].'</td>
							<td><button onclick="updatedata('.$row['id'].')" class="btn btn-success">Edit</button></td>
							<td><button onclick="deletedata('.$row['id'].')" class="btn btn-danger">Delete</button></td>
						</tr>';
						

				$counter++;
				
		}			
		$data .='</table>';
		echo $data;
	}
			// insert in to database

	if(isset($_POST['week_name']) && isset($_POST['ads_spent']) && isset($_POST['revenue']))
	{
		$query ="INSERT INTO `dummy`(`week_name`,`ads`,`revenue`) VALUES ('$week_name','$ads_spent','$revenue')";
		mysqli_query($con,$query);
	}	

		// deleting database
	if(isset($_POST['delete_id']))
	{
		$del = $_POST['delete_id'];
		$delquery = "DELETE FROM dummy where id='$del'";
		 mysqli_query($con,$delquery);
	}

	// getting value on clicking modal
	if(isset($_POST['id']))
	{
		$getid = $_POST['id'];
		$sel = "SELECT * FROM dummy where id='$getid'";
		$qry = mysqli_query($con,$sel);
		$response = array();
		while($row=mysqli_fetch_array($qry))
		{
			$response = $row;
		}
		echo json_encode($response);
	}
	//update table
	if(isset($_POST['hidden_id']))
	{
		$hidden =$_POST['hidden_id'];
		$week = $_POST['upd_week'];
		$ads =$_POST['upd_ads'];
		$revenue =$_POST['upd_revenue'];
		
		$upd ="UPDATE dummy set week_name='$week',ads='$ads',revenue='$revenue' where id='$hidden'";
		mysqli_query($con,$upd);
	}

?> 