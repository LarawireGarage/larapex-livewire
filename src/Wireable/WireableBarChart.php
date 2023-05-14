<?php

namespace LarawireGarage\LarapexLivewire\Wireable;

use LarawireGarage\LarapexLivewire\Wireable\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class WireableBarChart extends LarapexWirable
{
    use ComplexChartDataAddable;

    public function __construct($id = null, array $options = [])
    {
        parent::__construct($id, $options);
        $this->set('chart', 'type', 'bar');
    }

    public function addBar(string $name, array $data)
    {
        return $this->addData($name, $data);
    }
}
