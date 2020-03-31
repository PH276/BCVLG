window.onload = function(){
    // choix des adherents dans 'gestion_membre.php'
    var cbAdherent = document.getElementsByClassName("cb_adherent");
    for (i = 0 ; i < cbAdherent.length; i++){

        cbAdherent[i].addEventListener("change", function(event){
            event.preventDefault();
            adherent = (this.checked)?'1':'0';
            parameters = 'id='+this.value+'&adherent='+adherent;
            console.log(parameters);

            var r = new XMLHttpRequest();

            r.open("POST", "ajout_supp_adherent.php", true);

            r.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");

            r.send(parameters);
        });
    }

    function confirmer(q){

        confirm(q);
    }
}


// <a onclick="confirm(\'Êtes certain de vouloir supprimer ce membre numéro ' . $valeur['id'] . ' \', $valeur['id']);" href="supprimer_membre.php?id=' . $valeur['id'] . '">

// ' . $valeur['id'] . '
