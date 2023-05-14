<?php

namespace LarawireGarage\LarapexLivewire\regulars;

use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class LineChart extends LarapexChart
{
    use ComplexChartDataAddable;

    public function __construct()
    {
        parent::__construct();
        $this->set('chart', 'type', 'line');
    }

    public function addLine(string $name, array $data)
    {
        return $this->addData($name, $data);
    }
}
