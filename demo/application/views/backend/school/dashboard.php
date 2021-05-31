<?php $running_year = $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
$school_id = $this->session->userdata('school_id');
 ?>

<hr />
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
                    <div class="panel-body" style="padding:0px;margin-top: 10px;">
                            <div class="form-group">
                        <label class="col-sm-2 control-label">Enter Phone number</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="number" id="number" value=""/>
                        </div>
                        <div class=" col-sm-1">
                            <button class="btn btn-info" onclick="get_by_number()"><?php echo get_phrase('Get Info');?></button>
                        </div>
                        <div>
                           <label class="col-sm-2 control-label">Enter SR number</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="srnumber" id="srnumber" value=""/>
                        </div> 
                        </div>
                        <div class=" col-sm-1">
                            <button class="btn btn-info" onclick="get_by_srnumber()"><?php echo get_phrase('Get Info');?></button>
                        </div>

    </div>
                    </div>
                </div>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div id="subject_holder" name="subject_holder">
        
    </div>
</div>
<div class="row" style="margin-top: 20px;">
	<div class="col-md-8">
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
    
	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats" style="background: #ff8000; -moz-box-shadow: 3px 3px 5px 6px #ccc; -webkit-box-shadow: 3px 3px 5px 6px #ccc; box-shadow: 3px 3px 5px 6px #ccc;">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php
                    $q=$this->db->get_where('enroll',array('school_id' => $school_id,'year'=>$running_year));
                    $count=$q->result_array();
                    echo sizeof($count);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total students</p>
                </div>
                
            </div>
            <div class="col-md-12">
            
                <div class="tile-stats" style="background: #ffffff; -moz-box-shadow: 3px 3px 5px 6px #ccc; -webkit-box-shadow: 3px 3px 5px 6px #ccc; box-shadow: 3px 3px 5px 6px #ccc;">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php
                    $q=$this->db->get_where('teacher',array('school_id' => $school_id,'year'=>$running_year));
                    $count=$q->result_array();
                    echo sizeof($count);?>" 
                    		data-postfix="" data-duration="800" data-delay="0" style="color: #0000ff;">0</div>
                    
                    <h3 style="color: #0000ff;"><?php echo get_phrase('teacher');?></h3>
                   <p style="color: #0000ff;">Total teachers</p>
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
            url: '<?php echo base_url();?>index.php?school/get_by_number/' + number,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }


    function get_by_srnumber() {
        var srno = document.getElementById('srnumber').value;
    $.ajax({
            url: '<?php echo base_url();?>index.php?school/get_by_srno/' + srno,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>
  
