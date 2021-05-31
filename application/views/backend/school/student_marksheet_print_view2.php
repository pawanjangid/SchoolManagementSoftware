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
<div id="print" style="border : 2px solid black; padding: 20px;border-radius: 20px;max-width:1080px;background-color : #fffd73;">
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
        
        <div style="float: left;max-width:100px;"><img src="<?php echo $logo; ?>" width="100%" alt=""></div>
        <div style="width:980px;">
            <div style="font-weight: 600;font-size: 45px;text-transform:uppercase;"><?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_name;?></div>
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

<div style="background-color: white;border:1px solid black;">
  <center><div style="border-radius: 5px;margin-top:20px;padding:20px;"><h1 style="text-decoration: underline; color: #000; padding: 5px;text-transform:uppercase;">Progress Report</h1></div>
  <div style="margin-top: -60px; margin-left: 10px; font-weight: 600;"><h3>Session: <?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->year;?></h3></div>
  </center>
<div style="width:100%;background-color:#bdbdbb;">
    <center><h3 style="padding:5px;">STUDENT PROFILE</h3></center>
</div>
<table style="width:100%; border-collapse:collapse; margin-top: 10px;">
    <tbody>
        <tr style="color: #000;">
            <td rowspan="4" style="max-width:100px;">
                <center><img src="<?php echo $this->crud_model->get_image_url('student',$student_id);?>" style="max-width:100%;"></center>
            </td>
            <td style="text-align: left;text-transform: uppercase;">Student Name:</td>
            <td style="text-align: left;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></b></td>
            <td style="text-align: left;text-transform: uppercase;">Date of Birth:</td>
            <td style="text-align: center;text-transform: uppercase;"><b><?php echo date('d-M-Y',$this->db->get_where('student' , array('student_id' => $student_id))->row()->birthday);?></b></td>
            </tr>
        </tr>
        <tr style="color: #000;">
            <td style="text-align: left;text-transform: uppercase;">Father's Name:</td>
            <td style="text-align: left;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->fathername;?></b></td>
            <td style="text-align: left;text-transform: uppercase;">SR. No.:</td>
            <td style="text-align: center;text-transform: uppercase;"><b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->srno;?></b></td>
        </tr>
        <tr style="background-color: #fff; color: #000;">
            <td style="text-align: left;text-transform: uppercase;">Mother's Name:</td>
            <td style="text-align: left;text-transform: uppercase;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->mothername;?></b></td>
            <td style="text-align: left;text-transform: uppercase;text-transform: uppercase;">Roll no.:</td>
            <td style="text-align: center;"><b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->roll;?></b></td>
        </tr>
        <tr style="background-color: #fff; color: #000;">
            <td style="text-align: left;text-transform: uppercase;">Address:</td>
            <td style="text-align: left;text-transform: uppercase;text-transform: uppercase;"><b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->address;?></b></td>
            <td style="text-align: left;text-transform: uppercase;">Class:</td>
            <td style="text-align: center;text-transform: uppercase;text-transform: uppercase;"><b><?php $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->class_id;
                echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
                ?></b></td>
        </tr>
    </tbody>
</table>  
</div>


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
            <td style="text-align: center;color:#000;" ><?php echo $totalobtained; ?></td>
            <td style="text-align: center;color:#000;"><?php echo grade($totalobtained,$totalmoos); ?></td>
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
            <td style="text-align: center;color:#000;" ><?php echo $totalobtained2; ?></td>
            <td style="text-align: center;color:#000;"><?php echo grade($totalobtained2,$totalmoos2); ?></td>
        </tr>
      
    </tbody>
</table>


<br>
<div style="background-color:#bfbfbf;padding:10px;border:1px solid black;">
    8 Point Grade Scale : A (86 to 100), B (71 to 85), C (51 to 70), D (31 to 50), E (31 And Below)
</div>
<div style="float: left; margin-left: 50px; margin-top:10px; margin-bottom: 30px;">
    
</div>
<?php $percentage = ($totalobtained/$totalmoos)*100; ?>
<div style="float: right; margin-top: 10px; margin-right: 100px;border: 1px solid #fff;">

    <table style="border: 0px solid #ccc; border-collapse:collapse; float: left; width: 135%;background-color:#fff;" border="1">
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
        </tbody>
    </table>

</div>

    <div style="clear: both;"></div>


  <div style="margin-left: 50px;margin-top: 20px;">Authorized</div>
<hr>

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