DROP TABLE histo_mouvement;

CREATE TABLE IF NOT EXISTS histo_mouvement (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_compte INT NOT NULL,
  type_mouvement CHAR(7) NOT NULL,
  montant INT NOT NULL,
  libelle CHAR(50),
  automatique INT(1) NOT NULL DEFAULT 0,
  date_creation TIMESTAMP NOT NULL,
  date_suppression TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
