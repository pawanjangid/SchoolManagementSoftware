<?php
$edit_data = $this->db->get_where('transfercertificate', array('tc_id' => $param2))->result_array();
echo $edit_data['class_id'];
foreach ($edit_data as $row):
	?>
	<center>
		<a onClick="printFunc()" class="btn btn-default btn-icon icon-left hidden-print ">
			Print 
			<i class="entypo-print"></i>
		</a>
	</center>
	<hr style="border-color: #000; border-width: 1px;">
	<div id="printarea">
		<!-- School copy -->

		<div style="clear: both;"></div>
		<img src="<?php echo base_url();?>uploads/sss_logo.png"  style="max-height:100px; max-width:100px; float: left; margin-left: 5px; margin-right: -100px;"/>
		<div style="position: absolute;"></div>

		<h2 style="color: #000; text-align: center; font-weight: 600; text-transform: uppercase; font-family: 
		Georgia"><?php echo $this->db->get_where('settings' , array('type' =>'school_name'))->row()->description;?></h3>
		<h5 style="color: #000; text-align: center; margin-top: 3px; margin-bottom: 0px;"><?php echo $this->db->get_where('settings' , array('type' =>'school_address'))->row()->description;?></h5>
		<h5 style="color: #000; text-align: center; margin-top: 3px; margin-bottom: 0px;">Ph.: <?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?></h5>
<br><br><br>
<center>
<h4 style="float: left;display: inline;">TC No.: ..........</h4><h2 style="display: inline;">TRANSFER CERIFICATE</h2><h4 style="float: right;display: inline;">SR No. <?php echo '<b>'.$row['srno'].'</b>';?></h4>
</center>
<br>
<br>
<div>
	<table style="border-style: none;width: 100%;" border="0">
		<tr style="margin-top: 20px;">
			<td>1.</td>
			<td>Name of Student :</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td>2.</td>
			<td>Father's/Guardian Name :</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->fathername;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td>3.</td>
			<td>Mother's Name :</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->mothername;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td>4.</td>
			<td>Nationality :</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->nationality;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td>5.</td>
			<td>Category :</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->category;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td>6.</td>
			<td>Date of first admission in the school with fist class:</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->date_of_admission;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td>7.</td>
			<td>Date of Birth :</td>
			<td><?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->birthday;?></td>
		</tr>
		<tr style="margin-top: 20px;">
			<td style="margin-top: 20px;">8.</td>
			<td>Class in which the pupil studied :</td>
			<td><?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name; ?></td>
		</tr>
		<tr>
			<td style="margin-top: 20px;">9.</td>
			<td>School/Board annual Exmination last taken with result :</td>
			<td><?php if($row['promotion'])
			echo "PASS";
			else 
			echo "FAIL"; ?></td>
		</tr>
		<tr>
			<td>10.</td>
			<td>whether failed. if so once/twice in same class :</td>
			<td><?php if($row['promotion'])
			echo "NO";
			else echo "YES"; ?></td>
		</tr>
		<tr>
			<td>11.</td>
			<td>Subject Studies :</td>
			<td style="border: 1px solid black;"><?php $subjects = $this->db->get_where('subject' , array('class_id' => $row['class_id'] , 'year' => $row['year'] , 'type' => 1
        ))->result_array();
			echo '<ol>';
			foreach ($subjects as $key) {
				echo '<li>'.$key['name'].'</li>'; 
			}
		echo '</ol>'; ?></td>
		</tr>
		<tr>
			<td>12.</td>
			<td>whether qualified for promotion to the high school:</td>
			<td><?php echo $row['promotion']; ?></td>
		</tr>
		<tr>
			<td></td>
			<td >if so, to which class</td>
			<td><?php if ($row['class_id'] < 13) {
				$class = $row['class_id']+1;
				echo $this->db->get_where('class' , array('class_id' => $class))->row()->name;
			} ?></td>
		</tr>
		<tr>
			<td>13.</td>
			<td>Total No. of working days :</td>
			<td><input id="att" type="text" value="342" style="border: #fff;min-width: 60px;text-align: center; max-width: 80px;font-weight: 600;font-size: 18px;" onfocusout="att(this.value);"><b id="attadd"></b></td>
		</tr>
		<tr>
			<td>14.</td>
			<td>Total No. of working days present:</td>
			<td><input id="amt" type="text" value="297" style="border: #fff;min-width: 60px;text-align: center; max-width: 80px;font-weight: 600;font-size: 18px;" onfocusout="amt(this.value);"><b id="amtadd"></b></td>
		</tr>
		<tr>
			<td>15.</td>
			<td>Whether Participate in the NCC cadet/Boy scout/Girl Guide :</td>
			<td><?php echo $row['ncc_value']; ?></td>
		</tr>
		<tr>
			<td>16.</td>
			<td>Games played or extra curricular :</td>
			<td><select id="game" style="border: #fff;min-width: 80px; max-width: 180px;font-size: 20px;-webkit-appearance:none;-moz-appearance: none;text-decoration: underline; " onfocusout="game(this.value);">
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                </select><b id="addgame"></b></td>
		</tr>
		<tr>
			<td>17.</td>
			<td>General Conduct :</td>
			<td><select id="behaviour" style="border: #fff;min-width: 80px; max-width: 180px;font-size: 20px;-webkit-appearance:none;-moz-appearance: none;text-decoration: underline; " onfocusout="behaviour(this.value);">
                    <option value="Excellent">Excellent</option>
                    <option value="Very Good">Very Good</option>
                    <option value="Good">Good</option>
                    <option value="Normal">Normal</option>
                </select><b id="behaviouradd"></b></td>
		</tr>
		<tr>
			<td>18.</td>
			<td>Date of application for certificate :</td>
			<td><?php echo $row['creation_timestamp']; ?></td>
		</tr>
		<tr>
			<td>19.</td>
			<td>Date of issue certitficate :</td>
			<td><?php echo date('d/m/Y'); ?></td>
		</tr>
		<tr>
			<td>20.</td>
			<td>Reason for leaving the institute :</td>
			<td><?php echo $row['reason']; ?></td>
		</tr>
		<tr>
			<td>21.</td>
			<td>Any other remark :</td>
			<td><textarea id="remark" style="width: 150px;height: 40px;" onfocusout="remark(this.value);"></textarea><b id="addremark"></b></td>
		</tr>


	</table>
