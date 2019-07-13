<?php

if (!isset($_GET['id']) OR !is_numeric($_GET['id']))
	header('location: index.php');
else
{
	extract($_GET);
	$id = strip_tags($id);

	require_once('config/functions.php');

	if (!empty($_POST))
	{
		extract($_POST);
		$errors = array();

		$author = strip_tags($author);
		$comment = strip_tags($comment);

		if (empty($author))
			array_push($errors, 'Veuillez préciser un pseudo');

		if (empty($comment))
			array_push($errors, 'Veuillez entrer un commentaire');

		if (count($errors) == 0)
		{
			$comment = addComment($id, $author, $comment);

			$success = 'Votre commentaire a bien été publié';

			unset($author);
			unset($comment);
		}
	}

	if(isset($_GET['report']) AND !empty($_GET['report'])) 
	{
		extract($_GET);
		$idComment = strip_tags($report);
		$report = reportComment($idComment);
	}

	$chapter = getOneChapter($id);
	$comments = getComments($id);
}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<title><?= $chapter->chapterName ?></title>
	</head>

	<body>

		<?php include('header.php'); ?>

		<section>
			<div class="preview">
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
						foreach($conv as $o=>$c) {
							$textePropre = preg_replace('/'.$o.'/',$c, $textePropre);
						}
						$textePropre = nl2br($textePropre);
						echo $textePropre;
					?>	
				</p><br/>
				<time>Chapitre publié le : <?= $chapter->chapterDate ?></time>
			</div>

			<div id="comment">
				<?php
				if (isset($success))
					echo $success;

				if (!empty($errors)):?>

					<?php foreach($errors as $error): ?>
						<p><?= $error ?></p>
					<?php endforeach; ?>

				<?php endif; ?>

				<h2>Commenter ce chapitre :</h2>

				<form action="chapitre.php?id=<?= $chapter->idChapter ?>" method="post">
					<p>
						<label for="author">Pseudo :</label><br/>
						<input type="text" name="author" id="author" value="<?php if(isset($author)) echo $author ?>" />
					</p>
					<p>
						<label for="comment">Commentaire :</label><br/>
						<input type="text" name="comment" id="comment" cols="30" rows="8" value="<?php if(isset($comment)) echo $comment ?>" />
					</p>
					<button type="submit">Envoyer</button>
				</form>
			</div>
			
			<div id="comments">
				<h2>Commentaires</h2>

				<?php foreach($comments as $com): ?>
					<h3><?= $com->author ?></h3>
					<p><?= $com->comment ?></p>
					<div class="under">
						<time><?= $com->date ?></time> 
						<a href="chapitre.php?id=<?= $chapter->idChapter ?>&report=<?= $com->idComment ?>">Signaler</a><!-- Ajouter un champ VALIDÉ -->
					</div>
					<p><?php
						$reported = $com->report;
						if ($reported == 1) {
							echo "commentaire signalé";
						};
					?></p>
					<hr/>
				<?php endforeach; ?>
			</div>
			
		</section>
	</body>
	
</html>