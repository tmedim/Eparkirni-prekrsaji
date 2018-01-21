<?php

include_once "includes/db_connection.php";
session_start();

if (isset($_POST['add_reg']) && isset($_POST['add_marka']) && isset($_POST['add_tip'])) {
	$korisnik_id = $_SESSION['korisnik']['korisnik_id'];
	$registracija = $_POST['add_reg'];
	$marka = $_POST['add_marka'];
	$tip = $_POST['add_tip'];
	
	$sql = "INSERT INTO vozilo
			(korisnik_id, registracija, marka_vozila, tip_vozila)
			VALUES
			('$korisnik_id', '$registracija', '$marka', '$tip');";
	
	$result = mysqli_query($conn, $sql);
	header ("location: motorna_vozila.php");
}

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Dodavanje vozila | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
	   echo '<div id="main-body">
				<h2>Dodavanje novog motornog vozila</h2>
				<form method="post" action="">
					<label for="add_reg">Registracija</label>
					<input type="text" name="add_reg" id="add_reg">
					<label for="add_marka">Marka vozila</label>
					<input type="text" name="add_marka" id="add_marka">
					<label for="add_tip">Tip vozila</label>
					<input type="text" name="add_tip" id="add_tip">
					<input type="submit" value="Dodaj vozilo" class="btn-sub-form">
				</form>
			</div>';
		
		echo '<footer>';
				include_once "includes/footer.php";
	    echo '</footer>
		</body>
	</html>';


?>