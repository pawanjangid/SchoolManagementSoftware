<?php echo form_open(base_url() . 'index.php?school/change_session' , array('id' => 'session_change'));?>
<li>
	
	<div class="form-group">
		<select name="running_year" class="form-control" onchange="submit()">
		  	<?php $running_year = $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;?>
		  	<option value=""><?php echo get_phrase('select_running_session');?></option>
		  	<?php for($i = 0; $i < 10; $i++):?>
		      	<option value="<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>"
		        <?php if($running_year == (2016+$i).'-'.(2016+$i+1)) echo 'selected';?>>
		          	<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>
		      	</option>
		  <?php endfor;?>
		</select>
	</div>
	
	
</li>
<?php echo form_close();?>



<script type="text/javascript">

    function submit()
    {
    	$('#session_change').submit();
    }
	
</script>