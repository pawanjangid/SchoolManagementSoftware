<?php
$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
$running_year       =   $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
$head       =   $this->db->get_where('settings' , array('type'=>'head'))->row()->description;

function grade($obt,$totm){
    $percentage22 = ($obt/$totm)*100;

    $grade=null;
    if ($percentage22>=86) {
        $grade="A";
    }elseif ($percentage22<86 && $percentage22>=71) {
        $grade="B";
    }elseif ($percentage22<71 && $percentage22>=51) {
        $grade="C";
    }elseif ($percentage22<51 && $percentage22>=31) {
        $grade="D";
    }elseif ($percentage22<31 ) {
        $grade="E";
    }
    return $grade;
}
function grade1($obt,$totm){
    $percentage22 = ($obt/$totm)*100;

    $grade=null;
    if ($percentage22>=81) {
        $grade="A";
    }elseif ($percentage22<81 && $percentage22>=61) {
        $grade="B";
    }elseif ($percentage22<61 && $percentage22>=41) {
        $grade="C";
    }elseif ($percentage22<41 && $percentage22>=21) {
        $grade="D";
    }elseif ($percentage22<21 ) {
        $grade="E";
    }
    return $grade;
}
function remark($grade){

    $remark=null;
    if ($grade=="A") {
        $remark="Very Good";
    }elseif ($grade=="B") {
        $remark="Good";
    }elseif ($grade=="C") {
        $remark="Average";
    }elseif ($grade=="D") {
        $remark="Bad";
    }elseif ($grade=="E") {
        $remark="Very Bad";
    }
    return $remark;
}
?>
<div id="print" style="border : 2px solid black; padding: 20px;border-radius: 20px;max-width:1080px;">
	<style type="text/css">
  td {
     padding: 5px;
 }
</style>

<center>
    <div style="max-width: 100%;">
        
        
<?php 

$logo = $this->db->get_where('school',array('school_id'=>$this->session->userdata('school_id')))->row()->image;
if($logo){
    $logo = base_url().'uploads/schools_logo/'.$logo;
}else{
    $logo = base_url().'uploads/logo.png';
}

?>
        
        <div style="float: left;"><img src="<?php echo $logo; ?>" width="180px;" alt=""></div>
        <div style="width:900px;float:right;">
            <div style="font-weight: 600;font-size: 45px;"><?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_name;?></div>
            <div style="margin-top: 10px;">
               <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_address;?>, Ph.: <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?>  
               <div>
                 
               </div>
               
            </div>
        </div>
        
    </div>

    <div style="clear: both;margin-top:30px;"></div>
</center>
<div style="clear: both;"></div>
<center><div style="background-color: #000; max-width: 200px; margin-top: -20px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">Progress Report</h4></div></center>

<div style="float: left; margin-top: -40px; margin-left: 10px; font-weight: 600;"><p>Session: <?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->year;?></p></div>
<center></center>
<table style="width:100%; border-collapse:collapse;border: 1px solid #bbb; margin-top: 10px;border-radius: 2px;" border="1">
    <tbody>
        <tr style="color: #000;">
            <td style="text-align: left;background-color: #bbb;text-transform: uppercase;">Student Name:</td>
            <td style="text-align: left;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></b></td>
            <td style="text-align: left;text-transform: uppercase;background-color: #bbb;">Date of Birth:</td>
            <td style="text-align: center;text-transform: uppercase;"><b><?php echo date('d-M-Y',$this->db->get_where('student' , array('student_id' => $student_id))->row()->birthday);?></b></td>
            <!-- <td rowspan="4" style="text-align: center;background-color: #fff; padding: 0px; width: 115px; border: 1px solid #000;"><img src="<?php echo $this->crud_model->get_image_url('student',$student_id);?>" class="" height="115" width="115" alt=""></td> -->
        </tr>
        </tr>
        <tr style="color: #000;">
            <td style="text-align: left;text-transform: uppercase; background-color: #bbb;">Father's Name:</td>
            <td style="text-align: left;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->fathername;?></b></td>
            <td style="text-align: left;text-transform: uppercase; background-color: #bbb;">SR. No.:</td>
            <td style="text-align: center;text-transform: uppercase;"><b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->srno;?></b></td>
        </tr>
        <tr style="background-color: #fff; color: #000;">
            <td style="text-align: left;text-transform: uppercase;background-color: #bbb;">Mother's Name:</td>
            <td style="text-align: left;text-transform: uppercase;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->mothername;?></b></td>
            <td style="text-align: left;text-transform: uppercase;text-transform: uppercase;background-color: #bbb;">Roll no.:</td>
            <td style="text-align: center;"><b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->roll;?></b></td>
        </tr>
        <tr style="background-color: #fff; color: #000;">
            <td style="text-align: left;text-transform: uppercase;background-color: #bbb;">Address:</td>
            <td style="text-align: left;text-transform: uppercase;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->address;?></b></td>
            <td style="text-align: left;text-transform: uppercase;background-color: #bbb;">Class:</td>
            <td style="text-align: center;text-transform: uppercase;text-transform: uppercase;"><b><?php $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->class_id;
                echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
                ?></b></td>
        </tr>
    </tbody>
