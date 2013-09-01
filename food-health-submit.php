<?php
session_start();
include 'func.php';
connectDB();
if(!isset($_SESSION['ic']))
	header("Location:index.php");
else
{
	$ic= $_SESSION["ic"];
	$id= $_SESSION['id'];
	if(isset($_POST['vege']) && isset($_POST['food']) && isset($_POST['medcine']) && isset($_POST['surgery'])  && isset($_POST['illness']) && isset($_POST['country'])  && isset($_POST['vaccine']))
	{
		$values = "NULL, ".$id.", '".$_POST['vege']."', '";
		foreach ($_POST['food'] as $food){
			$values .= $food;
		}
		$values .= "', '".$_POST['medcine'].$_POST['medcinename']."', '";
		if($_POST['surgery']=='No')
			$values .= $_POST['surgery']."', '";
		else
			$values .= $_POST['surgery'].' name='.$_POST['surgeryname'].', time='.$_POST['surgerytime']."', '";
		
		foreach ($_POST['illness'] as $ill){
			$values .= $ill;
		}	
		
		$values .= "', '".$_POST['country'].$_POST['countryname']."', '".$_POST['vaccine'].$_POST['vaccinetime']."'";
		$result = mysql_query("INSERT INTO health VALUES($values)");

		header('Location:activities.php');
	}
	else
		header('Location:food-health.php');
}
?>