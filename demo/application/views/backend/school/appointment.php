<?php
$teacher_name		 	= 	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id,'school_id'=>$this->session->userdata('school_id')))->row()->name;

$school_name        =	$this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;

?>
<div id="printarea" style="border: 2px solid black;width: 900px;border-radius: 5px;">
    <center>
     <h1><?php  echo $school_name; ?></h1>
     <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_address;?><br><p style="margin-top: 5px;">Ph.: <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?></p>
    </center>

    <center>
       
    </center>
    <center>
            <div style="width: 750px;">
                        <div style="clear: both;"><p style="float: left;">Ref No.: ...............</p></div>
                        <center>
                             <div style="background-color: #000; max-width: 250px; margin-top: -0px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">APPOINTMENT LETTER</h4>
                            </div>
                        </center>
            </div> 
    </center>        
    <center>          
        <div style="clear: both;"></div>            
            <div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">

                <p style="word-spacing: 2px;">
                    Mr./Miss&nbsp;<b style="text-transform: uppercase;"><?php echo $teacher_name;?></b> Date <b><input id="start" type="text" value="<?php echo $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->row()->blood_group; ?>" style="border: #fff;font-weight: 600;max-width :80px;font-size: 18px;display: inline-block;" onfocusout="start(this.value);" /></b><b id="startadd"></b> subject <input id="end" type="text" value="subject" style="border: #fff;font-weight: 600;max-width :80px;font-size: 18px;display: inline-block;" onfocusout="end(this.value);" /><b id="endadd"></b> the school managanement has appointed you in interview after the consideration by the following terms<br><br>
                    <ol>
                        <li>Your posting is temporary</li>
                        <li>If the service is unsatisfited. you will be free from your post by the management</li>
                        <li>your salaries is <input id="salary" type="text" value="7000" style="border: #fff;font-weight: 600;max-width :80px;font-size: 18px;display: inline-block;" onfocusout="salary(this.value);" /><b id="salaries"></b></li>
                    </ol>
                <br>           
                
                <br><br><br>
                <p style="float: left;">Date:<?php echo date('d-m-y'); ?></p>
                <p style="float: right;">Principal Signature</p>
            </div>
    </center>

<div style="clear: both;"></div>

</div>
<center>
<div style="text-align: left;margin: 20px;">
    <div style="color: red;">You can Change Highlighted data manually</div>
    <div style="text-align: center;"><button id="btn" onclick="printFunc();" >Print</button></div>
    
</div>
</center>

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
    function category(value) {
        var beh = document.getElementById('category');
        var behadd = document.getElementById('categoryadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function start(value) {
        var beh = document.getElementById('start');
        var behadd = document.getElementById('startadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function end(value) {
        var beh = document.getElementById('end');
        var behadd = document.getElementById('endadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function salary(value) {
        var beh = document.getElementById('salary');
        var behadd = document.getElementById('salaries');
        beh.style.display = "none";
        behadd.innerHTML = value+' Rupees.';
    }
</script>