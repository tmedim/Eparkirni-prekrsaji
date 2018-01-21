<?php

include_once "includes/db_connection.php";
session_start();

$korisnik_id = $_SESSION['korisnik']['korisnik_id'];
$tip_id = $_SESSION['korisnik']['tip_id'];

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Moje kategorije | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
		  echo '<div id="main-body">
					<h2>Moje kategorije</h2>
					<table>
						<tr>
							<th>Naziv kategorije</th>
							<th></th>
						</tr>';
						
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
							
							echo '<tr>
									<td>'.$row['naziv'].'</td>
									<td><a href="pregled_prekrsaja.php?kategorija_id='.$row['kategorija_id'].'&naziv='.$row['naziv'].'">Pregled prekršaja</a></td>
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