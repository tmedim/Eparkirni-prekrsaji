<?php

include_once "includes/db_connection.php";
session_start();

$prekrsaj_id = $_GET['prekrsaj_id'];

if (isset($_POST['dan_pla']) && isset($_POST['mje_pla']) && isset($_POST['god_pla']) &&
	isset($_POST['sat_pla']) && isset($_POST['min_pla']) && isset($_POST['sek_pla'])) {

	$dan = $_POST['dan_pla'];
	$mje = $_POST['mje_pla'];
	$god = $_POST['god_pla'];
	$sat = $_POST['sat_pla'];
	$min = $_POST['min_pla'];
	$sek = $_POST['sek_pla'];
	
	$sql = "UPDATE prekrsaj
			SET datum_placanja='$god-$mje-$dan',
				vrijeme_placanja='$sat:$min:$sek',
				status='P'
			WHERE prekrsaj_id=$prekrsaj_id;";
	
	$result = mysqli_query($conn, $sql);
	
	header ("location: prekrsaji.php");
	
}else {
	$dan = date("d");
	$mje = date("m");
	$god = date("Y");
	$sat = date("H");
	$min = date("i");
	$sek = date("s");

	echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Plaćanje prekršaja | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
		   
		   echo '<div id="main-body">
					<h2>Plaćanje prekršaja</h2>
					<h3 class="form-title">Dospjeće plaćanja kazne</h3>
					<form method="post" action="">
						<div class="inline-element">
							<label for="dan_pla">Dan</label>
							<select name="dan_pla" id="dan_pla">';							
								for ($i = 1; $i <= 31; $i++){
									if ($i / 10 < 1) { $j = '0'.$i;	}
									else { $j = $i;	}
									
									if ($j == $dan){
										$sel = ' selected';
									}else {
										$sel = '';
									}
									
									echo '<option value="'.$j.'"'.$sel.'>'.$j.'</option>';
								}							
					  echo '</select>
						</div>
						<div class="inline-element">
							<label for="mje_pla">Mjesec</label>
							<select name="mje_pla" id="mje_pla">';
								for ($i = 1; $i <= 12; $i++){
									if ($i / 10 < 1) { $j = '0'.$i;	}
									else { $j = $i;	}
									
									if ($j == $mje){
										$sel = ' selected';
									}else {
										$sel = '';
									}
									
									echo '<option value="'.$j.'"'.$sel.'>'.$j.'</option>';
								}
					  echo '</select>
						</div>
						<div class="inline-element">
							<label for="god_pla">Godina</label>
							<select name="god_pla" id="god_pla">';
								for ($i = date("Y"); $i >= 1900; $i--){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
					  echo '</select>
						</div>                
						<div class="new-row">
							<div class="inline-element">
								<label for="sat_pla">Sat</label>
								<select name="sat_pla" id="sat_pla">';
									for ($i = 0; $i <= 23; $i++){
										if ($i / 10 < 1) { $j = '0'.$i;	}
										else { $j = $i;	}
										
										if ($j == $sat){
											$sel = ' selected';
										}else {
											$sel = '';
										}
										
										echo '<option value="'.$j.'"'.$sel.'>'.$j.'</option>';
									}
						  echo '</select>
							</div>
							<div class="inline-element">
								<label for="min_pla">Minuta</label>
								<select name="min_pla" id="min_pla">';
									for ($i = 0; $i <= 59; $i++){
										if ($i / 10 < 1) { $j = '0'.$i;	}
										else { $j = $i;	}
										
										if ($j == $min){
											$sel = ' selected';
										}else {
											$sel = '';
										}
										
										echo '<option value="'.$j.'"'.$sel.'>'.$j.'</option>';
									}
						  echo '</select>
							</div>
							<div class="inline-element">
								<label for="sec_pla">Sekunda</label>
								<select name="sek_pla" id="sek_pla">';
									for ($i = 0; $i <= 59; $i++){
										if ($i / 10 < 1) { $j = '0'.$i;	}
										else { $j = $i;	}
										
										if ($j == $sek){
											$sel = ' selected';
										}else {
											$sel = '';
										}
										
										echo '<option value="'.$j.'"'.$sel.'>'.$j.'</option>';
									}
						  echo '</select>
							</div>
						</div>
						<input type="submit" value="Plaćanje prekršaja" name="btn_plati" class="btn-sub-form btn-sf1">
					</form>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';
}

?>