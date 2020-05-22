<?php
session_start();
include 'helper.php';
if(isset($_SESSION['usn']))
{
    header("Location:home.php");
}

if(isset($_SESSION['t_usn']))
{
	      if($_SESSION["role"]=="Teacher")
            {
              header("Location:teacher.php");
            }
          if($_SESSION["role"]=="Admin")
            {
              header("location:admin.php");
            }
}

if(isset($_POST['submit']))
{

$password=$_POST['password'];

$email=$_POST['email'];

login($email,$password);

}



if(isset($_GET['errorStatus']))
{
$errorStatus = $_GET['errorStatus'];
$errorMessage = $_GET['errorMessage'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/pulse/bootstrap.min.css" rel="stylesheet" integrity="sha384-FnujoHKLiA0lyWE/5kNhcd8lfMILbUAZFAT89u11OhZI7Gt135tk3bGYVBC2xmJ5" crossorigin="anonymous">
  
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body style="background-color: #a29bfe">
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="#">
   <svg class="bi bi-people" width="1.3em" height="1.3em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M17 16s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.995-.944v-.002zM9.022 15h7.956a.274.274 0 00.014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C15.688 12.629 14.718 12 13 12c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 00.022.004zm7.973.056v-.002zM13 9a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zm-7.064 4.28a5.873 5.873 0 00-1.23-.247A7.334 7.334 0 007 11c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 017 15c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM6.92 12c-1.668.02-2.615.64-3.16 1.276C3.163 13.97 3 14.739 3 15h3c0-1.045.323-2.086.92-3zM3.5 7.5a3 3 0 116 0 3 3 0 01-6 0zm3-2a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd"/>
</svg>
   Attendance panel
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card" style="margin-top: 130px">
				<div class="card-header">
					<h3>Login</h3>
					<?php
					if(isset($_GET['errorStatus']))
						{
							?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
  								<strong><?php echo $errorMessage;?>!</strong><?php echo $errorStatus;?>
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
   								<span aria-hidden="true">&times;</span>
  								</button>
								</div>
							<?php
						}
					?>
				</div>
				<div class="card-body">
					<form method="post">
  						<div class="form-group">
    						<label for="exampleInputEmail1">Email address</label>
    						<input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  						</div>
 						<div class="form-group">
    						<label for="exampleInputPassword1">Password</label>
    						<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  						</div>
  						<button type="submit" name="submit" class="btn-lg btn-primary btn-block">Submit</button>
  					</form>
  				</div>
			</div>
		</div>
		<div class="col-4"></div>
	</div>
</div>
</body>
</html>