<?php $running_year = $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
$school_id = $this->session->userdata('school_id');
 ?>

<div class="row">
            <div class="col-md-3">
            
                <div class="tile-stats" style="background: #63d3ff; -moz-box-shadow: 3px 3px 5px 6px #ccc; -webkit-box-shadow: 3px 3px 5px 6px #ccc; box-shadow: 3px 3px 5px 6px #ccc;">
                    <div class="icon"><i class="fa fa-user" ></i></div>
                    <div class="num" data-start="0" data-end="<?php
                    $q=$this->db->get_where('enroll',array('school_id' => $school_id,'year'=>$running_year));
                    $count=$q->result_array();
                    echo sizeof($count);?>" 
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total students</p>
                </div>
                
            </div>
            <div class="col-md-3">
            
                <div class="tile-stats" style="background: #fdff9c; -moz-box-shadow: 3px 3px 5px 6px #ccc; -webkit-box-shadow: 3px 3px 5px 6px #ccc; box-shadow: 3px 3px 5px 6px #ccc;">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php
                    $q=$this->db->get_where('teacher',array('school_id' => $school_id,'year'=>$running_year));
                    $count=$q->result_array();
                    echo sizeof($count);?>" 
                            data-postfix="" data-duration="800" data-delay="0" style="color: #0000ff;">0</div>
                    
                    <h3 style="color: #0000ff;"><?php echo get_phrase('teacher');?></h3>
                   <p style="color: #0000ff;">Total teachers</p>
                </div>
                
            </div>
            <div class="col-md-3">
            
                <div class="tile-stats" style="background: #ff9c9c; -moz-box-shadow: 3px 3px 5px 6px #ccc; -webkit-box-shadow: 3px 3px 5px 6px #ccc; box-shadow: 3px 3px 5px 6px #ccc;">
                    <div class="icon"><i class="fas fa-sms"></i></div>
                    <div class="num" data-start="0" data-end="<?php

                    echo $this->db->get_where('firebase_notification',array('school_id' => $school_id))->num_rows();
                     ?>" 
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('Message');?></h3>
                   <p>Total Message</p>
                </div>
                
            </div>
            <div class="col-md-3">
            
                <div class="tile-stats" style="background: #d899ff; -moz-box-shadow: 3px 3px 5px 6px #ccc; -webkit-box-shadow: 3px 3px 5px 6px #ccc; box-shadow: 3px 3px 5px 6px #ccc;">
                    <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                    <div class="num" data-start="0" data-end="<?php
                    echo $this->db->get_where('class',array('school_id' => $school_id))->num_rows(); ?>" 
                            data-postfix="" data-duration="800" data-delay="0" style="color: #0000ff;">0</div>
                    
                    <h3 style="color: #0000ff;"><?php echo get_phrase('Classes');?></h3>
                   <p style="color: #0000ff;">Total Classes</p>
                </div>
                
            </div>
        </div>



        

<div class="row" style="margin-top: 20px;">
    <div  class="col-sm-9">
        <div class="row">
            <div class="col-sm-5">
                    <div class="row">
                        <!-- CALENDAR-->
                        <div class="col-md-12 col-xs-12">    
                            <div class="panel panel-primary " data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <i class="entypo-info"></i>
                                        <?php echo get_phrase('Quick Notification');?>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding:20px;margin-top: 10px;">
                                            <?php echo form_open(base_url() . 'school/message/whole_sms' , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label" style="text-align: center;"><?php echo "Type SMS Here..";?></label>
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <textarea type="text" class="form-control" name="Whole_SMS"
                                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" style="min-height: 100px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-5 col-sm-offset-4">
                                                        <button type="submit" class="btn btn-info"><?php echo "Send SMS to All";?></button>
                                                    </div>
                                                </div>
                                            </div>
                                             <?php echo form_close();?>

                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <!-- CALENDAR-->
                        <div class="col-md-12 col-xs-12">    
                            <div class="panel panel-primary " data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <i class="entypo-info"></i>
                                        <?php echo get_phrase('Get Info shortly');?>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding:20px;margin-top: 10px;">
                                    <div class="form-group">
                                        <div  class="row">
                                                <label class="col-sm-3 control-label">Enter Phone number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="number" id="number" value=""/>
                                                </div>
                                                <div class=" col-sm-3">
                                                    <button class="btn btn-info" onclick="get_by_number()"><?php echo get_phrase('Get Info');?></button>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Enter SR number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="srnumber" id="srnumber" value=""/>
                                            </div>
                                            <div class=" col-sm-3">
                                                <button class="btn btn-info" onclick="get_by_srnumber()"><?php echo get_phrase('Get Info');?></button>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;padding: 15px;">
                        <div id="subject_holder" name="subject_holder">
                            
                        </div>
                    </div>
                </div>                
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $payment = $this->db->order_by('payment_id desc')->get_where('payment',array('payment_type'=>'income','school_id'=>$school_id),10)->result_array();$count = 1; ?>
                        <?php foreach ($payment as $row): ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $this->db->get_where('student',array('student_id'=>$this->db->get_where('enroll',array('enroll_id'=>$row['enroll_id']))->row()->student_id))->row()->name; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo date('d-m-Y',$row['timestamp']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    
	<div class="col-md-3">
		<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
</div>



    <script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
						<?php 
						$notices	=	$this->db->get_where('noticeboard', array('school_id' => $this->session->userdata('school_id')))->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>
<script type="text/javascript">
    function get_by_number() {
        var number = document.getElementById('number').value;
    $.ajax({
            url: '<?php echo base_url();?>school/get_by_number/' + number,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }


    function get_by_srnumber() {
        var srno = document.getElementById('srnumber').value;
    $.ajax({
            url: '<?php echo base_url();?>school/get_by_srno/' + srno,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>
  
