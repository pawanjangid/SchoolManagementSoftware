<style type="text/css">
  #map {
    box-shadow: 2px 2px 10px 2px #c9c7c7;
    border-radius: 10px;
  }
</style>
<?php $location = $this->db->get_where('school', array('school_id' => $school_id ))->row()->location_data;
$cordinate=explode(',', $location);
 ?>
 <?php
$seller_info  = $this->db->get_where('school' , array('school_id' => $school_id))->result_array();
foreach($seller_info as $row):?>

<div class="profile-env">
  
  <header class="row">
    
    <div class="col-sm-3">
      
      <a href="#" class="profile-picture">
        <img src="<?php echo $this->crud_model->get_image_url('school' , $row['school_id']);?>" 
                  class="img-responsive img-circle" />
      </a>
      
    </div>
    
    <div class="col-sm-9">
      
      <ul class="profile-info-sections">
        <li style="padding:0px; margin:0px;">
          <div class="profile-name">
              <h2>
                                <?php echo $row['school_name'];?>                     
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
                        <td><b><?php echo $row['school_username']; ?></b></td>
                    </tr>
                
                 
                    <tr>
                        <td><?php echo get_phrase('Address');?></td>
                        <td><b><?php echo $row['school_address'] . ', district : ' . $this->db->get_where('district' , array('district_id' => $row['school_district_id']))->row()->name . ',  State : ' . $this->db->get_where('state' , array('state_id' => $row['school_state_id']))->row()->Name;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('school_contact_primary');?></td>
                        <td><b><?php echo $row['school_contact_primary'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Mail');?></td>
                        <td><b><?php echo $row['school_email'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Set_Destination');?></td>
                        <td><b> <a target="_black"  href="https://www.google.com/maps/dir/?api=1&origin=current+location&destination=<?php echo $row['location_data']; ?>">Get Direction</a></b></td>
                    </tr>
                   

                </table>

      </div>
    </div>    
  </section>
  
  
  
</div>


<?php endforeach;?>

    <div id="map" style="position: relative; min-height: 400px;min-width: 200px;max-width: 100%;max-height: 1100px;"></div>


    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: {lat: <?php echo $cordinate['0']; ?>, lng: <?php echo $cordinate['1']; ?>}
        });

        var image = {
          url: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCa2UBqNa_ei_Ig2ttOPg1p_zt6Oy8cs2ygkL8HMcignPdMYYe',
          origin: new google.maps.Point(0, 0),
         
        };
        
         marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: {lat: <?php echo $cordinate['0']; ?>, lng: <?php echo $cordinate['1']; ?>}
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


