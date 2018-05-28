<!doctype html>
<html lang="en">
  
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.checked {
					color: orange;
			}
			
			@media (min-width: 768px) {

				/* show 3 items */
				.carousel-inner .active,
				.carousel-inner .active + .carousel-item,
				.carousel-inner .active + .carousel-item + .carousel-item,
				.carousel-inner .active + .carousel-item + .carousel-item + .carousel-item  {
						display: block;
				}

				.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
				.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item,
				.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item,
				.carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
						transition: none;
				}

				.carousel-inner .carousel-item-next,
				.carousel-inner .carousel-item-prev {
					position: relative;
					transform: translate3d(0, 0, 0);
				}

				.carousel-inner .active.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
						position: absolute;
						top: 0;
						right: -25%;
						z-index: -1;
						display: block;
						visibility: visible;
				}

				/* left or forward direction */
				.active.carousel-item-left + .carousel-item-next.carousel-item-left,
				.carousel-item-next.carousel-item-left + .carousel-item,
				.carousel-item-next.carousel-item-left + .carousel-item + .carousel-item,
				.carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item,
				.carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
						position: relative;
						transform: translate3d(-100%, 0, 0);
						visibility: visible;
				}

				/* farthest right hidden item must be abso position for animations */
				.carousel-inner .carousel-item-prev.carousel-item-right {
						position: absolute;
						top: 0;
						left: 0;
						z-index: -1;
						display: block;
						visibility: visible;
				}

				/* right or prev direction */
				.active.carousel-item-right + .carousel-item-prev.carousel-item-right,
				.carousel-item-prev.carousel-item-right + .carousel-item,
				.carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item,
				.carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item,
				.carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
						position: relative;
						transform: translate3d(100%, 0, 0);
						visibility: visible;
						display: block;
						visibility: visible;
				}
			}
			</style>

		<title>NoPayNoGame</title>
	</head>
  
	<header>
		<?php include 'header.php'; 
		if(isset($_SESSION['user']))
			$utente=$_SESSION['user'];
		?>
	</header>
  
	<?php 
		$codice_gioco = $_GET['game']; 	
		$query_gioco = "SELECT * FROM GAMES WHERE COD_GAME ='$codice_gioco' ";	  
		$ris_gioco = ($conn->query($query_gioco));
		
		foreach($ris_gioco as $riga){
			$Cod_gioco = $riga['COD_GAME'];
			$Titolo = $riga['TITLE'];
			$Prezzo = $riga['PRICE'];
			$Cod_console = $riga['COD_CONSOLE'];
			$Prezzo_saldo = $riga['PRICE_ON_SALE'];
			$Flag_vendita = $riga['FLAG_SALE'];
			$Flag_novita = $riga['FLAG_NEWS'];
			$Immagine = $riga['IMAGE'];
			$Descrizione = $riga['DESCRIPTION'];
			$Requisiti = $riga['SPEC_REQ'];
			$Trailer = $riga['TRAILER'];
			$Data = $riga['INSERTION_DATE'];
		}
	?>

	<body>

		<div class="container">
			<h1><?php echo $Titolo?></h1>
			<div class="row">
				<div class="col-md-3">
					<img class='img-fluid' src="<?php echo $Immagine?>" alt="Non va">
					<div>
						<?php
							$stars = mysql_fetch_row(mysql_query("select cast(AVG(stars)AS DECIMAL(10,1)) from my_nopaynogame.REVIEW where cod_game = '$Cod_gioco'"));
							echo'<span class="fa fa-star'; if($stars[0] >= 1 ) { echo' checked'; } echo'"></span>';
							echo'<span class="fa fa-star'; if($stars[0] >= 2 ) { echo' checked'; } echo'"></span>';
							echo'<span class="fa fa-star'; if($stars[0] >= 3 ) { echo' checked'; } echo'"></span>';
							echo'<span class="fa fa-star'; if($stars[0] >= 4 ) { echo' checked'; } echo'"></span>';
							echo'<span class="fa fa-star'; if($stars[0] == 5 ) { echo' checked'; } echo'"></span><b> '.$stars[0].' </b>';
						?>
					</div>
					<div>
						<?php 
							if($Prezzo_saldo < $Prezzo){
								echo"<h5>€<del>".$Prezzo."</del> <i class='fa fa-chevron-right'></i> €".$Prezzo_saldo."</h5>";
								echo'<span class="badge badge-pill badge-danger">SALDO</span>';
							}
							else{
								echo"<h5>€".$Prezzo."</h5>";
							}
						?>
					</div>
					<div>
						<?php 
							echo $FLAG_SALE;
							if($Flag_novita == 'Y'){
								echo '<span class="badge badge-pill badge-success">NUOVO!</span>';
							}
						?>
					</div>
					<div>
						<?php
							$query_console = "SELECT * FROM DOM_CONSOLE WHERE COD_CONSOLE = '$Cod_console' ";
							$ris_console = ($conn->query($query_console));
							foreach ($ris_console as $riga) {
								$Console_desc = $riga['DESC_CONSOLE'];
								echo '<p>'.$Console_desc.'</p>';
							}
						?>
					</div>
					<div>
						<?php
							echo "<form method='POST' action='addtocart.php'>
							<input type='hidden' name='cod_gioco' value=".$Cod_gioco." />";
							$quantita = mysql_fetch_row(mysql_query("select SUM(quantity) from my_nopaynogame.GAME_WAREHOUSE where cod_game = '$Cod_gioco'"));
							echo"<button type='submit' class='btn btn-block ";
							if($quantita[0] == 0){
								echo"btn-danger' disabled>Non Disponibile</button>";
							}else{
								echo"btn-warning'>Aggiungi al Carrello</button>";
							} 
							echo "</form>";
						?>
					</div>
					<div>
						<?php
							$query_genre = "SELECT dg.DESC_GENRE 
											FROM GAME_GENRE gg, DOM_GENRE dg
											WHERE COD_GAME = '$codice_gioco' AND gg.COD_GENRE = dg.COD_GENRE ";
							$ris_genre = ($conn->query($query_genre));
							foreach ($ris_genre as $riga) {
								$Genere_game = $riga['DESC_GENRE'];
								echo '<span class="badge badge-info">'.$Genere_game.'</span>'; 
							}
						?>
					</div>			
				</div>
				<div class="col-md-9">
					<div class="embed-responsive embed-responsive-16by9"> 
						<iframe  width="854" height="480" src="<?php echo str_replace("watch?v=","embed/",$Trailer);?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
					<h5> Descrizione </h5>
					<p><?php echo $Descrizione?></p>
					<h5> Requisiti di sistema </h5>
					<p><?php echo $Requisiti?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h5> Recensioni </h5>
					<div class="list-group">
						<?php
							$query_review = "SELECT * FROM REVIEW WHERE COD_GAME = '$codice_gioco'";
							$ris_review = ($conn->query($query_review));
							foreach ($ris_review as $riga) {
								$Id_review = $riga['ID_REVIEW'];
								$Id_user = $riga['ID_USER'];
								$Stelle = $riga['STARS'];
								$Commenti = $riga['COMMENT_TEXT'];	 
								$query_nomeutente = "SELECT * FROM USERS WHERE ID_USER = '$Id_user'";
								$ris_nomeutente = ($conn->query($query_nomeutente));
								foreach ($ris_nomeutente as $riga) {
									$Nome_utente = $riga['USERNAME'];
								}			 
						?>
							<?php 
							$codutente="SELECT * FROM USERS WHERE EMAIL='$utente' || USERNAME='$utente'";
							$ris = ($conn->query($codutente));
							foreach($ris as $riga){
								$cod=$riga['ID_USER'];
							}
								
							
							
							//if($cod==$ris_query_verificato){$acquistoverificato=1;}else {$acquistoverificato=0;}
						
						?>
						
						<div class="list-group">
							<a  class="list-group-item list-group-item-action flex-column align-items-start ">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1"><?php echo $Nome_utente ?></h5><small>
									<small style='color:green;'><?php 
									$query_review_verificato = "SELECT ord.ID_USER FROM USERS us, GAME_ORDER go, ORDERS ord WHERE us.ID_USER = ord.ID_USER AND ord.ID_ORDER = go.ID_ORDER AND go.COD_GAME=60";
									$ris_query_verificato = ($conn->query($query_review_verificato));
									foreach($ris_query_verificato as $riga){
										$acquistoverificato=$riga['ID_USER'];
									}
										if($acquistoverificato == $Id_user){ echo "ACQUISTO VERIFICATO"; } ?></small>
									
									<?php  
										echo'<span class="fa fa-star'; if($Stelle[0] >= 1 ) { echo' checked'; } echo'"></span>';
										echo'<span class="fa fa-star'; if($Stelle[0] >= 2 ) { echo' checked'; } echo'"></span>';
										echo'<span class="fa fa-star'; if($Stelle[0] >= 3 ) { echo' checked'; } echo'"></span>';
										echo'<span class="fa fa-star'; if($Stelle[0] >= 4 ) { echo' checked'; } echo'"></span>';
										echo'<span class="fa fa-star'; if($Stelle[0] == 5 ) { echo' checked'; } echo'"></span>';
									?></small>
								</div>
								<p class="mb-1"><?php echo $Commenti ?></p>
							</a>
						</div>
						<?php 
							}
						?>
						
					
						<?php 
							if (isset($_POST ['invia_recensione'])){
								if (isset($_POST ['star'])) {
									if($_POST ['star'] == 'star_1')
									    $Stella = 1;
								
									else if ($_POST ['star'] == 'star_2')
										$Stella = 2;
								
									else if ($_POST ['star'] == 'star_3')
										$Stella = 3;
								
									else if ($_POST ['star'] == 'star_4')
										$Stella = 4;
								
									else if ($_POST ['star'] == 'star_5') 
										$Stella = 5;
								}
								$commento = $_POST ['testo_recensione'];
								$query_codice_utente = "SELECT ID_USER FROM USERS WHERE USERNAME = '$utente' OR EMAIL = '$utente'";
								$ris_codice_utente = ($conn->query($query_codice_utente));
								foreach ($ris_codice_utente as $riga) {
									$Id_utente_cod = $riga['ID_USER'];
								}
								$query_controllo_commento =	"SELECT * FROM REVIEW re, USERS usr WHERE re.ID_USER = usr.ID_USER AND re.ID_USER = '$Id_utente_cod' AND re.COD_GAME = '$Cod_gioco'";
								$ris_query_controllo_commento = ($conn->query($query_controllo_commento));
								if ($ris_query_controllo_commento -> rowCount()> 0){
									echo "<script>alert('Hai già commentato questo gioco');</script>";
								}else{
								$query_insert="INSERT INTO `REVIEW`(`COD_GAME`, `ID_USER`, `STARS`, `COMMENT_TEXT`) 
									    VALUES ('$Cod_gioco','$Id_utente_cod','$Stella','$commento')";
									$ris_insert =($conn->query($query_insert));
									echo "<meta http-equiv='refresh' content='0'>";
								}
							}
						if(isset($_SESSION['user'])){
						?><form method='post'>
								<h4> Recensione </h4>
									<div class="form-group form-check-inline">
										<div class="radio"  style='margin-right:20px;'>
										  <label><input type="radio" value="star_1" name="star"><span class="fa fa-star checked" ></span></label>
										</div>
										<div class="radio" style='margin-right:20px;'>
										  <label><input type="radio" value="star_2" name="star"><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span></label>
										</div>
										<div class="radio" style='margin-right:20px;'>
										  <label><input type="radio" value="star_3" name="star"><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span></label>
										</div>
										<div class="radio" style='margin-right:20px;'>
										  <label><input type="radio" value="star_4" name="star"><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span></label>
										</div>
										<div class="radio" style='margin-right:20px;'>
										  <label><input type="radio" name='star' value="star_5"><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span><span class="fa fa-star checked" ></span></label>
										</div>
									</div>
									<div class="form-group">
										<label for="exampleTextarea">Scrivi qui il tuo commento</label>
										<textarea class="form-control" id="exampleTextarea" rows="3" name='testo_recensione'></textarea>
									</div>
									
									<button type='submit' class='btn btn-primary' name='invia_recensione'>Invia</button>
							</form>
					  <?php 	}else { echo "<p>Devi essere loggato per poter lasciare una recensione</p> <a href='sign.php'><button type='button' class='btn btn-primary'>Loggati</button></a>"; }
							
						?> 
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">					
					<div class="container-fluid">
					<h2>Giochi consigliati</h2>
						<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
							<div class="carousel-inner row w-100 mx-auto" role="listbox">
								<?php 
									$query_random_game = "SELECT * FROM GAMES ga, GAME_GENRE gg,DOM_CONSOLE dm, DOM_GENRE dg WHERE ga.COD_CONSOLE=dm.COD_CONSOLE AND dg.COD_GENRE = gg.COD_GENRE AND gg.COD_GAME = ga.COD_GAME AND gg.COD_GENRE in (SELECT gg2.COD_GENRE FROM GAMES ga2 , GAME_GENRE gg2, DOM_CONSOLE dm2 WHERE dm2.COD_CONSOLE=ga2.COD_CONSOLE AND ga2.COD_GAME=$Cod_gioco AND gg2.COD_GAME = ga2.COD_GAME ) ORDER BY RAND() LIMIT 8";
									$ris_random_game = ($conn->query($query_random_game));
									$i = 0;
									foreach ($ris_random_game as $riga) {
										$Immagine_gioco_random = $riga['IMAGE'];
										$Codice_gioco_random = $riga['COD_GAME'];
										$Titolo_gioco_random = $riga['TITLE'];
										$Prezzo_gioco_random = $riga['PRICE'];
										/*echo'
										<div class="carousel-item col-md-3 '; if($i == 0){ echo 'active'; } echo'">
											<img class="img-fluid mx-auto d-block" src="'; echo $Immagine_gioco_random; echo'" alt="slide '.$i.'">
										</div>
										';*/
                                        echo'
                                        <div class="carousel-item col-md-3 '; if($i == 0){ echo 'active'; } echo'">
                                          <div class="card">
                                            <a href="http://nopaynogame.altervista.org/nopaynogame_/game.php??cp=game&game='.$Codice_gioco_random.'"><img class="card-img-top" src="'; echo $Immagine_gioco_random; echo'" alt="slide '.$i.'"></a>
                                            <div class="card-body">
                                              <h5 class="card-title">'.$Titolo_gioco_random.'</h5>
                                              <h6 class="card-subtitle mb-2 text-muted">'.$Prezzo_gioco_random.' €</h6>
                                            </div>
                                          </div>
                                        </div>';
										$i++;					
									}
								?>
							</div>
							<a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
								<i class="fa fa-chevron-left fa-lg text-muted"></i>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
								<i class="fa fa-chevron-right fa-lg text-muted"></i>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<?php include 'script.php'; ?>
		<script js>
			$('#carouselExample').on('slide.bs.carousel', function (e) {
				var $e = $(e.relatedTarget);
				var idx = $e.index();
				var itemsPerSlide = 4;
				var totalItems = $('.carousel-item').length;
				if (idx >= totalItems-(itemsPerSlide-1)) {
					var it = itemsPerSlide - (totalItems - idx);
					for (var i=0; i<it; i++) {
						// append slides to end
						if (e.direction=="left") {
								$('.carousel-item').eq(i).appendTo('.carousel-inner');
						}
						else {
								$('.carousel-item').eq(0).appendTo('.carousel-inner');
						}
					}
				}
			});
		</script>
	</body>
