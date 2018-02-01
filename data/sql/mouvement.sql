DROP TABLE mouvement;

CREATE TABLE IF NOT EXISTS mouvement (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_compte INT NOT NULL,
  type_mouvement CHAR(7) NOT NULL,
  montant INT NOT NULL,
  libelle CHAR(50),
  automatic INT(1) NOT NULL DEFAULT 0,
  date_mouvement TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
