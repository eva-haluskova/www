<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\Type;

class TypesController extends AControllerBase
{
    public function index() : Response {
        $types = Type::getAll();
        $data = ['types'=>$types];

        return $this->html($data);
    }

    public function store() {

        $name = $this->request()->getValue('name');

        $types = Type::getAll();
        foreach ($types as $type) {
            if ($type->getName() == $name) {
                $types = Type::getAll();
                $data = ['message' => 'Takáto kategória už existuje!', 'types' => $types];
                return $this->html($data,viewName: 'index');
               // return $this->html();
            }
        }

        $type = new Type();

        $type->setName($name);
        $type->save();

        return $this->redirect("?c=types");
    }

    public function delete()
    {
        $idType = $this->request()->getValue('id');

        //deletovanie receptov v kategorii
        $recipesToDelete = Recipe::getAll("category = ?",[$idType]);
        if($recipesToDelete) {
            foreach ($recipesToDelete as $recipe) {
                $recipe->delete();
            }
        }

        $typeToDelete = Type::getOne($idType);
        if ($typeToDelete) {
            $typeToDelete->delete();
        }

        return $this->redirect('?c=types');



//        $idType = $this->request()->getValue('id');
//
//        //deletovanie receptov v kategorii
//        $recipesToDelete = Recipe::getAll("category = ?",[$idType]);
//        if($recipesToDelete) {
//            foreach ($recipesToDelete as $recipe) {
//                $recipe->delete();
//            }
//        }
//
//        $typeToDelete = Type::getOne($idType);
//        if ($typeToDelete) {
//            $typeToDelete->delete();
//        } else {
//            return $this->json(['e' => "error"]);
//        }
//
//        return $this->json(['type' => $idType]);
    }


}