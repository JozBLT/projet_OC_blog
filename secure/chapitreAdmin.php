<?php

if (!isset($_GET['id']) OR !is_numeric($_GET['id']))
	header('location: admin.php');
else
{
	extract($_GET);
	$id = strip_tags($id);

	require_once('../config/functions.php');

	$chapter = getOneChapter($id);
	$comments = getComments($id);
}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<title><?= $chapter->chapterName ?></title>
	</head>

	<body>

		<?php include('headerAdmin.php'); ?>

		<section>
			<h1><?= $chapter->chapterName ?></h1>
			<p>	
				<?php
					$textePropre = $chapter->chapterText;
					$conv = array(
						//tableau des symboles à convertir
						'\[b\](.*?)\[\/b\]' => '<strong>$1</strong>',
						'\[i\](.*?)\[\/i\]' => '<em>$1</em>',
						'\[u\](.*?)\[\/u\]' => '<u>$1</u>'
					);
					foreach($conv as $o=>$c) {
						$textePropre = preg_replace('/'.$o.'/',$c, $textePropre);
					}
					$textePropre = nl2br($textePropre);
					echo $textePropre;
				?>	
			</p><br/>
			<time><?= $chapter->chapterDate ?></time>
			<hr />

			<h2>Commentaires</h2>

			<?php foreach($comments as $com): ?>
				<h3><?= $com->author ?></h3>
				<p><?= $com->comment ?></p>
				<time><?= $com->date ?></time>
				<p><?php
					$reported = $com->report;
					if ($reported == 1) {
						echo "commentaire signalé";
					};
				?></p>
			<?php endforeach; ?>

		</section>
	</body>
	
</html>