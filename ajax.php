<html>
	<head>
		<title>AJAX CRUD </title>
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		
	</head>
	<body> 
		<div class="container">
			<h1>AJAX CRUD </h1>	
			<div>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Week</button>	
			</div>	
      <br />
			<div id="record">

			</div>	

				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Week</h4>
					      </div>
					      <div class="modal-body">
					       		<div class="form-group">
					       			<label>Week Name : </label>
                      <select id="week">
                        <option value="week1">Week1</option>
                        <option value="week2">Week2</option>
                        <option value="week3">Week3</option>
                        <option value="week4">Week4</option>
                        <option value="week5">Week5</option>
                      </select>
					       		</div>	
					       		<div class="form-group">
					       			<label>Ad Spent :</label>
					       			<input type="text" name="ads" id="ads" class="form-control" />
					       		</div>	
					       		<div class="form-group">
					       			<label>Revenue :</label>
					       			<input type="text" name="revenue" id="revenue" class="form-control" />
					       		</div>	
					      </div>
					      <div class="modal-footer">
					      	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addweek()">Save</button>
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					        
					      </div>
					    </div>

				    </div>
				</div>

				<!--for edit modaal -->
				<div id="update_modal" class="modal fade" role="dialog">
					<div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Week</h4>
					      </div>
					      <div class="modal-body">
					       		<div class="form-group">
					       			<label>Week Name : </label>
                      <select id="upd_week">
                        <option value="week1">Week1</option>
                        <option value="week2">Week2</option>
                        <option value="week3">Week3</option>
                        <option value="week4">Week4</option>
                        <option value="week5">Week5</option>
                      </select>
					       		</div>	
					       		<div class="form-group">
					       			<label>Ad Spent :</label>
					       			<input type="text" name="" id="upd_ads" class="form-control" />
					       		</div>	
					       		<div class="form-group">
					       			<label>Revenue :</label>
					       			<input type="text" name="" id="upd_revenue" class="form-control" />
					       		</div>	
					      </div>
					      <div class="modal-footer">
					      	<button type="button" class="btn btn-Success" data-dismiss="modal" onclick="updateddata()">Update</button>
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					        <input type="hidden" name="" id="hidden_id" / >
					      </div>
					    </div>

				    </div>
				</div>
			
		</div>	


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>		
  	<script type="text/javascript">
  		//function to load page without refreshing
  		$(document).ready(function(){
  			
        readweek();
        
  		});
  			// reading data from database and printing in to table
  			function readweek()
  			{
  				var read = "read";
  				$.ajax({
  				url:"test.php",
  				type:"POST"	,
  				data:{read:read }	,

	  				success:function(data,status){
	  					$('#record').html(data);
	  				}
  				});
  			}	

  			// addding data in to database
  		function addweek()
  		{
        var e = document.getElementById("week");
        var week = e.options[e.selectedIndex].value;
  			var ads = $('#ads').val();
  			var revenue = $('#revenue').val();

  			$.ajax({
  				url:"test.php",
  				type:"POST"	,
  				data:{week_name:week,ads_spent:ads,revenue:revenue}	,

  				success:function(data,status){
  					readweek();

  				}
  			});
  			
  		}

  		// delete week 
  		function deletedata(del)
  		{
  			var conf = confirm("Are You Sure");
  			if(conf == true)
  			{
  				$.ajax({
  				url:"test.php",
  				type:"POST"	,
  				data:{delete_id:del},

  				success:function(data,status){
  					readweek();
  				}
  			});
  			}
  		}
  		// update data on clicking modal
  		function updatedata(id)
  		{
  			$('#hidden_id').val(id);
  			$.post("test.php",{id:id},
  				function(data,status)
  				{
  					var upd = JSON.parse(data);
  					$('#upd_week').val(upd.week_name);
  					$('#upd_ads').val(upd.ads);
  					$('#upd_revenue').val(upd.revenue);
            
        document.getElementById('week').value='';
        document.getElementById('ads').value='';
        document.getElementById('revenue').value='';

  				}

  				);
  			$('#update_modal').modal("show");
        
  		}
  		//upda
  		function updateddata()
  		{
        var se = document.getElementById("upd_week");
        var updweek_name = se.options[se.selectedIndex].value;
  		
  			var upd_ads = $('#upd_ads').val();
  			var upd_revenue =$('#upd_revenue').val();
  			var hidden_id	=$('#hidden_id').val();
  			$.post("test.php",{
  				hidden_id:hidden_id,
  				upd_week:updweek_name,
  				upd_ads:upd_ads,
  				upd_revenue:upd_revenue,
  			},
  				function(data,status)
  				{
  					$('#update_modal').modal("hide");

  					readweek();
  				}
  			)
  		}
  	</script>


	</body>	
</html>		