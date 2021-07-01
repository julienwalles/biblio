<?php 
include 'request.php';

$conn = pdo_connect_mysql();

if(isset($_POST['createAdh'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $NbLivreEmprunte = 0;

    $query = "INSERT INTO adherent (nom, prenom, NbLivreEmprunte) VALUES(:nom, :prenom, :NbLivreEmprunte)";
    $stmt = $conn->prepare($query); 
    $stmt->execute(array(":nom"=>$nom, ":prenom"=>$prenom, ":NbLivreEmprunte"=>$NbLivreEmprunte));


if($stmt) {
    echo '<script type="text/javascript">alert("Nouvel adhérent ajouté");
              </script>';

              header('location: adh_read.php');
    }	
}

?>

<?php echo template_index() ?>

<h3>Créer un nouvel adhérent</h3>

<div class="container">
	<form method="post" action="#"class="row g-3 m-auto">
		<div class="col-2">
			<label for="exampleFormControlInput1" class="form-label">Lastname</label>
			<input type="text" class="form-control" name="nom" id="exampleFormControlInput1" pattern="[A-Z]{4,8}" placeholder="Nom">
		</div>

		<br>

		<div class="col-2">
			<label for="exampleFormControlInput2" class="form-label">firstname</label>
			<input type="text" class="form-control" name="prenom" id="exampleFormControlInput2" pattern="[a-z]{4,8}" placeholder="Prenom">
		</div>

		<br>

		<div class="col-4">
			<input type="submit" name="createAdh" value="Créer" class="btn btn-primary">
			<a class="btn btn-primary" href="adh_read.php" role="button">Retour</a>
		</div>
	</form>
</div>

<?php echo template_footer(); ?>