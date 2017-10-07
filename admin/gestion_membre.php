<?php
require_once('../inc/init.inc.php');

if(isset($_GET['msg']) && $_GET['msg'] == 'validation' && isset($_GET['id'])){
	$msg .= '<div class="validation">Le membre N°' . $_GET['id'] . ' a été correctement enregistré !</div>';
}

if(isset($_GET['msg']) && $_GET['msg'] == 'suppr' && isset($_GET['id'])){
	$msg .= '<div class="validation">Le membre N°' . $_GET['id'] . ' a été correctement supprimé !</div>';
}


$resultat = $pdo -> query("SELECT * FROM joueurs");
$membres = $resultat -> fetchAll(PDO::FETCH_ASSOC);
$contenu .= 'Nombre de résultats : ' . $resultat -> rowCount() . '<br/><hr/>';

$contenu .= $msg;
$contenu .= '<table border="1">';
$contenu .= '<tr>'; // ligne des titres

for($i = 0; $i < $resultat -> columnCount(); $i++ ){
	$colonne = $resultat -> getColumnMeta($i);
	if (in_array ($colonne['name'], array('id', 'nom', 'prenom', 'adresse', 'code_postal', 'ville', ))){
		$contenu .= '<th>' . $colonne['name'] . '</th>';
	}
}

$contenu .= '	<th colspan="2">Actions</th>';
$contenu .= '</tr>'; // fin ligne des titres

foreach($membres as $valeur){ // parcourt tous les enregistrements
	$contenu .= '<tr>'; // ligne pour chaque enregistrement

	foreach($valeur as $indice => $valeur2){ // Parcourt toutes les infos de chaque enregistrement

		if($indice == 'photo'){
			$contenu .= '<td><img src="' . RACINE_SITE . 'photo/' . $valeur2 . '" height="90"/></td>';
		}
		elseif (in_array ($indice, array('id', 'nom', 'prenom', 'adresse', 'code_postal', 'ville', )))
		{
			$contenu .= '<td>' . $valeur2. '</td>';
		}
	}
	$contenu .= '<td><a href="formulaire_membre.php?id=' . $valeur['id'] . '"><img src="../img/edit.png" /></a></td>';
	$contenu .= '<td><a onclick="confirm(\'Êtes certain de vouloir supprimer ce membre numéro ' . $valeur['id'] . ' \');" href="supprimer_membre.php?id=' . $valeur['id'] . '"><img src="../img/delete.png" /></a></td>';

	$contenu .= '</tr>';
}
$contenu .= '</table>';


$page = 'Gestion membre';
include ('../inc/head.inc.php');
?>
<body id="gmembre">
	<?php include ('../inc/nav.inc.php'); ?>
	<!-- Contenu HTML -->
	<h1>Gestion des membres</h1>
	<div class="container">


		<a class="btn-add" href="formulaire_membre.php">Ajouter un membre</a>


		<?= $contenu ?>

	</div>

	<?php include ('../inc/footer.inc.php'); ?>



</body>
</html>
