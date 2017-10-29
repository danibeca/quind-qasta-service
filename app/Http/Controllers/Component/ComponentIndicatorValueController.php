<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentIndicatorSerie;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class ComponentIndicatorValueController extends ApiController
{
    public function store($componentId)
    {
        $indicators = Input::all();
        ComponentIndicatorSerie::where('component_id', $componentId)->where('created_at','>',Carbon::now()->format('Y-m-d'))->delete();
        foreach ($indicators as $indicator)
        {
            $value = new ComponentIndicatorSerie($indicator);
            $value->component_id = $componentId;
            $value->save();
        }

        return $this->respondResourceCreated();

    }


}