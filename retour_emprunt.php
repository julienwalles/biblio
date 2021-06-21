<?php

include 'request.php';

$conn = pdo_connect_mysql();
?>

<?php 

$id = $_GET['id'];

//request tu update NbLivreEmprunte;
$query2 = "UPDATE emprunt LEFT JOIN adherent ON adherent.id = emprunt.IDAdherent SET adherent.NbLivreEmprunte = adherent.NbLivreEmprunte - 1 WHERE emprunt.id = :id";
$stmt2 = $conn->prepare($query2);
$stmt_exec2 = $stmt2->execute(array("id"=>$id));

//request tu update disponible;
$query3 = "UPDATE emprunt LEFT JOIN livre ON livre.id = emprunt.IDLivre SET livre.disponible = 'oui' WHERE emprunt.id = :id";
$stmt3 = $conn->prepare($query3);
$stmt_exec3 = $stmt3->execute(array("id"=>$id));

$sql = "DELETE FROM emprunt WHERE id=$id";
$conn->exec($sql);

	echo '<script type="text/javascript">alert("emprunt deleted");
			window.location.href = "emprunt_read.php";
		  </script>';

?>

<?php echo template_header('Delete'); ?>
<div class="content delete">
	<h2>Delete Student</h2>
</div>

<?php echo template_footer(); ?>
