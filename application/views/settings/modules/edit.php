 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Edit Module</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Edit Module</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">

 		<div class="row">
 			<div class="col-sm-6">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Module Information</h3>
 					</div>

 					<div class="panel-body">
 						<?php echo form_open('settings/module_edit_now'); ?>
 						<div class="form-group">
 							<label class="control-label">Module Name</label>
 							<input type="text"  name="Module_Name" value="<?php echo $module_data[0]->Module_Name; ?>" class="form-control" placeholder="Enter Module Name" required>
 							<input type="hidden" name="Module_ID" value="<?php echo $module_data[0]->Module_ID; ?>">
 						</div>
 						<div class="form-group">
 							<label class="control-label">Class Name</label>
 							<input type="text"  name="Class Name" value="<?php echo $module_data[0]->Class_Name; ?>" class="form-control" placeholder="Enter Class Name" required>
 						</div>
 					</div>
 					<div class="panel-footer text-right">
 						<button class="btn btn-success" type="submit">Submit</button>
 					</div>
 				</form>
 				<!--===================================================-->
 				<!--End Block Styled Form -->

 			</div>
 		</div>
 	</div>



 </div>
 <!--===================================================-->
 <!--End page content-->


</div>
<!--===================================================-->
            <!--END CONTENT CONTAINER-->