<style type="text/css">
	
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    float: left;
  }
  .col-sm-12 {
    width: 100%;
  }
  .col-sm-11 {
    width: 91.66666667%;
  }
  .col-sm-10 {
    width: 83.33333333%;
  }
  .col-sm-9 {
    width: 75%;
  }
  .col-sm-8 {
    width: 66.66666667%;
  }
  .col-sm-7 {
    width: 58.33333333%;
  }
  .col-sm-6 {
    width: 49%;
  }
  .col-sm-5 {
    width: 41.66666667%;
  }
  .col-sm-4 {
    width: 33.33333333%;
  }
  .col-sm-3 {
    width: 25%;
  }
  .col-sm-2 {
    width: 16.66666667%;
  }
  .col-sm-1 {
    width: 8.33333333%;
  }
  .dataTable {
  width: 100% !important;
}
.table-bordered {
  border: 1px solid #ebebeb;
}
table {
  background-color: transparent;
}
caption {
  padding-top: 8px;
  padding-bottom: 8px;
  color: #999999;
  text-align: left;
}
th {
  text-align: left;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 17px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ebebeb;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ebebeb;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ebebeb;
}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
}
.table-bordered {
  border: 1px solid #ebebeb;
}
</style>



<?php 
$enroll = $this->db->get_where('enroll', array('enroll_id' => $enroll_id))->row_array();
$payment = $this->db->get_where('payment', array('enroll_id' => $enroll_id))->result_array();
$school = $this->db->get_where('school', array('school_id' => $this->session->userdata('school_id')))->row_array();
$class = $this->db->get_where('class', array('class_id' => $enroll['class_id']))->row_array();
$total_fee = $class['tution_fee']+$class['examination_fee']+$class['session_fee']+$class['computer_academics']+$class['sports']+$class['extra_co_curricular']+$class['laboratory_fee']+$class['development_fee']+$class['adminssion_fee']+$class['other_fee'];
 ?>

 <div class="row" id="print">
 	<div class="col-sm-12">
 		<div class="col-sm-6" style="">
 			<div class="col-sm-12" style="max-height: 200px;min-height: 100px;">
 			<div class="col-sm-2">
 				<img style="height: 100%; width: 100%; object-fit: contain;max-height: 150px;" src="<?php echo base_url().'uploads/school_image/' . $school['image']; ?>">
 			</div>
 			<div class="col-sm-10" style="">
 				<h2 style="padding: 3px;text-align: center;text-transform: uppercase;"><?php echo $school['school_name']; ?></h2>
 				<p style="margin-top: -20px;font-size: 14px;padding: 6px;text-align: center;">Address : <?php echo $school['school_address']; ?>, <?php echo $school['school_contact_primary'].', '. $school['school_contact_secondary'];?></p>
 			</div>
 			</div>
 			<div style="clear: both;"></div>
 			<div class="col-sm-12" style="margin-top: -10px;">
 				<span style="padding: 10px;padding-left: 30px;padding-right: 30px;font-size: 18px;font-weight: 600;text-decoration: underline;">Institute Copy</span>
 			</div>
 			<div style="float: right;margin-top: -20px;margin-right: 20px;">Receipt No.-<?php echo $enroll_id . '/' . sizeof($payment); ?></div>
 			<div class="col-sm-12" style="padding: 20px;font-size: 18px;margin-top: 0px;">
 				<p style="margin-top: -10px;">Student Name : <b style="text-transform: uppercase;"><?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->name; ?></b></p>
 				<p style="margin-top: -10px;">Father's Name : <b><?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->fathername; ?></b></p>
 				<p style="margin-top: -10px;">Address : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->address; ?></p>
 			</div>

 			
 			<div class="col-sm-12" style="margin-top: -10px;">
 				<table class="table table-bordered datatable" style="width: 100%;border : 1px solid black;padding: 3px;font-size: 12px;">
 					<thead>
 						<tr>
 							<td>SNo.</td>
 							<td colspan="3">Description</td>
 							<td>Amount (INR)</td>
 						</tr>
 					</thead>
 					<tbody>
 						<tr>
 							<td>1. </td>
 							<td colspan="3">Tuition Fee</td>
 							<td><?php echo $class['tution_fee']; ?></td>
 						</tr>
 						<tr>
 							<td>2. </td>
 							<td colspan="3">Admission Fee</td>
 							<td><?php echo $class['admission_fee']; ?></td>
 						</tr>
 						<tr>
 							<td>3. </td>
 							<td colspan="3">Session Fee</td>
 							<td><?php echo $class['session_fee']; ?></td>
 						</tr>
            <tr>
              <td>4. </td>
              <td colspan="3">Examination Fee</td>
              <td><?php echo $class['examination_fee']; ?></td>
            </tr>
            
 						<tr>
 							<td>5. </td>
 							<td colspan="3">Computer Fee</td>
 							<td><?php echo $class['computer_academics']; ?></td>
 						</tr>
 						<tr>
 							<td>6. </td>
 							<td colspan="3">Laboratory Fee</td>
 							<td><?php echo $class['laboratory_fee']; ?></td>
 						</tr>
 						<tr>
 							<td>6. </td>
 							<td colspan="3">Sports</td>
 							<td><?php echo $class['sports']; ?></td>
 						</tr>
 						<tr>
 							<td>8. </td>
 							<td colspan="3">Development Fee</td>
 							<td><?php echo $class['development_fee']; ?></td>
 						</tr>
 						<tr>
 							<td>9. </td>
 							<td colspan="3">Curricular Activity Fee</td>
 							<td><?php echo $class['extra_co_curricular']; ?></td>
 						</tr>
 						<tr>
 							<td>10. </td>
 							<td colspan="3">Other Fee</td>
 							<td><?php echo $class['other_fee']; ?></td>
 						</tr>
 						<tr style="font-weight: 600;">
 							<td colspan="4">Total Institute Fee</td>
 							<td ><?php echo $class['total_school_fee']; ?></td>
 						</tr>
 						<tr>
 							<td colspan="5" style="text-align: center;font-weight: 600;">Total Payment Detail</td>
 						</tr>
 						<tr style="font-weight: 600;">
 							<td>SNo.</td>
 							<td>Description</td>
 							<td>Date</td>
 							<td>Discount</td>
 							<td>Amount</td>
 						</tr>
 						<?php $count = 1;$total_paid = 0;$total_discount = 0; ?>
 						<?php foreach ($payment as $row) : ?>
 						<tr style="background-color: #D4FFC2;">
 							<td><?php echo $count . '.'; ?> </td>
 							<td style="overflow: hidden;"><?php echo $row['title']; ?></td>
 							<td><?php echo date('d/m/y', $row['timestamp']); ?></td>
 							<td><?php echo $row['discount']; $total_discount += $row['discount']; ?></td>
 							<td><?php echo $row['amount']; $total_paid += $row['amount']; ?></td>
 						</tr>
 						<?php $count += 1; ?>
 						<?php endforeach; ?>
 						<tr>
 							<td colspan="3">Total</td>
 							<td ><?php echo $total_discount; ?></td>
 							<td ><?php echo $total_paid; ?></td>
 						</tr>
 						<tr style="background-color: #FFDCC2;">
 							<td colspan="4">Due Amount</td>
 							<td ><?php echo $class['total_school_fee']-$total_paid-$total_discount; ?></td>
 						</tr>
 					</tbody>
 				</table>
 			</div>
 			<div class="col-sm-12" style="padding: 10px;">
 				Authorised By <?php echo $school['head_authority'] ?>
 			</div>
 			<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 20px;text-align: right;color: #a8a8a8;font-size: 10px;padding-right: 20px;">
 				<span style="margin-right: 20px;">Powered By Anom.in</span>
 			</div>
 		</div>
 		<div class="col-sm-6" style="">
 			<div class="col-sm-12" style="max-height: 200px;min-height: 100px;">
 			<div class="col-sm-2">
 				<img style="height: 100%; width: 100%; object-fit: contain;max-height: 150px;" src="<?php echo base_url().'uploads/school_image/' . $school['image']; ?>">
 			</div>
 			<div class="col-sm-10" style="">
 				<h2 style="padding: 3px;text-align: center;text-transform: uppercase;"><?php echo $school['school_name']; ?></h2>
 				<p style="margin-top: -20px;font-size: 14px;padding: 6px;text-align: center;">Address : <?php echo $school['school_address']; ?>, <?php echo $school['school_contact_primary'].', '. $school['school_contact_secondary'];?></p>
 			</div>
 			</div>
 			<div style="clear: both;"></div>
 			<div class="col-sm-12" style="margin-top: -10px;">
 				<span style="padding: 10px;padding-left: 30px;padding-right: 30px;font-size: 18px;font-weight: 600;text-decoration: underline;">Student Copy</span>
 			</div>
 			<div style="float: right;margin-top: -20px;margin-right: 20px;">Receipt No.-<?php echo $enroll_id . '/' . sizeof($payment); ?></div>
 			<div class="col-sm-12" style="padding: 20px;font-size: 18px;margin-top: 0px;">
 				<p style="margin-top: -10px;">Student Name : <b style="text-transform: uppercase;"><?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->name; ?></b></p>
 				<p style="margin-top: -10px;">Father's Name : <b><?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->fathername; ?></b></p>
 				<p style="margin-top: -10px;">Address : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->address; ?></p>
 			</div>

 			
 			<div class="col-sm-12" style="margin-top: -10px;">
 				 <table class="table table-bordered datatable" style="width: 100%;border : 1px solid black;padding: 3px;font-size: 12px;">
          <thead>
            <tr>
              <td>SNo.</td>
              <td colspan="3">Description</td>
              <td>Amount (INR)</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1. </td>
              <td colspan="3">Tuition Fee</td>
              <td><?php echo $class['tution_fee']; ?></td>
            </tr>
            <tr>
              <td>2. </td>
              <td colspan="3">Admission Fee</td>
              <td><?php echo $class['admission_fee']; ?></td>
            </tr>
            <tr>
              <td>3. </td>
              <td colspan="3">Session Fee</td>
              <td><?php echo $class['session_fee']; ?></td>
            </tr>
            <tr>
              <td>4. </td>
              <td colspan="3">Examination Fee</td>
              <td><?php echo $class['examination_fee']; ?></td>
            </tr>
            
            <tr>
              <td>5. </td>
              <td colspan="3">Computer Fee</td>
              <td><?php echo $class['computer_academics']; ?></td>
            </tr>
            <tr>
              <td>6. </td>
              <td colspan="3">Laboratory Fee</td>
              <td><?php echo $class['laboratory_fee']; ?></td>
            </tr>
            <tr>
              <td>6. </td>
              <td colspan="3">Sports</td>
              <td><?php echo $class['sports']; ?></td>
            </tr>
            <tr>
              <td>8. </td>
              <td colspan="3">Development Fee</td>
              <td><?php echo $class['development_fee']; ?></td>
            </tr>
            <tr>
              <td>9. </td>
              <td colspan="3">Curricular Activity Fee</td>
              <td><?php echo $class['extra_co_curricular']; ?></td>
            </tr>
            <tr>
              <td>10. </td>
              <td colspan="3">Other Fee</td>
              <td><?php echo $class['other_fee']; ?></td>
            </tr>
            <tr style="font-weight: 600;">
              <td colspan="4">Total Institute Fee</td>
              <td ><?php echo $class['total_school_fee']; ?></td>
            </tr>
            <tr>
              <td colspan="5" style="text-align: center;font-weight: 600;">Total Payment Detail</td>
            </tr>
            <tr style="font-weight: 600;">
              <td>SNo.</td>
              <td>Description</td>
              <td>Date</td>
              <td>Discount</td>
              <td>Amount</td>
            </tr>
            <?php $count = 1;$total_paid = 0;$total_discount = 0; ?>
            <?php foreach ($payment as $row) : ?>
            <tr style="background-color: #D4FFC2;">
              <td><?php echo $count . '.'; ?> </td>
              <td style="overflow: hidden;"><?php echo $row['title']; ?></td>
              <td><?php echo date('d/m/y', $row['timestamp']); ?></td>
              <td><?php echo $row['discount']; $total_discount += $row['discount']; ?></td>
              <td><?php echo $row['amount']; $total_paid += $row['amount']; ?></td>
            </tr>
            <?php $count += 1; ?>
            <?php endforeach; ?>
            <tr>
              <td colspan="3">Total</td>
              <td ><?php echo $total_discount; ?></td>
              <td ><?php echo $total_paid; ?></td>
            </tr>
            <tr style="background-color: #FFDCC2;">
              <td colspan="4">Due Amount</td>
              <td ><?php echo $class['total_school_fee']-$total_paid-$total_discount; ?></td>
            </tr>
          </tbody>
        </table>
 			</div>
 			<div class="col-sm-12" style="padding: 10px;">
 				Authorised By <?php echo $school['head_authority'] ?>
 			</div>
 			<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 20px;text-align: right;color: #a8a8a8;font-size: 10px;padding-right: 20px;">
 				<span style="margin-right: 20px;">Powered By Anom.in</span>
 			</div>
 		</div>
 	</div>
 </div>
 <script type="text/javascript">
 
   window.print();
   window.close();
 </script>