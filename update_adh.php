<?php
include 'request.php';

$conn = pdo_connect_mysql();

$id = $_GET['id'];

//request GET adherent
$request = "SELECT * FROM adherent WHERE id = $id ";
$stmt_get = $conn->prepare($request);
$stmt_get->execute();
$rows = $stmt_get->fetchAll(PDO::FETCH_ASSOC);

// var_dump($rows);
// die();

if(isset($_POST['updateAdh'])) {

    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $NbLivreEmprunte = $_POST['NbLivreEmprunte'];
// update  request POST
$query = "UPDATE adherent SET nom=:nom, prenom=:prenom, NbLivreEmprunte=:NbLivreEmprunte WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt_exec = $stmt->execute(array("nom"=>$nom, "prenom"=>$prenom, "NbLivreEmprunte"=>$NbLivreEmprunte, "id"=>$id));

if($stmt_exec) {
	echo '<script type="text/javascript">alert("Modification effectuée");
			window.location.href = "adh_read.php";
		  </script>';

	exit();
}
	else {
		echo '<script>alert("Modification non effectuée")</script';
	}
}

?>


<?php echo template_index() ?>

<h3>Modifier un adhérent</h3>

<div class="container">
	<form method="post" action="#"class="row g-3 m-auto">
		<div class="col-2">
			<label for="exampleFormControlInput1" class="form-label">Nom</label>
            <?php
        foreach ($rows as $row) {
?>
			<input type="text" class="form-control" name="nom" id="exampleFormControlInput1" pattern="[A-Z]{4,8}" placeholder="Nom"  required value="<?php echo $row["nom"]; ?>">
            <?php
        }
?>
		</div>

		<br>

		<div class="col-2">
			<label for="exampleFormControlInput2" class="form-label">Prenom</label>
            <?php
        foreach ($rows as $row) {
?>
			<input type="text" class="form-control" name="prenom" id="exampleFormControlInput2" pattern="[A-z]{4,8}" placeholder="Prenom"  required value="<?php echo $row["prenom"]; ?>">
            <?php
        }
?>
		</div>

		<br>

		<div class="col-4">
            <label for="exampleFormControlInput2" class="form-label">Nbre livres empruntés</label>
            <?php
        foreach ($rows as $row) {
?>
            <input type="number" class="form-control" name="NbLivreEmprunte" id="exampleFormControlInput2"  placeholder="Nombre livre emprunte"  required value="<?php echo $row["NbLivreEmprunte"]; ?>">
		</div>
        <?php
        }
?>
        <br>

        <input type="submit" name="updateAdh" value="Modifier" class="btn btn-primary">
		<a class="btn btn-primary" href="adh_read.php" role="button">Retour</a>
	</form>
</div>

<?php echo template_footer(); ?>