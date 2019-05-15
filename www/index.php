<?php
session_start();
/**
 * 
 * 
 * 
 * 
 * 
 * 
 */

require_once $_SERVER['DOCUMENT_ROOT'].'/controller/ControllerSquash.php';

$action = (isset($_GET['action']))? $_GET['action'] : null;

//Si l'utilisateur est connecté, récupère son role. Sinon mets le role à null
$u = ESession::GetUser();
$role = ($u === false) ? null : $u->Role;


if($role === null)
{
    switch($action)
    {
        case 'Register' :
            ControllerSquash::Register();
            break;
        case 'EmailRegisterSend' :
            ControllerSquash::EmailRegisterSend();
            break;
        default :
            ControllerSquash::Login();
    }

}


switch($action)
{
    case 'Logout' :
        ControllerSquash::Logout();
        break;
    case 'Accueil' :
        ControllerSquash::AllUsers();
        break;
    case 'MyReservation' :
        ControllerSquash::MyReservations($u);
        break;
    case null :
        ControllerSquash::AllUsers();
        break;
}

