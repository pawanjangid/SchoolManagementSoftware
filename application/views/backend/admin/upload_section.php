<hr />

    <div class="row">
    <?php echo form_open(base_url() . 'index.php?admin/upload_settings/upload_logo' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-10">
            
            <div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('upload_logo');?>
                    </div>
                </div>
                <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_email" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
                      </div>
                  </div>
                <div class="panel-body">
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
                            <input type="file" id="userfile" name="userfile" accept="image/*">
                          </span>
                          <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                

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
     <div class="row">
    <?php echo form_open(base_url() . 'index.php?admin/upload_settings/upload_header' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-10">
            
            <div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('upload_header');?>
                    </div>
                </div>
                 
                <div class="panel-body">
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
                            <input type="file" id="userfile" name="userfile" accept="image/*">
                          </span>
                          <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                

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

