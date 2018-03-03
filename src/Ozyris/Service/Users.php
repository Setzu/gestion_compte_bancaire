<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 16:50
 */

namespace Ozyris\Service;

class Users extends AbstractService
{

    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $date_registration;
    protected $admin = 0;
    protected $role = 'member';

    /**
     * Users constructor.
     * @param array $aDonnees
     */
    public function __construct(array $aDonnees = [])
    {
        if (is_array($aDonnees) && count($aDonnees) > 0) {
            try {
                $this->hydrate($this, $aDonnees);
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateRegistration()
    {
        return $this->date_registration;
    }

    /**
     * @param mixed $date_registration
     */
    public function setDateRegistration($date_registration)
    {
        $this->date_registration = $date_registration;
    }

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param boolean $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }


}