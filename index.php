<?php 
session_start(); 
session_destroy(); 
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script>
			$(document).ready(function() { 
			    $('input[type="submit"]').attr('disabled','disabled');
			    $('input[type="submit"]').css('opacity','0.3');
				$('input[type="text"]').keyup(function() {
					if($(this).val().length == 12) {
						$('input[type="submit"]').removeAttr('disabled');
						$('input[type="submit"]').css('opacity','1');
					}
					else{
						$('input[type="submit"]').attr('disabled','disabled');
						$('input[type="submit"]').css('opacity','0.3');
					}
				});
				$("input[name='ic']").keydown(function(event) {
					// Allow: backspace, delete, tab, escape, and enter
					if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
						 // Allow: Ctrl+A
						(event.keyCode == 65 && event.ctrlKey === true) || 
						 // Allow: home, end, left, right
						(event.keyCode >= 35 && event.keyCode <= 39)) {
							 // let it happen, don't do anything
							 return;
					}
					else {
						// Ensure that it is a number and stop the keypress
						if ($("input[name='ic']").val().length > 11 || event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
							event.preventDefault(); 
						}   
					}
				});
			}); 
			/*wait for ajax response
			$.when(
				$.ajax({/*settings*}),
				$.ajax({/*settings*}),
				$.ajax({/*settings*}),
				$.ajax({/*settings*}),
			).then(function() {
				// when all AJAX requests are complete
			});
			
			
			$.ajax({
			  type: "POST",
			  url: "some.php",
			  data: { name: "John", location: "Boston" }
			}).done(function( msg ) {
			  alert( "Data Saved: " + msg );
			});
			
			$(".my_link").click(
				function(){
				$.ajax({
					url: $(this).attr('href'),
					type: 'GET',
					async: false,
					cache: false,
					timeout: 30000,
					error: function(){
						return true;
					},
					success: function(msg){ 
						if (parseFloat(msg)){
							return false;
						} else {
							return true;
						}
					}
				});
			});
			*/
		</script>
	</head>
	<body>
		<div style='float:right; font-size:0.7em;'><a href='adminlogin.php'>admin login</a></div>
		<div style='height:1px;'></div>
		<div class='box'>
			<h2>Welcome to KK8 - <br> Your new home in University of Malaya</h2>
			<form action='editDetails.php' method='post'>
<?php 
if(isset($_GET['e']))
	if($_GET['e']==1)
		echo "<h5>IC is not in our records. Please re-enter your IC. Please inform any of the PM around if the problem still persist.</h5>";
	else if($_GET['e']==2)
		echo "<h5>You already checked in.</h5>";
?>
			<h3>Please enter your IC number:
			<input type='text' autocomplete="off" required width='6' name='ic' placeholder='eg.930230035132' title='eg.930230035132' autofocus pattern='[0-9]{12}' oncontextmenu="return false;"/></h3>
			<br>
			<center><input type='submit' value='Confirm' name='submit'></center>
			</form>
		</div>
	</body>
<html>