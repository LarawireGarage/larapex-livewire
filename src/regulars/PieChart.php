<?php

namespace LarawireGarage\LarapexLivewire\regulars;

use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\Traits\SimpleChartDataAddable;

class PieChart extends LarapexChart
{
    use SimpleChartDataAddable;

    public function __construct()
    {
        parent::__construct();
        $this->set('chart', 'type', 'pie');
    }

    public function addPieces(array $data)
    {
        return $this->addData($data);
    }
}
