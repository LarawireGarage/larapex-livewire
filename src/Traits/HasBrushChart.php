<?php

namespace LarawireGarage\LarapexLivewire\Traits;

use Illuminate\Support\Str;
use LarawireGarage\LarapexLivewire\LarapexChart;

/**
 * Initialize Livewire Chart component
 */
trait HasBrushChart
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
    public $updateSyncCharts = true;

    /** reset params */
    public $update = false;
    /** reset params */
    public $zoom = true;

    public function mountHasBrushChart()
    {
        // $this->chart = new $this->chartType;
        $this->chart_id = $this->generateID();
        $this->chart_code = $this->generateShortCode();

        $this->brush_chart_id = $this->generateID();
        $this->main_chart_id = $this->generateID();
        $this->sub_chart_id = $this->generateID();

        $this->brush_chart_code = $this->generateShortCode();
        $this->main_chart_code = $this->generateShortCode();
        $this->sub_chart_code = $this->generateShortCode();
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
