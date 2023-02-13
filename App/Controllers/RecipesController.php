<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\Type;

class RecipesController extends AControllerBase
{

    /**
     * vypise vsetky recepty daneho typu
     */
    public function index(): Response {
        $idType = $this->request()->getValue('id');

        if ($idType == null) {
            $recipes = Recipe::getAll();
        } else {
            $recipes = Recipe::getAll("category = ?", [$idType]);
        }

        return $this->html($recipes);
    }


    /**
     * zobrazenie detailu receptu
     */
    public function display() {
        $idRecipe = $this->request()->getValue('id');
        $error = $this->request()->getValue('e');

        if ($error) {
            return $this->html(viewName: 'content');
        }

        if(!$idRecipe) {
            return $this->redirect("?c=recipes&a=display&e=chyba");
        }

        $recipeToDisplay = Recipe::getOne($idRecipe);

        if(!$recipeToDisplay) {
            return $this->redirect("?c=recipes&a=display&e=chyba");
        }

        $comments = Comment::getAll("recipe = ?", [$idRecipe]);
        $data = ['recept' => $recipeToDisplay, 'comments' => $comments];

        return $this->html($data, viewName: 'content');
    }


    /**
     * vymaze recept spolu so vsetkymi jeho komentarmi a obrazkom
     */
    public function delete()
    {
        $idRecipe = $this->request()->getValue('id');

        $recipeToDelete = Recipe::getOne($idRecipe);

        if ($recipeToDelete) {
            // deleteovanie komentarov
            $commentsToDelete = Comment::getAll("recipe = ?", [$idRecipe]);
            if ($commentsToDelete) {
                foreach ($commentsToDelete as $comment) {
                    $comment->delete();
                }
            }

            // zmazanie obrazka z priecinku
            $pathOdImage = "public/images/{$recipeToDelete->getImage()}";
            if ($pathOdImage != "public/images/universal.jpg") {
                unlink($pathOdImage);
            }

            $recipeToDelete->delete();
            return $this->json(['recipe' => $idRecipe]);
        } else {
            return $this->json(['e' => "error"]);
        }
    }


    /**
     * nachysta data pre vytvorenie noveho receptu, zobrazi formular na vytvorenie receptu
     */
    public function create() {
        $categories = Type::getAll();
        $data = ['categiries' => $categories,'recept' => null];

        return $this->html($data, viewName: 'create.form');
    }


    /**
     * nachysta data z receptu ktory sa bude dalej editovat vo formulari
     */
    public function edit() {
        $idRecipe = $this->request()->getValue('id');
        $recipeToEdit = Recipe::getOne($idRecipe);

        $categories = Type::getAll();
        $data = ['categiries' => $categories, 'recept' => $recipeToEdit];

        return $this->html($data, viewName: 'create.form');
    }


    /**
     * ulozenie receptu
     */
    public function store(): Response {

        $idRecipe = $this->request()->getValue('id');
        $recipe = ($idRecipe ? Recipe::getOne($idRecipe) : new Recipe()); //kontrolujem ci pridavam recept alebo upravujem stary....


        $title = $this->request()->getValue('title');
        $ingredient = $this->request()->getValue('ingredient');
        $process = $this->request()->getValue('process');

        if (strlen($title) >= 3 && strlen($title) <= 65 &&
            strlen($ingredient) >= 5 && strlen($ingredient) <= 500 &&
            strlen($process) >= 5 && strlen($process) <= 2000) {

            $recipe->setTitle($title);
            $recipe->setIngredient($ingredient);
            $recipe->setProcess($process);
            $recipe->setAuthor($this->app->getAuth()->getLoggedUserId());

            $typeofRecipe = $this->request()->getValue('typ');
            $types = Type::getAll();
            foreach ($types as $typ) {
                if ($typ->getName() == $typeofRecipe) {
                    $recipe->setCategory($typ->getId());
                }
            }

            $image = $_FILES['image']['tmp_name'];
            move_uploaded_file($image, "public/images/{$_FILES['image']['name']}");

            if ($image == null) {
                    $recipe->setImage("universal.jpg");
            } else {
                $recipe->setImage($_FILES['image']['name']);
            }

            $recipe->save();
            return $this->redirect("?c=home");
        } else {
            $types = Type::getAll();
            $message = 'error';
            if (strlen($title) < 3) {
                $message = 'Nazov je príliš krátky!';
            } else if (strlen($title) > 65) {
                $message = 'Nazov je príliš dlhy!';
            } else if (strlen($ingredient) < 5) {
                $message = 'Ingredienci je prilis malo!';
            } else if (strlen($ingredient) > 500) {
                $message = 'Ingredienci je prilis vela!';
            } else if (strlen($process) < 5) {
                $message = 'Postup je prikratky!';
            } else if (strlen($process) > 2000) {
                $message = 'Postup je prilis dlhy!';
            }

            $data = ['message' => $message,'categiries' => $types, 'recept' => null, 'title' => $title, 'ingredient'=>$ingredient, 'process'=>$process];
            return $this->html($data, viewName: 'create.form');

        }
    }

}