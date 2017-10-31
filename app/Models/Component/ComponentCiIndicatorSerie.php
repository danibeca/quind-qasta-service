<?php

namespace App\Models\Component;
use Illuminate\Database\Eloquent\Model;

class ComponentCiIndicatorSerie extends Model
{
    protected $fillable = ['component_id', 'ci_indicator_id', 'value'];
}
