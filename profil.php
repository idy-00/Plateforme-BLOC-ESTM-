<?php
require_once 'includes/db.php';
require_once 'includes/fonctions.php';
require_once 'includes/header.php';

// Redirection si non connecté
if (!isset($_SESSION['etudiant_id'])) {
    header('Location: connexion.php');
    exit();
}

// Récupérer les infos de l'étudiant
$stmt = $pdo->prepare("SELECT nom, prenom, email, date_inscription FROM etudiants WHERE id = ?");
$stmt->execute([$_SESSION['etudiant_id']]);
$etudiant = $stmt->fetch(); 
?>

<div class="container mt-4"> <!-- Conteneur principal -->
    <div class="row">
        <div class="col text-center">
            <h1>Mon Profil</h1>
            <p class="lead">Bienvenue, <?= htmlspecialchars($etudiant['prenom']) ?> !</p>
        </div>
    <div class="row justify-content-center"> <!-- Centrer le contenu -->
        <div class="col-md-6"><!-- Colonne pour le profil -->
            <!-- Card pour le profil -->
            <div class="card">
                <div class="card-header bg-primary text-white"><!-- En-tête de la carte -->
                    <i class="fas fa-user"></i> <!-- Icône utilisateur -->
                    <h3 class="mb-0">Mon Profil</h3>
                </div>
                <div class="card-body"><!-- Corps de la carte -->
                    <p class="lead">Voici vos informations :</p>
                    <table class="table table-bordered"><!-- Tableau pour afficher les informations -->
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Informations personnelles</th>
                            </tr>
                        <tbody><!-- Corps du tableau -->
                            <tr><!-- Ligne pour le nom -->
                                <th class="w-50">Nom :</th>
                                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                            </tr>
                            <tr><!-- Ligne pour le prénom -->
                                <th>Prénom :</th>
                                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                            </tr>
                            <tr><!-- Ligne pour l'email -->
                                <th>Email :</th>
                                <td><?= htmlspecialchars($etudiant['email']) ?></td>
                            </tr>
                            <tr>
                                <th>Inscrit depuis :</th>
                                <td><?= date('d/m/Y', strtotime($etudiant['date_inscription'])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>