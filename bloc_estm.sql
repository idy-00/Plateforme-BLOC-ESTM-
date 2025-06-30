-- Création de la base
CREATE DATABASE IF NOT EXISTS bloc_estm DEFAULT CHARACTER SET utf8mb4;
USE bloc_estm;

-- Table des étudiants
CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique
    -- pour chaque étudiant
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    mot_de_passe VARCHAR(255),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- Table des sujets
CREATE TABLE IF NOT EXISTS sujets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200),
    contenu TEXT,
    auteur_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES etudiants(id) ON DELETE CASCADE -- l'auteur est supprimé, les sujets le sont aussi
);

-- Table des commentaires
CREATE TABLE IF NOT EXISTS commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT
    auteur_id INT,
    sujet_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES etudiants(id) ON DELETE CASCADE, -- l'auteur est supprimé, les commentaires le sont aussi
    FOREIGN KEY (sujet_id) REFERENCES sujets(id) ON DELETE CASCADE-- le sujet est supprimé, les commentaires le sont aussi
);

-- Données de test
INSERT INTO etudiants (nom, prenom, email, mot_de_passe) VALUES
('Diop', 'Fatou', 'fatou@example.com', '$2y$10$xBzL9O6ZnB1aY5OorCqBCOIBOULZV1qEVCEKyFcbVf0HXoY44mv/C'); -- mot de passe : 123456

INSERT INTO sujets (titre, contenu, auteur_id) VALUES   -- Sujet de discussion
('Bonjour à tous', 'Je suis ravi d\'être ici !', 1),
('Nouveaux événements', 'Des activités intéressantes à venir.', 1),
('Bienvenue sur le forum', 'Exprimez-vous librement ici !', 1),
('Activités de la semaine', 'Voici les événements prévus.', 1);

INSERT INTO commentaires (contenu, auteur_id, sujet_id) VALUES
('Merci pour l\'info !', 1, 1),
('Hâte de participer.', 1, 2); 
-- Sujet de discussion
INSERT INTO commentaires (contenu, auteur_id, sujet_id) VALUES
('Hâte de participer.', 1, 2);

