<?php

namespace App\Utils\Transformers;


class CiAutomationTransformer extends Transformer
{

    public function transform($automationData)
    {
        return [
            'phase' => $automationData['process_phase']['name'],
            'value' => $automationData['value'],

        ];

        return $automationData;
    }
}