<?php 
// Projet: TPI
// Script: Modèle users.php
// Description: Classe de gestions de la table users 
// Auteur: Loïc Burnand
// Version 1.0 PC 13.5.2019 / Codage initial

class ModelCourts
{
    /**
	 * @brief Retourne le tableau des utilisateurs de type ECourt
	 * @return [array of ECourt] Le tableau de ECourt
	 */
    static function GetAllCourts()
    {
        // On crée un tableau qui va contenir les objets ECourt
		$arr = array();

		$s = "SELECT `IdCourt`, `Name`, `Desc`, `Deleted` FROM `tpi`.`COURTS`";
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
			// On crée l'objet ECourt en l'initialisant avec les données provenant
			// de la base de données
			$u = new ECourt($row['IdCourt'], $row['Name'], $row['Desc'], $row['Deleted']);
			// On place l'objet ECourt créé dans le tableau
			array_push($arr, $u);
		}        
		// On retourne le tableau contenant les courts sous forme ECourt
		return $arr;
    }

    	/**
	 * @brief Cherche un court par son Id dans la table 
	 * @param Id	    L'id a recherché dans la base de donnée
	 * @return [ECourt] Retourne le premier Court du résultat de la requête
	 */
	static function GetCourtById($Id)
	{
		$s = "SELECT `IdCourt`, `Name`, `Desc`, `Deleted` FROM `tpi`.`COURTS` WHERE `IdCourt` = :e";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => $Id));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		// On parcoure les enregistrements 
		if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			// On crée l'objet ECourt en l'initialisant avec les données provenant
			// de la base de données et on le retourne 
			return new ECourt($row['IdCourt'], $row['Name'], $row['Desc'], $row['Deleted']);
		}
		// On retourne null si il n'y a pas de court
		return null;
	}

    /**
	 * @brief Ajoute un court dans la base de donnée
	 * @param Court le court a ajouté sous forme de ECourt
	 * @return [bool] Retourne true si l'ajout est réussi, sinon retourne false
	 */
	static function AddCourt($Court)
	{
		$s = "INSERT INTO `tpi`.`courts`(`Name`, `Desc`, `Deleted`) VALUES (:na, :dc, :de);";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':na' => $Court->Name, ':dc' => $Court->Desc, ':de' => (int)$Court->Deleted));
		}
		catch (PDOException $e) {
			echo 'Problème d\'insertion dans la base de données: '. $e->getMessage();
			return false;
		}
		return true;
    }
    
    /**
	 * @brief Permet de metter à jours les donnée d'un court
	 * @param Court     le court que l'on souhaite modifié
	 * @return [bool]   Retourne true si l'update est réussi, sinon retourne false
	 */
	static function UpdateCourt($Court)
	{
		$s = "UPDATE `TPI`.`COURTS` SET `Name` = :na, `Desc` = :dc, `Deleted` = :de WHERE `IdCourt` = :id";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':id' => $Court->Id, ':na' => $Court->Name, ':dc' => $Court->Desc, ':de' => (int)$Court->Deleted));
		}
		catch (PDOException $e) {
			echo 'Problème de mise à jour dans la base de données: '.$e->getMessage();
			return false;
		}
		// Ok
		return true;
    }
    
    /**
     ********* A FAIRE ***********
     */
    static function DeleteCourt($Court)
    {

    }
}