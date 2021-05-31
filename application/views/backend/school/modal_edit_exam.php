<?php 
$edit_data		=	$this->db->get_where('exam' , array('exam_id' => $param2) )->result_array();
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
				
                <?php echo form_open(base_url() . 'school/exam/edit/do_update/'.$row['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Maximum marks</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="maxmarks" value="<?php echo $row['maxmarks'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                        data-message-required="<?php echo get_phrase('value_required');?>"
                                            onchange="return get_class_sections(this.value)">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php 
                                        $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
                                        foreach($classes as $row2):
                                            ?>
                                            <option value="<?php echo $row2['class_id'];?>" <?php if($row2['class_id']==$row['class_id']) echo 'selected'; ?>>
                                                    <?php echo $row2['name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                      ?>
                                  </select>
                                </div> 
                            </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_exam');?></button>
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





