<?php
require('../inc/init.inc.php');


$resultat = $pdo -> prepare("SELECT * FROM v_bureau WHERE id = :id");
$resultat -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$resultat -> execute();

if($resultat -> rowCount() > 0){ //Signifie que le membre existe donc l'id passé en URL était conforme.
	$membre_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
	debug($membre_actuel);
}


// traitement pour ajouter un membre :
if(!empty($_POST)){

	debug($_POST);

	// Controls sur les infos du formulaire (pas vide, nbre de caractère etc...)
	// Requete pour insérer les infos dans la BDD.
	// redirection sur gestion_membre.php


	// Insérer les infos du membre en BDD...
	// Au préalable nous aurions vérifier tous les champs (taille, caractères, no empty etc......)

	if(empty($msg)){



		$resultat = $pdo -> prepare("INSERT INTO joueurs (adresse, code_postal, date_naissance, email, nom, prenom, nom_fich_photo, tel_fixe, tel_mobile, ville) VALUES (:adresse, :code_postal, :date_naissance, :email, :nom, :prenom, :nom_fich_photo, :tel_fixe, :tel_mobile, :ville)");

		$resultat -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);

		if($resultat -> execute()){

			header('location:gestion_membre.php?msg=validation&id=' . $mbr_insert);
		}
	}
}// fin du if(!empty($_POST))


// traitement pour modifier un membre
// 1/ On récupère les infos du membre actuel (en cours de modification)
// 2/ On insert les infos de ce membre dans le formulaire
// 3/ Gestion de la photo : Si on modifie simplement un texte il faut renvoyer l'ancienne image. Si on modifie l'image il faut pouvoir récupérer la nouvelle image.
// 4/ Enregistrement des modifications



// Créons des variables pour chaque élément à insérer dans le formulaire :
$adresse = (isset($membre_actuel))  ? $membre_actuel['adresse']  : '';
$code_postal = (isset($membre_actuel))  ? $membre_actuel['code_postal']  : '';
$date_naissance = (isset($membre_actuel))  ? $membre_actuel['date_naissance']  : '';
$email = (isset($membre_actuel))  ? $membre_actuel['email']  : '';
$nom = (isset($membre_actuel))  ? $membre_actuel['nom']  : '';
$prenom = (isset($membre_actuel))  ? $membre_actuel['prenom']  : '';
$photo = (isset($membre_actuel))  ? $membre_actuel['nom_fich_photo']  : $nom_photo;
$tel_fixe = (isset($membre_actuel))  ? $membre_actuel['tel_fixe']  : '';
$tel_mobile = (isset($membre_actuel))  ? $membre_actuel['tel_mobile']  : '';
$ville = (isset($membre_actuel))  ? $membre_actuel['ville']  : '';

$action = (isset($membre_actuel)) ? 'Modifier' : 'Ajouter';

$page = 'Gestion Membre';
include('../inc/head.inc.php');
include ('header.php');
?>
<body id="fmembre">

	<?php include ('../inc/nav.inc.php'); ?>
	<div class="container" >

		<div class="row" >
			<div class="col-12">

				<h1><?= $action ?> un membre</h1>
				<form action="" method="post" enctype="multipart/form-data">

					<input type="hidden" name="id_membre" value="<?= $id_membre ?>"/>

					<div class="form-group">
						<label for="photo"><img src="<?= RACINE_SITE ?>photos/<?= $photo ?>" height="100px"/></label><br>
						<!-- <label>Photo :</label> -->
						<input id="photo" type="file" name="photo"/ hidden>


						<input type="hidden" name="photo_actuelle" value="<?= $photo ?>" />
					</div>

					<div class="form-group">
						<label>Prénom :</label>
						<input type="text" name="prenom" value="<?= $prenom ?>" required>
					</div>

					<div class="form-group">
						<label>Nom :</label>
						<input type="text" name="nom" value="<?= $nom ?>" required>
					</div>

					<div class="form-group">
						<label>Date de naissance :</label>
						<input type="text" name="date_naissance" value="<?= $date_naissance ?>">
					</div>

					<div class="form-group">
						<label>Adresse :</label>
						<input type="text" name="adresse" value="<?= $adresse ?>" required>
					</div>

					<div class="form-group">
						<label>Code postal :</label>
						<input type="text" name="code_postal" value="<?= $code_postal ?>" required>
					</div>

					<div class="form-group">
						<label>Ville :</label>
						<input type="text" name="ville" value="<?= $ville ?>" required>
					</div>

					<div class="form-group">
						<label>tél. fixe :</label>
						<input type="text" name="tel_fixe" value="<?= $tel_fixe ?>">
					</div>

					<div class="form-group">
						<label>Tél. mobile :</label>
						<input type="text" name="tel_mobile" value="<?= $tel_mobile ?>">
					</div>

					<div class="form-group">
						<label>Email :</label>
						<input type="email" name="email" value="<?= $email ?>">
					</div>


					<input class="btn btn-primary" type="submit" name="<?= $action ?>" value="<?= $action ?>" />

				</form>
			</div>
			<!-- <div class="col-6">
			<form action="" method="post">

			<div class="form-group">
			<select name="">
			<option>Président</option>
			<option>Vice-Président</option>
			<option>Secrétaire</option>
			<option>Trésorier</option>
			<option>Membre</option>
		</select>
	</div>

	<div class="form-group">
	<select name="">

</select>
</div>

<input class="btn btn-primary" type="submit" name="Ajouter" value="<?= $action ?>" />

</form>
</div> -->
</div>
</div>


</body>
</html>
