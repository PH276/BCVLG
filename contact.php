<?php require_once('inc/init.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$titrePage = "";
include ('inc/head.inc.php');
?>
<body>
    <?php include ('inc/nav.inc.php'); ?>
    <div id="corps" class="container">
        <?php include ('inc/header.inc.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <aside class="col-3">  <!--  aside -->
                    <div class="row">
                        <div class="col-12">
                            <h3>Attention !</h3>
                            <p>Notre courrier électronique n'est pas lu quotidiennement, il est donc préférable de nous contacter par téléphone</p>
                        </div>
                    </div>
                </aside>
                <main class="col-9">
                    <h1>Contact</h1>
                    <section>
                        <h2>Pour nous concter</h2>
                        <hr color="#99CC00" size="5">
                        <div class="row">
                            <div class="col-7">
                                <p>Notre club se trouve au :<br>11-13 Rue Dupont du Chambon</p>
                                <p>Vous pouvez nous joindre aux heures d'ouverture au :<br><a href="tel:+320147946852">01 47 94 68 52 </a><br>
                                    ou par courrier électronique à :<br> <a href="mailto:bureau@billardclubvlg.org">bureau@billardclubvlg.org</a></p>
                                </div>
                                <div class="col-5">
                                    <img width="100%" src="img/salle.jpg" alt="">
                                </div>
                            </div>
                        </section>
                        <section>
                            <h2>Comment nous retrouver ?</h2>
                            <hr color="#99CC00" size="5">
                            <p><strong>Au centre de Villeneuve la garenne.</strong><br>
                                Désservi par le tramway, à deux pas de la Mairie.</p>
                                <p>Desservie par un puissant réseau routier et autoroutier et un maillage de transports en commun, Villeneuve-la-Garenne est très accessible.</p>
                                <p><strong>Nous disposons d'un parking.</strong></p>
                            </section>
                            <section>
                                <h2>Plan</h2>
                                <hr color="#99CC00" size="5">
                                <div class="row">
                                    <div class="col-12">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2620.911088195635!2d2.3294437159127517!3d48.936135279295264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66ed4deb5e9fd%3A0xf3f6f20d3ea68888!2s13+Rue+Dupont+du+Chambon%2C+92390+Villeneuve-la-Garenne!5e0!3m2!1sfr!2sfr!4v1506638531293" width="80%" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </section>
                        </main>
                    </div>
                </div>


                <?php include ('inc/footer.inc.php'); ?>
            </div>


        </body>
        </html>
