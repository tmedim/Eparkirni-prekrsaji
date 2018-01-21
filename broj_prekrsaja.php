<?php

include_once "includes/db_connection.php";

session_start();

$naziv_kategorije = $_GET['kategorija'];
$id_kategorije = $_GET['id'];

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Početna | E-prekršaji</title>
			  <meta charset="utf-8">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';
			 include_once "includes/navigation_main.php";
			 
       echo '</header>';
	   
	   if (isset($_SESSION['korisnik'])){
		   include_once "includes/navigation_user.php";
	   }
       
       echo '<div id="main-body">
				<h2>'.$naziv_kategorije.'</h2>
				<table>
					<tr>
						<th>Broj prekršaja</th>
						<th>Godina</th>
					</tr>';
					
					$sql = "SELECT 
								COUNT(*) AS zbroj,
								YEAR(p.datum_prekrsaja) as godina
							FROM kategorija k, prekrsaj p 
							WHERE p.kategorija_id = k.kategorija_id
							AND k.kategorija_id=$id_kategorije
							GROUP BY YEAR(p.datum_prekrsaja);";
					
					$result = mysqli_query($conn, $sql);
					
					while ($row = mysqli_fetch_array($result)){
						
						echo '<tr>
								<td>'.$row['zbroj'].'</td>
								<td>'.$row['godina'].'</td>
							  </tr>';
					}
		  echo '</table>
		        <a href="kategorije_prekrsaja.php" class="back-link">Natrag na kategorije prekršaja</a>
			</div>
			<footer>';
				include_once "includes/footer.php";
	  echo '</footer>
		</body>
	</html>';

?>