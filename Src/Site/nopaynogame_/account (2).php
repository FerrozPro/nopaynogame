<!DOCTYPE html>
   <!DOCTYPE html>
<html>
<head>
	<title>Account</title>

<body>
</html>
		

<?php
session_start();
require 'connection.php';
if(!isset($_SESSION['user'])){ //se non è stato ancora fatto un login
	header("Location: index.php"); //torna all'index
}
$utente=$_SESSION['user'];
$query ="SELECT * FROM USERS WHERE EMAIL='$utente' || USERNAME='$utente'";
$ris = ($conn->query($query));
foreach($ris as $riga){
  $id_utente= $riga ['ID_USER'];
  $surname = $riga ['SURNAME'];
  $password = MD5($riga ['PASSWORD']);
  $name = $riga ['NAME'];
  $email= $riga ['EMAIL'];
  $username= $riga ['USERNAME'];
  $address= $riga ['ADDRESS'];
  $phone= $riga ['PHONE'];
  $wallet= $riga ['WALLET'];
  $punti= $riga ['FIDELITY_POINT'];
  }
  
  
 //QUERY MODIFICA DATI//
 $newcognome=$_POST['newsurname'];
 $newname = $_POST['newname'];
 $newusername=$_POST['newusername'];
 $newemail=$_POST['newemail'];
 $newaddress=$_POST['newaddress'];
 $newphone=$_POST['newphone'];
 $newpassword= MD5($_POST['newpassword']);
