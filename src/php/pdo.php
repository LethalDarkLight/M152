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
function AjouterUnPost($commentaire, $typeMedia, $nomMedia)
{
    try
    {
        $query = getConnexion()->prepare("
            INSERT INTO post (commentaire)
            VALUES (?);
        ");
        $query->execute([$commentaire]);

        $query = getConnexion()->prepare("
            INSERT INTO media (typeMedia, nomMedia, idPost)
            VALUES (?, ?, LAST_INSERT_ID());
        ");
        $query->execute([$typeMedia, $nomMedia]);
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}
?>
