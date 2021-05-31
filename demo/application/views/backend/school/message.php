<hr />
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#unpaid" data-toggle="tab">
                    <span class="hidden-xs"><?php echo "Single Student";?></span>
                </a>
            </li>
            <li>
                <a href="#paid" data-toggle="tab">
                    <span class="hidden-xs"><?php echo "Classwise Students";?></span>
                </a>
            </li>
            <li>
                <a href="#paid22" data-toggle="tab">
                    <span class="hidden-xs"><?php echo "All Classes(Complete School)";?></span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <br>
            <div class="tab-pane active" id="unpaid">

                <!-- creation of single invoice -->
                <?php echo form_open(base_url() . 'index.php?school/message/single' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo "Student Detail";?></div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                    <div class="col-sm-9">
                                        <select name="class_id" class="form-control selectboxit"
                                        onchange="return get_class_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                        <?php 
                                        $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
                                        foreach ($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                                <div class="col-sm-9">
                                    <select name="Contact_number" class="form-control" style="width:100%;" id="student_selection_holder">
                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default panel-shadow" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title"><?php echo "Type SMS Here..";?></div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="smstext"
                                    placeholder="Enter Message here"
                                    data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" style="min-height: 150px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo "Send SMS"?></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
            <!-- creation of single invoice -->
        </div>
        <div class="tab-pane" id="paid">
            <!-- creation of mass invoice -->
            <?php echo form_open(base_url() . 'index.php?school/message/bulk_sms' , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        <div class="col-sm-9">
                            <select name="class_id" class="form-control selectboxit"
                            onchange="return get_class_students_mass(this.value)">
                            <option value=""><?php echo get_phrase('select_class');?></option>
                            <?php 
                            $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo "Type SMS Here..";?></label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" name="Bulk_SMS"
                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" style="min-height: 200px;"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                        <button type="submit" class="btn btn-info"><?php echo "Send SMS to All";?></button>
                    </div>
                </div>



            </div>
            <div class="col-md-6">
                <div id="student_selection_holder_mass"></div>
            </div>
        </div>
        <?php echo form_close();?>

        <!-- creation of mass invoice -->

    </div>

    <div class="tab-pane" id="paid22">

        <!-- creation of whole school sms -->

        <?php echo form_open(base_url() . 'index.php?school/message/whole_sms' , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="form-group">
                <label class="col-sm-1 control-label"><?php echo "Type SMS Here..";?></label>
                <div class="col-sm-7">
                    <textarea type="text" class="form-control" name="Whole_SMS"
                    data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" style="min-height: 200px;"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-5 col-sm-offset-4">
                    <button type="submit" class="btn btn-info"><?php echo "Send SMS to All";?></button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close();?>

    <!-- creation of whole school sms -->
</div>
</div>
</div>
</div>

<script type="text/javascript">
    // function check() {
 //     $("#selectall").click(function () {
 //         $("input:checkbox").prop('checked', $(this).prop("checked"));
    //  });
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
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
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
            url: '<?php echo base_url();?>index.php?admin/get_class_students_mass/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });

        
    }
</script>