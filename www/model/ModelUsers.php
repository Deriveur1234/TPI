<?php

// Projet: TPI
// Script: Modèle users.php
// Description: Classe de gestions de la table users 
// Auteur: Loïc Burnand
// Version 1.0 PC 9.5.2019 / Codage initial


class ModelUsers
{
	/**
	 * @brief Retourne le tableau des utilisateurs de type EUser
	 * @return [array of EUser] Le tableau de EUser
	 */
	static function GetAllUsers()
	{
		// On crée un tableau qui va contenir les objets EUser
		$arr = array();

		$s = "SELECT `Nickname`, `Name`, `Firstname`, `Phone`, `email`, `IsConfirmed`, `CodeRole` FROM `tpi`.`USERS`";
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
			$u = new EUser($row['email'], $row['Nickname'], $row['Name'], $row['Firstname'], $row['Phone'], new ERole($row['CodeRole']), $row['IsConfirmed']);
			// On place l'objet EUser créé dans le tableau
			array_push($arr, $u);
		}        
		// On retourne le tableau contenant les utilisateurs sous forme EUser
		return $arr;
	}

	/**
	 * @brief Cherche un utilisateur par son Id dans la table 
	 * @param nickname	Le nickname a recherché dans la base de donnée
	 * @return [EUser] Retourne le premier utilisateur du résultat de la requête
	 */
	static function GetUserByNickname($nickname)
	{
		$s = "SELECT `Nickname`, `Name`, `Firstname`, `Phone`, `email`, `IsConfirmed`, `CodeRole` FROM `tpi`.`USERS` WHERE `Nickname` = :e";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => $nickname));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		// On parcoure les enregistrements 
		if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			// On crée l'objet EUser en l'initialisant avec les données provenant
			// de la base de données et on le retourne 
			return new EUser($row['email'], $row['Nickname'], $row['Name'], $row['Firstname'], $row['Phone'], ModelRoles::GetRoleByCode($row['CodeRole']), $row['IsConfirmed']);
		}
		// On retourne null si il n'y a pas d'utilisateur
		return null;
	}

	/**
	 * @brief Ajoute un utilisateur dans la base de donnée
	 * @param User l'utilisateur a ajouté sous forme de EUser
	 * @return [bool] Retourne true si l'ajout est réussi, sinon retourne false
	 */
	static function AddUser($user)
	{
		if($user->Role == null)
			$user->Role = new ERole(2);
		$s = "INSERT INTO `tpi`.`users`(`Nickname`, `Name`, `Firstname`, `Password`, `Phone`, `email`, `IsConfirmed`, `CodeRole`) VALUES (:nc, :na, :fn, :pw , :ph, :e, 0, :cr);";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':nc' => $user->Nickname, ':na' => $user->Name, ':fn' => $user->FirstName, ':pw' => $user->Password, ':ph' => $user->Phone, ':e' => $user->Email, ':cr' => $user->Role->CodeRole ));
		}
		catch (PDOException $e) {
			echo 'Problème d\'insertion dans la base de données: '. $e->getMessage();
			return false;
		}
		return ModelTokens::CreateToken($user->Nickname);
	}

	/**
	 * @brief Permet de metter à jours les donnée d'un utilisateur
	 * @param User l'utilisateur que l'on souhaite modifié
	 * @return [bool] Retourne true si l'update est réussi, sinon retourne false
	 */
	static function UpdateUser($user)
	{
		$s = "UPDATE `TPI`.`USERS` SET `Name` = :na, `Firstname` = :fn, `Phone` = :ph, `email` = :e, `IsConfirmed` = :ic, `CodeRole` = :cr WHERE `Nickname` = :nc";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':nc' => $user->Nickname, ':na' => $user->Name, ':fn' => $user->FirstName, ':ph' => $user->Phone, ':e' => $user->Email, ':ic' => $user->IsConfirmed, ':cr' => $user->Role->CodeRole ));
		}
		catch (PDOException $e) {
			echo 'Problème de mise à jour dans la base de données: '.$e->getMessage();
			return false;
		}
		// Ok
		return true;
	}

	/**
	 * @brief Retourne le nom du rôle de l'utilisateur
	 * @param User L'utilisateur du quel on souhaite récupérer le rôle
	 * @return [string] Le nom du rôle
	 */
	static function GetUserRole($User)
	{
		if(!isset($User->Role->CodeRole))
		{
			// si le code du role n'est pas renseigné on essaie d'utiliser le
			// nickname pour récupérer toutes les infos sur l'utilisateurs (dont l'id du role)
			if(isset($User->Nickname))
			{
				$User = ModelUsers::GetUserByNickname($User->Nickname);
			}
			else
			{
				return false;
			}
		}
		return ModelRoles::GetRoleByCode($User->Role->CodeRole);
	}

	/**
	 * @brief Retourne si le password et le nickname sont dans la base
	 * @param User De type EUser, doit contenir le nickname et le password
	 * @return [bool] Retourne true si l'utilisateur et le password corréspondent
	 */
	static function CheckLogin($User)
	{
		$s = "SELECT COUNT(*) FROM `tpi`.`USERS` WHERE `Nickname` = :e AND `Password` = :p AND `IsConfirmed` = 1";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => strtolower($User->Nickname), ':p' => $User->Password));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		return ($statement->fetch()["COUNT(*)"] > 0) ? true : false;
	}

	static function UpdateConfirmation($nickname, $isConfirmed)
	{
		$s = "UPDATE `TPI`.`USERS` SET  `IsConfirmed` = :ic WHERE `Nickname` = :nc";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':nc' => $nickname, ':ic' => $isConfirmed ));
		}
		catch (PDOException $e) {
			echo 'Problème de mise à jour dans la base de données: '.$e->getMessage();
			return false;
		}
		// Ok
		return true;
	}
}



