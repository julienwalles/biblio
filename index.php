<?php
require 'request.php';
$conn = pdo_connect_mysql();


// request to verify login and password
if(isset($_POST['verify'])) {

	$login = $_POST['login'];
	$password = $_POST['password'];

	$query = 'SELECT * FROM admin WHERE (login = :login)';

/* Values array for PDO. */
$values = [':login' => $login];

/* Execute the query */
try
{
  $res = $conn->prepare($query);
  $res->execute($values);
}
catch (PDOException $e)
{
  /* Query error. */
  echo 'Query error.';
  die();
}

$row = $res->fetch(PDO::FETCH_ASSOC);

	$isPasswordCorrect = password_verify($password, $row['password']);

	if($isPasswordCorrect) {

		// on la démarre :)
		session_start ();
		// on enregistre les paramètres de notre visiteur comme variables de session ($login et $password) 
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['password'] = $_POST['password'];

		header('location: biblio.php');	
	  }
	  else
	  {
		  echo '<script type="text/javascript">alert("votre login ou mot de passe est incorrect!");
          </script>';
	
	  }
	}
  ?>


<?php echo template_index() ?>

<br>
<br>
<br>
<br>


<div class="container ">
	<form method="post" action='#' class=" row g-5">
		<div class="mb-3 row">
			<label for="inputLogin" class="col-5 col-form-label">Login</label>
			<div class="col-6">
			<input type="text" class="form-control" name="login">
			</div>
		</div>

		<br>

		<div class="mb-3 row">
			<label for="inputPassword" class="col-5 col-form-label">Password</label>
			<div class="col-6">
			<input type="password" class="form-control" name="password" id="inputPassword">
			</div>
		</div>

		<br>

		<div class="mb-6">
			<div class="btnConn col-6">
			<input class="btn btn-outline-primary" type="submit" name="verify"  value="Se connecter">
			<a type="button" href="./new_user.php" class="btn btn-primary" rôle="button">Créer un nouvel utilisateur</a>
			<a type="button" href="http://localhost/phpmyadmin/index.php?route=/sql&server=1&db=biblio&table=admin&pos=0" class="btn btn-warning" rôle="button">Accéder à la table admin</a>
			</div>
		</div>
	</form>
</div>




<?php echo template_footer(); ?>