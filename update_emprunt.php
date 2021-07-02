<?php
include 'request.php';

$conn = pdo_connect_mysql();

$id = $_GET['id'];

//request GET 
$request = "SELECT emprunt.id, emprunt.IDLivre, emprunt.IDAdherent, DateEmprunt, DRetourMax, DateRetour , livre.titre, adherent.nom, adherent.prenom 
            FROM emprunt
            LEFT JOIN adherent ON emprunt.IDAdherent = adherent.id  
            LEFT JOIN livre ON emprunt.IDLivre = livre.id 
            WHERE emprunt.id = $id";

$stmt_get = $conn->prepare($request);
$stmt_get->execute();
$rows = $stmt_get->fetchAll(PDO::FETCH_ASSOC);


$request2 = "SELECT CONCAT(adherent.nom,' ',adherent.prenom) AS adherent FROM adherent";
$stmt_get2 = $conn->prepare($request2);
$stmt_get2->execute();
$rows2 = $stmt_get2->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['updateEmprunt'])) {

    $id = $_GET['id'];
    $IDLivre = $_POST['IDLivre'];
    $IDAdherent = $_POST['IDAdherent'];
    $DateEmprunt = $_POST['DateEmprunt'];
    $DRetourMax = $_POST['DRetourMax'];
    $DateRetour = $_POST['DateRetour'];

// update  request POST
$query = "UPDATE emprunt SET IDLivre=:IDLivre, IDAdherent=:IDAdherent, DateEmprunt =:DateEmprunt, DRetourMax=:DRetourMax, DateRetour=:DateRetour WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt_exec = $stmt->execute(array("IDLivre"=>$IDLivre, "IDAdherent"=>$IDAdherent, "DateEmprunt"=>$DateEmprunt, "DRetourMax"=>$DRetourMax, "DateRetour"=>$DateRetour,"id"=>$id));

if($stmt_exec) {
	echo '<script type="text/javascript">alert("Modification effectuée");
			window.location.href = "emprunt_read.php";
		  </script>';

	exit();
}
	else {
		echo '<script>alert("Modification non effectuée")</script';
	}
}

?>

<?php echo template_index() ?>

<h3>Modifier un emprunt</h3>

<form method="post" action="#">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <label for="exampleFormControlInput1" class="form-label">ID livre</label>
                <select name="IDLivre">
                <?php
                foreach ($rows as $row) {
                ?>
                    < <option value="<?php echo $row["IDLivre"]; ?>"><?php echo $row["IDLivre"]; ?></option>
                    <?php
                    }
                ?>
                </select>
            </div>

            <br>

            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">ID adherent</label>
                <select name="IDAdherent">
                <?php
                foreach ($rows2 as $row2) {
                ?>
                    <option value="<?php echo $row2["IDAdherent"]; ?>"><?php echo $row2["adherent"]; ?></option>
                <?php
                    }
                ?>
                </select>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">Date d'emprunt</label>
                <input type="date" id="meeting-time"
                <?php
                foreach ($rows as $row) {
                ?>
                 name="DateEmprunt" value="<?php echo $row["DateEmprunt"]; ?>"
                 <?php
                    }
                ?>
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>

            <br>

            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">Date de retour max</label>
                <input type="date" id="meeting-time"
                <?php
                foreach ($rows as $row) {
                ?>
                 name="DRetourMax" value="<?php echo $row["DRetourMax"]; ?>"
                 <?php
                    }
                ?>
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>
        
            <br>

            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">Date de retour</label>
                <input type="date" id="meeting-time"
                <?php
                foreach ($rows as $row) {
                ?>
                 name="DateRetour" value="<?php echo $row["DateRetour"]; ?>"
                 <?php
                    }
                ?>
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>
            
            <br>
        
        </div>

        <input type="submit" name="updateEmprunt" value="Modifier" class="btn btn-secondary">
        <a class="btn btn-primary" href="emprunt_read.php" role="button">Retour</a>
    </div>
</form>

<?php echo template_footer(); ?>