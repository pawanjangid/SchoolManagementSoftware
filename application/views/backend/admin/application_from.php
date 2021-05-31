<?php
$student_info	=	$this->db->get_where('enroll' , array(
    'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
    ))->result_array();
foreach($student_info as $row):?>
<style type="text/css">
    table {
    border-collapse: collapse;
}

td {
    padding-top: .5em;
    padding-bottom: .5em;
}
</style>

<div id="print">
<center>
<div style=" margin-left: 20px;"><img src="uploads/header.jpg" width="100%" height="130px;" alt=""></div>
</center>
<center>
    <div style="margin-top: 10px;">
       <?php echo $this->db->get_where('settings' , array('type' =>'school_address'))->row()->description;?><br>Ph.: <?php echo $this->db->get_where('settings' , array('type' =>'school_contact_no'))->row()->description;?>
    </div>
</center>
<div style="clear: both;"></div>
<center>
            <div style="width: 100%;">
                <div style="float: left; width: 100px;height: 120px;border:1px solid black;" border="1">
                    <p style="font-size: 10px; text-decoration: underline;">for office use only</p>
                    <p style="font-size: 10px;text-align: left;">Class : </p>
                    <p style="font-size: 10px;text-align: left;">Reg. No:</p>
                    <p style="font-size: 10px;text-align: left;">Ad. Dt.</p>
                    <center style="font-size: 8px;margin-top: 20px;">Principle</center>
                </div>
                <div style="float: right; width: 100px;height: 120px; border:1px solid black;" border="1">
                    <img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" />
                </div>
                        <center>
                             <div style="background-color: #000; max-width: 250px; margin-top: -0px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">APPLICATION FORM</h4>
                            </div>
                        </center>
            </div> 
            <div style="margin-top: 10px;">
                Session :
           <?php echo $this->db->get_where('settings' , array('type' =>'running_year'))->row()->description;?><br>
        </div>
        <div>
            <p>Class : <?php echo $this->crud_model->get_class_name($row['class_id']);?> &nbsp;&nbsp;Section : <?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></p>
        </div>
    </center>
<div style="clear: both;"></div>
    <table style="width: 100%">
        <tr>
            <td>1.</td>
            <td>Name :</td>
            <td colspan="3"><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->name;?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Father's Name :</td>
            <td><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->fathername;?></td>
            <td>Education</td>
            <td>.............</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Mother's Name :</td>
            <td><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->mothername;?></td>
            <td>Education</td>
            <td>.............</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Guardian :</td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Religion : </td>
            <td></td>
            <td>Cast :</td>
            <td><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->category;?></td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Address : </td>
            <td colspan="3"><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->address;?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Occupation : </td>
            <td>.............</td>
            <td>Tel.(Mob)</td>
            <td><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->phone;?></td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Promoted to Class : </td>
            <td colspan="3">.............</td>
            <td></td>
            <td></td>
        </tr>
        
        <tr>
            <td>9.</td>
            <td>Date of Birth : </td>
            <td colspan="3"><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->birthday;?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>10.</td>
            <td style="font-size: 12px;">Age at the time of admission : </td>
            <td colspan="3"><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->birthday;?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>11.</td>
            <td style="font-size: 12px;">School last attended(if any) : </td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>12.</td>
            <td style="font-size: 12px;">Reference (if any) : </td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>13.</td>
            <td style="font-size: 12px;">Attach Document : </td>
            <td colspan="3">(A) Transfer Certificate of the school previously attended.<br>(B) Marks sheet of preceding class.<br> (C) Proof in support of date of birth/Birth Certificate</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Note :</td>
            <td colspan="4">Date of birth once enterd in the record of the school shall not be changed in any circumstances.</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div style="width: 100%; border: 1px solid black;">
        <center><p>ONLY FOR XI &AMP; XII CLASSES :(Attach the original document with Application From)</p></center>
        <table style="width: 100%;">
            <tr>
                <td style="width:100px;"><b>Faculty Opted :</b></td>
                <td>Art : </td>
                <td style="width: 80px;"><div style="width: 100%;height: 20px;border: 1px solid black;"></div></td>
                <td>Commerce : </td>
                <td style="width: 80px;"><div style="width: 100%;height: 20px;border: 1px solid black;"></div></td>
                <td>Science : </td>
                <td style="width: 80px;"><div style="width: 100%;height: 20px;border: 1px solid black;"></div></td>
            </tr>
            <tr>
                <td style="width:100px;"><b>Subject :</b></td>
                <td colspan="2">(A) Compulsary</td>
                <td>(1) Hindi</td>
                <td>(2) English</td>
                <td colspan="2">(3) Computer Science</td>
                
            </tr>
            <tr>
                <td style="width:100px;"></td>
                <td colspan="2">(B)</td>
                <td>(1)</td>
                <td>(2)</td>
                <td colspan="2">(3)</td>
                
            </tr>
        </table>
    </div>
<center>DECLARATION</center>
<P style="font-size: 10px;">I want to get my son/daughter admitted to your school. I clearly understand that the admission in the school is subect to fitness after the tests. I undertake the reponsibility to deposit all school wihtin stipulated period. If i an found defaulter, I shall abide by the school rules. I shall be sincere n attending parent-teacher meets whenever convened by the school. I do understand and accept that the decision of the principal shall be final and binding on disciplinary and promotion malters.</P>
<br>
<div style="float: right;">
    Signature of parent/Guardian
</div>
<div style="clear: both;"></div>
<center>FOR OFFICE USE</center>
<div style="float: left; width: 200px;">
    <table>
        <tr>
            <td>S.R. No</td>
            <td>.................</td>
            
        </tr>
        <tr>
            <td>Date of adm :</td>
            <td>.................</td>
        </tr>
        <tr>
            <td>R. No</td>
            <td>.................</td>
        </tr>
    </table>
</div>
<div style="float: right; width: 200px;">
    remarks : ..................<br>
    ..................................<br>
    ..................................<br>
</div>
<br><br><br><br><br><br><br><br>
<br><br>

<div class="profile-env">
	

	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                
                    <?php if($row['class_id'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('Name');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->name;?></b></td>
                    </tr>
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
                        <td><?php echo get_phrase('email');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('address');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->address;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Nationality');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->nationality;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('parent');?></td>
                        <td>
                            <b>
                                <?php 
                                    $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->name;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('parent_phone');?></td>
                        <td><b><?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;?></b></td>
                    </tr>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>