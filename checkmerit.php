<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<style>
			*{
				transition: all 300ms;
			}
		</style>
	</head>
	<body><br><br><div class='container' style='position:relative;'>
<?php
if(isset($_POST['ic']) && isset($_POST['matric']))
{
	$con = new mysqli('127.0.0.1','root','','student_registration');
	$result = $con->query("SELECT id, name from student WHERE ic = '$_POST[ic]' AND matricNum = '$_POST[matric]'");
	if($result->num_rows > 0)
	{
		$student = $result->fetch_assoc();
		$sid = $student['id'];
		$participations = $con->query("SELECT * from participation p INNER JOIN event e ON e.id = p.event_ID INNER JOIN merit m ON m.id = p.merit_ID WHERE student_ID = $sid ORDER BY m.merit");
		if($participations->num_rows > 0)
		{
?>
	<div style='width:800px;margin:auto;margin-top:10px;'>
		<h3>Nama: <b><?php echo $student['name']?></b></h3>
		<table id="myTable" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width='50px' class="text-center">No</th>
					<th width='620px'>Acara/Projek</th>
					<th width='130px' class="text-center">Markah Merit</th>
				</tr>
			</thead>
			<tbody>
<?php
		$total = 0;
		$x = 1;
		while($participate = $participations->fetch_assoc())
		{
			echo '<tr><td class="text-center">'.$x.'.</td>';
			echo '<td>'.$participate['name'].' &mdash; '.$participate['involvement'].'</td>';
			echo '<td class="text-center">'.$participate['merit'].'</td></tr>';
			$total += intval($participate['merit']);
			$x++;
		}
?>
			<tr><td colspan='2' align='right'>Jumlah: </td><td class="text-center"><?php echo $total?></td></tr>
			</tbody>
		</table><br>
		<center><a href='checkmerit.php' class='btn btn-primary' style='transition: all 300ms;'>Kembali</a></center>
	</div>
<?php
		}
		else
			echo '<p>Tiada rekod aktiviti.</p>';
	}
	else
		header("checkmerit.php?error");
}
else
{
	if(isset($_GET['error']))
		echo "<p>Tiada rekod pelajar kombinasi nombor IC dan matrik</p>";
?>
<div style='width:400px;height:330px;margin:auto;margin-top:5%;'>
	<center><img src='img/kk8logo.jpg' /><h2>Kolej Kediaman Kinabalu</h2></center>
	
	<div style='border-radius:15px;background: -webkit-linear-gradient(#f0f0ff, #ccccee);background: -moz-linear-gradient(#f0f0ff, #ccccee);padding:30px;padding-bottom:10px'>
		<form action='checkmerit.php' method='post' class='form-horizontal' ><fieldset>
				<div class='form-group'>
					<label for='inputIC' class='col-lg-5 control-label'>Nombor I/C:</label>
					<div class='col-lg-7'>
						<input required type='text' value='' name='ic' id='inputICdisabled' class='form-control' pattern='[0-9]{12}' title='eg.930230035132'/>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputMatric' class='col-lg-5 control-label'>Nombor Matrik:</label>
					<div class='col-lg-7'>
						<input required style='text-transform: uppercase;' type='text' value='' name='matric' id='inputMatric' class='form-control' pattern='[A-z]{3}[0-9]{6}' title='eg.WEK130014'/>
					</div>
				</div>
			<div class='form-group'><center><input type='submit' class='btn btn-primary' value='Semak Markah Merit'  style='transition: all 300ms;'/></center></div>
			</fieldset>
		</form>
	</div>
</div>
<?php
}
?>
</div>
</body>
</html>