</div>
<div style="clear: both;"></div>
<br>
<br><br><br><br><br><br><br><br>
<table style="width: 100%;">
	<tr>
		<td style="text-align: left;width: 30%;">
			signature of task Incharge
		</td>
		<td style="text-align: center;width: 30%">Checked by</td>
		<td style="text-align: right; width: 30%;">Principal</td>
	</tr>
</table>
<?php endforeach; ?>

			<script type="text/javascript">
    function printFunc() {
    	remark(document.getElementById('remark').value);
    	att(document.getElementById('att').value);
    	behaviour(document.getElementById('behaviour').value);
    	amt(document.getElementById('amt').value);
    var divToPrint = document.getElementById('printarea');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:0px solid #000;' +
        'padding:5px;' +
        'font-size:21px;'+
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
    }
</script>
<script type="text/javascript">
    function behaviour(value) {
        var beh = document.getElementById('behaviour');
        var behadd = document.getElementById('behaviouradd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function att(value) {
        var beh = document.getElementById('att');
        var behadd = document.getElementById('attadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function amt(value) {
        var beh = document.getElementById('amt');
        var behadd = document.getElementById('amtadd');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function remark(value) {
        var beh = document.getElementById('remark');
        var behadd = document.getElementById('addremark');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
    function game(value) {
        var beh = document.getElementById('game');
        var behadd = document.getElementById('addgame');
        beh.style.display = "none";
        behadd.innerHTML = value;
    }
</script>