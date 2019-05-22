<?php

class ESession {

    /**
     * @brief Assigner un objet EUser dans la session
     * @param EUser user l'objet user
     */
    public static function SetUser($user)
    {
        $_SESSION['User'] = serialize($user);
    }

    /**
     * @brief Retourne l'objet EUser stocké en session
     * @return EUser user l'objet user
     */
    public static function GetUser()
    {
        if (isset($_SESSION['User']))
        {
            return unserialize($_SESSION['User']);
        }
        return false;
    }
}
