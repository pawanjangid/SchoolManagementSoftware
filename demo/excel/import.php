<?php
include 'db.php';
if(isset($_POST["Import"])){
 
 
		echo $filename=$_FILES["file"]["tmp_name"];
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 				
	           $sql_student = "INSERT into student (`name`, `fathername`, `mothername`, `birthday`,`sex`, `religion`, `blood_group`,`address`,`email`,`password`,`category`,`nationality`,`date_of_admission`) 
	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]','$emapData[9]','$emapData[10]','$emapData[11]','$emapData[12]')";
	           $sql_student_id = "select `student_id` from student where name='$emapData[0]' AND fathername='$emapData[1]' AND mothername = '$emapData[2]'";
	           $result_student = mysql_query( $sql_student, $conn );
	           if (!$result_student) {
    die('Invalid query: ' . mysql_error());
}
	           $result_student_id = mysql_query( $sql_student_id, $conn );
	           $row = mysql_fetch_array($result_student_id);
	           $student_id = $row['student_id'];
	            $sql_enroll = "INSERT into enroll (`student_id`, `class_id`, `section_id`, `srno`,`roll`, `date_added`, `year`) 
	            	values('$student_id','$emapData[13]','$emapData[14]','$emapData[15]','$emapData[16]','$emapData[17]','$emapData[18]')";
	          
	          $result_enroll = mysql_query( $sql_enroll, $conn );
				if(! $result_student )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";
 
				}
 
	         }
	         fclose($file);
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
			mysql_close($conn); 
 
 
 
		 }
	}
	else {
		echo "<script type=\"text/javascript\">
						alert(\"Please select EXCEL/CSV file.\");
						window.location = \"index.php\"
					</script>";
	}	 
?>