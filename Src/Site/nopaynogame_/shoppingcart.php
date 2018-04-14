<!doctype html>
<html lang="en">

<?php
session_start();

?>
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
          <p class="lead">Hi <?php if(!isset($_SESSION['user'])){ echo "Utente Sconosciuto"; } else {echo "Utente loggato";}?> this is your shopping cart</p>
       <!--Tabella prodotti-->
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
								<button class="btn btn-info btn-sm"><i class="material-icons">refresh</i></button>
								<button class="btn btn-danger btn-sm"><i class="material-icons">cancel</i></button>								
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total 1.99</strong></td>
						</tr>
						<tr>
							<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
							<?php if(!isset($_SESSION['user'])) echo " <td><button type='button' class='btn btn-sucess btn-md' data-toggle='modal' data-target='#myModalregistrazione'>Checkout con registrazione</button></a></td>" ;
							else echo" <td><button type='button' class='btn btn-success btn-md' data-toggle='modal' data-target='#myModal'>Checkout</button></td>"; ?>
						</tr>
					</tfoot>
				</table>
				
				
	


			<!-- Modal con accesso -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				  </div>
				  <div class="modal-body">
					<p>ciao.</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
			</div>
			
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>



