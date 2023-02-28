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
        $db = getConnexion();
        $db->beginTransaction();

        $query = $db->prepare("
            INSERT INTO post (commentaire)
            VALUES (?);
        ");
        $query->execute([$commentaire]);
        $db->commit();
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
        $db->rollBack();
    }
}

// Ajoute un nouveau Post
function AjouterUnPost($typeMedia, $nomMedia, $commentaire)
{
    try
    {
        $db = getConnexion();
        $db->beginTransaction();

        $query = $db->prepare("
            INSERT INTO media (typeMedia, nomMedia, idPost)
            VALUES (?, ?, (SELECT MAX(idPost) FROM post WHERE commentaire = ?));
        ");
        $query->execute([$typeMedia, $nomMedia, $commentaire]);
        $db->commit();
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
        $db->rollBack();
    }
}

// Récupère les commentaires
function RecupererLesCommentaire()
{
    try
    {
        $query = getConnexion()->prepare("
            SELECT commentaire, idPost
            FROM post
            ORDER BY creationDate DESC;
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}

// Récupère le nom et le type du media grâce à l'idPost donné en paramètre
function RecupererLesMedia($idPost)
{
    try
    {
        $query = getConnexion()->prepare("
            SELECT nomMedia, typeMedia
            FROM media
            WHERE idPost = ?;
        ");
        $query->execute([$idPost]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}

?>
