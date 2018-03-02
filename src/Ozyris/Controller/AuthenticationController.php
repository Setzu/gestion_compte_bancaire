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
        if (!empty($_POST)) {
            $aPostedDatas = Router::getPostValues();
            $oEmailValidator = new EmailValidator();
            $bEmailIsValid = $oEmailValidator->isValid($aPostedDatas['email']);

            if (!$bEmailIsValid) {
                $this->setFlashMessage($oEmailValidator->errorMessage);

                return $this->redirect('authentication', 'signup');
            }

            $oModelUser = new UserModel();

            if ($oModelUser->ifUserAlreadyExist($aPostedDatas['email'])) {
                $this->setFlashMessage("Un compte a déjà été crée avec cette adresse email.");

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
            $bPasswordIsValid = $oPasswordValidator->isValid($aPostedDatas['password'], $aPostedDatas['confirm-password']);

            if (!$bPasswordIsValid) {
                $this->setFlashMessage($oPasswordValidator->errorMessage);

                return $this->redirect('authentication', 'signup');
            }

            $oUser = new Users([
                $aPostedDatas['email'],
                $aPostedDatas['username'],
                password_hash($aPostedDatas['password'], PASSWORD_BCRYPT)
            ]);

            $oModelUser->insertUserByInfosUser($oUser);
            $this->setSessionValue('oUser', $oUser);
            $this->isAuthentified = true;
            $this->setFlashMessage('Votre compte a été crée avec succès.', false);

            return $this->redirect();
        }

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