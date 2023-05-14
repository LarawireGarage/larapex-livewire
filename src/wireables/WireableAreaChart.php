<?php

namespace LarawireGarage\LarapexLivewire\wireables;

use LarawireGarage\LarapexLivewire\wireables\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class WireableAreaChart extends LarapexWirable
{
    use ComplexChartDataAddable;

    public function __construct($id = null, array $options = [])
    {
        // parent::__construct($id, $options);

        $this->set('chart', 'type', 'area');
    }

    public function addArea(string $name, array $data)
    {
        return $this->addData($name, $data);
    }
}
