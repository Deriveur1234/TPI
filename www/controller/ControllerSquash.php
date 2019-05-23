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

    static function Register($user)
    {
        ModelUsers::AddUser($user);
        $Email = new EEmail($user->Email, "Confirmation de votre compte");
        $Email->Body = '<html>' .
                ' <head></head>' .
                ' <body>'.
                '  <p>Veuillez ouvrir ce lien pour confirmer votre compte : http://localhost/index.php?action=EmailConfirmation&token=' .
                    ModelTokens::GetTokenByNickname($user->Nickname)->Code. 
                '</p>' .
                ' </body>' .
                '</html>';
        ModelEmailSender::SendEmail($Email);
        header("Location: index.php?action=EmailRegisterSend");
        exit();
    }

    static function EmailRegisterSend()
    {
        include $_SERVER['DOCUMENT_ROOT'].'/view/Email/emailRegistrationSend.html';
    }

    static function EmailValidation($token)
    {
        if(ModelTokens::acceptToken($token))
        {
            include $_SERVER['DOCUMENT_ROOT'].'/view/Email/emailValidate.html';
        }
        else
        {
            include $_SERVER['DOCUMENT_ROOT'].'/view/Email/emailError.html';
        }
        
    }

    static function Logout()
    {
        session_destroy();
        header("Location: index.php");
    }

    static function Accueil($role=2)
    {
        $doc = $_SERVER['DOCUMENT_ROOT'].'/view/DocUtilisateur/DocAccueil.html';
        $courts = ModelCourts::GetAllCourts();
        $users = ModelUsers::GetAllUsers();
        $reservations = ModelReservations::GetAllReservations();
        $BeginTime = ModelPreferences::GetBeginTime();
        $EndTime = ModelPreferences::GetEndTime();
        $navBar = null;
        if($role==2)
            $navBar =  ControllerSquash::requireToVar($_SERVER['DOCUMENT_ROOT'].'/view/User/NavBar.php');
        else
            $navBar =  ControllerSquash::requireToVar($_SERVER['DOCUMENT_ROOT'].'/view/Admin/NavBar.php');
        include  $_SERVER['DOCUMENT_ROOT'].'/view/listAll.php';
    }

    static function MyReservations($user)
    {
        $doc = '/view/DocUtilisateur/DocMyProfil.html';
        $reservations = ModelReservations::GetReservationsByUser($user);
        include  $_SERVER['DOCUMENT_ROOT'].'/view/User/myReservations.php';
    }

    static function DeleteReservation($reservation, $user)
    {
        if(!isset($user->Role))
        {
            $user = ModelUsers::GetUserByNickname($user->Nickname);
        }
        if($user->Role->Label == "Admin" || $reservation->User->Nickname == $user->Nickname)
            ModelReservations::DeleteReservation($reservation);
        header("Location: ?action=Accueil");
    }

    static function ShowUsers()
    {
        $doc = "/view/DocUtilisateur/DocProfils.html";
        $users = ModelUsers::GetAllUsers();
        include  $_SERVER['DOCUMENT_ROOT'].'/view/Admin/listUsers.php';
    }

    static function ManagePreferences()
    {
        $doc = "/view/DocUtilisateur/DocParametre.html";
        $courts = ModelCourts::GetAllCourts();
        $preferences = ModelPreferences::GetPreferences();
        $preferences->BeginTime = ModelPreferences::GetBeginTime() . ":00";
        $preferences->EndTime = ModelPreferences::GetEndTime() . ":00";
        include $_SERVER['DOCUMENT_ROOT'].'/view/Admin/ManagePreferences.php';
    }

    static function GetRole($user)
    {
        return ModelUsers::GetUserRole($user);
    }

    static function requireToVar($file){
        ob_start();
        require($file);
        return ob_get_clean();
    }

    static function showUserProfil($nickname)
    {
        $doc = '/view/DocUtilisateur/DocProfilUser.html';
        $user = ModelUsers::GetUserByNickname($nickname);
        $reservations = ModelReservations::GetReservationsByUser($user);
        include $_SERVER['DOCUMENT_ROOT'].'/view/Admin/userProfil.php';
    }

    static function updatePreferences($preferences)
    {
        $preferences->BeginTime = "2000-00-00 " . $preferences->BeginTime . ":00";
        $preferences->EndTime = "2000-00-00 " . $preferences->EndTime . ":00";
        ModelPreferences::UpdatePreferences($preferences);
    }
}