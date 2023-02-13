<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * sluzi aj na ukladanie pouzivatelov
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
        return $this->redirect('?c=home');
    }


    /**
     * registracia noveho pouzivatela
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function registration(): Response
    {
        return $this->html();
    }


    /**
     * ulozenie noveho pouzivatela
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function store()
    {
        $login = $this->request()->getValue('login');
        $email = $this->request()->getValue('email');
        $password_one = $this->request()->getValue('password_one');
        $password_two = $this->request()->getValue('password_two'); // kontrolne

        // kontrola loginu
        if (strlen($login) <= 3) {
            $data = ['message' => 'Príliš krátky login!', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }
        if (strlen($login) > 30) {
            $data = ['message' => 'Príliš dlhy login!', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }

        // kontrola mailu
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data = ['message' => 'Zadal si neplatný email', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }
        if (strlen($email) > 40) {
            $data = ['message' => 'Prilis dlhy mail!', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }


        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password_one);
        $lowercase = preg_match('@[a-z]@', $password_one);
        $number    = preg_match('@[0-9]@', $password_one);
        $specialChars = preg_match('@[^\w]@', $password_one);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_one) < 8) {
            $data = ['message' => 'Helso musí mať aspoň 8 znakov a musí obsahovať apsoň jedno veľké písmeno, číslo a špeciálny znak.', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }

        // Spravne zadanie overovacie heslo
        if($password_one != $password_two){
            $data = ['message' => 'Zadal si zlé overovacie heslo!', 'login' => $login, 'email' => $email];
            return $this->html($data, viewName: 'registration');
        }

        $password = password_hash($this->request()->getValue('password_two'), PASSWORD_DEFAULT);

        // kontrola, či používateľ so zadaným loginom alebo emailom už neexsituje
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

        // vytvorenie a uloženie nového používateľa
        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->save();

        return $this->redirect('?c=auth&a=login');
    }

    /**
     * vola sa pri vytvorani loginu - kontorla, ci uz pouzivatel s danym loginom neexituje
     */
    function checkLogin() {

        $str = $this->request()->getValue("str");
        $message = "";

        $len = strlen($str);
        if ($len > 3) {
            $users = User::getAll();
            foreach ($users as $user) {
                if ($user->getLogin() == $str) {
                    $message = "Používateľ s takýmto loginom uz existuje!";
                    return $this->json(['message' => $message]);
                }
            }
        }
        return $this->json(['message' => $message]);
    }

}