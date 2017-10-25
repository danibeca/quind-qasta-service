<?php

namespace App\Models\Component;
use Illuminate\Database\Eloquent\Model;

class ComponentInformationSerie extends Model
{
    protected $fillable = ['systems', 'applications', 'debt', 'component_id'];

}
