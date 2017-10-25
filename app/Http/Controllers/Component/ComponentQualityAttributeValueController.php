<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentAttributeIssueSerie;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;


class ComponentQualityAttributeValueController extends ApiController
{
    public function store($componentId)
    {

        $value = new ComponentAttributeIssueSerie(Input::all());
        $value->component_id = $componentId;
        $value->save();

        return $this->respondResourceCreated();

    }


}