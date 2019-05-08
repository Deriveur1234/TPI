<?php

// Projet: TPI
// Script: Modèle users.php
// Description: Classe de gestions de la table users 
// Auteur: Loïc Burnand
// Version 1.0 PC 9.5.2019 / Codage initial

/**
 * @remark Mettre le bon chemin d'accès à votre fichier contenant les constantes
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ERole.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ECourt.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EReservation.php';

class Users
{
	/**
	 * @brief Retourne le tableau des utilisateurs de type EUser
	 * @return [array of EUser] Le tableau de EUser
	 */
	function GetAllUsers()
	{
		// On crée un tableau qui va contenir les objets EUser
		$arr = array();

		$s = "SELECT `Nickname`, `Name`, `Firstname`, `Phone`, `email`, `IsConfirmed`, `IdRole` FROM `tpi`.`USER`";
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
			$u = new EUser($row['Nickname'], $row['Name'], $row['Firstname'], $row['Phone'], $row['email'], $row['IsConfirmed'], new ERole($row['IdRole']));
			// On place l'objet EUser créé dans le tableau
			array_push($arr, $u);
		}        
		// On retourne le tableau contenant les utilisateurs sous forme EUser
		return $arr;
	}

	function GetUserById(int $Id)
	{
		
	}
}



