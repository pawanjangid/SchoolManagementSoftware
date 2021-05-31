<style type="text/css">
  .shadow {
  -moz-box-shadow:    1px 2px 2px 2px #ededed;
  -webkit-box-shadow: 1px 2px 2px 2px #ededed;
  box-shadow:         1px 2px 2px 2px #ededed;
  border-radius: 5px;
}
.shadow:hover {
  z-index: 10px;
  -moz-box-shadow:    2px 3px 1px 3px #c9c9c9;
  -webkit-box-shadow: 2px 3px 1px 3px #c9c9c9;
  box-shadow:         2px 3px 1px 3px #c9c9c9;
}
</style>
<div class="row">
  <div class="col-sm-8"> <p style="float: right;"><h2 style="float: right;">Go to cart for General Detail</h2></p></div>
  <div class="col-sm-4">
    <a href="<?php echo base_url();?>school/continuetocart"
    class="btn btn-success pull-right" style="font-size: 24px;">
        <i class="fa fa-shopping-cart"></i>
        <?php echo get_phrase('Continue_To_Cart');?>
    </a>
  </div>
  
    </div>
<div class="row">
	<div  class="col-md-2"></div>
	<div class="col-md-10">
        <?php $product = $this->db->get_where('products',array('product_category_id' => $product_category_id))->result_array() ?>
        <?php foreach ($product as $row): ?>
    	<div class="col-md-3 shadow" style="margin: 0px;" >
    		
    			<div style="height: 300px;">
                	<div style="height: 80%;border : 2px black;" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_product_profile/<?php echo $row['product_id'];?>');">
                		<div style="height: 80%;">
                   	<img style="border-radius: 10px;" src="<?php echo $this->crud_model->get_image_url('product',$row['product_id']);?>" class="img-squre" width="100%" height='100%'/>
                   </div>
                   
                	</div>
                   
                    
                <div style="margin-top: -20px;">
                	 <p style="text-overflow: ellipsis;font-size: 14px;"><?php echo $row['name'];?></p>
                   <div class="row">
                     <div class="col-sm-12">
                       <p class="col-sm-4" style="margin-bottom: 5px;display: inline;font-size: 32px;color: #7fc900;" onclick="addtocart(<?php echo $row['product_id'];?>);"><i class="fa fa-shopping-cart"></i></p>
                   <p class="col-sm-4" style="margin-bottom: 5px;display: inline;font-size: 32px;color: #f787ff;"><i class="fa fa-heart"></i></p>
                   <p class="col-sm-4" style="margin-bottom: 5px;display: inline;font-size: 32px;color: blue;" ><i class="fa fa-list"></i></p>
                     </div>
                   </div>
                   
                </div>
                </div>     
        </div>
    <?php endforeach; ?>
    </div>	
</div>
<script type="text/javascript">
  function addtocart(product_id) {
    $.ajax({
            url: '<?php echo base_url(); ?>school/addtocart/' + product_id,
            success: function (response)
            {

                jQuery('#cartbutton').html(response);
                alert('added');
            }
        });
  }
</script>
