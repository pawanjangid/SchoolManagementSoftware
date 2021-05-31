
<style>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

<?php
$teacher_name		 	= 	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->row()->name;

$system_name        =	$this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->school_name;
$running_year       =   $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;

?>

<center>


<div id="printarea" style="width:1080px;border:1px solid black;border-radius:20px;padding:20px;">
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
    </center>
    <center>
            <div style="width: 750px;margin-bottom:100px;">
                        <div style="clear: both;"><p style="float: left;">Ref No.: ...............</p></div>
                        <center>
                             <div style="background-color: #000; max-width: 350px; margin-top: -0px; border-radius: 5px;"><h3 style="text-decoration: underline; color: #fff; padding: 15px;">EXPERIENCE CERITIFICATE</h3>
                            </div>
                        </center>
            </div> 
    </center>        
    <center>          
        <div style="clear: both;"></div>            
            <div style="width: 750px; text-align: left;font-size: 20px;margin-top: 20px;">

                <p style="word-spacing: 2px;">
                    It is Certified that Mr./Miss&nbsp;<b style="text-transform: uppercase;"><?php echo $teacher_name;?></b> at this school from <b><?php echo date('d-m-Y',$this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->row()->joining_date); ?></b><b id="startadd"></b> to <b><?php echo date('d-m-Y'); ?></b>, on the post of <b><?php echo $this->db->get_where('teacher',array('teacher_id'=>$teacher_id))->row()->post; ?></b>, was posted.


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
<div style="clear: both;margin-top:20px;"></div>
<div style="text-align: center;">
    <button class="button" id="btn" onclick="printFunc();" >Print</button>
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
</script>