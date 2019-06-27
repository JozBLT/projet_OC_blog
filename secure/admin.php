<?php

require_once('../config/functions.php');

if(isset($_GET['id']) AND !empty($_GET['id'])) 
{
	extract($_GET);
	$id = strip_tags($id);
	$edit = getOneChapter($id);
}

if (!empty($_POST))
{
	extract($_POST);
	$errors = array();

	$chapterName = strip_tags($chapterName);
	$chapterText = strip_tags($chapterText);

	if (empty($chapterName))
		array_push($errors, 'Vous avez oublié de préciser le titre du chapitre !');

	if (empty($chapterText))
		array_push($errors, 'Votre chapitre est vide ?');

	if (count($errors) == 0)
	{
		$chapterText = addChapter($chapterName, $chapterText);

		$success = 'Votre chapitre a bien été publié !!';

		unset($chapterName);
		unset($chapterText);
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="Js/jquery.wysibb.min.js"></script>
        <script src="Js/fr.js"></script>
        <link rel="stylesheet" href="wbbtheme.css">
        <script>
			$(function() {
				var wbbOpt = {
				buttons: "bold,|,italic,|,underline",
				lang: "fr"
				}
			  $("#chapterText").wysibb(wbbOpt);
			})
		</script>
		<title>ADMIN</title>
	</head>

	<body>

		<?php include('headerAdmin.php'); ?>

		<section>

			<div id="write">
				<?php
				if (isset($success))
					echo $success;

				if (!empty($errors)):?>

					<?php foreach($errors as $error): ?>
						<p><?= $error ?></p>
					<?php endforeach; ?>

				<?php endif; ?>

				<form method="post">
					<p>
						<label for="chapterName">Titre :</label><br/>
						<input type="text" name="chapterName" id="chapterName" value="<?php if(isset($chapterName)) 
																							{
																								echo $chapterName;
																							}
																							else if(isset($edit))
																							{
																								echo $edit->chapterName; 
																							}
																							?>
						"/>
					</p>
					<p>
						<label for="chapterText">Chapitre :</label><br/>
						<textarea name="chapterText" id="chapterText" cols="30" rows="8" ><?php if(isset($chapterText))
																								{
																									echo $chapterText;
																								}
																								else if(isset($edit))
																								{
																									echo $edit->chapterText;
																								}
																								?>
							
						</textarea>
					</p>
					<button type="submit">Envoyer</button>
				</form>
			</div>

		</section>
	</body>
	
</html>