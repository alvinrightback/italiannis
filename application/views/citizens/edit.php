 <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Edit Personal Information</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Edit Personal Citizen</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					<div class="row">
					    <div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Personal Information</h3>
					            </div>
					
					            <!--Block Styled Form -->
					            <!--===================================================-->
					            <?php
						        echo form_open('citizens/edit_now');
						        ?>
					                <div class="panel-body">
					                <div class="row">
					                         <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Barangay</label>
					                                <select name="Barangay_ID" class="selectpicker form-control" required>
					                               <?php if(is_array($barangay)): ?>
					                                	<?php foreach($barangay as $row): ?>
					                                		<option value="<?php echo $row->Barangay_ID; ?>"<?php echo $row->Barangay_ID == $citizen_data[0]->Barangay_ID ? ' selected':'' ?> ><?php echo $row->Barangay_Name; ?></option>
					                                	<?php endforeach; ?>
					                                <?php endif; ?>
					                            </select>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                		<div class="col-sm-1">
					                            <div class="form-group">
					                                <label class="control-label">Title</label>
					                                <select name="Citizen_Title" class="selectpicker form-control">
					                                <option value="Mr" <?php echo $citizen_data[0]->Citizen_Title == 'Mr'? 'selected':'' ?>>Mr</option>
					                                <option value="Ms" <?php echo $citizen_data[0]->Citizen_Title == 'Ms'? 'selected':'' ?>>Ms</option>
					                                <option value="Mrs" <?php echo $citizen_data[0]->Citizen_Title == 'Mrs'? 'selected':'' ?>>Mrs</option>
					                           		</select>
					                            </div>
					                        </div>
					                        <div class="col-sm-3">
					                            <div class="form-group">
					                                <label class="control-label">Last Name</label>
					                                <input type="text" class="form-control" name="Citizen_LastName" 
					                                value="<?php echo $citizen_data[0]->Citizen_LastName; ?>" placeholder="Enter Last Name" required>
          											<small class="text-danger"><?php echo form_error('Citizen_LastName'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">First Name</label>
					                                <input type="text" class="form-control" name="Citizen_FirstName" value="<?php echo $citizen_data[0]->Citizen_FirstName; ?>"  placeholder="Enter First Name" required>
          											<small class="text-danger"><?php echo form_error('Citizen_FirstName'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-3">
					                            <div class="form-group">
					                                <label class="control-label">Middle Name</label>
					                                <input type="text" class="form-control" name="Citizen_MiddleName" value="<?php echo $citizen_data[0]->Citizen_MiddleName; ?>"  placeholder="Enter Middle Name">
          											<small class="text-danger"><?php echo form_error('Citizen_MiddleName'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-1">
					                            <div class="form-group">
					                                <label class="control-label">Name Suffix</label>
					                                <input type="text" class="form-control" name="Citizen_Suffix" value="<?php echo $citizen_data[0]->Citizen_Suffix; ?>"  
					                                placeholder="Enter Name Suffix" required>      								<small class="text-danger"><?php echo form_error('Citizen_Suffix'); ?></small>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Nickname</label>
					                                <input type="text" class="form-control" name="Citizen_NickName" 
					                                value="<?php echo $citizen_data[0]->Citizen_NickName; ?>" placeholder="Enter Nick Name">
					                                <input type="hidden" name="Citizen_ID" value="<?php echo $citizen_data[0]->Citizen_ID; ?>">
          											<small class="text-danger"><?php echo form_error('Citizen_NickName'); ?></small>
					                            </div>
					                        </div>
					                	</div>
					                    <div class="row">
					                    	<div class="col-sm-4">
					                        <div class="form-group">
					                                <label class="control-label">Gender</label>
					                                <select name="Citizen_Gender" class="selectpicker form-control">
					                                <option value="Male" <?php echo $citizen_data[0]->Citizen_Gender == 'Male'? 'selected': '' ?>>Male</option>
					                                <option value="Female" <?php echo $citizen_data[0]->Citizen_Gender == 'Female'? 'selected': '' ?>>Female</option>
					                           		</select>
					                          </div>
					                        </div>

					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Nationality</label>
					                                <select name="Nationality_ID" class="selectpicker form-control" required>
					                               		<?php if(is_array($nationality)): ?>
					                                	<?php foreach($nationality as $row): ?>
					                                		<option value="<?php echo $row->Nationality_ID; ?>"<?php echo $row->Nationality_ID == $citizen_data[0]->Nationality_ID ? ' selected':'' ?> ><?php echo $row->Nationality_Name; ?></option>
					                                	<?php endforeach; ?>
					                                <?php endif; ?>
					                           		 </select>
          											<small class="text-danger"><?php echo form_error('Citizen_Nationality'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Civil Status</label>
					                                <select name="Citizen_CivilStatus" class="selectpicker form-control">
					                                <option value="Single" <?php echo $citizen_data[0]->Citizen_CivilStatus == 'Single' ? 'selected':'' ?>>Single</option>
					                                <option value="Married" <?php echo $citizen_data[0]->Citizen_CivilStatus == 'Married' ? 'selected':'' ?>>Married</option>
					                                <option value="Divorced" <?php echo $citizen_data[0]->Citizen_CivilStatus == 'Divorced' ? 'selected':'' ?>>Divorced</option>
					                                 <option value="Widowed" <?php echo $citizen_data[0]->Citizen_CivilStatus == 'Widowed' ? 'selected':'' ?>>Widowed</option>
					                                 <option value="Separated" <?php echo $citizen_data[0]->Citizen_CivilStatus == 'Separated' ? 'selected':'' ?>>Separated</option>
					                                 <option value="Livein" <?php echo $citizen_data[0]->Citizen_CivilStatus == 'Livein' ? 'selected':'' ?>>Livein</option>
					                            </select>
					                          </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Birth Date</label>
					                                <input class="form-control input-sm" type="date" name="Citizen_BirthDate" value="<?php echo $citizen_data[0]->Citizen_BirthDate; ?>" placeholder="Enter Birth Date" required>
          											<small class="text-danger"><?php echo form_error('Citizen_BirthDate'); ?></small>
					                            </div>
					                        </div>
					                    	<div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Birth Place</label>
					                                <input type="text" class="form-control" name="Citizen_BirthPlace" value="<?php echo $citizen_data[0]->Citizen_BirthPlace; ?>" placeholder="Enter Middle Name">
          											<small class="text-danger"><?php echo form_error('Citizen_BirthPlace'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Highest Educational Attainment</label>
					                                <select name="Citizen_HighestEducationAttainment" class="selectpicker form-control">
					                                <option value="Elementary" <?php echo $citizen_data[0]->Citizen_HighestEducationAttainment == 'Elementary'? 'selected':'' ?>>Elementary</option>
					                                <option value="Highschool" <?php echo $citizen_data[0]->Citizen_HighestEducationAttainment == 'Highschool'? 'selected':'' ?>>Highschool</option>
					                                <option value="College" <?php echo $citizen_data[0]->Citizen_HighestEducationAttainment == 'College'? 'selected':'' ?>>College</option>
					                           		</select>
          											<small class="text-danger"><?php echo form_error('Citizen_HighestEducationAttainment'); ?></small>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Mobile Number</label>
					                                <input type="number" class="form-control" name="Citizen_Mobile" value="<?php echo $citizen_data[0]->Citizen_Mobile; ?>" placeholder="Enter Mobile Number">
          											<small class="text-danger"><?php echo form_error('Citizen_Mobile'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Telephone Number</label>
					                                <input type="number" class="form-control" name="Citizen_Telephone" value="<?php echo $citizen_data[0]->Citizen_Telephone; ?>" placeholder="Enter Telephone Number">
          											<small class="text-danger"><?php echo form_error('Citizen_Telephone'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Email Address</label>
					                                <input type="email" class="form-control" name="Citizen_Email" value="<?php echo $citizen_data[0]->Citizen_Email; ?>" placeholder="Enter Email Address">
          											<small class="text-danger"><?php echo form_error('Citizen_Email'); ?></small>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Name of Father</label>
					                                <input type="text" class="form-control" name="Citizen_NameOfFather" value="<?php echo $citizen_data[0]->Citizen_NameOfFather; ?>" placeholder="Enter Father's Name">
          											<small class="text-danger"><?php echo form_error('Citizen_NameOfFather'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Name of Mother</label>
					                                <input type="text" class="form-control" name="Citizen_NameOfMother" value="<?php echo $citizen_data[0]->Citizen_NameOfMother; ?>" placeholder="Enter Mother's Name">
          											<small class="text-danger"><?php echo form_error('Citizen_NameOfMother'); ?></small>
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Name of Spouse (If Married)</label>
					                                <input type="text" class="form-control" name="Citizen_NameOfSpouse" value="<?php echo $citizen_data[0]->Citizen_NameOfSpouse; ?>" placeholder="Enter Spouse's Name">
          											<small class="text-danger"><?php echo form_error('Citizen_NameOfSpouse'); ?></small>
					                            </div>
					                        </div>
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