<?php

include_once "includes/db_connection.php";
session_start();

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Kategorije i moderatori | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
	   echo '<div id="main-body">
				<h2>Kategorije i moderatori</h2>
				<a href="dodaj_kategoriju_moderatoru.php" class="btn-add">Dodaj kategoriju moderatoru</a>
				<table>
					<tr>
						<th>Naziv kategorije</th>
						<th>Moderator</th>
						<th>Opis kategorije</th>
						<th></th>
					</tr>';
					
					$sql = "SELECT k.naziv AS naziv,
								   kor.ime AS ime,
								   kor.prezime AS prezime,
								   kor.korisnicko_ime AS korisnicko_ime,
								   k.opis AS opis,
								   k.kategorija_id AS kategorija_id
						    FROM kategorija k, korisnik kor
						    WHERE k.moderator_id = kor.korisnik_id
						    ORDER BY kor.ime ASC, kor.prezime ASC;";

					$result = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($result)){
						$kategorija_id = $row['kategorija_id'];
						$naziv = $row['naziv'];
						$ime = $row['ime'];
						$prezime = $row['prezime'];
						$korisnicko_ime = $row['korisnicko_ime'];
						$opis = $row['opis'];
						
						echo '<tr>
								<td>'.$naziv.'</td>
								<td>'.$ime.' '.$prezime.' - '.$korisnicko_ime.'</td>
								<td>'.$opis.'</td>
								<td><a href="uredi_kategoriju_moderatoru.php?kategorija_id='.$kategorija_id.'">Uredi</a></td>
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