<?php
require 'request.php';
$conn = pdo_connect_mysql();

// if(isset($_POST['create'])) {

	
	
// 	$firstname = $_POST['firstname'];
// 	$lastname = $_POST['lastname'];
// 	$password = $_POST['password'];
// 	$login = $_POST['login'];

// 	$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	
// $query = "INSERT INTO admin (firstname, lastname, password) VALUES(:firstname, :lastname, :password)";
// $stmt = $conn->prepare($query); 
// $stmt->execute(array(":firstname"=>$firstname,":lastname"=>$lastname, ":password"=>$hashed_password));
// }


if(isset($_POST['verify'])) {

	$login = $_POST['login'];
	$password = $_POST['password'];
 
	$req = $conn->prepare("SELECT * FROM admin");
	$req->execute(array(':login'=>$login, ':password'=>$password ));
	$res = $req->fetch();

	// var_dump($res);
	var_dump($res['password']);
	var_dump($password);
	$isPasswordCorrect = password_verify($password, $res['password']);

	var_dump($isPasswordCorrect);
	if($isPasswordCorrect) {
	  
		echo '<script type="text/javascript">alert("book created");
			window.location.href = "livres_read.php";
	  		</script>';
		
	  }
	//   else
	//   {
	// 	  echo 'Votre pseudo ou mot de passe est incorrect';
	// 	  header('location:aboutus.php');
	//   }
	// }
	}
  ?>


<?php echo template_header('Home'); ?>

<div class="content">
	<h1>Accueil</h1>
	<p>BIENVENUE SUR LE SITE DE LA BIBLIOTHEQUE !</p>
</div>

<!-- <form method="post" action="#">
	<div class="mb-3">
		<label for="exampleFormControlInput1" class="form-label">firstname</label>
		<input type="text" class="form-control" name="firstname" id="exampleFormControlInput1" placeholder="firstname">
	</div>
	<br>
	<div class="mb-3">
		<label for="exampleFormControlInput1" class="form-label">lastname</label>
		<input type="text" class="form-control" name="lastname" id="exampleFormControlInput1" placeholder="lastname">
	</div>
	<br>
	<div class="col-auto">
	<label for="exampleFormControlInput1" class="form-label">login</label>
		<input type="text" class="form-control" name="login" id="exampleFormControlInput1" placeholder="login">
    </div>
	<br>
	<div class="col-auto">
	<label for="exampleFormControlInput1" class="form-label">password</label>
		<input type="text" class="form-control" name="password" id="exampleFormControlInput1" placeholder="password">
    </div>

  <div class="row">
 <input type="submit" name="create" value="Create" class="buttom">
</div>
</form> -->

<br>
<br>

<form method="post">
<div class="col-auto">
	<label for="exampleFormControlInput1" class="form-label">login</label>
		<input type="text" class="form-control" name="login" id="exampleFormControlInput1" placeholder="login">
    </div>
	<div class="col-auto">
	<label for="exampleFormControlInput1" class="form-label">password</label>
		<input type="text" class="form-control" name="password" id="exampleFormControlInput1" placeholder="password">
    </div>

  <div class="row">
 <input type="submit" name="verify" value="Create" class="buttom">
</div>
</form>

<?php echo template_footer(); ?>