<?php

namespace LarawireGarage\LarapexLivewire\regulars;

use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class BarChart extends LarapexChart
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
