<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>呜呜</title>
</head>
<body>
	<form action="<?php echo e(url('/rost')); ?>" method="post">
	<?php echo e(csrf_field()); ?>

		<input type="text" name="name"><br>
		<input type="password" name="pwd"><br>
		<input type="submit" value="提交">
	</form>
</body>
</html>