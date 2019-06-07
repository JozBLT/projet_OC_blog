<?php

// fonction pour récupérer le titre et l'id es chapitres
function getChaptersInfo()
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT id, chapter_name, chapter_date FROM chapters ORDER BY id DESC');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}

// fonction qui récupère un article
function getOneChapter($id)
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM chapters WHERE id = ?');
	$req->execute(array($id));
	if($req->rowcount() == 1)
	{
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data;
	}
	else
	{
		header('location: index.php');
	}
}