</table>
<hr />
<?php $exam = $this->db->get_where('exam', array('class_id' => $class_id))->result_array(); ?>
<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
    <tbody>
        <tr style="background-color: #333; color: #fff;">
                <td style="text-align: center;">Subject</td>
                <?php $maxexammarks=0; ?>
                <?php foreach ($exam as $exam): ?>

                <td style="text-align: center;text-transform: capitalize;"><?php echo ($exam['name']." (".$exam['maxmarks'].")"); $maxexammarks+=$exam['maxmarks']?></td>
            <?php  endforeach; ?>
    		<td style="text-align: center;" >Grand Total (<?php echo $maxexammarks ?>)</td>
            <td style="text-align: center;">Grade</td>
        </tr>


        <?php $totalmoos = 0; ?>
        <?php $subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year , 'type' => 1))->result_array();
        $rowadd = 0;
        
        $totalobtained=0;
        ?>
        <?php foreach ($subjects as $subject):  ?>
            <tr style="background-color: #fff; color: #000;" id="subjects">


            <td style="text-align: left;text-transform: uppercase;"><?php  echo $subject['name'];?></td>
            <?php $exam = $this->db->order_by('exam_id','asc')->get_where('exam', array('class_id' => $class_id))->result_array(); ?>
             <?php $totalrow=0;$totalmoos = $totalmoos+$maxexammarks; ?>
            <?php foreach($exam as $row1) :?>

                <td style="text-align: center;">
                    <?php
                    $obtained_mark_query = $this->db->get_where('mark' , array(
                        'subject_id' => $subject['subject_id'],
                        'exam_id' => $row1['exam_id'],
                        'class_id' => $class_id,
                        'student_id' => $student_id , 
                        'year' => $running_year));
                        $marks = $obtained_mark_query->result_array();
                        foreach ($marks as $row4) {
                            echo $row4['mark_obtained'];
                            $totalrow+=$row4['mark_obtained'];
                            $totalobtained +=$row4['mark_obtained'];
                        
                    }
                    ?>
                </td>
               <?php endforeach; ?>
               <td style="text-align: center;"><?php echo $totalrow; ?></td>
               <td style="text-align: center;"><?php echo grade($totalrow,$maxexammarks); ?></td>
               
            </tr>

        <?php endforeach; ?>
<tr style="background-color: #ccc; color: #000;font-weight: 600;">
                <td style="text-align: center;"></td>
                <?php foreach ($exam as $exams): ?>
                <td style="text-align: center;"></td>
                <?php  endforeach; ?>
            <td style="text-align: center;" ><?php echo $totalobtained; ?></td>
            <td style="text-align: center;"><?php echo grade($totalobtained,$totalmoos); ?></td>
        </tr>
      <?php $totalmoos2 = 0; ?>
        <?php $subjects2 = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year , 'type' => 0))->result_array();
        $rowadd2 = 0;
        
        $totalobtained2=0;
        ?>
        <?php foreach ($subjects2 as $subject2):  ?>
            <tr style="background-color: #fff; color: #000;" id="subjects">


            <td style="text-align: left;text-transform: uppercase;"><?php  echo $subject2['name'];?></td>
            <?php $exam = $this->db->order_by('exam_id','asc')->get_where('exam', array('class_id' => $class_id))->result_array(); ?>
             <?php $totalrow2=0;$totalmoos2 = $totalmoos2+$maxexammarks; ?>
            <?php foreach($exam as $row1) :?>

                <td style="text-align: center;">
                    <?php
                    $obtained_mark_query = $this->db->get_where('mark' , array(
                        'subject_id' => $subject2['subject_id'],
                        'exam_id' => $row1['exam_id'],
                        'class_id' => $class_id,
                        'student_id' => $student_id , 
                        'year' => $running_year));
                        $marks = $obtained_mark_query->result_array();
                        foreach ($marks as $row4) {
                            echo $row4['mark_obtained'];
                            $totalrow2+=$row4['mark_obtained'];
                            $totalobtained2 +=$row4['mark_obtained'];
                        
                    }
                    ?>
                </td>
               <?php endforeach; ?>
               <td style="text-align: center;"><?php echo $totalrow2; ?></td>
               <td style="text-align: center;"><?php echo grade($totalrow2,$maxexammarks); ?></td>
               
            </tr>

        <?php endforeach; ?>
        <tr style="background-color: #ccc; color: #000;font-weight: 600;">
                <td style="text-align: center;"></td>
                <?php foreach ($exam as $exams): ?>
                <td style="text-align: center;"></td>
                <?php  endforeach; ?>
            <td style="text-align: center;" ><?php echo $totalobtained2; ?></td>
            <td style="text-align: center;"><?php echo grade($totalobtained2,$totalmoos2); ?></td>
        </tr>
      
    </tbody>
