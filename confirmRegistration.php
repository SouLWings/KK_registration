<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<script type='text/javascript' src='js/inputLimit.js'></script>
		<style>
			th + th, td + td{
				text-align:center;
			}
			td{
				line-height:1.4;
				padding:5px;
			}
		</style>
	</head>
	<body><br><br>
<?php
session_start();
include 'func.php';
connectDB();
if(isset($_SESSION['ic']) && !empty($_SESSION['ic'])) 
{
	header("Refresh: 15;url=index.php");
	$room = $_SESSION['room'];
	$sel = $_SESSION['sel'];
	$ic = $_SESSION['ic'];

	$result=mysql_query("UPDATE student SET isCheckedIn = 'YES', checkInTime = CURRENT_TIMESTAMP WHERE ic='$ic'");
	if($result!=1){
		errMsg("Update query failed at registration confirmation.");
	}else{
?>
<div class="jumbotron" width=90%>
  <div class="container">
    <h1>Congratulation! </h1>
    <p>You have check into the system successfully. Your room number is <b><?php echo $room?></b>. You are in SEL <b color='red'><?php echo $sel ?></b>. <br>Please head to bla bla bla to pick up your room key.<br><br>Redirecting back to welcome page in <b><span id='countdown'>15</span></b>.</p>
    <p><a class="btn btn-primary btn-lg" href='index.php'>Finish</a></p>
  </div>
</div>
<?php	

	}	
}
else
	errMsg('No session IC found.');
?>
<script>
	var x = 15;
	function countdown(){
		document.getElementById('countdown').innerHTML = --x;
	}
	setInterval( "countdown()", 1030 )
</script>	</body>
</html>