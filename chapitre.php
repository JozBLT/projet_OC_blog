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

	$chapter = getOneChapter($id);
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
		<title><?= $chapter->chapter_name ?></title>
	</head>

	<body>

		<?php include('header.php'); ?>

		<section>
			<h1><?= $chapter->chapter_name ?></h1>
			<p><?= $chapter->chapter_text ?></p><br/>
			<time><?= $chapter->chapter_date ?></time>
			<hr />

			<?php
			if (isset($success))
				echo $success;

			if (!empty($errors)):?>

				<?php foreach($errors as $error): ?>
					<p><?= $error ?></p>
				<?php endforeach; ?>

			<?php endif; ?>

			<form action="chapitre.php?id=<?= $chapter->id ?>" method="post">
				<p>
					<label for="author">Pseudo :</label><br/>
					<input type="text" name="author" id="author" />
				</p>
				<p>
					<label for="comment">Commentaire :</label><br/>
					<textarea name="comment" id="comment" cols="30" rows="8"></textarea>
				</p>
				<button type="submit">Envoyer</button>
			</form>

		</section>
	</body>
	
</html>