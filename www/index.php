<?php

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

if($action != null)
{
    switch($action)
    {
        case 'Accueil' :
            ControllerSquash::AllUsers();
            break;
    }
}