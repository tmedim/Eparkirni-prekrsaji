<?php

include_once "includes/db_connection.php";
session_start();

$korisnik_id = $_SESSION['korisnik']['korisnik_id'];
$vozilo_id = $_GET['vozilo_id'];

if (isset($_POST['add_reg']) && isset($_POST['add_marka']) && isset($_POST['add_tip'])) {
	$registracija = $_POST['add_reg'];
	$marka = $_POST['add_marka'];
	$tip = $_POST['add_tip'];

	$sql = "UPDATE vozilo
			SET registracija='$registracija',
				marka_vozila='$marka',
				tip_vozila='$tip'
			WHERE vozilo_id='$vozilo_id';";
	
	$result = mysqli_query($conn, $sql);
	header ("location: motorna_vozila.php");	
}else {
	$sql = "SELECT registracija,
				   marka_vozila,
				   tip_vozila
			FROM vozilo
			WHERE vozilo_id='$vozilo_id';";

	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)){
		$registracija = $row['registracija'];
		$marka = $row['marka_vozila'];
		$tip = $row['tip_vozila'];
	}

	echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Uređivanje vozila | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
		   
		   echo '<div id="main-body">
					<h2>Uređivanje vozila</h2>
					<form method="post" action="">
						<label for="add_reg">Registracija</label>
						<input type="text" name="add_reg" id="add_reg" value="'.$registracija.'">
						<label for="add_marka">Marka vozila</label>
						<input type="text" name="add_marka" id="add_marka" value="'.$marka.'">
						<label for="add_tip">Tip vozila</label>
						<input type="text" name="add_tip" id="add_tip" value="'.$tip.'">
						<input type="submit" value="Ažuriraj" class="btn-sub-form">
					</form>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';
}


?>