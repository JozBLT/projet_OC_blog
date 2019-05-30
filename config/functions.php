<? php

// fonctions pour récupérer tous les chapitres

function getChapters()
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT id, chapter_name FROM chapters ORDER BY id DESC');
	$req->execute();
	$data = $req->fetchALL(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
?>