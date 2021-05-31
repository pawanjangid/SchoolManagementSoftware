<hr />
<div class="row">
	<div class="col-md-12">

		<ul class="nav nav-tabs bordered">
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
		</ul>

		<div class="tab-content">
			<br>
			<div class="tab-pane active" id="unpaid">


				<table  class="table table-bordered datatable example">
					<thead>
						<tr>
							<th>Inv #</th>
							<th><div><?php echo get_phrase('student');?></div></th>
							<th><div><?php echo get_phrase('class');?></div></th>
							<th><div><?php echo get_phrase('total');?></div></th>
							<th><div><?php echo get_phrase('paid');?></div></th>
							<th><div><?php echo get_phrase('due');?></div></th>
							<th><div><?php echo get_phrase('status');?></div></th>
							<th><div><?php echo get_phrase('date');?></div></th>
							<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						$this->db->where('year' , $running_year);
						$this->db->order_by('creation_timestamp' , 'desc');
						$invoices = $this->db->get('invoice')->result_array();
						$enroll1 = $this->db->get('enroll')->result_array();
						$class1 = $this->db->get('class')->result_array();

						foreach($invoices as $row):
							?>
							<tr>
								<td><?php echo $row['invoice_id']; ?></td>
								<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
								<td><?php $class_id1 = $enroll1[$row['student_id']-1]['class_id'];
								$classname=$this->db->get_where('class',array('class_id' => $class_id1))->result_array();
								echo $classname[0]['name']; ?></td>
								<td><?php echo  $row['amount'];?></td>
								<td><?php echo $row['amount_paid'];?></td>
								<td><?php echo $row['due'];?></td>
								<?php if($row['due'] == 0):?>
									<td>
										<button class="btn btn-success btn-xs"><?php echo get_phrase('paid');?></button>
									</td>
								<?php endif;?>
								<?php if($row['due'] > 0):?>
									<td>
										<button class="btn btn-danger btn-xs"><?php echo get_phrase('unpaid');?></button>
									</td>
								<?php endif;?>
								<?php if($row['due'] < 0):?>
									<td style="background-color: #ffeb3b">
										<button class="btn btn-danger btn-xs" style="color: #000000; background-color: #ffeb3b; border-color: #ffeb3b;"><?php echo get_phrase('warning, due<0');?></button>
									</td>
								<?php endif;?>
								<td><?php $payments = $this->db->get_where('payment',array('invoice_id' => $row['invoice_id']))->result_array();echo end($payments)['timestamp'];?></td>
								<td>
									<center><div class="btn-group">
										<a class="btn btn-default btn-sm" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');" style="margin-right: 10px;">
											<i class="entypo-bookmarks"></i>
											<?php echo get_phrase('take_payment');?>
										</a>
										<a class="btn btn-default btn-sm" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');" style="margin-right: 10px;">
											<i class="entypo-credit-card"></i>
											<?php echo get_phrase('view_invoice');?>
										</a>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
											<?php echo get_phrase('action');?> <span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-default pull-right" role="menu">
											<li>
												<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
													<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
												</a>
											</li>
											<li class="divider"></li>

											<!-- DELETION LINK -->
											<li>
												<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
													<i class="entypo-trash"></i>
													<?php echo get_phrase('delete');?>
												</a>
											</li>
										</ul>
									</div></center>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>

			</div>
			<div class="tab-pane" id="paid">

				<table class="table table-bordered datatable example">
					<thead>
						<tr>
							<th><div>Pmt #</div></th>
							<th>Student Name</th>
							<th style="text-align: center;"><div><?php echo get_phrase('description');?></div></th>
							<th><div><?php echo get_phrase('method');?></div></th>

							<th><div><?php echo get_phrase('amount_paid');?></div></th>
							<th><div><?php echo get_phrase('date');?></div></th>
							
							<!-- <th></th> -->
						</tr>
					</thead>
					<tbody>
						<?php 
						$count = 1;
						$this->db->where('payment_type' , 'income');
						$this->db->order_by('timestamp' , 'desc');
						$payments = $this->db->get('payment')->result_array();
						foreach ($payments as $row):
							?>
							<tr>
								<td><?php echo $row['payment_id']; ?></td>
								<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
								<td style="text-align: center;"><?php echo $row['description'];?></td>
								<td>
									<?php 
									if ($row['method'] == 1)
										echo get_phrase('cash');
									if ($row['method'] == 2)
										echo get_phrase('check');
									if ($row['method'] == 3)
										echo get_phrase('card');
									if ($row['method'] == 'paypal')
										echo 'paypal';
									?>
								</td>

								<td><?php echo $row['amount'];?></td>
								<td><?php echo $row['timestamp'];?></td>

						<!-- <td align="center">
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"
								class="btn btn-default">
								<?php echo get_phrase('view_invoice');?>
							</a>
						</td> -->
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

<?php

$AA = $payments;
$amount_today = 0;
$amount_month = 0;
$amount_prv = 0;
$DATE =  date('d/m/Y');
$month = date('m/Y');
$month_prv1 = date('m');
$month_prv1 = $month_prv1-1;
$month_prv1 = sprintf("%02d",$month_prv1);
if ($month_prv1 == 00) {
	$month_prv1 = 12;
	$month_prv = $month_prv1 . '/' . date('Y')-1;
}else {
	$month_prv = $month_prv1 . '/' . date('Y');
}
for ($i=0; $i < sizeof($AA); $i++) { 
	if ($AA[$i]['timestamp'] == $DATE) {
		$amount_today= $amount_today + $AA[$i]['amount'];
	}
	if (substr($AA[$i]['timestamp'], 3,7) == $month) {
		$amount_month= $amount_month + $AA[$i]['amount'];
	}
	if (substr($AA[$i]['timestamp'], 3,7) == $month_prv) {
		$amount_prv= $amount_prv + $AA[$i]['amount'];
	}
}
echo '<b style="color:#000; font-size:1.5em;">Total Transaction:-  Today : &#8377 ' . $amount_today . ' ,  This Month( ' . date('M') . ' ) :  &#8377 ' . $amount_month . '</b></br>';
echo '<b style="color:#000; font-size:1.5em;">Last Transaction:-  Last Month : &#8377 ' . $amount_prv .'</b>';


?>