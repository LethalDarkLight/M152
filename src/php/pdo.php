<?php
/*
* Auteur      : Flavio Soares Rodrigues
* Projet      : M152
* Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
* Date        : 09.02.2023
* Version     : 1.0.0
*/
require_once "database.php";

// Ajoute un nouveau commentaire 
function AjouterUnCommentaire($commentaire)
{
    try
    {
        $query = getConnexion()->prepare("
            INSERT INTO post (commentaire)
            VALUES (?);
        ");
        $query->execute([$commentaire]);
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}

// Ajoute un nouveau Post
function AjouterUnPost($typeMedia, $nomMedia, $commentaire)
{
    try
    {
        $query = getConnexion()->prepare("
            INSERT INTO media (typeMedia, nomMedia, idPost)
            VALUES (?, ?, (SELECT MAX(idPost) FROM post WHERE commentaire = ?));
        ");
        $query->execute([$typeMedia, $nomMedia, $commentaire]);
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}
?>
