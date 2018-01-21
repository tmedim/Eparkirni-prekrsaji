<?php

require_once "includes/db_connection.php";

session_start();

if (isset($_POST['log_username']) && isset($_POST['log_password'])){
	$username = $_POST['log_username'];
	$password = $_POST['log_password'];

	$sql = "SELECT korisnik_id,
				   tip_id,
				   korisnicko_ime,
				   lozinka,
				   ime,
				   prezime,
				   email,
				   slika
			FROM korisnik
			WHERE korisnicko_ime LIKE '$username';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if ($password === $row['lozinka']){
		$_SESSION['korisnik']['korisnik_id'] = $row['korisnik_id'];
		$_SESSION['korisnik']['tip_id'] = $row['tip_id'];
		$_SESSION['korisnik']['korisnicko_ime'] = $row['korisnicko_ime'];
		$_SESSION['korisnik']['ime'] = $row['ime'];
		$_SESSION['korisnik']['prezime'] = $row['prezime'];
		$_SESSION['korisnik']['email'] = $row['email'];
		$_SESSION['korisnik']['slika'] = $row['slika'];
		
		header ("location: index.php");
	}else {
		unset($_SESSION['korisnik']);
		$msg = "Krivo korisničko ime ili lozinka!";
	}
}

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Prijava | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 include_once "includes/navigation_main.php";
			 
       echo '</header>
			<div id="main-body">
				<div id="login-container">
					<h2>Prijava</h2>
					<form method="post" action="prijava.php">
						<label for="log_username">Korisničko ime</label>
						<input type="text" name="log_username" id="log_username" required>
						<label for="log_password">Lozinka</label>
						<input type="password" name="log_password" id="log_password" required>
						<input type="submit" value="Prijava" class="btn-sub-form">
					</form>';
					if (isset($msg)){
						echo '<p>'.$msg.'</p>';
					}
		  echo '</div>
			</div>		
			<footer>';
				include_once "includes/footer.php";
	  echo '</footer>
		</body>
	</html>';

?>