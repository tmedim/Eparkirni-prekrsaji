<?php

include_once "includes/db_connection.php";
session_start();

echo '<!DOCTYPE html>
	  <html>
		  <head>
			  <title>Početna | E-prekršaji</title>
			  <meta charset="utf-6">
			  <link rel="stylesheet" type="text/css" href="css/style.css">
		  </head>
		  <body>
			 <header>';				 
			 include_once "includes/navigation_main.php";			 
       echo '</header>';
	   
	   if (!isset($_SESSION['korisnik'])){		   
		   header ("location: kategorije_prekrsaja.php");
	   }else {		   
			include_once "includes/navigation_user.php";			
			if ($_SESSION['korisnik']['tip_id'] == 1){
				header ("location: moje_kategorije.php");
			}			
	   }
	   
	  echo '<footer>';
				include_once "includes/footer.php";
	  echo '</footer>
		</body>
	</html>';

?>