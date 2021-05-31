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
					<?php echo get_phrase('Import_Student_Data');?>
            	</div>
            </div>
          

			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?school/import_student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	

					
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
	                    <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
	                    <div class="col-sm-5">
	                        <input type="file" name="file_name" class="form-control inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
	                               data-validate="required" data-message-required="<?php echo get_phrase('required'); ?>"/>
	                    </div>
	                </div>
					

					<input type="hidden" name="year" value="<?php echo $this->db->get_where('school', array('school_id'=>$this->session->userdata('school_id')))->row()->running_year; ?>">
					

                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Load_Data');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

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