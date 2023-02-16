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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

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
              <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-house fa-xl"></i> Accueil</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="./post.php"><i class="fa-solid fa-plus fa-xl"></i> Post</a>
            </li>
          </ul>
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