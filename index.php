<?php

require_once('config/functions.php');

$chapters = getChaptersInfoDesc();
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska</title>
    </head>

    <body>

        <?php include('header.php'); ?>

        <section>

            <?php foreach($chapters as $chapter): ?>
                <h2><?= $chapter->chapterName ?></h2>
                <time><?= $chapter->chapterDate ?></time><br/>
            	<a href="chapitre.php?id=<?= $chapter->id ?>">Lire la suite</a>
            	<hr />
            <?php endforeach; ?>
            
        </section>

    </body>

    <footer>
        
    </footer>
</html>