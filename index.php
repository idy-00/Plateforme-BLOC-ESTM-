<?php
require_once 'includes/db.php';
require_once 'includes/fonctions.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT s.*, e.nom, e.prenom FROM sujets s JOIN etudiants e ON s.auteur_id = e.id ORDER BY s.date_creation DESC");// Récupère tous les sujets avec les informations de l'auteur
$sujets = $stmt->fetchAll();//
?>

<div class="container-fluid py-5">
<div class="row align-items-center">
    
    <!-- Texte à gauche -->
    <div class="col-md-6">
      <h1 class="mb-4">Bienvenue sur le Bloc de l'Amicale de l'ESTM</h1>
      <p class="lead">
        Un espace de partage et de discussion pour tous les étudiants. Connectez-vous, créez des sujets, commentez, échangez vos idées et restez informés.
      </p>
      
    </div>

    <!-- Image à droite -->
    <div class="col-md-6 text-center">
      <img src="includes/logo-amicale.jpg" width="250px" height="250px" class="rounded-circle me-2">
    </div>

  </div>
<h1 style="font-size: 50px;  margin-top: 20px; margin-bottom: 10px;">Derniers sujets</h1>
<?php foreach ($sujets as $sujet): ?><!-- Boucle pour afficher chaque sujet -->
  <div class="card mb-3 border-0 shadow-sm transition-hover"><!-- Card pour chaque sujet -->
    <div class="card-body">
      <h5 class="card-title" style="color: royalblue;" ><?= htmlspecialchars($sujet['titre']) ?></h5>
      <p class="card-text"><?= nl2br(htmlspecialchars($sujet['contenu'])) ?></p>
      <p class="card-text"><small>Par <?= htmlspecialchars($sujet['prenom'] . ' ' . $sujet['nom']) ?> le <?= $sujet['date_creation'] ?></small></p>
      <a href="voir_sujet.php?id=<?= $sujet['id'] ?>" class="btn btn-sm btn-outline-primary" >Voir la suite</a>
    </div>
  </div>
<?php endforeach; ?>


<?php require_once 'includes/footer.php'; ?>
