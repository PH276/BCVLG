<?php
require_once('../inc/init.inc.php');
// pas besoin de design (header, footer, contenu) sur cette page, car elle a seulement vocation � nous faire un traitement puis � nous rediriger vers l'affiche de tous les membres.


// On v�rifie qu'il a bien un id dans l'URL et que c'est un chiffre
// On r�cupere les infos du membre
// On v�rifie que le membre existe
// On supprime la photo si elle existe et que c'est pas default.jpg
// On supprime le membre de la BDD
// on redirige vers l'affichage des membres (gestion_membre.php).

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){

	$resultat = $pdo -> prepare("SELECT * FROM joueurs WHERE id = :id");
	$resultat -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat -> execute();

	if($resultat -> rowCount() > 0){ // signifie que le membre existe
		$membre = $resultat -> fetch(PDO::FETCH_ASSOC);
		debug($membre);

		// Supprimer la photo du serveur :
		$chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . 'photo/' . $membre['photo'];
		// on recompose le chemin ABSOLUE du fichier que l'on va supprimer.

		if(file_exists($chemin_photo_a_supprimer) && $chemin_photo_a_supprimer != 'default.jpg'){
			unlink($chemin_photo_a_supprimer);
			// Unlink() permet de supprimer un fichier sur notre serveur.
		}

		// supprimer le membre de la BDD :

		$resultat = $pdo -> exec("DELETE FROM joueurs WHERE id = $membre[id]");

		if($resultat){
			header('location:gestion_membre.php?msg=suppr&id=' . $membre['id']);
		}
	} // fin du if $resultat -> rowCount()
}// fin du if(isset($_GET etc...
