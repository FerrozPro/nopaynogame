<!doctype html>
<html lang="en">

<?php
session_start();
require 'connection.php';
$utente=$_SESSION['user'];
$query="SELECT ID_USER FROM USERS WHERE USERNAME='$utente' || EMAIL='$utente'";
$ris = ($conn->query($query));
foreach($ris as $riga){
	$ute=$riga['ID_USER'];
}
$first=1;
		
		if(isset($_POST['buttoncheck'])){
			$step2=1;
			$back=0;
		}else if(isset($_POST['buttonaddress'])){
			$step3=1;
			$step2=0;
			$step5=0;
			$step4=0;
			$back=0;
		}else if(isset($_POST['buttonpay'])){
			$step4=1;
			$step2=0;
			$step3=0;
			$step5=0;
			$back=0;
		}else if(isset($_POST['confirm'])){ 
			$step5=1;
			$step4=0;
			$step2=0;
			$step3=0;
			$back=0;
			
		}else if(isset($_POST['back'])){
			$back=1;
		}
		
		

$query ="SELECT * FROM USERS WHERE USERNAME='$utente' || EMAIL='$utente'";
$ris = ($conn->query($query));
foreach($ris as $riga){
  $surname = $riga ['SURNAME'];
  $name = $riga ['NAME'];
  $email= $riga ['EMAIL'];
  $username= $riga ['USERNAME'];
  $address= $riga ['ADDRESS'];
  $phone= $riga ['PHONE'];
  $portafoglio= $riga ['WALLET'];
  }
 
$max=count($_SESSION['carrello']); 
$i=0;
//while($max==0){ 
		$gioco=$_SESSION['carrello'][$i];
		//echo $gioco;
		$query ="SELECT * FROM GAMES WHERE COD_GAME='$gioco'";
		$ris = ($conn->query($query));  
		foreach($ris as $riga){
			$title=$riga['TITLE'];
		}
		$i++;
		//$max--;
//}

if(isset($_GET['delete_item'])){
	$codice=$_GET['delete_item'];
	foreach (array_keys($_SESSION['carrello'], $codice) as $key) {
		unset($_SESSION['carrello'][$key]);
	}
}

