<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 02/06/16
 * Time: 10:14
 */

namespace Ozyris\core;

use Ozyris\Service\Users;

abstract class SessionManager
{

    public $aFlashMessages = [];

    const DEFAULT_EXPIRATION_TIME = 60;
    const FLASH_MESSAGE = 'flashmessage';
    const DANGER = 'danger';
    const SUCCESS = 'success';
    const ICON_DANGER = 'glyphicon-remove';
    const ICON_SUCCESS = 'glyphicon-ok';
    const DEFAULT_ERROR = 'The %param% must be %type% type in %file% at line %line%';

    public function __construct()
    {
        self::startSession();
    }

    /**
     * Start the session
     *
     * @param int $expiration
     */
    public static function startSession($expiration = self::DEFAULT_EXPIRATION_TIME)
    {
        $exp = (int) $expiration;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            session_cache_expire($exp > 0 ? $exp : self::DEFAULT_EXPIRATION_TIME);
        } else {
            session_cache_expire($exp > 0 ? $exp : self::DEFAULT_EXPIRATION_TIME);
        }
    }

    /**
     * Insert $sessionContent in session
     *
     * @param string $key
     * @param mixed $value
     * @throws \Exception
     */
    public function setSessionValue($key, $value)
    {
        if (!is_string($key)) {
            throw new \Exception(str_replace('%param%', 'key',
                str_replace('%type%', 'a string',
                    str_replace('%file%', __FILE__,
                        str_replace('%line%', __LINE__, self::DEFAULT_ERROR)))));
        }

        $_SESSION[$key] = $value;
    }

    /**
     * Get user from session
     *
     * @return Users | null
     */
    public function getUser()
    {
        if (key_exists('user', $_SESSION) && $_SESSION['user'] instanceof Users) {
            return $_SESSION['user'];
        } else {
            return null;
        }
    }

    /**
     * Get all session
     *
     * @return array
     */
    public function getSession()
    {
        return $_SESSION;
    }

    /**
     * Récupère une valeur de la session en passant la clé en paramètre
     *
     * @param mixed $key
     * @return null
     * @throws \Exception
     */
    public function getSessionValue($key)
    {
        if (!is_string($key) && !is_int($key)) {
            throw new \Exception(str_replace('%param%', 'key',
                str_replace('%type%', 'a string',
                    str_replace('%file%', __FILE__,
                        str_replace('%line%', __LINE__, self::DEFAULT_ERROR)))));
        }

        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    /**
     * Destroy the session
     */
    public function destroySession()
    {
        session_destroy();
    }

    /**
     * Unset the key $key in session
     *
     * @param $key
     * @return $this
     */
    public function destroySessionValue($key)
    {
        if (is_string($key) || is_int($key)) {
            if (array_key_exists($key, $_SESSION)) {
                unset($_SESSION[$key]);
            }
        }

        return $this;
    }

    /**
     * Stocke the flashmessages in session
     *
     * @param $message
     * @param bool|true $error
     * @throws \Exception
     */
    public function setFlashMessage($message, $error = true)
    {
        if ($error) {
            $type = self::DANGER;
            $icon = self::ICON_DANGER;
        } else {
            $type = self::SUCCESS;
            $icon = self::ICON_SUCCESS;
        }

        $this->setSessionValue(self::FLASH_MESSAGE, [$type => [
            'message' => $message,
            'icon' => $icon
        ]]);
    }

    /**
     * Display flash messages and removes them from the session
     *
     * @return string
     */
    public function flashMessages()
    {
        $aSession = $this->getSession();
        $sFlashMessages = '';

        if (array_key_exists(self::FLASH_MESSAGE, $aSession)) {
            foreach ($aSession[self::FLASH_MESSAGE] as $type => $aContent) {
                $sFlashMessages .= "<div class='alert alert-$type'><span class='glyphicon " . $aContent['icon'] .
                    "' aria-hidden='true'></span>&nbsp;&nbsp;&nbsp;" . $aContent['message'] . '</div><br>';
            }
        }

        $this->destroySessionValue(self::FLASH_MESSAGE);

        return $sFlashMessages;
    }
}
