<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Recipe;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $recipes = Recipe::getAll();
        return $this->html($recipes);
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function contact(): Response
    {
        return $this->html();
    }


    public function search() {
        $search = $this->request()->getValue('search');
        $recipes = Recipe::getAll("title LIKE ?", ["%$search%"]);
        //$recipes = Recipe::getAll();
        //return $this->html($recipes);
        return $this->html($recipes, viewName: 'index');
    }
}