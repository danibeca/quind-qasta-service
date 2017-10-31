<?php

namespace App\Utils\Transformers;


class CiIndicatorSerieTransformer extends Transformer
{


    public function transform($indicator)
    {
        $indicatorTransform = new SimpleCiIndicatorTransformer();

        return $indicatorTransform->transformCollection($indicator->toArray());
    }
}