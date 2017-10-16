<?php

namespace App\Utils\Transformers;


use App\Models\Component\QualityAttribute;
use Illuminate\Database\Eloquent\Collection;

class QATransformer
{

    public function transform(Collection $data)
    {
        $qas = $data->pluck('attribute_id')->unique();
        $countQA = 0;
        $resultData = null;
        $resultName = [];
        foreach ($qas as $qa)
        {


            $countQA++;
            array_push($resultName,
                ['balloonText'           => 'Criticidad:<b>[[y]]</b> Esfuerzo:<b>[[x]]</b><br>Cantidad:<b>[[value]]</b>',
                 'bullet'                => 'circle',
                 'lineAlpha'             => 0,
                 'valueField'            => 'value' . $countQA,
                 'xField'                => 'x' . $countQA,
                 'yField'                => 'y' . $countQA,
                 'fillAlphas'            => 0,
                 'maxBulletSize'         => 80,
                 'title'                 => QualityAttribute::find($qa)->name,

                 'minBulletSize'         => 15,
                 'bulletBorderAlpha'     => 1,
                 'bulletBorderThickness' => 2,
                 'bulletAlpha'           => 0.8
                ]);

            $count = 0;
            $values = $data->where('attribute_id', $qa);
            foreach ($values as $value)
            {
                $count++;
                $resultData[$count]['y' . $countQA] = 6-$value->impact;
                $resultData[$count]['x' . $countQA] = intval($value->effort);
                $resultData[$count]['value' . $countQA] = $value->quantity;
            }

        }

        return [array_values($resultName), array_values($resultData)];

        /*$qas = $data->pluck('attribute_id')->unique();
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

        return $resultData;*/



    }
}