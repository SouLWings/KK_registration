<?php
session_start();
include 'func.php';
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<style>
			html { 
				background: url(img/bg.jpg) no-repeat center center fixed;
			}
		</style>
	</head><body>
<?php
if(isset($_POST['username']) && isset($_POST['password']))
	if(!empty($_POST['username']) && !empty($_POST['password']))
		if($_POST['username']=='iamPM' && $_POST['password']=='password')
		{
			$_SESSION['login']=true;
			header('Location:adminhome.php');
		}
		else
			echo '<h3>Incorrect username and password combination</h3>';
	else
		echo '<h3>Please enter both username and password field.</h3>';
?>
<div style='float:right; font-size:0.7em;'><a href='index.php'>Back to welcome page</a></div>
<div style='height:1px;'></div>
<div class='box' style='width:220px;'>
<h2>Admin sign in</h2>
<form action='adminlogin.php' method='post'>
Username: <br><input type='text' name='username' autofocus/><br>
Password: <br><input type='password' name='password'/><br><br>
<center><input type='submit' value='Sign in'/></center>
</form>
</div>
</body></html>