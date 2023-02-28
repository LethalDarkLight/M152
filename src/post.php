<?php
/*
  * Auteur      : Flavio Soares Rodrigues
  * Projet      : M152
  * Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
  * Date        : 02.02.2023
  * Version     : 1.0.0
  */

require_once "php/pdo.php";
require_once "php/tools.php";

// Constantes...
define('TAILLE_MAX', 70000000); // 70Mo
define('TAILLE_MAX_UN_FICHIER', 3000000); // 30Mo

// Filtrer les champs...
$submit = filter_input(INPUT_POST, "submit", FILTER_SANITIZE_SPECIAL_CHARS);
$commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_SPECIAL_CHARS);

$typeDeFichierAccepter = array("image/png", "image/jpg", "image/jpeg"); // Correspond au type de fichier accepté
$dossierCible = dirname(__DIR__) . "/src/uploads/"; // Chemin vers le dossier de stockage
$tailleDesFichiers = 0; // Correspond à la taille total des fichiers

$messageErreur = "";

if ($submit)
{
  // Vérifie que le commentaire contient quelques chose. Si ce n'est pas le cas on affiche un message d'erreur
  if ($commentaire != "")
  {
    $fichiers = $_FILES['files'];
    $creeUnNouveauCommentaire = true; // Bool qui permet d'attribuer 1 commentaire à plusieurs post

    // Parcourir tout les fichiers pour connaître la taille de l'ensemble des fichiers selectionné
    foreach ($fichiers['size'] as $key => $tailleUnFichier)
    {
      $tailleDesFichiers += $tailleUnFichier;
    }

    // Parcourir tout les fichiers
    for ($i = 0; $i < count($fichiers['name']); $i++)
    {
      // On regarde si le type de fichier correspond à une image. Si ce n'est pas le cas on affiche un message d'erreur
      if (in_array($fichiers['type'][$i], $typeDeFichierAccepter))
      {
        // Vérifie que la taille de chaques fichier est inferieur ou égale à la taille max d'un fichier. Si ce n'est pas le cas on affiche un message d'erreur
        if ($fichiers["size"] >= TAILLE_MAX_UN_FICHIER)
        {
          // Vérifie que la taille de tous les fichiers est inferieur ou égale à la taille max. Si ce n'est pas le cas on affiche un message d'erreur
          if ($tailleDesFichiers <= TAILLE_MAX)
          {
            $nomDuFichier = uniqid() . "-" . basename($fichiers['name'][$i]); // Nom du fichier
            $typeDuFichier = $fichiers["type"][$i]; // Type de fichier
            $cheminCible = $dossierCible . $nomDuFichier; // Indique le chemin où on veut stocker l'image

            // Stock le fichier dans un dossier 
            if (move_uploaded_file($fichiers["tmp_name"][$i], $cheminCible))
            {
              // Ajoute un commentaire
              if ($creeUnNouveauCommentaire)
              {
                AjouterUnCommentaire($commentaire);
                $creeUnNouveauCommentaire = false;
              }

              // Ajoute à la base de données
              AjouterUnPost($typeDuFichier, $nomDuFichier, $commentaire);
            }
            else
            {
              $messageErreur = "Les fichiers n'ont pas pu être upload.";
            }
          }
          else
          {
            $messageErreur = "Les fichiers sont trop volumineux.";
            break;
          }
        }
        else
        {
          $messageErreur = "Le fichier " . $fichiers['name'][$i] . " dépasse 3Mo";
          break;
        }
      }
      else
      {
        if ($fichiers["name"][$i] == "")
        {
          $messageErreur = "Veuillez selectionner un fichier.";
          break;
        }
        else
        {
          $messageErreur = "Seul les fichiers de types png jpg et jpeg sont pris en charge.";
          break;
        }
      }
    }
  }
  else
  {
    $messageErreur = "Il manque un commentaire";
  }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-body">

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand my-3" href="#"><i class="fa-2xl fa-brands fa-bootstrap"></i> Faceboot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mx-lg-5" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-lg-0">
            <li class="nav-item mx-2">
              <a class="nav-link" aria-current="page" href="./index.php"><i class="fa-solid fa-house fa-xl"></i> Accueil</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link active" href="#"><i class="fa-solid fa-plus fa-xl"></i> Post</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container-fluid my-4 mainContainer">

    <h2 class="text-center mb-5">Ajouter un post</h2>
    <div class=" my-3">
      <p class="text-danger"><strong><?= $messageErreur ?></strong></p>
    </div>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="mb-2" for="floatingTextarea2">Commentaire : </label>
        <div class="form-floating">
          <textarea name="commentaire" class="form-control areaPost" id="floatingTextarea2" style="height: 200px"><?= $commentaire ?></textarea>
        </div>
      </div>
      <div class="mb-4">
        <label for="formFile" class="form-label">Image :</label>
        <input class="form-control" type="file" name="files[]" id="formFile" multiple="multiple" accept="image/png, image/jpg, image/jpeg">
      </div>

      <div class="d-flex justify-content-end">
        <input type="submit" name="submit" value="Poster" class="btn btn-primary w-25">
      </div>
    </form>
  </main>

  <script src="assets/js/bootstrap.js"></script>
</body>

</html>