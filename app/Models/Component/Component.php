<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['id', 'type_id'];


    public function informationSeries()
    {
        return $this->hasMany('App\Models\Component\ComponentInformationSerie');

    }

    public function attributeIssueSeries()
    {
        return $this->hasMany('App\Models\Component\ComponentAttributeIssueSerie');

    }

    public function ciAutomationSerie()
    {
        return $this->hasMany('App\Models\Component\ComponentCiAutomationSerie');

    }

    public function indicatorSerie($indicatorId)
    {
        return $this->hasMany('App\Models\Component\ComponentCiAutomationSerie')
            ->where('indicator_id', $indicatorId);
    }

    public function ciIndicatorSerie($indicatorId)
    {
        return $this->hasMany('App\Models\Component\ComponentCiIndicatorSerie')
            ->where('ci_indicator_id', $indicatorId);
    }

    public function getCiAutomation()
    {
        return $this->ciAutomationSerie()
            ->whereCreatedAt(
                $this->ciAutomationSerie()->max('created_at')
            )->get();
    }

    public function getIndicator($indicatorId)
    {
        return $this->indicatorSerie($indicatorId)
            ->whereCreatedAt(
                $this->indicatorSerie($indicatorId)->max('created_at')
            )->get()->first();
    }

    public function getCiIndicator($indicatorId)
    {
        return $this->ciIndicatorSerie($indicatorId)
            ->whereCreatedAt(
                $this->ciIndicatorSerie($indicatorId)->max('created_at')
            )->get()->first();
    }

    public function getAttributeIssues()
    {
        return $this->attributeIssueSeries()
            ->whereCreatedAt(
                $this->attributeIssueSeries()->max('created_at')
            )->get();
    }

    public function getInformation()
    {
        return $this->informationSeries()
            ->whereCreatedAt(
                $this->informationSeries()->max('created_at')
            )->get()->first();
    }

}
