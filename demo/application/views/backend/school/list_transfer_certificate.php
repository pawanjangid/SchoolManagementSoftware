<hr />
<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('List_Transfer_Certificate');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
			<br>
				<div class="tab-pane active" id="unpaid">
					
											
						<table  class="table table-bordered datatable example">
                	<thead>
                		<tr>
                			<th>#</th>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('Class');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('SR No.');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    		$count = 1;
                    		$this->db->where('year' , $running_year);
                    		$this->db->order_by('creation_timestamp' , 'desc');
                    		$invoices = $this->db->get('transfercertificate')->result_array();
                    		foreach($invoices as $row):
                    	?>
                        <tr>
                        	<td><?php echo $count++;?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php  echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name;?></td>
							<td><?php echo $row['creation_timestamp'];?></td>

							<td><?php echo $row['srno'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_tc/<?php echo $row['tc_id'];?>');">
                                    <?php echo get_phrase('Print');?>
                                </button>
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

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		

		var datatable = $(".example").dataTable({
			"sPaginationType": "bootstrap",
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>