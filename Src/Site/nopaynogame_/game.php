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
		</style>

    <title>NoPayNoGame</title>
  </head>
  
  <header>
  <?php	include 'header.php'; ?>
  </header>
  
  <?php $codice_gioco = $_GET['game']; 
  

	
	$query_gioco = "SELECT *
			  FROM GAMES 
			  WHERE COD_GAME ='$codice_gioco' ";
			  
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
		<?php
		  $stars = mysql_fetch_row(mysql_query("select AVG(stars) from my_nopaynogame.REVIEW where cod_game = '$Cod_gioco'"));
								echo'<span class="fa fa-star'; if($stars[0] >= 1 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 2 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 3 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 4 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] == 5 ) { echo' checked'; } echo'"></span><b> '.$stars[0].' </b>';
		?>
		
		
		
		  <?php if($Prezzo_saldo < $Prezzo){
                  echo"<h5>€<del>".$Prezzo."</del> <i class='fa fa-chevron-right'></i> €".$Prezzo_saldo."</h5>";
                  echo'<span class="badge badge-pill badge-danger">SALDO</span>';
								}else{
									echo"<h5>€".$Prezzo."</h5>";
                }
			?>
	
		  <?php echo $FLAG_SALE;
			if($Flag_novita == 'Y'){
				echo'<span class="badge badge-pill badge-success">NUOVO!</span>';
			}
			?>
		<?php
			$query_console = "SELECT *
							  FROM DOM_CONSOLE
							  WHERE COD_CONSOLE = '$Cod_console' ";
				  
			$ris_console = ($conn->query($query_console));
	 
			 foreach ($ris_console as $riga) {
				  $Console_desc = $riga['DESC_CONSOLE'];
				  echo '<p>'.$Console_desc.'</p>';
			 }
		?>
			
			<?php
			echo"<form method='POST' action='addtocart.php'>
                <input type='hidden' name='cod_gioco' value=".$Cod_gioco." />";
                $quantita = mysql_fetch_row(mysql_query("select SUM(quantity) from my_nopaynogame.GAME_WAREHOUSE where cod_game = '$Cod_gioco'"));
                echo"<button type='submit' class='btn btn-block ";
                if($quantita[0] == 0){
                  echo"btn-danger' disabled>Non Disponibile</button>";
                }else{
                  echo"btn-warning'>Aggiungi al Carrello</button>";
                } echo"
							</form>";
			?>
			
			<br>
			
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
        <div class="col-md-9">

           <div class="embed-responsive embed-responsive-16by9"> 
      <iframe  width="854" height="480" src="<?php echo str_replace("watch?v=","embed/",$Trailer);?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
			<h5> Descrizione </h5>
			
			<p><?php echo $Descrizione?></p>
			
			<br>
			
			<h5> Requisiti di sistema </h5>
		   
		  <p><?php echo $Requisiti?></p>
		  
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

         <?php
		 $query_review = "SELECT *
						  FROM REVIEW
						  WHERE COD_GAME = '$codice_gioco ";
						  
		 $ris_review = ($conn->query($query_review));
		 
		 foreach ($ris_review as $riga) {
			 $Id_review = riga['ID_REVIEW'];
			 $Id_user = riga['ID_USER'];
			 $Stelle = riga['STARS'];
			 $Commenti = riga['COMMENT_TEXT'];
		 }
		 
		 
		 ?>
		 
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        giochi consigliati?
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'script.php'; ?>
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