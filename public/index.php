<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 26/05/16
 * Time: 12:07
 */

// Affiche les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$loader = require_once __DIR__ . '/../vendor/autoload.php';

try {
    try {
        \Ozyris\core\Router::dispatch();
    } catch (\Exception $e) {
        die($e->getMessage());
    }
} catch(\Exception $e) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-not-found">
                    <h3 class="page-not-found">
                        <?php
                        try {
                            if (\Ozyris\core\Module::getEnv() == 'development') {
                                echo 'Exception : ' . $e->getMessage();
                            } else {
                                echo 'Une erreur est survenue, veuillez réessayez ultérieurement.';
                            }
                        } catch (\Ozyris\core\ModuleException $e) {
                            echo 'Une erreur est survenue, veuillez réessayez ultérieurement.';
                        }
                        ?>
                    </h3>
                </div>
                <a href="" class="btn btn-danger btn-retour" style="float: right;">Retour</a>
            </div>
        </div>
    </div>

<?php } ?>
