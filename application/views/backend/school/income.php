<hr />
<?php $payment=$this->db->get_where('payment', array('school_id' =>  $this->session->userdata('school_id'),'payment_type'=>'income'))->result_array(); ?>
<div class="row">
	<div class="col-md-12">

		<!-- <ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#unpaid" data-toggle="tab">
					<span class="hidden-xs"><?php echo get_phrase('invoices');?></span>
				</a>
			</li>
			<li>
				<a href="#paid" data-toggle="tab">
					<span class="hidden-xs"><?php echo get_phrase('payment_history');?></span>
				</a>
			</li>
		</ul> -->

		<div class="tab-content">
			<br>
			<div class="tab-pane active" id="unpaid">


				<table  class="table table-bordered datatable example">
					<thead>
						<tr>
							<th>SNo #</th>
							<th><div><?php echo get_phrase('student');?></div></th>
							<th><div><?php echo get_phrase('class');?></div></th>
							<th><div><?php echo get_phrase('Date');?></div></th>
							<th><div><?php echo get_phrase('Amount');?></div></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						foreach($payment as $row):
							?>
							<tr>
								<td><?php echo $row['payment_id']; ?></td>
								<td>

									<?php 
									$enroll = $this->db->get_where('enroll', array('enroll_id' => $row['enroll_id']))->row_array();
									echo $this->crud_model->get_type_name_by_id('student',$enroll['student_id']);?>
								</td>
								<td><?php $class = $this->db->get_where('class', array('class_id' =>$enroll['class_id']))->row_array();echo $class['name']; ?>
								</td>
								<td><?php echo date('d-m-Y',$row['timestamp']);?></td>
								<td><?php echo  $row['amount'];?></td>
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

