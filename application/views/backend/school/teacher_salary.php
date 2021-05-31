<?php
$teacher_payment	=	$this->db->get_where('payment' , array(
    'teacher_id' => $teacher_id , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->description
    ))->result_array();
$teacher_info = $this->db->get_where('teacher',array('teacher_id' => $teacher_id))->result_array();
?>
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_teacher_salary');" 
              class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
              <?php echo get_phrase('add_teacher_salary');?>
                </a> 




<hr />
        <div class="row" style="height: 200px;">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0" style="height: 100px;">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-info"></i>
                            <?php echo get_phrase('Get Salary info');?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Select Teacher');?></label>
                        <div class="col-sm-3">
                            <select name="teacher_id" class="form-control selectboxit" required onchange="get_teacher_salary(this.value);">
                                <option value=""><?php echo get_phrase('select_teacher');?></option>
                                <?php 
                                    $teacher = $this->db->get('teacher')->result_array();
                                    foreach ($teacher as $row):
                                ?>
                                <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                </div>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div id="subject_holder" name="subject_holder">
        
    </div>
</div>


 
<script type="text/javascript">
    
    function get_teacher_salary(teacher_id) {
        //var cat = document.getElementById('expense_category_id').value;
    $.ajax({
            url: '<?php echo base_url();?>school/get_teacher_salary/' + teacher_id,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>
  
