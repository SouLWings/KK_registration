<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<style>
		
		</style>
	</head>
	<body><br><br><div class='container'>
<?php
if(isset($_POST['ic']) && isset($_POST['matric']))
{
	$con = new mysqli('127.0.0.1','root','','student_registration');
	$result = $con->query("SELECT id from student WHERE ic = '$_POST[ic]' AND matricNum = '$_POST[matric]'");
	if($result->num_rows > 0)
	{
		$sid = $result->fetch_assoc()['id'];
		$participations = $con->query("SELECT * from participation p INNER JOIN event e ON e.id = p.event_ID INNER JOIN merit m ON m.id = p.merit_ID WHERE student_ID = $sid ORDER BY m.merit");
		if($participations->num_rows > 0)
		{
?>
		<table id="myTable" class="table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width='50px'>No</th>
					<th>Acara/Projek</th>
					<th width='130px'>Markah Merit</th>
				</tr>
			</thead>
			<tbody>
<?php
		$total = 0;
		$x = 1;
		while($participate = $participations->fetch_assoc())
		{
			echo '<tr><td>'.$x.'.</td>';
			echo '<td>'.$participate['name'].'</td>';
			echo '<td>'.$participate['merit'].'</td></tr>';
			$total += intval($participate['merit']);
			$x++;
		}
?>
			<tr><td colspan='2' align='right'>Jumlah</td><td><?php echo $total?></td></tr>
			</tbody>
		</table><br>
		<a href='checkmerit.php' class='btn btn-primary'>Kembali</a>
<?php
		}
		else
			echo 'Tiada rekod aktiviti.';
	}
	else
		header("checkmerit.php?error");
}
else
{
	if(isset($_GET['error']))
		echo "<p>Rekod pelajar kombinasi nombor IC dan matrik tidak dalam rekod";
?>

<form action='checkmerit.php' method='post' class='form-horizontal'><fieldset>
	<legend>Masukan nombor IC dan Matrik</legend>
	<div class='form-group'><label for='inputIC' class='col-lg-2 control-label'>IC number:</label><div class='col-lg-2'><input required type='text' value='' name='ic' id='inputICdisabled' class='form-control' pattern='[0-9]{12}' title='eg.930230035132'/></div></div>
	<div class='form-group'><label for='inputMatric' class='col-lg-2 control-label'>Matric number:</label><div class='col-lg-2'><input required style='text-transform: uppercase;' type='text' value='' name='matric' id='inputMatric' class='form-control' pattern='[A-z]{3}[0-9]{6}' title='eg.WEK130014'/></div></div>
	<div class='form-group'><div class='col-lg-2 col-lg-offset-2'><input type='submit' class='btn btn-primary' value='Semak'/></div></div>
	</fieldset>
</form>

<?php
}
?>
</div>
</body>
</html>