<?php

/**
 * @remark Mettre le bon chemin d'accès à votre fichier contenant les constantes
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/config/mailparam.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ERole.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ECourt.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EReservation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EToken.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EPreference.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/EEmail.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/ESession.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelUsers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelRoles.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelCourts.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelReservations.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelPreferences.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelTokens.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/ModelEmailSender.php';

// Inclure le fichier swift_required.php localisé dans le répertoire swiftmailer5
require_once $_SERVER['DOCUMENT_ROOT'].'/swiftmailer5/lib/swift_required.php';

class ControllerSquash
{
    static function Login()
    {
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $User = new EUser();
            $User->Nickname = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
            $User->Password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $User->Password = sha1($User->Password);
            if(ModelUsers::CheckLogin($User))
            {
                ESession::SetUser(ModelUsers::GetUserByNickname($User->Nickname));
                header("Location: index.php?action=Accueil");
            }
        }
        include  $_SERVER['DOCUMENT_ROOT'].'/view/login.html';
    }

    static function Register()
    {
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
            ModelUsers::AddUser($user);
            $Email = new EEmail($user->Email, "Confirmation de votre compte");
            $Email->Body = '<html>' .
                    ' <head></head>' .
                    ' <body>'.
                    '  <p>Veuillez ouvrir ce lien pour confirmer votre compte : http://127.0.0.1/index.php?action=EmailConfirmation&token=' .
                     ModelTokens::GetTokenByNickname($user->Nickname)->Code. 
                    '</p>' .
                    ' </body>' .
                    '</html>';
            ModelEmailSender::SendEmail($Email);
            header("Location: index.php?action=EmailRegisterSend");
            exit();
        }
        include $_SERVER['DOCUMENT_ROOT'].'/view/register.html';
    }

    static function EmailRegisterSend()
    {
        include $_SERVER['DOCUMENT_ROOT'].'/view/Email/emailRegistrationSend.html';
    }

    static function EmailValidation()
    {

    }

    static function Logout()
    {
        session_destroy();
        header("Location: index.php");
    }

    static function AllUsers()
    {
        
        $users = ModelUsers::GetAllUsers();
        include  $_SERVER['DOCUMENT_ROOT'].'/view/User/listAll.php';
    }

    static function MyReservations($user)
    {
        $reservations = ModelReservations::GetReservationsByUser($user);
        include  $_SERVER['DOCUMENT_ROOT'].'/view/User/myReservations.php';
    }
}