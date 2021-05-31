<div class="row">
	<div  class="col-md-2"></div>
	<div class="col-md-10">
        <?php $product = $this->db->get_where('products',array('product_category_id' => $product_category_id))->result_array() ?>
        <?php foreach ($product as $row): ?>
    	<div class="col-md-3">
    		
    			<div style="height: 300px;">
                	<div style="height: 80%">
                		<div style="height: 80%;">
                   	<img style="border-radius: 10px;" src="<?php echo $this->crud_model->get_image_url('product',$row['product_id']);?>" class="img-squre" width="100%" height='100%'/>
                   </div>
                   <div style="position: absolute;top: 0px;right: 0px;background-color: rgba(255, 0, 0, 0.4);height: 80%;width: 50px;">
                   	<div class="icon" style="font-size: 40px;margin: auto;"><i class="fa fa-cart"></i></div>
                   	<div class="icon" style="font-size: 40px;margin: auto;"><i class="fa fa-shopping-cart"></i></div>
                   	<div class="icon" style="font-size: 40px;margin: auto;"><i class="fa fa-heart"></i></div>



                   </div>
                	</div>
                   
                    
                <div >
                	 <h2 style="text-overflow: ellipsis;"><?php echo $row['name'];?></h2>
                   <p><?php echo $row['product_category_id'];?></p>
                </div>
                </div>     
        </div>
    <?php endforeach; ?>
    </div>	
</div>