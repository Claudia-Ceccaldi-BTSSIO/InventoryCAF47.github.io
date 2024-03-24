-- Table pour les utilisateurs
CREATE TABLE Users (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(191) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  registration_code VARCHAR(255),
  UNIQUE (username(191))
);

-- Table pour le matériel
CREATE TABLE Materiel (
  id_materiel INT PRIMARY KEY AUTO_INCREMENT,
  nom_utilisateur VARCHAR(255) NOT NULL,
  prenom_utilisateur VARCHAR(255) NOT NULL,
  service_utilisateur VARCHAR(255) NOT NULL,
  type_materiel VARCHAR(20),
  description_materiel VARCHAR(255) NOT NULL,
  emplacement_materiel VARCHAR(255) NOT NULL,
  annee_materiel INT
);

-- Table pour les demandes d'emprunt
CREATE TABLE DemandeEmprunt (
  id_demande INT PRIMARY KEY AUTO_INCREMENT,
  id_utilisateur INT,
  id_materiel INT,
  date_emprunt DATE NOT NULL,
  observations TEXT,
  FOREIGN KEY (id_utilisateur) REFERENCES Users(id_user),
  FOREIGN KEY (id_materiel) REFERENCES Materiel(id_materiel)
);
