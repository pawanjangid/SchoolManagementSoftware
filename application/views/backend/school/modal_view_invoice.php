




<?php 
$enroll = $this->db->get_where('enroll', array('enroll_id' => $param2))->row_array();
$payment = $this->db->get_where('payment', array('enroll_id' => $param2))->result_array();
$school = $this->db->get_where('school', array('school_id' => $this->session->userdata('school_id')))->row_array();
$class = $this->db->get_where('class', array('class_id' => $enroll['class_id']))->row_array();
$total_fee = $class['tution_fee']+$class['session_fee']+$class['examination_fee']+$class['computer_academics']+$class['sports']+$class['extra_co_curricular']+$class['laboratory_fee']+$class['development_fee']+$class['adminssion_fee']+$class['other_fee'];
 ?>
 <center>
 	<div>
 		<a  target="_blank" href="<?php echo base_url() . 'school/print_invoice/'.$param2; ?>" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
 	</div>
 </center>
 
 <div class="row">
 	<div class="col-sm-12">
 		<div class="col-sm-6">
 			<div class="col-sm-3">
 				<img style="height: 100%; width: 100%; object-fit: contain;" src="<?php echo base_url().'uploads/schools_logo/' . $school['image']; ?>">
 			</div>
 			<div class="col-sm-9">
 				<h3><?php echo $school['school_name']; ?></h3>
 				<h5>Address : <?php echo $school['school_address']; ?></h5>
 				<h5 style=""><?php echo $school['school_contact_primary'].', '. $school['school_contact_secondary'];?></h5>
 			</div>
 			<div class="col-sm-12">
 				<p>Student Name : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->name; ?></p>
 				<p>Father's Name : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->fathername; ?></p>
 				<p>Address : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->address; ?></p>
 			</div>
 			
 			<div class="col-sm-12">
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
 			<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 20px;">
 				Authorised By <?php echo $school['head_authority'] ?>
 			</div>
 			<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 20px;text-align: right;color: #a8a8a8;font-size: 10px;">
 				<span>Powered By Anom.in</span>
 			</div>
 		</div>
 		<div class="col-sm-6">
 			<div class="col-sm-3">
 				<img style="height: 100%; width: 100%; object-fit: contain;" src="<?php echo base_url().'uploads/schools_logo/' . $school['image']; ?>">
 			</div>
 			<div class="col-sm-9">
 				<h3><?php echo $school['school_name']; ?></h3>
 				<h5>Address : <?php echo $school['school_address']; ?></h5>
 				<h5 style=""><?php echo $school['school_contact_primary'].', '. $school['school_contact_secondary'];?></h5>
 			</div>
 			<div class="col-sm-12">
 				<p>Student Name : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->name; ?></p>
 				<p>Father's Name : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->fathername; ?></p>
 				<p>Address : <?php echo $this->db->get_where('student', array('student_id' => $enroll['student_id']))->row()->address; ?></p>
 			</div>
 			<div class="col-sm-12">
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
 			<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 20px;">
 				Authorised By <?php echo $school['head_authority'] ?>
 			</div>
 			<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 20px;text-align: right;color: #a8a8a8;font-size: 10px;">
 				<span>Powered By Anom.in</span>
 			</div>
 		</div>
 	</div>
 </div>
 