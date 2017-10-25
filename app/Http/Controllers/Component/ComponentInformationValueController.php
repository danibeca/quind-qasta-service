<?php

namespace App\Http\Controllers\Component;



use App\Http\Controllers\ApiController;
use App\Models\Component\ComponentInformationSerie;
use Illuminate\Support\Facades\Input;



class ComponentInformationValueController extends ApiController
{
    public function store($componentId)
    {

        $value = new ComponentInformationSerie(Input::all());
        $value->component_id = $componentId;
        $value->save();

        return $this->respondResourceCreated();

    }


}