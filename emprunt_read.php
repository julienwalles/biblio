<?php
include 'request.php';

$conn = pdo_connect_mysql();

//recuperer les noms dans la database

$reponse = $conn->query("SELECT emprunt.id, emprunt.IDLivre, emprunt.IDAdherent, DateEmprunt, DRetourMax, DateRetour , livre.titre, adherent.nom, adherent.prenom FROM emprunt   LEFT JOIN adherent ON emprunt.IDAdherent = adherent.id  LEFT JOIN livre ON emprunt.IDLivre = livre.id ORDER BY nom");
        
?>

<?php echo template_header('Read'); ?>

<div class="content read">
	<h2>Liste emprunts</h2>

<<<<<<< Updated upstream
    <a href="create_emprunt.php" class="create-contact">Emprunter un livre</a>

=======
<a href="ajout_patient.php" class="create-contact">Créer un emprunt</a>
>>>>>>> Stashed changes
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Titre livre</td>
                <td>Nom Adh</td>
                <td>Prenom Adh</td>
                <td>DateEmprunt</td>
                <td>DateRetourMax</td>
                <td>DateRetour</td>
            </tr>
        </thead>
        <tbody>
<?php
        foreach ($reponse as $rows) {
?>
            <tr>
                <td><?php echo $rows["id"]; ?></td>
                <td><?php echo $rows["titre"]; ?></td>
                <td><?php echo $rows["nom"]; ?></td>
                <td><?php echo $rows["prenom"]; ?></td>
                <td><?php echo $rows["DateEmprunt"]; ?></td>
                <td><?php echo $rows["DateRetour"]; ?></td>
                
                <td class="actions">
                    <a href="update.php?id=<?php echo $rows["id"]; ?> " class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="retour_emprunt.php?id=<?php echo $rows["id"]; ?> " class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
</div>



<?php echo template_footer(); ?>