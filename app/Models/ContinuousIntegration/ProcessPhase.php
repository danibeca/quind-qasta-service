<?php

namespace App\Models\ContinuousIntegration;

use Illuminate\Database\Eloquent\Model;

class ProcessPhase extends Model
{
    protected $fillable = ['component_owner_id', 'name'];

}
