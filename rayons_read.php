<?php
include 'request.php';

$conn = pdo_connect_mysql();

        //recuperer les noms dans la database

        $reponse = $conn->query("SELECT * FROM rayon");

?>

<?php echo template_header('Read'); ?>

<div class="content read">
	<h2>Liste rayons</h2>

<a href="create_rayon.php" class="create-contact">Créer un rayon</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Référence</td>
            </tr>
        </thead>
        <tbody>
<?php
        foreach ($reponse as $rows) {
?>
            <tr>
                <td><?php echo $rows["id"]; ?></td>
                <td><?php echo $rows["nom"]; ?></td>
                <td><?php echo $rows["reference"]; ?></td>
                
                <td class="actions">
                    <a href="update.php?id=<?php echo $rows["id"]; ?> " class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?php echo $rows["id"]; ?> " class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
</div>

<?php echo template_footer(); ?>