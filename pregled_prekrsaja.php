<?php

include_once "includes/db_connection.php";
session_start();

$kategorija_id = $_GET['kategorija_id'];
$kategorija_naziv = $_GET['naziv'];

echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>Pregled prekršaja | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   include_once "includes/navigation_user.php";
		   	   
		   echo '<div id="main-body">
					<h2>Popis kaznenih prijava - '.$kategorija_naziv.'</h2>
					<div class="pay-or-not">';
					
					$sql = "SELECT * FROM prekrsaj WHERE status like 'P' AND kategorija_id = $kategorija_id;";
				    $result = mysqli_query($conn, $sql);
				    $broj_placenih = mysqli_num_rows($result);
					
					echo '<p><b>Plaćeno</b> - '.$broj_placenih.'</p>';
					
					$sql = "SELECT * FROM prekrsaj WHERE status like 'N' AND kategorija_id = $kategorija_id;";
				    $result = mysqli_query($conn, $sql);
				    $broj_neplacenih = mysqli_num_rows($result);
					
					echo '<p><b>Neplaćeno</b> - '.$broj_neplacenih.'</p>
					
			     </div>
					<table>
						<tr>
							<th>ID prekrsaja</th>
							<th>Registracija</th>
							<th>Osoba</th>
							<th>Naziv</th>
							<th>Status</th>
							<th>Novčana kazna</th>
							<th></th>
							<th></th>
						</tr>';
						
						$sql = "SELECT p.prekrsaj_id AS prekrsaj_id,
									   p.naziv AS naziv_prekrsaja,
									   p.status AS status,
									   p.novcana_kazna AS novcana_kazna,
									   v.registracija AS registracija,
									   k.ime AS ime,
									   k.prezime AS prezime
									   FROM prekrsaj p, vozilo v, korisnik k
									   WHERE p.vozilo_id = v.vozilo_id
									   AND v.korisnik_id = k.korisnik_id
									   AND p.kategorija_id = $kategorija_id;";
						
						$result = mysqli_query($conn, $sql);
						
						while ($row = mysqli_fetch_array($result)){
							
							echo '<tr>
									<td>'.$row['prekrsaj_id'].'</td>
									<td>'.$row['registracija'].'</td>
									<td>'.$row['ime'].' '.$row['prezime'].'</td>
									<td>'.$row['naziv_prekrsaja'].'</td>
									<td>'.$row['status'].'</td>
									<td>'.$row['novcana_kazna'].'</td>
									<td><a href="detalji_prekrsaja_moderator.php?prekrsaj_id='.$row['prekrsaj_id'].'">Detalji prekršaja</a></td>
									<td><a href="uredi_prekrsaj_moderator.php?prekrsaj_id='.$row['prekrsaj_id'].'&registracija='.$row['registracija'].'">Uredi prekršaj</a></td>
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