<!DOCTYPE html>

<?php
session_start();
include_once 'connection.php';
if(isset($_SESSION['user'])){
		header('Location: index.php');
}else{
	session_unset();
	session_destroy();
	session_start();
}

$registrati=$_POST['registrati'];
$accedi=$_POST['accedi'];
$registrato=0;
$first=1;
if(isset($accedi)){
	
	
/*QUERY PER L'ACCESSO*/	
$emaila = $_POST['inputEmailA'];
$passworda = MD5($_POST['inputPasswordA']);

$sql = "SELECT cod_role,id_user,name,surname FROM USERS WHERE PASSWORD='$passworda' && (EMAIL='$emaila' || USERNAME='$emaila') && FLAG_DELETED='N' ";
$preparata = $conn->prepare($sql);
$preparata->execute();


/*$ris= $preparata -> fetch();
foreach($ris as $riga){
	$delete=$riga['flag_deleted'];
	}
if($delete=='Y'){
	header('Location: riattiva.php');
}
*/
if($preparata->rowCount() > 0){	
	while($user = $preparata->fetch()){
		$_SESSION['role']=$user[0];
		$_SESSION['id']=$user[1];
		$_SESSION['name']=$user[2];
		$_SESSION['surname']=$user[3];
	}
	$_SESSION['user']=$emaila;
	
	header("Location: index.php");
}else{
	echo "<script> alert('Account non esistente , dati errati, account eliminato'); </script>";
} 	
}else if(isset($registrati)){
/*QUERY PER LA REGISTRAZIONE*/
	$name = $_POST['inputName'];
	$surname = $_POST['inputSurname'];
	$username = $_POST['inputUsername'];
	$address = $_POST['inputAddress'];
	$role=RL1;
	$phone = $_POST['inputPhone'];
	$email = $_POST['inputEmail'];
	$password = MD5($_POST['inputPassword']);
	
	$sql = "SELECT * FROM USERS WHERE EMAIL='$email' || USERNAME='$username'";
	$preparata = $conn->prepare($sql);
	$preparata->execute();
	if($preparata->rowCount() > 0){
		echo "<script>alert('Sei gia registrato!');</script>";
	}else{
		$query = $conn -> prepare("INSERT INTO USERS(name, surname, address, phone, username, password, cod_role,email)
									VALUES('$name','$surname','$address','$phone','$username','$password','$role','$email')");
		$query -> execute();
		if($query -> rowCount() > 0){ //se la registrazione è andata a buon fine
			//require ("email.php");
			$registrato=1;
			$first=0;	
		}
	}

}


?>
<html lang="en">
  <?php	include 'header.php'; ?>
  <body>
	<br>
			<?php if($registrato==1 || $first==1){ ?>
				<!-- Page Content -->
				<div class="container">
				<div class="row">
				 <?php if($first==1){ ?> <div class="col-sm-5 col-md-6"> <?php } else { ?>
				 <h2>Complimenti ti sei registrato! Ora effettua l'accesso con i tuoi dati </h2>
			 <div class="col-sm-12 col-md-12"> <?php } ?>
				 
				  <h3>Accedi:</h3>
				  <form method='post'>
				  <div class="form-group">
					<label for="exampleInputEmail1">Email o Username</label>
					<input type="text" class="form-control" name="inputEmailA" aria-describedby="emailHelp" placeholder="Enter email or your Username" required >
					<small id="emailHelp" class="form-text text-muted">Non condiviremo la tua email con nessuno.</small>
			  </div>
				  <div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" name="inputPasswordA" placeholder="Password" required>
				  </div>
				  <div class="form-group">
					<p><a data-toggle="modal" href="#myModalEmail">Hai dimenticato l'email?</a></p>
					<p><a data-toggle="modal" href="#myModalPassword">Hai imenticato password?</a></p>
					
					
				  </div>
				  <button type="submit" name='accedi' class="btn btn-primary">Accedi</button>
				</form>
				  
				  </div>
		<?php } ?>
				  <?php if($registrato==0 || $first==1){?>
				  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
					<h3>Registrati:</h3>
						<form method='post'>
						 <div class="form-row">
							<div class="form-group col-md-6">
							  <label for="inputName">Nome</label>
							  <input type="text" class="form-control" name="inputName" placeholder="Mario" required>
							</div>
							<div class="form-group col-md-6">
							  <label for="inputSurname">Cognome</label>
							  <input type="text" class="form-control" name="inputSurname" placeholder="Rossi" required>
						</div>
						  </div>
					  <div class="form-row">
							<div class="form-group col-md-6">
							  <label for="inputEmail">Email</label>
							  <input type="email" class="form-control" name="inputEmail" placeholder="Email" required>
							</div>
							<div class="form-group col-md-6">
							  <label for="inputPassword4">Password</label>
							  <input type="password" class="form-control" name="inputPassword" placeholder="Password" required>
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputUsername">Username</label>
							<input type="text" class="form-control" name="inputUsername" placeholder="MarioRossi" required>
						  </div>
						  <div class="form-group">
							<label for="inputAddress">Indirizzo</label>
							<input type="text" class="form-control" name="inputAddress" placeholder="1234 Main St" required>
						  </div>
						 
					  <div class="form-row">
							<div class="form-group col-md-6">
							  <label for="inputPhone">Telefono</label>
							  <input type="" class="form-control" name="inputPhone" placeholder="3294252886" required>
							</div>
							
						  </div>
						  <div class="form-group">
							
						  </div>
						  <button type="submit" name='registrati' class="btn btn-primary">Registrati</button>
						</form>
				  
				  
				  </div>
				</div>
				  <?php } ?>
				</div>
				
				
				  <!-- Modal -->
			  <div class="modal fade" id="myModalEmail" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Email</h4>
					</div>
					<div class="modal-body">
					  <form>
						  <div class="form-group">
							<label for="exampleInputEmail1">Email di appoggio</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
							<small id="emailHelp" class="form-text text-muted">invieremo un messaggio alla mail sopra riportata con la tua email.</small>
						  </div>
						  <div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						  </div>
						  
						  <button type="submit" class="btn btn-primary">Invia richiesta</button>
						</form>
					  
					  
					  
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
					</div>
				  </div>
				  
				</div>
			  </div>
				  <!-- Modal -->
			  <div class="modal fade" id="myModalPassword" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Password</h4>
					</div>
					<div class="modal-body">
					  <form>
						  <div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
							<small id="emailHelp" class="form-text text-muted">invieremo una password momentanea sulla tua email.</small>
						  </div>
						
						  <button type="submit" class="btn btn-primary">Invia richiesta</button>
						</form>
					 
				 
					 
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
					</div>
				  </div>
				  
				</div>
			  </div>
			  
			  
			</div>
	
    <!-- Bootstrap core JavaScript -->
    <?php include 'script.php'; ?>
  </body>

</html>
