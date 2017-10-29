<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentAttributeIssueSerie;

use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class ComponentQualityAttributeValueController extends ApiController
{
    public function store($componentId)
    {

        ComponentAttributeIssueSerie::where('component_id', $componentId)->where('created_at','>',Carbon::now()->format('Y-m-d'))->delete();
        $value = new ComponentAttributeIssueSerie(Input::all());
        $value->component_id = $componentId;
        $value->save();

        return $this->respondResourceCreated();

    }


}