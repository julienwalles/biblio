<?php 
include 'request.php';

$conn = pdo_connect_mysql();

//request GET
$request = "SELECT * FROM rayon ";
$stmt_get = $conn->prepare($request);
$stmt_get->execute();
$rows = $stmt_get->fetchAll(PDO::FETCH_ASSOC);

//request POST

if(isset($_POST['create'])) {
	
$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$disponible = $_POST['disponible'];
$IDRayon = $_POST['IDRayon'];

$query = "INSERT INTO livre (titre, auteur, disponible, IDRayon) VALUES(:titre, :auteur, :disponible, :IDRayon)";
$stmt = $conn->prepare($query); 
$stmt->execute(array(":titre"=>$titre,":auteur"=>$auteur, ":disponible"=>$disponible, ":IDRayon"=>$IDRayon));


if($stmt) {
	echo '<script type="text/javascript">alert("book created");
			window.location.href = "livres_read.php";
		  </script>';

	exit();
}
	else {
		echo '<script>alert("there is an error")</script';
	}

}
?>


<?php echo template_header('Create'); ?>
<div class="content update">
    <h2>Ajouter un livre</h2>
</div>


<form method="post" action="#">
    <div class="container">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name = titre placeholder="Titre" required value="">
            </div>
            <div class="col">
                <input type="text" class="form-control"  name = auteur placeholder="Auteur" required value="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control"  name = disponible placeholder="Disponible" required value="oui">
            </div>
            <div class="col">
                IDRayon:
                <select name="IDRayon">
                    <?php
        foreach ($rows as $row) {
?>
                    < <option value="<?php echo $row["id"]; ?>"><?php echo $row["id"]; ?></option>
                        <?php
        }
?>
                </select>
                <br>
                
            </div>
            <br>
            <div class="row">
                <input type="submit" name="create" value="Create" class="buttom">
                </div>
        </div>
    </div>
</form>

<?php echo template_footer(); ?>