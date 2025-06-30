<?php
require_once 'includes/db.php';
require_once 'includes/fonctions.php';
require_once 'includes/header.php';

if (!isset($_SESSION['etudiant_id'])) { // Vérifie si l'utilisateur est connecté
    header('Location: connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis
    // Récupère les données du formulaire
    $titre = trim($_POST['titre']); // Utilise trim pour enlever les espaces inutiles
    $contenu = trim($_POST['contenu']);

    if ($titre && $contenu) {// Vérifie si les champs ne sont pas vides
        $stmt = $pdo->prepare("INSERT INTO sujets (titre, contenu, auteur_id) VALUES (?, ?, ?)");// Prépare la requête pour éviter les injections SQL
// Utilise des paramètres pour le titre, le contenu et l'auteur
        $stmt->execute([$titre, $contenu, $_SESSION['etudiant_id']]);
        header('Location: index.php');
        exit;
    } else {
        afficherMessage('danger', "Veuillez remplir tous les champs.");
    }
}
?>

<h2>Créer un sujet</h2>
<form method="post">
  <input name="titre" class="form-control mb-2" placeholder="Titre du sujet">
  <textarea name="contenu" rows="5" class="form-control mb-2" placeholder="Contenu du sujet"></textarea>
  <button class="btn btn-success">Publier</button>
</form>

<?php require_once 'includes/footer.php'; ?>
