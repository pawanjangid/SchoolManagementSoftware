<hr />
<?php echo $running_year; ?>
<?php echo form_open(base_url() . 'index.php?school/attendance_selector/');?>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get_where('class', array('school_id' =>$this->session->userdata('school_id')))->result_array();
					foreach($classes as $row):
                                            
				?>
                                
				<option value="<?php echo $row['class_id'];?>"
					><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>

	
    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_class_first') ?></option>
				
			</select>
		</div>
	</div>
    </div>
	
        <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $this->db->get_where('school', array('school_id' => $this->session->userdata('school_id')))->row()->running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_attendance');?></button>
	</div>

</div>
<?php echo form_close();?>

<script type="text/javascript">
    function select_section(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?school/get_section/' + class_id,
            success:function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }
</script>