<!DOCTYPE html>
<html lang="fr">
<?php
$titrePage = "";
include ('head.php');
?>
<body>
    <?php include ('nav.php'); ?>
    <div id="corps" class="container">
        <?php
        $texte_header = "header_index.html";
        include ('header.php'); ?>
        <div id="corps" class="container-fluid">
            <div class="row">
                <aside class="col-3">
                    <p>aside</p>
                </aside>
                <main class="col-9">
                    <p>main</p>

                </main>
            </div>
        </div>


        <?php include ('footer.php'); ?>
    </div>


</body>
</html>
