<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

class UsersController extends AControllerBase
{
    public function index() : Response
    {
        $users = User::getAll();
        return $this->html($users);
    }

    public function delete() {

    }

    public function edit() {

    }


    public function create() {

    }

    public function store() {

    }


}


