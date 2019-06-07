<?php

if (!isset($_GET['id']) OR !is_numeric($_GET['id']))
	header('location: index.php');
else
{
	extract($_GET);
	$id = strip_tags($id);

	require_once('config/functions.php');

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

			<form action="chapitre.php?id=<?= $chapter->id ?>" methode="post">
				<p>
					<label for="author">Pseudo :</label><br/>
					<input type="text" name="author" id="author" />
				</p>
				<p>
					<label for="comment">Commentaire</label><br/>
					<textarea name="comment" id="comment" cols="30" rows="8"></textarea>
				</p>
			</form>

		</section>
	</body>
	
</html>