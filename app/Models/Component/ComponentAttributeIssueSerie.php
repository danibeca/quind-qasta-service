<?php

namespace App\Models\Component;
use Illuminate\Database\Eloquent\Model;

class ComponentAttributeIssueSerie extends Model
{
    protected $fillable = ['attribute_id', 'impact', 'effort', 'quantity', 'component_id'];
}
