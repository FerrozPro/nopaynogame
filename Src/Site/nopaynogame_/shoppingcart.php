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
$query ="SELECT * FROM USERS WHERE EMAIL='$utente'";
$ris = ($conn->query($query));
foreach($ris as $riga){
  $surname = $riga ['SURNAME'];
  $name = $riga ['NAME'];
  $email= $riga ['EMAIL'];
  $username= $riga ['USERNAME'];
  $address= $riga ['ADDRESS'];
  $phone= $riga ['PHONE'];
  }
		?>
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
          <h1 class="mt-5">Shopping cart</h1>
          <p class="lead">Hi <?php if(!isset($_SESSION['user'])){ echo "Utente Sconosciuto"; } else {echo $name;}?> this is your shopping cart</p>
       <!--Tabella prodotti-->
	   
	   <?php if(($step2==0 && $step3==0 && $step4==0 & $step5==0) || $back==1){ ?>
	    <div class="progress">
  <div class="progress-bar progress-bar-striped" style="width:20%"></div>
</div>
	   
		<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin">Product 1</h4>
										<p>Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
							</td>
							<td data-th="Price">$1.99</td>
							<td data-th="Quantity">
								<input type="number" class="form-control text-center" value="1">
							</td>
							<td data-th="Subtotal" class="text-center">1.99</td>
							<td class="actions" data-th="">
								<button class="btn btn-info btn-sm"><i class="material-icons">autorenew</i></button>
								<button class="btn btn-danger btn-sm"><i class="material-icons">delete_forever</i></button>								
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total 1.99</strong></td>
						</tr>
						<tr>
							<td><a href="http://nopaynogame.altervista.org/nopaynogame_/gamelist.php?cp=cat&tipo_ricerca=catalogo" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
							<?php if(!isset($_SESSION['user'])) echo " <td><button type='submit' name='buttoncheck' class='btn btn-sucess btn-md' data-toggle='modal' data-target='#myModalregistrazione'>Checkout con registrazione</button></a></td>" ;
							else echo" <form method=post><td><button type='submit' class='btn btn-success btn-md' name='buttoncheck' >Checkout</button></td></form>"; ?>
						</tr>
					</tfoot>
				</table>
	   <?php }else if($step2==1 && $step3==0 && $step4==0 & $step5==0){ ?>
	   <div class="progress">
		<div class="progress-bar progress-bar-striped" style="width:40%"></div>
		</div>
	    Il tuo indirizzo:
	     <table class="table">
			  <thead>
				<tr>
				  <th scope="col">Nome</th>
				  <th scope="col">Cognome</th>
				  <th scope="col">Indirizzo di spedizione</th>
				  <th scope="col"></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row"><?php echo $name; ?></th>
				  <td><?php echo $surname; ?></td>
				  <td><?php echo $address; ?></td>
				  <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Modifica</button></td>
				</tr>
				
			  </tbody>
			</table>
			<form method='post'>
			<button type='submit' class='btn btn-warning btn-md' name='back'>Torna indietro</button>
			<button type='submit' class='btn btn-success btn-md' name='buttonaddress'>Procedi al pagamento</button>
			
			</form>
	   
	   <?php }else if($step2==0 && $step3==1 && $step4==0 & $step5==0){ ?>
	   <div class="progress">
		<div class="progress-bar progress-bar-striped" style="width:60%"></div>
		</div>
	      Metodo di pagamento:
	     <table class="table">
			  <thead>
				<tr>
				  <th scope="col">Metodo</th>
				  <th scope="col">First</th>
				  
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">1</th>
				  <td><label>
					  <input type="radio" name="fb" value="small" />
					  <img src="fb1.jpg">
					</label></td>
				  
				</tr>
				<tr>
				  <th scope="row">2</th>
				 <td><label>
					  <input type="radio" name="fb" value="small" />
					  <img src="fb1.jpg">
					</label></td>
				  
				</tr>
				<tr>
				  <th scope="row">3</th>
				  <td><label>
					  <input type="radio" name="fb" value="small" />
					  <img src="fb1.jpg">
					</label></td>
				  
				</tr>
			  </tbody>
			</table>
			<form method='post'>
               <button type='submit' class='btn btn-warning btn-md' name='buttoncheck'>Torna indietro</button>
				<button type='submit' class='btn btn-success btn-md' name='buttonpay'>Ultimo step!</button>
				
			</form>
	   
	   <?php }else if($step2==0 && $step3==0 && $step4==1 & $step5==0){ ?>
	   <div class="progress">
		<div class="progress-bar progress-bar-striped" style="width:100%"></div>
	   </div>
	    
	      Riepilogo:
	     <table class="table">
			  <thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">First</th>
				  <th scope="col">Last</th>
				  <th scope="col">Handle</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">1</th>
				  <td>Mark</td>
				  <td>Otto</td>
				  <td>@mdo</td>
				</tr>
				<tr>
				  <th scope="row">2</th>
				  <td>Jacob</td>
				  <td>Thornton</td>
				  <td>@fat</td>
				</tr>
				<tr>
				  <th scope="row">3</th>
				  <td>Larry</td>
				  <td>the Bird</td>
				  <td>@twitter</td>
				</tr>
			  </tbody>
			</table>
			
			<form method='post'>
			<button type='submit' class='btn btn-warning btn-md' name='buttonaddress'>Torna indietro</button>
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
			<div class="modal fade" id="myModal">
			  <div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Modal Heading</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					<label >Name:</label>
					<input type="text" class="form-control" value= <?php echo $name; ?>>
					<label>Surname:</label>
					<input type="text" class="form-control"  value= <?php echo $surname; ?>>
					<label >Indirizzo:</label>
					<input type="text" class="form-control"  value= <?php echo $address; ?>>
					
					
					
					
				  </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>

				</div>
			  </div>
			</div>
			
			
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<?php include 'script.php'; ?>
  </body>

</html>