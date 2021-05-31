<?php
$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
$system_name        =	$this->db->get_where('school' , array('school_id'=> $this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school_id'=> $this->session->userdata('school_id')))->row()->running_year;

?>
<div id="printarea" style="width:900px;border:1px solid black;padding:20px;">

    <div style="max-width: 100%;">
        
        
<?php 

$logo = $this->db->get_where('school',array('school_id'=>$this->session->userdata('school_id')))->row()->image;
if($logo){
    $logo = base_url().'uploads/schools_logo/'.$logo;
}else{
    $logo = base_url().'uploads/logo.png';
}

?>
        <div style="border:1px solid #e8e8e8;padding:20px;border-radius:20px;">
          
          <div style="float: left;"><img src="<?php echo $logo; ?>" width="180px;" alt="">
        </div>
        <div style="width:900px;">
            <div style="font-weight: 600;font-size: 50px;"><?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_name;?></div>
            <center>
              <div style="font-size:20px;">
                  <p>
                     <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_address;?> 
                  </p>
                  <p style="margin-top:-20px;">
                     Contact No.: <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?> 
                  </p>
                 
               <div>
                 
               </div>
               
            </div>  
            </center>
            
        </div>  
            
        </div>
        
        
    </div>

<div style="clear: both;margin-top:30px;"></div>
<div style="width:100%;">
    <center>
        
    </center>
</div>
<center><div style="width:100%;">

<img src="<?php echo base_url().'uploads/charactor.png'; ?>" style="width:70%;">

</div></center>
<hr style="margin:20px;">
<center>                
<div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">
    <p style="word-spacing: 2px;font-size:24px;">
            This is certify that Mr./Miss&nbsp;&nbsp;<b style="text-transform:uppercase"><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></b> Son/Daughter if Mr. <b style="text-transform:uppercase"><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->fathername;?></b> was bonofide student of <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_name;?> of class : <?php $class_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->class_id;
                    echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; ?> successfully passed the examination. Whose date of birth is <b><?php echo date('d-m-Y',$this->db->get_where('student' , array('student_id' => $student_id))->row()->birthday);?></b>. He/She is a student from <b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->date_of_admission;?></b> to <b><?php echo date('d-m-y');?></b> at this school. During this session his/her work and behaviour is remained <select id="behaviour" style="border: #fff;min-width: 80px; max-width: 180px;font-size: 20px;-webkit-appearance:none;-moz-appearance: none;text-decoration: underline; " onfocusout="behaviour(this.value);">
                        <option value="Excellent">Excellent</option>
                        <option value="Very Good">Very Good</option>
                        <option value="Good">Good</option>
                        <option value="Normal">Normal</option>
                    </select><b id="behaviouradd" style="text-decoration: underline;"></b>.
        </p>
    <p>As far as I know, his/her moral character is excellent. I wish for his/her successful future life.  </p>
    <br><br><br>
    <div style="clear: both;"></div>
    <div style="width:100%;margin-bottom:50px;">
        <p style="float: left;">Date:<?php echo date('d-m-y'); ?></p>
    <p style="float: right;">Principal Signature</p>
    </div>
    
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