<?php

include_once "includes/db_connection.php";
session_start();

if (isset($_POST['add_kat_mod_moderator']) && isset($_POST['add_kat_mod_naziv']) && 
	isset($_POST['add_kat_mod_opis'])){
		
	$moderator_id = $_POST['add_kat_mod_moderator'];
	$naziv = $_POST['add_kat_mod_naziv'];
	$opis = $_POST['add_kat_mod_opis'];
	
	$sql = "INSERT INTO kategorija
	(moderator_id, naziv, opis)
	VALUES
	('$moderator_id', '$naziv', '$opis');";
	
	$result = mysqli_query($conn, $sql);

	header ('location: kategorije.php');
	
}else {
	echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Dodjeljivanje kategorije moderatoru | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
		   
		   echo '<div id="main-body">
					<h2>Dodjeljivanje kategorije moderatoru</h2>
					<form method="post" action="">
						<label for="add_kat_mod_moderator">Moderator</label>
						<select name="add_kat_mod_moderator" id="add_kat_mod_moderator" class="wide-select">';
							$sql = "SELECT ime,
										   prezime,
										   korisnicko_ime,
										   korisnik_id
										   FROM korisnik
										   WHERE tip_id = 1;";

							$result = mysqli_query($conn, $sql);

							while ($row = mysqli_fetch_array($result)){								
								echo '<option value="'.$row['korisnik_id'].'">'.$row['ime'].' '.$row['prezime'].' - '.$row['korisnicko_ime'].'</option>';
							}
	
				  echo '</select>
						<label for="add_kat_mod_naziv">Naziv</label>
						<input type="text" name="add_kat_mod_naziv" id="add_kat_mod_naziv">
						<label for="add_kat_mod_opis">Opis</label>
						<textarea name="add_kat_mod_opis" id="add_kat_mod_opis" rows="5"></textarea>
						<input type="submit" value="Dodjeli kategoriju moderatoru" class="btn-sub-form">
					</form>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';
}

?>