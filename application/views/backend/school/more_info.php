<?php
$student_info	=	$this->db->get_where('enroll' , array(
    'student_id' => $student_id,'school_id' => $this->session->userdata('school_id') , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year
    ))->result_array();
foreach($student_info as $row):?>

<div class="profile-env col-sm-6">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h2>
                                <?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?>                     
                            </h2>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                
                    <?php if($row['class_id'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('class');?></td>
                        <td><b><?php echo $this->crud_model->get_class_name($row['class_id']);?></b></td>
                    </tr>
                    <?php endif;?>

                    <?php if($row['section_id'] != '' && $row['section_id'] != 0):?>
                    <tr>
                        <td><?php echo get_phrase('section');?></td>
                        <td><b><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['roll'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('roll');?></td>
                        <td><b><?php echo $row['roll'];?></b></td>
                    </tr>

                    <?php endif;?>
                    <tr>
                        <td><?php echo get_phrase('SR No.');?></td>
                        <td><b><?php echo $row['srno'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Father_name');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->fathername;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Mother Name');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->mothername;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('birthday');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->birthday;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('gender');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->sex;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Category');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->category;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('phone');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('address');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->address;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Print Marksheet');?></td>
                        <td><div>
              	<a href="<?php echo base_url();?>school/student_marksheet_print_view/<?php echo $row['student_id'];?>" target="_blank" class="btn btn-info" >Print Marksheet</a>
              </div></td>
                    </tr>
                    
                   
                    <tr>
                        <td><?php echo get_phrase('Charactor Certificate');?></td>
                        <td>
                            <a target="_blank" href="<?php echo base_url();?>school/charactor/<?php echo $row['student_id'];?>">
                                                <i class="entypo-vcard"></i>
                                                    <?php echo get_phrase('Charactor_Certificate');?>
                                                </a>
                        </td>
                    </tr>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>

<?php endforeach;?>
<div style="clear: both"></div>