<?php

// Projet: TPI
// Script: Modèle roles.php
// Description: Classe de gestions de la table roles 
// Auteur: Loïc Burnand
// Version 1.0 PC 9.5.2019 / Codage initial


class ModelRoles
{
    /**
	 * @brief Retourne le tableau des roles de type ERole
	 * @return [array of ERole] Le tableau de ERole
	 */
    static function GetAllRoles()
    {
        // On crée un tableau qui va contenir les objets ERole
		$arr = array();

		$s = "SELECT `Code`, `Label` FROM `tpi`.`ROLES`";
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
			// On crée l'objet ERole en l'initialisant avec les données provenant
			// de la base de données
			$u = new ERole($row['Code'], $row['Label']);
			// On place l'objet ERole créé dans le tableau
			array_push($arr, $u);
		}        
		// On retourne le tableau contenant les utilisateurs sous forme EUser
		return $arr;
    }

    /**
	 * @brief Chercher un role par son Code dans la table 
	 * @param Code	Le code a recherché dans la base de donnée
	 * @return [ERole] Retourne le premier rôle du résultat de la requête
	 */
    static function GetRoleByCode($Code)
    {
        $s = "SELECT `Code`, `Label` FROM `tpi`.`ROLES` WHERE `Code` = :e";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => $Code));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		// On parcoure les enregistrements 
		if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			// On crée l'objet ERole en l'initialisant avec les données provenant
			// de la base de données et on le retourne 
			return new ERole($row['Code'], $row['Label']);
		}
		// On retourne null si il n'y a pas de role
		return null;
    }
}

