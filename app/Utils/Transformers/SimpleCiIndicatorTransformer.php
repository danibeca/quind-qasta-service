<?php

namespace App\Utils\Transformers;

use App\Models\ContinuousIntegration\CiIndicator;
use Carbon\Carbon;

class   SimpleCiIndicatorTransformer extends Transformer
{

    public function transform($indicator)
    {
        if ($indicator)
        {
            $value = isset($indicator['value']) ? $indicator['value'] : 0;

            return [
                'date'  => Carbon::parse($indicator['created_at'])->format('d-m-Y'),
                'value' => round($value, 2)
            ];
        }
    }
}