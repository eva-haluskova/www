<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\Type;
use App\Models\User;

class RecipesController extends AControllerBase
{

    public function index(): Response
    {
        $id = $this->request()->getValue('id');
        $recipes = Recipe::getAll("category = ?", [$id]);
        return $this->html($recipes);
    }

    public function delete() {
        $id = $this->request()->getValue('id');
        $recipeToDelete = Recipe::getOne($id);

        // deleteovanie komentarov
        $comments = Comment::getAll("recipe = ?", [$id]);
        if ($comments) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }


        if ($recipeToDelete) {
            $recipeToDelete->delete();
        }

        return $this->redirect("?c=home");
    }

    public function edit() {
        $id = $this->request()->getValue('id');
        $recipeToEdit = Recipe::getOne($id);

        $categories = Type::getAll();
        $data = ['categiries' => $categories, 'recept' => $recipeToEdit];

        return $this->html($data, viewName: 'create.form');
    }

    public function create() {
        $categories = Type::getAll();
        $data = ['categiries' => $categories, 'recept' => new Recipe()];
        return $this->html($data, viewName: 'create.form');
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */

    public function store() {

        $id = $this->request()->getValue('id');
        $recipe = ($id ? Recipe::getOne($id) : new Recipe()); //kontrolujem ci pridavam recept alebo upravujem stary....


     /*   $title = $this->request()->getValue('title');
        $ingredient = $this->request()->getValue('ingredient');
        $process = $this->request()->getValue('process');
        $category = $this->request()->getValue('category'); */

  /*      if (is_string($title) && is_string($ingredient) && is_string($process)
            &&
            strlen($title) >= 5 && strlen($title) <= 40 &&
            strlen($process) >= 10 && strlen($ingredient) >= 10)
            //&&

            // TOTO ODRAZU OSETRI
          //  ($category == "Zákusok" || $category == "Torta" || $category == "Múčnik"
            //    || $category == "Kysnutý koláč" || $category == "Iné"))

        { */
      //  if ($recipe == null) {
        //    $recipe = new Recipe();
        //}
            $recipe->setTitle($this->request()->getValue('title'));

            $recipe->setProcess($this->request()->getValue('process'));
            $recipe->setIngredient($this->request()->getValue('ingredient'));
            // AJ TOTO PEKNE OSETRI



           // $recipe->setCategory($this->request()->getValue('category'));

            $category = $this->request()->getValue('category');
            $categories = Type::getAll();
            foreach ($categories as $cat) {
                if ($cat->getName() == $category) {
                    $recipe->setCategory($cat->getId());
                }
            }


        /*    if ($recipe->getImage() == null) { */
                $recipe->setImage("universal.jpg");
       /*     } else {
                $recipe->setImage($this->request()->getValue('image'));
            } */
           // $recipe->setAuthor($this->request()->getValue('id_user'));
            $recipe->setAuthor($this->app->getAuth()->getLoggedUserId());

           // $recipe->setUserId(2);//$this->request()->getValue('user_id'));

            $recipe->save();
   /*     } else {
            $myfile = fopen("testfile.txt", "a");
            $txt = "Nespravny vstup\n";
            fwrite($myfile,$txt);
            fclose($myfile);
        } */
        return $this->redirect("?c=home");
    }

    public function display() {
        $id = $this->request()->getValue('id');
        $recipeToDisplay = Recipe::getOne($id);

        $comments = Comment::getAll();
        $users = User::getAll();
        $data = ['recept' => $recipeToDisplay, 'comments' => $comments, 'users' => $users];

        return $this->html($data, viewName: 'content');
    }

    public function mucniky(): Response
    {
        $recipes = Recipe::getAll("category = ?", [3]);
        return $this->html($recipes, viewName: 'index');
    }

    public function kysnute(): Response
    {
        $recipes = Recipe::getAll("category = ?", [2]);
        return $this->html($recipes, viewName: 'index');
    }

    public function torty(): Response
    {
        $recipes = Recipe::getAll("category = ?", [4]);
        return $this->html($recipes, viewName: 'index');
    }

    public function zakusky(): Response
    {
        $recipes = Recipe::getAll("category = ?", [1]);
        return $this->html($recipes, viewName: 'index');
    }

    public function ine(): Response
    {
        $recipes = Recipe::getAll("category = ?", [5]);
        return $this->html($recipes, viewName: 'index');
    }

}