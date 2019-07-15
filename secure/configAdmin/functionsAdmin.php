<?php


// fonction pour récupérer le titre et la date des chapitres par ordre croissant
function getChaptersInfo()
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM chapters ORDER BY idChapter');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}

// fonction qui récupère un chapitre grâce à son id
function getOneChapter($id)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM chapters WHERE idChapter = ?');
	$req->execute(array($id));
	if ($req->rowcount() == 1)
	{
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data;
	}
	else
	{
		header('location: admin.php');
	}
	$req->closeCursor();
}

// fonction pour insérer un chapitre dans la BDD (ADMIN)
function addChapter($chapterName, $chapterText)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT into chapters (chapterName, chapterText, chapterDate) VALUES (?,?,NOW())');
	$req->execute(array($chapterName, $chapterText));
	$req->closeCursor();
	header('location: allChaptersAdmin.php');
}

// fonction pour supprimer un chapitre (ADMIN)
function deleteChapter($idChapter)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM chapters WHERE idChapter = ?');
	$req->execute(array($idChapter));
	$req = $bdd->prepare('DELETE FROM comments WHERE chapterId = ?');
	$req->execute(array($idChapter));
	$req->closeCursor();
	header('location: allChaptersAdmin.php');
}

// fonction pour éditer un chapitre (ADMIN)
function updateChapter($chapterName, $chapterText,$idChapter)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE chapters SET chapterName = ?, chapterText = ?, dateEdit = NOW() WHERE idChapter = ?');
	$req->execute(array($chapterName, $chapterText,$idChapter));
	$req->closeCursor();
	header('location: allChaptersAdmin.php');
}
















// fonction pour insérer un commentaire en temps qu'admin dans la BDD (ADMIN)
function addCommentAdmin($chapterId, $comment)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT into comments (chapterId, author, comment, priorityCom, date) VALUES (?, "Jean Forteroche", ?, 3, NOW())');
	$req->execute(array($chapterId, $comment));
	$req->closeCursor();
}

// fonction qui récupère les commentaires d'un chapitre
function getComments($id)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM comments WHERE chapterId = ? ORDER BY date DESC');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}

// fonction pour enlever le signalement d'un commentaire (ADMIN)
function validComment($idComment)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE comments SET priorityCom = 2 WHERE idComment = ?');
	$req->execute(array($idComment));
	$req->closeCursor();
}

// fonction pour supprimer un commentaire innadapté (ADMIN)
function deleteComment($idComment)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM comments WHERE idComment = ?');
	$req->execute(array($idComment));
	$req->closeCursor();
}









// fonction boutons chapitres (ADMIN)
function getButtonsChap()
{
	$btnChap = '';
	$btnCp = array(
	
		1=>'éditer',
		2=>'supprimer',

	);

	while (list($h,$p)=each($btnCp)) 
	{
		$btnChap.='<input type="submit" value="'.$p.'" name="btnCp_'.$h.'"  class="button" id="btnCp_'.$h.'"/>';
	}
	return $btnChap;
}


//fonction boutons commentaires (ADMIN)
function getButtonsCom()
{
	$btnCom = '';
	$btnCm = array(
	
		1=>'Valider',
		2=>'Supprimer',

	);
	
	while (list($o,$m)=each($btnCm)) 
	{
		$btnCom.='<input type="submit" value="'.$m.'" name="btnCm_'.$o.'" class="button" id="btnCm_'.$o.'"/>';
	}
	return $btnCom;
}
