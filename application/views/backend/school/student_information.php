<?php
$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
?>

<hr />

<a href="<?php echo base_url();?>school/student_add"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_student');?>
    </a>
    <?php $query = $this->db->get_where('section' , array('class_id' => $class_id,'school_id' => $this->session->userdata('school_id')))->result_array();  

foreach ($query as $rows): ?>
    <a href="<?php echo base_url();?>school/rankcalculate/<?php echo $class_id . '/' . $rows['section_id']; ?>"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('Rank S : ' . $rows['name']);?>
    </a>
<?php 
endforeach;
?>

<br>
<div class="row">
    <div class="col-md-12">
        
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
                </a>
            </li>
        <?php 
            $query = $this->db->get_where('section' , array('class_id' => $class_id,'school_id' => $this->session->userdata('school_id')));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
        ?>
            <li>
                <a href="#<?php echo $row['section_id'];?>" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('section');?> <?php echo $row['name'];?> ( <?php echo $row['nick_name'];?> )</span>
                </a>
            </li>
        <?php endforeach;?>
        <?php endif;?>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <?php 
                                $student   =   $this->db->get_where('enroll' , array(
                                    'class_id' => $class_id,'school_id' => $this->session->userdata('school_id'),'year' => $running_year
                                ));
                                $students=$student->result_array(); ?>
                                <?php 
                                if ($student->num_rows() < 1): ?>
                                    <div class="tile-stats" style="background: #ced1ff;color: #7ca4f4;margin-top: 40px;">
                                        <h1 style="color: #606af7;">Student Not Available (why?? - <i class="fa fa-meh-o" style="color: red;"></i>)</h1>
                                        
                                        <ol>
                                            <li>Student Not Enrolled to year <?php echo $running_year; ?>.</li>
                                            <li>Student not reguter to portal.</li>
                                            <li>student not promoted to this running session.</li>
                                            <li>Please change your current session.<h2 style="color: #467087;">Just click on Running session at top to change it to your current year.</h2></li>
                                            <li><h2>Other Wise to add new student Click On this Button
                                                <a href="<?php echo base_url();?>school/student_add" class="btn btn-success">Add Student</a></h2></li>
                                        </ol>

                                    </div>
                                <?php endif; ?>
                <?php 
                                foreach($students as $row):?>
        <div class="col-md-2 shadow" style="border:1px solid white;margin: 0px;<?php if ($row['tc_status'] == '1') {
           echo 'background-color: rgba(255, 0, 0,0.3);border-radius: 5px;';
        }else {
            echo 'background-color: rgba(0, 255, 98,0.3);border-radius: 5px;';
        } ?>" >   
                <div style="height: 250px;margin-top: 30px;">
                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_student_profile/<?php echo $row['student_id'];?>');">
                    <div style="height: 80%;border : 2px black;" >
                        <div style="height: 80%;">
                    <img style="border-radius: 10px;" src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-squre" width="100%" height='100%'/>
                   </div>
                   
                    </div>
                   </a>
                    
                <div style="margin-top: -50px;">
                     <h3 style="text-overflow: ellipsis;overflow: hidden;white-space:pre"><?php 
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->name;
                                ?></h3>

                    <?php if ($row['tc_status'] == '1') {
                            echo '<h5 style="color:red;">TC Generated</h5>';
                        } ?>
                   <div class="row">
                    <p style="text-overflow: ellipsis;overflow: hidden;white-space:pre" class="col-sm-10">S/O:- <?php 
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->fathername;
                                ?></p>
                   <div class="btn-group" style="float: right;margin-right:5px;margin-top:-10px;">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bars" style="color:green;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                       
                                        
                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_student_profile/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>

                                        <!-- STUDENT MARKSHEET LINK  -->
                                        <li>
                                            <a href="<?php echo base_url();?>school/student_marksheet/<?php echo $row['student_id'];?>">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                                </a>
                                        </li>
                                        <!-- student charactor certificate -->
                                        <li>
                                            <a href="<?php echo base_url();?>school/charactor/<?php echo $row['student_id'];?>">
                                                <i class="entypo-vcard"></i>
                                                    <?php echo get_phrase('charactor_Certi.');?>
                                                </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>school/feescerti/<?php echo $row['student_id'];?>">
                                                <i class="entypo-credit-card"></i>
                                                    <?php echo get_phrase('Fees_Certificate');?>
                                                </a>
                                        </li>
                                        <!--<li>-->
                                        <!--    <a href="<?php echo base_url();?>school/gamecerti/<?php echo $row['student_id'];?>">-->
                                        <!--        <i class="entypo-vcard"></i>-->
                                        <!--            <?php echo get_phrase('Games_Certificate');?>-->
                                        <!--        </a>-->
                                        <!--</li>-->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_take_payment/<?php echo $row['enroll_id'];?>');">
                                            <i class="entypo-bookmarks"></i>
                                            <?php echo get_phrase('take_payment');?>
                                        </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_view_invoice/<?php echo $row['enroll_id'];?>');">
                                            <i class="entypo-credit-card"></i>
                                            <?php echo get_phrase('view_invoice');?>
                                        </a>
                                        </li>
                                        
                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>

                                        <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>school/student/<?php echo $row['class_id'];?>/delete/<?php echo $row['student_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                    </li>
                                    </ul>
                                </div>
                     </div>
                   </div>
                   
                </div>
                </div>
<?php endforeach;?>
             
        
            
        
    </div>
</div>

</div>
</div>                