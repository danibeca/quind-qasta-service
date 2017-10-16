<?php

namespace App\Http\Controllers\Component;

use App\Utils\Transformers\IndicatorTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use Illuminate\Support\Facades\Input;

class ComponentIndicatorController extends ApiController
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

                $result = $result->union([$indicatorId => Component::find($componentId)->getIndicator($indicatorId)]);


            }

            return $this->respondData((new IndicatorTransformer())->transformCollection($result->toArray(), true));

        }


        return $this->respondData([]);
    }


    public function show($componentId, $indicatorId)
    {
        return $this->respondData(
            (new IndicatorTransformer())->transform(
                Component::find($componentId)->getIndicator($indicatorId)
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
                $result[$indicatorId] = $component->indicatorSerie($indicatorId)->get();
            }
        }

        return (new IndicatorSerieTransformer())->transformCollection($result, true);
    }
}