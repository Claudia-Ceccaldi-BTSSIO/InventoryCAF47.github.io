CREATE TABLE Users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_user VARCHAR(255) NOT NULL,
  password_hash VARCHAR(255) NOT NULL
);


CREATE TABLE Materiel (
  id_materiel INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  service VARCHAR(255) NOT NULL,
  type_select VARCHAR(20),
  _description VARCHAR(255) NOT NULL,
  emplacement VARCHAR(255) NOT NULL,
  annee_uc INT
);

-- Table pour les attestations de mise à disposition de matériel nomade
CREATE TABLE AttestationsMateriel (
  id_attestation INT PRIMARY KEY AUTO_INCREMENT,
  materiel_tt VARCHAR(255),
  ecran1_isiac VARCHAR(255),
  ecran2_isiac VARCHAR(255),
  uc_isiac VARCHAR(255),
  enregistre_dans_GACI BOOLEAN,
  materiel VARCHAR(255),
  remis_par VARCHAR(255),
  emprunte_par VARCHAR(255),
  fonction_emprunteur VARCHAR(255),
  date_emprunt DATE,
  date_restitution DATE,
  recepteur VARCHAR(255),
  observations VARCHAR(255)
);
