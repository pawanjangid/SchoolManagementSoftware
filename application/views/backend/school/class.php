<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('class_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_class');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        
		<div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th style="background-color:#ff0000;"><div>#</div></th>
                    		<th style="background-color:#ff6a00;"><div><?php echo get_phrase('Class');?></div></th>
                            <th style="background-color:#ff9d00;"><div><?php echo get_phrase('Admission');?></div></th>
                            <th style="background-color:#ddff36;"><div><?php echo get_phrase('Session');?></div></th>
                            <th style="background-color:#5eff36;"><div><?php echo get_phrase('Exam_fee');?></div></th>
                            <th style="background-color:#36ffd7;"><div><?php echo get_phrase('Tution');?></div></th>
                            <th style="background-color:#33b3ff;"><div><?php echo get_phrase('Activity');?></div></th>
                            <th style="background-color:#1962ff;"><div><?php echo get_phrase('Sports');?></div></th>
                            <th style="background-color:#661fff;"><div><?php echo get_phrase('Computer');?></div></th>
                            <th style="background-color:#ae00ff;"><div><?php echo get_phrase('Lab');?></div></th>
                            <th style="background-color:#ff00d9;"><div><?php echo get_phrase('Development');?></div></th>
                            <th style="background-color:#ff0090;"><div><?php echo get_phrase('Other');?></div></th>
                            <th style="background-color:#00ff15;"><div><?php echo get_phrase('Total');?></div></th>
                    		<th style="background-color:#ff0000;"><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($classes as $row):?>
                        <tr>
                            <td style="background-color:#ffd3c2;"><?php echo $count++;?></td>
							<td style="background-color:#ffd4b5;"><?php echo $row['name'];?></td>
                            <td style="background-color:#ffd3c2;"><?php echo $row['admission_fee']; ?></td>
                            <td style="background-color:#f9ffdb;"><?php echo $row['session_fee']; ?></td>
                            <td style="background-color:#e6ffe0;"><?php echo $row['examination_fee']; ?></td>
                            <td style="background-color:#dbfff8;"><?php echo $row['tution_fee'] ?></td>
                            <td style="background-color:#d1eeff"><?php echo $row['extra_co_curricular'] ?></td>
                            <td style="background-color:#d1e0ff;"><?php echo $row['sports'] ?></td>
                            <td style="background-color:#dac9ff;"><?php echo $row['computer_academics'] ?></td>
                            <td style="background-color:#f3d9ff;"><?php echo $row['laboratory_fee'] ?></td>
                            <td style="background-color:#ffbff5;"><?php echo $row['development_fee'] ?></td>
                            <td style="background-color:#ffc2e4;"><?php echo $row['other_fee'] ?></td>
                            <td style="color: green;font-weight: 600;font-size: 18px;background-color:#ffffff;"><?php echo $row['total_school_fee'] ?></td>
							<td style="background-color:#ffd4b5;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_class/<?php echo $row['class_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>school/classes/delete/<?php echo $row['class_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'school/classes/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name_numeric');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name_numeric"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                                <div class="col-sm-5">
                                    <select name="teacher_id" class="form-control select2" style="width:100%;">
                                        <option value=""><?php echo get_phrase('select_teacher');?></option>
                                    	<?php 
										$teachers = $this->db->get_where('teacher', array('school_id' => $this->session->userdata('school_id')))->result_array();
										foreach($teachers as $row):
										?>
                                    	<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div style="text-align: center;"><h1>Fees Structure-(Annual)</h1></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Admission_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="admission_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Tution_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="tution_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Session_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="session_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Examination_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="examination_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Computer_Academics');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="computer_academics" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Sports');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sports" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('extra_co_curricular');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="extra_co_curricular" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Laboratory_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="laboratory_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Development_Fee');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="development_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Other_Fees');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="other_fee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>



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
                        "mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(0, false);
                            datatable.fnSetColumnVis(12, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(1, true);
                                      datatable.fnSetColumnVis(5, true);
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