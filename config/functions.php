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
	$req =$bdd->prepare('UPDATE comments SET priorityCom = 1 WHERE idComment = ?');
	$req->execute(array($idComment));
	$req->closeCursor();
}