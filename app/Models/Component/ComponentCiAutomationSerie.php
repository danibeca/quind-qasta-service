<?php

namespace App\Models\Component;
use Illuminate\Database\Eloquent\Model;

class ComponentCiAutomationSerie extends Model
{
    protected $fillable = ['process_phase_id', 'component_id', 'value'];
    public function processPhase()
    {
        return $this->belongsTo('App\Models\ContinuousIntegration\ProcessPhase');

    }
}
