<?php

namespace LarawireGarage\LarapexLivewire\wireables;

use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\wireables\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class WireableBarChart extends LarapexWirable
{
    use ComplexChartDataAddable;

    public function __construct()
    {
        parent::__construct();
        $this->set('chart', 'type', 'bar');
    }

    public function addBar(string $name, array $data)
    {
        return $this->addData($name, $data);
    }
}
