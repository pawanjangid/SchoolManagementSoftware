<div class="row" > 
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Add_New_School');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/school/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="school_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus >
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="school_address" value="" >
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('State');?></label>
                        
						<div class="col-sm-5">
							<select name="school_state_id" class="form-control selectboxit" onchange="get_district(this.value);">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php $state = $this->db->get('state')->result_array(); ?>
                              <?php foreach ($state as $row): ?>
                              	<option value="<?php echo $row['state_id'] ?>"><?php echo $row['Name'];?></option>
                              <?php endforeach; ?>
                              
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('District');?></label>
                        
						<div class="col-sm-5">
							<select name="school_district_id" class="form-control" id="district">
                          </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Postal_Code');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="school_postal_code" value="" >
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Postal_Code');?></label>
                        
						<div class="col-sm-5">
							<input type="hidden" name="location_data" id="location" value="">
					<input type="button" class="btn btn-success" name="" value="Allow Location" onclick="getLocation()">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Contact_Number');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="school_contact_primary" value="" >
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Contact_Number_other');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="school_contact_secondary" value="" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mail');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="school_email" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="" >
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Confirm_password');?></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password_confirm" value="" >
						</div> 
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Save');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script>
var x = document.getElementById("location");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.value = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.value = position.coords.latitude + ',' + position.coords.longitude;
}
</script>

<script type="text/javascript">
	
	function get_district(state_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_district/' + state_id,
            success: function(response)
            {
                jQuery('#district').html(response);
            }
        });
    }
</script>