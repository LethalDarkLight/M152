<?php
/*
* Auteur      : Flavio Soares Rodrigues
* Projet      : M152
* Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
* Date        : 02.02.2023
* Version     : 1.0.0
*/
require_once "config.php";

// Permet d'accéder à la base de données
function  getConnexion()
{
    static $myDb = null;
    if($myDb === null)
    {
        try{
            $myDb = new PDO(
                "mysql:host=". DB_HOST. ";dbname=". DB_NAME. ";charset=utf8",
                DB_USER, DB_PASSWORD
            );
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(PDOException $e)
        {
            die("Erreur :" .$e->getMessage());
        }
    }
    return $myDb;
}