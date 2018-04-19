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
	Require ('connection.php');
	
	$query = "SELECT *
			  FROM GAMES 
			  WHERE COD_GAME ='$codice_gioco' ";
			  
    $ris = ($conn->query($query));
	
	foreach($ris as $riga){
		$Cod_gioco = $riga['COD_GAME'];
		$Titolo = $riga['TITLE'];
		$Prezzo = $riga['PRICE'];
		$Cod_console = $riga['COD_CONSOLE'];
		$Prezzo_vendita = $riga['PRICE_ON_SALE'];
		$Flag_vendita = $riga['FLAG_SALE'];
		$Flag_novita = $riga['FLAG_NEWS'];
		$Immagine = $riga['IMAGE'];
		$Descrizione = $riga['DESCRIPTION'];
		$Requisiti = $riga['SPEC-REQ'];
		$Trailer = $riga['TRAILER'];
		$Data = $riga['INSERTION_DATE'];
	}
	
	
  ?>
  <body>

    <div class="container">
      <h1><?php echo $Titolo?></h1>
      <div class="row">
        <div class="col-md-3">
          <?php echo $Immagine?>foto <?php echo $FLAG_SALE?>saldo <?php echo $Flag_novita?>novità <?php echo $Prezzo?>prezzo carrello | generi?
        </div>
        <div class="col-md-9">
          <?php echo $Trailer?>trailer <?php echo $Descrizione?>descrizione <?php echo $Requisiti?>requisiti | generi?
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
         recensioni
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