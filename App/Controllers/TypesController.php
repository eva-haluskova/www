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

    /**
     * mazanie kategorie
     */
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
    }

    /**
     * ukladanie novej kategorie
     */
    public function store() {

        $name = $this->request()->getValue('name');

        // aby sa prazdny string neulozil ako kategoria
        if ($this->request()->getValue('name') == "") {
            return $this->redirect("?c=types");
        }

        // aby sa nelozil do nazvu pripadny enter
        $name = trim(preg_replace('/\s\s+/', ' ', $name));

        $types = Type::getAll();

        // kontrola dlzky
        if (strlen($name) > 30) {
            $data = ['message' => 'Názov je príliš dlhý!', 'types' => $types];
            return $this->html($data,viewName: 'index');
        } else if (strlen($name) < 3) {
            $data = ['message' => 'Názov je príliš krátky! Musí mať minimálne 3 znaky', 'types' => $types];
            return $this->html($data, viewName: 'index');
        }

        // kontrola ci dana kategoria uz neexistuje
        foreach ($types as $type) {
            if ($type->getName() == $name) {
                $data = ['message' => 'Kategória ' . $name . ' už existuje!', 'types' => $types];
                return $this->html($data,viewName: 'index');
            }
        }

        $type = new Type();

        $type->setName($name);
        $type->save();

        return $this->redirect("?c=types");
    }

}