<?php

namespace App\Utils\Transformers;

use Agilin\Models\Application\QualityAttribute;
use Illuminate\Database\Eloquent\Collection;

class QATransformer
{

    public function transform(Collection $data)
    {
        $qas = $data->pluck('attribute_id')->unique();
        $resultData = null;
        foreach ($qas as $qa)
        {
            $values = $data->where('attribute_id', $qa);
            foreach ($values as $value)
            {
                $resultData[$qa]['impact'] = $value->impact;
                $resultData[$qa]['effort'] = intval($value->effort);
                $resultData[$qa]['quantity'] = $value->quantity;
            }

        }

        return $resultData;

    }
}