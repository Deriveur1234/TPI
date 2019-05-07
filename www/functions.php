<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/EUser.php';

/**
 * @brief Retourne le tableau des utilisateurs de type EUser
 * @return [array of EUser] Le tableau de EUser
 */
function GetAllUsers()
{
	// On crée un tableau qui va contenir les objets EUser
	$arr = array();

    $s = "SELECT `EMAIL`, `NICKNAME`, `NAME` FROM `USERS`";
	$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	try {
		$statement->execute();
	}
	catch (PDOException $e) {
        echo 'Problème de lecture de la base de données: '.$e->getMessage();
		return false;
	}
	// On parcoure les enregistrements 
	while ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
		// On crée l'objet EUser en l'initialisant avec les données provenant
		// de la base de données
		$u = new EUser($row['EMAIL'], $row['NICKNAME'], $row['NAME']);
		// On place l'objet EUser créé dans le tableau
		array_push($arr, $u);
	}        
	// On retourne le tableau contenant les utilisateurs sous forme EUser
	return $arr;
}

function GetUserByEmail($email)
{
	$s = "SELECT `EMAIL`, `NICKNAME`, `NAME` FROM `USERS` WHERE `EMAIL` = :e";
	
	$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	try {
		$statement->execute(array(':e' => $email));
	}
	catch (PDOException $e) {
        echo 'Problème de lecture de la base de données: '.$e->getMessage();
		return false;
	}
	// On parcoure les enregistrements 
	if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
		// On crée l'objet EUser en l'initialisant avec les données provenant
		// de la base de données et on le retourne 
		return $u = new EUser($row['EMAIL'], $row['NICKNAME'], $row['NAME']);
	}
	// On retourne null si il n'y a pas d'utilisateur
	return null;
}

function AddUser($user)
{
	$s = "INSERT INTO cfpt.users(EMAIL, NICKNAME, NAME) VALUES (:e, :nc, :na);";
	$statement = EDatabase::prepare($s);
	try {
		$statement->execute(array(':e' => $user->Email, ':nc' => $user->Nickname, 'na' => $user->Name));
	}
	catch (PDOException $e) {
        echo 'Problème d\'insertion dans la base de données: '.$e->getMessage();
		return false;
	}
	return true;
}

function UpdateUser($user)
{

}
?>
