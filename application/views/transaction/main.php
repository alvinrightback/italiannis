<script type="text/javascript">
	
	function getTransactionDetails(id){
		$('#table_orders').DataTable().destroy();
		$('#Transaction_Details').css('display', 'block');
		$('#Transaction_Details_Progress').css('display', 'block');
		$('#Transaction_Details_Body').css('display', 'none');
		$('#Payment_Details_Complete').css('display', 'none');
		$('#Transaction_Details_Status').removeAttr( "class");
		$('#Transaction_Details_Status').css('display', 'none');
		$.ajax({
			'url' : '<?php  echo base_url('transaction/get_transaction_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : id},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
 					$('#Transaction_Table_Number').text('Table number: '+data[0].table_number);
 					$('#Transaction_Date').text('Date: '+data[0].date_created);
					if(data[0].status == 0){
						$('#Transaction_Details_Status').addClass("badge badge-warning");
						$('#Transaction_Details_Status').text("Pending");
					}
					else if(data[0].status == 1){
						$('#Transaction_Details_Status').addClass("badge badge-info");
						$('#Transaction_Details_Status').text("Bill-out");
					}
					else if(data[0].status == 2){
						$('#Transaction_Details_Status').addClass("badge badge-success");
						$('#Transaction_Details_Status').text("Completed");
					}
					else{
						//Do Nothing
					}
					$('#Transaction_Details_Status').css('display', 'block');

					if(data[0].payment){
						$('#Payment_Details').css('display', 'block');	 
						var payment_type = data[0].payment[0].payment_type == 1? 'Cash':'Card';
						var discount = data[0].payment[0].discount == 1? 'Yes':'No';
						$('#Transaction_Payment_Type').text("Type: "+payment_type);
						$('#Transaction_Payment_Total').text("Grand Total: "+data[0].payment[0].total);
						$('#Transaction_Payment_Discount').text("Discount: "+discount);
					 }
					 else{
						$('#Payment_Details').css('display', 'none');	 
					 }

					if(data[0].status == 1){
						$('#Payment_Details_Complete').css('display', 'block');	 
					}
					else{
						$('#Payment_Details_Complete').css('display', 'none');	 
					}

 					var myTable = $('#table_orders').DataTable({
 						"paging": false,
 						"lengthChange": false,
 						"searching": false,
 						"ordering": true,
 						"info": false,
 						"autoWidth": true,
 						"columns": [{
 							"title": "Name",
 							"data": "name"
 						}, {
 							"title": "Price",
 							"data": "price"

 						}, {
							"title": "Quantity",
							"data": "quantity"
						}, {
							"title": "Total",
							"data": "total"
						}, {
 							"title": "Status",
 							"data": "order_status"

 						}]
 					});

 					 myTable.clear();
 					 $.each(data[0].orders, function(index, value) {
 					 	myTable.row.add(value);
 					 });
 					myTable.draw();
 				},
			complete: function(){
				$('#Transaction_Details_Progress').css('display', 'none');
				$('#Transaction_Details_Body').css('display', 'block');
			}	 


 			});
	}

</script>
<main class="main-content p-5" role="main">
	<div class="row">
		<div class="col-md-12">
			<h1>Transaction</h1>
		</div>
	</div>
	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>

<div class="row">
	<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
		<div class="card">
			<div class="card-header">
				Transactions
			</div>
			<div class="card-body">

				<?php if(is_array($transaction)): ?>
					<div class="table-responsive">
						<table id="datatable-1" class="table table-datatable table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Table Number</th>
									<th>Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($transaction as $row): ?>
									<tr style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="View Transaction" onclick="javascript:getTransactionDetails(<?php echo $row->trans_id; ?>)">
										<td><?php echo $row->table_number; ?></td>
										<td><?php echo date('Y-m-d h:i A', strtotime($row->date_created));	 ?></td>
										<td class="text-center">
											<span class="badge 
												<?php if($row->status == 0){echo 'badge-warning';} 
													  else if($row->status == 1){echo 'badge-info';}
													  else if($row->status == 2){echo 'badge-success';}
													  else{echo '';}	
												?>">
												<?php if($row->status == 0){echo 'Pending';} 
													  else if($row->status == 1){echo 'Bill-out';}
													  else if($row->status == 2){echo 'Completed';}
													  else{echo '';}	
												?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php else: ?>
					<p>No data found.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="Transaction_Details" style="display: none;" class="col-md-6 col-lg-6 col-xl-6 mb-5">
		<div class="card">
			<div class="card-header">
				Transaction Details
				<div class="header-btn-block">
					<span id="Transaction_Details_Status" style="display: none;"></span>
				</div>
			</div>
			<div class="card-body">
				<div id="Transaction_Details_Progress" style="display: none;" class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
				</div>

				<div id="Transaction_Details_Body" style="display: none;">
					<p id="Transaction_Table_Number"></p>
					<p id="Transaction_Date"></p>
					<hr>
					<h4>Orders</h4>
					<div class="table-responsive">
						<table id="table_orders" class="table table-sm table-bordered table-hover">
							<thead class="thead-light">
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<p id="Transaction_Payment_Total" class="pull-right" style="padding-right:25%; font-weight: bold;></p>
					</div>
					<div id="Payment_Details_Complete" style="display: none;"><button class="btn btn-success">Payment Complete</button></div>
					<div id="Payment_Details" style="display: none;">
						<hr>
						<h4>Payment Details</h4>
						<p id="Transaction_Payment_Type"></p>
						<p id="Transaction_Payment_Discount"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

