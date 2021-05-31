<?php
$teacher_name		 	= 	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->row()->name;

$system_name        =	$this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;

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
    <center>
            <div style="width: 750px;">
                        <div style="clear: both;"><p style="float: left;">Ref No.: ...............</p></div>
                        <center>
                             <div style="background-color: #000; max-width: 250px; margin-top: -0px; border-radius: 5px;"><h4 style="text-decoration: underline; color: #fff; padding: 5px;">EXPERIENCE CERITIFICATE</h4>
                            </div>
                        </center>
            </div> 
    </center>        
    <center>          
        <div style="clear: both;"></div>            
            <div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">

                <p style="word-spacing: 2px;">
                    It is Certified that Mr./Miss&nbsp;<b style="text-transform: uppercase;"><?php echo $teacher_name;?></b> at this school from <b><input id="start" type="text" value="<?php echo $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->row()->blood_group; ?>" style="border: #fff;font-weight: 600;max-width :80px;font-size: 18px;display: inline-block;" onfocusout="start(this.value);" /></b><b id="startadd"></b> to <input id="end" type="text" value="<?php echo date('d-m-y'); ?>" style="border: #fff;font-weight: 600;max-width :80px;font-size: 18px;display: inline-block;" onfocusout="end(this.value);" /><b id="endadd"></b>, on the post of <select id="category" style="border: #fff; max-width: 80px;font-weight: 600;-webkit-appearance:none;-moz-appearance: none;font-size: 18px;" onfocusout="category(this.value)">
                                <option value="P.R.T.">P.R.T.</option>
                                <option value="T.G.T.">T.G.T.</option>
                                <option value="P.G.T.">P.G.T.</option>
                            </select><b style="font-size: 18px;font-weight: 600;" id="categoryadd"></b>, was posted.


                </p>
                <br>           
                <p style="text-align: center;margin: 30px 0px 30px 0px;"><b>He/She is skilled and laborious person, I wish a bright future for him/her.</b>  </p>
                <br><br><br>
                <p style="float: left;">Date:<?php echo date('d-m-y'); ?></p>
                <p style="float: right;">Principal Signature</p>
            </div>
    </center>

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
</script>