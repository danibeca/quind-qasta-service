<?php

namespace App\Http\Controllers\Component;

use App\Utils\Transformers\IndicatorTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use Illuminate\Support\Facades\Input;

class ComponentAttributeIssueController extends ApiController
{
    public function index($componentId)
    {
        $component = Component::find($componentId);

        //return $this->respondData($component->getAttributeIssues());
    }
}