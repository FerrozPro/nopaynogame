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
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Account</title>

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
          <h1 class="mt-5">My account</h1>
          <p class="lead">Hi <?php echo $name; ?> this is your personal account!</p>
		  <a href="javascript:;" class="uploadcontainer" onClick="javascript:setnewpicidvalue('1');">
			<img class="rounded-circle img-fluid d-block mx-auto" style="margin-bottom:10px;" src="http://placehold.it/200x200" alt="">
		  </a>
		  <input class="imageselectinput" id="imageuploadform1" type="file" name="picture" style='display:none;' />
		 </div>
		 
		 <div class="col-12 .col-md-4">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Information</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Orders</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
					  </li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					   
				  <table class="table table-striped">
				  Information:
				  <thead>
					<tr>
					
					</tr>
				  </thead>
				  <tbody>
					<tr >
					<th> <i class="material-icons">account_circle</i> </th>
					  <th scope="row">Name</th>
					  <td><?php echo $name;  ?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$name"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">face</i></th>
					  <th scope="row">Surname</th>
					  <td><?php echo $surname;?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$surname"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">face</i></th>
					  <th scope="row">Username</th>
					  <td><?php echo $username; ?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$username"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">fingerprint</i></th>
					  <th scope="row">Password</th>
					  <td>******</td>
					   <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$modal"><i class="material-icons">&#xe418;</i></button>
					  </td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">home</i></th>
					  <th scope="row">Shipping address</th>
					  <td><?php echo $address;  ?></td>
					 <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$address"><i class="material-icons">&#xe418;</i></button>
					  </td>
					 
					</tr>
					<tr>
					<th><i class="material-icons">phone</i></th>
					  <th scope="row">Phone</th>
					  <td><?php echo $phone;?></td>
					  <td>
						<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#$phone"><i class="material-icons">&#xe418;</i></button>
					  </td>
					 
					</tr>
					<tr>
					<th><i class="material-icons">shopping_cart</i></th>
					  <th scope="row">Orders</th>
					  <td>Total : count</td>
					  <td><a href="#"><i class="material-icons">arrow_forward</i></a></td>
					 
					</tr>
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
					  <form>
						<div class="form-group row">
						<label for="inputSpecifica" class="col-sm-2 col-form-label"></label>
						 <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
							<option selected>Specifica il tipo di problema...</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						  </select>
						  </label>
						 </div>
						 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						  <div class="col-sm-10">
							<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
						  </div>
						  </div>
						
						<div class="form-group row">
						  <label for="inputText" class="col-sm-2 col-form-label">Text</label>
						  <div class="col-sm-10">
							<textarea rows="4" cols="125"></textarea>
						  </div>
						</div>
						<fieldset class="form-group row">
						  <legend class="col-form-legend col-sm-2">More information</legend>
						  <div class="col-sm-10">
							<div class="form-check">
							  <label class="form-check-label">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
								Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
							<div class="form-check">
							  <label class="form-check-label">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
								Option two can be something else and selecting it will deselect option one
							  </label>
							</div>
							<div class="form-check disabled">
							  <label class="form-check-label">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
								Option three is disabled
							  </label>
							</div>
						  </div>
						</fieldset>
					
						<div class="form-group row">
						  <div class="offset-sm-2 col-sm-10">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</div>
					  </form>
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
				  <input class="form-control" type=text >
				  <button type="button" class="btn btn-warning">Modifica</button>
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
				   <input class="form-control" type=text >
				   <button type="button" class="btn btn-warning">Modifica</button>
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
				  <input class="form-control" type=text >
				  <button type="button" class="btn btn-warning">Modifica</button>
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
				   <input class="form-control" type=text >
				   <button type="button" class="btn btn-warning">Modifica</button>
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
				   <input class="form-control" type=text value=<?php echo $address; ?>>
				   <button type="button" class="btn btn-warning">Modifica</button>
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
				   <input class="form-control" type=text value=<?php echo $username; ?>>
				   <button type="button" class="btn btn-warning">Modifica</button>
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
