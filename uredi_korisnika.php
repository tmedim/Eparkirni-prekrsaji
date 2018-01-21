<?php

include_once "includes/db_connection.php";
session_start();

$korisnik_id = $_GET['korisnik_id'];

if (isset($_POST['ch_kor_tip']) && isset($_POST['ch_kor_username']) && isset($_POST['ch_kor_pwd']) &&
	isset($_POST['ch_kor_ime']) && isset($_POST['ch_kor_prezime'])){
		
	$tip_id = $_POST['ch_kor_tip'];
	$korisnicko_ime = $_POST['ch_kor_username'];
	$lozinka = $_POST['ch_kor_pwd'];
	$ime = $_POST['ch_kor_ime'];
	$prezime = $_POST['ch_kor_prezime'];
	$email = $_POST['ch_kor_email'];
	$slika = $_POST['ch_kor_slika'];
	
	$sql = "UPDATE korisnik
			SET tip_id=$tip_id,
				korisnicko_ime='$korisnicko_ime', 
				lozinka='$lozinka', 
				ime='$ime', 
				prezime='$prezime', 
				email='$email', 
				slika='$slika'
			WHERE korisnik_id = $korisnik_id;";
	$result = mysqli_query($conn, $sql);
	
	header ('location: korisnici.php');
	
}else {
	$sql = "SELECT tip_id,
			   korisnicko_ime,
			   lozinka,
			   ime,
			   prezime,
			   email,
			   slika
			   FROM korisnik
			   WHERE korisnik_id = $korisnik_id;";

	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)){
		$tip_id = $row['tip_id'];
		$korisnicko_ime = $row['korisnicko_ime'];
		$lozinka = $row['lozinka'];
		$ime = $row['ime'];
		$prezime = $row['prezime'];
		$email = $row['email'];
		$slika = $row['slika'];
	}

	echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Detalji prekršaja | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
		   
		   echo '<div id="main-body">
					<h2>Uređivanje korisnika - ID'.$korisnik_id.'</h2>
					<form method="post" action="">
						<label for="ch_kor_tip">Tip korisnika</label>
						<select name="ch_kor_tip" id="ch_kor_tip" class="wide-select">';
						
							$sql = "SELECT tip_id,
										   naziv
										   FROM tip_korisnika;";

							$result = mysqli_query($conn, $sql);

							while ($row = mysqli_fetch_array($result)){
								
								if ($row['tip_id'] == $tip_id){
									$sel = ' selected';
								}else {
									$sel = '';
								}
								
								echo '<option value="'.$row['tip_id'].'"'.$sel.'>'.$row['naziv'].'</option>';
							}
							
				  echo '</select>
						<label for="ch_kor_username">Korisničko ime</label>
						<input type="text" name="ch_kor_username" id="ch_kor_username" value="'.$korisnicko_ime.'">
						<label for="ch_kor_pwd">Lozinka</label>
						<input type="text" name="ch_kor_pwd" id="ch_kor_pwd" value="'.$lozinka.'">
						<label for="ch_kor_ime">Ime</label>
						<input type="text" name="ch_kor_ime" id="ch_kor_ime" value="'.$ime.'">
						<label for="ch_kor_prezime">Prezime</label>
						<input type="text" name="ch_kor_prezime" id="ch_kor_prezime" value="'.$prezime.'">
						<label for="ch_kor_email">Email</label>
						<input type="email" name="ch_kor_email" id="ch_kor_email" value="'.$email.'">
						<label for="ch_kor_slika">Slika</label>
						<input type="text" name="ch_kor_slika" id="ch_kor_slika" value="'.$slika.'">
						<input type="submit" value="Ažuriraj promjene" class="btn-sub-form">
					</form>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';
}

?>