<?php
require_once 'includes/db.php';
require_once 'includes/fonctions.php';
require_once 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];// Assurez-vous que l'ID est un entier
$stmt = $pdo->prepare("SELECT s.*, e.nom, e.prenom FROM sujets s JOIN etudiants e ON s.auteur_id = e.id WHERE s.id = ?");// Prépare la requête pour éviter les injections SQL
// Utilise un paramètre pour l'ID du sujet
$stmt->execute([$id]);
$sujet = $stmt->fetch();

if (!$sujet) {  // Vérifie si le sujet existe
    afficherMessage('danger', "Sujet introuvable.");
    require_once 'includes/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['etudiant_id'])) {// Vérifie si le formulaire a été soumis et si l'utilisateur est connecté
    // Récupère les données du formulaire
    $contenu = trim($_POST['contenu']);
    if ($contenu) {// Vérifie si le champ n'est pas vide
        $stmt = $pdo->prepare("INSERT INTO commentaires (contenu, auteur_id, sujet_id) VALUES (?, ?, ?)");
        $stmt->execute([$contenu, $_SESSION['etudiant_id'], $id]);//
    }
}

$stmt = $pdo->prepare("SELECT c.*, e.nom, e.prenom FROM commentaires c JOIN etudiants e ON c.auteur_id = e.id WHERE sujet_id = ? ORDER BY c.date_creation ASC");
$stmt->execute([$id]);
$commentaires = $stmt->fetchAll();// Récupère tous les commentaires du sujet
?>

<h2><?= htmlspecialchars($sujet['titre']) ?></h2>
<p><?= nl2br(htmlspecialchars($sujet['contenu'])) ?></p>
<p><em>Posté par <?= htmlspecialchars($sujet['prenom'] . ' ' . $sujet['nom']) ?> le <?= $sujet['date_creation'] ?></em></p>
<hr>

<h4>Commentaires</h4>
<?php foreach ($commentaires as $com): ?>
  <div class="card mb-3 border-0 shadow-sm transition-hover">
    <strong><?= htmlspecialchars($com['prenom'] . ' ' . $com['nom']) ?> :</strong><br>
    <?= nl2br(htmlspecialchars($com['contenu'])) ?>
  </div>
<?php endforeach; ?>

<?php if (isset($_SESSION['etudiant_id'])): ?>
  
  <h4 style="color: royalblue;">Laissez un commentaire</h4>
  <form method="post" class="mt-3">
    <textarea class="form-control mb-2" name="contenu" rows="3" placeholder="Votre commentaire..."></textarea>
    <button class="btn btn-primary">Commenter</button>
  </form>
<?php else: ?>
  <p><a href="connexion.php">Connectez-vous</a> pour commenter.</p>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
