<?php

echo '<nav>
		<h1 id="logo"><a href="index.php">e-parkirni prekrsaji</a></h1>
		<ul>
			<li><a href="o_autoru.php">O autoru</a></li>';
			
			if (isset($_SESSION['korisnik'])){
				echo '<li><a href="logout.php">Odjava</a></li>';
			}else {
				echo '<li><a href="prijava.php">Prijava</a></li>';
			}	
			
  echo '</ul>
	  </nav>';

?>