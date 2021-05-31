<?php
$product_info	=	$this->db->get_where('products' , array('product_id' => $param2))->result_array();
foreach($product_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" 
                	class="img-responsive img-circle" />
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
                        <td><?php echo get_phrase('Seller_Detail');?></td>
                        <td><b><?php echo $this->db->get_where('seller', array('seller_id' => $row['seller_id']))->row()->name?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Product_categgry');?></td>
                        <td><b><?php echo $this->db->get_where('product_category', array('product_category_id' => $row['product_category_id']))->row()->name;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Price');?></td>
                        <td><b><?php echo $row['price'] . ' Rupee';?></b></td>
                    </tr>



                    
                    <tr>
                        <td><?php echo get_phrase('Description');?></td>
                        <td><b><?php echo $row['description'];?></b></td>
                    </tr>
                    
                    <tr>
                        <td><?php echo get_phrase('Stock');?></td>
                        <td><b><?php echo $row['available_stock'];?></b></td>
                    </tr>
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>