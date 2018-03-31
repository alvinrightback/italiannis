 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Citizen Information</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Upload Photo</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->
 	
 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<div class="row">
 			<div class="col-md-6" id="takePhoto" style="display: block;">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Take a photo</h3>
 					</div>
 					<div class="panel-body">
 						<video id="video" autoplay></video>
 					</div>
 					<div class="panel-footer text-right">
 						<button id="snap" class="btn btn-success" type="submit">Take Photo</button>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-6" id="uploadPhoto" style="display: none;">
 				<div class="panel">
 					<div class="panel-heading">
 					<h3 class="panel-title">Upload the photo</h3>
 					</div>
 					<div class="panel-body">
 						<canvas id="canvas" width="490" height="480"></canvas>
 					</div>
 					<?php echo form_open('citizens/photo_add_now'); ?>
 					<input type="hidden" id="imageURL" name="imageURL">
 					<input type="hidden" name="Citizen_ID" value="<?php echo $citizen_data[0]->Citizen_ID; ?>">
 					<div class="panel-footer text-right">
 						<a id="retake" class="btn btn-muted" >Retake</a>
 						<button class="btn btn-success" type="submit">Upload</button>
 					</div>
 					<?php echo form_close(); ?>
 				</div>
 			</div>
 		</div>
 	</div>
 	<script type="text/javascript">
 		// Grab elements, create settings, etc.
 		var video = document.getElementById('video');
 		// Elements for taking the snapshot
 		var canvas = document.getElementById('canvas');
 		var context = canvas.getContext('2d');
 		video.width = 490;

		// Get access to the camera!
		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
		    // Not adding `{ audio: true }` since we only want video now
		    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
		    	video.src = window.URL.createObjectURL(stream);
		    	video.play();
		    });
		}

		// Trigger photo take
		document.getElementById("snap").addEventListener("click", function() {
			context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight,-100,0,video.videoWidth, video.videoHeight);
			document.getElementById("imageURL").value = canvas.toDataURL();
			document.getElementById('takePhoto').style.display = 'none';
			document.getElementById('uploadPhoto').style.display = 'block';
		});

		// Retake Photo
		document.getElementById("retake").addEventListener("click", function() {
			document.getElementById('takePhoto').style.display = 'block';
			document.getElementById('uploadPhoto').style.display = 'none';
		});


	</script>
	<!--===================================================-->
	<!--End page content-->


</div>
<!--===================================================-->
            <!--END CONTENT CONTAINER-->