<?php

namespace App\Utils\Transformers;

use Carbon\Carbon;

class SeriesTransformer extends Transformer {


    public function transform($indicator)
    {
        $indicatorTransform = new IndicatorTransformer();
        return $indicatorTransform->transformCollection($indicator->toArray());
    }
}