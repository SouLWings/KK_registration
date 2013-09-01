<?php 
session_start();
if(isset($_SESSION['login']))
{
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<link rel="stylesheet" type="text/css" href="css/adminstyle.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.js"></script>	
		<script type='text/javascript' src='js/inputLimit.js'></script>
		<script>
			$(document).ready(function(){
				$("#myTable").tablesorter(); 
				$('.masterTooltip').hover(function(){
					var title = $(this).attr('title');
					$(this).data('tipText', title).removeAttr('title');
					$('<div class="btn-default btn-small guide"></div>').html(title).appendTo('body').fadeIn('slow');
				}, function() {
					$(this).attr('title', $(this).data('tipText'));
					$('.guide').remove();
				}).mousemove(function(e) {
						var mousex = e.pageX + 20; //Get X coordinates
						var mousey = e.pageY + 10; //Get Y coordinates
						$('.guide').css({ top: mousey, left: mousex })
				});
			});
			
			//script to highlight a table to be copy
			/*<input type="button" value="select table" onclick="selectElementContents( document.getElementById('table') );">
			function selectElementContents(el) {
				var body = document.body, range, sel;
				if (document.createRange && window.getSelection) {
					range = document.createRange();
					sel = window.getSelection();
					sel.removeAllRanges();
					try {
						range.selectNodeContents(el);
						sel.addRange(range);
					} catch (e) {
						range.selectNode(el);
						sel.addRange(range);
					}
				} else if (body.createTextRange) {
					range = body.createTextRange();
					range.moveToElementText(el);
					range.select();
				}
			}			
			
			*/
		</script>
	</head>
	<body>

		<div class="navbar navbar-fixed-top">
			<div class='container'>
				<a href="adminhome.php?r=1" class="navbar-brand">View</a>
				<a href="adminhome.php?r=4" class="navbar-brand">Add</a>
				<!--<a href="adminhome.php?r=5" class="navbar-brand">Edit</a>
				<a href="adminhome.php?r=6" class="navbar-brand">Delete</a>-->
				<a href="adminhome.php?r=3" class="navbar-brand">Statistic</a>
				<a href='index.php' class="pull-right btn btn-primary btn-small" style='margin-top:9px'>Log out</a>
			</div>
		</div>
		<div class='container'>
		
<?php
	include 'func.php';
	connectDB();
	if(isset($_GET['r']) && !empty($_GET['r']))
	{
		if($_GET['r'] == '1' || $_GET['r'] == '2')
		{
	?>
			<form action='adminhome.php' method='get' class="form-inline navbar-text pull-left">
					<input type='hidden' value='2' name='r'/>
					<input type='text' style='width:180px;' autocomplete="off" class='form-control input-small masterTooltip' placeholder='part of name, ic, or matric' name='keyword' title='Leave it blank to search for all student'/>
					
					<select style='width:120px;' name='checkedIn' class='form-control input-small'>
						<option value=''>Checked In</option>
						<option>YES</option>
						<option>NO</option>
					</select>
					
					<select style='width:120px;' name='gender' class='form-control input-small'>
						<option value=''>Gender</option>
						<option>MALE</option>
						<option>FEMALE</option>
					</select>
					
					<select style='width:120px;' name='laptop' class='form-control input-small'>
						<option value=''>Laptop</option>
						<option>YES</option>
						<option>NO</option>
					</select>
					
					<select style='width:120px;' name='race' class='form-control input-small'>
						<option value=''>Race</option>
						<option>MALAY</option>
						<option>CHINESE</option>
						<option>INDIAN</option>
						<option>OTHERES</option>
					</select>
					
					<select style='width:120px;' name='fac' class='form-control input-small'>
						<option value=''>Faculty</option>
						<option value='B'>FAB</option>
						<option value='I'>API</option>
						<option value='J'>APM</option>
						<option value='T'>FBL</option>
						<option value='E'>FEP</option>
						<option value='K'>FK</option>
						<option value='P'>FP</option>
						<option value='C'>FPP</option>
						<option value='R'>PK</option>
						<option value='V'>PS</option>
						<option value='S'>FS</option>
						<option value='W'>FSKTM</option>
						<option value='A'>FSSS</option>
						<option value='L'>FUU</option>
					</select>
					
					<select style='width:120px;' name='floor' class='form-control input-small'>
						<option value=''>Floor</option>
						<option value='A1'>A100</option>
						<option value='A2'>A200</option>
						<option value='A3'>A300</option>
						<option value='B1'>B100</option>
						<option value='B2'>B200</option>
						<option value='B3'>B300</option>
						<option value='B4'>B400</option>
						<option value='C1'>C100</option>
						<option value='C2'>C200</option>
						<option value='C3'>C300</option>
						<option value='D1'>D100</option>
						<option value='D2'>D200</option>
						<option value='D3'>D300</option>
						<option value='E1'>E100</option>
						<option value='E2'>E200</option>
						<option value='E3'>E300</option>
						<option value='E4'>E400</option>
						<option value='F1'>F100</option>
						<option value='F2'>F200</option>
						<option value='F3'>F300</option>
						<option value='F4'>F400</option>
					</select>
					
					<input type='submit' value='Search' class='btn btn-primary btn-small'/>
				</form>
				
	<?php	
		}
		
		/**
		 * --------------------------
		 *   r = 1 Show all student 
		 * --------------------------
		 * extra parameter 
		 *		a(action) = d(delete) || e(edit)
		 *		s(success) = t(true) || f(false)
		 *		ic = $ic
		 */
		if($_GET['r'] == '1')
		{
			if(isset($_GET['s']))
			{
				if($_GET['s'] == 't')
				{
					if(isset($_GET['a']) && !empty($_GET['a']))
					{
						$ic = '';
						if(isset($_GET['ic']) && !empty($_GET['ic']))
							$ic = $_GET['ic'];
						if($_GET['a'] == 'd')
						{
							successMsg("Student record with IC $ic is deleted successfully.");
						}
						else if($_GET['a'] == 'e')
						{
							successMsg("Student record with IC $ic is updated successfully.");
						}
					}
				}
				else if($_GET['s'] == 'f')
				{
					if(isset($_GET['a']) && !empty($_GET['a']))
					{
						$ic = '';
						if(isset($_GET['ic']) && !empty($_GET['ic']))
							$ic = $_GET['ic'];
						if($_GET['a'] == 'd')
						{
							if(isset($_GET['e']) && !empty($_GET['e']))
								if($_GET['e'] == 1)
									errMsg("Delete query failed, IC = $ic.");
								else if($_GET['e'] == 2)
									errMsg("Student with IC = $ic not found.");
								else if($_GET['e'] == 3)
									errMsg("Incomplete form submittion");
						}
						else if($_GET['a'] == 'e')
						{
							if(isset($_GET['e']) && !empty($_GET['e']))
								if($_GET['e'] == 1)
									errMsg("Update query failed, IC = $ic.");
								else if($_GET['e'] == 2)
									errMsg("Student with IC = $ic not found.");
								else if($_GET['e'] == 3)
									errMsg("Incomplete form submittion");
						}
					}
				}
			}
			if($result=mysql_query("SELECT * FROM student ORDER BY id"))
				showTable($result);
			else
				echo errMsg('Select query failed');
		}	
		
		
		/**
		 * -----------------------
		 *   r = 2 search result 
		 * -----------------------
		 */
		else if($_GET['r'] == '2')
			if(isset($_GET['keyword']) && isset($_GET['checkedIn']) && isset($_GET['laptop']) && isset($_GET['gender']) && isset($_GET['race']) && isset($_GET['fac']) && isset($_GET['floor']))
			{
				$key = $_GET['keyword'];
				$extraFilter = '';
				if(!empty($_GET['checkedIn']))
					$extraFilter .= ' AND isCheckedIn = \''.$_GET['checkedIn'].'\'';
				if(!empty($_GET['laptop']))
					$extraFilter .= ' AND haveLaptop = \''.$_GET['laptop'].'\'';
				if(!empty($_GET['gender']))
					$extraFilter .= ' AND gender = \''.$_GET['gender'].'\'';
				if(!empty($_GET['race']))
					$extraFilter .= ' AND race = \''.$_GET['race'].'\'';
				if(!empty($_GET['fac']))
					$extraFilter .= ' AND matricNum LIKE \''.$_GET['fac'].'%\'';
				if(!empty($_GET['floor']))
					$extraFilter .= ' AND roomNum LIKE \''.$_GET['floor'].'%\'';
					
				if($result=mysql_query("SELECT * FROM student WHERE (lower(name) LIKE lower('%$key%') OR ic LIKE lower('%$key%') OR lower(matricNum) LIKE lower('%$key%')) $extraFilter"))
				{
					if(mysql_num_rows($result) == 0)
						echo "<div class='alert alert-danger' style='clear:left;'>No student found.</div>";
					else
					{
						echo "<div class='alert alert-success' style='clear:left;'>".mysql_num_rows($result)." student(s) found.</div>";
						showTable($result);
					}
				}
			}
			else
				echo errMsg('Keyword query failed');
				
		/**
		 * --------------------------
		 *   r = 3 statistical view 
		 * --------------------------
		 */
		else if($_GET['r'] == '3')
		{
			echo '<meta http-equiv="Refresh" content="3">';
			echo '<table style="margin:auto;margin-top:15px;line-height:2;font-size:1em;" class ="table-striped table-hover  statistic">';
			echo '<tr><th style="background:#e6eeee;"></th><th style="background:#e6eeee;">Checked in</th><th style="background:#e6eeee;">Not checked in</th><th style="background:#e6eeee;">Total</th></tr>';
			
			echo '<tr></tr><tr><td>Malay students</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND lower(race) = 'malay'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND lower(race) = 'malay'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(race) = 'malay'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo '<tr><td>Chinese students</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND lower(race) = 'chinese'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND lower(race) = 'chinese'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(race) = 'chinese'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo '<tr><td>Indian students</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND lower(race) = 'indian'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND lower(race) = 'indian'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(race) = 'indian'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';	
			
			echo '<tr><td>Other races students</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND lower(race) = 'others'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND lower(race) = 'others'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(race) = 'others'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo '<tr><td style="border:1px solid; border-color:black white black white;"><strong>All students</strong><br></td><td style="border:1px solid; border-color:black white black white;">';
			
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo "</td><td style='border:1px solid; border-color:black white black white;'>";
			
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];	
			echo "</td><td style='border:1px solid; border-color:black white black white;'>";
			
			if($result=mysql_query("SELECT count(id) as total FROM student"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];		
			echo '</td></tr>';
			
			echo "<tr><td style='height:20px;'> </td></tr><tr><td>Male students</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND lower(gender) = 'male'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND lower(gender) = 'male'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(gender) = 'male'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo '<tr><td>Female students<br></td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND lower(gender) = 'female'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND lower(gender) = 'female'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(gender) = 'female'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo '<tr><td style="border:1px solid; border-color:black white black white;"><strong>All students</strong><br></td><td style="border:1px solid; border-color:black white black white;">';
			
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo "</td><td style='border:1px solid; border-color:black white black white;'>";
			
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];		
			echo "</td><td style='border:1px solid; border-color:black white black white;'>";
			
			if($result=mysql_query("SELECT count(id) as total FROM student"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];	
			echo '</td></tr>';	
			

			echo "<tr><td style='height:20px;'> </td></tr><tr><td>Alam bina</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'B%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'B%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'B%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Akademik Pengajian Islam</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'I%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'I%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'I%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Akademik Pengajian Melayu</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'J%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'J%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'J%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Bahasa dan Linguistik</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'T%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'T%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'T%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Ekonomi dan Pentadbiran</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'E%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'E%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'E%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Kejuruteraan</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'K%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'K%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'K%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Pendidikan</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'P%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'P%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'P%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Perniagaan dan Perakaunan</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'C%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'C%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'C%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Pusat Kebudayaan</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'R%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'R%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'R%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Pusat Sukan</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'V%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'V%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'V%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Sains</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'S%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'S%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'S%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Sains Komputer dan Teknologi Maklumat</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'W%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'W%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'W%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Sains Sosial</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'A%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'A%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'A%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo "<tr><td>Undang-Undang</td><td>";
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes' AND upper(matricNum) LIKE 'L%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no' AND upper(matricNum) LIKE 'L%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td><td>';
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE upper(matricNum) LIKE 'L%'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo '</td></tr>';
			
			echo '<tr><td style="border:1px solid; border-color:black white black white;"><strong>All students</strong><br></td><td style="border:1px solid; border-color:black white black white;">';
			
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'yes'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];
			echo "</td><td style='border:1px solid; border-color:black white black white;'>";
			
			if($result=mysql_query("SELECT count(id) as total FROM student WHERE lower(isCheckedIn) = 'no'"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];		
			echo "</td><td style='border:1px solid; border-color:black white black white;'>";
			
			if($result=mysql_query("SELECT count(id) as total FROM student"))
				while($query_row=mysql_fetch_assoc($result))
					echo $query_row['total'];	
			echo '</td></tr>';			
			
			echo '</table>';
			
		}
		
		/**
		 * ---------------------
		 *   r = 4 Add student 
		 * ---------------------
		 * extra parameter 
		 *		s(success) = t(true) || f(false)
		 *		n(name) = $name
		 *		e(error) = 1(similar ic) || 2(similar matric)
		 */
		else if($_GET['r'] == '4')
		{
			if(isset($_GET['s']))
			{
				if($_GET['s'] == 't')
				{
					$name = '"'.$_GET['n'].'"';
					successMsg("Student $name added successfully.");
				}
				else if($_GET['s'] == 'f')
					dangerMsg("Failed to add student.");
				if(isset($_GET['e']))
				{
					if($_GET['e'] == 1)
						dangerMsg("A student with the same <b>IC</b> already in record.");
					else if($_GET['e'] == 2)
						dangerMsg("A student with the same <b>matric number</b> already in record.");
					else if($_GET['e'] == 3)
						errMsg("invalid form submittion.");
					else if($_GET['e'] == 0)
						errMsg("Insert student query failed.");
						
				}	
			}

	?>
			<form id='newRecord' action='studentDA.php' method='post' class="form-horizontal">
				<fieldset>
					<legend>Add a new student record</legend>
					<div class='form-group'>
						<label class='col-lg-2 control-label' for='inputName'>Name:</label>  
						<div class='col-lg-4'>
							<input required autofocus style='text-transform: uppercase;' type='text' type='text' id='inputName' autocomplete='off' class='form-control' value='' name='name'/>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-2 control-label' for='inputIC'>IC number:</label>
						<div class='col-lg-2'>
							<input required type='text' autocomplete='off' value='' name='ic' id='inputIC' class='form-control masterTooltip' pattern='[0-9]{12}' title='eg.930230035132'/>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-2 control-label' for='inputMatric'>Matric number:</label>
						<div class='col-lg-2'>
							<input required style='text-transform: uppercase;' type='text' autocomplete='off' value='' name='matric' id='inputMatric' class='form-control masterTooltip' pattern='[A-z]{3}[0-9]{6}' title='eg.WEK130014'/>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-2 control-label' for='inputRoom'>Race:</label>
						<div class='col-lg-2'>
							<select name='race' class='form-control'><option>MALAY</option> <option>CHINESE</option> <option>INDIAN</option> <option>OTHERS</option> </select>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-2 control-label' for='inputSel'>Sel number:</label>
						<div class='col-lg-1'>
							<input required type='text' autocomplete='off' value='' name='sel' id='inputSel' class='form-control masterTooltip' pattern='[0-9]{1,2}' title='eg.11'/>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-2 control-label' for='inputRoom'>Room number:</label>
						<div class='col-lg-1'>
							<input required style='text-transform: uppercase;' type='text' autocomplete='off' value='' name='room' id='inputRoom' class='form-control masterTooltip' pattern='[A-Fa-f]{1}[0-9]{3}' title='eg.C309'/>
						</div>
					</div>
					<div class='form-group'>
						<div class='col-lg-3 col-lg-offset-2'>
							<input type='submit' class='btn btn-primary' value='Add student'/>
							<a href='adminhome.php?r=1' class='btn btn-primary'>Cancel</a>
						</div>
					</div>
					<input type='hidden' name='action' value='insert'>
				</fieldset>
			</form>
<?php
		}
		
		/**
		 * ----------------------
		 *   r = 5 Edit student 
		 * ----------------------
		 * extra parameter 
		 *		ic = $ic
		 */
		else if($_GET['r'] == '5')
		{
			if(isset($_GET['ic']) && !empty($_GET['ic']))
			{
				$ic = $_GET['ic'];		
					
				if($result=mysql_query("SELECT * FROM student WHERE ic = '$ic'"))
				{
					$row = mysql_fetch_array($result);
					$last = substr($ic, -1);
					$gender='';
					if($last%2==0)
						$gender = 'selected="selected"';
					
					$race = strtoupper($row['race']);
					$malay = '';
					$chinese = '';
					$indian = '';
					$others = '';
					if($race == 'OTHERS')
						$others = 'selected="selected"';
					if($race == 'INDIAN')
						$indian = 'selected="selected"';
					if($race == 'CHINESE')
						$chinese = 'selected="selected"';
					if($race == 'MALAY')
						$malay = 'selected="selected"';
						
					$religion = strtoupper($row['religion']);
					$islam = '';
					$buddha = '';
					$hindu = '';
					$christian = '';
					$catalic = '';
					$others = '';
					if($religion == 'CATALIC')
						$catalic = 'selected="selected"';
					if($religion == 'CHRISTIAN')
						$christian = 'selected="selected"';
					if($religion == 'HINDU')
						$hindu = 'selected="selected"';
					if($religion == 'ISLAM')
						$islam = 'selected="selected"';
					if($religion == 'BUDDHA')
						$buddha = 'selected="selected"';
					if($religion == 'OTHERS')
						$others = 'selected="selected"';
					
					$laptop = '';
					if(strtoupper($row['haveLaptop']) == 'NO')
						$laptop = 'selected="selected"';
					$checkedIn = '';
					if(strtoupper($row['isCheckedIn']) == 'NO')
						$checkedIn = 'selected="selected"';
						
					$id = $row['id'];
	?>
				<form id='editRecord' action='studentDA.php' method='post' class="form-horizontal">
					<fieldset>
						<legend>Edit student record</legend>
						<!-- name -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputName'>Name:</label>  
							<div class='col-lg-4'>
								<input required autofocus style='text-transform: uppercase;' type='text' type='text' id='inputName' autocomplete='off' class='form-control' value='<?php echo $row['name']?>' name='name'/>
							</div>
						</div>
						<!-- ic -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputIC'>IC number:</label>
							<div class='col-lg-2'>
								<input required type='text' autocomplete='off' value='<?php echo $row['ic'];?>' name='ic' id='inputIC' class='form-control masterTooltip' pattern='[0-9]{12}' title='eg.930230035132'/>
							</div>
						</div>
						<!-- matric -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputMatric'>Matric number:</label>
							<div class='col-lg-2'>
								<input required style='text-transform: uppercase;' type='text' autocomplete='off' value='<?php echo $row['matricNum'];?>' name='matric' id='inputMatric' class='form-control masterTooltip' pattern='[A-z]{3}[0-9]{6}' title='eg.WEK130014'/>
							</div>
						</div>
						<!-- gender -->
						<div class='form-group'>
							<label for='inputGender' class='col-lg-2 control-label'>Gender:</label>
							<div class='col-lg-2'>
								<select name='gender' class='form-control'><option>MALE</option><option <?php echo $gender;?> >FEMALE</option> </select>
							</div>
						</div>
						<!-- address -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputAddress'>Address:</label>
							<div class='col-lg-4'>
								<textarea class='form-control' spellcheck='false' autocomplete='off' style='text-transform:uppercase;' name='address' rows='3'><?php echo $row['address'];?></textarea>
							</div>
						</div>
						<!-- phone -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputPhone'>Phone:</label>
							<div class='col-lg-2'>
								<input type='text' autocomplete='off' value='<?php echo $row['phone'];?>' name='phone' id='inputPhone' class='form-control masterTooltip' pattern='[0-9]{10,11}' title='eg.0123456789'/>
							</div>
						</div>
						<!-- email -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputEmail'>Email:</label>
							<div class='col-lg-3'>
								<input style='text-transform: uppercase;' type='email' autocomplete='off' value='<?php echo $row['email'];?>' name='email' id='inputEmail' class='form-control' />
							</div>
						</div>
						<!-- race -->
						<div class='form-group'>
							<label for='inputRace' class='col-lg-2 control-label'>Race:</label>
							<div class='col-lg-2'>
								<select name='race' class='form-control'><option value=''>N/A</option><option <?php echo $malay;?>>MALAY</option> <option <?php echo $chinese;?>>CHINESE</option> <option <?php echo $indian;?>>INDIAN</option> <option <?php echo $others;?>>OTHERS</option> </select>
							</div>
						</div>
						<!-- religion -->
						<div class='form-group'>
							<label for='inputReligion' class='col-lg-2 control-label'>Religion:</label><div class='col-lg-2'>
								<select name='religion' class='form-control'><option value=''>N/A</option><option <?php echo $islam;?>>ISLAM</option> <option <?php echo $buddha;?>>BUDDHA</option> <option <?php echo $hindu;?>>HINDU</option> <option <?php echo $christian;?>>CHRISTIAN</option> <option <?php echo $catalic;?>>CATALIC</option> <option <?php echo $others;?>>OTHERS</option> </select>
							</div>
						</div>
						<!-- room -->
						<div class='form-group'>
							<label class='col-lg-2 control-label' for='inputRoom'>Room number:</label>
							<div class='col-lg-1'>
								<input required style='text-transform: uppercase;' type='text' autocomplete='off' value='<?php echo $row['roomNum'];?>' name='room' id='inputRoom' class='form-control masterTooltip' pattern='[A-Fa-f]{1}[0-9]{3}' title='eg.C309'/>
							</div>
						</div>
						<!-- laptop -->
						<div class='form-group'>
							<label for='laptop' class='col-lg-2 control-label'>With laptop:</label>
							<div class='col-lg-2'>
								<select name='laptop' class='form-control'><option>YES</option> <option <?php echo $laptop;?>>NO</option> </select>
							</div>
						</div>
						<!-- checked in -->
						<div class='form-group'>
							<label for='checkedIn' class='col-lg-2 control-label'>Checked in:</label>
							<div class='col-lg-2'>
								<select name='checkedIn' class='form-control'><option>YES</option> <option <?php echo $checkedIn;?>>NO</option> </select>
							</div>
						</div>
						<div class='form-group'>
							<div class='col-lg-3 col-lg-offset-2'>
								<input type='submit' class='btn btn-primary' value='Edit'/>
								<a href='adminhome.php?r=1' class='btn btn-primary'>Cancel</a>
							</div>
						</div>
						<input type='hidden' name='action' value='edit'>
						<input type='hidden' name='id' value='<?php echo $id; ?>'>
					</fieldset>
				</form>
	<?php 
				}
				else
				{
					dangerMsg("No such student.");
					header("Refresh: 5;url=adminhome.php?r=1");
				}
			}
			else
			{
				header("Location:adminhome.php?r=1");
			}
		}
		
		
		/**
		 * ------------------------
		 *   r = 6 Delete student 
		 * ------------------------
		 * extra parameter 
		 *		ic = $ic
		 */	
		else if($_GET['r'] == '6')
		{
			if(isset($_GET['ic']) && !empty($_GET['ic']))
			{
				$ic = $_GET['ic'];
				if($result=mysql_query("SELECT * FROM student WHERE ic = '$ic'"))
				{
	?>
				<form id='deleteRecord' action='studentDA.php' method='post' class="form-horizontal">
					<fieldset>
						<legend>Confirm delete student record with IC <?php echo $ic; ?></legend>
						<input type='hidden' name='ic' value='<?php echo $ic; ?>'>
						<input type='hidden' name='action' value='delete'>
						<div class='form-group'>
							<div class='col-lg-3 col-lg-offset-2'>
								<input type='submit' class='btn btn-danger' value='Confirm Remove'/>
								<a href='adminhome.php' class='btn btn-primary'>Cancel</a>
							</div>
						</div>
					</fieldset>
				</form>
	<?php
				}
				else
				{
					dangerMsg("No such student.");
					header("Refresh: 5;url=adminhome.php?r=1");
				}
			}
			else
			{
				header("Location:adminhome.php?r=1");
			}
		}
		else
			header("Location:adminhome.php?r=1");
	}
	else
	{
		header("Location:adminhome.php?r=1");
	}
}
else
	echo 'You must log in before viewing this page. Please <a href="adminlogin.php">log in</a> or <a href="index.php">return to welcome page</a>.';
