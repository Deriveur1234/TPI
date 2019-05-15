<?php
/**
 * @brief	Objet Role
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new ERole();
 *          $u->IdRole = 1;
 *          $u->Name = "Admin";
 * 
 *          Exemple d'utilisation 2
 *          $u = new ERole(1, "Admin");
 */
class ECalendar {

    /**
     * @brief Assigner un objet EUser dans la session
     * @param EUser user l'objet user
     */
    public static function SetUser($user)
    {
        $_SESSION['User'] = serialize($user);
    }

    public static function GetUser()
    {
        if (isset($_SESSION['User']))
        {
            return unserialize($_SESSION['User']);
        }
        return false;
    }
}
