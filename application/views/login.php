<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<?=form_open('welcome/login')?>
	<input type="text" name="username">
	<input type="text" name="password">
	<input type="submit">
<?=form_close()?>
<?=validation_errors()?>
</body>
</html>