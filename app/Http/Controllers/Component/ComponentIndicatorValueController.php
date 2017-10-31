<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentCiAutomationSerie;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class ComponentIndicatorValueController extends ApiController
{
    public function store($componentId)
    {
        $indicators = Input::all();
        ComponentCiAutomationSerie::where('component_id', $componentId)->where('created_at','>',Carbon::now()->format('Y-m-d'))->delete();
        foreach ($indicators as $indicator)
        {
            $value = new ComponentCiAutomationSerie($indicator);
            $value->component_id = $componentId;
            $value->save();
        }

        return $this->respondResourceCreated();

    }


}