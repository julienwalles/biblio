<?php
require 'request.php';
$conn = pdo_connect_mysql();

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
?>


<div class="container">
<form method="post" action="#"class="row g-3 m-auto">
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
 <input type="submit" name="create" value="Créer" class="buttom">
 <a class="btn btn-primary" href="./index.php" role="button">Retour</a>
</div>
</form>
</div>