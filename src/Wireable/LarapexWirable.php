<?php

namespace LarawireGarage\LarapexLivewire\Wireable;

use Livewire\Wireable;
use LarawireGarage\LarapexLivewire\LarapexChart;

abstract class LarapexWirable extends LarapexChart implements Wireable
{
    public function __construct($id = null, array $options = [])
    {
        parent::__construct($id, $options);
    }

    public function toLivewire()
    {
        //
    }

    public static function fromLivewire($value)
    {
        //
    }
}
