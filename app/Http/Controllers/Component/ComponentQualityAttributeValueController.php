<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentAttributeIssueSerie;

use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;


class ComponentQualityAttributeValueController extends ApiController
{
    public function store($componentId)
    {
        Log::info(json_encode(Input::all()));
        ComponentAttributeIssueSerie::where('attribute_id', (Input::get('attribute_id')))->where('component_id', $componentId)->where('created_at','>',Carbon::now()->format('Y-m-d'))->delete();
        $value = new ComponentAttributeIssueSerie(Input::all());
        $value->component_id = $componentId;
        $value->save();

        return $this->respondResourceCreated();

    }


}