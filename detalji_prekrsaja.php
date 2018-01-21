<?php

include_once "includes/db_connection.php";
session_start();

$prekrsaj_id = $_GET['prekrsaj_id'];

$sql = "SELECT kategorija.naziv AS naziv_k,
			   prekrsaj.naziv AS naziv_p,
			   prekrsaj.opis AS opis,
			   prekrsaj.status AS status,
			   prekrsaj.novcana_kazna AS novcana_kazna,
			   DATE_FORMAT(prekrsaj.datum_prekrsaja, '%d.%m.%Y') AS datum_prekrsaja,
			   prekrsaj.vrijeme_prekrsaja AS vrijeme_prekrsaja,
			   DATE_FORMAT(prekrsaj.datum_placanja, '%d.%m.%Y') AS datum_placanja,
			   prekrsaj.vrijeme_placanja AS vrijeme_placanja,
			   prekrsaj.slika AS slika,
			   prekrsaj.video AS video
		FROM prekrsaj, kategorija
		WHERE prekrsaj.kategorija_id = kategorija.kategorija_id
		AND prekrsaj.prekrsaj_id = $prekrsaj_id;";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)){
	$kategorija = $row['naziv_k'];
	$naziv = $row['naziv_p'];
	$opis = $row['opis'];
	$status = $row['status'];
	$novcana_kazna = $row['novcana_kazna'];
	$datum_prekrsaja = $row['datum_prekrsaja'];
	$vrijeme_prekrsaja = $row['vrijeme_prekrsaja'];
	$datum_placanja = $row['datum_placanja'];
	$vrijeme_placanja = $row['vrijeme_placanja'];
	$slika = $row['slika'];
	$video = $row['video'];
}

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Detalji prekršaja | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
       echo '</header>';
	   include_once "includes/navigation_user.php";
	   
	   echo '<div id="main-body">
				<h2>Prekršaj</h2>';
				
				if ($status != 'P'){
					echo '<a href="placanje_prekrsaja.php?prekrsaj_id='.$prekrsaj_id.'" class="btn-add btn-add1">Plaćanje prekršaja</a>';
				}
		
		  echo '<div id="o-autoru">
					<p><b>ID prekršaja:</b> '.$prekrsaj_id.'</p>
					<p><b>Kategorija prekršaja:</b> '.$kategorija.'</p>
					<p><b>Naziv:</b> '.$naziv.'</p>
					<p><b>Opis:</b> '.$opis.'</p>
					<p><b>Status:</b> '.$status.'</p>
					<p><b>Novčana kazna:</b> '.$novcana_kazna.' HRK</p>
					<p><b>Datum prekršaja:</b> '.$datum_prekrsaja.'</p>
					<p><b>Vrijeme prekršaja:</b> '.$vrijeme_prekrsaja.'</p>
					<p><b>Datum plaćanja prekršaja:</b> '.$datum_placanja.'</p>
					<p><b>Vrijeme plaćanja prekršaja:</b> '.$vrijeme_placanja.'</p>
					<p><b>Slika:</b> <a href="'.$slika.'">kliknite za sliku</a></p>
					<p><b>Video:</b> <a href="'.$video.'">kliknite za video</a></p> 
				</div>
			</div>';
		
		echo '<footer>';
				include_once "includes/footer.php";
	    echo '</footer>
		</body>
	</html>';
	
?>