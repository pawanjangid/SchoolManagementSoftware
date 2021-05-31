<hr />
<div class="row">
	<div class="col-md-12">
		<?php echo form_open(base_url() . 'index.php?school/tabulation_sheet');?>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label"><?php echo get_phrase('class');?></label>
					<select name="class_id" class="form-control selectboxit" onchange="get_class_section(this.value)">
                        <option value=""><?php echo get_phrase('select_a_class');?></option>
                        <?php 
                        $classes = $this->db->get_where('class',array('school_id' => $this->session->userdata('school_id')))->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"
                            	<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<div id="subject_holder2">
				<div class="col-md-3">
					<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
						<select name="" id="" class="form-control selectboxit" disabled="disabled">
							<option value=""><?php echo get_phrase('select_class_first');?></option>		
						</select>
					</div>
				</div>
			</div>
			
			<div id="subject_holder3">
				<div class="col-md-3">
					<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam');?></label>
						<select name="" id="" class="form-control selectboxit" disabled="disabled">
							<option value=""><?php echo get_phrase('select_class_first');?></option>		
						</select>
					</div>
				</div>
			</div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-4" style="margin-top: 20px;">
				<button type="submit" class="btn btn-info"><?php echo get_phrase('view_tabulation_sheet');?></button>
			</div>
		<?php echo form_close();?>
	</div>
</div>

<?php if ($class_id != '' && $exam_id != ''):?>
<br>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8" style="text-align: center;">
		<div class="tile-stats tile-gray">
		<div class="icon"><i class="entypo-docs"></i></div>
			<h3 style="color: #696969;">
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id,'school_id' => $this->session->userdata('school_id')))->row()->name; 
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id,'school_id' => $this->session->userdata('school_id')))->row()->name; 
					$section_name = $this->db->get_where('section' , array('section_id' => $section_id,'school_id' => $this->session->userdata('school_id')))->row()->name;
					echo get_phrase('tabulation_sheet');
				?>
			</h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('class') . ' ' . $class_name;?> : <?php echo get_phrase('section').' '.$section_name;?> <br>
				Exam : <?php echo $exam_name;?>
			</h4>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>


<hr />

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr><td style="text-align: center;">
					<?php echo get_phrase('roll_no');?></td>
				<td style="text-align: center;">
					<?php echo get_phrase('students');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('subjects');?> <i class="entypo-right-thin"></i>
				</td>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year,'school_id' => $this->session->userdata('school_id'),'type'=> "1"))->result_array();
					foreach($subjects as $row):
				?>
					<td style="text-align: center;"><?php echo $row['name'];?></td>
				<?php endforeach;?>
				<td style="text-align: center;"><?php echo get_phrase('total');?></td>
				<!-- <td style="text-align: center;"><?php echo get_phrase('average_grade_point');?></td> -->
				</tr>
			</thead>
			<tbody>
			<?php
				$students = $this->db->order_by('roll')->get_where('enroll' , array('class_id' => $class_id , 'section_id' => $section_id ,'school_id' => $this->session->userdata('school_id')))->result_array();
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align: center;">
						<?php echo $row['roll'];?>
					</td>
					<td style="text-align: center;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;
					$total_grade_point = 0;  
					foreach($subjects as $row2):
				?>
					<td style="text-align: center;">
						<?php 
							$obtained_mark_query = 	$this->db->get_where('mark' , array(
													'class_id' => $class_id , 
														'exam_id' => $exam_id , 
															'subject_id' => $row2['subject_id'] , 
																'student_id' => $row['student_id'],
																	'year' => $running_year
												));
							if ( $obtained_mark_query->num_rows() > 0) {
								$obtained_marks = $obtained_mark_query->row()->mark_obtained;
								echo $obtained_marks;
								if ($obtained_marks >= 0 && $obtained_marks != '') {
									$grade = $this->crud_model->get_grade($obtained_marks);
									$total_grade_point += $grade['grade_point'];
								}
								$total_marks += $obtained_marks;
							}
							

						?>
					</td>
				<?php endforeach;?>
				<td style="text-align: center;"><?php echo $total_marks;?></td>
				<!-- <td style="text-align: center;">
					<?php 
						// $this->db->where('class_id' , $class_id);
						// $this->db->where('year' , $running_year);
						// $this->db->from('subject');
						// $number_of_subjects = $this->db->count_all_results();
						// echo ($total_grade_point / $number_of_subjects);
					?>
				</td> -->
				</tr>

			<?php endforeach;?>

			</tbody>
		</table>
		<center>
			<a href="<?php echo base_url();?>index.php?school/tabulation_sheet_print_view/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>" 
				class="btn btn-primary" target="_blank">
				<?php echo get_phrase('print_tabulation_sheet');?>
			</a>
		</center>
	</div>
</div>
<?php endif;?>

<script type="text/javascript">
	function get_class_section(class_id) {
		
		$.ajax({
            url: '<?php echo base_url();?>index.php?school/marks_get_section/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder2').html(response);
            }
        });
        get_class_exam(class_id);
	}
	function get_class_exam(class_id) {
		
		$.ajax({
            url: '<?php echo base_url();?>index.php?school/marks_get_exam/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder3').html(response);
            }
        });
	}
	
</script>
