<?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
$edit_data2 = $this->db->order_by('payment_id','asc')->get_where('payment', array('invoice_id' => $param2))->result_array();
foreach ($edit_data as $row):
	?>
	<center>
		<a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print ">
			Print Invoice 
			<i class="entypo-print"></i>
		</a>
	</center>
	<hr style="border-color: #000; border-width: 1px;">
	<div id="invoice_print">
		<!-- School copy -->

		<div style="clear: both;"></div>
		<img src="<?php echo base_url();?>uploads/sss_logo.png"  style="max-height:100px; max-width:100px; float: left; margin-left: 5px; margin-right: -100px;"/>
		<div style="position: absolute;"></div>

		<h2 style="color: #000; text-align: center; font-weight: 600; text-transform: uppercase; font-family: 
		Georgia"><?php echo $this->db->get_where('settings' , array('type' =>'school_name'))->row()->description;?></h3>
		<h5 style="color: #000; text-align: center; margin-top: 3px; margin-bottom: 0px;"><?php echo $this->db->get_where('settings' , array('type' =>'school_address'))->row()->description;?></h5>
		<h5 style="color: #000; text-align: center; margin-top: 3px; margin-bottom: 0px;">Ph.: <?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?></h5>
		<h3 style="color: #000; text-align: center; font-family: 
		Georgia; text-decoration: underline;">FEE-RECEIPT</h3>
		<div class="pull-left" style="font-size:14px; color: #000; float: left;">
			RECEIPT NO.: <?php echo end($edit_data2)['payment_id'];?>
			<br />
			<span style="font-size:16px;font-weight:100;color: #000;">
				Received with thanks from: <span style="text-transform: uppercase; font-weight: 600;"><?php echo $this->db->get_where('student' , array('student_id'=>$row['student_id']))->row()->name;?></span>

			</span>
			<br />
		</div>
		<div class="pull-right" style="margin-right: 30px; float: right;">
			<span style="font-size:16px;font-weight:100; margin-right: 30px; color: #000;">
				Date:-<?php echo end($edit_data2)['timestamp'];?>

				<br />
				<?php echo get_phrase('class');?> : 
				<?php 
				$class_id   =   $this->db->get_where('enroll' , array('student_id'=>$row['student_id']))->row()->class_id;
				$class_name   =   $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name;
				echo $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name; ?>
			</span>
			<br />  
		</div>
		<div style="clear:both;"></div>
		<table width="100%" style="border-color: #777; max-width: 100%; border-collapse: collapse; border-spacing: 0;<?php if ($row['first_invoice']==1) {echo 'display: table;';}elseif ($row['first_invoice']==0) {echo 'display: none;';}?>" border="2" >
			<tr style="background-color:#eee; color:#000; padding:5px; text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px;"><?php echo get_phrase('Title');?></td>
				<td width="30%" style="padding:5px; text-align: center;">
					<div class="">
						<?php echo get_phrase('amount');?>
					</div>
				</td>
			</tr>

			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Tuition Fee<?php if ($row['sibling']=="Yes") {echo '(with concession)';} ?>
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$tution_amount = $row['tution_amount']; echo $tution_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Term Fee
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$term_amount = $row['term_amount']; echo $term_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Admission Fee
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$admission_amount = $row['admission_amount']; echo $admission_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Computer/Lab Fee
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$complab_amount = $row['complab_amount']; echo $complab_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Examination Fee
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$exam_amount = $row['exam_amount']; echo $exam_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Others
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$others_amount = $row['others_amount']; echo $others_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center; border-left: #000;">

				<td style="">
				</td>
				<td width="30%" style="padding:5px;">
					<span style="font-size:14px;font-weight:100; color: #000;">
						&nbsp;
					</span>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="text-align: left; padding-left: 20px;">
					<span style="font-size:14px;font-weight:600; color: #000;">
						TOTAL
					</span>
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:600; color: #000;">
							<?php
							echo $tution_amount+$term_amount+$admission_amount+$complab_amount+$exam_amount+$others_amount ; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Paid Amount(<?php echo end($edit_data2)['description']; ?>)
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$paid_amount = $row['amount_paid']; echo $paid_amount; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Remaining Fee
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							echo $tution_amount+$term_amount+$admission_amount+$complab_amount+$exam_amount+$others_amount-$paid_amount; ?>
						</span>
					</div>
				</td>
			</tr>
		</table>


		<table width="100%" style="border-color: #777; max-width: 100%; border-collapse: collapse; border-spacing: 0;<?php if ($row['first_invoice']==1) {echo 'display: none;';}elseif ($row['first_invoice']==0) {echo 'display: table;';}?>" border="2" >
			<tr style="background-color:#eee; color:#000; padding:5px; text-align: center; font-weight: 600;">

				<td style="padding:5px; text-align: left; padding-left: 20px;"><?php echo get_phrase('Title');?></td>
				<td width="30%" style="padding:5px; text-align: center;">
					<div class="">
						<?php echo get_phrase('amount');?>
					</div>
				</td>
			</tr>

			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Outstanding Amount
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$due = $row['due'];
							$amount = end($edit_data2)['amount'];echo $amount+$due; ?>
						</span>
					</div>
				</td>
			</tr>

			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Paid Amount(<?php echo end($edit_data2)['description']; ?>)
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php echo end($edit_data2)['amount']; ?>
						</span>
					</div>
				</td>
			</tr>
			<tr style="text-align: center;">

				<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
					Remaining Fee
				</td>
				<td width="30%" style="padding:5px;">
					<div class="">
						<span style="font-size:14px;font-weight:100; color: #000;">
							<?php
							$due = $row['due']; echo $due; ?>
						</span>
					</div>
				</td>
			</tr>
		</table>
		<p style="color: #000; margin-left: 5px;"><b>Note:</b> Fee is to be paid in advance by 15<sup>th</sup> of the first month of the quarter. (1<sup>st</sup> quarter April to June, 2<sup>nd</sup> quarter July to September, 3<sup>rd</sup> quarter October to December, 4<sup>th</sup> quarter January to March.)</p>


		<center>
			<table width="90%">
				<tr>

					<td>
						<div class="pull-left">
							<br><br>
							<h3 style="color: #000;font-family: Arial">Student Copy</h3>
						</div>   
					</td>
					<td></td>

					<td width="30%" style="padding:5px;">
						<div class="pull-right">
							<br><br>
							<h4 style="color: #000;font-family: Arial">Auth. Signatory </h4>
						</div>
					</td>
				</tr>
			</table></center>
			<hr style="border-color: #000; border-width: 1px;">



			<!-- School copy -->

			<hr style="border-color: #000; border-width: 1px;">



			<div style="clear: both;"></div>
			<img src="<?php echo base_url();?>uploads/sss_logo.png"  style="max-height:100px; max-width:100px; float: left; margin-left: 5px; margin-right: -100px;"/>
			<div style="position: absolute;"></div>

			<h2 style="color: #000; text-align: center; font-weight: 600; text-transform: uppercase; font-family: 
			Georgia"><?php echo $this->db->get_where('settings' , array('type' =>'school_name'))->row()->description;?></h3>
			<h5 style="color: #000; text-align: center; margin-top: 3px; margin-bottom: 0px;"><?php echo $this->db->get_where('settings' , array('type' =>'school_address'))->row()->description;?></h5>
			<h5 style="color: #000; text-align: center; margin-top: 3px; margin-bottom: 0px;">Ph.: <?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?></h5>
			<h3 style="color: #000; text-align: center; font-family: 
			Georgia; text-decoration: underline;">FEE-RECEIPT</h3>
			<div class="pull-left" style="font-size:14px; color: #000; float: left;">
				RECEIPT NO.: <?php echo end($edit_data2)['payment_id'];?>
				<br />
				<span style="font-size:16px;font-weight:100;color: #000;">
					Received with thanks from: <span style="text-transform: uppercase; font-weight: 600;"><?php echo $this->db->get_where('student' , array('student_id'=>$row['student_id']))->row()->name;?></span>

				</span>
				<br />
			</div>
			<div class="pull-right" style="margin-right: 30px; float: right;">
				<span style="font-size:16px;font-weight:100; margin-right: 30px; color: #000;">
					Date:-<?php echo end($edit_data2)['timestamp'];?>

					<br />
					<?php echo get_phrase('class');?> : 
					<?php 
					$class_id   =   $this->db->get_where('enroll' , array('student_id'=>$row['student_id']))->row()->class_id;
					$class_name   =   $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name;
					echo $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name; ?>
				</span>
				<br />  
			</div>
			<div style="clear:both;"></div>
			<table width="100%" style="border-color: #777; max-width: 100%; border-collapse: collapse; border-spacing: 0;<?php if ($row['first_invoice']==1) {echo 'display: table;';}elseif ($row['first_invoice']==0) {echo 'display: none;';}?>" border="2" >
				<tr style="background-color:#eee; color:#000; padding:5px; text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px;"><?php echo get_phrase('Title');?></td>
					<td width="30%" style="padding:5px; text-align: center;">
						<div class="">
							<?php echo get_phrase('amount');?>
						</div>
					</td>
				</tr>

				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Tuition Fee<?php if ($row['sibling']=="Yes") {echo '(with concession)';} ?>
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$tution_amount = $row['tution_amount']; echo $tution_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Term Fee
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$term_amount = $row['term_amount']; echo $term_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Admission Fee
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$admission_amount = $row['admission_amount']; echo $admission_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Computer/Lab Fee
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$complab_amount = $row['complab_amount']; echo $complab_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Examination Fee
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$exam_amount = $row['exam_amount']; echo $exam_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Others
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$others_amount = $row['others_amount']; echo $others_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center; border-left: #000;">

					<td style="">
					</td>
					<td width="30%" style="padding:5px;">
						<span style="font-size:14px;font-weight:100; color: #000;">
							&nbsp;
						</span>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="text-align: left; padding-left: 20px;">
						<span style="font-size:14px;font-weight:600; color: #000;">
							TOTAL
						</span>
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:600; color: #000;">
								<?php
								echo $tution_amount+$term_amount+$admission_amount+$complab_amount+$exam_amount+$others_amount ; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Paid Amount(<?php echo end($edit_data2)['description']; ?>)
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$paid_amount = $row['amount_paid']; echo $paid_amount; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Remaining Fee
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								echo $tution_amount+$term_amount+$admission_amount+$complab_amount+$exam_amount+$others_amount-$paid_amount; ?>
							</span>
						</div>
					</td>
				</tr>
			</table>


			<table width="100%" style="border-color: #777; max-width: 100%; border-collapse: collapse; border-spacing: 0;<?php if ($row['first_invoice']==1) {echo 'display: none;';}elseif ($row['first_invoice']==0) {echo 'display: table;';}?>" border="2" >
				<tr style="background-color:#eee; color:#000; padding:5px; text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; font-weight: 600;"><?php echo get_phrase('Title');?></td>
					<td width="30%" style="padding:5px; text-align: center; font-weight: 600;">
						<div class="">
							<?php echo get_phrase('amount');?>
						</div>
					</td>
				</tr>

				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Previous Amount
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$due = $row['due'];
								$amount = end($edit_data2)['amount'];echo $amount+$due; ?>
							</span>
						</div>
					</td>
				</tr>

				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Paid Amount(<?php echo end($edit_data2)['description']; ?>)
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php echo end($edit_data2)['amount']; ?>
							</span>
						</div>
					</td>
				</tr>
				<tr style="text-align: center;">

					<td style="padding:5px; text-align: left; padding-left: 20px; color: #000;">
						Remaining Fee
					</td>
					<td width="30%" style="padding:5px;">
						<div class="">
							<span style="font-size:14px;font-weight:100; color: #000;">
								<?php
								$due = $row['due']; echo $due; ?>
							</span>
						</div>
					</td>
				</tr>
			</table>


			<center>
				<table width="90%">
					<tr>

						<td>
							<div class="pull-left">
								<br><br>
								<h3 style="color: #000;font-family: Arial">School Copy</h3>
							</div>   
						</td>
						<td></td>

						<td width="30%" style="padding:5px;">
							<div class="pull-right">
								<br><br>
								<h4 style="color: #000;font-family: Arial">Auth. Signatory </h4>
							</div>
						</td>
					</tr>
				</table></center>
				<hr style="border-color: #000; border-width: 1px;">

				<!-- School copy -->

				<hr style="border-color: #000; border-width: 1px;">
			</div>

			<div>
				<table width="100%" border="0">    
					<tr>
						<td align="right" width="80%"><?php echo get_phrase('total_amount'); ?> :</td>
						<td align="right"><?php echo $row['amount']; ?></td>
					</tr>
					<tr>
						<td align="right" width="80%"><h4><?php echo get_phrase('paid_amount'); ?> :</h4></td>
						<td align="right"><h4><?php echo $row['amount_paid']; ?></h4></td>
					</tr>
					<?php if ($row['due'] != 0):?>
						<tr>
							<td align="right" width="80%"><h4><?php echo get_phrase('due'); ?> :</h4></td>
							<td align="right"><h4><?php echo $row['due']; ?></h4></td>
						</tr>
					<?php endif;?>
				</table>

				<hr style="border-color: #000; border-width: 1px;">

				<!-- payment history -->
				<h4><?php echo get_phrase('payment_history'); ?></h4>
				<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
					<thead>
						<tr>
							<th><?php echo get_phrase('date'); ?></th>
							<th><?php echo get_phrase('amount'); ?></th>
							<th>Discount</th>
							<th><?php echo get_phrase('method'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$payment_history = $this->db->order_by('payment_id','asc')->get_where('payment', array('invoice_id' => $row['invoice_id']))->result_array();
						foreach ($payment_history as $row2):
							?>
							<tr>
								<td><?php echo $row2['timestamp']; ?></td>
								<td><?php echo $row2['amount']; ?></td>
								<td><?php echo $row2['discount']; ?></td>
								<td>
									<?php 
									if ($row2['method'] == 1)
										echo get_phrase('cash');
									if ($row2['method'] == 2)
										echo 'Cheque';
									if ($row2['method'] == 3)
										echo get_phrase('card');
									if ($row2['method'] == 'paypal')
										echo 'paypal';
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					<tbody>
					</table>
				</div>
			<?php endforeach; ?>


			<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
    	Popup($(elem).html());
    }

    function Popup(data)
    {
    	var mywindow = window.open('', 'invoice', 'height=400,width=600');
    	mywindow.document.write('<html><head><title>Invoice</title>');
    	mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
    	mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
    	mywindow.document.write('</head><body >');
    	mywindow.document.write(data);
    	mywindow.document.write('</body></html>');

    	mywindow.print();
    	mywindow.close();

    	return true;
    }

</script>