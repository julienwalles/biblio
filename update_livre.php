<?php
include 'request.php';

$conn = pdo_connect_mysql();

$id = $_GET['id'];

//request GET livre
$request = "SELECT livre.id, livre.titre, livre.auteur, livre.disponible,livre.IDRayon FROM  livre LEFT JOIN rayon ON livre.IDRayon = rayon.id WHERE livre.id = $id ";
$stmt_get = $conn->prepare($request);
$stmt_get->execute();
$rows = $stmt_get->fetchAll(PDO::FETCH_ASSOC);

$request2 = "SELECT CONCAT(rayon.nom,' ',rayon.id) AS rayon FROM rayon";
$stmt_get2 = $conn->prepare($request2);
$stmt_get2->execute();
$rows2 = $stmt_get2->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['update'])) {

$id = $_GET['id'];
$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$disponible = $_POST['disponible'];
$IDRayon = $_POST['IDRayon'];

// update  request POST
$query = "UPDATE livre SET titre=:titre, auteur=:auteur, disponible=:disponible, IDRayon=:IDRayon WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt_exec = $stmt->execute(array("titre"=>$titre, "auteur"=>$auteur, "disponible"=>$disponible, "IDRayon"=>$IDRayon, "id"=>$id));

if($stmt_exec) {
	echo '<script type="text/javascript">alert("data updated");
			window.location.href = "livres_read.php";
		  </script>';

	exit();
}
	else {
		echo '<script>alert("Modification effectuée")</script';
	}
}


?>
<?php echo template_header('Create'); ?>
<div class="content update">

<form method="post" action="#">
    <div class="container">
        <div class="row">
            <div class="col-6">
            <?php
        foreach ($rows as $row) {
?>
                <label for="exampleFormControlInput1" class="form-label">Titre</label>
                <input type="text" class="form-control" name = titre placeholder="Titre" required value="<?php echo $row["titre"]; ?>">
                <?php
        }
?>
            </div>
            <div class="col-6">
            <?php
        foreach ($rows as $row) {
?>
                <label for="exampleFormControlInput1" class="form-label">Auteur</label>
                <input type="text" class="form-control"  name = auteur placeholder="Auteur" required value="<?php echo $row["auteur"]; ?>">
                <?php
        }
?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
            <label for="exampleFormControlInput1" class="form-label">Disponible</label>
                <input type="text" class="form-control"  name = disponible placeholder="Disponible" required value="<?php echo $row["disponible"]; ?>">
            </div>
            <div class="col">
                IDRayon:
                <select name="IDRayon">       
                <?php
                foreach ($rows2 as $row2) {
?>
                     <option value="<?php echo $row["IDRayon"]; ?>"><?php echo $row2["rayon"]; ?></option>
                        <?php
        }
?>
                </select>
                <br>
                
            </div>
            <br>
            <div class="row">
                <input type="submit" name="update" value="Update" class="btn btn-primary">
                <a class="btn btn-primary" href="livres_read.php" role="button">Retour</a>
                </div>
        </div>
    </div>
</form>

<?php echo template_footer(); ?>