<?php 
include 'request.php';

$conn = pdo_connect_mysql();

$id = $_GET['id'];

$sql = "DELETE FROM livre WHERE id=$id";
$stmt_del = $conn->prepare($sql);
$stmt_del->execute();

if($stmt_del) {
	echo '<script type="text/javascript">alert("livre supprimé");
			window.location.href = "livres_read.php";
		  </script>';

	exit();
}
	else {
		echo '<script>alert("there is an error")</script';
	}
?>

<?php echo template_header('Delete'); ?>
<div class="content delete">
	<h2>Supprimer livre</h2>
</div>


<?php echo template_footer(); ?>