<!doctype html>
<html lang="en">

<?php
session_start();
require 'connection.php';
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
		
		
$utente=$_SESSION['user'];
$query ="SELECT * FROM USERS WHERE USERNAME='$utente' || EMAIL='$utente'";
$ris = ($conn->query($query));
foreach($ris as $riga){
  $surname = $riga ['SURNAME'];
  $name = $riga ['NAME'];
  $email= $riga ['EMAIL'];
  $username= $riga ['USERNAME'];
  $address= $riga ['ADDRESS'];
  $phone= $riga ['PHONE'];
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
?>
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>NoPayNoGame</title>
  </head>
  
  <header>
  <?php	include 'header.php'; ?>
  </header>

  <body>

    <!-- Navigation -->
   
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Carrello</h1>
          <p class="lead">Ciao <?php if(!isset($_SESSION['user'])){ echo "Utente Sconosciuto"; } else {echo $name;}?> questo è il tuo carrello</p>
       <!--Tabella prodotti-->
	   
	   <?php if(($step2==0 && $step3==0 && $step4==0 & $step5==0) || $back==1){ ?>
	   <?php if(!isset($_SESSION['carrello'])){?>
	    
    				
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
					$max=count($_SESSION['carrello']);
					
					for($i=0;$i<$max;$i++){
						$array[$i]=1;
					}
					print_r($_SESSION['carrello']);
					for($i=0;$i<$max;$i++){
						for($j=i+2;$j<$max;$j++){
							
							if($_SESSION['carrello'][$i] == $_SESSION['carrello'][$j] ){
								$array[$i]=$array[$i]+1;
								//unset($_SESSION['carrello'][$j]);
							}
							
							else{
								echo 'no';
								$array[$i]=$array[$i]+0;
							}
						}
					}
		
					$i=0;
					$result = array_unique($_SESSION['carrello']);
					$max=count($result);
					while($max!=0 && $array[$i]!=0){ 
							$gioco=$result[$i];
							$query ="SELECT *,count(*) AS quantita_aggiunta FROM GAMES WHERE COD_GAME='$gioco'";
							$ris = ($conn->query($query));  
							foreach($ris as $riga){
								
							
					//}?>
					<tbody>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src=<?php echo $riga['IMAGE']; ?> alt=<?php echo $riga['TITLE']; ?> class="img-responsive" style="width:200px; heigth:200px;"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"><?php echo $riga['TITLE']; ?></h4>
										<p><?php echo $riga['DESCRIPTION']; ?></p>
									</div>
								</div>
							</td>
							<td data-th="Price"><?php echo $riga['PRICE']; ?></td>
							<td data-th="Quantity">
								<input type="number" class="form-control text-center" value=<?php echo $array[$i]; ?>>
							</td>
							<td data-th="Subtotal" class="text-center"><?php $riga['PRICE']; ?></td>
							<td class="actions" data-th="">
								<form method='get'><button type='submit' class="btn btn-info btn-sm" name=refresh value=<?php echo $riga['COD_GAME'];?>><i class="material-icons">autorenew</i></button>
								<button type='submit' class="btn btn-danger btn-sm" name=delete value=<?php echo $riga['COD_GAME'];?>><i class="material-icons">delete_forever</i></button></form>								
							</td>
						</tr>
					</tbody>
					
					<?php }
						$i++;
						$max--; 
						$total=$total+($riga['PRICE']*$array[$i]);
						
					}
					
					
						  /* $max=count($result);
							if(isset($_GET['delete'])){
								for($i=0;$i<$max;$i++){
									print_r($result[$i]);
									if($result[$i] == $_GET['delete']){
										$array[$i]=0;
									}
								
								}
							}*/
							
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
	   <?php }else if($step2==1 && $step3==0 && $step4==0 & $step5==0){ ?>
	   <div class="progress">
		<div class="progress-bar progress-bar-striped" style="width:50%"></div>
		</div>
	    Il tuo indirizzo:
	     <table class="table">
			  <thead>
				<tr>
				  <th scope="col">Nome: <?php echo $name; ?></th>
				  <th scope="col"></th>
				  <th scope="col"></th>
				  <th scope="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myname">Modifica</button></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">Cognome: <?php echo $surname; ?></th>
				  <td></td>
				  <td></td>
				  <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mysurname">Modifica</button></td>
				</tr>
				<tr>
				  <th scope="row">Indirizzo: <?php echo $address; ?></th>
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
		  <div class="col-6 col-md-4">
		  
			 Riepilogo:
		  <p>Prodotti</p>
	       <table class="table">
			  <thead>
				<tr>
				  <th scope="col">Codice gioco</th>
				  <th scope="col">Titolo</th>
				  <th scope="col">Prezzo</th>
				  <th scope="col">Quantità</th>
				</tr>
			  </thead>
			  <tbody>
			  <?PHP 
			  $i=0;
			  $result = array_unique($_SESSION['carrello']);
			  $max=count($result);
			  while($max!=0){ 
     		  $gioco=$result[$i];
			  $query ="SELECT *,count(*) AS quantita_aggiunta FROM GAMES WHERE COD_GAME='$gioco'"; 
			 
				$ris = ($conn->query($query));  
				foreach($ris as $riga){
			    ?>
				<tr>
				  <th scope="row"><?php echo $riga['COD_GAME']; ?></th>
				  <td><?php echo $riga['TITLE']; ?></td>
				  <td><?php echo $riga['PRICE']; ?></td>
				  <td><?php $quantità ?></td>
				</tr>
				<?php }
					$i++;
					$max--;
			     }				
				?>
			  </tbody>
			</table>
		  </div>
		  
		  <div class="col-6 col-md-4">
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
		  <div class="col-6 col-md-4">
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
				  <td><label>
					  <input type="radio" name="bonifico" value="small" />
					  <img src="img/bonifico.png" style='width:20%; heigth:20%;'>
					</label></td>
				  
				</tr>
				<tr>
				  <th scope="row">PayPal</th>
				 <td><label>
					  <input type="radio" name="paypal" value="small" />
					  <img src="img/paypal.png" style='width:20%; heigth:20%;'>
					</label></td>
				  
				</tr>
				<tr>
				  <th scope="row">Contrassegno</th>
				  <td><label>
					  <input type="radio" name="contrassegno" value="small" />
					  <img src="img/contrassegno.png" style='width:20%; heigth:20%;'>
					</label></td>
				  
				</tr>
			  </tbody>
			</table>
		  </div>
		</div> 
			<form method='post'>
			<button type='submit' class='btn btn-warning btn-md' name='buttoncheck'>Torna indietro</button>
			<button type='submit' class='btn btn-success btn-md' name='confirm'>Invia ordine</button>
			
			</form>
		    
		  </div>
		  
	   
	   <?php }else if($step2==0 && $step3==0 && $step4==0 & $step5==1){ ?>
	     <h2>Ordine ricevuto!</h2>
		 <p>Id ordine: $idordine</p>
		 <p>Saldo punti: $punti </p>
	      <img src="img/check.png"></img>
		 <p> Riceverai il tuo ordine tra 48h</p>
	   
	   <?php }?>
				
	

       
			
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
					<input type="text" class="form-control" value=''>
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
				    <button type="submit" class="btn btn-success">Ok</button></form>
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
					<input type="text" class="form-control" value="">
					
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
				    <button type="submit" class="btn btn-success">Ok</button></form>

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
					<h4 class="modal-title"Modifica dati</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					 <form method='post'>
					<label>Cognome:</label>
					<input type="text" class="form-control" value=''>
					
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
				   <button type="submit" name='modifica_cognome' class="btn btn-success">Ok</button></form>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>

				</div>
			  </div>
			</div>
			
			
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<?php include 'script.php'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script type="text/javascript">
       int reply_click(clicked_id)
		{
			return clicked_id;
		}
	</script>
  
  </body>

</html>



