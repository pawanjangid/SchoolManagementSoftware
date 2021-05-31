<style type="text/css">
	.red{
		color: red;
	}
</style>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('addmission_form');?>
            	</div>
            </div>
          

			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?school/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label red"><?php echo get_phrase('name') . ' #';?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Aadhar_Number');?></label>
                        
						<div class="col-sm-5">
							<input type="number" class="form-control" id="aadhar" name="aadhar" onfocusout="check(this.value);" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label red">Father's Name   #</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="fathername" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label red">Mother's Name   #</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mothername" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label red"><?php echo get_phrase('class') . ' #';?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control select2" data-validate="required" id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get_where('class',array('school_id' => $this->session->userdata('school_id')))->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-5">
		                        <select name="section_id" class="form-control select2" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                    </select>
			                </div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">S.R. No.</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="srno" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Roll No.</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="roll" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Category</label>
                        
						<div class="col-sm-5">
							<select name="category" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="general">General</option>
                              <option value="obc_cl">OBC(Creamy Layer)</option>
                              <option value="obc-ncl">OBC(Non Creamy Layer)</option>
                              <option value="sc">SC</option>
                              <option value="st">ST</option>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Nationality</label>
                        
						<div class="col-sm-5">
							<select name="nationality" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="indian">INDIAN</option>
                              <option value="non-indian">Non-INDIAN</option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Mobile_Number');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="phone" name="phone" value="" onfocusout="checkphone(this.value);">
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Previous_School_Name');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="lastschool" value="">
						</div>
					</div>

					<div class="form-group" >
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory');?></label>
                        
						<div class="col-sm-5">
							<select name="dormitory_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
	                              	$dormitories = $this->db->get_where('dormitory', array('school_id' => $this->session->userdata('school_id')))->result_array();
	                              	foreach($dormitories as $row):
	                              ?>
                              		<option value="<?php echo $row['dormitory_id'];?>"><?php echo $row['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>
					<input type="hidden" name="year" value="<?php echo $this->db->get_where('school', array('school_id'=>$this->session->userdata('school_id')))->row()->running_year; ?>">
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>
                        
						<div class="col-sm-5">
							<select name="transport_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
	                              	$transports = $this->db->get_where('transport', array('school_id' => $this->session->userdata('school_id')))->result_array();
	                              	foreach($transports as $row):
	                              ?>
                              		<option value="<?php echo $row['transport_id'];?>"><?php echo $row['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
	                    <label class="col-sm-3 control-label">Date of Admission</label>
	                    <div class="col-sm-5">
	                        <input type="text" class="datepicker form-control" name="date_of_admission" value="<?php echo $row['date_of_admission'];?>"/>
	                    </div>
	                </div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="col-sm-4" style="color: red;"># marked is required.</div>

</div>

<script type="text/javascript">

	function get_class_sections(class_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?school/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }

</script>
<script type="text/javascript">
	function check(num) {
		var len = num.length;
		if (len != "12") {
			alert("Please Enter valid Aadhar Number");
		}
	}
	function checkphone(num) {
		var len = num.length;
		if (len != "10") {
			alert("Please Enter valid number Only 10 digit's Thanks.");
		}
	}

</script>
<style type="text/css">
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
 -webkit-appearance: none; 
 margin: 0; 
}
</style>