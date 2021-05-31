<a href="<?php echo base_url();?>index.php?admin/product_add" class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('Add_new_Product');?>
    </a>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('Id');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('Product_category');?></div></th>
                            <th><div><?php echo get_phrase('Seller');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $products   =   $this->db->get_where('products' , array(
                                    'product_category_id' => $product_category_id))->result_array();
                                foreach($products as $row):?>
                        <tr>
                            <td><?php echo $row['product_id'];?></td>
                            <td></td>
                            <td>
                                <?php 
                                    echo $row['name'];
                                ?>
                            </td>
                            <td>
                                <?php 
                                 echo $this->db->get_where('product_category', array('product_category_id' => $row['product_category_id']))->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                 echo $this->db->get_where('seller', array('seller_id' => $row['seller_id']))->row()->name;
                                ?>
                            </td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                       
                                        
                                        <!-- PRODUCT DETAIL -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_product_profile/<?php echo $row['product_id'];?>');">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('Product_Detail');?>
                                                </a>
                                        </li>
                                        <!-- Product Edit Detail LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_product_edit/<?php echo $row['product_id'];?>');">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('Edit_Detail');?>
                                                </a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                    
            </div>

        </div>
        
        
    </div>
</div>




<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>