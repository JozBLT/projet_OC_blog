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

                <div class="preview">
                    <a href="chapitre.php?id=<?= $chapter->idChapter ?>">

                        <h2><?= $chapter->chapterName ?></h2>

                        <p>
                            <?php
                                $textePropre = $chapter->chapterText;
                                $conv = array(
                                    //tableau des symboles à convertir
                                    '\[b\](.*?)\[\/b\]' => '<strong>$1</strong>',
                                    '\[i\](.*?)\[\/i\]' => '<em>$1</em>',
                                    '\[u\](.*?)\[\/u\]' => '<u>$1</u>'
                                );
                                foreach($conv as $o=>$c) 
                                {
                                    $textePropre = preg_replace('/'.$o.'/',$c, $textePropre);
                                }
                                $textePropre = nl2br($textePropre);
                                echo $textPreview = substr($textePropre, 0, 500);
                            ?> ...
                        </p><br/>

                        <time><span>Chapitre publié le :</span>  <?= $chapter->chapterDate ?>     |</time>

                        <?php
    					$dateEdit = $chapter->dateEdit;
    					if ($dateEdit !== NULL)
    						echo '<time><span>Édité le :</span>   '.$dateEdit.'</time><br/>';
    					?>

                        <p>
                            <?php
                            $id = $chapter->idChapter;
                            $nbComments = getComments($id);
                            echo 'Ce chapitre a été commenté : '.count($nbComments).' fois'
                            ?>
                        </p>

                    </a>
                </div>
                
            <?php endforeach; ?>
            
        </section>

    </body>

</html>