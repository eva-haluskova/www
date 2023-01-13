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

    public function delete() {
        $id = $this->request()->getValue('id');
        $commentToDelete = Comment::getOne($id);
        if ($commentToDelete) {
            $commentToDelete->delete();
        }
        return $this->redirect("?c=recipes");
    }

    public function edit() {

    }

    public function create() {
        $data = new Comment();
        return $this->html($data, viewName: 'create.form');
    }



}