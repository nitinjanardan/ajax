<html>
	<head>
		<title>AJAX CRUD </title>
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		
	</head>
	<body> 
		<div class="container">
			<h1>AJAX CRUD </h1>	
				
			</div>	
      <br />
			<div id="record">

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
                      <label>Title : </label>
                      <input type="text" name="ads" id="title" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>SKU: </label>
                      <input type="text" name="ads" id="sku" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>MRP: </label>
                      <input type="text" name="ads" id="mrp" pattern= "[0-9]" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Basic Price: </label>
                      <input type="text" name="ads" id="basic_price" pattern= "[0-9]" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Quantity: </label>
                      <input type="text" name="ads" id="quan" pattern= "[0-9]"  class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Damage: </label>
                      <input type="text" name="ads" id="damage" pattern= "[0-9]" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Total: </label>
                      <input type="text" name="ads" id="total" pattern= "[0-9]" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Lost: </label>
                      <input type="text" name="ads" id="lost" pattern= "[0-9]" class="form-control" />
                    </div>  
                    <div class="form-group">
                      <label>Available Quantity:</label>
                      <input type="text" name="ads" id="avail_quan" pattern= "[0-9]" class="form-control" />
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
  				url:"test1.php",
  				type:"POST"	,
  				data:{read:read }	,

	  				success:function(data,status){
	  					$('#record').html(data);
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
  				url:"test1.php",
  				type:"POST"	,
  				data:{delete_id:del},

  				success:function(data,status){
  					readweek();
  				}
  			});
  			}
  		}
  		// update data  on clicking modal
  		function updatedata(id)
  		{
  			$('#hidden_id').val(id);
  			$.post("test1.php",{id:id},
  				function(data,status)
  				{
  					var upd = JSON.parse(data);
            //console.log(upd);
  					//$('#upd_week').val(upd.week_name);
            document.getElementById('title').value='';
        document.getElementById('sku').value='';
        document.getElementById('mrp').value='';
        document.getElementById('basic_price').value='';
        document.getElementById('quan').value='';
        document.getElementById('damage').value='';
        document.getElementById('total').value='';
        document.getElementById('lost').value='';
        document.getElementById('avail_quan').value='';
  					$('#title').val(upd.title);
  					$('#sku').val(upd.sku);
            $('#mrp').val(upd.mrp);
            $('#basic_price').val(upd.basic_price);
            $('#quan').val(upd.quant);
            $('#damage').val(upd.damage_prod);
            $('#total').val(upd.total);
            $('#lost').val(upd.lost);
            $('#avail_quan').val(upd.avail_quant);
            
        
        
  				}

  				);
  			$('#update_modal').modal("show");
        
  		}
  		//upda
  		function updateddata()
  		{
        // var se = document.getElementById("upd_week");
       
  			var title = $('#title').val();
  			var sku =$('#sku').val();
        var mrp =$('#mrp').val();
        var basic_price =$('#basic_price').val();
        var quan =$('#quan').val();
        var damage =$('#damage').val();
        var total =$('#total').val();
        var lost =$('#lost').val();
        var avail_quan =$('#avail_quan').val();
  			var hidden_id	=$('#hidden_id').val();
  			$.post("test1.php",{
  				hidden_id:hidden_id,
  				title:title,
  				sku:sku,
  				mrp:mrp,
          basic_price:basic_price,
          quan:quan,
          damage:damage,
          total:total,
          lost:lost,
          avail_quan:avail_quan,

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