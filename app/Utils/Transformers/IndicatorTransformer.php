<?php

namespace Agilin\Utils\Transformers;

class IndicatorTransformer extends Transformer {

    public function transform($indicator)
    {
        return [
            'id' => $indicator['id'],
            'name' => $indicator['name'],
            'code' => $indicator['code'],
            'value' => round($indicator['value'],3)
        ];
    }
}