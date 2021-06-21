<?php
require 'request.php';
$conn = pdo_connect_mysql();

if(isset($_POST['create'])) {

	
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$login = $_POST['login'];

	$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	
$query = "INSERT INTO admin (firstname, lastname, password, login) VALUES(:firstname, :lastname, :password, :login)";
$stmt = $conn->prepare($query); 
$stmt->execute(array(":firstname"=>$firstname,":lastname"=>$lastname, ":password"=>$hashed_password, ":login"=>$login));
}


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
	  
		echo '<script type="text/javascript">alert("Connexion réussie");
			window.location.href = "livres_read.php";
	  		</script>';
		
	  }
	  else
	  {
		  echo 'Votre pseudo ou mot de passe est incorrect';
		  header('location:aboutus.php');
	  }
/* If there is a result, check if the password matches using password_verify(). */
// if (is_array($row))
// {
//   if (password_verify($password, $row['password']))
//   {
    
//   }

 
	// $req = $conn->prepare("SELECT * FROM admin WHERE login = :login");
	// $req->execute(array(':login'=>$login, ':password'=>$password ));
	// $res = $req->fetch();

	// // var_dump($res);
	// var_dump($res['password']);
	// var_dump($password);
	// $isPasswordCorrect = password_verify($password, $res['password']);

	// var_dump($isPasswordCorrect);
	// if($isPasswordCorrect) {
	  
	// 	echo '<script type="text/javascript">alert("book created");
	// 		window.location.href = "livres_read.php";
	//   		</script>';
		
	//   }
	//   else
	//   {
	// 	  echo 'Votre pseudo ou mot de passe est incorrect';
	// 	  header('location:aboutus.php');
	//   }
	}
  ?>


<?php echo template_header('Home'); ?>

<div class="content">
	<h1>Accueil</h1>
	<p>BIENVENUE SUR LE SITE DE LA BIBLIOTHEQUE !</p>
</div>

<form method="post" action="#"class="row g-3">
	<div class="col-3">
		<label for="exampleFormControlInput1" class="form-label">firstname</label>
		<input type="text" class="form-control" name="firstname" id="exampleFormControlInput1" placeholder="firstname">
	</div>
	<br>
	<div class="col-3">
		<label for="exampleFormControlInput1" class="form-label">lastname</label>
		<input type="text" class="form-control" name="lastname" id="exampleFormControlInput1" placeholder="lastname">
	</div>
	<br>
	<div class="col-3">
	<label for="exampleFormControlInput1" class="form-label">login</label>
		<input type="text" class="form-control" name="login" id="exampleFormControlInput1" placeholder="login">
    </div>
	<br>
	<div class="col-3">
	<label for="exampleFormControlInput1" class="form-label">password</label>
		<input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="password">
    </div>

  <div class="col-3">
 <input type="submit" name="create" value="Sign in" class="buttom">
</div>
</form>

<br>
<br>

<form method="post" action='#' class="row g-3">
<div class="col-3">
	<label for="exampleFormControlInput1" class="form-label">login</label>
		<input type="text" class="form-control" name="login" id="exampleFormControlInput1" placeholder="login">
    </div>
	<div class="col-3">
	<label for="exampleFormControlInput1" class="form-label">password</label>
		<input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="password">
    </div>
	<br>
  <div class="col-3">
 <input type="submit" name="verify" value="Sign up" class="buttom">
</div>
</form>

<?php echo template_footer(); ?>