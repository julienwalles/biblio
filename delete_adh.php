<?php 
include 'request.php';

$conn = pdo_connect_mysql();

$id = $_GET['id'];

$sql = "DELETE FROM adherent WHERE id=$id";
$stmt_del = $conn->prepare($sql);
$stmt_del->execute();

if($stmt_del) {
	echo '<script type="text/javascript">alert("Adhérent supprimé");
			window.location.href = "adh_read.php";
		  </script>';
	// header('Location: http://localhost/pdo-test/read.php');

	exit();
}
	else {
		echo '<script>alert("there is an error")</script';
	}
?>

<?php echo template_header('Delete'); ?>
<div class="content delete">
	<h5>Voulez-vous supprimer cet adhérent ?</h5>
</div>


<?php echo template_footer(); ?>