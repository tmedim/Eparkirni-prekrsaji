<?php

include_once "includes/db_connection.php";
session_start();

$korisnik_id = $_SESSION['korisnik']['korisnik_id'];

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Motorna vozila | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
		  echo '<div id="main-body">
					<h2>Motorna vozila</h2>
					<a href="dodaj_vozilo.php" class="btn-add">Dodaj vozilo</a>
					<table>
						<tr>
							<th>ID vozila</th>
							<th>Registracija</th>
							<th>Marka</th>
							<th>Tip</th>
							<th></th>
						</tr>';
						
						$sql = "SELECT vozilo_id,
									   registracija,
									   marka_vozila,
									   tip_vozila
								FROM vozilo
								WHERE korisnik_id = $korisnik_id;";
						
						$result = mysqli_query($conn, $sql);
						
						while ($row = mysqli_fetch_array($result)){
							
							echo '<tr>
									<td>'.$row['vozilo_id'].'</td>
									<td>'.$row['registracija'].'</td>
									<td>'.$row['marka_vozila'].'</td>
									<td>'.$row['tip_vozila'].'</td>
									<td><a href="uredi_vozilo.php?vozilo_id='.$row['vozilo_id'].'">Uredi</a></td>
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