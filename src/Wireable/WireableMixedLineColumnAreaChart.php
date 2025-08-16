<?php

namespace LarawireGarage\LarapexLivewire\Wireable;

use LarawireGarage\LarapexLivewire\Wireable\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class WireableMixedLineColumnAreaChart extends LarapexWirable
{
    use ComplexChartDataAddable;

    public function __construct($id = null, array $options = [])
    {
        parent::__construct($id, $options);
        $this->set('chart', 'type', 'line');
        $this->set('chart', 'stacked', false);
        $this->set('stroke', 'curve', 'smooth');
        $this->setFill([
            'opacity' => [0.85, 0.25, 1],
            'gradient' => [
                'inverseColors' => false,
                'shade' => 'light',
                'type' => "vertical",
                'opacityFrom' => 0.85,
                'opacityTo' => 0.55,
                'stops' => [0, 100, 100, 100]
            ]
        ]);

    }

    public function addLine(string $name, array $data)
    {
        return $this->addData($name, $data, 'line');
    }

    public function addColumn(string $name, array $data)
    {
        return $this->addData($name, $data, 'column');
    }

    public function addArea(string $name, array $data)
    {
        return $this->addData($name, $data, 'area');
    }
}
