<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                    <?php $edit_data = $this->db->get_where('product_category',array('product_category_id' => $param2))->result_array(); ?>
                    
                	<?php foreach($edit_data as $row):?>
                    <?php echo form_open(base_url() . 'index.php?admin/product_category/do_update/'.$row['product_category_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="" name="description" value="<?php echo $row['description'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('Save');?></button>
                        </div>
                    </form>
                    <?php endforeach;?>
                </div>
			</div>