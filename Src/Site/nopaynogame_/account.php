<!DOCTYPE html>
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
          <p class="lead">Hi Bob this is your personal account!</p>
		  <img class="rounded-circle img-fluid d-block mx-auto" style="margin-bottom:10px;" src="http://placehold.it/200x200" alt="">
		 
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
					  <td>Mark</td>
					  <td><i class="material-icons">&#xe418;</i></td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">face</i></th>
					  <th scope="row">Surname</th>
					  <td>Jacob</td>
					   <td><i class="material-icons">&#xe418;</i></td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">face</i></th>
					  <th scope="row">Username</th>
					  <td>Larry</td>
					   <td><i class="material-icons">&#xe418;</i></td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">fingerprint</i></th>
					  <th scope="row">Password</th>
					  <td>******</td>
					   <td><i class="material-icons">&#xe418;</i></td>
					  
					</tr>
					<tr>
					<th><i class="material-icons">home</i></th>
					  <th scope="row">Shipping address</th>
					  <td>Via riviera 18 giugno n 117 meolo 30020 VE</td>
					  <td><i class="material-icons">&#xe418;</i></td>
					 
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
							<th>1</th>
							  <td>12/05/2018</th>
							  <td>Mark</td>
							  <td>12</td>
							  <td><i class="material-icons">favorite_border</i></td>
							  
							</tr>
							<tr>
							<th>2</th>
							  <td>12/05/2018</th>
							  <td>Jacob</td>
							   <td>12</td>
							   <td><i class="material-icons">favorite_border</i></td>
							  
							</tr>
							<tr>
							<th>3</th>
							  <td>12/05/2018</th>
							  <td>Larry</td>
							   <td>12</td>
							   <td><i class="material-icons">favorite_border</i></td>
							  
							</tr>
							<tr>
							<th>4</th>
							  <td>12/05/2018</th>
							  <td>******</td>
							   <td>12</td>
							  <td><i class="material-icons">favorite_border</i></td>
							</tr>
							<tr>
							<th>5</th>
							  <td>12/05/2018</th>
							  <td>Via riviera 18 giugno n 117 meolo 30020 VE</td>
							  <td>12</td>
							  <td><i class="material-icons">favorite_border</i></td>
							 
							</tr>
							<tr>
							<th>6</th>
							  <td>12/05/2018</th>
							  <td>Total : count</td>
							  <td>12</td>
							  <td><i class="material-icons">favorite_border</i></td>
							 
							</tr>
						  </tbody>
						</table>
			
				  
				  
				  
				  </div>
				  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
				</div>
			</div> 
		
		  </div>
      </div>
    

    <!-- Bootstrap core JavaScript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

</html>
