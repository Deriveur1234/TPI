<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ECourt.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EReservation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ESession.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelReservations.php';


$id = filter_input(INPUT_POST, 'IdCourt', FILTER_SANITIZE_NUMBER_INT);
$dt = filter_input(INPUT_POST, 'Date', FILTER_SANITIZE_STRING);

$r = new EReservation();
$r->Court = new ECourt($id);
$r->User = ESession::GetUser();
$r->Date = date_parse($dt);

$r->Date = $r->Date["year"] . "-" . $r->Date["month"] . "-" .  $r->Date["day"] . " " . $r->Date["hour"] . ":00:00";

if(ModelReservations::AddReservation($r))
    echo '{ "ReturnCode": 0, "Message": ""}';
else
    echo '{ "ReturnCode": 1, "Message": "Problème dans l\'enregistrement des données"}';
