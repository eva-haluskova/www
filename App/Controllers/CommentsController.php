<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\Type;

class CommentsController extends AControllerBase
{
    public function index() : Response {
        $comments = Comment::getAll();
        return $this->html($comments);
    }

    /**
     * mazanie komentarov cez volanie
     */
    public function delete() : Response {
        $idComment = $this->request()->getValue('id');
        $commentToDelete = Comment::getOne($idComment);

        if ($commentToDelete) {
            $commentToDelete->delete();
        } else {
            return $this->json(['e' => "error"]);
        }

        return $this->json(['comment' => $idComment]);
    }


    /**
     * editovanie komentarov
     */
    public function edit() {
        $idComment = $this->request()->getValue('id');
        $commentToEdit = Comment::getOne($idComment);

        return $this->json(['comment' => $idComment]);
//        return $this->html($commentToEdit, viewName: 'content');


       // $this->redirect("?c=recipes&a=display&id=$idRecipe");

//        $categories = Type::getAll();
//        $data = ['categiries' => $categories, 'recept' => $recipeToEdit];
//
//        return $this->html($data, viewName: 'create.form');
    }


    /**
     * ukladanie noveho komentara
     */
    public function store() {

        $idRecipe = $this->request()->getValue('id');
        $idComment = $this->request()->getValue('idComment');

        // aby sa neulozil prazdny komentar
        if ($this->request()->getValue('text') == "") {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        $comment = ($idComment ? Comment::getOne($idComment) : new Comment());


        $comment->setText($this->request()->getValue('text'));
        $comment->setAuthor($this->app->getAuth()->getLoggedUserId());
        $comment->setRecipe($idRecipe);
        $comment->save();

        return $this->redirect("?c=recipes&a=display&id=$idRecipe");
    }



}