<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Recipe;

class RecipesController extends AControllerBase
{

    public function index(): Response
    {
        $recipes = Recipe::getAll();
        return $this->html($recipes);
    }

    public function delete() {
        $id = $this->request()->getValue('id');
        $recipeToDelete = Recipe::getOne($id);
        if ($recipeToDelete) {
            $recipeToDelete->delete();
        }
        return $this->redirect("?c=recipes");
    }

    public function edit() {
        $id = $this->request()->getValue('id');
        $recipeToEdit = Recipe::getOne($id);
        return $this->html($recipeToEdit, viewName: 'create.form');

    }

    public function create() {
        return $this->html(new Recipe(), viewName: 'create.form');
    }

    public function store() {

        $id = $this->request()->getValue('id');
        $recipe = ( $id ? Recipe::getOne($id) : new Recipe()); //kontrolujem ci pridavam recept alebo upravujem stary....
        $recipe->setTitle($this->request()->getValue('title'));
        $recipe->setProcess($this->request()->getValue('process'));
        $recipe->setIngredient($this->request()->getValue('ingredient'));
        $recipe->setType($this->request()->getValue('type'));
        if ($recipe->getImage() == null) {
            $recipe->setImage("universal.jpg");
        } else {
            $recipe->setImage($this->request()->getValue('image'));
        }
        $recipe->save();
        return $this->redirect("?c=recipes");
    }

    public function display() {
        $id = $this->request()->getValue('id');
        $recipeToDisplay = Recipe::getOne($id);
        return $this->html($recipeToDisplay, viewName: 'content');
    }
}