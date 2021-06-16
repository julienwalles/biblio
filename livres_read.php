<?php
include 'request.php';

$conn = pdo_connect_mysql();

        //recuperer les noms dans la database

        $reponse = $conn->query("SELECT livre.id, livre.titre, livre.auteur, livre.disponible, rayon.nom  FROM livre LEFT JOIN rayon ON livre.IDRayon = rayon.id ");
 
?>

<?php echo template_header('Read'); ?>

<div class="content read">
	<h2>Liste livres</h2>

<a href="ajout_livre.php" class="create-contact">Créer un livre</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>titre</td>
                <td>auteur</td>
                <td>disponible</td>
                <td>IDRayon</td>
            </tr>
        </thead>
        <tbody>
<?php
        foreach ($reponse as $rows) {
?>
            <tr>
                <td><?php echo $rows["id"]; ?></td>
                <td><?php echo $rows["titre"]; ?></td>
                <td><?php echo $rows["auteur"]; ?></td>
                <td><?php echo $rows["disponible"]; ?></td>
                <td><?php echo $rows["nom"]; ?></td>
                
                <td class="actions">
                    <a href="update_livre.php?id=<?php echo $rows["id"]; ?> " class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_livre.php?id=<?php echo $rows["id"]; ?> " class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
</div>

<?php echo template_footer(); ?>