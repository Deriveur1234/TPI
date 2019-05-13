<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ERole.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ECourt.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EReservation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EToken.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EPreference.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelUsers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelRoles.php';

$role = ModelUsers::GetUserRole(new EUser("loic@burnand.com", "Test3", "Burnand2", "Loic", "0767756644", new ERole(1), 1));
echo "Si le code est déjà rempli, requête retourne : " . $role->Label;

$role = ModelUsers::GetUserRole(new EUser("loic@burnand.com", "Test3", "Burnand2", "Loic", "0767756644"));
echo "Si le code n'est pas rempli mais le nickname est rempli : " . $role->Label;