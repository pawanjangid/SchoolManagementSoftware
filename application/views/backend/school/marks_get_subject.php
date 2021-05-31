<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<?php 
				$sections = $this->db->get_where('section' , array(
					'class_id' => $class_id,'school_id' => $this->session->userdata('school_id')))->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Exam');?></label>
		<select name="exam_id" id="exam_id" class="form-control selectboxit">
			<?php 
			$exams = $this->db->get_where('exam' , array('class_id' => $class_id,'school_id' => $this->session->userdata('school_id')))->result_array();
				foreach($exams as $row):
			?>
			<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
		<select name="subject_id" id="subject_id" class="form-control selectboxit">
			<?php 
				$subjects = $this->db->get_where('subject' , array(
					'class_id' => $class_id,'school_id' => $this->session->userdata('school_id') , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year
				))->result_array();
				foreach($subjects as $row):
			?>
			<option value="<?php echo $row['subject_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="col-md-2" style="margin-top: 20px;">
	<center>
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_marks');?></button>
	</center>
</div>


<script type="text/javascript">
	$(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
		{
			$("select.selectboxit").each(function(i, el)
			{
				var $this = $(el),
					opts = {
						showFirstOption: attrDefault($this, 'first-option', true),
						'native': attrDefault($this, 'native', false),
						defaultText: attrDefault($this, 'text', ''),
					};
					
				$this.addClass('visible');
				$this.selectBoxIt(opts);
			});
		}
    });
	
</script>