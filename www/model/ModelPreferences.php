<?php 
// Projet: TPI
// Script: Modèle ModelPreferences.php
// Description: Classe de gestions de la table Preferences 
// Auteur: Loïc Burnand
// Version 1.0 PC 13.5.2019 / Codage initial

class ModelPreferences
{
    /**
	 * @brief Retourne un objet EPreferences contenant les préférences
	 * @return [EPreferences] Les préférences dans un objet
	 */
    static function GetPreferences()
    {
        // On créer la requête
		$s = "SELECT `Updated`, `BeginTime`, `EndTime`, `NbReservationsByUser` FROM `tpi`.`Preferences`";
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
			// On crée l'objet EPreferences en l'initialisant avec les données provenant
            // de la base de données et on le retourne
			return new EPreference($row['BeginTime'], $row['EndTime'], $row['NbReservationsByUser']);
		}        
		// On retourne null si aucun enregistrement n'a été trouvé
		return $null;
    }

    /**
	 * @brief Permet de metter à jours les préférences
	 * @param Preferences Les nouvelles préférences dans un objet EPreference
	 * @return [bool] Retourne true si l'update est réussi, sinon retourne false
	 */
    static function UpdatePreferences($Preferences)
    {
        $s = "UPDATE `tpi`.`PREFERENCES` SET `Updated` = now(), `BeginTime` = :bt, `EndTime` = :et, `NbReservationsByUser` = :ru WHERE `Updated` != now()";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':bt' => $Preferences->BeginTime, ':et' => $Preferences->EndTime, ':ru' => $Preferences->NbReservation));
		}
		catch (PDOException $e) {
			echo 'Problème de mise à jour dans la base de données: '.$e->getMessage();
			return false;
		}
		// Ok
		return true;
	}
	
	/**
	 * @brief Retourne le débuts des horaires d'ouvertur dans le format "H"
	 * @return [string] Retourne le début des horaires d'ouverture
	 */
	static function GetBeginTime()
	{
		$Preferences = ModelPreferences::GetPreferences();
		$BeginTime = $Preferences->BeginTime;
		$BeginTime = strtotime($BeginTime);
		return date('H', $BeginTime);
	}

	/**
	 * @brief Retourne la fin des horaires d'ouverture dans le format "H"
	 * @return [string] Retourne la fin des horaires d'ouverture
	 */
	static function GetEndTime()
	{
		$Preferences = ModelPreferences::GetPreferences();
		$EndTime = $Preferences->EndTime;
		$EndTime = strtotime($EndTime);
		return date('H', $EndTime);
	}
}