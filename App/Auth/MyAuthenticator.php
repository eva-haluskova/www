<?php

namespace App\Auth;

use App\Core\DB\Connection;
use App\Core\IAuthenticator;

class MyAuthenticator implements IAuthenticator
{

    /**
     * DummyAuthenticator constructor
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Verify, if the user is in DB and has his password is correct
     * @param $login
     * @param $password
     * @return bool
     * @throws \Exception
     */

    function login($login, $password): bool
    {

        $sql = "SELECT login, password, id FROM users WHERE login = ?";

        $query = Connection::connect()->prepare($sql);
        $query->execute([$login]);

        $fetchedData = $query->fetch();

        if(!$fetchedData) {
            return false;
        }


        if ($fetchedData['login'] == $login && password_verify($password, $fetchedData['password'])) {
            $_SESSION['user'] = $fetchedData['login'];
            $_SESSION['id'] = $fetchedData['id'];
            return true;
        }

        return false;
        /*
        if ($login == self::LOGIN && password_verify($password, self::PASSWORD_HASH)) {
               $_SESSION['user'] = self::USERNAME;
                return true;
            } else {
                return false;
            }
        */
    }


    /**
     * Logout the user
     */
    function logout() : void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * Get the name of the logged-in user
     * @return string
     */
    function getLoggedUserName(): string
    {

        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }

    /**
     * Get the context of the logged-in user
     * @return string
     */
    function getLoggedUserContext(): mixed
    {
        return null;
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    /**
     * Return the id of the logged-in user
     * @return mixed
     */
    function getLoggedUserId(): mixed
    {
        // return $_SESSION['user'];
        return $_SESSION['id'];
    }
}