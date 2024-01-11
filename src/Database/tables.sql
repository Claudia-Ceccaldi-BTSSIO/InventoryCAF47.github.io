-- Table pour les utilisateurs
CREATE TABLE Users (
  id_user VARCHAR(255) PRIMARY KEY,
  password_hash VARCHAR(255) NOT NULL -- Modification de la colonne pour stocker le mot de passe haché
);

-- Table pour le matériel
CREATE TABLE Materiel (
  id_user VARCHAR(255),
  type_select VARCHAR(20),
  observation VARCHAR(255),
  id_materiel INT PRIMARY KEY AUTO_INCREMENT,
  isiac VARCHAR(255),
  _description VARCHAR(255) NOT NULL,
  emplacement VARCHAR(255) NOT NULL,
  annee_uc INT,
  FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

CREATE TABLE EmpruntRestitution (
  id_emprunt_restitution INT PRIMARY KEY AUTO_INCREMENT,
  id_materiel INT,
  id_user VARCHAR(255),
  type_select VARCHAR(20),
  date_creation DATE,
  observation VARCHAR(255),
  FOREIGN KEY (id_materiel) REFERENCES Materiel(id_materiel),
  FOREIGN KEY (id_user) REFERENCES Users(id_user)
);
