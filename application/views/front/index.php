<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<?php include 'include_top.php'; ?>
</head>
<body>
	<div class="site-wrap">
		<?php include 'header.php'; ?>
		<?php include 'pages/'.$page_name.'.php'; ?>
		<?php include 'footer.php'; ?>
		
	</div>
<?php include 'include_bottom.php'; ?>
</body>
</html>