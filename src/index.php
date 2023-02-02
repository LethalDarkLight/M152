<?php
/*
* Auteur      : Flavio Soares Rodrigues
* Projet      : M152
* Description : Crée un site web qui permet d'afficher une page ressemblant à "Facebook du CFPT Ecole d'info"
* Date        : 02.02.2023
* Version     : 1.0.0
*/
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Faceboot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./post.php">Post</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main class="container-fluid my-4">
    <div class="container-fluid" id="divUser">
      <h5 class="card-title">Bienvenue "nom de l'utilisateur"</h5>
      <img src="assets/img/photoProfil.png" alt="photo de profil" style="width: 300px;">
    </div>
  </main>

  <script src="assets/js/bootstrap.js"></script>
</body>
</html>