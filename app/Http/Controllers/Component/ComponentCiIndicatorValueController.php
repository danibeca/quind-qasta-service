<?php

namespace App\Http\Controllers\Component;



use App\Http\Controllers\ApiController;
use App\Models\Component\ComponentCiIndicatorSerie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;



class ComponentCiIndicatorValueController extends ApiController
{
    public function store($componentId)
    {

        ComponentCiIndicatorSerie::where('component_id', $componentId)->where('created_at','>',Carbon::now()->format('Y-m-d'))->delete();
        $value = new ComponentCiIndicatorSerie(Input::all());
        $value->component_id = $componentId;
        $value->save();

        return $this->respondResourceCreated();

    }


}