<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<script type='text/javascript' src='js/inputLimit.js'></script>
		<style>
			dd{
				padding-left:40px;
			}
			dl{
				padding-top:5px;
			}
			dt{
				margin-left:10px;
				line-height:2;
			}
			form{
				margin-right:15px;
				margin-left:-10px;
			}
		</style>
	</head>
	<body>
		<div class='container'><div id='alertcontainer'></div>
<?php
include 'func.php';
connectDB();
$ic= $_SESSION["ic"];
echo "<legend>Please check your details. Press 'Edit Details' if there is anything you wish to change</legend><dl class='dl-horizontal'>";
if($result=mysql_query("SELECT * FROM student WHERE ic='$ic'"))
	if(mysql_num_rows($result) == 1)
	{	
		$query_row=mysql_fetch_assoc($result);
		echo "<dt>Name:</dt><dd>".$query_row["name"]."</dd><br />";
		echo "<dt> IC number:</dt><dd>".$query_row["ic"]."</dd><br />";
		echo "<dt> Matric number:</dt><dd>".$query_row["matricNum"]."</dd><br />";
		echo "<dt> Faculty:</dt><dd>".getFac($query_row["matricNum"])."</dd><br />";
		echo "<dt> Gender:</dt><dd>".$query_row["gender"]."</dd><br />";
		echo "<dt> Mobile Phone:</dt><dd>".$query_row["phone"]."</dd><br />";
		echo "<dt> Emergancy contact:</dt><dd>".$query_row["emergancycontact"]."</dd><br />";
		echo "<dt> Email:</dt><dd>".$query_row["email"]."</dd><br />";
		echo "<dt> Address:</dt><dd>".nl2br($query_row["address"])."</dd><br />";
		echo "<dt> Race:</dt><dd>".$query_row["race"]."</dd><br />";
		echo "<dt> Religion:</dt><dd>".$query_row["religion"]."</dd><br />";
		echo "<dt> Having laptop:</dt><dd>".$query_row["haveLaptop"]."</dd><br />";
?>
<dt></dt><dd>
<form action='food-health.php' method='post' class='pull-left'>
<input type='submit' value='Next Step' class='btn btn-primary btn-small'/>
</form>
<form action='editDetails.php' method='post' class='pull-left'>
<input type='hidden' value='<?php echo $ic;?>' name='ic'/>
<input type='hidden' value='YES' name='isFromRegister'/>
<input type='submit' value='Edit Details' class='btn btn-primary btn-small'/>
</form>

<form class='pull-left'>
<a href='index.php' class='btn btn-primary btn-small '>Quit</a>.
</form>
</dl></div></body></html>
<?php
	}
	else
	{
		header("Refresh: 5;url=index.php");
		echo 'No student with such IC found. Returning to <a href="index.php">welcome page</a> in 5 seconds.';
	}

?>