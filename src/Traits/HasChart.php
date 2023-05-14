<?php

namespace LarawireGarage\LarapexLivewire\Traits;

use Illuminate\Support\Str;
use LarawireGarage\LarapexLivewire\LarapexChart;

/**
 * Initialize Livewire Chart component
 */
trait HasChart
{

    /**
     * update options param : redraw
     * false : only update (default)
     * true : redraw all charts
     */
    public $redraw = false;
    /** update [options | series] param : animate */
    public $animate = true;
    /** update options param : updateSyncCharts */
    public $updateSyncCharts = false;

    /** reset params */
    public $update = false;
    /** reset params */
    public $zoom = true;

    public function mountHasChart()
    {
        // $this->chart = new $this->chartType;
        $this->chart_id = $this->generateID();
        $this->chart_code = $this->generateShortCode();
    }
    public function generateID()
    {
        return (new LarapexChart())->generateID();
    }
    public function generateShortCode()
    {
        return Str::random(5);
    }
    public function chartRedraw($canRedraw = true)
    {
        $this->redraw = $canRedraw;
        return $this;
    }
    public function chartAnimate($canAnimate = true)
    {
        $this->animate = $canAnimate;
        return $this;
    }
    public function chartUpdateSyncCharts($canUpdate = false)
    {
        $this->updateSyncCharts = $canUpdate;
        return $this;
    }
}
