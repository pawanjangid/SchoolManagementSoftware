<?php
$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
$system_name        =	$this->db->get_where('school' , array('school_id'=> $this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school_id'=> $this->session->userdata('school_id')))->row()->running_year;

?>
<div id="printarea">
<center>
<div style=" margin-left: 20px;"><img src="uploads/header2.jpg" height="100px;" alt=""></div>
</center>
<center>
    <div style="margin-top: 10px;">
       <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_address;?><br><p style="margin-top: 5px;">Ph.: <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?></p>
    </div>
</center>
<div style="clear: both;"></div>
<center><div style="background-color: #000; max-width: 300px; margin-top: -0px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">CHARACTER CERTIFICATE</h4></div></center>
<center>                
<div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">
    <p style="word-spacing: 2px;">
        It is declared that Mr./Miss&nbsp;<b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></b> s/o. <b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->fathername;?></b> SR No. <b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->srno;?></b>, whose date of birth is <b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->birthday;?></b>. He/She is a student from <b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->date_of_admission;?></b> to <b><?php echo date('d-m-y');?></b> at this school. During this session his/her work and behaviour is remained <select id="behaviour" style="border: #fff;min-width: 80px; max-width: 180px;font-size: 20px;-webkit-appearance:none;-moz-appearance: none;text-decoration: underline; " onfocusout="behaviour(this.value);">
                    <option value="Excellent">Excellent</option>
                    <option value="Very Good">Very Good</option>
                    <option value="Good">Good</option>
                    <option value="Normal">Normal</option>
                </select><b id="behaviouradd" style="text-decoration: underline;"></b> ,and he/she is declared <select id="result" style="font-size: 20px;border: #fff; max-width: 80px;-webkit-appearance:none;-moz-appearance: none;text-decoration: underline; " onfocusout="result(this.value);">
                    <option value="Pass">Pass</option>
                    <option value="Fail">Fail</option>
                </select><b id="resultadd"></b> in class &nbsp;<?php $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->class_id;
                echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; ?> &nbsp; in <input
                id="year" type="text" value="<?php echo date('Y'); ?>" style="border: #fff;font-weight: 600;width: 50px;font-size: 20px;" onfocusout="year(this.value);" /><b id="yearadd"></b>.

    </p>
    <p>As far as I know, his/her moral character is excellent. I wish for his/her successful future life.  </p>
    <br><br><br>
    <p style="float: left;">Date:<?php echo date('d-m-y'); ?></p>
    <p style="float: right;">Principal Signature</p>
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