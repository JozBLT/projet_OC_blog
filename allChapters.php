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
		<title>Tous les chapitres</title>
	</head>

	<body>

		<?php include('header.php'); ?>

		<section>

			<div id="previews">

        		<?php foreach($chapters as $chapter): ?>
        			<a class="iconPreview" href="chapitre.php?id=<?= $chapter->idChapter ?>">

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
						 		echo $textPreview = substr($textePropre, 0, 250);
						 	?> ...
						</p><br/>

						<time><?= $chapter->chapterDate ?></time><br/>

						<p>
							<?php
							$id = $chapter->idChapter;
							$nbComments = getComments($id);
						 	echo '<span>Ce chapitre a été commenté : '.count($nbComments).' fois</span>'
						 	?>
						</p>

					</a>
				<?php endforeach; ?>
				
			</div>

		</section>

	</body>
	
</html>