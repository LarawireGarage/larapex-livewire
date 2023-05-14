<?php

namespace LarawireGarage\LarapexLivewire\contracts;

interface ChartEssentials
{
    public function container();
    public function script();
    public function getOptionsAsArray();
    public function getOptionsAsJson();
}
