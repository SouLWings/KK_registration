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
	<body>
		<div class='container'><div id='alertcontainer'></div>
			<form id='detailsForm' action='activity-submit.php' method='post' class='form-horizontal'>
				<fieldset>
					<legend>MHS Activity Survey Form</legend>
					
					<table id="formTable" class="table-striped table-bordered table-hover" valign='center'>
						<thead>
							<tr>
								<th width='250px' rowspan='2'>Seni</th> 
								<th width='480px' colspan='4'>Archievement</th> 
								<th width='80px' rowspan='2'>Interested</th> 
								<th width='80px' rowspan='2'>No involvement</th> 
							</tr>
							<tr>
								<th width='120px' align='center'>International</th> 
								<th width='120px'>National</th> 
								<th width='120px'>State</th> 
								<th width='120px'>Distric/School</th> 
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Choir</td>
								<td><input type='radio' name='s1' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s1' value='national'/></td>
								<td><input type='radio' name='s1' value='State'/></td>
								<td><input type='radio' name='s1' value='Distric/School'/></td>
								<td><input type='radio' name='s1' value='Interested'/></td>
								<td><input type='radio' name='s1' value='' checked/></td>
							</tr>
							<tr>
								<td>Nasyid</td>
								<td><input type='radio' name='s2' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s2' value='national'/></td>
								<td><input type='radio' name='s2' value='State'/></td>
								<td><input type='radio' name='s2' value='Distric/School'/></td>
								<td><input type='radio' name='s2' value='Interested'/></td>
								<td><input type='radio' name='s2' value='' checked/></td>
							</tr>
							<tr>
								<td>Nyanyian malay</td>
								<td><input type='radio' name='s3' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s3' value='national'/></td>
								<td><input type='radio' name='s3' value='State'/></td>
								<td><input type='radio' name='s3' value='Distric/School'/></td>
								<td><input type='radio' name='s3' value='Interested'/></td>
								<td><input type='radio' name='s3' value='' checked/></td>
							</tr>
							<tr>
								<td>nyanian ingegeris</td>
								<td><input type='radio' name='s4' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s4' value='national'/></td>
								<td><input type='radio' name='s4' value='State'/></td>
								<td><input type='radio' name='s4' value='Distric/School'/></td>
								<td><input type='radio' name='s4' value='Interested'/></td>
								<td><input type='radio' name='s4' value='' checked/></td>
							</tr>
							<tr>
								<td>menifestasi puisi</td>
								<td><input type='radio' name='s5' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s5' value='national'/></td>
								<td><input type='radio' name='s5' value='State'/></td>
								<td><input type='radio' name='s5' value='Distric/School'/></td>
								<td><input type='radio' name='s5' value='Interested'/></td>
								<td><input type='radio' name='s5' value='' checked/></td>
							</tr>
							<tr>
								<td>drama/sketsa/teater malay</td>
								<td><input type='radio' name='s6' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s6' value='national'/></td>
								<td><input type='radio' name='s6' value='State'/></td>
								<td><input type='radio' name='s6' value='Distric/School'/></td>
								<td><input type='radio' name='s6' value='Interested'/></td>
								<td><input type='radio' name='s6' value='' checked/></td>
							</tr>
							<tr>
								<td>drama/sketsa/teater inggeris</td>
								<td><input type='radio' name='s7' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s7' value='national'/></td>
								<td><input type='radio' name='s7' value='State'/></td>
								<td><input type='radio' name='s7' value='Distric/School'/></td>
								<td><input type='radio' name='s7' value='Interested'/></td>
								<td><input type='radio' name='s7' value='' checked/></td>
							</tr>
							<tr>
								<td>boria</td>
								<td><input type='radio' name='s8' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s8' value='national'/></td>
								<td><input type='radio' name='s8' value='State'/></td>
								<td><input type='radio' name='s8' value='Distric/School'/></td>
								<td><input type='radio' name='s8' value='Interested'/></td>
								<td><input type='radio' name='s8' value='' checked/></td>
							</tr>
							<tr>
								<td>gamelan</td>
								<td><input type='radio' name='s9' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s9' value='national'/></td>
								<td><input type='radio' name='s9' value='State'/></td>
								<td><input type='radio' name='s9' value='Distric/School'/></td>
								<td><input type='radio' name='s9' value='Interested'/></td>
								<td><input type='radio' name='s9' value='' checked/></td>
							</tr>
							<tr>
								<td>kompang</td>
								<td><input type='radio' name='s10' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s10' value='national'/></td>
								<td><input type='radio' name='s10' value='State'/></td>
								<td><input type='radio' name='s10' value='Distric/School'/></td>
								<td><input type='radio' name='s10' value='Interested'/></td>
								<td><input type='radio' name='s10' value='' checked/></td>
							</tr>
							<tr>
								<td>tarian tradisional, moden</td>
								<td><input type='radio' name='s11' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s11' value='national'/></td>
								<td><input type='radio' name='s11' value='State'/></td>
								<td><input type='radio' name='s11' value='Distric/School'/></td>
								<td><input type='radio' name='s11' value='Interested'/></td>
								<td><input type='radio' name='s11' value='' checked/></td>
							</tr>
							<tr>
								<td>drama/sketsa/teater</td>
								<td><input type='radio' name='s12' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s12' value='national'/></td>
								<td><input type='radio' name='s12' value='State'/></td>
								<td><input type='radio' name='s12' value='Distric/School'/></td>
								<td><input type='radio' name='s12' value='Interested'/></td>
								<td><input type='radio' name='s12' value='' checked/></td>
							</tr>
							<tr>
								<td>emcee/pengacara majlis</td>
								<td><input type='radio' name='s13' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s13' value='national'/></td>
								<td><input type='radio' name='s13' value='State'/></td>
								<td><input type='radio' name='s13' value='Distric/School'/></td>
								<td><input type='radio' name='s13' value='Interested'/></td>
								<td><input type='radio' name='s13' value='' checked/></td>
							</tr>
							<tr>
								<td>pidato BM</td>
								<td><input type='radio' name='s14' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s14' value='national'/></td>
								<td><input type='radio' name='s14' value='State'/></td>
								<td><input type='radio' name='s14' value='Distric/School'/></td>
								<td><input type='radio' name='s14' value='Interested'/></td>
								<td><input type='radio' name='s14' value='' checked/></td>
							</tr>
							<tr>
								<td>pidato BI</td>
								<td><input type='radio' name='s15' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s15' value='national'/></td>
								<td><input type='radio' name='s15' value='State'/></td>
								<td><input type='radio' name='s15' value='Distric/School'/></td>
								<td><input type='radio' name='s15' value='Interested'/></td>
								<td><input type='radio' name='s15' value='' checked/></td>
							</tr>
							<tr>
								<td>debat BM</td>
								<td><input type='radio' name='s16' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s16' value='national'/></td>
								<td><input type='radio' name='s16' value='State'/></td>
								<td><input type='radio' name='s16' value='Distric/School'/></td>
								<td><input type='radio' name='s16' value='Interested'/></td>
								<td><input type='radio' name='s16' value='' checked/></td>
							</tr>
							<tr>
								<td>debat BI</td>
								<td><input type='radio' name='s17' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s17' value='national'/></td>
								<td><input type='radio' name='s17' value='State'/></td>
								<td><input type='radio' name='s17' value='Distric/School'/></td>
								<td><input type='radio' name='s17' value='Interested'/></td>
								<td><input type='radio' name='s17' value='' checked/></td>
							</tr>
						</tbody>
					</table>
					<table id="formTable" class="table-striped table-bordered table-hover" valign='center'>
						<thead>
							<tr>
								<th width='250px' rowspan='2'>Sports</th> 
								<th width='480px' colspan='4'>Archievement</th> 
								<th width='80px' rowspan='2'>Interested</th> 
								<th width='80px' rowspan='2'>No involvement</th> 
							</tr>
							<tr>
								<th width='120px' align='center'>International</th> 
								<th width='120px'>National</th> 
								<th width='120px'>State</th> 
								<th width='120px'>Distric/School</th> 
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Bola keranjang</td>
								<td><input type='radio' name='s18' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s18' value='national'/></td>
								<td><input type='radio' name='s18' value='State'/></td>
								<td><input type='radio' name='s18' value='Distric/School'/></td>
								<td><input type='radio' name='s18' value='Interested'/></td>
								<td><input type='radio' name='s18' value='' checked/></td>
							</tr>
							<tr>
								<td>Bola tampar</td>
								<td><input type='radio' name='s19' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s19' value='national'/></td>
								<td><input type='radio' name='s19' value='State'/></td>
								<td><input type='radio' name='s19' value='Distric/School'/></td>
								<td><input type='radio' name='s19' value='Interested'/></td>
								<td><input type='radio' name='s19' value='' checked/></td>
							</tr>
							<tr>
								<td>Bola baling</td>
								<td><input type='radio' name='s20' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s20' value='national'/></td>
								<td><input type='radio' name='s20' value='State'/></td>
								<td><input type='radio' name='s20' value='Distric/School'/></td>
								<td><input type='radio' name='s20' value='Interested'/></td>
								<td><input type='radio' name='s20' value='' checked/></td>
							</tr>
							<tr>
								<td>Bola jaring</td>
								<td><input type='radio' name='s21' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s21' value='national'/></td>
								<td><input type='radio' name='s21' value='State'/></td>
								<td><input type='radio' name='s21' value='Distric/School'/></td>
								<td><input type='radio' name='s21' value='Interested'/></td>
								<td><input type='radio' name='s21' value='' checked/></td>
							</tr>
							<tr>
								<td>Sepak takraw</td>
								<td><input type='radio' name='s22' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s22' value='national'/></td>
								<td><input type='radio' name='s22' value='State'/></td>
								<td><input type='radio' name='s22' value='Distric/School'/></td>
								<td><input type='radio' name='s22' value='Interested'/></td>
								<td><input type='radio' name='s22' value='' checked/></td>
							</tr>
							<tr>
								<td>Futsal</td>
								<td><input type='radio' name='s23' value='international' class='input-lg'/></td>
								<td><input type='radio' name='s23' value='national'/></td>
								<td><input type='radio' name='s23' value='State'/></td>
								<td><input type='radio' name='s23' value='Distric/School'/></td>
								<td><input type='radio' name='s23' value='Interested'/></td>
								<td><input type='radio' name='s23' value='' checked/></td>
							</tr>
						</tbody>
					</table>
					<div class='form-group'>
						<div class='col-lg-3 col-lg-offset-5'>
							<br><input type='submit' class='btn btn-primary' value='Next Step'/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</body>
</html>