<!DOCTYPE html>
<?php 
	include 'db.php';
 
?>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Import Excel To Mysql Database Using PHP </title>
		<meta name="import excel file" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">
 	<style type="text/css">
.button {
    background-color: black; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
}
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn {
  border: 2px solid blue;
  color: blue;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
 	</style>
 
 <style>
table {
    border-collapse: collapse;
    
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #133771;
    color: white;
}
</style>
	</head>
	<body> 
	<div>
		<div >
			<div class="container"> 
				<a data-toggle="collapse" data-target=".nav-collapse">
				</a>
				<a href="#">Load All data with your existing matter</a>
 
			</div>
		</div>
	</div>
 
	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span6" id="form-login" style="text-orientation: upright;margin-left: auto; margin-right: auto; text-align: center;">
				<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data" >
					<fieldset >
						<legend style="text-align: center;font-weight: 600;color: red;"><h1>Import CSV/Excel file</h1></legend>
						<div class="control-group">
							<div class="control-label">
								<label style="color: gold;"><h2>choose CSV/Excel File:</h2></label>
							</div>
							<div class="upload-btn-wrapper">
								<button class="btn">Upload a file</button>
								<input type="file" name="file" id="file">
							</div>
						</div>
 
						<div class="control-group">
							<div class="controls">
								
							<button type="submit" id="submit" class="button" name="Import"  data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			
		</div>
 <div class="control-group" style="text-align: center;margin-top: 20px;margin-bottom: 20px;">
							<div class="controls">
								<a href="sample.csv">
							<button type="button" id="submit" class="button"  data-loading-text="Loading..." >DOWNLOAD SAMPLE FILE</button></a>
							</div>
						</div>
		<table border="1" width="100%" style="margin-top: 20px;">
			<thead>
				  	<tr>
				  		<th>Name</th>
				  		<th>Father Name</th>
				  		<th>Mother Name</th>
				  		<th>Sex</th>
				  		<th>Address</th>
 
 
				  	</tr>	
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM student ";
				$result_set =  mysql_query($SQLSELECT, $conn);
				while($row = mysql_fetch_array($result_set))
				{
				?>
 
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['fathername']; ?></td>
						<td><?php echo $row['mothername']; ?></td>
						<td><?php echo $row['sex']; ?></td>
						<td><?php echo $row['address']; ?></td>
 
 
					</tr>
				<?php
				}
			?>
		</table>
		<table border="1" style="float: left;width: 50%;margin-top: 20px;">
			<thead>	
				<tr>
						<td colspan="2" style="text-align: center;">CLASS ID</td>
 
					</tr>
				  	<tr>
				  		
				  		<th>Name</th>
				  		<th>Class id</th>
				  		
 
 
				  	</tr>	
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM class ";
				$result_set =  mysql_query($SQLSELECT, $conn);
				while($row = mysql_fetch_array($result_set))
				{
				?>
 					
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['class_id']; ?></td>
 
					</tr>
				<?php
				}
			?>
		</table>
		<table border="1" style="float: right;width: 50%;margin-top: 20px;">
			<thead>	
					<tr>
						<td colspan="2" style="text-align: center;">SECTION ID</td>
 
					</tr>
				  	<tr>
				  		<th>Name</th>
				  		<th>Class id</th>
				  		
 
 
				  	</tr>	
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM section ";
				$result_set =  mysql_query($SQLSELECT, $conn);
				while($row = mysql_fetch_array($result_set))
				{
				?>
 
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['section_id']; ?></td>
 
					</tr>
				<?php
				}
			?>
		</table>
	</div>
 
	</div>
 
	</body>
</html>