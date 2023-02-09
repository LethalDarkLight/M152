<?php
/*
* Auteur      : Flavio Soares Rodrigues
* Projet      : M152
* Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
* Date        : 09.02.2023
* Version     : 1.0.0
*/
require_once "database.php";

// Ajoute un nouveau Post
function AjouterUnPost($commentaire, $typeMedia, $nomMedia, $media)
{
    try
    {
        $query = getConnexion()->prepare("
        INSERT INTO `post` (`commentaire`)
        VALUES (?);
        INSERT INTO `media` (`typeMedia`, `nomMedia`, `media`, `idPost`)
        VALUES (?,?,? (SELECT `idPost` FROM `post` WHERE `commentaire` = ?))");
        $query->execute([$commentaire, $typeMedia, $nomMedia, $media, $commentaire]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}
?>