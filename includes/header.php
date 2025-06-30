<!-- gestion de l'affichage du thème -->
<?php
session_start();
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="<?php echo $theme; ?>">
<head>
  <meta charset="UTF-8">
  <title>Bloc ESTM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- css pour les animation -->
  <style>  
  .transition-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .transition-hover:hover {
    transform: scale(1.02);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }
</style>

</head>
<body>
<!--Barre de navigation-->
<nav class="navbar navbar-expand-lg navbar-blue bg-primary"> 
  <div class="container-fluid"> 
    <a href="index.php" class="nav-link me-3">
          <i class="bi bi-house"></i> acceuil 
        </a>
    
      
    </a>
    <div class="d-flex ms-auto align-items-center">
      <a class="nav-link me-2" href="theme.php">
        <?php if ($theme == 'dark'): ?>
          <i class="bi bi-sun"></i> light
        <?php else: ?>
          <i class="bi bi-moon"></i> dark
        <?php endif; ?>
      </a>

      <?php if (isset($_SESSION['etudiant_id'])): ?><!-- Si l'utilisateur est connecté --> 
        <a href="profil.php" class="nav-link me-3">
          <i class="bi bi-person-circle"></i>  Profil
        </a>
        <a href="creer_sujet.php" class="btn btn-outline-light btn-sm me-2">Créer un sujet</a>
        <a href="deconnexion.php" class="btn btn-danger btn-sm">Déconnexion</a>
      <?php else: ?>
        <a href="connexion.php" class="btn btn-outline-light btn-sm me-2">Connexion</a>
        <a href="inscription.php" class="btn btn-success btn-sm">Inscription</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container mt-4">