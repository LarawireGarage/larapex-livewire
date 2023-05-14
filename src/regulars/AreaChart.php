<?php

namespace LarawireGarage\LarapexLivewire\regulars;

use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class AreaChart extends LarapexChart
{
    use ComplexChartDataAddable;

    public function __construct()
    {
        parent::__construct();
        $this->set('chart', 'type', 'area');
    }

    public function addArea(string $name, array $data)
    {
        return $this->addData($name, $data);
    }
}
