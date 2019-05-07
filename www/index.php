<!DOCTYPE html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';
?>
<html>
<!-- Cet exemple démontre ce qu'il faut faire en terme d'utilisation
     de données provenant d'une base de données.
     Pour cet exemple, nous utilisons la classe EDatabase afin de simplifier
     l'accès aux données de la base de données.

     Dans cet exemple, afin de cacher la requête sql et l'appel aux fonctions PDO
     on a créé une fonction GetAllUsers() qui retourne un tableau contenant des objets
     EUser. 
     Pour afficher ces données, nous parcourons le tableau des EUserretourné.
     Nous avons complètement supprimé la dépendance avec la base de données et
     l'objet PDO.
-->     
<head>
<meta charset="utf-8">
<title>Encapsulation - Sample 3</title>
</head>
<body>
<?php
        $results = GetAllUsers();
        if ($results === false){
			exit();
        }
        // On parcoure les objets de type EUser
        foreach ($results as $user){
            // On affiche les données en utilisant les données de l'objet EUser
            echo '<p>';
            echo 'Email: '.$user->Email;
            echo '  Nickname: '.$user->Nickname;
            echo '  Nom: '.$user->Name;
            echo '</p>';
		}        
?>
</body>
</html>