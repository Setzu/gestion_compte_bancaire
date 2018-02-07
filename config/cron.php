<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 30/01/18
 * Time: 08:32
 */


/**
 * @return PDO
 */
function getPDO() {
    $user = 'root';
    $password = 'gfp';
    $dsn = 'mysql:dbname=perso;host=localhost';

    return new \PDO($dsn, $user, $password);
}

/**
 * @return bool
 */
function execAutomaticMouvement() {
    $con = getPDO();
    $con->beginTransaction();
    $day = $test = date('d');

    $select = 'SELECT * FROM auto_mouvement WHERE jour = ' . $day;
    $stmt = $con->query($select);
    $aAutoMvt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    foreach ($aAutoMvt as $mvt) {

        // Contrôle sur le champ erreur, si il vaut 1 c'est qu'il y a eu une erreur avec un mouvement, voir fichier de logs
        if (!$mvt['cron_error']) {
            $sql = "INSERT INTO mouvement (id_compte, type_mouvement, montant, libelle, automatic) 
VALUES (:id_compte, :type_mouvement, :montant, :libelle, 1)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_compte', $mvt['id_compte']);
            $stmt->bindParam(':type_mouvement', $mvt['type_mouvement']);
            $stmt->bindParam(':montant', $mvt['montant']);
            $stmt->bindParam(':libelle', $mvt['libelle']);

            if (!$stmt->execute()) {
                $con->rollBack();
                $aSqlError = $stmt->errorInfo();
                echo date('d/m/Y H:i:s : ') . (string) $aSqlError[2] . ' ; Request : ' .
                    str_replace(':id_compte', $mvt['id_compte'],
                        str_replace(':type_mouvement', $mvt['type_mouvement'],
                            str_replace(':montant', $mvt['montant'],
                                str_replace(':libelle', $mvt['libelle'], $sql)))) . PHP_EOL;

                return updateMouvementCronError($mvt['id']);
            }

            $stmt->closeCursor();

            $sql = "SELECT solde FROM compte WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $mvt['id_compte']);

            if (!$stmt->execute()) {
                $con->rollBack();
                $aSqlError = $stmt->errorInfo();
                echo date('d/m/Y H:i:s : ') . (string) $aSqlError[2] . ' ; Request : ' .
                    str_replace(':id', $mvt['id_compte'], $sql) . PHP_EOL;

                return updateMouvementCronError($mvt['id']);
            }

            if ($mvt['type_mouvement'] == 'depot') {
                $iSolde = $stmt->fetchColumn() + $mvt['montant'];
            } else {
                $iSolde = $stmt->fetchColumn() - $mvt['montant'];
            }

            $stmt->closeCursor();

            $sql = "UPDATE compte SET solde = :solde, last_update = CURRENT_TIMESTAMP WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $mvt['id_compte']);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
                $con->rollBack();
                $aSqlError = $stmt->errorInfo();
                echo date('d/m/Y H:i:s : ') . __FILE__ . ' line : ' . __LINE__ . ' ; Erreur : ' . (string) $aSqlError[2]
                    . ' ; Request : ' . str_replace(':solde', $iSolde, str_replace(':id', $mvt['id_compte'], $sql)) . PHP_EOL;

                return updateMouvementCronError($mvt['id']);
            }

            $stmt->closeCursor();
        }
    }

    return $con->commit();
}

/**
 * @param int $idMouvement
 * @return bool
 */
function updateMouvementCronError($idMouvement) {
    $sql = "UPDATE auto_mouvement SET cron_error = 1 WHERE id = :id";
    $con = getPDO();
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $idMouvement);

    return $stmt->execute();
}

return execAutomaticMouvement();