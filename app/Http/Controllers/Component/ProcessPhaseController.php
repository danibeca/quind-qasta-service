<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;


use App\Models\ContinuousIntegration\ProcessPhase;
use Illuminate\Http\Request;



class ProcessPhaseController extends ApiController
{


    public function store(Request $request, $id)
    {
        $phase = new ProcessPhase();
        $phase->component_owner_id = $id;
        $phase->name = $request->name;
        $phase->save();

        return $this->respondResourceCreated($phase);
    }

}
