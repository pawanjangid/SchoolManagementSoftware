<hr />
<div class="row">
	<div class="col-md-12">

   <ul class="nav nav-tabs bordered">
    <li class="active">
     <a href="#unpaid" data-toggle="tab">
      <span class="hidden-xs"><?php echo get_phrase('create_single_invoice');?></span>
    </a>
  </li>
  <li>
   <a href="#paid" data-toggle="tab">
    <span class="hidden-xs"><?php echo get_phrase('create_mass_invoice');?></span>
  </a>
</li>
</ul>
<div class="tab-content">
  <br>
  <div class="tab-pane active" id="unpaid">
    <!-- creation of single invoice -->
    <?php echo form_open(base_url() . 'index.php?school/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
    <div class="row">
     <div class="col-md-6">
       <div class="panel panel-default panel-shadow" data-collapsed="0">
         <div class="panel-heading">
           <div class="panel-title"><?php echo get_phrase('invoice_informations');?></div>
         </div>
         <div class="panel-body">
           <div class="form-group">
             <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
             <div class="col-sm-9">
               <select name="class_id" class="form-control selectboxit"
               onchange="return get_class_students(this.value);">
               <option value=""><?php echo get_phrase('select_class');?></option>
               <?php 
               $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
               foreach ($classes as $row):
                ?>
                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label" onclick="sortSelect(); this.style.color='red';" style="font-weight: 600;"><?php echo get_phrase('student');?> &#8595;</label>
          <div class="col-sm-9">
            <select name="student_id" class="form-control" style="width:100%;" id="student_selection_holder">
              <option value=""><?php echo get_phrase('select_class_first');?></option>
            </select>
          </div>
        </div>

	                               <!--  <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="form-control" name="title"/>
	                                    </div>
	                                </div>
	                                <div class="form-group">
                                       <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                       <div class="col-sm-9">
                                           <input type="text" class="form-control" name="description"/>
                                       </div>
                                     </div> -->

                                     <div class="form-group">
                                       <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                       <div class="col-sm-9">
                                         <input type="text" class="datepicker form-control" name="date"
                                         data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                       </div>
                                     </div>

                                   </div>
                                 </div>
                               </div>

                               <div class="col-md-6">
                                <div class="panel panel-default panel-shadow" data-collapsed="0">
                                  <div class="panel-heading">
                                    <div class="panel-title"><?php echo get_phrase('payment_informations');?></div>
                                  </div>
                                  <div class="panel-body">

                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Tuition Fee</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tution_amount"
                                        placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Term Fee</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="term_amount"
                                        placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Admission Fee</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="admission_amount"
                                        placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Computer Lab</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="complab_amount"
                                        placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Examination Fee</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="exam_amount"
                                        placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Sibling</label>
                                      <div class="col-sm-9">
                                        <select name="sibling" class="form-control selectboxit" onchange="document.getElementById('hiddenbydefault1').style.display='block';document.getElementById('hiddenbydefault2').style.display='block';">
                                          <option value="No">No</option>
                                          <option value="Yes">Yes</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group" id="hiddenbydefault1" style="display: none;">
                                     <label class="col-sm-3 control-label"><?php echo get_phrase('Sibling\'s class');?></label>
                                     <div class="col-sm-9">
                                      <select name="sibling_class_id" class="form-control selectboxit"
                                       onchange="return get_class_students2(this.value);">
                                       <option value=""><?php echo get_phrase('select_class');?></option>
                                       <?php 
                                       $classes = $this->db->get('class')->result_array();
                                       foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                      <?php endforeach;?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group" id="hiddenbydefault2" style="display: none;">
                                  <label class="col-sm-3 control-label" onclick="sortSelect2(); this.style.color='red';" style="font-weight: 600;"><?php echo get_phrase('sibling\' name');?> &#8595;</label>
                                  <div class="col-sm-9">
                                    <select name="sibling_student_id" class="form-control" style="width:100%;" id="student_selection_holder2">
                                      <option value=""><?php echo get_phrase('select_class_first');?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Others</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" name="others_amount"
                                    placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                    data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" name="amount_paid"
                                    placeholder="<?php echo get_phrase('enter_payment_amount');?>"
                                    data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Description</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" name="amount_paid_desc"
                                    placeholder="<?php echo get_phrase('enter_description');?>" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                  <div class="col-sm-9">
                                    <select name="status" class="form-control selectboxit">
                                      <option value="paid"><?php echo get_phrase('paid');?></option>
                                      <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                                  <div class="col-sm-9">
                                    <select name="method" class="form-control selectboxit" onchange="takedetail(this.value);">
                                      <option value="1"><?php echo get_phrase('cash');?></option>
                                      <option value="2"><?php echo 'Cheque';?></option>
                                      <option value="3"><?php echo 'Card';?></option>
                                    </select>
                                  </div>
                                </div>
                                <div id="bank_detail" style="display: none">
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Bank Name</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="bank_name"
                                      placeholder="<?php echo "Bank Name";?>" />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Cheque Number</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="cheque_number"
                                      placeholder="<?php echo "Cheque Number";?>" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('add_invoice');?></button>
                              </div>
                            </div>
                          </div>


                        </div>
                        <?php echo form_close();?>

                        <!-- creation of single invoice -->

                      </div>
                      <div class="tab-pane" id="paid">

                        <!-- creation of mass invoice -->
                        <?php echo form_open(base_url() . 'index.php?school/invoice/create_mass_invoice' , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
                        <br>
                        <div class="row">
                          <div class="col-md-1"></div>
                          <div class="col-md-5">

                           <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                            <div class="col-sm-9">
                              <select name="class_id" class="form-control selectboxit"
                              onchange="return get_class_students_mass(this.value)">
                              <option value=""><?php echo get_phrase('select_class');?></option>
                              <?php 
                              $classes = $this->db->get('class')->result_array();
                              foreach ($classes as $row):
                               ?>
                               <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                             <?php endforeach;?>

                           </select>
                         </div>
                       </div>



                    <!-- <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="description"/>
                        </div>
                      </div> -->


                      <div class="form-group">
                        <label class="col-sm-3 control-label">Tuition Fee</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="tution_amount"
                          placeholder="<?php echo get_phrase('enter_total_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Term Fee</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="term_amount"
                          placeholder="<?php echo get_phrase('enter_total_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Admission Fee</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="admission_amount"
                          placeholder="<?php echo get_phrase('enter_total_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Computer/Lab</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="complab_amount"
                          placeholder="<?php echo get_phrase('enter_total_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Examination Fee</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="exam_amount"
                          placeholder="<?php echo get_phrase('enter_total_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Others</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="others_amount"
                          placeholder="<?php echo get_phrase('enter_total_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="amount_paid"
                          placeholder="<?php echo get_phrase('enter_payment_amount');?>"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                        <div class="col-sm-9">
                          <select name="status" class="form-control selectboxit">
                            <option value="paid"><?php echo get_phrase('paid');?></option>
                            <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                        <div class="col-sm-9">
                          <select name="method" onchange="alert('hello');" class="form-control selectboxit" >
                            <option value="1"><?php echo get_phrase('cash');?></option>
                            <option value="2"><?php echo "Cheque";?></option>
                            <option value="3"><?php echo get_phrase('card');?></option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                        <div class="col-sm-9">
                          <input type="text" class="datepicker form-control" name="date"
                          data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-3">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('add_invoice');?></button>
                        </div>
                      </div>



                    </div>
                    <div class="col-md-6">
                     <div id="student_selection_holder_mass"></div>
                   </div>
                 </div>
                 <?php echo form_close();?>

                 <!-- creation of mass invoice -->

               </div>

             </div>


           </div>
         </div>

         <script type="text/javascript">
	// function check() {
 //    	$("#selectall").click(function () {
 //    		$("input:checkbox").prop('checked', $(this).prop("checked"));
	// 	});
	// }

	function select() {
		var chk = $('.check');
   for (i = 0; i < chk.length; i++) {
    chk[i].checked = true ;
  }

		//alert('asasas');
	}
	function unselect() {
		var chk = $('.check');
   for (i = 0; i < chk.length; i++) {
    chk[i].checked = false ;
  }
}
</script>

<script type="text/javascript">

  function get_class_students(class_id) {
    $.ajax({
      url: '<?php echo base_url();?>index.php?school/get_class_students/' + class_id ,
      success: function(response)
      {
        jQuery('#student_selection_holder').html(response);
      }
    });
  }

  function get_class_students2(class_id) {
    $.ajax({
      url: '<?php echo base_url();?>index.php?school/get_class_students/' + class_id ,
      success: function(response)
      {
        jQuery('#student_selection_holder2').html(response);
      }
    });
  }

  function sortSelect() {
    var selElem = document.getElementById('student_selection_holder');
    var tmpAry = new Array();
    for (var i=0;i<selElem.options.length;i++) {
      tmpAry[i] = new Array();
      tmpAry[i][0] = selElem.options[i].text;
      tmpAry[i][1] = selElem.options[i].value;
    }
    tmpAry.sort();
    while (selElem.options.length > 0) {
      selElem.options[0] = null;
    }
    for (var i=0;i<tmpAry.length;i++) {
      var op = new Option(tmpAry[i][0], tmpAry[i][1]);
      selElem.options[i] = op;
    }
    return;
  }

  function sortSelect2() {
    var selElem = document.getElementById('student_selection_holder2');
    var tmpAry = new Array();
    for (var i=0;i<selElem.options.length;i++) {
      tmpAry[i] = new Array();
      tmpAry[i][0] = selElem.options[i].text;
      tmpAry[i][1] = selElem.options[i].value;
    }
    tmpAry.sort();
    while (selElem.options.length > 0) {
      selElem.options[0] = null;
    }
    for (var i=0;i<tmpAry.length;i++) {
      var op = new Option(tmpAry[i][0], tmpAry[i][1]);
      selElem.options[i] = op;
    }
    return;
  }
</script>

<script type="text/javascript">
  function get_class_students_mass(class_id) {

    $.ajax({
      url: '<?php echo base_url();?>index.php?school/get_class_students_mass/' + class_id ,
      success: function(response)
      {
        jQuery('#student_selection_holder_mass').html(response);
      }
    });


  }

  function takedetail(value1) {

    if (value1 == 2) {
      document.getElementById('bank_detail').style.display = 'block';
    }else{
      document.getElementById('bank_detail').style.display = 'none';
    }

  }
</script>

