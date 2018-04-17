<!DOCTYPE html>
<?php
session_start();
require 'connection.php';
if(!isset($_SESSION['user'])){ //se non è stato ancora fatto un login
	header("Location: index.php"); //torna all'index
}
$utente=$_SESSION['user'];
$query ="SELECT * FROM USERS WHERE EMAIL='$utente'";
$ris = ($conn->query($query));
foreach($ris as $riga){
  $id_utente= $riga ['ID_USER'];
  $surname = $riga ['SURNAME'];
  $name = $riga ['NAME'];
  $email= $riga ['EMAIL'];
  $username= $riga ['USERNAME'];
  $address= $riga ['ADDRESS'];
  $phone= $riga ['PHONE'];
  }
  
  
 //QUERY MODIFICA DATI//
 $newcognome=$_POST['newsurname'];
 $newname = $_POST['newname'];
 $newusername=$_POST['newusername'];
 $newemail=$_POST['newemail'];
 $newaddress=$_POST['newaddress'];
 $newphone=$_POST['newphone'];
 $newpassword=$_POST['newpassword'];
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
	$query ="UPDATE USERS SET phone='$newphone' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
}else if(isset($_POST['modificapassword'])){
	$query ="UPDATE USERS SET password='$newpassword' WHERE USERNAME='$utente' || email='$utente'";
	$ris = ($conn->query($query));
	echo "<meta http-equiv='refresh' content='0'>";
	
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
	
    <!-- Custom styles for this template -->
  

	</head>
  <header>
  <?php	include 'header.php'; ?>
  </header>
  <body>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Il mio profilo</h1>
          <p class="lead">Ciao <?php echo $name; ?> questo è il tuo profilo personale!</p>
		 
		 </div>
		 
		 <div class="col-12 .col-md-4">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informazioni</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ordini Effettuati</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Review e Voti</a>
					  </li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					   
				  <table class="table table-striped">
				  <thead>
					<tr>
					
					</tr>
				  </thead>
				  <tbody>
					<tr >
					<th> <i class="material-icons">account_circle</i> </th>
					  <th scope="row">Nome:</th>
					  <td><?php echo $name;  ?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$name"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">face</i></th>
					  <th scope="row">Cosgnome:</th>
					  <td><?php echo $surname;?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$surname"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">face</i></th>
					  <th scope="row">Username:</th>
					  <td><?php echo $username; ?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$username"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">fingerprint</i></th>
					  <th scope="row">Password:</th>
					  <td>******</td>
					   <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$password"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">home</i></th>
					  <th scope="row">Indirizzo:</th>
					  <td><?php echo $address;  ?></td>
					 <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$address"><i class="material-icons">&#xe418;</i></button>
					  </td>
					 
					</tr>
					<tr>
					<th><i class="material-icons">phone</i></th>
					  <th scope="row">Telefono:</th>
					  <td><?php echo $phone;?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$phone"><i class="material-icons">&#xe418;</i></button>
					  </td>
					 
					</tr>
					<tr>
					<th><i class="material-icons">shopping_cart</i></th>
					  <th scope="row">Ordini</th>
					  <td>Total : count</td>
					  <td><a href="#"><i class="material-icons">arrow_forward</i></a></td>
					 
					</tr>
					<form method='get' action="delete_account.php">
					<tr>
 					<th><i class="material-icons"></i></th>
					  <th scope="row">Cancella Account</th>
					  <td></td>
					  <td><button type='submit' class="btn btn-danger" name='eliminaccount' value=<?php echo "$id_utente"; ?>>Elimina</button></td>
					  </tr>
					</form>
				  </tbody>
				</table>
				</div>
				  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				  
				  <?php //query per gli ordini//
				   $query ="SELECT * FROM ORDERS WHERE ID_USER='$id_utente'";
				   $ris = ($conn->query($query));
				   $ris->execute();
				   if($ris->rowCount() <= 0){
					echo "<center><H2>Non hai ancora effettuato un ordine :( </H2> <img src=img/sad.png style=' width:30%; heigth:30%'></center>";
				   }else{
					   foreach($ris as $riga){
				     
					?>
				  
				  
						 <table class="table table-striped">
						  <thead>
							<tr>
							  <td>Numero ordine</td>
							  <td>Data</td>
							  <td>N. Prodotti</td>
							  <td>Totale</td>
							  <td>Visualizza</td>
							</tr>
						  </thead>

						  <tbody>
							<tr >
							<th><?php echo $riga['ID_ORDER'];?></th>
							  <td><?php echo $riga['DATE_ORDER'];?></th>
							  <td><?php echo $conta_prodotti;?></td>
							  <td><?php echo $totale;?></td>
							  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $riga['ID_ORDER']; ?> ">
								  Launch demo modal
								</button>
							  <td><i class="material-icons">favorite_border</i></td>
							  
							</tr>
							
						  </tbody>
						</table>
			
				  
				   <?php } }?>
				  
				  </div>
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
							
							
							?>
					
					
					   <div class="accordion" id="accordion">
							  <div class="card">
								<div class="card-header" id="headingOne">
								  <h5 class="mb-0">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#<?php echo $idreview; ?>" aria-expanded="false" aria-controls="collapseOne">
									   Commento ( <?php echo $idreview; ?> )
									</button>
								  </h5>
								</div>
								<div id="<?php echo $idreview; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								  <div class="card-body">
								  <p><?php
								    for($i=0;$i<$stars;$i++){
										echo '★';
									}
								  ?></p>
								  <p><b>Commento:</b>
								  <?php echo $commento; ?></p>
								  </div>
								</div>
							  </div>
							 <?php 	}
							  }else echo 'Non hai ancora lasciato un commento';?>
							  
							 <!-- <div class="card">
								<div class="card-header" id="headingTwo">
								  <h5 class="mb-0">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									  Commento n^
									</button>
								  </h5>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								  <div class="card-body">
								  </div>
									Testo
								</div>
							  </div> -->
							  
							  </div>
							</div>
					</div>
				</div>
		  </div>
      </div>
    
	
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
				  <input class="form-control" type=text name="newpassword" >
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
				   <input class="form-control" type=text name="newphone" >
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
				   <button type="button" class="btn btn-warning" name="modificaindirizzo">Modifica</button>
				</form>
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer">
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				
			  </div>
			</div>
		  </div>
		  
		  <div class="modal fade" id="$username">
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
				   <input class="form-control" type=text name="newusername">
				   <button type="submit" class="btn btn-warning" name="modificausername">Modifica</button>
				 </form>
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer">
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				
			  </div>
			</div>
		  </div>
		  
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
