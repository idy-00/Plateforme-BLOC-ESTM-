<?php
require_once 'includes/db.php';
require_once 'includes/fonctions.php';
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {// Vérifie si le formulaire a été soumis
    // Récupère les données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    if ($nom && $prenom && $email && $mot_de_passe) {
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);// Hash le mot de passe pour le stocker en toute sécurité
        // Prépare la requête pour éviter les injections SQL
        // Utilise des paramètres pour le nom, le prénom, l'email et le mot de passe
        $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
        try { // Essaye d'exécuter la requête
            // Si l'email est déjà utilisé, une exception sera levée
            $stmt->execute([$nom, $prenom, $email, $hash]);
            afficherMessage('success', "Inscription réussie !");
        } catch (PDOException $e) {
            afficherMessage('danger', "Email déjà utilisé.");
        }
    } else {// Vérifie si les champs ne sont pas vides
        afficherMessage('danger', "Veuillez remplir tous les champs.");
    }
}
?>

<h2>Inscription</h2><!-- Titre de la page -->
<p>Créez un compte pour participer aux discussions et partager vos idées.</p>
<form method="post">
  <input name="nom" class="form-control mb-2" placeholder="Nom">
  <input name="prenom" class="form-control mb-2" placeholder="Prénom">
  <input name="email" type="email" class="form-control mb-2" placeholder="Email">
  <input name="mot_de_passe" type="password" class="form-control mb-2" placeholder="Mot de passe"><!-- Champ pour le mot de passe -->
  <button class="btn btn-success">S'inscrire</button>
</form>

<?php require_once 'includes/footer.php'; ?>