if(isset($_POST['modificacognome'])){
	$query ="UPDATE USERS SET surname='$newcognome' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}else if(isset($_POST['modificanome'])){
	$query ="UPDATE USERS SET NAME='$newname' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}else if(isset($_POST['modificausername'])){
	$query ="UPDATE USERS SET username='$newusername' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}else if(isset($_POST['modificaemail'])){
	$query ="UPDATE USERS SET EMAIL='$newemail' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}else if(isset($_POST['modificaindirizzo'])){
	$query ="UPDATE USERS SET address='$newaddress' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}else if(isset($_POST['modificacell'])){
	if (ctype_digit($newphone)){
		$query ="UPDATE USERS SET phone='$newphone' WHERE USERNAME='$utente' || email='$utente'";
		$ris = ($conn->query($query));
		echo "<meta http-equiv='refresh' content='0'>";
	}else echo "<script type='text/javascript'>alert('Devi inserire solo numeri!');</script>";
	
}else if(isset($_POST['modificapassword'])){
	$query ="UPDATE USERS SET password='$newpassword' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}

//MODIFICA E ELIMINA COMMENTO//
if(isset($_GET['eliminacommento'])){
	$rev=$_GET['eliminacommento'];
	$query ="DELETE FROM REVIEW WHERE ID_REVIEW='$rev'";
	$ris = ($conn->query($query));
}
if(isset($_POST['modificacommento'])){
	$modcommento=$_POST['modificacommento'];
	$testocommento=$_POST['nuovocommento'];
	$stelle=$_POST['stella'];
	$query ="UPDATE REVIEW SET COMMENT_TEXT='$testocommento' , STARS='$stelle' WHERE ID_REVIEW='$modcommento'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
}

//RICARICA CONTO//
if($punti > 0){
	if(isset($_POST['ricaricaconto10'])){
		$ricarica=10;
		$query ="UPDATE USERS SET WALLET=WALLET+'$ricarica' WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		$query ="UPDATE USERS SET FIDELITY_POINT=FIDELITY_POINT-100 WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		echo "<meta http-equiv='refresh' content='0'>";
		
	}else if(isset($_POST['ricaricaconto30'])){
		$ricarica=30;
		$query ="UPDATE USERS SET WALLET=WALLET+'$ricarica' WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		$query ="UPDATE USERS SET FIDELITY_POINT=FIDELITY_POINT-250 WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		echo "<meta http-equiv='refresh' content='0'>";
		
	}else if(isset($_POST['ricaricaconto65'])){
		$ricarica=65;
		$query ="UPDATE USERS SET WALLET=WALLET+'$ricarica' WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		$query ="UPDATE USERS SET FIDELITY_POINT=FIDELITY_POINT-500 WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		echo "<meta http-equiv='refresh' content='0'>";
	}else if(isset($_POST['ricaricaconto140'])){
		$ricarica=140;
		$query ="UPDATE USERS SET WALLET=WALLET+'$ricarica' WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		$query ="UPDATE USERS SET FIDELITY_POINT=FIDELITY_POINT-1000 WHERE EMAIL='$utente' || USERNAME='$utente'";
		$ris = ($conn->query($query));
		echo "<meta http-equiv='refresh' content='0'>";
	}
}

//elimina e modifica ordine
if(isset($_POST['eliminaordine'])){
//	$ordine=$_POST['eliminaordine'];
	$del_ordine = $_POST['eliminaordine'];
    $id_user = $_POST['id_user_order'];

    $order_games= ("SELECT cod_game,quantity,game_price FROM GAME_ORDER WHERE id_order = '$del_ordine'");
    $ris = ($conn->query($order_games));  
    foreach($ris as $riga){
      $cod_game_result = $riga['cod_game'];
      $quantity_result = $riga['quantity'];
      $game_price_result = $riga['game_price'];
      $warehouse = 'WH1';
      
      $quantity_warehouse= ("SELECT quantity FROM GAME_WAREHOUSE WHERE cod_game = '$cod_game_result'");
      $risultato = ($conn->query($quantity_warehouse));  
      foreach($risultato as $rigas) {
        $safequantity = $rigas['quantity'];
      }

      $query = $conn -> prepare("UPDATE GAME_WAREHOUSE 
      SET 
      quantity = '$safequantity'+'$quantity_result' 
      WHERE cod_game = '$cod_game_result' and cod_warehouse = '$warehouse'");
      $query -> execute();
      
      $quantity_warehouse= ("SELECT wallet FROM USERS WHERE id_user = '$id_user'");
      $risultato = ($conn->query($quantity_warehouse));  
      foreach($risultato as $rigas) {
        $wallet = $rigas['wallet'];
      }

      $query = $conn -> prepare("UPDATE USERS 
      SET 
      wallet = '$wallet'+('$quantity_result'*'$game_price_result')
      WHERE id_user = '$id_user'");
      $query -> execute();
    }


    $query = $conn -> prepare("DELETE FROM GAME_ORDER WHERE id_order = '$del_ordine'");
    $query -> execute();
    
    $query = $conn -> prepare("DELETE FROM ORDERS WHERE id_order = '$del_ordine'");
    $query -> execute();
}

if(isset($_POST['paga'])){
	$pagamento=$_POST['paga'];
	$query ="UPDATE ORDERS SET FLAG_PAYD='Y' WHERE ID_ORDER='$pagamento'";
	$ris = ($conn->query($query));
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profilo</title>
    <!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
		<style>
		.checked {
				color: orange;
		}
		</style>
	</head>
	<header>
		<?php	include 'header.php'; ?>
	</header>
  <body>
    <!-- Page Content -->
    <div class="container">
			<!--apro row-->
      <div class="row">

        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Il mio profilo</h1>
          <p class="lead">Ciao <?php echo $name; ?> questo è il tuo profilo personale!</p>
         	
			
		  		<button type="button" class="btn btn-primary">
				  Portafoglio <span class="badge badge-light"><?php echo $wallet; ?></span>
				</button>
				<button type="button" class="btn btn-primary">
				  Punti fedeltà <span class="badge badge-light"><?php echo $punti; ?></span>
				</button>
				<br><br>
		 		</div>
		 
				<div class="col-12 .col-md-4">
					<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
						<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informazioni</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ordini Effettuati</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Review e Voti</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-conto-tab" data-toggle="pill" href="#pills-conto" role="tab" aria-controls="pills-conto" aria-selected="false">Il mio conto</a>
					  </li>
					</ul>

					<div class="tab-content" id="pills-tabContent">
				
						<!--home-->
						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							<table class="table table-striped">
								<thead>
									<tr>
									</tr>
								</thead>

								<tbody>
									<tr>
										<th> <i class="material-icons">account_circle</i> </th>
										<th scope="row">Nome:</th>
										<td><?php echo $name;  ?></td>
										<td class="text-right">
											<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$name"><i class="material-icons">&#xe418;</i></button>
										</td>
									</tr>
									<tr>
										<th><i class="material-icons">face</i></th>
										<th scope="row">Cognome:</th>
										<td><?php echo $surname;?></td>
										<td class="text-right">
											<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$surname"><i class="material-icons">&#xe418;</i></button>
										</td>
									</tr>
									<tr>
									<th><i class="material-icons">face</i></th>
										<th scope="row">Username:</th>
										<td><?php echo $username; ?></td>
										<td class="text-right">
											<!--<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$username"><i class="material-icons">&#xe418;</i></button> -->
										</td>
									</tr>
									<tr>
									<th><i class="material-icons">fingerprint</i></th>
										<th scope="row">Password:</th>
										<td><?php for($i=0;$i<strlen($password);$i++) echo '*'; ?></td>
										<td class="text-right">
										
											<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$password"><i class="material-icons">&#xe418;</i></button>
											 
										</td>
									</tr>
									<tr>
									<th><i class="material-icons">home</i></th>
										<th scope="row">Indirizzo:</th>
										<td><?php echo $address;  ?></td>
										<td class="text-right">
											<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$address"><i class="material-icons">&#xe418;</i></button>
										</td>
									</tr>
									<tr>
										<th><i class="material-icons">phone</i></th>
										<th scope="row">Telefono:</th>
										<td><?php echo $phone;?></td>
										<td class="text-right">
											<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$phone"><i class="material-icons">&#xe418;</i></button>
										</td>
									</tr>
									<tr>

									<form method='get' action="delete_account.php">
									<tr>
										<th><i class="material-icons">highlight_off</i></th>
										<th scope="row">Cancella Account</th>
										<td></td>
										<td class="text-right"><button type='submit' class="btn btn-danger" name='eliminaccount' value=<?php echo "$id_utente"; ?>>Elimina</button></td>
										</tr>
									</form>

								</tbody>
							</table>
						</div>
						<!--home fine-->

						<!--profilo-->
						
						<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						<p><b>Legenda:</b><br> Giallo -> da spedire <br> Verde -> spedito</p> 
							<?php //query per gli ordini//
								$query ="SELECT * FROM ORDERS WHERE ID_USER='$id_utente' ORDER BY ID_ORDER DESC";
								$ris = ($conn->query($query));
								$ris->execute();
								if($ris->rowCount() <= 0){
									echo "<center><H2>Non hai ancora effettuato un ordine :( </H2> <img src=img/sad.png style=' width:30%; heigth:30%'></center>";
								}else{
									foreach($ris as $riga){
										$pagato=$riga['FLAG_PAYD'];
										$ordine=$riga['ID_ORDER'];
							?>
										<table class="table">
											<thead>
												<tr>
													<td>Numero ordine</td>
													<td>Data</td>
													
													<td>Visualizza</td>
													<td>Paga</td>
												</tr>
											</thead>

											<tbody>
												<tr <?php if ($riga['FLAG_EVADE'] == 'Y') echo "class='table-success'"; else echo "class='table-warning'" ;?>>
													<th><?php echo $riga['ID_ORDER'];?></th>
													<td><?php echo $riga['DATE_ORDER'];?></th>
													
													
													<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ordine<?php echo $riga['ID_ORDER'];?>">
														♥
													</button></td>
													<td>
													<?php if($pagato=='N'){ 
														echo" <form method='post'><button type='submit' name='paga' class='btn btn-success' value=".$riga['ID_ORDER'].">
															Paga
														</button></form>";
													} else {
														echo "Pagato!";
													}
													
													?>
													</td>
													<!--<td><i class="material-icons">favorite_border</i></td> -->
												</tr>
											</tbody>
										</table>
										
							
									<div class="modal fade" id="ordine<?php echo $riga['ID_ORDER'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Ordine</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<div class="container">
											   <table class="table table-striped">
												<thead>
												  <tr>
													<th>Titolo</th>
													<th>Prezzo</th>
													<th>Quantità</th>
												  </tr>
												</thead>
												<?php  $query ="SELECT * FROM GAME_ORDER WHERE ID_ORDER='$ordine' ";
													   $ris = ($conn->query($query));
													   $ris->execute();
													   $somma=0;
													   foreach($ris as $riga){
														   $cod=$riga['COD_GAME'];
														   $id_ordine=$riga['ID_ORDER'];
														   $querys ="SELECT * FROM ORDERS WHERE ID_ORDER='$ordine' ";
															   $riss = ($conn->query($querys));
															   $riss->execute();
															   foreach($riss as $rigas){
																   $evaso=$rigas['FLAG_EVADE'];
																   $dataordine=$rigas['DATE_ORDER'];
															   }
															   ?>
																<tbody>
																  <tr>
																	<td>
																	<?php $squery ="SELECT * FROM GAMES WHERE COD_GAME='$cod'"; 
																	$ris = ($conn->query($squery));
																	$ris->execute();
																	foreach($ris as $rigas){ echo $rigas['TITLE'];}?></td>
																	<td><?php echo $riga['GAME_PRICE'];?></td>
																	<td><?php echo $riga['QUANTITY'];?></td>
																  </tr>
																 </tbody>
																 
														 <?php $somma+= $riga['GAME_PRICE'] * $quantita; //fare la quantita
														 
																$dt = new DateTime();
																$dts = $dt->format('Y-m-d H:i:s');
																$differenza = $dt - $dataordine ;
																
														} ?>
											  </table>
											  <p>Totale: <?php echo $somma;?></p>
											  <?php if( $differenza<=2 && $evaso!='Y'){
														echo "<form method='post'>";
														echo "<button type='submit' class='btn btn-danger' name='eliminaordine' value='$ordine'>Elimina ordine</button>";
														echo "<button type='submit' class='btn btn-warning' name='modificaordine' value='$ordine'>Modifica ordine</button>";
														echo "</form>";
													} ?>
											</div>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										
									  </div>
									</div>
								  </div>
								</div>
								
								
								
								
							<?php 
									}?><?php
							
							}?>
						</div>
						<!--profilo fine-->

						<!--review-->
						<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
							<div class="container">
								<?php
									$query ="SELECT * FROM REVIEW WHERE ID_USER='$id_utente' ORDER BY ID_REVIEW DESC";
									$ris = ($conn->query($query));
									$ris->execute();
									if($ris->rowCount() > 0){
										foreach($ris as $riga){
											$idreview=$riga['ID_REVIEW'];
											$cod_game=$riga['COD_GAME'];
											$stars=$riga['STARS'];
											$commento=$riga['COMMENT_TEXT'];
											
											$query ="SELECT * FROM GAMES WHERE COD_GAME='$cod_game'";
											$ris = ($conn->query($query));
											$ris->execute();
											foreach($ris as $riga){
												$gioco=$riga['TITLE'];
											}
											
											
								?>
						   
								<div class="accordion" id="accordion">
									<div class="card">

										<div class="card-header" id="headingOne">
											<h5 class="mb-0">
												<button class="btn" type="button" data-toggle="collapse" data-target=<?php echo "#".$idreview; ?> aria-expanded="false" aria-controls="collapseOne">
													<i class="fa fa-chevron-right"></i>
													Recensione (<?php echo $gioco; echo ' - ';
																				for($i = 0; $i < 5; $i++){
																					if($i < $stars){
																						echo " <span class='fa fa-star checked'></span>";
																					}else{
																						echo " <span class='fa fa-star'></span>";
																					}
																				}?>)
												</button>
											</h5>
										</div>
								
										<div id=<?php echo $idreview; ?> class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body">
												<p>
													<?php
														$tot=5;
														for($i = 0; $i < 5; $i++){
															if($i < $stars){
																echo " <span class='fa fa-star checked'></span>";
															}else{
																echo " <span class='fa fa-star'></span>";
															}
														}
													?>
												</p>
												<p><b>Commento:</b><?php echo $commento; ?></p>
									
												<form method='get' action=game.php>
													<button type="submit" class="btn btn-primary btn-sm" name="game" value="<?php echo $cod_game ?>" >Vai al gioco</button><br><br><br>
												</form>	
												<form method='get'>
													<button type="button" class="btn btn-warming" data-toggle="modal" data-target=<?php echo "#modifica".$idreview;?> >Modifica</button>
													<button type='submit' name='eliminacommento' value="<?php echo $idreview ?>" class="btn btn-danger"> Elimina </button>
												</form>	
											</div>
										</div>

									</div>
								</div>
										
								<!--MODAL MODIFICA COMMENTO -->
	
								<div class="modal fade" id=<?php echo "modifica".$idreview;?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" >
											  <form method='post' class="form-group">
													<p>Commento:</p>
													<textarea class="form-control" rows="5" name='nuovocommento'><?php echo $commento ?></textarea>
													<div class="form-group row">
														<label for="example-number-input" class="col-2 col-form-label">Stelle:</label>
														<div class="col-2">
															<input class="form-control" type="number" value="<?php echo $stars; ?>" name='stella' id="example-number-input" max='5' min='1'>
														</div>
													</div>
												
													<button type='submit' name='modificacommento' value="<?php echo $idreview ?>" class="btn btn-warning"> Modifica </button>
											  </form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>	
																
										
								<?php 	
									}
								}else{
									echo "<center><h4>Ancora nessun commento</h4> <img src='img/noorder.png' style='heigth:30%; width:30%;'></center>";
								} 
								?>
							</div>
						</div>
						<!--review fine-->	

						<!--conto-->	
						<div class="tab-pane fade" id="pills-conto" role="tabpanel" aria-labelledby="pills-conto-tab">
							<div class="container">

								<!--<table class="table">
									<thead>
										<tr>
											<th scope="col">Il tuo portafoglio</th>
											<th scope="col"><?php //echo $wallet;?></th>
											<!--<th scope="col">
										    <form method='post'>
													<button type="submit" name="ricaricaconto10" <?php //if($punti<100){ echo "class='btn btn-success disabled' "; }else{ echo "class='btn btn-success' ";} ?> > 10 euro</button>
												<th>
												<th scope="col">
													<button type="submit" name="ricaricaconto30" <?php //if($punti<250){ echo "class='btn btn-success disabled' "; }else{ echo "class='btn btn-success' ";} ?> > 30 euro</button>
												<th>
												<th scope="col">
													<button type="submit" name="ricaricaconto65" <?php //if($punti<500){ echo "class='btn btn-success disabled' "; }else{ echo "class='btn btn-success' ";} ?> > 65 euro</button>
												<th>
												<th scope="col">
													<button type="submit" name="ricaricaconto140"  <?php// if($punti<1000){ echo "class='btn btn-success disabled' "; }else{ echo "class='btn btn-success' ";} ?> > 140 euro</button>
											</form>
											<th>
										</tr>
									</thead>
								</table>-->
									
								<div class="row">
									<div class="col-sm-6 col-md-3 ">
										<div class="card" style="width: 18rem;">
										 
										  <div class="card-body">
											<h5 class="card-title">100 punti</h5>
											<p class="card-text">Con 100 punti potrai caricare il tuo portafoglio di 10 euro</p>
											<form method='post'>
											<?php if($punti<100){ echo "<button type='button' class='btn btn-success disabled btn-lg btn-block'>10 euro </button>"; }else{ echo "<button type='submit' name='ricaricaconto10' class='btn btn-success btn-lg btn-block'> 10 euro</button> ";} ?> 
											</form>
										  </div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="card" style="width: 18rem;">
										 
										  <div class="card-body">
											<h5 class="card-title">250 punti</h5>
											<p class="card-text">Con 250 punti potrai caricare il tuo portafoglio di 30 euro</p>
											<form method='post'>
											 <button type="submit" name="ricaricaconto30" <?php if($punti<250){ echo "class='btn btn-success disabled btn-lg btn-block' "; }else{ echo "class='btn btn-success btn-lg btn-block' ";} ?> > 30 euro</button>
											</form>
										  </div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="card" style="width: 18rem;">
										
										  <div class="card-body">
											<h5 class="card-title">500 punti</h5>
											<p class="card-text">Con 500 punti potrai caricare il tuo portafoglio di 65 euro</p>
											<form method='post'>
												<button type="submit" name="ricaricaconto65" <?php if($punti<500){ echo "class='btn btn-success disabled btn-lg btn-block ' "; }else{ echo "class='btn btn-success btn-lg btn-block' ";} ?> > 65 euro</button>
											</form>
										  </div>
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="card" style="width: 18rem;">
										 
										  <div class="card-body">
											<h5 class="card-title">1000 punti</h5>
											<p class="card-text">Con 1000 punti potrai caricare il tuo portafoglio di 140 euro</p>
											<form method='post'>
												<button type="submit" name="ricaricaconto140"  <?php if($punti<1000){ echo "class='btn btn-success disabled btn-lg btn-block' "; }else{ echo "class='btn btn-success btn-lg btn-block' ";} ?> > 140 euro</button>
											</form>
										  </div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<!--conto fine-->	
					</div>
				</div>
			</div>
			<!--chiudo row-->
		</div>
		<!--div container-->
	
		
		
		<!-- MODAL MODIFICHE DEI DATI UTENTE -->
		<div class="modal fade" id="$name">
			<div class="modal-dialog">
			  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form method=post>
							<input class="form-control" type=text name="newname" >
							<button type="submit" class="btn btn-warning" name="modificanome">Modifica</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		  
		<div class="modal fade" id="$password">
			<div class="modal-dialog">
			  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					
					<div class="modal-body">
						<form method=post>
						
							<input class="form-control" type="password" name="newpassword" >
					       
							<button type="submit" class="btn btn-warning" name="modificapassword">Modifica</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
		  
		  
		<div class="modal fade" id="$surname">
			<div class="modal-dialog">
			  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form method=post>
							<input class="form-control" type=text name="newsurname" >
							<button type="submit" class="btn btn-warning" name="modificacognome">Modifica</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
		  
		<div class="modal fade" id="$email">
			<div class="modal-dialog">
			  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form method=post>
							<input class="form-control" type=text name="newemail" >
							<button type="submit" class="btn btn-warning" name="modificaemail">Modifica</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
		  
		<div class="modal fade" id="$phone">
			<div class="modal-dialog">
			  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form method=post>
							<input class="form-control" type="text" name="newphone" maxlength="10">
							<button type="submit" class="btn btn-warning" name="modificacell">Modifica</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
		  
		<div class="modal fade" id="$address">
			<div class="modal-dialog">
			  <div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form method=post>
							<input class="form-control" type=text name="newaddress">
							<button type="submit" class="btn btn-warning" name="modificaindirizzo">Modifica</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
		  
		<!--<div class="modal fade" id="$username">
			<div class="modal-dialog">
			  <div class="modal-content">
					
					<div class="modal-header">
						<h4 class="modal-title">Modifica dati</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<div class="modal-body">
						<form method=post>
							<input class="form-control" type=text name="newusername">
							<button type="submit" class="btn btn-warning" name="modificausername">Modifica</button>
						</form>
					</div>
				
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
		  -->


		<!-- MODAL ordini -->
		<!-- Modal -->
		<div class="modal fade" id="<?php echo $riga['ID_ORDER']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						...
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

	
		<!-- Modal RICARICA CONTO-->
		<div class="modal fade" id="ricarica" tabindex="-1" role="dialog" aria-labelledby="ricarica" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ricarica conto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method='post'>
							<div class="form-group" >
								Cifra:<input class="form-control" type='number' value=<?php echo $wallet; ?> name='numero_ricarica'>
							</div>
							
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">Paypal</label>
							</div>
							<button type="submit" class="btn btn-primary" name='salva_ricarica'>Salva</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		
    <!-- Bootstrap core JavaScript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<script type="text/javascript">
			function setnewpicidvalue(divid){
				clickid = "imageuploadform" + divid;
				document.getElementById(clickid).click();
			}
		</script>
  </body>
</html>