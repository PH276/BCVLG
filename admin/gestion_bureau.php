<?php
require_once('../inc/init.inc.php');

if(isset($_GET['msg']) && $_GET['msg'] == 'validation' && isset($_GET['id'])){
	$msg .= '<div class="validation">Le membre N°' . $_GET['id'] . ' a été correctement enregistré !</div>';
}

$resultat = $pdo -> query("SELECT j.*, titre FROM bureau b right join joueurs j on j.id=b.id_joueur ORDER BY titre");
// SELECT * FROM joueurs ORDER BY prenom
$membres = $resultat -> fetchAll(PDO::FETCH_ASSOC);
$contenu .= 'Nombre de membres : ' . $resultat -> rowCount() . '<br/>';

$contenu .= $msg;
$contenu .= '<table border="1">';
$contenu .= '<tr>'; // ligne des titres

for($i = 0; $i < $resultat -> columnCount(); $i++ ){
	$colonne = $resultat -> getColumnMeta($i);
	if (in_array ($colonne['name'], array('id', 'nom', 'prenom', 'adresse', 'code_postal', 'ville', ))){
		$contenu .= '<th>' . $colonne['name'] . '</th>';
	}
}

$contenu .= '	<th>Bureau</th>';
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
	$b_adherent = ($valeur['titre'])?' checked ':'';
	$contenu .= '<td><input class="cb_bureau" style="width: 80%;height:35px;margin:auto" type="checkbox" value="'.$valeur['id'].'"'.$b_adherent.'></td>';

	$contenu .= '</tr>';
}
$contenu .= '</table>';

$page = 'Gestion bureau';
include ('../inc/head.inc.php');
?>
<body id="gbureau">
	<?php include ('../inc/nav.inc.php'); ?>
	<!-- Contenu HTML -->
	<?php include ('nav_admin.php') ?>
	<h1>Gestion des membres du bureau</h1>
	<div class="container">
		<?= $contenu ?>

	</div>

	<?php include ('../inc/footer.inc.php'); ?>

</body>
</html>
