<?php
function connectDB(){
	mysql_connect('localhost','root','');
	mysql_select_db('student_registration');
}
function getFac($matric){
	$f = $matric[0];
	if($f == 'B' || $f == 'b')
		return "ALAM BINA";
	else if($f == 'I' || $f == 'i')
		return "AKADEMIK PENGAJIAN ISLAM";
	else if($f == 'J' || $f == 'j')
		return "AKADEMIK PENGAJIAN MELAYU";
	else if($f == 'T' || $f == 't')
		return "BAHASA DAN LINGUISTIK";
	else if($f == 'E' || $f == 'e')
		return "EKOMONI DAN PENTADBIRAN";
	else if($f == 'K' || $f == 'k')
		return "KEJURUTERAAN";
	else if($f == 'P' || $f == 'p')
		return "PENDIDIKAN";
	else if($f == 'C' || $f == 'c')
		return "PERNIAGAAN DAN PERAKAUNAN";
	else if($f == 'R' || $f == 'r')
		return "PUSAT KEBUDAYAAN";
	else if($f == 'V' || $f == 'v')
		return "PUSAT SUKAN";
	else if($f == 'S' || $f == 's')
		return "SAINS";
	else if($f == 'W' || $f == 'w')
		return "SAINS KOMPUTER DAN TEKNOLOGI MAKLUMAT";
	else if($f == 'A' || $f == 'a')
		return "SAINS SOSIAL";
	else if($f == 'L' || $f == 'l')
		return "UNDANG-UNDANG";
}
function errMsg($msg){
	echo "<div class='alert alert-danger' style='clear:both;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Opps, something went wrong. Please inform PM EMO 0163201966 for help.<br />Error msg: $msg.</div>";
}

function dangerMsg($msg){
	echo "<div class='alert alert-danger' style='clear:both;'><button type='button' class='close' data-dismiss='alert'>&times;</button>$msg</div>";
}
function successMsg($msg){
	echo "<div class='alert alert-success' style='clear:both;'><button type='button' class='close' data-dismiss='alert'>&times;</button>$msg</div>";
}

function showTable($result){
?>	
	<div style="clear:left">
		<form action='getExcel.php' method='post' id='tabledataform'>
		<span class="label label-info" style="font-size:12px;">TIP!</span>
		<span style="font-size:11px">Sort multiple columns simultaneously by holding down the <i><b>shift key</b></i> and clicking a second, third or even fourth column header!</span>
		<input id='tabledata' type='hidden' value='' name='data'/>
		<a href='#' class='pull-right masterTooltip' id='asubmit' title="Click 'Yes' for the warning message when opening the file in Excel. Then save the file as .xlsx file."><img src='img/exceldl.png' height='12px'/> Download this table</a>
		</form>	
		<table id="myTable" class="table-striped table-bordered table-hover tablesorter">
			<thead>
				<tr>
					<th width='50px'>No</th> 
					<th>Name</th> 
					<th width='140px'>IC num</th> 
					<th width='130px'>Matric</th> 
					<th width='80px'>Gender</th> 
					<th width='90px'>Race</th> 
					<th width='70px'>Room</th> 
					<th width='100px'>Checked in</th> 
					<th width='70px'>Laptop</th> 
					<th width='60px'>Info</th> 
					<th width='90px'>Action</th> 
				</tr>
			</thead>
			<tbody>
<?php	
	$tabledata = 'No\tName\tIC num\tMatric\tGender\tRace\tRoom\tChecked in\tLaptop\tPhone\tAddress\tCheck in time\n';
	$count = 1;
	//while($query_row=mysql_fetch_assoc($result))
	while($query_row=mysql_fetch_array($result))
	{
		$tabledata.=$count.'\t'.strtoupper($query_row["name"]).'\t'.substr($query_row["ic"],0,6).'-'.substr($query_row["ic"],5,2).'-'.substr($query_row["ic"],8,4).'\t'.strtoupper($query_row["matricNum"]).'\t'.strtoupper($query_row["gender"]).'\t'.strtoupper($query_row["race"]).'\t'.strtoupper($query_row["roomNum"]).'\t'.strtoupper($query_row["isCheckedIn"]).'\t'.strtoupper($query_row["haveLaptop"]).'\t'.substr($query_row["phone"],0,3).'-'.substr($query_row["phone"],3,8).'\t'.strtoupper($query_row["address"]).'\t'.$query_row["checkInTime"].'\n';
		$fon = $query_row["phone"];
		$email = $query_row["email"];
		$add = $query_row["address"];
		$religion = strtoupper($query_row["religion"]);
		$inTime = $query_row["checkInTime"];
		$ic = $query_row["ic"];
		echo '<tr><td>'.$count++;
		echo "</td><td>".strtoupper($query_row["name"]);
		echo "</td><td>".substr($query_row["ic"],0,6).'-'.substr($query_row["ic"],5,2).'-'.substr($query_row["ic"],8,4);
		echo "</td><td>".strtoupper($query_row["matricNum"]);
		echo "</td><td>".strtoupper($query_row["gender"]);
		echo "</td><td>".strtoupper($query_row["race"]);
		echo "</td><td>".strtoupper($query_row["roomNum"]);
		echo "</td><td>".strtoupper($query_row["isCheckedIn"]);
		echo "</td><td>".strtoupper($query_row["haveLaptop"]);
		echo "</td><td class='masterTooltip' title='Phone: <i>$fon</i> <br>Email: <i>$email</i> <br>Address: <i>$add</i> <br>Religion: <i>$religion</i><br>Check In Time: <i>$inTime</i>'>More";
		echo "</td><td><a href='adminhome.php?r=5&ic=$ic'>Edit</a> <a href='adminhome.php?r=6&ic=$ic'>Delete</a>";
		echo '</td></tr>';
	}
	echo '</tbody></table></div>';
	echo '<script>$("#tabledata").val("'.$tabledata.'");
	$(document).ready(function(){
		$("#asubmit").click(function(){
			$("#tabledataform").submit();
		});

	});</script>';
}
?>