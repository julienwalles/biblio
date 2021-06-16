<?php 
include 'request.php';

$conn = pdo_connect_mysql();

//request GET livre
$request = "SELECT * FROM  livre WHERE disponible = 'oui' ";
$stmt_get = $conn->prepare($request);
$stmt_get->execute();
$rows = $stmt_get->fetchAll(PDO::FETCH_ASSOC);

//request GET adherent
$request2 = "SELECT id, NbLivreEmprunte, CONCAT(nom,' ',prenom) AS nom FROM adherent ";
$stmt_get2 = $conn->prepare($request2);
$stmt_get2->execute();
$rows2 = $stmt_get2->fetchAll(PDO::FETCH_ASSOC);

//request POST

if(isset($_POST['create'])) {
	

$IDLivre = $_POST['IDLivre'];
$IDAdherent = $_POST['IDAdherent'];
$DateEmprunt = $_POST['DateEmprunt'];


$query = "INSERT INTO emprunt (IDLivre, IDAdherent, DateEmprunt) VALUES(:IDLivre, :IDAdherent, :DateEmprunt)";
$stmt = $conn->prepare($query); 
$stmt->execute(array(":IDLivre"=>$IDLivre, ":IDAdherent"=>$IDAdherent, ":DateEmprunt"=>$DateEmprunt));


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
    <h2>Ajouter un emprunt</h2>
</div>


<form method="post" action="#">
    <div class="container">
        <div class="row">
            <div class="col">
            Titre du livre:
                <select name="IDLivre">
                <?php
            foreach ($rows as $row) {
?>
                    < <option value="<?php echo $row["IDLivre"]; ?>"><?php echo $row["titre"]; ?></option>
                    <?php
        }
?>
            </select>
            </div>
            <br>
            <div class="col">
            Nom adherent:
                <select name="IDAdherent">
            <?php
        foreach ($rows2 as $row2) {
?>
                    < <option value="<?php echo $row2["IDAdherent"]; ?>"><?php echo $row2["nom"]; ?></option>
                    <?php
        }
?>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
            Date d'emprunt:
                <input type="date" id="meeting-time"
                 name="DateEmprunt" value=""
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>
            <div class="col">              
            </div>
            <br>
            
                <input type="submit" name="create" value="Create" class="buttom">
                
        </div>
    </div>
</form>

<?php echo template_footer(); ?>