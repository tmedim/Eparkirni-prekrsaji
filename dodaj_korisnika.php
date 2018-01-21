<?php

include_once "includes/db_connection.php";
session_start();

if (isset($_POST['ch_kor_tip']) && isset($_POST['ch_kor_username']) && isset($_POST['ch_kor_pwd']) &&
	isset($_POST['ch_kor_ime']) && isset($_POST['ch_kor_prezime'])){
		
	$tip_id = $_POST['ch_kor_tip'];
	$korisnicko_ime = $_POST['ch_kor_username'];
	$lozinka = $_POST['ch_kor_pwd'];
	$ime = $_POST['ch_kor_ime'];
	$prezime = $_POST['ch_kor_prezime'];
	$email = $_POST['ch_kor_email'];
	$slika = $_POST['ch_kor_slika'];
	
	$sql = "INSERT INTO korisnik
	(tip_id, korisnicko_ime, lozinka, ime, prezime, email, slika)
	VALUES
	('$tip_id', '$korisnicko_ime', '$lozinka', '$ime', '$prezime', '$email', '$slika');";
	
	$result = mysqli_query($conn, $sql);

	header ('location: korisnici.php');
	
}else {
	echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Dodavanje korisnika | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
		   
		   echo '<div id="main-body">
					<h2>Dodavanje novog korisnika</h2>
					<form method="post" action="">
						<label for="ch_kor_tip">Tip korisnika</label>
						<select name="ch_kor_tip" id="ch_kor_tip" class="wide-select">';
						
							$sql = "SELECT tip_id,
										   naziv
									FROM tip_korisnika;";

							$result = mysqli_query($conn, $sql);

							while ($row = mysqli_fetch_array($result)){								
								echo '<option value="'.$row['tip_id'].'">'.$row['naziv'].'</option>';
							}
							
				  echo '</select>
						<label for="ch_kor_username">Korisničko ime</label>
						<input type="text" name="ch_kor_username" id="ch_kor_username">
						<label for="ch_kor_pwd">Lozinka</label>
						<input type="text" name="ch_kor_pwd" id="ch_kor_pwd">
						<label for="ch_kor_ime">Ime</label>
						<input type="text" name="ch_kor_ime" id="ch_kor_ime">
						<label for="ch_kor_prezime">Prezime</label>
						<input type="text" name="ch_kor_prezime" id="ch_kor_prezime">
						<label for="ch_kor_email">Email</label>
						<input type="email" name="ch_kor_email" id="ch_kor_email">
						<label for="ch_kor_slika">Slika</label>
						<input type="text" name="ch_kor_slika" id="ch_kor_slika">
						<input type="submit" value="Dodaj korisnika" class="btn-sub-form">
					</form>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';
}

?>