</table>


<br>
<div style="float: left; margin-left: 50px; margin-top:10px; margin-bottom: 30px;">
    <table style="border: 0px solid #ccc; border-collapse:collapse; float: left;" border="1">
        <tbody>
            <tr style="background-color: #333; color:#fff;">
                <td>Grade</td>
                <td>Percentage</td>
            </tr>
            <tr>
                <td>A</td>
                <td>86 to 100</td>
            </tr>
            <tr>
                <td>B</td>
                <td>71 to 85</td>
            </tr>
            <tr>
                <td>C</td>
                <td>51 to 70</td>
            </tr>
            <tr>
                <td>D</td>
                <td>31 to 50</td>
            </tr>
            <tr>
                <td>E</td>
                <td>0 to 31</td>
            </tr>
        </tbody>
    </table>
</div>
<?php $percentage = ($totalobtained/$totalmoos)*100; ?>
<div style="float: right; margin-top: 10px; margin-right: 100px;border: 1px solid #fff;">

    <table style="border: 0px solid #ccc; border-collapse:collapse; float: left; width: 135%;" border="1">
        <tbody>
            <tr style="background-color: #333; color:#fff; text-align: center;">
                <td colspan="2">Final Result</td>
            </tr>
            <tr>
                <td>Result:</td>
                <td><b><?php if ($percentage>=36) { $result="Pass"; }else {  $result="Fail"; } echo $result; ?></b></td>
            </tr>
            <tr>
                <td>Obtain Marks:</td>
                <td><b><?php echo $totalobtained ."</b> Out of: <b>".$totalmoos ?> </b></td>
            </tr>
            <tr>
                <td>Percentage:</td>
                <td><b><?php echo round($percentage,2); ?> %</b></td>
            </tr>
            <tr>
                <td>Division:</td>
                <td><b>
                  <?php  if(round($percentage,2) >= 60)
                            echo "FIRST DIVISION";
                            elseif ((round($percentage,2) < 60)&&(round($percentage,2) >= 45)) {
                                 echo "SECOND DIVISION";
                             }
                             elseif ((round($percentage,2) < 45)&&(round($percentage,2) >= 36)) {
                                 echo "THIRD DIVISION";
                             }else
                             echo " "; ?>
                </b>
                </td>
            </tr>
            <tr>
                <td>Rank:</td>
                <td><b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->rank;?></b> Out of: <b><?php $sql = "SELECT `class_id` FROM `enroll` WHERE class_id=$class_id"; $query = $this->db->query($sql); echo $query->num_rows(); ?></b></td>
            </tr>
            <tr>
                <td>Grade:</td>
                <td><b><?php echo grade($totalobtained,$totalmoos); ?></b></td>
            </tr>
            <tr>
<?php $attendence = $this->db->get_where('attendance',array('class_id'=>$class_id,'year'=>$running_year,'student_id'=>$student_id))->num_rows(); ?>
                
                
                
                <td>Attendance:</td>
                <td><b><?php echo $attendence; ?></b></td>
            </tr>
            <!--<tr>-->
            <!--    <td>Discipline:</td>-->
            <!--    <td><select style="border: #fff; max-width: 80px;font-weight: 600;-webkit-appearance:none;-moz-appearance: none;">-->
            <!--    	<option value="Better">Excellent</option>-->
            <!--    	<option value="Very Good">Very Good</option>-->
            <!--    	<option value="Good">Good</option>-->
            <!--    	<option value="Normal">Normal</option>-->
            <!--    	<option value="Satisfactory">Satisfactory</option>-->
            <!--    	<option value="Weak">Weak</option>-->
            <!--    </select></td>-->
            <!--</tr>-->
        </tbody>
    </table>

</div>

    <div style="clear: both;"></div>
    <div style="float: left; margin-left: 30px;margin-top: 20px;">Class Teacher</div>

    <center><div style="margin-right: 50px;margin-top: 20px;"><?php echo $head; ?></div></center>
<hr>
<center>
    <div style="width: 100%;"><div class="form-group">Result Decleration Date: <input type="text" value="<?php echo date('d-m-Y'); ?>" style="border: #fff;font-weight: 600;"></div>
    </div>
</center>
<div style="clear: both;"></div>

</div>

<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});



    function PrintElem(elem)
    {
        //Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        //mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //mywindow.document.write('<style>.print{border : 1px;}</style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>