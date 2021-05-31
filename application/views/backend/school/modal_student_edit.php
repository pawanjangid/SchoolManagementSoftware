<?php 
$edit_data		=	$this->db->get_where('enroll' , array(
	'student_id' => $param2 , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year
))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'school/student/do_update/'.$row['student_id'].'/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
                	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">S.R. No.</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="srno"
								value="<?php echo $row['srno'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class" disabled
								value="<?php echo $this->db->get_where('class' , array('class_id' => $row['class_id'],'school_id' => $this->session->userdata('school_id')))->row()->name; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                        
						<div class="col-sm-5">
							<select name="section_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select_section');?></option>
                              <?php
                              	$sections = $this->db->get_where('section' , array('class_id' => $row['class_id'],'school_id' => $this->session->userdata('school_id')))->result_array();
                              	foreach($sections as $row2):
                              ?>
                              <option value="<?php echo $row2['section_id'];?>"
                              	<?php if($row['section_id'] == $row2['section_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('roll');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="roll"
								value="<?php echo $row['roll'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Father's Name</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="fathername" value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->fathername; ?>" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Mother's Name</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mothername" value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->mothername; ?>" >
						</div> 
					</div>
					
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" 
								value="<?php echo date('d-m-Y',$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->birthday); ?>" 
									data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
							<?php
								$gender = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->sex;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male" <?php if($gender == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female"<?php if($gender == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->address; ?>" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Category</label>
                        
						<div class="col-sm-5">
							<select name="category" class="form-control selectboxit">
							<?php
								$category = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->category;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="general" <?php if($category == 'general')echo 'selected';?>>General</option>
                              <option value="obc_cl" <?php if($category == 'obc_cl')echo 'selected';?>>OBC(Creamy Layer)</option>
                              <option value="obc-ncl" <?php if($category == 'obc-ncl')echo 'selected';?>>OBC(Non Creamy Layer)</option>
                              <option value="sc" <?php if($category == 'sc')echo 'selected';?>>SC</option>
                              <option value="st" <?php if($category == 'st')echo 'selected';?>>ST</option>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Nationality</label>
                        
						<div class="col-sm-5">
							<select name="nationality" class="form-control selectboxit">
							<?php
								$nationality = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->nationality;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="indian" <?php if($nationality == 'indian')echo 'selected';?>>INDIAN</option>
                              <option value="non-indian" <?php if($nationality == 'non-indian')echo 'selected';?>>Non-INDIAN</option>
                          </select>
						</div>  
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone; ?>" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Date of Admission</label>
						<div class="col-sm-5">
								<input type="text" class="datepicker form-control" name="date_of_admission" value="<?php echo date('d-m-Y',$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->date_of_admission); ?>"/>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory');?></label>
                        
						<div class="col-sm-5">
							<select name="dormitory_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$dorm_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->dormitory_id;
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $row2):
	                              ?>
                              		<option value="<?php echo $row2['dormitory_id'];?>"
                              			<?php if($dorm_id == $row2['dormitory_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>
                        
						<div class="col-sm-5">
							<select name="transport_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$trans_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->transport_id; 
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $row2):
	                              ?>
                              		<option value="<?php echo $row2['transport_id'];?>"
                              			<?php if($trans_id == $row2['transport_id']) echo 'selected';?>><?php echo $row2['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

