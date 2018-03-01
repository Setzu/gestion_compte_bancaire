DROP TABLE auto_mouvement;

CREATE TABLE IF NOT EXISTS auto_mouvement (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_compte INT NOT NULL,
  type_mouvement CHAR(7) NOT NULL,
  montant INT NOT NULL,
  libelle CHAR(50),
  jour INT(2) NOT NULL DEFAULT 1,
  cron_error INT(1) DEFAULT 0,
  date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;