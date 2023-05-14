<?php

namespace LarawireGarage\LarapexLivewire\wireables;

use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\wireables\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\SimpleChartDataAddable;

class WireableDonutChart extends LarapexWirable
{
    use SimpleChartDataAddable;

    public function __construct()
    {
        parent::__construct();
        $this->set('chart', 'type', 'donut');
    }

    public function addPieces(array $data)
    {
        return $this->addData($data);
    }
}
