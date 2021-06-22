<?php
require 'request.php';
$conn = pdo_connect_mysql();
?>

<?php echo template_header('Home'); ?>

<div class="content">
	<h1>Accueil</h1>
	<p>BIENVENUE SUR LE SITE DE LA BIBLIOTHEQUE !</p>
</div>

<?php echo template_footer(); ?>