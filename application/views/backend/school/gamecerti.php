<?php
$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
$system_name        =	$this->db->get_where('school' , array('school'=>$this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school'=>$this->session->userdata('school_id')))->row()->running_year;

?>
<div id="printarea">
<center>
<div style=" margin-left: 20px;"><img src="uploads/header2.jpg" height="100px;" alt=""></div>
</center>
<center>
    <div style="margin-top: 10px;">
       <?php echo $this->db->get_where('school' , array('school' =>$this->session->userdata('school_id')))->row()->school_name;?><br><p style="margin-top: 5px;">Ph.: <?php echo $this->db->get_where('school' , array('school' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?></p>
    </div>
</center>
<div style="clear: both;"></div>
<center><div style="background-color: #000; max-width: 300px; margin-top: -0px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">CERTIFICATE</h4></div></center>
<center>                
<div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">
    <p style="word-spacing: 2px;">
        It is certified that Mr./Miss&nbsp;<b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></b> s/o. <b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->fathername;?></b> Class <b><?php $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->class_id;
                echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; ?></b>of this school, remained student for session <b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->year;?></b>. In this duration he/she, actively participated in sports and sports competition conducted by school.<br>
                The special description of these games is given in the following table.<br>
                <table width="100%">
                    <tr style="margin-top: 20px;">
                        <td>1. <b>Kho-Kho</b></td>
                        <td>.....................</td>
                        <td>2. <b>Kabaddi</b></td>
                        <td>.....................</td>
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td>3. <b>Cricket</b></td>
                        <td>.....................</td>
                        <td>4. <b>Badminton</b></td>
                        <td>.....................</td>
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td>5. <b>Table-Tennis</b></td>
                        <td>.....................</td>
                        <td>6. <b>Football</b></td>
                        <td>.....................</td>
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td>7. <b>Basket-Ball</b></td>
                        <td>.....................</td>
                        <td>8. <b>Volley Ball</b></td>
                        <td>.....................</td>
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td>9. <b>Hockey</b></td>
                        <td>.....................</td>
                        <td>10. <b>Atheletics</b></td>
                        <td>.....................</td>
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td colspan="4">11. <b>Interschool</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;position in competition &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        
                    </tr>
                    <tr style="margin-top: 20px;">
                        <td colspan="4">12. Participation and position in the sports competiton of regional, district and state level <br><br><br></td>
                        
                    </tr>

                </table>


    </p>
    <br><br><br>
    <p style="float: left;">Principal</p>
    <p style="float: right;">Coordinator</p>
</div>
</center>
</div>
<div style="clear: both;"></div>

</div>
<div style="text-align: center;">
    <button id="btn" onclick="printFunc();" >Print</button>
</div>
<script type="text/javascript">
    function behaviour(value) {
        var beh = document.getElementById('behaviour');
        var behadd = document.getElementById('behaviouradd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function result(value) {
        var beh = document.getElementById('result');
        var behadd = document.getElementById('resultadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function year(value) {
        var beh = document.getElementById('year');
        var behadd = document.getElementById('yearadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
</script>
<script type="text/javascript">
    function printFunc() {
    var divToPrint = document.getElementById('printarea');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
    }
</script>