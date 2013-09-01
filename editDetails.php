<?php
session_start();
include 'func.php';
connectDB();
$ic= $_POST["ic"];
if($query=mysql_query("SELECT * FROM student WHERE ic='$ic'"))
{	
	$query_row = mysql_fetch_assoc($query);
	if(mysql_num_rows($query) == 0)
		header('Location:index.php?e=1');
	else if(strtoupper($query_row['isCheckedIn']) == 'YES')
	{
		header('Location:index.php?e=2');
	}
	else
	{
		$_SESSION['id'] = $query_row['id'];
		$_SESSION['ic'] = $query_row['ic'];
		$_SESSION['room'] = $query_row['roomNum'];
		$_SESSION['sel'] = $query_row['sel'];
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<script type='text/javascript' src='js/inputLimit.js'></script>
		<style>
		
		</style>
	</head>
	<body>
		<div class='container'><div id='alertcontainer'></div>
			<form id='detailsForm' action='confirmEditDetails.php' method='post' class='form-horizontal'>
				<fieldset>
					<legend>Please complete the following form with your details.</legend>
<?php

		$ic = $query_row['ic'];
		$last = substr($ic, -1);
		$select='';
		if($last%2==0)
			$select = 'selected="selected"';
		//name
		echo "<div class='form-group'><label for='inputName' class='col-lg-2 control-label'>Name:</label><div class='col-lg-4'><input required style='text-transform: uppercase;' type='text' type='text' id='inputName' autocomplete='off' class='form-control' value='".$query_row['name']."' name='name'/></div></div>";
		
		//ic
		echo "<div class='form-group'><label for='inputIC' class='col-lg-2 control-label'>IC number:</label><div class='col-lg-2'><input required type='text' autocomplete='off' value='".$query_row['ic']."' name='ic' id='inputICdisabled' class='form-control' pattern='[0-9]{12}' title='eg.930230035132'/></div></div>";
		
		//matric
		echo "<div class='form-group'><label for='inputMatric' class='col-lg-2 control-label'>Matric number:</label><div class='col-lg-2'><input required style='text-transform: uppercase;' type='text' autocomplete='off' value='".$query_row['matricNum']."' name='matric' id='inputMatric' class='form-control' pattern='[A-z]{3}[0-9]{6}' title='eg.WEK130014'/></div></div>";
		
		//gender
		echo "<div class='form-group'><label for='inputGender' class='col-lg-2 control-label'>Gender:</label><div class='col-lg-2'><select name='gender' class='form-control'><option>MALE</option><option $select >FEMALE</option> </select></div></div>";
		
		//phone
		echo "<div class='form-group'><label for='phone' class='col-lg-2 control-label'>Mobile phone:</label><div class='col-lg-2'><input type='tel' autocomplete='off' value='".$query_row['phone']."' name='phone' id='inputPhone' class='form-control' autofocus pattern='[0-9]{10,11}' title='eg.0123456789'/></div></div>";
		
		//emergancy phone
		echo "<div class='form-group'><label class='col-lg-2 control-label'>Emergancy contact:</label><div class='col-lg-2'><input type='tel' autocomplete='off' value='".$query_row['emergancycontact']."' name='emergancycontact' id='inputEmergancycontact' class='form-control' pattern='[0-9]{9,11}' title='eg.0123456789'/></div></div>";
		
		//email
		echo "<div class='form-group'><label for='email' class='col-lg-2 control-label'>Email (facebook):</label><div class='col-lg-2'><input type='email' autocomplete='off' value='".$query_row['email']."' name='email' id='inputEmail' class='form-control'/></div></div>";
		
		//address
		echo "<div class='form-group'><label for='inputAddress' class='col-lg-2 control-label'>Address:</label><div class='col-lg-4'><textarea required class='form-control' spellcheck='false' autocomplete='off' style='text-transform:uppercase;' name='address' rows='3'>".$query_row['address']."</textarea></div></div>";
		
		//race
		echo "<div class='form-group'><label for='inputRace' class='col-lg-2 control-label'>Race:</label><div class='col-lg-2'><select name='race' class='form-control'><option>MALAY</option> <option>CHINESE</option> <option>INDIAN</option> <option>OTHERS</option> </select></div></div>";
		
		//religion
		echo "<div class='form-group'><label for='inputReligion' class='col-lg-2 control-label'>Religion:</label><div class='col-lg-2'><select name='religion' class='form-control'><option>ISLAM</option> <option>BUDDHA</option> <option>HINDU</option> <option>CHRISTIAN</option> <option>CATALIC</option> <option>OTHERS</option> </select></div></div>";
		
		//hidden id
		echo "<input type='hidden' value='".$query_row['id']."' name='id'/>";
		
?>
<div class='form-group'><label for='laptop' class='col-lg-2 control-label'>I have a laptop/netbook</label><div class='col-lg-2'><select name='laptop' class='form-control'><option>YES</option> <option>NO</option> </select></div></div>
<div class='form-group'><div class='col-lg-2 col-lg-offset-2'><input type='submit' class='btn btn-primary' value='Confirm'/>

<?php
		if(isset($_POST['isFromRegister']) && !empty($_POST['isFromRegister']))
			echo "<a href='register.php?ic=$ic' class='btn btn-primary'>Cancel</a></div></div></form></div></body></html>";
		else
			echo "<a href='index.php' class='btn btn-primary'>Quit</a></div></div></form></div></body></html>";
	}
}
?>