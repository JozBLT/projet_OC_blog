<?php
require_once('config/functions.php');

$chapters = getChapters();
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

        <header>
            <div id="home">
                <a href="index.html"><h1>BILLET SIMPLE POUR L'ALASKA</h1></a>
            </div>
                
            <nav>
                <li>
                    <ul><a href="index.php"><i class="fas fa-home"></i></a></ul>
                    <ul><a href="index.php?action=all_chapters">Chapitres</a></ul>
                    <ul><a href="index.php?action=about">About</a></ul>
                    <ul><a href="index.php?action=contact">Contact</a></ul>
                </li>
            </nav>
        </header>

        <div id="banner">
            <img src="images/alaska.jpg" alt="bannière du site" />
        </div>

        <section>

            <?php foreach($chapters as $value): ?>
                <h2><?= $value->chapter_name ?></h2>
            <a href="chapitre.php?id=<?= $value->id ?>">Lire la suite</a>
            <?php endforeach; ?>
            
        </section>

    </body>

    <footer>
        
    </footer>
</html>