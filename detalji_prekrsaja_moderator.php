<?php

include_once "includes/db_connection.php";
session_start();

$prekrsaj_id = $_GET['prekrsaj_id'];

$sql = "SELECT p.naziv AS naziv_prekrsaja,
			   p.opis AS opis_prekrsaja,
			   p.status AS status,
			   p.novcana_kazna AS novcana_kazna,
			   DATE_FORMAT(p.datum_prekrsaja, '%d.%m.%Y') AS datum_prekrsaja,
			   p.vrijeme_prekrsaja AS vrijeme_prekrsaja,
			   DATE_FORMAT(p.datum_placanja, '%d.%m.%Y') AS datum_placanja,
			   p.vrijeme_placanja AS vrijeme_placanja,
			   p.slika AS slika,
			   p.video AS video,
			   v.registracija AS registracija,
			   k.ime AS ime,
			   k.prezime AS prezime
			   FROM prekrsaj p, vozilo v, korisnik k
			   WHERE p.vozilo_id = v.vozilo_id
			   AND v.korisnik_id = k.korisnik_id
			   AND p.prekrsaj_id = $prekrsaj_id;";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)){
	$naziv = $row['naziv_prekrsaja'];
	$opis = $row['opis_prekrsaja'];
	$status = $row['status'];
	$novcana_kazna = $row['novcana_kazna'];
	$datum_prekrsaja = $row['datum_prekrsaja'];
	$vrijeme_prekrsaja = $row['vrijeme_prekrsaja'];
	$datum_placanja = $row['datum_placanja'];
	$vrijeme_placanja = $row['vrijeme_placanja'];
	$slika = $row['slika'];
	$video = $row['video'];
	$registracija = $row['registracija'];
	$ime = $row['ime'];
	$prezime = $row['prezime'];
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
				<h2>Prekršaj</h2>		
				<div id="o-autoru">
					<p><b>ID prekršaja:</b> '.$prekrsaj_id.'</p>
					<p><b>Registracija vozila:</b> '.$registracija.'</p>
					<p><b>Ime:</b> '.$ime.'</p>
					<p><b>Prezime:</b> '.$prezime.'</p>
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