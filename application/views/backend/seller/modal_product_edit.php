<?php 
$edit_data		=	$this->db->get_where('products' , array('product_id' => $param2,'seller_id' => $this->session->userdata('seller_id')))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Update_Product');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?seller/product/do_update/'.$row['product_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                           
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Product_Category');?></label>
                        
                        <div class="col-sm-5">
                            <select name="product_category_id" class="form-control" data-validate="required" 
                                data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                $category = $this->db->get('product_category')->result_array();
                                foreach($category as $row2):
                                    ?>
                                    <option value="<?php echo $row2['product_category_id'];?>" <?php if($row['product_category_id'] == $row2['product_category_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                            </option>
                                <?php
                                endforeach;
                              ?>
                          </select>
                        </div> 
                    </div>
                    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Stock_Available');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="available_stock" value="<?php echo $row['available_stock'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Price');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="price" value="<?php echo $row['price'];?>"/>
                                </div>
                            </div>
                           <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                        
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id="description" name="description" value="<?php echo $row['description']; ?>"></textarea>
                            </div> 
                    </div>
                            
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>