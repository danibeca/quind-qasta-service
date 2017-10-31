<?php

namespace App\Utils\Transformers;


class CiIndicatorSerieTransformer extends Transformer
{


    public function transform($indicator)
    {
        $indicatorTransform = new CiIndicatorTransformer();

        return $indicatorTransform->transformCollection($indicator->toArray());
    }
}