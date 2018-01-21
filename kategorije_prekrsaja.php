<?php

include_once "includes/db_connection.php";
session_start();

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Kategorije prekršaja | E-prekršaji</title>
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
					<h2>Kategorije prekršaja</h2>
					<table>
						<tr>
							<th>Naziv kategorije prekršaja</th>
							<th></th>
						</tr>';
						
						$sql = "SELECT kategorija_id, naziv FROM kategorija;";
						
						$result = mysqli_query($conn, $sql);
						
						while ($row = mysqli_fetch_array($result)){
							
							echo '<tr>
									<td>'.$row['naziv'].'</td>
									<td><a href="broj_prekrsaja.php?id='.$row['kategorija_id'].'&kategorija='.$row['naziv'].'">Detalji</a></td>
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