?>
		</div><!--
		<div class="container">
			<h2>To do</h2>
			<div class='alert alert-info'>editDetails.php js input field protection - length check, valid characters, check dublicate ic/matric</div>
			<div class='alert alert-info'>sql injection, htmlentities</div>
			<h2>Known Issue</h2>
			<div class='alert alert-warning'>ic sorting failed</div>
			<h2>review</h2>
			<div class='alert alert-success'>insert : name, ic , matric , room num : check no dublicate input</div>
			<div class='alert alert-success'>edit record</div>
			<div class='alert alert-success'>delete record</div>
			<div class='alert alert-success'>view - filter result:checked in student, gender, matric, name, with laptop, race, floor&number, check in time; fixed accending order id number</div>
			<div class='alert alert-success'>register.php - gender auto detect by ic</div>
			<div class='alert alert-success'>DB add column Religion, add editDetails.php, show in table result(islam, buddha , christian, hindu, catalic, others )</div>
			<div class='alert alert-success'>DB add column email, add editDetails.php, show in table result more info</div>
			<div class='alert alert-success'>DB add column CheckInTime, add column in confirmRegistration.php, show in table result, </div>
			<div class='alert alert-success'>editDetails.php back button-return to home/register</div>
			<h2>To test</h2>
			<div class='alert alert-danger'>multiple updates at the same time</div>
			<div class='alert alert-danger'>check all input fields</div>
			<div class='alert alert-danger'>all faculties with matric number</div>
			<div class='alert alert-danger'>basic operation, add edit delete register</div>
		</div>-->
	
	</body>
</html>
