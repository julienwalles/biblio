<?php
require 'request.php';
$conn = pdo_connect_mysql();

// request to create a user
if(isset($_POST['create'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$login = $_POST['login'];

	//aumente la valeur de coût
	$options = ['cost' => 12];
	//hachage du password
	$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);
	
	
$query = "INSERT INTO admin (firstname, lastname, password, login) VALUES(:firstname, :lastname, :password, :login)";
$stmt = $conn->prepare($query); 
$stmt->execute(array(":firstname"=>$firstname,":lastname"=>$lastname, ":password"=>$hashed_password, ":login"=>$login));

if($stmt) {
	echo '<script type="text/javascript">alert("Nouvel utilisateur ajouté");
	  		</script>';
}
}

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

var_dump($row['password']);
var_dump($password);

	$isPasswordCorrect = password_verify($password, $row['password']);
var_dump($isPasswordCorrect);

	if($isPasswordCorrect) {

		// on la démarre :)
		session_start ();
		// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) 
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['password'] = $_POST['password'];

		header('location: biblio.php');	
	  }
	  else
	  {
		  echo 'Votre pseudo ou mot de passe est incorrect';
		  header('location:aboutus.php');
	  }
	}
  ?>



<?php echo template_header('Home'); ?>

<br>
<br>
<br>
<br>

<form method="post" action='#' class="row g-5">
<div class="mb-6 row">
    <label for="inputLogin" class="col-5 col-form-label">Login</label>
    <div class="col-6">
      <input type="text" class="form-control" name="login">
    </div>
  </div>
	<br>
  <div class="mb-6 row">
    <label for="inputPassword" class="col-5 col-form-label">Password</label>
    <div class="col-6">
      <input type="password" class="form-control" name="password" id="inputPassword">
    </div>
  </div>
  <br>
  <div class="mb-6 row">
    <div class="col-6">
	<input class="btn btn-outline-primary" type="submit" name="verify" value="Se connecter">
	<a type="button" href="./new_user.php" class="btn btn-secondary" rôle="button">Créer un nouvel utilisateur</a>

    </div>
  </div>
</form>

