<?php $running_year = $this->db->get_where('school',array('school_id' => $this->session->userdata('school_id')))->row()->running_year; ?>
<div class="col-md-3">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Exam');?></label>
		<select name="exam_id" id="exam_id" class="form-control selectboxit">
			<?php 
				$exams = $this->db->get_where('exam' , array(
					'class_id' => $class_id,'school_id' => $this->session->userdata('school_id')))->result_array();
				foreach($exams as $row):
			?>
			<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
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