<?php

// Projet: TPI
// Script: Modèle roles.php
// Description: Classe de gestions de la table roles 
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


class ModelRoles
{
    /**
	 * @brief Retourne le tableau des roles de type ERole
	 * @return [array of ERole] Le tableau de ERole
	 */
    static function GetAllRoles()
    {

    }

    /**
	 * @brief Chercher un role par son Id dans la table 
	 * @param Id	L'id a recherché dans la base de donnée
	 * @return [ERole] Retourne le premier rôle du résultat de la requête
	 */
    static function GetRolesById($Id)
    {

    }
}

