<?php

namespace App\Utils\Transformers;


class CiAutomationTransformer extends Transformer
{

    public function transform($automationData)
    {
        return [
            'phase' => $automationData['processPhase']['name'],
            'value' => $automationData['value'],

        ];

        return $automationData;
    }
}