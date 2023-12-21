<?php

namespace LarawireGarage\LarapexLivewire\Traits;

/**
 * Common adding dataset features
 */
trait ComplexChartDataAddable
{
    public function addData(string $name, array $data)
    {
        $dataset = $this->getDataset();
        $dataset[] = ['name' => $name, 'data' => $data];
        $this->set('dataset', $dataset);
        return $this;
    }
}