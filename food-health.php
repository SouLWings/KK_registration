<?php
session_start();
include 'func.php';
connectDB();
$ic= $_SESSION["ic"];
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<style>
		.form-control{
			display:inline;
			padding-top:0;
			padding-left:3px;
			padding-bottom:0;
			padding-right:3px;;
			width:150px;
			height:24px;
		}
		</style>
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
		<script type='text/javascript' src='js/bootstrap.js'></script>
		<script type='text/javascript' src='js/inputLimit.js'></script>
		<script>
			$(document).ready(function(){ 	
				$("select[name='food[]']").change(function(){
					var others=false;
					$.each( $(this).val(), function(i, l){
						if(l=='true')
							others=true;
					});
					if(others)
						$('#inputallergicfood').prop('disabled', false);
					else
					{
						$('#inputallergicfood').prop('disabled', true);
					}
				}); 
				$("select[name='medcine']").change(function(){
					if($(this).val()=='true')
					{
						$('#inputallergicmedine').prop('disabled', false);
					}
					else
					{
						$('#inputallergicmedine').prop('disabled', true);
					}
				}); 
			});
		</script>
	</head>
	<body>
		<div class='container'><div id='alertcontainer'></div>
			<form id='detailsForm' action='food-health-submit.php' method='post' class='form-horizontal'>
				<fieldset>
					<legend>Food and Health Infomation</legend>
					<div class='form-group'>
						<label class='col-lg-4 control-label'>Are you a vegetarian? </label>
						<div class='col-lg-4'>
							<label class="radio-inline">
								<input type="radio" name="vege" value="No" checked> No
							</label>
							<label class="radio-inline">
								<input type="radio" name="vege" value="Yes"> Yes
							</label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-4 control-label' for='inputIC'>Are you allergic to any food?</label>
						<div class='col-lg-8'>
							<label class="checkbox-inline">
								<input type="checkbox" name="food[]" value="No " checked> No
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="food[]" value="Beef "> Beef
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="food[]" value="Seafood "> Seafood
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="food[]" value="Fish "> Fish
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="food[]" value="Chicken "> Chicken
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="food[]" value="Others: "> Others:
								<input type='text' autocomplete='off' value='' name='food[]' id='inputallergicfood' class='form-control' placeholder='Name the food'>
							</label>
							
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-4 control-label'>Are you allergic to any medcine?</label>
						<div class='col-lg-8'>
							<label class="radio-inline">
								<input type="radio" name="medcine" value="No" checked> No
							</label>
							<label class="radio-inline">
								<input type="radio" name="medcine" value="Yes: "> Yes:
								<input type='text' autocomplete='off' value='' name='medcinename' id='inputallergicmedine' class='form-control' placeholder='Name the medcine'>
							</label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-4 control-label'>Have you had surgery recently?</label>
						<div class='col-lg-8'>
							<label class="radio-inline">
								<input type="radio" name="surgery" value="No" checked> No
							</label>
							<label class="radio-inline">
								<input type="radio" name="surgery" value="Yes: "> Yes:
								<input type='text' autocomplete='off' value='' name='surgerytime' id='inputsurgerytime' class='form-control' placeholder='When you had it'>
								<input type='text' autocomplete='off' value='' name='surgeryname' id='inputsurgeryname' class='form-control' placeholder='Name the surgery'>
							</label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-4 control-label'>Are you having any illness:</label>
						<div class='col-lg-8'>
							<label class="checkbox-inline">
								<input type="checkbox" name="illness[]" value="No " checked> No
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="illness[]" value="Fever "> Fever
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="illness[]" value="Flu "> Flu
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="illness[]" value="Diarrhea "> Diarrhea
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="illness[]" value="Others: "> Others:
								<input type='text' autocomplete='off' value='' name='illness[]' id='inputillness' class='form-control' placeholder='State the illness you are having'>
							</label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-4 control-label'>Are you just returned from foriegn country:</label>
						<div class='col-lg-8'>
							<label class="radio-inline">
								<input type="radio" name="country" value="No" checked> No
							</label>
							<label class="radio-inline">
								<input type="radio" name="country" value="Yes: "> Yes:
								<input type='text' autocomplete='off' value='' name='countryname' id='inputcountry' class='form-control' placeholder='Please state the country'>
							</label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-lg-4 control-label'>Have you had rubella vaccine injection before?</label>
						<div class='col-lg-8'>
							<label class="radio-inline">
								<input type="radio" name="vaccine" value="No" checked> No
							</label>
							<label class="radio-inline">
								<input type="radio" name="vaccine" value="Yes: "> Yes:
								<input type='text' autocomplete='off' value='' name='vaccinetime' id='inputvaccine' class='form-control' placeholder='When you had it'>
							</label>
						</div>
					</div>

					<div class='form-group'>
						<div class='col-lg-3 col-lg-offset-4'>
							<input type='submit' class='btn btn-primary' value='Next Step'/>
							<a href='register.php' class='btn btn-primary'>Back</a>
						</div>
					</div>
				</fieldset>
			</form>
