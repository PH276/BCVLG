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
        <?php
        $texte_header = "header_resultats.html";
        include ('inc/header.inc.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <aside class="col-3">  <!--  aside -->
                    <section class="row">
                    </section>
                    <section class="row">
                        <div class="col-12">
                            <h3>Le Grand Handicap</h3>
                            <p>
                                Il s'agit d'une compétition permettant à l'ensemble des joueurs du club de se rencontrer quelque soit leur niveau, le nombre de points à réaliser (handicap) est calculé en fonction du niveau de chacun.
                            </p>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-12">
                            <h3>Le Cazin</h3>
                            <p>
                                Chaque joueur doit effectuer des figures imposées, qu'il doit annoncer avant de jouer. Il est interdit de jouer la meme figure deux fois de suite. Le premier qui a réalisé chaque figure un nombre de fois prédéfini à l'avance a gagné.
                            </p>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-12">
                            <h3>Le penthatlon</h3>
                            <p>
                                Il s'agit d'une épeuve regroupant 5 disciplines. Dans la même partie le joueur doit réaliser un quota de points, par exemple à la libre, à la bande, au trois bandes et cazin et au 4 billes.
                            </p>
                        </div>
                    </section>
                </aside>
                <main class="col-9 resultats">
                    <h1>Résultats - saison 2016/2017</h1>
                    <hr color="#99CC00" size="5">
                    <div class="row">
                        <div class="col-3">
                            <div class="tournoi">

                                <h2>Grand handicap</h2>
                                <hr color="#99CC00" size="5">
                                <ol>
                                    <li>Pierre Janvier</li>
                                    <li>Jean-Jacques GADENNE</li>
                                    <li>Pierre Poretzky</li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="tournoi">
                                <h2>Américain</h2>
                                <hr color="#99CC00" size="5">
                                <ol>
                                    <li>Joe SAUTRON</li>
                                    <li>Pierre JANVIER</li>
                                    <li>Marcel TECHER</li>
                                </ol>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="tournoi">
                                <h2>3 bandes</h2>
                                <hr color="#99CC00" size="5">
                                <div class="row">

                                    <article class="col-6">
                                        <h4>Poule A</h4>
                                        <ol>
                                            <li>Joe SAUTRON</li>
                                            <li>Marcel TECHER</li>
                                            <li>Pierre JANVIER</li>
                                        </ol>
                                    </article>
                                    <article class="col-6">
                                        <h4>Poule B</h4>
                                        <ol>
                                            <li>Frédéric TECHER</li>
                                            <li>Christophe CORBIN</li>
                                            <li>Thierry DUVAL</li>
                                        </ol>
                                    </article>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="tournoi">
                                <h2>Cazin</h2>
                                <hr color="#99CC00" size="5">
                                <div class="row">

                                    <article class="col-6">
                                        <h4>Poule A</h4>
                                        <ol>
                                            <li>Pierre JANVIER</li>
                                            <li>Joe SAUTRON</li>
                                            <li>Dany BENTEUR</li>
                                        </ol>
                                    </article>
                                    <article class="col-6">
                                        <h4>Poule B</h4>
                                        <ol>
                                            <li>Frédéric TECHER</li>
                                            <li>Pascal HUITOREL</li>
                                            <li>Alain FRANCILLONE</li>
                                        </ol>
                                    </article>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="tournoi">
                                <h2>4 billes</h2>
                                <hr color="#99CC00" size="5">
                                <div class="row">

                                    <article class="col-6">
                                        <h4>Poule A</h4>
                                        <ol>
                                            <li>Joe SAUTRON</li>
                                            <li>Marcel TECHER</li>
                                            <li>Pierre JANVIER</li>
                                        </ol>
                                    </article>
                                    <article class="col-6">
                                        <h4>Poule B</h4>
                                        <ol>
                                            <li>Georges CHETRIT</li>
                                            <li>Alain FRANCILLONE</li>
                                            <li>Pascal HUITOREL</li>
                                        </ol>
                                    </article>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="tournoi">
                                <h2>Libre</h2>
                                <hr color="#99CC00" size="5">
                                <div class="row">

                                    <article class="col-6">
                                        <h4>Poule A</h4>
                                        <ol>
                                            <li>Joe SAUTRON</li>
                                            <li>Pierre JANVIER</li>
                                            <li>Marcel TECHER</li>
                                        </ol>
                                    </article>
                                    <article class="col-6">
                                        <h4>Poule B</h4>
                                        <ol>
                                            <li>Christophe CORBIN</li>
                                            <li>Pascal HUITOREL</li>
                                            <li>Alain FRANCILLONE</li>
                                        </ol>
                                    </article>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="tournoi">
                                <h2>Bande</h2>
                                <hr color="#99CC00" size="5">
                                <div class="row">

                                    <article class="col-6">
                                        <h4>Poule A</h4>
                                        <ol>
                                            <li>Pierre JANVIER</li>
                                            <li>Marcel TECHER</li>
                                            <li>Roger NEGRE</li>
                                        </ol>
                                    </article>
                                    <article class="col-6">
                                        <h4>Poule B</h4>
                                        <ol>
                                            <li>Frédéric TECHER</li>
                                            <li>Alain FRANCILLONE</li>
                                            <li>Pascal HUITOREL</li>
                                        </ol>
                                    </article>
                                </div>
                            </div>

                        </div>

                    </div>
                </main>
            </div>
        </div>


        <?php include ('inc/footer.inc.php'); ?>
    </div>


</body>
</html>
