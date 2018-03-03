<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 26/05/16
 * Time: 14:52
 */

namespace Ozyris\Controller;

use Ozyris\core\Router;
use Ozyris\Model\UserModel;
use Ozyris\Form\Validator\EmailValidator;
use Ozyris\Form\Validator\PasswordValidator;
use Ozyris\Form\Validator\StandardValidator;
use Ozyris\Service\Users;

class AuthenticationController extends AbstractController
{

    public $isAuthentified = false;

    /**
     * Connecte l'utilisateur, stocke l'objet Users en session, puis redirige sur l'accueil
     *
     * @return $this|bool
     * @throws \Exception
     */
    public function indexAction()
    {
        if (!empty($_POST)) {
            $aPostedDatas = Router::getPostValues();
            $oModelUser = new UserModel();
            $aDonneesUser = $oModelUser->getUserByUsernameOrEmail($aPostedDatas['username']);

            if (!$aDonneesUser || count($aDonneesUser) == 0 || !password_verify($aPostedDatas['password'], $aDonneesUser['password'])) {
                $this->setFlashMessage('Identifiant ou mot de passe incorrect.');

                return $this->redirect('authentication');
            }

            $oUser = new Users($aDonneesUser);
            $this->setSessionValue('oUser', $oUser);
            $this->setSessionValue('isAuthentified', true);

            return $this->redirect();
        }

        return $this->render('authentication', 'index');
    }

    /**
     * Créée un nouvel utilisateur, stocke l'objet Users en session puis redirige sur l'accueil
     *
     * @return $this
     * @throws \Exception
     */
    public function signupAction()
    {
        $aConfig = $this->getConfig();

        if (!array_key_exists('reCaptcha', $aConfig) && !array_key_exists('secret_key', $aConfig['reCaptcha']) &&
            !array_key_exists('site_key', $aConfig['reCaptcha'])) {
            throw new \Exception('Une ou plusieurs clés sont manquantes dans le fichier de configuration');
        }

        if (!empty($_POST)) {
            $aPostedDatas = Router::getPostValues();

            if (!array_key_exists('g-recaptcha-response', $aPostedDatas) ||
                !array_key_exists('email', $aPostedDatas) ||
                !array_key_exists('username', $aPostedDatas) ||
                !array_key_exists('password', $aPostedDatas) ||
                !array_key_exists('confirm', $aPostedDatas)) {
                $this->setFlashMessage('Une erreur est survenue, merci de réessayer ultérieurement');

                return $this->redirect('authentication', 'signup');
            }

            $sSecretKey = $aConfig['reCaptcha']['secret_key'];
            $sResponse = $aPostedDatas['g-recaptcha-response'];
            $sRemoteip = $_SERVER['REMOTE_ADDR'];

            $sApi_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $sSecretKey
                . "&response=" . $sResponse
                . "&remoteip=" . $sRemoteip ;

            $decode = json_decode(file_get_contents($sApi_url), true);

            if (!$decode['success']) {
                $this->setFlashMessage('Le captcha a déterminé que vous êtes un robot');

                return $this->redirect('authentication', 'signup');
            }

            $oEmailValidator = new EmailValidator();

            $bEmailIsValid = $oEmailValidator->isValid($aPostedDatas['email']);

            if (!$bEmailIsValid) {
                $this->setFlashMessage($oEmailValidator->errorMessage);

                return $this->redirect('authentication', 'signup');
            }

            $oModelUser = new UserModel();

            if ($oModelUser->isUserAlreadyExist($aPostedDatas['email'])) {
                $this->setFlashMessage('Un compte a déjà été crée avec cette adresse email.');

                return $this->redirect('authentication', 'signup');
            }

            $this->startSession();
            $this->setSessionValue('email', $aPostedDatas['email']);
            $oStandarValidator = new StandardValidator();
            $bUsernameIsValid = $oStandarValidator->stringLenght($aPostedDatas['username'], 3, 50);

            if (!$bUsernameIsValid) {
                $this->setFlashMessage($oStandarValidator->errorMessage);

                return $this->redirect('authentication', 'signup');
            }

            if ($oModelUser->getUserByUsernameOrEmail($aPostedDatas['username'])) {
                $this->setFlashMessage("Ce nom d'utilisateur est déjà utilisé, veuillez en choisir un autre.");

                return $this->redirect('authentication', 'signup');
            }

            $this->setSessionValue('username', $aPostedDatas['username']);
            $oPasswordValidator = new PasswordValidator();
            $bPasswordIsValid = $oPasswordValidator->isValid($aPostedDatas['password'], $aPostedDatas['confirm']);

            if (!$bPasswordIsValid) {
                $this->setFlashMessage($oPasswordValidator->errorMessage);

                return $this->redirect('authentication', 'signup');
            }

            $oUser = new Users();
            $oUser->setEmail($aPostedDatas['email']);
            $oUser->setUsername($aPostedDatas['username']);
            $oUser->setPassword(password_hash($aPostedDatas['password'], PASSWORD_BCRYPT));

            $oModelUser->insertUserByInfosUser($oUser);
            $this->setSessionValue('oUser', $oUser);
            $this->isAuthentified = true;
            $this->setFlashMessage('Votre compte a été crée avec succès.', false);

            return $this->redirect();
        }

        $this->setVariables(['siteKey' => $aConfig['reCaptcha']['site_key']]);

        return $this->render('authentication', 'signup');
    }

    /**
     * Détruit la session puis redirige sur l'accueil
     *
     * @return $this
     * @throws \Exception
     */
    public function signoutAction()
    {
        $this->destroySession();
        $this->isAuthentified = false;

        return $this->redirect();
    }
}