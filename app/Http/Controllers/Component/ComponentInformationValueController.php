<?php

namespace App\Http\Controllers\Component;



use App\Http\Controllers\ApiController;
use App\Models\Component\ComponentInformationSerie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;



class ComponentInformationValueController extends ApiController
{
    public function store($componentId)
    {

        ComponentInformationSerie::where('component_id', $componentId)->where('created_at','>',Carbon::now()->format('Y-m-d'))->delete();
        $value = new ComponentInformationSerie(Input::all());
        $value->component_id = $componentId;
        $value->save();

        return $this->respondResourceCreated();

    }


}