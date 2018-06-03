<!doctype html>
<html lang="en">
  <?php	include 'header.php'; ?>
  <body>
    <div class="container">
      <div class="row">
			<?php 
			  $tipo_ricerca = $_GET["tipo_ricerca"];
			  $id = $_GET["id"];
				
			  switch ($tipo_ricerca) {
					case 'catalogo':
						$lista_giochi = ($conn->query("SELECT * from my_nopaynogame.GAMES"));
						echo"<h1>Catalogo Completo</h1></div><div class='row'>";
						break;
					case 'genere':
						$lista_giochi = ($conn->query("SELECT g.* from my_nopaynogame.GAMES g, my_nopaynogame.GAME_GENRE gg where gg.cod_genre = '$id' and g.cod_game = gg.cod_game"));
						$query = ($conn->query("SELECT desc_genre from my_nopaynogame.DOM_GENRE where cod_genre = '$id'"));
						foreach($query as $riga) {
							$nome_genere = $riga['desc_genre'];
						}
						echo"<h1>Genere ".$nome_genere."</h1></div><div class='row'>";
						break;
					case 'console':
						$lista_giochi = ($conn->query("SELECT * from my_nopaynogame.GAMES where cod_console = '$id'"));
						$query = ($conn->query("SELECT desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$id'"));
						foreach($query as $riga) {
							$nome_console = $riga['desc_console'];
						}
						echo"<h1>Piattaforma ".$nome_console."</h1></div><div class='row'>";						
						break;
					case 'search':
						$cod_c = $_POST['cod_console'];
						$cod_g = $_POST['cod_genere'];
						$cod_s = $_POST['cod_saldo'];
						$cod_n = $_POST['cod_novita'];
						$cod_t = $_POST['cod_testo'];
						$cod_p = $_POST['cod_prezzo'];
						$cod_r = $_POST['cod_review'];
						$range = 15;

						if ($cod_p < 0){
							$cod_p = 0;
							$range = 15000;
						}
						
						$lista_giochi_query = "
						select g.* 
						from my_nopaynogame.GAMES g LEFT JOIN my_nopaynogame.GAME_GENRE gg ON	g.cod_game = gg.cod_game LEFT JOIN my_nopaynogame.REVIEW r ON g.cod_game = r.cod_game
						where 
							g.title like '%".$cod_t."%'
							and g.flag_news like '%".$cod_n."%'
							and g.flag_sale like '%".$cod_s."%'
							and (gg.cod_genre like '%".$cod_g."%'	or gg.cod_genre IS NULL)
							and g.cod_console like '%".$cod_c."%'
							and g.price_on_sale between $cod_p and $cod_p+$range
						group by g.cod_game
						having (AVG(r.stars) >= $cod_r) or ($cod_r < 1)
						";
						$lista_giochi = ($conn->query($lista_giochi_query));
						echo"<h1>Risultati Ricerca</h1></div><div class='row'>";						
						break;
				}
				
				if($lista_giochi -> rowCount()<1){
					echo"<h3>Nessun risultato trovato.</h3>";
				}else{
					foreach($lista_giochi as $gioco) {
						$cod_gioco = $gioco[0];
						$nome_gioco = $gioco[1];
						$prezzo_gioco = $gioco[2];
						$prezzo_saldo = $gioco[4];
						$novita = $gioco[6];
						$img = $gioco[7];
						$query = ($conn->query("SELECT desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$gioco[3]'"));
						foreach($query as $riga) {
							$console = $riga['desc_console'];
						}
						
						echo"<div class='col-lg-3 col-md-4 col-sm-6'>";
							echo"<div class='card h-100'>";
								echo"<a href='game.php?cp=game&game=".$cod_gioco."'><img class='card-img-top img-fluid' src='".$img."' alt=''></a>";
								echo"<div class='card-body'>";
									echo"<h4 class='card-title'>";
									echo"<a href='game.php?cp=game&game=".$cod_gioco."'>".$nome_gioco."</a>";
									echo"</h4>";
	
									$query = ($conn->query("SELECT AVG(stars) from my_nopaynogame.REVIEW where cod_game = '$cod_gioco'"));
									foreach($query as $riga) {
										$stars = $riga[0];
									}
									echo'<span class="fa fa-star'; if($stars[0] >= 1 ) { echo' checked'; } echo'"></span>';
									echo'<span class="fa fa-star'; if($stars[0] >= 2 ) { echo' checked'; } echo'"></span>';
									echo'<span class="fa fa-star'; if($stars[0] >= 3 ) { echo' checked'; } echo'"></span>';
									echo'<span class="fa fa-star'; if($stars[0] >= 4 ) { echo' checked'; } echo'"></span>';
									echo'<span class="fa fa-star'; if($stars[0] == 5 ) { echo' checked'; } echo'"></span>';
	
									if($prezzo_saldo < $prezzo_gioco){
										echo"<h5>€<del>".$prezzo_gioco."</del> <i class='fa fa-chevron-right'></i> €".$prezzo_saldo."</h5>";
										echo'<span class="badge badge-pill badge-danger">SALDO</span>';
									}else{
										echo"<h5>€".$prezzo_gioco."</h5>";
									}
	
									if($novita == 'Y'){
										echo'<span class="badge badge-pill badge-success">NUOVO!</span>';
									}
	
									echo"<p class='card-text'>".$console."</p>";
								echo"</div>";
	
								echo"<div class='card-footer'>";
								echo"<form method='POST' action='addtocart.php'>
									<input type='hidden' name='cod_gioco' value=".$cod_gioco." />";
									$query = ($conn->query("SELECT SUM(quantity) from my_nopaynogame.GAME_WAREHOUSE where cod_game = '$cod_gioco'"));
									foreach($query as $riga) {
									$quantita = $riga[0];
									}
									echo"<button type='submit' class='btn btn-block ";
									if($quantita == 0){
									echo"btn-danger' disabled>Non Disponibile</button>";
									}else{
									echo"btn-warning'>Aggiungi al Carrello</button>";
									} echo"
							</form>";
								echo"</div>";
	
							echo"</div>";
						echo"</div>";
						}
				}
				
			?>
      </div>
    </div>
    <?php include 'script.php'; ?>
  </body>

</html>