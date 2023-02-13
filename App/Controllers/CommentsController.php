<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Recipe;

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
            return $this->json(['comment' => $idComment]);
        } else {
            return $this->json(['e' => "error"]);
        }
    }


    /**
     * editovanie komentarov cez volanie
     */
    public function edit() {
        $idComment = $this->request()->getValue('id');
        $commentToEdit = Comment::getOne($idComment);

        if ($commentToEdit) {
            return $this->json(['comment' => $commentToEdit]);
        } else {
            return $this->json(['e' => "error"]);
        }
    }


    /**
     * ukladanie noveho komentara
     */
    public function store() {

        $idRecipe = $this->request()->getValue('id');

        // aby sa neulozil prazdny komentar
        if ($this->request()->getValue('text') == "") {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        $comment = new Comment();

        if(!$comment) {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        $text = $this->request()->getValue('text');
        if (strlen($text) > 1000) {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        $comment->setText($text);
        $comment->setAuthor($this->app->getAuth()->getLoggedUserId());
        $comment->setRecipe($idRecipe);
        $comment->save();

        return $this->redirect("?c=recipes&a=display&id=$idRecipe");
    }


    /**
     * ukladanie editovaneho commentu
     */
    public function storeEdit() {
        $idRecipe = $this->request()->getValue('idRecipe');
        $idComment = $this->request()->getValue('id');

        // aby sa neulozil prazdny komentar
        if ($this->request()->getValue('text') == "") {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        if(!$idComment) {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }
        $comment = Comment::getOne($idComment);

        if(!$comment) {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        $text = $this->request()->getValue('text');
        if (strlen($text) > 1000) {
            return $this->redirect("?c=recipes&a=display&id=$idRecipe");
        }

        $comment->setText($text);
        $comment->save();

        return $this->redirect("?c=recipes&a=display&id=$idRecipe");

    }

}