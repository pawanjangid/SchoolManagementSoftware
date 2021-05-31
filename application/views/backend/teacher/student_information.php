<?php
$school_id = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->row()->school_id;
$running_year = $this->db->get_where('school' , array('school_id' => $school_id))->row()->running_year;
?>

<hr />

<a href="<?php echo base_url();?>index.php?teacher/student_add"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_student');?>
    </a>


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
            $query = $this->db->get_where('section' , array('class_id' => $class_id,'school_id' => $school_id));
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
                                    'class_id' => $class_id,'school_id' => $school_id,'year' => $running_year
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
                                                <a href="<?php echo base_url();?>index.php?school/student_add" class="btn btn-success">Add Student</a></h2></li>
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
                    <div style="height: 80%;border : 2px black;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id'];?>');">
                        <div style="height: 80%;">
                    <img style="border-radius: 10px;" src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-squre" width="100%" height='100%'/>
                   </div>
                   
                    </div>
                   
                    
                <div style="margin-top: -50px;">
                     <h1 style="text-overflow: ellipsis;overflow: hidden;white-space:pre"><?php 
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->name;
                                ?></h1>

                    <?php if ($row['tc_status'] == '1') {
                            echo '<h5 style="color:red;">TC Generated</h5>';
                        } ?>
                   <div class="row">
                    <p style="text-overflow: ellipsis;overflow: hidden;white-space:pre" class="col-sm-10">S/O:- <?php 
                                    echo $this->db->get_where('student' , array(
                                        'student_id' => $row['student_id']
                                    ))->row()->fathername;
                                ?></p>
                   <div class="btn-group" style="float: right;">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bars" style="color:green;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                       
                                        
                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>

                                        <!-- STUDENT MARKSHEET LINK  -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php?teacher/student_marksheet/<?php echo $row['student_id'];?>">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
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
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>