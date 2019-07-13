<?php

// fonction pour récupérer le titre et la date des 3 derniers chapitres par ordre décroissant
function getChaptersInfoDesc()
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM chapters ORDER BY idChapter DESC LIMIT 3');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}

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
		header('location: index.php');
	}
	$req->closeCursor();
}

// fonction pour insérer un chapitre dans la BDD
function addChapter($chapterName, $chapterText)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT into chapters (chapterName, chapterText, chapterDate) VALUES (?,?,NOW())');
	$req->execute(array($chapterName, $chapterText));
	$req->closeCursor();
	header('location: allChaptersAdmin.php');
}

// fonction pour supprimer un chapitre
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

// fonction pour éditer un chapitre
function updateChapter($chapterName, $chapterText,$idChapter)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE chapters SET chapterName = ?, chapterText = ?, dateEdit = NOW() WHERE idChapter = ?');
	$req->execute(array($chapterName, $chapterText,$idChapter));
	$req->closeCursor();
	header('location: allChaptersAdmin.php');
}




//	header('location: chapitreAdmin.php?id='.$var);







// fonction pour insérer un commentaire dans la BDD
function addComment($chapterId, $author, $comment)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT into comments (chapterId, author, comment, date) VALUES (?, ?, ?, NOW())');
	$req->execute(array($chapterId, $author, $comment));
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

// fonction pour signaler un commentaire
function reportComment($idComment)
{
	require('connect.php');
	$req =$bdd->prepare('UPDATE comments SET report = 1 WHERE idComment = ?');
	$req->execute(array($idComment));
	$req->closeCursor();
}

// fonction pour enlever le signalement d'un commentaire
function validComment($idComment)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE comments SET report = 0 WHERE idComment = ?');
	$req->execute(array($idComment));
	$req->closeCursor();
}

// fonction pour supprimer un commentaire innadapté
function deleteComment($idComment)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM comments WHERE idComment = ?');
	$req->execute(array($idComment));
	$req->closeCursor();
}









// fonction boutons chapitres
function getButtonsChap()
{
	$btnChap = '';
	$btnCp = array(
	
		1=>'éditer',
		2=>'supprimer',

	);

	while (list($h,$p)=each($btnCp)) 
	{
		$btnChap.='<input type="submit" value="'.$p.'" name="btnCp_'.$h.'" id="btnCp_'.$h.'"/>';
	}
	return $btnChap;
}


//fonction boutons commentaires
function getButtonsCom()
{
	$btnCom = '';
	$btnCm = array(
	
		1=>'valider',
		2=>'supprimer',

	);
	
	while (list($o,$m)=each($btnCm)) 
	{
		$btnCom.='<input type="submit" value="'.$m.'" name="btnCm_'.$o.'" id="btnCm_'.$o.'"/>';
	}
	return $btnCom;
}


//fonction boutons envoi de chapitre
function getButtonsSend($mode)
{
	$mode;
	$btnSend = '';
	$btnSd = array(
	
		1=>'Envoyer',
		2=>'Éditer',

	);
	
	while (list($s,$d)=each($btnSd)) 
	{
		$btnSend.='<input type="submit" value="'.$d.'" name="btnCm_'.$s.'" id="btnCm_'.$s.'"/>';
	}
	if ($mode == 1) 
	{
		echo '<input type="submit" value="Envoyer" name="btnCm_1" id="btnCm_1"/>';
	}
	else
	{
		return $btnSend;
	}
}