<?php

include_once "includes/db_connection.php";
session_start();

if (isset($_POST['dan_od']) && isset($_POST['mje_od']) && isset($_POST['god_od']) &&
	isset($_POST['dan_do']) && isset($_POST['mje_do']) && isset($_POST['god_do'])){
		
	$dan_od = $_POST['dan_od'];
	$mje_od = $_POST['mje_od'];
	$god_od = $_POST['god_od'];
	$dan_do = $_POST['dan_do'];
	$mje_do = $_POST['mje_do'];
	$god_do = $_POST['god_do'];
	
	$sql = "SELECT COUNT(*) AS zbroj,
				   k.ime AS ime, 
				   k.prezime AS prezime
			FROM vozilo v, korisnik k, prekrsaj p
			WHERE v.korisnik_id = k.korisnik_id 
			AND v.vozilo_id=p.vozilo_id
			AND p.datum_prekrsaja BETWEEN '$god_od-$mje_od-$dan_od' AND '$god_do-$mje_do-$dan_do'
			GROUP BY k.korisnik_id ORDER BY zbroj DESC LIMIT 20;";
	
	$result = mysqli_query($conn, $sql);
	
	$ispis = '<table class="top-20">
					<tr>
						<th>Ime</th>
						<th>Prezime</th>
						<th>Broj prekršaja</th>
					</tr>';
	
	while ($row = mysqli_fetch_array($result)){
		
		$ispis .= '<tr>
					  <td>'.$row['ime'].'</td>
					  <td>'.$row['prezime'].'</td>
					  <td>'.$row['zbroj'].'</td>
				  </tr>';
		
	}
	
	$ispis .= '</table>';
	
}

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Top 20 | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 
			 include_once "includes/navigation_main.php";	
			 
	   echo '</header>';
	   include_once "includes/navigation_user.php";
	   
	   echo '<div id="main-body">
				<h2>Top 20 korisnika po broju prekršaja</h2>
				<h3 class="form-title">Datum od</h3>
				<form method="post" action="" class="top-20-form">
					<div class="inline-element">
				<label for="dan_od">Dan</label>
				<select name="dan_od" id="dan_od">';
					for ($i = 1; $i <= 31; $i++){
						if ($i / 10 < 1) { $j = '0'.$i;	}
						else { $j = $i;	}						
						
						echo '<option value="'.$j.'">'.$j.'</option>';
					}	
		   echo '</select>
					</div>
					<div class="inline-element">
						<label for="mje_od">Mjesec</label>
						<select name="mje_od" id="mje_od">';
							for ($i = 1; $i <= 12; $i++){
								if ($i / 10 < 1) { $j = '0'.$i;	}
								else { $j = $i;	}
								
								echo '<option value="'.$j.'">'.$j.'</option>';
							}
				  echo '</select>
					</div>
					<div class="inline-element">
						<label for="god_od">Godina</label>
						<select name="god_od" id="god_od">';
							for ($i = date("Y"); $i >= 1900; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
				  echo '</select>
					</div>                
					<div class="new-row">
						<h3 class="form-title">Datum do</h3>
						<div class="inline-element">
							<label for="dan_do">Dan</label>
							<select name="dan_do" id="dan_do">';
								for ($i = 1; $i <= 31; $i++){
									if ($i / 10 < 1) { $j = '0'.$i;	}
									else { $j = $i;	}						
									
									echo '<option value="'.$j.'">'.$j.'</option>';
								}
					  echo '</select>
						</div>
						<div class="inline-element">
							<label for="mje_do">Mjesec</label>
							<select name="mje_do" id="mje_do">';
								for ($i = 1; $i <= 12; $i++){
									if ($i / 10 < 1) { $j = '0'.$i;	}
									else { $j = $i;	}
									
									echo '<option value="'.$j.'">'.$j.'</option>';
								}
					  echo '</select>
						</div>
						<div class="inline-element">
							<label for="god_do">Godina</label>
							<select name="god_do" id="god_do">';
								for ($i = date("Y"); $i >= 1900; $i--){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
					  echo '</select>
						</div>       
					</div>
					<input type="submit" value="Top korisnici" class="btn-sub-form btn-sf1">
				</form>';
				
				if (isset($ispis)){
					echo $ispis;
				}
				
	  echo '</div>';
		
		echo '<footer>';
				include_once "includes/footer.php";
		echo '</footer>
		</body>
	</html>';


?>