</html>

<!--
$stars = mysql_fetch_row(mysql_query("select AVG(stars) from my_nopaynogame.REVIEW where cod_game = '$cod_gioco'"));
								echo'<span class="fa fa-star'; if($stars[0] >= 1 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 2 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 3 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 4 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] == 5 ) { echo' checked'; } echo'"></span>';
for($i = 0; $i < 5; $i++){
															if($i < $stars){
																echo " <span class='fa fa-star checked'></span>";
															}else{
																echo " <span class='fa fa-star'></span>";
															}
														}


<form method='POST' action='addtocart.php'>
                <input type='hidden' name='cod_gioco' value=".$cod_gioco." />";
                $quantita = mysql_fetch_row(mysql_query("select SUM(quantity) from my_nopaynogame.GAME_WAREHOUSE where cod_game = '$cod_gioco'"));
                echo"<button type='submit' class='btn btn-block ";
                if($quantita[0] == 0){
                  echo"btn-danger' disabled>Non Disponibile</button>";
                }else{
                  echo"btn-warning'>Aggiungi al Carrello</button>";
                } echo"
							</form>

if($prezzo_saldo < $prezzo_gioco){
                  echo"<h5>€<del>".$prezzo_gioco."</del> <i class='fa fa-chevron-right'></i> €".$prezzo_saldo."</h5>";
                  echo'<span class="badge badge-pill badge-danger">SALDO</span>';
								}else{
									echo"<h5>€".$prezzo_gioco."</h5>";
                }

								if($novita == 'Y'){
                  echo'<span class="badge badge-pill badge-success">NUOVO!</span>';
								}
                
-->
