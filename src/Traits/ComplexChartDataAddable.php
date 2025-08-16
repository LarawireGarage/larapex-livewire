<?php

namespace LarawireGarage\LarapexLivewire\Traits;

/**
 * Common adding dataset features
 */
trait ComplexChartDataAddable
{
    public function addData(string $name, array $data, ?string $type = null)
    {
        $dataset = $this->getDataset();
        $values = ['name' => $name, 'data' => $data];
        if ($type) {
            $values['type'] = $type;
        }
        $dataset[] = $values;
        $this->set('dataset', $dataset);
        return $this;
    }
}