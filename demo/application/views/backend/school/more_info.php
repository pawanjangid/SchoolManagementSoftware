<?php
$student_info	=	$this->db->get_where('enroll' , array(
    'student_id' => $student_id,'school_id' => $this->session->userdata('school_id') , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->description
    ))->result_array();
foreach($student_info as $row):?>

<div class="profile-env col-sm-6">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h2>
                                <?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?>                     
                            </h2>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                
                    <?php if($row['class_id'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('class');?></td>
                        <td><b><?php echo $this->crud_model->get_class_name($row['class_id']);?></b></td>
                    </tr>
                    <?php endif;?>

                    <?php if($row['section_id'] != '' && $row['section_id'] != 0):?>
                    <tr>
                        <td><?php echo get_phrase('section');?></td>
                        <td><b><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['roll'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('roll');?></td>
                        <td><b><?php echo $row['roll'];?></b></td>
                    </tr>

                    <?php endif;?>
                    <tr>
                        <td><?php echo get_phrase('SR No.');?></td>
                        <td><b><?php echo $row['srno'];?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Father_name');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->fathername;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Mother Name');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->mothername;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('birthday');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->birthday;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('gender');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->sex;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Category');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->category;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('phone');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('address');?></td>
                        <td><b><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->address;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Print Marksheet');?></td>
                        <td><div>
              	<a href="<?php echo base_url();?>index.php?school/student_marksheet_print_view/<?php echo $row['student_id'];?>" target="_blank" class="btn btn-info" >Print Marksheet</a>
              </div></td>
                    </tr>
                    
                    <tr>
                        <td><?php echo get_phrase('Fee Receipt');
                         $invoice_id = $this->db->get_where('invoice' , array('student_id' => $row['student_id'])) ->row()->invoice_id;
                         ?></td>

                        <td><a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $invoice_id;?>');">
                                            <i class="entypo-credit-card"></i>
                                            <?php echo get_phrase('view_invoice');?>
                                        </a></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('Charactor Certificate');?></td>
                        <td>
                            <a target="_blank" href="<?php echo base_url();?>index.php?school/charactor/<?php echo $row['student_id'];?>">
                                                <i class="entypo-vcard"></i>
                                                    <?php echo get_phrase('Charactor_Certificate');?>
                                                </a>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('parent_phone');?></td>
                        <td><b><?php echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;?></b></td>
                    </tr>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>
<div class="col-sm-6">
	<?php 
$edit_data	=	$this->db->get_where('invoice' , array('student_id' => $student_id) )->result_array();
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
                       $payments = $this->db->get_where('payment' , array(
                         'invoice_id' => $row['invoice_id']
                         ))->result_array();
                       foreach ($payments as $row2):
                           ?>
                       <tr>
                         <td><?php echo $count++;?></td>
                         <td><?php echo $row2['amount'];?></td>
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
                    <td><?php echo $row2['timestamp'];?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
</div>
</div>
</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0">
			<div class="panel-heading">
                <div class="panel-title"><?php echo get_phrase('take_payment');?></div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/invoice/take_payment/'.$row['invoice_id'], array(
                'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('total_amount');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" value="<?php echo $row['amount'];?>" readonly/>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('amount_paid');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="amount_paid" value="<?php echo $row['amount_paid'];?>" readonly/>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('due');?></label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" value="<?php echo $row['due'];?>" readonly/>
                  </div>
              </div>
              <div>
              	<a href="#" class="btn btn-info" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');">Take Payment</a>
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
</div>

<?php endforeach;?>
<div style="clear: both"></div>