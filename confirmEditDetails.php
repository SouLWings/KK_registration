<?php
session_start();
include 'func.php';
connectDB();
if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['matric']) && !empty($_POST['matric']) && isset($_POST['phone']) && isset($_POST['emergancycontact']) && isset($_POST['email']) && isset($_POST['gender']) && !empty($_POST['gender']) && isset($_POST['address']) && !empty($_POST['address']) && isset($_POST['race']) && !empty($_POST['race']) &&  isset($_POST['religion']) && !empty($_POST['religion']))
{
	$name = strtoupper($_POST['name']);
	$ic = $_POST['ic'];
	$id = $_POST['id'];
	$matric = strtoupper($_POST['matric']);
	$phone = $_POST['phone'];
	$emergancy = $_POST['emergancycontact'];
	$email = strtoupper($_POST['email']);
	$gender = strtoupper($_POST['gender']);
	$address = strtoupper($_POST['address']);
	$race = strtoupper($_POST['race']);
	$religion = strtoupper($_POST['religion']);
	$laptop = strtoupper($_POST['laptop']);
	$result=mysql_query("UPDATE student SET name=UPPER('$name'), ic = '$ic', matricNum = UPPER('$matric'), phone = '$phone', emergancycontact = '$emergancy', email = '$email', gender = UPPER('$gender'), address = UPPER('$address'), race = UPPER('$race'), religion = UPPER('$religion'), haveLaptop = '$laptop' WHERE id = $id");

	if($result==1)
		header("Location:register.php");
	else 
		echo errMsg('Update query failed when confirm edit details.');
}
else
	echo errMsg('Post variables not complete.');
?>
