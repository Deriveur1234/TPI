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
            if(isset($_POST) && count($_POST) == 6)
            {
                $user = new EUser();
                $user->Nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_SPECIAL_CHARS);
                $user->Password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                $user->Email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
                $user->Name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $user->Firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
                $user->Phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
                $user->Password = sha1($user->Password);
                ControllerSquash::Register($user);
            }
            include $_SERVER['DOCUMENT_ROOT'].'/view/register.html';
            break;
        case 'EmailRegisterSend' :
            ControllerSquash::EmailRegisterSend();
            break;
        case 'EmailConfirmation' :
            $token = (isset($_GET['token'])) ? filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS) : null;
            if($token === null)
                break;
            ControllerSquash::EmailValidation($token);
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
        ControllerSquash::Accueil();
        break;
    case 'MyReservation' :
        ControllerSquash::MyReservations($u);
        break;
    case 'DeleteReservation' :
        $user = ESession::GetUser();
        $reservation = new EReservation();
        $reservation->Court = ModelCourts::GetCourtById(filter_input(INPUT_GET, 'idCourt', FILTER_SANITIZE_SPECIAL_CHARS));
        $reservation->User = ModelUsers::GetUserByNickname(filter_input(INPUT_GET, 'Nickname', FILTER_SANITIZE_SPECIAL_CHARS));
        $reservation->Date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        ControllerSquash::DeleteReservation($reservation, $user);
        break;
    case null :
        ControllerSquash::Accueil();
        break;
}

