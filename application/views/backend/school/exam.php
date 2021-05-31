<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('exam_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_exam');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th style="text-align: center;"><div><?php echo get_phrase('exam_name');?></div></th>
                    		<th style="text-align: center;"><div>Max. marks</div></th>
                    		<th><div><?php echo get_phrase('Class');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($exams as $row):?>
                        <tr>
							<td style="text-align: center;"><?php echo $row['name'];?></td>
							<td style="text-align: center;"><?php echo $row['maxmarks'];?></td>
							<td><?php echo $this->db->get_where('class',array('class_id' =>$row['class_id']))->row()->name;?></td>
							<td style="text-align: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>school/exam/delete/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'school/exam/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control select2" data-validate="required" id="class_id" 
                                        data-message-required="<?php echo get_phrase('value_required');?>"
                                            onchange="return get_class_sections(this.value)">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php 
                                        $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
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
                                <label class="col-sm-3 control-label">Maximum marks</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="maxmarks"/>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                            </div>
                        		<div class="form-group">
                              	<div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_exam');?></button>
                              	</div>
								</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>