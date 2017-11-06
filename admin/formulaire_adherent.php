<?php
require('../inc/init.inc.php');

// traitement pour ajouter un membre :
$nom_photo = 'avatar.png';

if(!empty($_POST)){

	debug($_POST);
	debug($_FILES);


	if(isset($_POST['photo_actuelle'])){
		$nom_photo = $_POST['photo_actuelle'];
	}

	if(!empty($_FILES['photo']['name'])){ // Si une photo est uploadée

		$nom_photo = $_POST['id_membre'] . '-' . $_FILES['photo']['name'];

		$chemin_photo = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . 'photos/' . $nom_photo;
		// chemin: c://xampp/htdocs   /PHP/site/   photos/   1-membre.jpg

		$ext = array('image/png', 'image/jpeg', 'image/gif');
		if(!in_array($_FILES['photo']['type'], $ext)){
			$msg .= '<div class="erreur">Images autorisées : PNG, JPG, JPEG et GIF</div>';
			// Si le fichier uploadé ne correspond pas aux extensions autorisées (ici PNG, JPEG, JPG et GIF) alors on affiche un message d'erreur.
		}

		if($_FILES['photo']['size'] > 2000000){
			$msg .= '<div class="erreur">Images : 2Mo maximum autorisé</div>';
			// Si la photo uploadées est trop valumineuse (ici 2Mo max), alors on met un message d'erreur.
			// Par defaut XAMPP autorise 2,5Mo. Voir dans php.ini, rechercher upload_max_filesize=2.5M
		}

		if(empty($msg) && $_FILES['photo']['error'] == 0){

			copy($_FILES['photo']['tmp_name'], $chemin_photo);
			// On enregistre la photo sur le serveur. Dans les fait, on la copier depuis son emplacement temporaire et on la colle dans son emplacement définitif.
		}
	}// fin du if isset($_FILES['photo']['name'])


	// Insérer les infos du membre en BDD...
	// Au préalable nous aurions vérifier tous les champs (taille, caractères, no empty etc......)

	if(empty($msg)){



		if(isset($_POST['Modifier'])){
			$resultat = $pdo -> prepare("UPDATE joueurs set adresse = :adresse, code_postal = :code_postal, date_naissance= :date_naissance, email = :email, nom= :nom, prenom = :prenom, nom_fich_photo = :nom_fich_photo, tel_fixe = :tel_fixe, tel_mobile = :tel_mobile, ville = :ville WHERE id = :id_membre");

			$resultat -> bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);

		}
		else{
			$resultat = $pdo -> prepare("INSERT INTO joueurs (adresse, code_postal, date_naissance, email, nom, prenom, nom_fich_photo, tel_fixe, tel_mobile, ville) VALUES (:adresse, :code_postal, :date_naissance, :email, :nom, :prenom, :nom_fich_photo, :tel_fixe, :tel_mobile, :ville)");
		}

		$resultat -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
		$resultat -> bindParam(':code_postal', $_POST['code_postal'], PDO::PARAM_INT);
		$resultat -> bindParam(':date_naissance', $_POST['date_naissance'], PDO::PARAM_STR);
		$resultat -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
		$resultat -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
		$resultat -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
		$resultat -> bindParam(':nom_fich_photo', $_POST['nom_fich_photo'], PDO::PARAM_STR);
		$resultat -> bindParam(':tel_fixe', $_POST['tel_fixe'], PDO::PARAM_INT);
		$resultat -> bindParam(':tel_mobile', $_POST['tel_mobile'], PDO::PARAM_INT);
		$resultat -> bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);


		if($resultat -> execute()){

			$mbr_insert = (isset($_POST['Modifier'])) ? $_POST['id_membre'] : $pdo -> lastInsertId(); // Récupère l'ID du dernier enregistrement.

			$resultat = $pdo -> query("INSERT INTO adherents(saison, id_joueur) VALUES ($saison_annee_un, $mbr_insert) ");

			$resultat -> execute();

			header('location:gestion_adherents.php?msg=validation&id=' . $mbr_insert);
		}
	}
}// fin du if(!empty($_POST))


// traitement pour modifier un membre
// 1/ On récupère les infos du membre actuel (en cours de modification)
// 2/ On insert les infos de ce membre dans le formulaire
// 3/ Gestion de la photo : Si on modifie simplement un texte il faut renvoyer l'ancienne image. Si on modifie l'image il faut pouvoir récupérer la nouvelle image.
// 4/ Enregistrement des modifications


if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	// Si j'ai un ID dans l'URL, non vide et de type INT, alors je suis dans le cadre de la modification d'un membre.

	$resultat = $pdo -> prepare("SELECT * FROM joueurs WHERE id = :id");
	$resultat -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat -> execute();

	if($resultat -> rowCount() > 0){ //Signifie que le membre existe donc l'id passé en URL était conforme.
		$membre_actuel = $resultat -> fetch(PDO::FETCH_ASSOC);
		debug($membre_actuel);
	}
}

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
include ('../inc/head.inc.php');
?>
<body id="fmembre">

	<?php include ('../inc/nav.inc.php'); ?>
	<div class="container" >
		<?php include ('nav_admin.php') ?>

		<div class="row" >
			<div class="col-12">

				<h1><?= $action ?> un adhérent</h1>
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
					<div class="form-group">
						<input name="cotisation" id="sans" type="radio" checked>
						<label for="sans"> : non </label>
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
