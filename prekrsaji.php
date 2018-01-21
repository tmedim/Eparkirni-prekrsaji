<?php

include_once "includes/db_connection.php";
session_start();

$korisnik_id = $_SESSION['korisnik']['korisnik_id'];

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Prekršaji | -prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
		  echo '<div id="main-body">
					<h2>Prekršaji</h2>
					<table>
						<tr>
							<th>ID prekršaja</th>
							<th>Registracija</th>
							<th>Marka</th>
							<th>Tip</th>
							<th>Status</th>
							<th></th>
						</tr>';
						
						$sql = "SELECT vozilo.vozilo_id AS vozilo_id,
									   vozilo.registracija AS registracija,
									   vozilo.marka_vozila AS marka_vozila,
									   vozilo.tip_vozila AS tip_vozila,
									   prekrsaj.status AS status,
									   prekrsaj.prekrsaj_id AS prekrsaj_id
								FROM vozilo, prekrsaj
								WHERE vozilo.vozilo_id = prekrsaj.vozilo_id
								AND vozilo.korisnik_id = $korisnik_id
								ORDER BY prekrsaj_id DESC;";
						
						$result = mysqli_query($conn, $sql);
						
						while ($row = mysqli_fetch_array($result)){
							
							echo '<tr>
									<td>'.$row['prekrsaj_id'].'</td>
									<td>'.$row['registracija'].'</td>
									<td>'.$row['marka_vozila'].'</td>
									<td>'.$row['tip_vozila'].'</td>
									<td>'.$row['status'].'</td>
									<td><a href="detalji_prekrsaja.php?prekrsaj_id='.$row['prekrsaj_id'].'">Detalji prekršaja</a></td>
								</tr>';
						}
			  echo '</table>
				</div>';
		
		echo '<footer>';
				include_once "includes/footer.php";
	    echo '</footer>
		</body>
	</html>';

?>