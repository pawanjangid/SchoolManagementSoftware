<?php
$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
$system_name        =	$this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;

?>
<div id="printarea">
    <center>
        <div style=" margin-left: 20px;"><img src="uploads/header2.jpg" height="100px;" alt="BSN SR SEC School"></div>
    </center>
        <center>
            <div style="margin-top: 10px;">
               <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_address;?><br><p style="margin-top: 5px;">Ph.: <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?></p>
            </div>
        </center>
<div style="clear: both;"></div>
<div>
    <center>
        <div style="width: 750px;">
        <p style="float: left;">Ref No. : .................</p>
        <div style="background-color: #000; max-width: 250px; margin-top: -0px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">FEES CERTIFICATE</h4></div>
    </center>
        <center>
            <div style="clear: both;"></div>

            <center>              
                    <div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">
                        <p style="word-spacing: 2px;">
                            It is certified that Mr./Miss&nbsp;<b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></b> s/o. <b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->fathername;?></b> is studing in this school from std <b><?php $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->class_id;
                                    echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; ?></b>, section <b><?php $section_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->section_id;
                                    echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name; ?>&nbsp;</b>S.R. No. <b><?php echo $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->srno; ?></b> as a regular student. The student's tuition fees of the session  <b><?php echo $running_year; ?></b> is <b><input id="amt" type="text" value="1000" style="border: #fff;min-width: 60px;text-align: center; max-width: 80px;font-weight: 600;font-size: 18px;" onfocusout="inWords(this.value);"></b><b id="amtt"></b> Rupees.<br>
                                    in words <b id="word" style="text-transform: uppercase;">ONE THOUSAND RUPEES ONLY</b>.
                        <br><br><br>
                        <p style="float: left;">Date:<?php echo date('d-m-y'); ?></p>
                        <p style="float: right;">Principal Signature</p>
                    </div>
            </center>
        </center> 
</div>
<div style="clear: both;"></div>

</div>
<div style="text-align: center;">
    <button id="btn" onclick="printFunc();" >Print</button>
</div>
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
<script type="text/javascript">
    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
    str += 'rupees only';
    var div = document.getElementById('word');
    var amt = document.getElementById('amt');
    var amtt  = document.getElementById('amtt');
amt.style.display = "none";
div.innerHTML = str;
amtt.innerHTML = num;
}
</script>