<?php
require_once('config/functions.php');

$chapters = getChaptersInfo();
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

            <?php foreach($chapters as $value): ?>
                <h2><?= $value->chapter_name ?></h2>
                <time><?= $value->chapter_date ?></time><br/>
            	<a href="chapitre.php?id=<?= $value->id ?>">Lire la suite</a>
            	<hr />
            <?php endforeach; ?>
            
        </section>

    </body>

    <footer>
        
    </footer>
</html>