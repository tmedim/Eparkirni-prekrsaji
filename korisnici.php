<?php

include_once "includes/db_connection.php";
session_start();

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Korisnici | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
	   echo '<div id="main-body">
				<h2>Korisnici</h2>
				<a href="dodaj_korisnika.php" class="btn-add">Dodaj korisnika</a>
				<table>
					<tr>
						<th>ID</th>
						<th>Tip korisnika</th>
						<th>Korisničko ime</th>
						<th>Lozinka</th>
						<th>Ime</th>
						<th>Prezime</th>
						<th>Email</th>
						<th>Slika</th>
						<th></th>
					</tr>';
					
					$sql = "SELECT k.korisnik_id AS korisnik_id,
								   t.naziv AS naziv_tipa,
								   k.korisnicko_ime AS korisnicko_ime,
								   k.lozinka AS lozinka,
								   k.ime AS ime,
								   k.prezime AS prezime,
								   k.email AS email,
								   k.slika AS slika
								   FROM korisnik k, tip_korisnika t
								   WHERE k.tip_id = t.tip_id
								   ORDER BY t.tip_id ASC,k.ime ASC, k.prezime ASC;";

					$result = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($result)){
						$korisnik_id = $row['korisnik_id'];
						$naziv_tipa = $row['naziv_tipa'];
						$korisnicko_ime = $row['korisnicko_ime'];
						$lozinka = $row['lozinka'];
						$ime = $row['ime'];
						$prezime = $row['prezime'];
						$email = $row['email'];
						$slika = $row['slika'];
						
						echo '<tr>
								<td>'.$korisnik_id.'</td>
								<td>'.$naziv_tipa.'</td>
								<td>'.$korisnicko_ime.'</td>
								<td>'.$lozinka.'</td>
								<td>'.$ime.'</td>
								<td>'.$prezime.'</td>
								<td>'.$email.'</td>
								<td>'.$slika.'</td>
								<td><a href="uredi_korisnika.php?korisnik_id='.$korisnik_id.'">Uredi korisnika</a></td>
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