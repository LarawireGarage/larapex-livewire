<?php

namespace LarawireGarage\LarapexLivewire\Traits;

/**
 * Common adding dataset features
 */
trait SimpleChartDataAddable
{
    public function addData(array $data)
    {
        $dataset = $this->getDataset();
        $dataset = $data;
        $this->set('dataset', $dataset);
        return $this;
    }
}
