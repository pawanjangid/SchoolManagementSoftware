
            <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?admin/school_add/');" 
            	class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo get_phrase('Add_New_School');?>
                </a> 
                <br><br>
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('Username');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('district');?></div></th>
                            <th><div><?php echo get_phrase('state');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $institute	=	$this->db->get('school')->result_array();
                                foreach($institute as $row):?>
                        <tr>
                            <td><?php echo $row['school_username'];?></td>
                            <td><img src="<?php echo base_url() . 'uploads/schools_logo/' . $row['image']; ?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['school_name'];?></td>
                            <td><?php echo $row['school_address'];?></td>
                            <td><?php echo $this->db->get_where('district', array('district_id' => $row['school_district_id']))->row()->name ;?></td>
                            <td><?php echo $this->db->get_where('state', array('state_id' => $row['school_state_id']))->row()->Name ;?></td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_school_profile/<?php echo $row['school_id'];?>');">
                                        <i class="entypo-eye"></i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_school_edit/<?php echo $row['school_id'];?>');">
                                        <i class="entypo-pencil"></i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-sm" >
                                        <i class="entypo-trash"></i>
                                    </button>
                                </div>
                                
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



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
						"mColumns": [1,2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
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

