DROP TABLE histo_compte;

CREATE TABLE IF NOT EXISTS histo_compte (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  nom VARCHAR(50) NOT NULL UNIQUE,
  solde INT NOT NULL,
  date_creation TIMESTAMP NOT NULL,
  date_suppression TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;