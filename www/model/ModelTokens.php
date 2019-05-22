<?php

// Projet: TPI
// Script: Modèle ModelTokens.php
// Description: Classe de gestions de la table Tokens 
// Auteur: Loïc Burnand
// Version 1.0 PC 13.5.2019 / Codage initial


class ModelTokens
{
    /**
	 * @brief Cherche un Token par son nickname dans la table 
	 * @param nickname	Le nickname a recherché dans la base de donnée
	 * @return [EToken] Retourne le premier token du résultat de la requête
	 */
	static function GetTokenByNickname($nickname)
	{
		$s = "SELECT `Nickname`, `ValidateTill`, `Code` FROM `tpi`.`TOKENS` WHERE `Nickname` = :e";
	
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
			// On crée l'objet EToken en l'initialisant avec les données provenant
			// de la base de données et on le retourne 
			return new EToken($row['Nickname'], $row['ValidateTill'], $row['Code']);
		}
		// On retourne null si il n'y a pas d'utilisateur
		return null;
	}
	
	/**
	 * @brief Cherche un Token par son code dans la table 
	 * @param code	Le code a recherché dans la base de donnée
	 * @return [EToken] Retourne le premier token du résultat de la requête
	 */
	static function GetTokenByCode($code)
	{
		$s = "SELECT `Nickname`, `ValidateTill`, `Code` FROM `tpi`.`TOKENS` WHERE `Code` = :e";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => $code));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		// On parcoure les enregistrements 
		if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			// On crée l'objet EUser en l'initialisant avec les données provenant
			// de la base de données et on le retourne 
			return new EToken($row['Nickname'], $row['ValidateTill'], $row['Code']);
		}
		// On retourne null si il n'y a pas d'utilisateur
		return null;
	}

    
    /**
     * @brief Créer un token et appelle une fonction pour l'insérer en bd
     * @param nickname Le nickname de l'utilisateur possédant le token
     * @return [bool] Retourne true si la création est réussie, sinon retourne false
     */
    static function CreateToken($nickname)
    {
        $token = new EToken($nickname);
        $token->Code = ModelTokens::generateToken();
        return ModelTokens::InsertToken($token);
    }

    /**
	 * @brief Ajoute un token dans la base de donnée
	 * @param Token le token a ajouté sous forme de EToken
	 * @return [bool] Retourne true si l'ajout est réussi, sinon retourne false
	 */
    static function InsertToken($Token)
    {
        $s = "INSERT INTO `tpi`.`tokens`(`Nickname`, `ValidateTill`, `Code`) VALUES (:n, NOW() + INTERVAL 1 DAY, :c);";
		$statement = EDatabase::prepare($s);
		try {
			$statement->execute(array(':n' => $Token->Nickname, ':c' => $Token->Code));
		}
		catch (PDOException $e) {
			echo 'Problème d\'insertion dans la base de données: '. $e->getMessage();
			return false;
		}
		return true;
    }

    /**
     * Generate a random token
     * @param number $len	The token length. Default is 20.
     * @return string	The generated token string.
     */
    static function generateToken($len = 20) {
        $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
        $c = count($keys);
        $token = '';
        for($i=0; $i < $len; $i++) {
            $token .= $keys[mt_rand(0, $c - 1)];
        }
        return $token;
	}

	
	/**
	 * @brief Accepte un utilisateur grâce à son token
	 * @param token Le token a validé
	 * @return bool Retourne true si l'acceptation est réussie, sinon retourne false
	 */
	static function acceptToken($code)
	{
		if(ModelTokens::isTokenValable($code))
		{
			ModelUsers::ConfirmUser(ModelTokens::GetTokenByCode($code)->Nickname);
			return true;
		}
		return false;
	}

	/**
	 * @brief Vérifie si le token est toujours valable
	 * @param Code le code du token a vérifié
	 * @return bool Retourne true si le token est valable sinon false
	 */
	static function isTokenValable($code)
	{
		$s = "SELECT `Nickname`, `ValidateTill`, `Code` FROM `tpi`.`TOKENS` WHERE `Code` = :e AND DATEDIFF(`ValidateTill`, now()) >= 0";
	
		$statement = EDatabase::prepare($s,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			$statement->execute(array(':e' => $code));
		}
		catch (PDOException $e) {
			echo 'Problème de lecture de la base de données: '.$e->getMessage();
			return false;
		}
		// On parcoure les enregistrements 
		if ($row=$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			// 
			return true;
		}
		// On retourne null si il n'y a pas d'utilisateur
		return false;
	}
}