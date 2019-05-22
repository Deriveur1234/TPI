<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/config/mailparam.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ECourt.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EReservation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ESession.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EEmail.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelReservations.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelCourts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelEmailSender.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/swiftmailer5/lib/swift_required.php';


$Name = filter_input(INPUT_POST, 'CourtName', FILTER_SANITIZE_STRING);

$r = new ECourt();
$r->Name = $Name;
$r->Desc = "";
$r->Deleted = false;


if(ModelCourts::AddCourt($r))
    echo '{ "ReturnCode": 0, "Message": ""}';
else
    echo '{ "ReturnCode": 1, "Message": "Problème dans l\'enregistrement des données"}';
