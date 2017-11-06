<?php
require_once('../inc/init.inc.php');

if(isset($_GET['msg']) && $_GET['msg'] == 'validation' && isset($_GET['id'])){
	$msg .= '<div class="validation">Le membre N°' . $_GET['id'] . ' a été correctement enregistré !</div>';
}

$resultat = $pdo -> query("SELECT * FROM adherents WHERE saison=".date('Y'));
$adherents = $resultat -> fetchAll(PDO::FETCH_ASSOC);
$nb_adherents = $resultat -> rowCount();

$resultat = $pdo -> query("SELECT j.*, a.cotisation FROM adherents a right join joueurs j on j.id=a.id_joueur where saison=$saison_annee_un or saison is null ORDER BY prenom");
// SELECT * FROM joueurs ORDER BY prenom
$membres = $resultat -> fetchAll(PDO::FETCH_ASSOC);
$contenu .= 'Nombre de membres : ' . $resultat -> rowCount() . '<br/>';

$contenu .= 'Nombre d\'adhérents : <span id=nbAdherents>' . $nb_adherents . '</span><hr/>';

$contenu .= $msg;
$contenu .= '<table border="1">';
$contenu .= '<tr>'; // ligne des titres

for($i = 0; $i < $resultat -> columnCount(); $i++ ){
	$colonne = $resultat -> getColumnMeta($i);
	if (in_array ($colonne['name'], array('id', 'nom', 'prenom', 'adresse', 'code_postal', 'ville', ))){
		$contenu .= '<th>' . $colonne['name'] . '</th>';
	}
}

$contenu .= '	<th></th>';
$contenu .= '	<th>Cotisation</th>';
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
	$contenu .= '<td><a href="formulaire_adherent.php?id=' . $valeur['id'] . '"><img src="../img/edit.png" /></a></td>';
	$b_adherent = ($valeur['cotisation']==$saison_annee_un)?' checked ':'';
	$contenu .= '<td>';
	// $contenu .= '<input class="cb_adherent" style="width: 80%;height:35px;margin:auto" type="checkbox" value="'.$valeur['id'].'"'.$b_adherent.'>';
	$contenu .= '<input name="cotisation" id="sans" type="radio" checked>';
	$contenu .= '<label for="sans"> : non </label>';
	$contenu .= '<input name="cotisation" id="chq" type="radio" >';
	$contenu .= '<label for="chq"> : chq </label>';
	$contenu .= '<input name="cotisation" id="esp" type="radio" >';
	$contenu .= '<label for="esp"> : esp </label>';
	$contenu .= '</td>';

	$contenu .= '</tr>';
}
$contenu .= '</table>';

$page = 'Gestion membre';
include ('../inc/head.inc.php');
?>
<body id="gmembre">
	<?php include ('../inc/nav.inc.php'); ?>
	<!-- Contenu HTML -->
	<?php include ('nav_admin.php') ?>
	<h1>Gestion des adhérents</h1>
	<div class="container">
		<div class="row">
			<div class="col-auto ml-auto">
				<button type="button" class="btn btn-outline-primary" ><a class="btn-add" href="formulaire_adherent.php">Ajouter un adherent</a></button><br>
			</div>
			<div class="col-auto ml-auto">
				<?php
				$resultat = $pdo -> query("SELECT distinct(saison) FROM adherents ORDER BY saison DESC");
				$saisons = $resultat -> fetchAll(PDO::FETCH_ASSOC);
				?>

				<p>saison <?= $saison_annee_un.'/'.($saison_annee_un+1); ?></p>
			</div>

		</div>
		<?= $contenu ?>

	</div>

	<?php include ('../inc/footer.inc.php'); ?>

</body>
</html>
