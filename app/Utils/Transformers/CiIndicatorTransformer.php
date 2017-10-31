<?php

namespace App\Utils\Transformers;

use App\Models\ContinuousIntegration\CiIndicator;
use Carbon\Carbon;

class   CiIndicatorTransformer extends Transformer
{

    public function transform($indicator)
    {
        if ($indicator)
        {
            $ciIndicator = CiIndicator::find($indicator['id']);
            $value = isset($indicator['value']) ? $indicator['value'] : 0;

            return [
                'id' => $ciIndicator->id,
                'date'  => Carbon::parse($indicator['created_at'])->format('d-m-Y'),
                'value' => round($value, 2),
                'name'  => $ciIndicator->name
            ];
        }
    }
}