<?php

namespace App\Auth;

use App\Core\DB\Connection;

class MyAuthenticator extends DummyAuthenticator
{

    public function login($login, $password): bool
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
            return true;
        }

        return false;

    }
}