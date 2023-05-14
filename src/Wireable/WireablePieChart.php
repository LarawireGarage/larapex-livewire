<?php

namespace LarawireGarage\LarapexLivewire\Wireable;

use LarawireGarage\LarapexLivewire\Wireable\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\SimpleChartDataAddable;

class WireablePieChart extends LarapexWirable
{
    use SimpleChartDataAddable;

    public function __construct($id = null, array $options = [])
    {
        parent::__construct($id, $options);
        $this->set('chart', 'type', 'pie');
    }

    public function addPieces(array $data)
    {
        return $this->addData($data);
    }
}
