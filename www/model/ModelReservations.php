<?php

// Projet: TPI
// Script: Modèle Reservation.php
// Description: Classe de gestions de la table Reservation 
// Auteur: Loïc Burnand
// Version 1.0 PC 9.5.2019 / Codage initial


class ModelReservations
{
    /**
	 * @brief Retourne le tableau des reservations de type EReservation
	 * @return [array of EReservation] Le tableau de EReservation
	 */
    static function GetAllReservations()
    {
        // On crée un tableau qui va contenir les objets EReservation
		$arr = array();

		$s = "SELECT `IdCourt`, `Nickname`, `Date` FROM `tpi`.`RESERVATIONS`";
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
			// On crée l'objet EReservation en l'initialisant avec les données provenant
			// de la base de données
			$u = new EReservation(ModelCourts::GetCourtById($row['IdCourt']), ModelUsers::GetUserByNickname($row['Nickname']), $row['Date']);
			// On place l'objet EReservation créé dans le tableau
			array_push($arr, $u);
		}        
		// On retourne le tableau contenant les utilisateurs sous forme EReservation
		return $arr;
    }


    /**
     * @brief Retourne un tableau de EReservation qui ont lieu à la date donnée
     * @param date      La date des reservations que l'on souhaite récupérer
     * @return [array of EReservation] Le tableau de EReservation
     */
    static function GetReservationsForADate($date)
    {
         // On crée un tableau qui va contenir les objets EReservation
        $arr = array();
        
        $s = "SELECT `IdCourt`, `Nickname`, `Date` FROM `tpi`.`reservations` WHERE `Date` between :e and :en ";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => $date, ':en' => $date . ' 23:59:59'));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		// On parcoure les enregistrements 
		if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			// On crée l'objet EReservation en l'initialisant avec les données provenant
			// de la base de données
            $u = new EReservation(ModelCourts::GetCourtById($row['IdCourt']), ModelUsers::GetUserByNickname($row['Nickname']), $row['Date']);
            // On place l'objet EReservation créé dans le tableau
            array_push($arr, $u);
		}
		// On retourne le tableau contenant les utilisateurs sous forme EReservation
		return $arr;
    }

    /**
	 * @brief Cherche les reservations pour un utilisateur 
	 * @param User	L'utilisateur (le nickname est obligatoire) a recherché dans la base de donnée
	 * @return [EReservation] Retourne les réservations du résultat de la requête
	 */
	static function GetReservationsByUser($User)
	{
        // On crée un tableau qui va contenir les objets EReservation
        $arr = array();
    
        $s = "SELECT `IdCourt`, `Nickname`, `Date` FROM `tpi`.`RESERVATIONS` WHERE `Nickname` = :e";
    
        $statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        try {
            $statement->execute(array(':e' => $User->Nickname));
        }
        catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: '.$e->getMessage();
            return false;
        }
        // On parcoure les enregistrements 
        if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
            // On crée l'objet EReservation en l'initialisant avec les données provenant
            // de la base de données
            $u = new EReservation(ModelCourts::GetCourtById($row['IdCourt']), ModelUsers::GetUserByNickname($row['Nickname']), $row['Date']);
            // On place l'objet EReservation créé dans le tableau
            array_push($arr, $u);
        }
        // On retourne le tableau contenant les utilisateurs sous forme EReservation
        return $arr;
    }
    
    /**
	 * @brief Cherche les reservations pour un court 
	 * @param Court	Le court (l'id est obligatoire) a recherché dans la base de donnée
	 * @return [EReservation] Retourne les réservations du résultat de la requête
	 */
	static function GetReservationsByCourt($Court)
	{
        // On crée un tableau qui va contenir les objets EReservation
        $arr = array();
    
        $s = "SELECT `IdCourt`, `Nickname`, `Date` FROM `tpi`.`RESERVATIONS` WHERE `IdCourt` = :e";
    
        $statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        try {
            $statement->execute(array(':e' => $Court->Id));
        }
        catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: '.$e->getMessage();
            return false;
        }
        // On parcoure les enregistrements 
        if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
            // On crée l'objet EReservation en l'initialisant avec les données provenant
            // de la base de données
            $u = new EReservation(ModelCourts::GetCourtById($row['IdCourt']), ModelUsers::GetUserByNickname($row['Nickname']), $row['Date']);
            // On place l'objet EReservation créé dans le tableau
            array_push($arr, $u);
        }
        // On retourne le tableau contenant les utilisateurs sous forme EReservation
        return $arr;
    }


    /**
	 * @brief Supprime une reservation  
	 * @param Reservation	(EReservation) La reservation a supprimer
	 * @return [bool] Retourne true si la suppression est réussie, sinon retourne false
	 */
    static function DeleteReservation($Reservation)
    {
        $s = "DELETE FROM `TPI`.`RESERVATIONS` WHERE `IdCourt` = :ic AND `Nickname` = :nc AND `Date` = :d";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':ic' => $Reservation->Court->Id, ':nc' => $Reservation->User->Nickname, ':d' => $Reservation->Date));
		}
		catch (PDOException $e) {
			echo 'Problème de mise à jour dans la base de données: '.$e->getMessage();
			return false;
		}
		// Ok
		return true;
    }

   /**
	 * @brief Ajoute une réservation dans la base de donnée
	 * @param Reservation la réservation a ajouté sous forme de EReservation
	 * @return [bool] Retourne true si l'ajout est réussi, sinon retourne false
	 */
	static function AddReservation($Reservation)
	{
		$s = "INSERT INTO `tpi`.`reservations`(`IdCourt`, `Nickname`, `Date`) VALUES (:ic, :nc, :d);";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':ic' => $Reservation->Court->Id, ':nc' => $Reservation->User->Nickname, ':d' => $Reservation->Date));
		}
		catch (PDOException $e) {
			echo 'Problème d\'insertion dans la base de données: '. $e->getMessage();
			return false;
		}
		return true;
	}


	static function GetReservationsForAWeek($dateBeginWeek)
	{
		
	}


}
