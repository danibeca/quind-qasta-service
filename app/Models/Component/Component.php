<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['id', 'tag_id'];

    public function indicatorSerie($indicatorId)
    {
        return $this->hasMany('App\Models\Component\ComponentIndicatorSerie')
            ->where('indicator_id', $indicatorId);
    }

    public function getIndicator($indicatorId)
    {
        return $this->indicatorSerie($indicatorId)
            ->whereCreatedAt(
                $this->indicatorSerie($indicatorId)->max('created_at')
            )->get()->first();
    }

}
