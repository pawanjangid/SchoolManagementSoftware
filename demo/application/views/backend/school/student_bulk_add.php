<hr />
<?php echo form_open(base_url() . 'index.php?school/student_bulk_add/add_bulk_student' , 
			array('class' => 'form-inline validate', 'style' => 'text-align:center;'));?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">
		<div class="form_group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" id="class_id" class="form-control selectboxit" required="required"
				onchange="get_sections(this.value)"  data-validate="required"  data-message-required="<?php echo get_phrase('value_required');?>">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<div id="section_holder"></div>
	<div class="col-md-3"></div>
</div>
<br><br>

<div id="bulk_add_form">
<div id="student_entry">
	<div class="row" style="margin-bottom:10px;">

		<div class="form-group">
			<input type="text" name="name[]" id="name" class="form-control" style="width: 160px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('name');?>" required>
		</div>

		<div class="form-group">
			<input type="text" name="roll[]" id="roll" class="form-control" style="width: 60px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('roll');?>">
		</div>

		<div class="form-group">
			<input type="text" name="fathername[]" id="fathername" class="form-control" style="width: 160px; margin-left: 5px;"
				placeholder="Father's Name" required>
		</div>
	
		<div class="form-group">
			<input type="text" name="mothername[]" id="mothername" class="form-control" style="width: 150px; margin-left: 5px;"
				placeholder="Mother's Name" required>
		</div>

		<div class="form-group">
			<input type="text" name="phone[]" id="phone" class="form-control" style="width: 140px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('phone');?>">
		</div>

		<div class="form-group">
			<input type="text" name="address[]" id="address" class="form-control" style="width: 240px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('address');?>">
		</div>

		<div class="form-group">
			<select name="sex[]" id="sex" class="form-control" style="width: 110px; margin-left: 5px;">
				<option value=""><?php echo get_phrase('gender');?></option>
				<option value="male"><?php echo get_phrase('male');?></option>
				<option value="female"><?php echo get_phrase('female');?></option>
			</select>
		</div>

		<div class="form-group">
			<button type="button" class="btn btn-default " title="<?php echo get_phrase('remove');?>"
					onclick="deleteParentElement(this)" style="margin-left: 10px;">
        		<i class="entypo-trash" style="color: #696969;"></i>
        	</button>
		</div>

			
	</div>

</div>


<div id="student_entry_append"></div>
<br>

<div class="row">
	<center>
		<button type="button" class="btn btn-default" onclick="append_student_entry()">
			<i class="entypo-plus"></i> <?php echo get_phrase('add_a_row');?>
		</button>
	</center>
</div>

<br><br>

<div class="row">
	<center>
		<button type="submit" class="btn btn-success" id="submit_button">
			<i class="entypo-check"></i> <?php echo get_phrase('save_students');?>
		</button>
	</center>
</div>
</div>

<?php echo form_close();?>

<script type="text/javascript">

	var blank_student_entry ='';
	$(document).ready(function() {
		//$('#bulk_add_form').hide(); 
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<7;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});

	function get_sections(class_id) {
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_sections/' + class_id ,
            success: function(response)
            {
                jQuery('#section_holder').html(response);
                jQuery('#bulk_add_form').show();
            }
        });
	}


	function append_student_entry()
	{
		$("#student_entry_append").append(blank_student_entry);
	}

	// REMOVING INVOICE ENTRY
	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}

</script>
