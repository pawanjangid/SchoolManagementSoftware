<?php
$temp	=	$this->db->get_where('marksheet_templete' , array('templete_id' => $param2))->result_array();
foreach($temp as $row):?>

<div class="profile-env">
	

	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            <a href="<?php echo base_url().'uploads/marksheet/'.$row['image'] ?>" target="_blank">
                <img src="<?php echo base_url().'uploads/marksheet/'.$row['image'] ?>">
            </a>	
			</div>
		</div>		
	</section>
</div>
<?php endforeach;?>