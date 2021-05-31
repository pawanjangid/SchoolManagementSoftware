<?php
$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
$templete = $this->db->get_where('school_setting',array('school_id'=>$this->session->userdata('school_id')))->row()->marksheet_templete;
if(!$templete){
    $templete= '1';
}
?>

<hr />


<div class="row">
    <div class="col-md-12">
        
     
        
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <?php 
                                $templetes   =   $this->db->get('marksheet_templete');
                                $templetes=$templetes->result_array(); ?>

                <?php 
                                foreach($templetes as $row):?>
        <div class="col-md-2 shadow" style="border:1px solid black;margin: 10px;border-radius:20px;" >   
                <div style="height: 250px;margin-top: 30px;" >
                    <div style="height: 80%;border : 2px black;" >
                    <div style="height: 80%;" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_marksheet_preview/<?php echo $row['templete_id'];?>');">
                    <img style="border-radius: 10px;" src="<?php echo base_url().'uploads/marksheet/'.$row['image']; ?>" class="img-squre" width="100%" height='100%'/>
                   </div>
                   
                    </div>
                    <?php if($templete==$row['templete_id']) { ?>
                    <div style="text-align:center;margin-top: -40px;"> 
                      <a href="#">
                          <button class="btn btn-success">
                            Selected
                        </button>
                      </a>  
                    </div>
                    <?php }else{ ?>
                    <div style="text-align:center;margin-top: -40px;"> 
                      <a href="<?php echo base_url();?>school/select_marksheet_templete/<?php echo $row['templete_id'];?>">
                          <button class="btn btn-info">
                            Select
                        </button>
                      </a>  
                    </div>
                    <?php } ?>
                  <div style="margin-top: 20px;text-align:center;">
                     <p style="text-overflow: ellipsis;overflow: hidden;white-space:pre"><?php 
                                   echo $row['title']
                                ?></p>

                   </div> 
                    
               
                   
                </div>
                 
        </div>
<?php endforeach;?>
             
        
            
        
    </div>
</div>

</div>
</div>                