<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelUsers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
// Initialisation des variables et Récupération du contenu des champs passés en paramètres
$nickname = filter_input(INPUT_POST, 'Nickname', FILTER_SANITIZE_STRING);
$isConfirmed = filter_input(INPUT_POST, 'isConfirmed', FILTER_SANITIZE_NUMBER_INT);

// Validation des données avec base de données ou autre
if (ModelUsers::UpdateConfirmation($nickname, (int)$isConfirmed))
    // si c'est valide 
    echo '{ "ReturnCode": 1, "Message": "Update réussie."}';
else
    // si c'est invalide on renvoie le code d'erreur et le message d'erreur
    echo '{ "ReturnCode": 0, "Message": "Update invalide."}';

 