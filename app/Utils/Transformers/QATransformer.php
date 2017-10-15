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
            $record = 0;
            foreach ($values as $value)
            {
                $resultData[$qa][$record]['impact'] = $value->impact;
                $resultData[$qa][$record]['effort'] = intval($value->effort);
                $resultData[$qa][$record]['quantity'] = $value->quantity;
                $record++;
            }

        }

        return $resultData;

    }
}