if(isset($_POST['modifica_cognome'])){
	$newsurname=$_POST['newcognome'];
	$query ="UPDATE USERS SET SURNAME='$newsurname' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
}else if(isset($_POST['modifica_nome'])){
	$newname=$_POST['newnome'];
	$query ="UPDATE USERS SET NAME='$newname' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
}else if(isset($_POST['modifica_indirizzo'])){
	$newind=$_POST['newindirizzo'];
	$query ="UPDATE USERS SET ADDRESS='$newind' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}

?>
  
  <?php	include 'header.php'; ?>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Carrello</h1>
          <p class="lead">Ciao <?php if(!isset($_SESSION['user'])){ echo "Utente Sconosciuto"; } else {echo $name;}?> questo è il tuo carrello</p>
          <p class="lead"><button type="button" class="btn btn-primary">
						  Portafoglio iniziale <span class="badge badge-light"><?php echo $portafoglio."€"; ?></span>
						  </button></p>
       <!--Tabella prodotti-->
	   
	   <?php if(($step2==0 && $step3==0 && $step4==0 & $step5==0) || $back==1){ ?>
	   <?php if(!isset($_SESSION['carrello']) || empty($_SESSION['carrello'])){?>
	    
    				
					<h3> Il tuo carrello è vuoto! </h3>
					<img src='img/sad.png' style='width:30%; heigth:30%;'>
					<a href='http://nopaynogame.altervista.org/nopaynogame_/index.php?cp=home'><button type='button' class='btn bt-success'>Inizia lo Shopping!</button></a>
					<?php }else{ ?>
					<div class="progress">
					  <div class="progress-bar progress-bar-striped" style="width:20%"></div>
					</div>
				   
					<table id="cart" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:50%">Prodotto</th>
							<th style="width:10%">Prezzo</th>
							<th style="width:8%">Quantità</th>
							<th style="width:22%" class="text-center">Sub-totale</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					
					<?php
					
					$total=0;
					reset($_SESSION['carrello']);
					$first_key = key($_SESSION['carrello']);
					//print_r($_SESSION['carrello']);
					$max=count($_SESSION['carrello']);
					$unique = array_unique($_SESSION['carrello']);
					$unique_c=count($unique);
					
					for($i=$first_key ;$i<$unique_c+$first_key;$i++)
						$array[$i]++;
					
					$copia=$_SESSION['carrello'];
			
					$y=$first_key;
					
					for($i=$first_key;$i<$max+$first_key;$i++){ 
						for($j=$i+1;$j<$max+$first_key;$j++){
							
							if($copia[$i] == $copia[$j] ){
								$array[$y]=$array[$y]+1;
								
							}
						}
						$y++;
						
					
					}
					
					$i=$first_key;
					
					while($max+$first_key!=0){ 
							$gioco=$unique[$i];
							$query ="SELECT DISTINCT * FROM GAMES WHERE COD_GAME='$gioco'";
							$ris = ($conn->query($query));
							
							foreach($ris as $riga){
								$console=$riga['COD_CONSOLE'];
								$querys ="SELECT DISTINCT * FROM DOM_CONSOLE WHERE COD_CONSOLE='$console'";
								$riss = ($conn->query($querys));
								foreach($riss as $rigas){
								
							
					//}?>
					<tbody>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><?php echo $rigas['DESC_CONSOLE']; ?> <class="img-responsive" style="width:200px; heigth:200px;"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"><?php echo $riga['TITLE']; ?></h4>
										
									</div>
								</div>
							</td>
							<td data-th="Price"><?php if($riga['FLAG_SALE']=='N') echo $riga['PRICE']; else echo $riga['PRICE_ON_SALE'];?></td>
							<td data-th="Quantity">
								<input type="number" class="form-control text-center" value=<?php echo $array[$i]; ?>>
							</td>
							<td data-th="Subtotal" class="text-center"><?php if($riga['FLAG_SALE']=='N') echo $riga['PRICE']*$array[$i]; else echo $riga['PRICE_ON_SALE']*$array[$i];?></td>
							<td class="actions" data-th="">
								<form method='get'><button type='submit' class="btn btn-info btn-sm" name="refresh_item" value=<?php echo $riga['COD_GAME'];?>><i class="material-icons">autorenew</i></button>
								<button type='submit' class="btn btn-danger btn-sm" name="delete_item" value=<?php echo $riga['COD_GAME'];?>><i class="material-icons">delete_forever</i></button></form>								
							</td>
						</tr>
					</tbody>
					
					<?php 
								/*if(isset($_GET['refresh_item'])){
									/*echo "valori array";
									print_r($array);
									echo "valore carrello";
									print_r($_SESSION['carrello']);
									$codice=$_GET['refresh_item']; //ricerca all'interno del carrello -> restituire primo indice dove trovo l'elemento. Allo stess indice decremento la postazione di array
									$y=$first_key;
									for($i=$first_key;$i<$max+$first_key;$i++){ 
										for($j=$i+1;$j<$max+$first_key;$j++){
											
											if($copia[$i] == $copia[$j] ){
												$array[$y]=$array[$y]-1;
												
											}
										}
										$y++;
									}
					
								}*/
					
								if($riga['FLAG_SALE']=='N'){
									$total=$total+($riga['PRICE']*$array[$i]);
								}
								else{ $total=$total+($riga['PRICE_ON_SALE']*$array[$i]);
									//echo $riga['PRICE_ON_SALE'];
								}
						
							}
					}
						$i++;
						$max--; 
					}
							
						
							?>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong></strong></td>
						</tr>
						<tr>
							<td><a href="http://nopaynogame.altervista.org/nopaynogame_/gamelist.php?cp=cat&tipo_ricerca=catalogo" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong><?php echo $total; ?></strong></td>
							<?php if(!isset($_SESSION['user'])) echo " <td><button type='submit' name='buttoncheck' class='btn btn-sucess btn-md' data-toggle='modal' data-target='#myModalregistrazione'>Checkout con registrazione</button></a></td>" ;
							else echo" <form method=post><td><button type='submit' class='btn btn-success btn-md' name='buttoncheck' >Checkout</button></td></form>"; ?>
						</tr>
	   </tfoot><?php } ?>
				</table>
	   <?php  }else if($step2==1 && $step3==0 && $step4==0 & $step5==0){ ?>
	   <div class="progress">
		<div class="progress-bar progress-bar-striped" style="width:50%"></div>
		</div>
	    Il tuo indirizzo:
	     <table class="table">
			  <thead>
				<tr>
				  <th scope="col">Nome:</th>
				  <td> <?php echo $name; ?></td>
				  <th scope="col"></th>
				  <th scope="col"></th>
				  <th scope="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myname">Modifica</button></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">Cognome: </th>
				  <td><?php echo $surname; ?></td>
				  <td></td>
				  <td></td>
				  <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mysurname">Modifica</button></td>
				</tr>
				<tr>
				  <th scope="row">Indirizzo: </th>
				  <td><?php echo $address; ?></td>
				  <td></td>
				  <td></td>
				  <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myaddress">Modifica</button></td>
				</tr>
				
			  </tbody>
			</table>
			<form method='post'>
			<button type='submit' class='btn btn-warning btn-md' name='back'>Torna indietro</button>
			<button type='submit' class='btn btn-success btn-md' name='buttonpay'>Ultimo step!</button>
			
			</form>
	   
	   <?php }else if($step2==0 && $step3==1 && $step4==0 & $step5==0){ ?>
	   
	   
	   <?php }else if($step2==0 && $step3==0 && $step4==1 & $step5==0){ ?>
	   <div class="progress">
		<div class="progress-bar progress-bar-striped" style="width:100%"></div>
	   </div>
	   <div class="row">
		  <div class="col-6 col-md-6">
		  
			<p> Riepilogo prodotti:</p>
	       <table class="table">
			  <thead>
				<tr>
				 <!-- <th scope="col">Codice gioco</th> -->
				  <th scope="col">Titolo</th>
				  <th scope="col">Prezzo</th>
				  <th scope="col">Subtotale</th>
				  <th scope="col">Quantità</th>
				</tr>
			  </thead>
			  <tbody>
			  <?PHP 
				$total=0;
					reset($_SESSION['carrello']);
					$first_key = key($_SESSION['carrello']);
					//print_r($_SESSION['carrello']);
					$max=count($_SESSION['carrello']);
					$unique = array_unique($_SESSION['carrello']);
					$unique_c=count($unique);
					
					for($i=$first_key ;$i<$unique_c+$first_key;$i++)
						$array[$i]++;
					
					$copia=$_SESSION['carrello'];
			
					$y=$first_key;
					for($i=$first_key;$i<$max+$first_key;$i++){ 
						for($j=$i+1;$j<$max+$first_key;$j++){
							
							if($copia[$i] == $copia[$j] ){
								$array[$y]=$array[$y]+1;
							}
						}
						$y++;
						
					
					}
					$i=$first_key;
			  $result = array_unique($_SESSION['carrello']);
			  $max+$first_key=count($result);
			  while($max!=0){ 
     		  $gioco=$result[$i];
			  $query ="SELECT *FROM GAMES WHERE COD_GAME='$gioco' "; 
			 
				$ris = ($conn->query($query));  
				foreach($ris as $riga){
			    ?>
				<tr>
				 <!-- <th scope="row"><?php //echo $riga['COD_GAME']; ?></th>-->
				  <td><?php echo $riga['TITLE']; ?></td>
				  <td><?php if($riga['FLAG_SALE']=='N') echo $riga['PRICE']; else echo $riga['PRICE_ON_SALE'];?></td>
				  <td><?php if($riga['FLAG_SALE']=='N') echo $riga['PRICE']*$array[$i]; else echo $riga['PRICE_ON_SALE']*$array[$i];?></td>
				  <td><?php echo $array[$i];?></td>
				</tr>
				<?php }
					$i++;
					$max--;
			     }				
				?>
			  </tbody>
			</table>
			<p>Con questo ordine guadagnerai X punti</p>
		  </div>
		  
		  <div class="col-6 col-md-6">
			 <p>Indirizzo di spedizione</p>
			  <table class="table">
			  <thead>
				<tr>
				
				  <th scope="col">Nome</th>
				  <th scope="col">Cognome</th>
				  <th scope="col">Indirizzo</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				 
				  <td><?php echo $name; ?></td>
				  <td><?php echo $surname; ?></td>
				  <td><?php echo $address; ?></td>
				</tr>
				
			  </tbody>
			</table>
			
		  </div>
		  
		  <div class="col-6 col-md-6">
		  <p>Pagamento</p>
		  <select>
			  <option value="paypal">Paypal</option>
			  <option value="postepay">Postepay</option>
			  <option value="bonifico">Bonifico</option>
			 
		</select>
		</div>
		 <!-- <div class="col-6 col-md-6">
				 <p>Pagamento</p>
	     <table class="table">
			  <thead>
				<tr>
				  <th scope="col">Metodo</th>
				 </tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">Bonifico bancario</th>
				 <form>
				  <td><label >
					  <input type="radio" value="bonifico" name='a' />
					  <img src="img/bonifico.png" style='width:20%; heigth:20%;'>
					</label></td>
				  
				</tr>
				<tr>
				  <th scope="row">PayPal</th>
				 <td><label>
					  <input type="radio" value="paypal" name='a' />
					  <img src="img/paypal.png" style='width:20%; heigth:20%;'>
					</label></td>
				  
				</tr>
				<tr>
				  <th scope="row">Contrassegno</th>
				  <td><label>
					  <input type="radio" value="contrassegno" name='a' />
					  <img src="img/contrassegno.png" style='width:20%; heigth:20%;'>
					</label></td>
				 </form>
				</tr>
			  </tbody>
			</table>
		  </div> -->
		</div>
			<form method='post'>
			<button type='submit' class='btn btn-warning btn-md' name='buttoncheck'>Torna indietro</button>
			<button type='submit' class='btn btn-success btn-md' name='confirm'>Invia ordine</button>
			
			</form>
		    
		 </div> 
		  
	   
	   <?php }else if($step2==0 && $step3==0 && $step4==0 & $step5==1){
		   
					$total=0;
					reset($_SESSION['carrello']);
					$first_key = key($_SESSION['carrello']);
					//print_r($_SESSION['carrello']);
					$max=count($_SESSION['carrello']);
					$unique = array_unique($_SESSION['carrello']);
					$unique_c=count($unique);
					$unique_ci=$unique_c;
					for($i=$first_key ;$i<$unique_c+$first_key;$i++)
						$array[$i]++;
					
					$copia=$_SESSION['carrello'];
			
					$y=$first_key;
					for($i=$first_key;$i<$max+$first_key;$i++){ 
						for($j=$i+1;$j<$max+$first_key;$j++){
							
							if($copia[$i] == $copia[$j] ){
								$array[$y]=$array[$y]+1;
							}
						}
						$y++;
						
					
					}
					$i=$first_key;
			  $result = array_unique($_SESSION['carrello']);
			  $max+$first_key=count($result);
			  while($max!=0){ 
     		  $gioco=$result[$i];
			  $query ="SELECT * FROM GAMES WHERE COD_GAME='$gioco' "; 
			 
				$ris = ($conn->query($query));  
				foreach($ris as $riga){
			    ?>
				<!---<tr>
				
				  <td><?php //echo $riga['TITLE']; ?></td>
				  <td><?php// if($riga['FLAG_SALE']=='N') echo $riga['PRICE']; else echo $riga['PRICE_ON_SALE'];?></td>
				  <td><?php //if($riga['FLAG_SALE']=='N') echo $riga['PRICE']*$array[$i]; else echo $riga['PRICE_ON_SALE']*$array[$i];?></td>
				  <td><?php//echo $array[$i];?></td>
				</tr> -->
				<?php }
					$i++;
					$max--;
			     }				
				
			
			//query che inserisce l'ordine
			$data=date("Y-m-d H:i:s");
			$codepayment='PAY1'; //sistema
			$query="INSERT INTO `ORDERS`(`ID_USER`, `COD_PAYMENT`, `DATE_ORDER`, `FLAG_PAYD`, `FLAG_EVADE`) 
			VALUES ('$ute','$codepayment','$data','N','N')";
			$ris = ($conn->query($query));
			
			//ricerca ultimo id_order inserito
			$query="SELECT ID_ORDER FROM ORDERS ORDER BY ID_ORDER DESC LIMIT 1";
			$ris = ($conn->query($query));
			foreach($ris as $riga){
				$id_order=$riga['ID_ORDER'];
			}
			
			//ripetere per ogni elemento dell'array
			$i=0;
			while($unique_ci !=0){
				$cod_game=$result[$i];
				
				$quantita=$array[$i];
				$query="SELECT * FROM GAMES WHERE COD_GAME='$cod_game'";
				$ris = ($conn->query($query));
						foreach($ris as $riga){
						$game_price =$riga['PRICE'];
					
						
				
						// dal codice del gioco faccio una query per prendere il costo
						
						$query="INSERT INTO `GAME_ORDER`(`ID_ORDER`, `COD_GAME`, `QUANTITY`, `GAME_PRICE`) 
						VALUES ('$id_order','$cod_game','$quantita','$game_price')";
						$ris = ($conn->query($query));
						
						
						$query="UPDATE GAME_WAREHOUSE SET QUANTITY = QUANTITY - '$quantita' WHERE COD_GAME = '$cod_game' ";
						$ris = ($conn->query($query));
						
						$query="SELECT * FROM USERS WHERE ID_USER = '$ute' "; 
						$ris = ($conn->query($query));
						foreach($ris as $riga){
							$wallet=$riga['WALLET'];
						}
						if($wallet<$game_price){
							$query="UPDATE USERS SET WALLET =0 WHERE ID_USER = '$ute' "; 
							$ris = ($conn->query($query));
						}else{
							$query="UPDATE USERS SET WALLET = WALLET - '$game_price' WHERE ID_USER = '$ute' "; 
							$ris = ($conn->query($query));
						}
						
						$totale=$game_price+$totale;
			 }
			 $unique_ci--;
			 $i++;
			}
			//supponendo che sia 1 punto ogni 10 euro
			$punti+=$totale % 10;
			$query="UPDATE USERS SET FIDELITY_POINT = FIDELITY_POINT + '$punti' WHERE ID_USER	= '$ute' ";
			$ris = ($conn->query($query));
			
			$query="SELECT ID_ORDER FROM ORDERS ORDER BY ID_ORDER LIMIT 1";
				$ris = ($conn->query($query));
					foreach($ris as $riga){
						$idordine=$riga['ID_ORDER'];
						
					}
			$query="SELECT * FROM USERS WHERE ID_USER= '$ute' ";
				$ris = ($conn->query($query));
					foreach($ris as $riga){
						$fidelity=$riga['FIDELITY_POINT'];
						$portafoglio=$riga['WALLET'];
						
					}
				
	   ?>
	     <h2>Ordine ricevuto!</h2>
		 <p>Id ordine: <?php echo $id_order; ?></p>
		 <p>Saldo punti: <?php echo $fidelity; ?> </p>
		 <p>Il tuo portafoglio: <?php echo $portafoglio; ?> </p>
	      <img src="img/check.png"></img>
		 <p> Riceverai il tuo ordine tra 48h</p>
	   
	   <?php 
	    unset($_SESSION['carrello']);
	     unset($array);
	     unset($result);?>
		<meta http-equiv="refresh" content="2;URL=http://www.nopaynogame.altervista.org/nopaynogame_">	
	   <?php } ?> 
	    	
	

       
			
			<!-- Modal senza accesso -->
			<div id="myModalregistrazione" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">OPS! Abbiamo notato che non hai effettuato l'accesso..</h4>
					
				  </div>
								
					
					<div id="accordion">
						  <div class="card">
							<div class="card-header" id="headingOne">
							  <h5 class="mb-0">
								<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  Accedi
								</button>
							  </h5>
							</div>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							  <div class="card-body">
							  <form>
								  <div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
									<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								  </div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
								  </div>
								  
								  <button type="submit" class="btn btn-primary">Submit</button>
								</form>
							  </div>
							</div>
						  </div>
						  <div class="card">
							<div class="card-header" id="headingTwo">
							  <h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								  Sei nuovo? Registrati!
								</button>
							  </h5>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							  <div class="card-body">
							  <form>
								  <div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputEmail4">Email</label>
									  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
									</div>
									<div class="form-group col-md-6">
									  <label for="inputPassword4">Password</label>
									  <input type="password" class="form-control" id="inputPassword" placeholder="Password">
									</div>
								  </div>
								  <div class="form-group">
									<label for="inputAddress">Username</label>
									<input type="text" class="form-control" id="inputUsername" placeholder="@Jonny">
								  </div>
								  <div class="form-group">
									<label for="inputAddress2">Address</label>
									<input type="text" class="form-control" id="inputAddress" placeholder="Apartment, studio, or floor">
								  </div>
								  <div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputCity">City</label>
									  <input type="text" class="form-control" id="inputCity">
									</div>
									<div class="form-group col-md-4">
									  <label for="inputState">State</label>
									  <select id="inputState" class="form-control">
										<option selected>Choose...</option>
										<option>...</option>
									  </select>
									</div>
									<div class="form-group col-md-2">
									  <label for="inputZip">Zip</label>
									  <input type="text" class="form-control" id="inputZip">
									</div>
								  </div>
								  <button type="submit" class="btn btn-primary">Sign in</button>
								</form>
							  </div>
							</div>
						  </div>
						 
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
				</div>

			  </div>
			</div>

				
        </div>
      </div>
    </div>

	
	  <!--MODAL MODIFICA DATI INDIRIZZO -->


			<!-- The Modal -->
			<div class="modal fade" id="myaddress">
			  <div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Modifica dati</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					<form method='post'>
					<label >Indirizzo:</label>
					<input type="text" class="form-control"  name='newindirizzo' value=''>
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
				    <button type="submit" class="btn btn-success" name="modifica_indirizzo" >Ok</button></form>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>

				</div>
			  </div>
			</div>
			
				<!-- The Modal -->
			<div class="modal fade" id="myname">
			  <div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Modifica dati</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <form method='post'>
					<label >Nome:</label>
					<input type="text" name='newnome' class="form-control" value="">
					
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
				    <button type="submit" class="btn btn-success" name="modifica_nome" >Ok</button></form>

					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>

				</div>
			  </div>
			</div>
			
			
				<!-- The Modal -->
			<div class="modal fade" id="mysurname">
			  <div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Modifica dati</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					 <form method='post'>
					<label>Cognome:</label>
					<input type="text" name='newcognome' class="form-control" value=''>
					
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
				   <button type="submit" name="modifica_cognome" class="btn btn-success">Ok</button></form>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>

				</div>
			  </div>
			</div>
			
		
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<?php include 'script.php'; ?>
		<script type="text/javascript">
       int reply_click(clicked_id)
		{
			return clicked_id;
		}
		
	</script>
  
  </body>

</html>



