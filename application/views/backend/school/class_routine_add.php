<hr />
<div class="row">
	<div class="col-md-12">
		
		<?php echo form_open(base_url() . 'school/class_routine/create' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                <div class="col-sm-5">
                    <select name="class_id" class="form-control selectboxit" style="width:100%;"
                        onchange="return get_class_section_subject(this.value)">
                        <option value=""><?php echo get_phrase('select_class');?></option>
                        <?php 
                        $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div id="section_subject_selection_holder"></div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('day');?></label>
                <div class="col-sm-5">
                    <select name="day" class="form-control selectboxit" style="width:100%;">
                        <option value="sunday">sunday</option>
                        <option value="monday">monday</option>
                        <option value="tuesday">tuesday</option>
                        <option value="wednesday">wednesday</option>
                        <option value="thursday">thursday</option>
                        <option value="friday">friday</option>
                        <option value="saturday">saturday</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_start" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_start_min" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('minutes');?></option>
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="starting_ampm" class="form-control selectboxit">
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('ending_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_end" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_end_min" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('minutes');?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control selectboxit">
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                </div>
            </div>
        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class_routine');?></button>
              </div>
            </div>
    <?php echo form_close();?>

	</div>
</div>


<script type="text/javascript">
    function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>school/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
    }
</script>