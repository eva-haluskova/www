<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Recipe;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */

    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
               // return $this->redirect('?c=admin');
                return $this->redirect('?c=home');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }


    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        //return $this->html();
        return $this->redirect('?c=home');
    }

    /**
     * Registration a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function registration(): Response
    {
        return $this->html();
    }

    public function store()
    {
        $login = $this->request()->getValue('login');
        $email = $this->request()->getValue('email');

        $password_one = $this->request()->getValue('password_one');
        $password_two = $this->request()->getValue('password_two');
        if($password_one != $password_two){
            $data = ['message' => 'Zadal si zlé heslo!', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }

        $password = password_hash($this->request()->getValue('password_two'), PASSWORD_DEFAULT);


        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() == $login) {
                $data = ['message' => 'Užívateľ s týmto loginom už existuje!', 'login' => $login, 'email' => $email];
                return $this->html($data, viewName: 'registration');
            } else {
                if ($user->getEmail() == $email) {
                    $data = ['message' => 'Užívateľ s týmto emailom už existuje!', 'login' => $login, 'email' => $email];
                    return $this->html($data, viewName: 'registration');
                }
            }
        }

        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->save();

      //  return $this->redirect('?c=auth$a=login');
        return $this->redirect('?c=auth&a=login');
    }

}