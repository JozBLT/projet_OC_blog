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

	if(isset($_GET['valid']) AND !empty($_GET['valid'])) 
	{
		extract($_GET);
		$idComment = strip_tags($valid);
		$valid = validComment($idComment);
	}

	if(isset($_GET['deleteCom']) AND !empty($_GET['deleteCom'])) 
	{
		extract($_GET);
		$idComment = strip_tags($deleteCom);
		$deleteCom = deleteComment($idComment);
	}

	if(isset($_GET['deleteChap']) AND !empty($_GET['deleteChap'])) 
	{
		extract($_GET);
		$idChapter = strip_tags($deleteChap);
		$deleteChap = deleteChapter($idChapter);
	}
}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleAdmin.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<title><?= $chapter->chapterName ?></title>
	</head>

	<body>

		<?php include('headerAdmin.php'); ?>

		<section>
			<div class="preview">
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
				<time><?= $chapter->chapterDate ?></time><br/>
				<a href="admin.php?id=<?= $chapter->idChapter ?>">Éditer ce chapitre</a>
				<a href="allChaptersAdmin.php?deleteChap=<?= $chapter->idChapter ?>">Supprimer ce chapitre</a>
			</div>

			<div id="comments">
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
					<a href="chapitreAdmin.php?id=<?= $chapter->idChapter ?>&valid=<?= $com->idComment ?>">Valider</a>
					<a href="chapitreAdmin.php?id=<?= $chapter->idChapter ?>&deleteCom=<?= $com->idComment ?>">Supprimer</a>
					<hr/>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<div id="buttons_ panel">
							<?php echo getButtonsCom(); ?>
						</div>
					</form>
				<?php endforeach; ?>
			</div>

		</section>
	</body>
	
</html>