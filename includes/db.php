<?php
// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'bloc_estm';
$user = 'root';
$pass = '';

try {
    // Connexion à la base avec PDO et gestion des erreurs
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Affichage d'un message en cas d'erreur de connexion
    die("Erreur de connexion : " . $e->getMessage());
}
?>
