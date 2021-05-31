<hr />
<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs">Create T.C.</span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
            <br>
				<div class="tab-pane active" id="unpaid">

				<!-- creation of single tc -->
				<?php echo form_open(base_url() . 'index.php?school/student_transfer_certificate/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<div class="row">
					<div class="col-md-6">
	                        <div class="panel panel-default panel-shadow" data-collapsed="0">
	                            <div class="panel-heading">
	                                <div class="panel-title">T.C. Information</div>
	                            </div>
	                            <div class="panel-body">
	                                
	                                <div class="form-group">
	                                    <label class="col-sm-4 control-label"><?php echo get_phrase('class');?></label>
	                                    <div class="col-sm-7">
	                                        <select name="class_id" class="form-control selectboxit"
	                                        	onchange="return get_class_students(this.value)">
	                                        	<option value=""><?php echo get_phrase('select_class');?></option>
	                                        	<?php 
	                                        		$classes = $this->db->get_where('class',array('school_id' => $this->session->userdata('school_id')))->result_array();
	                                        		foreach ($classes as $row):
	                                        	?>
	                                        	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	                                        	<?php endforeach;?>
	                                            
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="form-group">
		                                <label class="col-sm-4 control-label"><?php echo get_phrase('student');?></label>
		                                <div class="col-sm-7">
		                                    <select name="student_id" class="form-control select2" style="width:100%;" id="student_selection_holder">
		                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
		                                    	
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="form-group">
		                                <label class="col-sm-4 control-label"><?php echo get_phrase('Promotion_to_next_class');?></label>
		                                <div class="col-sm-7">
		                                    <select name="promotion" class="form-control" style="width:100%;" id="promotion">
		                                        <option value="yes">Yes</option>
		                                        <option value="No">No</option>
		                                    	
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="form-group">
		                                <label class="col-sm-4 control-label"><?php echo get_phrase('Participate_in_NCC');?></label>
		                                <div class="col-sm-7">
		                                    <select name="ncc_value" class="form-control" style="width:100%;" >
		                                        <option value="yes">Yes</option>
		                                        <option value="No">No</option>
		                                    	
		                                    </select>
		                                </div>
		                            </div>
	                                 <div class="form-group">
		                                <label class="col-sm-4 control-label"><?php echo get_phrase('Participate_in_NCC');?></label>
		                                <div class="col-sm-7">
		                                    <select name="reason" class="form-control" style="width:100%;" id="reason">
		                                        <option value="TO STUDY ELSE WHERE">TO STUDY ELSE WHERE</option>
		                                        <option value="No"></option>
		                                    	
		                                    </select>
		                                </div>
		                            </div>
	                                <div class="form-group">
	                                    <label class="col-sm-4 control-label"><?php echo get_phrase('Application_date');?></label>
	                                    <div class="col-sm-7">
	                                        <input type="text" class="datepicker form-control" name="date"
                                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
	                                    </div>
	                                </div>

                                    <div class="form-group" style="text-align: center;">
                                        <button type="submit" class="btn btn-info"><?php echo get_phrase('Create_TC');?></button>
                                    </div>
	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>
	              	<?php echo form_close();?>

				<!-- creation of single invoice -->
					
				</div>
				
			</div>
			
			
	</div>
</div>

<script type="text/javascript">
	// function check() {
 //    	$("#selectall").click(function () {
 //    		$("input:checkbox").prop('checked', $(this).prop("checked"));
	// 	});
	// }

	function select() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = true ;
			}

		//alert('asasas');
	}
	function unselect() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = false ;
			}
	}
</script>

<script type="text/javascript">
    function get_class_students(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?school/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
    function get_class_students_mass(class_id) {
    	
        $.ajax({
            url: '<?php echo base_url();?>index.php?school/get_class_students_mass/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });

        
    }
</script>