<?php
session_start();
include 'func.php';
connectDB();
if(!isset($_SESSION['ic']))
	header("Location:index.php");
else
{
	if(isset($_POST['s2']))
	{
		$values = "NULL,'".$_SESSION['id'];
		for($i = 1; $i < 24; $i+=1)
		{
			$t =  "s".$i;
			$values .= "','".$_POST[$t];
		}
		$values .= "',''";
		$result=mysql_query("INSERT INTO activity VALUES($values)");
		if($result!=1)
		{
			errMsg("activity insert query failed");
			die();
		}
		header('Location:confirmRegistration.php');
		
	}
	else
		header('Location:activities.php');
}
?>