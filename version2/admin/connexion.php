<?php
session_start();

require_once('inc/fonctions.inc.php');
require_once('inc/parametres.php');

// Connexion à la base de donnée
$pdo = new PDO("mysql:host=" . HOST . ";dbname=" . BDD, USER , PASS, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

// initialisation de variables
$page = '';
$title = '';
$msg = '';


include ('inc/head.inc.php');
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="thumbnail">
                    <div class="jumbotron jumbotron-sm">
                        <div class="container">
                            <div class="row">
                                <h3 class="h3"><span class="glyphicon glyphicon-lock">&nbsp;</span>CONNEXION</h3>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="caption">
                        <form method="post" action="<?php echo $controleur;?>verifconnexion.php">
                            <?php
                            if (isset($_GET['err'])){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                    <?php echo $_GET['err']; ?>
                                </div>
                            <?php } ?>
                            <div id="divemail" class="form-group">
                                <label for="email">Email :</label>
                                <?php $sp=""; ?>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo (isset($_COOKIE['email']))?$_COOKIE['email']:$sp; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd" >Mot de passe:</label>
                                <input type="password" class="form-control" id="pwd" name="pwd" required>
                            </div>

                            <input id="connect" type="submit" class="btn btn-success" value="SE CONNECTER" >

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php
include ('inc/footer.inc.php');
?>
