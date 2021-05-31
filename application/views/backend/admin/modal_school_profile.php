<?php
$school_info	=	$this->db->get_where('school' , array('school_id' => $param2))->result_array();
foreach($school_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('school' , $row['school_id']);?>" 
                	class="img-responsive img-square" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h1>
                                <?php echo $row['school_name'];?>                     
                            </h1>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                
                    <tr>
                        <td><?php echo get_phrase('District');?></td>
                        <td><b><?php echo $this->db->get_where('district', array('district_id' => $row['school_district_id']))->row()->name?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('State');?></td>
                        <td><b><?php echo $this->db->get_where('state', array('state_id' => $row['school_state_id']))->row()->Name;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Contact_Primary');?></td>
                        <td><b><?php echo $row['school_contact_primary'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Contact_Secondary');?></td>
                        <td><b><?php echo $row['school_contact_secondary'];?></b></td>
                    </tr>



                    
                    <tr>
                        <td><?php echo get_phrase('School_Mail');?></td>
                        <td><b><?php echo $row['school_email'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Get_Location');?></td>
                        <td><b><a href="<?php echo base_url() . 'index.php?admin/school_location/' . $row['school_id'];?>">Get Direction On Map</a></b></td>
                    </tr>
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>