<?php 
$edit_data	=	$this->db->get_where('enroll' , array('enroll_id' => $param2))->result_array();
$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
foreach ($edit_data as $row):
    ?>

<div class="row">
	<div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><?php echo get_phrase('payment_history');?></div>
            </div>
            <div class="panel-body">
                
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<td>#</td>
                			<td><?php echo get_phrase('amount');?></td>
                			<td><?php echo get_phrase('method');?></td>
                			<td><?php echo get_phrase('date');?></td>
                		</tr>
                	</thead>
                	<tbody>
                       <?php 
                       $count = 1;
                       $payments = $this->db->get_where('payment' , array('enroll_id' => $row['enroll_id'],'year' =>$running_year))->result_array();
                       $amount_paid = 0;
                       foreach ($payments as $row2):
                           ?>
                       <tr>
                         <td><?php echo $count++;?></td>
                         <td><?php echo $row2['amount'];
                          $amount_paid =$amount_paid+$row2['amount'];
                         ?></td>
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
                    <td><?php echo date("d/m/Y",$row2['timestamp']);?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
</div>
</div>
</div>
</div>
<?php $total_fee = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->total_school_fee;
  $due = $total_fee-$amount_paid;


 ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0">
			<div class="panel-heading">
                <div class="panel-title"><?php echo get_phrase('take_payment');?></div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?school/invoice/take_payment/'.$row['enroll_id'], array(
                'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('total_amount');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" value="<?php echo $total_fee;?>" readonly/>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('amount_paid');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="amount_paid" value="<?php echo $amount_paid;?>" readonly/>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('due');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" value="<?php echo $due;?>" readonly/>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="amount" value="" max="<?php echo $due;?>" title="Entered amount is more than due" x-moz-errormessage="Entered amount is more than due"
                      placeholder="<?php echo get_phrase('enter_payment_amount');?>"/>
                  </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Discount</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="discount" placeholder="Enter Discount Value"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" placeholder="Enter Description"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                <div class="col-sm-6">
                    <select name="method" class="form-control selectboxit" onchange="takedetail(this.value);">
                        <option value="1"><?php echo get_phrase('cash');?></option>
                        <option value="2" ><?php echo 'Cheque';?></option>
                        <option value="3"><?php echo get_phrase('card');?></option>
                    </select>
                </div>
            </div>
            <div id="bank_detail" style="display: none" class="form-group">
            <div class="form-group">
                <label class="col-sm-3 control-label">Bank Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Bank_name" placeholder="Enter Bank Name"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Cheque Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Bank_name" placeholder="Enter Cheque Number"/>
                </div>
            </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                <div class="col-sm-6">
                    <select name="status" class="form-control selectboxit">
                        <option value="paid"><?php echo get_phrase('paid');?></option>
                        <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                    </select>
                </div>
            </div>

            <div class="form-group">
               <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
               <div class="col-sm-6">
                   <input type="text" class="form-control datepicker" name="timestamp" 
                   value="<?php echo date('d/m/Y') ?>"/>
               </div>
           </div>

           <input type="hidden" name="student_id" value="<?php echo $row['student_id'];?>">

           <div class="form-group">
              <div class="col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('take_payment');?></button>
              </div>
          </div>

          <?php echo form_close();?>
      </div>
  </div>
</div>
</div>


<?php endforeach;?>
<script type="text/javascript">
  function takedetail(value1) {
   
    if (value1 == 2) {
      document.getElementById('bank_detail').style.display = 'block';
    }else{
      document.getElementById('bank_detail').style.display = 'none';
    }

  }

</script>