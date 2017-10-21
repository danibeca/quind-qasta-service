<?php

namespace App\Http\Controllers\Component;

use App\Utils\Transformers\IndicatorTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Utils\Transformers\QATransformer;
use App\Utils\Transformers\QATransformer2;
use Illuminate\Support\Facades\Input;

class ComponentAttributeIssueController extends ApiController
{
    public function index($componentId)
    {
        $component = Component::find($componentId);

        return $this->respondData((new QATransformer())->transform($component->getAttributeIssues()));
    }


    public function index2($componentId)
    {
        $component = Component::find($componentId);

        return $this->respondData((new QATransformer2())->transform($component->getAttributeIssues()));
    }
}