<?php
include 'request.php';

$conn = pdo_connect_mysql();

        //recuperer les noms dans la database

        $reponse = $conn->query("SELECT id, NbLivreEmprunte, CONCAT(nom,' ',prenom) AS nom FROM adherent");
 
?>

<?php echo template_header('Read'); ?>

<div class="content read">
	<h2>Liste adhérents</h2>

<a href="create_adh.php" class="create-contact">Créer un adhérent</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Identité</td>
                <td>NbLivreEmprunte</td>
            </tr>
        </thead>
        <tbody>
<?php
        foreach ($reponse as $rows) {
?>
            <tr>
                <td><?php echo $rows["id"]; ?></td>
                <td><?php echo $rows["nom"]; ?></td>
                <td><?php echo $rows["NbLivreEmprunte"]; ?></td>
                
                <td class="actions">
                    <a href="update_adh.php?id=<?php echo $rows["id"]; ?> " class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_adh.php?id=<?php echo $rows["id"]; ?> " class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
</div>

<?php echo template_footer(); ?>