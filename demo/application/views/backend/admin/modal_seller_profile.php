<?php
$seller_info	=	$this->db->get_where('seller' , array('seller_id' => $param2))->result_array();
foreach($seller_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<!-- <img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" 
                	class="img-responsive img-circle" /> -->
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h2>
                                <?php echo $row['name'];?>                     
                            </h2>
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
                        <td><?php echo get_phrase('username');?></td>
                        <td><b><?php echo $row['username']; ?></b></td>
                    </tr>
                
                 
                    <tr>
                        <td><?php echo get_phrase('Address');?></td>
                        <td><b><?php echo $row['address'] . ', district : ' . $this->db->get_where('district' , array('district_id' => $row['district_id']))->row()->name . ',  State : ' . $this->db->get_where('state' , array('state_id' => $row['state_id']))->row()->Name;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('contact_number');?></td>
                        <td><b><?php echo $row['contact_number'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Mail');?></td>
                        <td><b><?php echo $row['contact_mail'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Location');?></td>
                        <td><b><a href="<?php echo base_url() . 'index.php?admin/seller_location/' . $row['seller_id'];?>">Get Direction On Map</a></b></td>
                    </tr>
                   
                </table>
               
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>

    <script>

      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 26.8843769, lng: 75.7630889}
        });

        var image = {
          url: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCa2UBqNa_ei_Ig2ttOPg1p_zt6Oy8cs2ygkL8HMcignPdMYYe',
          // This marker is 20 pixels wide by 32 pixels high.
          //size: new google.maps.Size(20, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          //anchor: new google.maps.Point(0, 32)
        };
        //var beachMarker = new google.maps.Marker({position: {lat: 26.8843769, lng: 75.7630889},map: map,icon: image});
         marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: {lat: 26.8843769, lng: 75.7630889}
        });
        marker.addListener('click', toggleBounce);
      }

      function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhx6e_deJn-RJ9Tz0LvY5ThlyCEspT9Ew&callback=initMap">
    </script>