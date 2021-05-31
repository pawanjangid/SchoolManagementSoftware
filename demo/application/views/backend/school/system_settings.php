<hr />

    <div class="row">
    <?php echo form_open(base_url() . 'index.php?school/system_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-10">
            
            <div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('Account_settings');?>
                    </div>
                </div>
                
                <div class="panel-body">
                   
                  <div class="form-group">
                      <label  class="col-sm-2 control-label">School Name</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="school_name" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_name;?>">
                      </div>
                      <label  class="col-sm-2 control-label">In Hindi</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="school_name_hin" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_name_hin;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-2 control-label"><?php echo get_phrase('address');?></label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="school_address" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_address;?>">
                      </div>
                      <label  class="col-sm-2 control-label"><?php echo get_phrase('Dice_Code');?></label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="dice_code" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->dice_code;?>">
                      </div>
                  </div>

                   <div class="form-group">
                      <label  class="col-sm-2 control-label"><?php echo get_phrase('SMS_API');?></label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="school_sms_api" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sms_api;?>">
                      </div>
                      <label  class="col-sm-2 control-label"><?php echo get_phrase('SMS_SENDER_ID');?></label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="school_sender_id" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sender_id;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Phone Number</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="school_contact_primary" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_contact_primary;?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Registration Number</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="school_reg_number" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_reg_number;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="email" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->email;?>">
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Head_Authority');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="head_authority" 
                              value="<?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->head_authority;?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('running_session');?></label>
                      <div class="col-sm-9">
                          <select name="running_year" class="form-control selectboxit">
                          <?php $running_year = $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->running_year;?>
                          <option value=""><?php echo get_phrase('select_running_session');?></option>
                          <?php for($i = 0; $i < 100; $i++):?>
                              <option value="<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>"
                                <?php if($running_year == (2016+$i).'-'.(2016+$i+1)) echo 'selected';?>>
                                  <?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>
                              </option>
                          <?php endfor;?>
                          </select>
                      </div>
                  </div>
                    
                 <!--  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('language');?></label>
                      <div class="col-sm-9">
                          <select name="language" class="form-control selectboxit">
                                <?php
									$fields = $this->db->list_fields('language');
									foreach ($fields as $field)
									{
										if ($field == 'phrase_id' || $field == 'phrase')continue;
										
										$current_default_language	=	$this->db->get_where('settings' , array('type'=>'language'))->row()->description;
										?>
                                		<option value="<?php echo $field;?>"
                                        	<?php if ($current_default_language == $field)echo 'selected';?>> <?php echo $field;?> </option>
                                        <?php
									}
									?>
                           </select>
                      </div>
                  </div> -->
<!--                   <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Color');?></label>
                      <div class="col-sm-9">
                          <select name="skin" class="form-control selectboxit">
                          <?php $skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description;?>
                          <option value="<?php echo $skin; ?>"><?php echo get_phrase('select_skin');?></option>
                         
                              <option value="Purple">Purple</option>
                              <option value="black">black</option>
                              <option value="blue">blue</option>
                              <option value="green">green</option>
                              <option value="red">red</option>
                              <option value="white">white</option>
                              <option value="yellow">yellow</option>

                          </select>
                      </div>
                  </div> -->
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
                    </div>
                  </div>
                    <?php echo form_close();?>
                    
                </div>
            
            </div>
        
        </div>

    </div>



