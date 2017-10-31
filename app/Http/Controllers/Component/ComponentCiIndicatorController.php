<?php

namespace App\Http\Controllers\Component;

use App\Models\ContinuousIntegration\CiIndicator;
use App\Utils\Transformers\CiIndicatorSerieTransformer;
use App\Utils\Transformers\CiIndicatorTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use Illuminate\Support\Facades\Input;

class ComponentCiIndicatorController extends ApiController
{
    public function index($componentId)
    {
        if (Input::has('series'))
        {
            return $this->respondData($this->series($componentId));
        }

        if (Input::has('ids'))
        {
            $result = collect();
            $indicatorIdArray = array_map('intval', explode(',', Input::get('ids')));

            foreach ($indicatorIdArray as $indicatorId)
            {

                $result = $result->union([$indicatorId => Component::find($componentId)->getCiIndicator($indicatorId)
                ]);


            }

            return $this->respondData((new CiIndicatorTransformer())->transformCollection($result->toArray(), true));

        }


        return $this->respondData([]);
    }


    public function show($componentId, $indicatorId)
    {
        return $this->respondData(
            (new CiIndicatorTransformer())->transform(
                Component::find($componentId)->getCiIndicator($indicatorId)
            )
        );
    }


    public function series($componentId)
    {

        $result = array();

        $component = Component::find($componentId);

        if (Input::has('ids'))
        {

            $indicatorIdArray = array_map('intval', explode(',', Input::get('ids')));

            foreach ($indicatorIdArray as $indicatorId)
            {
                $result[$indicatorId] = $component->ciIndicatorSerie($indicatorId)->get();
            }
        }

        return (new CiIndicatorSerieTransformer())->transformCollection($result, true);
    }
}