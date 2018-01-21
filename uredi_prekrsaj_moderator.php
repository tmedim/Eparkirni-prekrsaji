<?php

include_once "includes/db_connection.php";
session_start();

$prekrsaj_id = $_GET['prekrsaj_id'];
$registracija = $_GET['registracija'];
$moderator_id = $_SESSION['korisnik']['korisnik_id'];
$tip_id = $_SESSION['korisnik']['tip_id'];

if (isset($_POST['pre_kat']) && isset($_POST['pre_reg']) && isset($_POST['pre_naziv']) &&
	isset($_POST['pre_opis']) && isset($_POST['pre_kazna']) && isset($_POST['dan_pla']) && 
	isset($_POST['mje_pla']) && isset($_POST['god_pla']) && isset($_POST['sat_pla']) && 
	isset($_POST['min_pla']) && isset($_POST['sec_pla']) && isset($_POST['pre_url_slika'])){
		
	$kategorija_id = $_POST['pre_kat'];
	$vozilo_id = $_POST['pre_reg'];
	$naziv = $_POST['pre_naziv'];
	$opis = $_POST['pre_opis'];
	$novcana_kazna = $_POST['pre_kazna'];
	$dan = $_POST['dan_pla'];
	$mje = $_POST['mje_pla'];
	$god = $_POST['god_pla'];
	$sat = $_POST['sat_pla'];
	$min = $_POST['min_pla'];
	$sek = $_POST['sec_pla'];
	$slika = $_POST['pre_url_slika'];
	$video = $_POST['pre_url_video'];
	
	$sql = "UPDATE prekrsaj
			SET kategorija_id='$kategorija_id',
				vozilo_id='$vozilo_id',
				naziv='$naziv', 
				opis='$opis', 
				novcana_kazna='$novcana_kazna', 
				datum_prekrsaja='$god-$mje-$dan', 
				vrijeme_prekrsaja='$sat:$min:$sek', 
				slika='$slika', 
				video='$video'
			WHERE prekrsaj_id = $prekrsaj_id;";
	$result = mysqli_query($conn, $sql);
		
	header ('location: moje_kategorije.php');
	
}else {
	$sql = "SELECT kategorija_id,
				   naziv,
				   opis,
				   novcana_kazna,
				   DAY(datum_prekrsaja) AS dan,
				   MONTH(datum_prekrsaja) AS mje,
				   YEAR(datum_prekrsaja) AS god,
				   HOUR(vrijeme_prekrsaja) AS sat,
				   MINUTE(vrijeme_prekrsaja) AS min,
				   SECOND(vrijeme_prekrsaja) AS sek,
				   slika,
				   video
				FROM prekrsaj
				WHERE prekrsaj_id = $prekrsaj_id;";

	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)){
		$kategorija_id = $row['kategorija_id'];
		$naziv = $row['naziv'];
		$opis = $row['opis'];
		$novcana_kazna = $row['novcana_kazna'];
		$dan = $row['dan'];
		$mje = $row['mje'];
		$god = $row['god'];
		$sat = $row['sat'];
		$min = $row['min'];
		$sek = $row['sek'];
		$slika = $row['slika'];
		$video = $row['video'];
	}

	echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Uređivanje prekršaja | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
			 
		   echo '<div id="main-body">
					<h2>Uređivanje prekršaja</h2>
					<form method="post" action="">
						<label for="pre_kat">Kategorija</label>
						<select name="pre_kat" id="pre_kat" class="wide-select">';
						
						if ($tip_id == 0){
							$sql = "SELECT kategorija_id,
										   naziv
									FROM kategorija;";
						}else {
							$sql = "SELECT kategorija_id,
										   naziv
									FROM kategorija
									WHERE moderator_id = $korisnik_id;";
						}
						
						$result = mysqli_query($conn, $sql);

						while ($row = mysqli_fetch_array($result)){
							if ($row['kategorija_id'] == $kategorija_id){
								$sel = ' selected';
							}else {
								$sel = '';
							}
							echo '<option value="'.$row['kategorija_id'].'"'.$sel.'>'.$row['naziv'].'</option>';
						}

				  echo '</select>
						<label for="pre_reg">Motorno vozilo (registracija)</label>
						<select name="pre_reg" id="pre_reg" class="wide-select">';
							$sql = "SELECT vozilo_id,
										   registracija
									FROM vozilo;";
							$result = mysqli_query($conn, $sql);

							while ($row = mysqli_fetch_array($result)){
								if ($row['registracija'] == $registracija){
									$sel = ' selected';
								}else {
									$sel = '';
								}
								echo '<option value="'.$row['vozilo_id'].'"'.$sel.'>'.$row['registracija'].'</option>';
							}
				  echo '</select>
						<label for="pre_naziv">Naziv prekršaja</label>
						<input type="text" name="pre_naziv" id="pre_naziv" value="'.$naziv.'">
						<label for="pre_opis">Opis prekršaja</label>
						<textarea name="pre_opis" id="pre_opis" rows="5">'.$opis.'</textarea>
						<label for="pre_kazna">Iznos kazne</label>
						<input type="number" name="pre_kazna" id="pre_kazna" value="'.$novcana_kazna.'">
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
									if ($i == $god){
										$sel = ' selected';
									}else {
										$sel = '';
									}
									echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
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
								<select name="sec_pla" id="sec_pla">';
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
						<label for="pre_url_slika">URL do slike</label>
						<input type="url" name="pre_url_slika" id="pre_url_slika" value="'.$slika.'">
						<label for="pre_url_video">URL do videa</label>
						<input type="url" name="pre_url_video" id="pre_url_video" value="'.$video.'">
						<input type="submit" value="Izmjena podataka" class="btn-sub-form">
					</form>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';
}



?>