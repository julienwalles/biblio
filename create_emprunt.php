<?php 
include 'request.php';

$conn = pdo_connect_mysql();

//request GET livre
$request = "SELECT * FROM  livre WHERE disponible = 'oui' ";
$stmt_get = $conn->prepare($request);
$stmt_get->execute();
$rows = $stmt_get->fetchAll(PDO::FETCH_ASSOC);

//request GET adherent
$request2 = "SELECT id, NbLivreEmprunte, CONCAT(nom,' ',prenom) AS nom FROM adherent WHERE NbLivreEmprunte < 5 ";
$stmt_get2 = $conn->prepare($request2);
$stmt_get2->execute();
$rows2 = $stmt_get2->fetchAll(PDO::FETCH_ASSOC);


//request POST to create an emprunt
if(isset($_POST['create'])) {
	

$IDLivre = $_POST['IDLivre'];
$IDAdherent = $_POST['IDAdherent'];
$DateEmprunt = $_POST['DateEmprunt'];
$DRetourMax = $_POST['DRetourMax'];
$DateRetour = $_POST['DateRetour'];

$query = "INSERT INTO emprunt (IDLivre, IDAdherent, DateEmprunt, DRetourMax, DateRetour) VALUES(:IDLivre, :IDAdherent, :DateEmprunt, :DRetourMax, :DateRetour)";
$stmt = $conn->prepare($query); 
$stmt->execute(array(":IDLivre"=>$IDLivre, ":IDAdherent"=>$IDAdherent, ":DateEmprunt"=>$DateEmprunt, ":DRetourMax"=>$DRetourMax, ":DateRetour"=>$DateRetour));



if($stmt) {

//request tu update NbLivreEmprunte;
$id = $_POST['IDAdherent'];
$NbLivreEmprunte = $_POST['NbLivreEmprunte'];

$query = "UPDATE adherent SET NbLivreEmprunte= NbLivreEmprunte + 1 WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt_exec = $stmt->execute(array("id"=>$id));

//request tu update NbLivreEmprunte;
$id = $_POST['IDLivre'];
$disponible = $_POST['disponible'];

$query = "UPDATE livre SET disponible= 'non' WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt_exec = $stmt->execute(array("id"=>$id));

	echo '<script type="text/javascript">alert("emprunt created");
			window.location.href = "emprunt_read.php";
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
            <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">Titre livre</label>
                <select name="IDLivre">
                <?php
                foreach ($rows as $row) {   
                    ?>
                    < <option value="<?php echo $row["id"]; ?>"><?php echo $row["titre"]; ?></option>
                    <?php
                        }
                ?>
                </select>
            </div>

            <br>

            <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">Nom adherent</label>
                <select name="IDAdherent">
                <?php
                foreach ($rows2 as $row2) {
                ?>
                    <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["nom"]; ?></option>
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
                 name="DateEmprunt" value=""
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>

            <br>

            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">Date de retour max</label>
                <input type="date" id="meeting-time"
                 name="DRetourMax" value=""
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>
        
            <br>

            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">Date de retour</label>
                <input type="date" id="meeting-time"
                 name="DateRetour" value=""
                min="2021-01-07T00:00" max="2030-06-14T00:00">
            </div>
            
            <br>
        
        </div>

        <input type="submit" name="create" value="Create" class="btn btn-secondary">
    </div>
</form>

<?php echo template_footer(); ?>