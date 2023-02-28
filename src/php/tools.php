<?php
/*
* Auteur      : Flavio Soares Rodrigues
* Projet      : M152
* Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
* Date        : 09.02.2023
* Version     : 1.0.0
*/
require_once "php/pdo.php";


function AfficherLesImages()
{
    $affichage = '<h5 class="card-title">Tout mes postes</h5>';
    $commentaires = RecupererLesCommentaire();
    $donnee = "";

    foreach ($commentaires as $unCommentaire)
    {
        $medias = RecupererLesMedia($unCommentaire['idPost']);
        $affichage .= '<div class="my-1 border-bottom border-dark">';

        foreach ($medias as $key => $unMedia)
        {
            $affichage .= '<img class="mt-3 mb-1 me-3 images" src="./uploads/'.$unMedia['nomMedia'].'">';
        }

        $affichage .= '<div>'.$unCommentaire["commentaire"].'</div> </div>';
    }
    echo $affichage;
}

?>