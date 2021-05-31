<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'school/teacher/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>" alt="...">
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Salary');?></label>
                        
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="salary" value="<?php echo $row['salary'];?>" >
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="birthday" value="<?php echo date('d-m-Y',$row['birthday']);?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sex');?></label>
                                <div class="col-sm-5">
                                    <select name="sex" class="form-control selectboxit">
                                    	<option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                    	<option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Blood_Gruop');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="blood_group" class="form-control selectboxit">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <option value="O+" <?php if($row['blood_group'] == 'O+')echo 'selected';?>><?php echo get_phrase('O+');?></option>
                                      <option value="O-" <?php if($row['blood_group'] == 'O-')echo 'selected';?>><?php echo get_phrase('O-');?></option>
                                      <option value="A-" <?php if($row['blood_group'] == 'A-')echo 'selected';?>><?php echo get_phrase('A-');?></option>
                                      <option value="A+" <?php if($row['blood_group'] == 'A+')echo 'selected';?>><?php echo get_phrase('A+');?></option>
                                      <option value="B-" <?php if($row['blood_group'] == 'B-')echo 'selected';?>><?php echo get_phrase('B-');?></option>
                                      <option value="B+" <?php if($row['blood_group'] == 'B+')echo 'selected';?>><?php echo get_phrase('B+');?></option>
                                      <option value="AB+" <?php if($row['blood_group'] == 'AB+')echo 'selected';?>><?php echo get_phrase('AB+');?></option>
                                      <option value="AB-" <?php if($row['blood_group'] == 'AB-')echo 'selected';?>><?php echo get_phrase('AB-');?></option>
                                  </select>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Joining_Date');?></label>
                                
                                <div class="col-sm-5">
                                    <input type="text" class="form-control datepicker" name="joining_date" value="<?php echo date('d/m/Y',$row['joining_date']) ;?>" data-start-view="2">
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Post');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="post" class="form-control selectboxit">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <option value="PRT" <?php if($row['post'] == 'PRT')echo 'selected';?>><?php echo get_phrase('PRT');?></option>
                                      <option value="TGT" <?php if($row['post'] == 'TGT')echo 'selected';?>><?php echo get_phrase('TGT');?></option>
                                      <option value="PGT" <?php if($row['post'] == 'PGT')echo 'selected';?>><?php echo get_phrase('PGT');?></option>
                                  </select>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Experience');?></label>
                                
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="experience" value="<?php echo $row['experience'];?>" >
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                                
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="subject" value="<?php echo $row['subject'];?>" >
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>

                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_teacher');?></button>
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