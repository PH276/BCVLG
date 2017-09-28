<!DOCTYPE html>
<html lang="fr">
<?php
$titrePage = "liens";
include ('head.php');
?>
<body>
    <?php include ('nav.php'); ?>
    <div id="corps" class="container">
        <?php
        $texte_header = "header_liens.html";
        include ('header.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <aside class="col-3">  <!--  aside -->
                    <div class="row">
                        <div class="col-12">
                            <h3>Vos coups de coeur </h3>
                            <p>Faites nous connaitre les sites que vous souhaitez faire partager.</p>
                            <br>
                            <a href="mailto:bureau@billardclubvlg.org">bureau@billardclubvlg.org</a>
                        </div>
                    </div>
                </aside>
                <main class="col-9">
                    <div class="row">
                        <div class="col-6">
                            <h2>Fédération</h2>
                            <hr color="#99CC00" size=5>
                            <div class="row">
                                <div class="col-5">
                                    <a href="http://www.ffbillard.com" target="_blank">
                                        <img width="100%" src="img/FFB.png" alt="FFB">
                                    </a>
                                </div>
                                <div class="col-7">
                                    <p>Le site de la fédération Française de Billard.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h2>Fournisseur</h2>
                            <hr color="#99CC00" size=5>
                            <div class="row">
                                <div class="col-5">
                                    <a href="http://www.billards-breton.com" target="_blank">
                                        <img width="100%" src="img/LOGO-BRETON-fond-vertweb.jpg" alt="FFB">
                                    </a>
                                </div>
                                <div class="col-7">
                                    <p>La société Bréton entretien nos billards et nous fournie en matériel et accessoires.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <h2>Un peu d'histoire</h2>
                            <hr color="#99CC00" size=5>
                            <div class="row">
                                <div class="col-3">
                                    <a href="http://www.supreme.fr/histoire_billard" target="_blank">
                                        <img width="100%" src="img/gravure.jpg" alt="FFB">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <p>L'histoire du billard commence sous Louis XI. Souffrant de problèmes de dos, il aurait ordonné à son tourneur sur bois une table pour jouer au croquet à hauteur d’homme..</p>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>


            <?php include ('footer.php'); ?>
        </div>


    </body>
    </html>
