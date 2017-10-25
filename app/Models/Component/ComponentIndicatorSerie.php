<?php

namespace App\Models\Component;
use Illuminate\Database\Eloquent\Model;

class ComponentIndicatorSerie extends Model
{
    protected $fillable = ['component_id', 'indicator_id', 'value'];
}
