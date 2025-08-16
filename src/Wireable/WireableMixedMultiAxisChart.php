<?php

namespace LarawireGarage\LarapexLivewire\Wireable;

use LarawireGarage\LarapexLivewire\Wireable\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class WireableMixedMultiAxisChart extends LarapexWirable
{
    use ComplexChartDataAddable;

    public function __construct($id = null, array $options = [])
    {
        parent::__construct($id, $options);
        $this->set('chart', 'type', 'line');
        $this->set('chart', 'stacked', false);
    }

    public function addLine(string $name, array $data)
    {
        return $this->addData($name, $data, 'line');
    }

    public function addColumn(string $name, array $data)
    {
        return $this->addData($name, $data, 'column');
    }
}
