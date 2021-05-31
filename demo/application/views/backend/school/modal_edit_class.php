<?php 
$edit_data		=	$this->db->get_where('class' , array('class_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
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
				
                <?php echo form_open(base_url() . 'index.php?school/classes/do_update/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('numeric_name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name_numeric" value="<?php echo $row['name_numeric'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                        <div class="col-sm-5">
                            <select name="teacher_id" class="form-control">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                                $teachers = $this->db->get_where('teacher', array('school_id' => $this->session->userdata('school_id')))->result_array();
                                foreach($teachers as $row2):
                                ?>
                                    <option value="<?php echo $row2['teacher_id'];?>"
                                        <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div style="text-align: center;"><h1>Fees Structure-(Annual)</h1></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Tution_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="tution_fee" value="<?php echo $row['tution_fee'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Session_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="session_fee" value="<?php echo $row['session_fee'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Examination_fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="examination_fee" value="<?php echo $row['examination_fee'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Computer_Academics');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="computer_academics" value="<?php echo $row['computer_academics'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Sports');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sports" value="<?php echo $row['sports'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('extra_co_curricular');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="extra_co_curricular" value="<?php echo $row['extra_co_curricular'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Laboratory_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="laboratory_fee" value="<?php echo $row['laboratory_fee'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Development_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="development_fee" value="<?php echo $row['development_fee'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Admission_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="admission_fee" value="<?php echo $row['admission_fee'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_class');?></button>
                        </div>
                    </div>
                        </div>


            		
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>


