<?php
/*
* Auteur      : Flavio Soares Rodrigues
* Projet      : M152
* Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
* Date        : 09.02.2023
* Version     : 1.0.0
*/
require_once "php/pdo.php";


function AfficherLesMedias()
{
    $commentaires = RecupererLesCommentaire();
    $donnee = "";

    if (!empty($commentaires))
    {
        $affichage = '<h5 class="card-title">Tout mes postes</h5>';   
    }
    else
    {
        $affichage = '<h5 class="card-title">Vous n\'avez pas encore fait de post</h5>';
    }

    foreach ($commentaires as $unCommentaire)
    {
        $medias = RecupererLesMedia($unCommentaire['idPost']);
        $affichage .= '<div class="my-1 border-bottom border-dark">';

        foreach ($medias as $key => $unMedia)
        {
            $typeDeMedia = explode("/", $unMedia['typeMedia'])[0]; // Enleve le nom de l'extention du type de fichier pour avoir uniquement son type (image, video, etc...)
            if ($typeDeMedia == "image") {
                $affichage .= '<img class="my-2 mx-2 medias" src="./uploads/'.$unMedia['nomMedia'].'" alt="'.$unMedia['nomMedia'].'">';
            }

            if ($typeDeMedia == "video") {
                $affichage .= '<video class="my-2 mx-2 medias" autoplay loop muted>
                <source src="./uploads/'.$unMedia['nomMedia'].'" type="'. $unMedia['typeMedia'] .'"></video>';
            }

            if ($typeDeMedia == "audio") {
                $affichage .= '<audio controls class="my-2 mx-2" style="width: 400px">
                <source src="./uploads/'.$unMedia['nomMedia'].'" type="'. $unMedia['typeMedia'] .'"></audio>';
            }
        }
        $affichage .= '<div>'.$unCommentaire["commentaire"].'</div> </div>';
    }
    echo $affichage;
}

?>