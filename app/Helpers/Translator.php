<?php
namespace App\Helpers;

use App\Models\Translator AS TranslatorModel;

trait Translator {

    public function getTrans($group = "home")
    {
        $this->Translator = TranslatorModel::where("group",$group)->get();
    }
}
