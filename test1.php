<?php 
	$con = mysqli_connect("localhost","root","123456","practice1");
	extract($_POST);

		// fetchinf from database and printing in table
	if(isset($_POST['read']))
	{
		$data ='<table class="table table-bordered ">
					<tr>
						<th>S.No</th>
						<th>Title</th>
						<th>SKu</th>
						<th>mrp</th>
						<th>basic price</th>
						<th>qantity</th>
						<th>dmaage</th>
						<th>total</th>
						<th>lost</th>
						<th>avail Quan</th>
						<th>Edit Action </th>
						<th>Delete Action </th>
					</tr>';
		$qry="SELECT * FROM warehouse ";
		$result = mysqli_query($con,$qry);
		
			$counter = 1;
			while($row = mysqli_fetch_array($result))
			{
				$data .='<tr>
							<td>'.$counter.'</td>
							<td>'.$row['title'].'</td>
							<td>'.$row['sku'].'</td>
							<td>'.$row['mrp'].'</td>
							<td>'.$row['basic_price'].'</td>
							<td>'.$row['quant'].'</td>
							<td>'.$row['damage_prod'].'</td>
							<td>'.$row['total'].'</td>
							<td>'.$row['lost'].'</td>
							<td>'.$row['avail_quant'].'</td>
							<td><button onclick="updatedata('.$row['sno'].')" class="btn btn-success">Edit</button></td>
							<td><button onclick="deletedata('.$row['sno'].')" class="btn btn-danger">Delete</button></td>
						</tr>';
						

				$counter++;
				
		}			
		$data .='</table>';
		echo $data;
	}
		// deleting database
	if(isset($_POST['delete_id']))
	{
		$del = $_POST['delete_id'];
		$delquery = "DELETE FROM warehouse where sno='$del'";
		 mysqli_query($con,$delquery);
	}

	// getting value on clicking modal
	if(isset($_POST['id']))
	{
		$getid = $_POST['id'];
		//print($getid);
		$sel = "SELECT * FROM `warehouse` where sno='$getid'";
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
		$title = $_POST['title'];
		$sku =$_POST['sku'];
		$mrp =$_POST['mrp'];
		$basic_price =$_POST['basic_price'];
		$quant =$_POST['quan'];
		$damage_prod =$_POST['damage'];
		$total =$_POST['total'];
		$lost =$_POST['lost'];
		$avail_quant =$_POST['avail_quan'];
		
		$upd ="UPDATE warehouse set title='$title',sku='$sku',mrp='$mrp',basic_price='$basic_price',quant='$quant',damage_prod='$damage_prod',total='$total',lost='$lost',avail_quant='$avail_quant' where sno='$hidden'";
		mysqli_query($con,$upd);
	}

?> 