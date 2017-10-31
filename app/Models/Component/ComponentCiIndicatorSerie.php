<?php

namespace App\Models\Component;
use Illuminate\Database\Eloquent\Model;

class ComponentCiIndicatorSerie extends Model
{
    protected $fillable = ['component_id', 'ci_indicator_id', 'value'];

    public function ciIndicator($indicatorId)
    {
        return $this->hasMany('App\Models\ContinuousIntegration', CiIndicator)
            ->where('ci_indicator_id', $indicatorId);
    }
}
