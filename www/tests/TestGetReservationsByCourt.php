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
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelCourts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelReservations.php';

$u = new ECourt();
$u->Id = 1;

print_r(ModelReservations::GetReservationsByCourt($u));