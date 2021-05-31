
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Add Teacher Salary');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?school/update_salary/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                            
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('category');?></label>
                        <div class="col-sm-6">
                            <select name="teacher_id" class="form-control selectboxit" required>
                                <option value=""><?php echo get_phrase('Select Teacher');?></option>
                                <?php 
                                    $teacher = $this->db->get('teacher')->result_array();
                                    foreach ($teacher as $row):
                                ?>
                                <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('category');?></label>
                        <div class="col-sm-6">
                            <select name="expense_category_id" class="form-control selectboxit" required>
                                <option value=""><?php echo get_phrase('select_expense_category');?></option>
                                <?php 
                                    $categories = $this->db->get('expense_category')->result_array();
                                    foreach ($categories as $row):
                                ?>
                                <option value="<?php echo $row['expense_category_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="amount" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date');?></label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" name="date" value=""/>
                                </div>
                            </div>
                            
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_teacher_salary');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>