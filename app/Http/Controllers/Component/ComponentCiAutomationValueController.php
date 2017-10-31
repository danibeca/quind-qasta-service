<?php

namespace App\Http\Controllers\Component;


use App\Http\Controllers\ApiController;
use App\Models\Component\ComponentCiAutomationSerie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class ComponentCiAutomationValueController extends ApiController
{
    public function store($componentId)
    {

        $indicators = Input::all();
        ComponentCiAutomationSerie::
        where('component_id', $componentId)
            ->where('created_at', '>',
                Carbon::now()->format('Y-m-d'))
            ->delete();
        foreach ($indicators as $indicator)
        {
            $value = new ComponentCiAutomationSerie();
            $value->process_phase_id = $indicator['phase_id'];
            $value->value = $indicator['value'];
            $value->component_id = $componentId;

            $value->save();
        }

        return $this->respondResourceCreated();
    }


}