<script type="text/javascript">
	
	function getTransactionDetails(id){
		$('#table_orders').DataTable().destroy();
		$('#Transaction_Details, #Transaction_Details_Progress').css('display', 'block');
		$('#Transaction_Details_Body, #Payment_Details_Complete, #Transaction_Details_Status, #Transaction_Edit_Orders').css('display', 'none');
		$('#Transaction_Details_Status').removeAttr( "class");
		$('#Edit_Order_ID').text('');
		$.ajax({
			'url' : '<?php  echo base_url('transaction/get_transaction_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : id},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
			    	$('#Payment_Complete_Btn').prop('href','<?php echo base_url('transaction/payment_complete/');?>'+data[0].trans_id);
					$('#Transaction_Invoice_ID').text('Invoice ID: '+data[0].invoice_id);
					$('#Transaction_Table_Number').text('Table number: '+data[0].table_number);
 					$('#Transaction_Date').text('Date: '+data[0].date_created);
					$('#Edit_Order_ID').text(data[0].trans_id);
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


				    if(data[0].status == 0){
						$('#Transaction_Edit_Orders').css('display', 'block');	 
					}
					else if(data[0].status == 1){
						$('#Payment_Details_Complete').css('display', 'block');	 
					}
					else{
						$('#Payment_Details_Complete, #Transaction_Edit_Orders').css('display', 'none');	 
					}

 					var myTable = $('#table_orders').DataTable({
 						"bSort": false,
						"paging": false,
 						"lengthChange": false,
 						"searching": false,
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
					
 				 	var subtotal = 0;
					myTable.clear();
 					$.each(data[0].orders, function(index, value) {
 					 	subtotal = subtotal+parseInt(value.total);
						myTable.row.add(value);
					});
					
					if(data[0].payment){
						myTable.row.add({name: " ", price: " ", quantity: "Subtotal", total: subtotal, order_status: " "});
						if(data[0].payment[0].discount == 1){
							myTable.row.add({name: " ", price: " ", quantity: "Discount card (20%)", total: subtotal-parseInt(data[0].payment[0].total), order_status: " "});	
						}
						myTable.row.add({name: " ", price: " ", quantity: "Total", total: parseInt(data[0].payment[0].total), order_status : " "});
						myTable.row.add({name: " ", price: " ", quantity: "Payment Type", total: data[0].payment[0].payment_type == 1? 'Cash':'Card', order_status : " "});
					 }
					myTable.draw();

 				},
			'complete' : function(){
				$('#Transaction_Details_Progress').css('display', 'none');
				$('#Transaction_Details_Body').css('display', 'block');
			}	 


 			});
	}


	function editOrders(){
		$('#editOrdersModal').modal('toggle');
		$('#Edit_Orders_Body, #Edit_Orders_Footer').css('display', 'none');
		$('#Edit_Orders_Progress').css('display', 'block');
		$('#table_edit_orders > tbody').html('');
		$.ajax({
			'url' : '<?php  echo base_url('transaction/get_transaction_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : $('#Edit_Order_ID').text()},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
 					$('#Edit_Orders_Table_Number').text('Table number: '+data[0].table_number);
					$('#Edit_Trans_Id').val($('#Edit_Order_ID').text());
					$.each(data[0].orders, function(index, value) {
						$('#table_edit_orders').append("<tr class='tr'><td>"+value.name+"</td><td><input id='input_trans_details_id' style='padding-top: 5%;' name='trans_details_id[]' type='hidden' value="+value.trans_details_id+"><input id='input_order_quantity' class='form-control form-control-sm' max="+value.quantity+" min='0' name='order_quantity[]' type='number' min='1' value="+value.quantity+" required></td><td><div class='form-group'><select id='input_order_status' name='order_status[]' class='form-control'><option value='Not yet served' "+(value.order_status=='Not yet served'?'selected':'')+">Not yet served</option><option value='Served' "+(value.order_status=='Served'?'selected':'')+">Served</option></select></div></td><td class='td'><div class='form-check text-center'><input name='order_delete[]' onchange='javascript:changeRowBG()' class='form-check-input' type='checkbox' value="+value.trans_details_id+"></div></td></tr>");		
 					 });					 
 				},
			complete: function(){
				$('#Edit_Orders_Progress').css('display', 'none');
				$('#Edit_Orders_Body, #Edit_Orders_Footer').css('display', 'block');
			}	 


 			});
	}

	function changeRowBG(){

		$("#table_edit_orders input:checkbox").each(function(){
			var row = $(this).parent().parent().parent();
			if ($(this).prop('checked')==true){ 
				$(row).addClass('table-danger');
				//$(row).find("#input_trans_details_id, #input_order_quantity, #input_order_status").prop('readonly', true);
			}
			else{
				$(row).removeClass('table-danger');
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

	<div class="modal fade" id="editOrdersModal" tabindex="-1" role="dialog" aria-labelledby="editOrdersModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Edit Orders</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="Edit_Orders_Progress" style="display: none;" class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
					</div>
					<div id="Edit_Orders_Body" style="display: none;">
					<p id="Edit_Orders_Table_Number"></p>
						<?php echo form_open('transaction/edit_orders'); ?>
						<input id="Edit_Trans_Id" name="Edit_Trans_Id" type="hidden" >
						<table id="table_edit_orders" class="table table-sm table-hover">
							<thead class="thead-light">
								<tr>
									<th>Name</th>
									<th>Quantity</th>
									<th>Status</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

					</div>
				</div>
				<div class="modal-footer" id="Edit_Orders_Footer" style="display: none;" >
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" onsubmit="alert('yes')" class="btn btn-primary">Update</button>
				</div>
				</form>
		</div>
	</div>
</div>



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
									<th>Invoice ID</th>	
									<th>Table Number</th>
									<th>Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($transaction as $row): ?>
									<tr style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="View Transaction" onclick="javascript:getTransactionDetails(<?php echo $row->trans_id; ?>)">
										<td><?php echo $row->invoice_id; ?></td>
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
					<p id="Transaction_Invoice_ID"></p>
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
					</div>
					<div id="Transaction_Edit_Orders" style="display: none;">
						<button id="Edit_Order_Btn" onclick="javascript: editOrders();" class="btn btn-primary">Edit Orders</button>
						<p id="Edit_Order_ID" style="display: none"></p>
					</div>
					<div id="Payment_Details_Complete" style="display: none;">
						<a id="Payment_Complete_Btn" href="" class="btn btn-success">Payment Complete</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

