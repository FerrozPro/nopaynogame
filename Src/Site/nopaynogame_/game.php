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
		<?php include 'header.php'; ?>
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
						<div class="list-group">
							<a  class="list-group-item list-group-item-action flex-column align-items-start ">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1"><?php echo $Nome_utente ?></h5>
									<small><?php  
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
						<div class="form-group">
							<label for="exampleTextarea">La tua recensione</label>
							<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!--
					<div class="card-group">
						<div class="card">
							<img class="card-img-top" src="<?php echo $Immagine_gioco_random?>" style='heigth:180px; width:100px; '>
							<div class="card-body">
								<h5 class="card-title"><?php echo $Titolo_gioco_random ?></h5>
								<p class="card-text"><?php echo $Prezzo_gioco_random ?></p>
							</div>
						</div>
					</div>
					-->
					
					<div class="container-fluid">
						<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
							<div class="carousel-inner row w-100 mx-auto" role="listbox">
								<?php 
									$query_random_game = "SELECT * FROM GAMES ga, GAME_GENRE gg, DOM_GENRE dg WHERE dg.COD_GENRE = gg.COD_GENRE AND gg.COD_GAME = ga.COD_GAME ORDER BY RAND() LIMIT 8";
									$ris_random_game = ($conn->query($query_random_game));
									$i = 0;
									foreach ($ris_random_game as $riga) {
										$Immagine_gioco_random = $riga['IMAGE'];
										$Titolo_gioco_random = $riga['TITLE'];
										$Prezzo_gioco_random = $riga['PRICE'];
										echo'
										<div class="carousel-item col-md-3 '; if($i == 0){ echo 'active'; } echo'">
											<img class="img-fluid mx-auto d-block" src="'; echo $Immagine_gioco_random; echo'" alt="slide '.$i.'">
										</div>
										';
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
					<!--
					<div class="container-fluid">
						<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
							<div class="carousel-inner row w-100 mx-auto" role="listbox">
								<div class="carousel-item col-md-3 active">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400/000/fff?text=1" alt="slide 1">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=2" alt="slide 2">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=3" alt="slide 3">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=4" alt="slide 4">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=5" alt="slide 5">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=6" alt="slide 6">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=7" alt="slide 7">
								</div>
								<div class="carousel-item col-md-3">
									<img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=8" alt="slide 7">
								</div>
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
					-->
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