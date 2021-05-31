<hr />
  
<div class="row" style="margin-top: 20px;">
    <?php $products = $this->db->get_where('cart',array('user_id' => $this->session->userdata('school_id'), 'user' => 'school'))->result_array(); ?>
    <?php foreach ($products as $row): ?>
	<div class="col-sm-12" style="border: 1px solid gray; margin: 5px;">
        <div class="col-sm-4" style="display: table;">
            <div class="col-sm-6"><img src="<?php echo $this->crud_model->get_image_url('product' , $row['product_id']);?>" 
                    class="img-responsive img-square" width="100"/></div>
            <div class="col-sm-6" style="color: green;font-size: 20px;display: table-cell;vertical-align: middle;margin-top: 20px;"><i class="fa fa-check"></i><span>Added to Cart</span></div>
            
        </div>
        <div class="col-sm-4" style="margin-top: 20px;text-align: right;">
           <input type="number" id="quantity" placeholder="enter Quantity" onfocusout="update_cart(<?php echo $row['product_id']; ?>,this.value);">
        </div>
        <div class="col-sm-4" style="font-size: 24px;margin-top: 20px;">
            <i class="fa fa-check-circle" style="color: green;"></i> <i class="fa fa-trash-o" style="color: red;"></i>
        </div>
    </div>
    <?php endforeach; ?>
	
</div>
<script type="text/javascript">

    function update_cart(product_id,quantity) {
        alert(product_id + ' ' + quantity);
        $.ajax({
            url: '<?php echo base_url();?>index.php?school/update_cart/' + product_id + '/' + quantity ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }

</script>