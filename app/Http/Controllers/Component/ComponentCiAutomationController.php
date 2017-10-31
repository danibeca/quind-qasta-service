<?php

namespace App\Http\Controllers\Component;

use App\Utils\Transformers\CiAutomationTransformer;

use App\Http\Controllers\ApiController;
use App\Models\Component\Component;


class ComponentCiAutomationController extends ApiController
{

    public function show($componentId)
    {
        return $this->respondData(
            (new CiAutomationTransformer())->transformCollection(
                Component::find($componentId)->getCiAutomation()->get()->toArray()
            )
        );
    }

}