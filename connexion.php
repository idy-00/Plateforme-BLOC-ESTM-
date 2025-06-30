<?php
require_once 'includes/db.php';
require_once 'includes/fonctions.php';
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis
    // Récupère les données du formulaire
    // Utilise trim pour enlever les espaces inutiles
    $email = trim($_POST['email']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    if (!empty($email) && !empty($mot_de_passe)) { // Vérifie si les champs ne sont pas vides
        // Prépare la requête pour éviter les injections SQL
        // Utilise un paramètre pour l'email
        // Exécute la requête
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE email = ?");
        $stmt->execute([$email]);
        $etudiant = $stmt->fetch();

        if ($etudiant && password_verify($mot_de_passe, $etudiant['mot_de_passe'])) {// Vérifie si l'étudiant existe et si le mot de passe est correct
            // Si l'étudiant existe et que le mot de passe est correct, on démarre la session
            session_start();
            $_SESSION['etudiant_id'] = $etudiant['id'];
            $_SESSION['nom'] = $etudiant['nom'];
            $_SESSION['prenom'] = $etudiant['prenom'];
            header('Location: index.php');
            exit;
        } else {
            afficherMessage('danger', "Identifiants incorrects.");// Affiche un message d'erreur si l'email ou le mot de passe est incorrect
        }
    } else {
        afficherMessage('warning', "Veuillez remplir tous les champs.");// Affiche un message d'avertissement si les champs sont vides
    }
}
?>

<h2>Connexion</h2>
<form method="post"><!-- Formulaire de connexion -->
  <input name="email" type="email" class="form-control mb-3" placeholder="Email">
  <input name="mot_de_passe" type="password" class="form-control mb-3" placeholder="Mot de passe">
  <button class="btn btn-primary">Se connecter</button>
</form>

<?php require_once 'includes/footer.php'; ?>
