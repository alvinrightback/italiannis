 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Barangay</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Barangay Information</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<!-- Row selection (single row) -->
 		<!--===================================================-->
 		<div class="row">
 		<div class="col-md-6">
 		<div class="panel">
 			<div class="panel-heading">
 				<h3 class="panel-title">Barangay Information <a href="<?php echo base_url('barangay/edit/'.$barangay_data[0]->Barangay_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 			</div>
 			<div class="panel-body">
 				<table class="table table-bordered table-hover">
 					<tbody>
 					<?php if(is_array($barangay_data)): ?>
 							<tr>
 								<td class="col-md-4"><b>Barangay Name</b></td>
 								<td><?php echo $barangay_data[0]->Barangay_Name; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Barangay Chairman</b></td>
 								<td><?php echo $barangay_data[0]->Barangay_Chairman; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Telephone Number</b></td>
 								<td><?php echo $barangay_data[0]->Barangay_Telephone; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Zip Code</b></td>
 								<td><?php echo $barangay_data[0]->Barangay_Zipcode; ?></td>
 							</tr>
 					<?php endif; ?>
 						</tbody>
 					</table>
 				</div>
 			</div>
 			</div>
 			</div>
 			<!--===================================================-->
 			<!-- End Row selection (single row) -->
 		</div>
 		<!--===================================================-->
 		<!--End page content-->
 	</div>
 	<!--===================================================-->
            <!--END CONTENT CONTAINER-->