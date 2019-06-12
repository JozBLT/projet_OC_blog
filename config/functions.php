<?php

// fonction pour récupérer le titre et la date des chapitres par ordre décroissant
function getChaptersInfoDesc()
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT id, chapterName, chapterDate FROM chapters ORDER BY id DESC');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}

// fonction pour récupérer le titre et la date des chapitres par ordre croissant
function getChaptersInfo()
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT id, chapterName, chapterDate FROM chapters ORDER BY id');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}

// fonction qui récupère un chapitre grâce à son id
function getOneChapter($id)
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM chapters WHERE id = ?');
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
}

// fonction pour insérer un commentaire dans la BDD
function addComment($chapterId, $author, $comment)
{
	require('config/connect.php');
	$req = $bdd->prepare('INSERT into comments (chapterId, author, comment, date) VALUES (?, ?, ?, NOW())');
	$req->execute(array($chapterId, $author, $comment));
	$req->closeCursor();
}

// fonction qui récupère les commentaires d'un chapitre
function getComments($id)
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM comments WHERE chapterId = ?');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}