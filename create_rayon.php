<?php 
include 'request.php';

$conn = pdo_connect_mysql();

//request POST

if(isset($_POST['create'])) {
	
$nom = $_POST['nom'];
$reference = $_POST['reference'];


$query = "INSERT INTO rayon (nom, reference) VALUES(:nom, :reference)";
$stmt = $conn->prepare($query); 
$stmt->execute(array(":nom"=>$nom,":reference"=>$reference));


if($stmt) {
	echo '<script type="text/javascript">alert("rayon created");
			window.location.href = "rayons_read.php";
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
    <h2>Ajouter un rayon</h2>
</div>


<form method="post" action="#">
    <div class="container">
        <div class="row">
            <div class="col">
                <label for="content" class="form-label">Nom</label>
                <input type="text" class="form-control" name = nom placeholder="Nom" required value="">
            </div>
            <div class="col">
            <label for="content" class="form-label">Reference</label>
                <input type="text" class="form-control"  name = reference placeholder="Reference" required value="">
            </div>
        </div>
            <br>
            <div class="row">
                <input type="submit" name="create" value="Create" class="buttom">
                </div>
        </div>
    </div>
</form>

<?php echo template_footer(); ?>