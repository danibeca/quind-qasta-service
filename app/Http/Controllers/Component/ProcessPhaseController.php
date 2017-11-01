<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;


use App\Models\ContinuousIntegration\ProcessPhase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class ProcessPhaseController extends ApiController
{

    public function index($componentId)
    {
        return $this->respondData(ProcessPhase::where('component_owner_id', $componentId)->get());
    }

    public function store(Request $request, $id)
    {
        $phase = new ProcessPhase();
        $phase->component_owner_id = $id;
        $phase->name = $request->name;
        $phase->save();

        return $this->respondResourceCreated($phase);
    }

    public function update(Request $request, $componentId, $phaseId)
    {
        $phase = ProcessPhase::where('component_owner_id', $componentId)->where('id', $phaseId)->get()->first();
        if (isset($phase))
        {
            $phase->name = Input::get('name');
            $phase->save();
        }


        return $this->respond('OK');
    }

    public function destroy(Request $request, $componentId, $phaseId)
    {
        ProcessPhase::where('componentId', $componentId)->where('id', $phaseId)->get()->delete();

        return $this->respondResourceDeleted();
    }

}
