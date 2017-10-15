<?php $dossier = opendir('./'); ?>
<?php while(false !== ($fichier = readdir($dossier))) : ?>
    <a style="color:white" href="<?= $fichier ?>"><?= $fichier ?></a><br>
<?php endwhile; ?>
