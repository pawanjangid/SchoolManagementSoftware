<hr />
<?php echo form_open(base_url() . 'school/marks_selector');?>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get_where('class', array('school_id' =>$this->session->userdata('school_id')))->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="subject_holder">
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
				<select name="section_id" id="" class="form-control selectboxit" disabled="disabled">
					<option value=""><?php echo get_phrase('select_class_first');?></option>		
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
				<select name="subject_id" id="" class="form-control selectboxit" disabled="disabled">
					<option value=""><?php echo get_phrase('select_class_first');?></option>		
				</select>
			</div>
		</div>
		<div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled"><?php echo get_phrase('manage_marks');?></button>
			</center>
		</div>
	</div>

</div>
<?php echo form_close();?>





<script type="text/javascript">
	function get_class_subject(class_id) {
		
		$.ajax({
            url: '<?php echo base_url();?>school/marks_get_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });

	}
</script>