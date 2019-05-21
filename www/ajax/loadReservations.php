<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ECourt.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ERole.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EReservation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ESession.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelReservations.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelCourts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelUsers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelRoles.php';


$reservations = ModelReservations::GetAllReservations();
$reservations = json_encode($reservations);
echo $reservations;