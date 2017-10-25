<?php

namespace App\Utils\Transformers;


use App\Models\Component\QualityAttribute;
use Illuminate\Database\Eloquent\Collection;

class QATransformer2
{

    public function transform(Collection $data)
    {
        $qas = $data->pluck('attribute_id')->unique();
        $resultData = null;
        $result = [];
        foreach ($qas as $qa)
        {
            $attribute = [];
            $attribute['name'] =  QualityAttribute::find($qa)->name;
            $attribute['balloonText'] = 'Criticidad:<b>[[y]]</b> Esfuerzo:<b>[[x]]</b><br>Cantidad:<b>[[value]]</b>';

            $count = 0;
            $values = $data->where('attribute_id', $qa);
            foreach ($values as $value)
            {
                $count++;
                $attribute['values'][$count]['x'] = intval($value->effort);
                $attribute['values'][$count]['y'] = $value->impact;
                $attribute['values'][$count]['value'] = $value->quantity;
            }

            $attribute['values'] = array_values($attribute['values']);

            array_push($result, $attribute);

        }

        return $result;
    }
}