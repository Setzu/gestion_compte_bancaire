DROP TABLE compte;

CREATE TABLE IF NOT EXISTS compte (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL UNIQUE,
  numero VARCHAR(255) NOT NULL UNIQUE,
  solde VARCHAR(255) NOT NULL
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;