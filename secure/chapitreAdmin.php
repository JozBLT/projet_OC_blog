<?php

if (!isset($_GET['id']) OR !is_numeric($_GET['id']))
	header('location: allChaptersAdmin.php');
else
{
	extract($_GET);
	$id = strip_tags($id);

	require_once('../config/functions.php');

	$chapter = getOneChapter($id);
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


	//édition d'un chapitre
	if (isset($_POST['btnCp_1']))
		header('location: admin.php?id='.$id);
	//suppression d'un chapitre
	if (isset($_POST['btnCp_2']))
	{
		if(isset($_GET['id'])) 
		{
			extract($_GET);
			$idChapter = strip_tags($id);
			$deletedChap = deleteChapter($idChapter);
			echo "Chapitre supprimé";
		}
	}

	//validation d'un commentaire
	if (isset($_POST['btnCm_1']))
	{
		if(isset($_GET['statusCom'])) 
		{
			extract($_GET);
			$idComment = strip_tags($statusCom);
			$statusCom = validComment($idComment);
		}
		echo "Commentaire validé";
	}
	//suppression d'un commentaire
	if (isset($_POST['btnCm_2']))
	{
		if(isset($_GET['statusCom'])) 
		{
			extract($_GET);
			$idComment = strip_tags($statusCom);
			$statusCom = deleteComment($idComment);
		}
		echo "Commentaire supprimé";
	}

	if (!empty($_POST['comment']))
	{
		extract($_POST);
		$comment = strip_tags($comment);

		if (empty($comment))
			$error = 'Ton commentaire est vide Jean..';

		if (!isset($error))
		{
			$comment = addCommentAdmin($id, $comment);

			$success = 'Ton commentaire a bien été publié';
			unset($comment);
		}
	}

	$comments = getComments($id);
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
				<p><?= $textePropre; ?></p><br/>
				<time>Chapitre publié le : <?= $chapter->chapterDate ?></time><br/>
				<?php
				$dateEdit = $chapter->dateEdit;
				if ($dateEdit !== NULL)
					echo '<time>Édité le : '.$dateEdit.'</time><br/>';
				?>
				<hr/>
				<form method="post">
					<div class="buttons_panel">
						<?php echo getButtonsChap(); ?>
					</div>
				</form>
			</div>

			<div id="comment">
				<?php
				if (isset($success))
					echo $success;

				if (isset($error))
					echo $error;
				?>

				<h2>Commenter ce chapitre :</h2>

				<form action="chapitreAdmin.php?id=<?= $chapter->idChapter ?>" method="post">
					<p>
						<label for="comment">Commentaire :</label><br/>
						<input type="text" name="comment" id="comment" cols="30" rows="8" value="<?php if(isset($comment)) echo $comment ?>" />
					</p>
					<button type="submit" class="button" id="send_com">Envoyer</button>
				</form>
			</div>

			<div id="comments">

				<h2>Commentaires</h2>

				<?php foreach($comments as $com): ?>

					<div class="<?php if ($com->priorityCom == 3) echo 'authorCom'; ?>">

						<h3><?= $com->author ?></h3>
						<p><?= $com->comment ?></p>

						<div class="under">
							<time><?= $com->date ?> &nbsp; </time>

							<?php
							if ($com->priorityCom == 1)
								echo "<div class='red'><i class='fas fa-exclamation-triangle'></i>&nbsp; commentaire signalé &nbsp;<i class='fas fa-exclamation-triangle'></i></div>";
							if ($com->priorityCom == 2)
								echo "<div class='green'>commentaire validé &nbsp;<i class='fas fa-thumbs-up'></i></div>";
							?>
						</div><br/>

						<form method="post" action="chapitreAdmin.php?id=<?= $chapter->idChapter ?>&statusCom=<?= $com->idComment ?>" >
							<div class="buttons_panel">
								<?php 
								if ($com->priorityCom == 2 OR $com->priorityCom == 3)
									echo '<input type="submit" value="Supprimer" name="btnCm_2" class="button" id="btnCm_2"/>';
								else echo getButtonsCom(); 
								?>
							</div>
						</form>

					</div>
					<hr/>

				<?php endforeach; ?>

			</div>

		</section>
	</body>
	
</html>