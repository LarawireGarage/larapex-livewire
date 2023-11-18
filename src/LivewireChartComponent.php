<?php

namespace LarawireGarage\LarapexLivewire;

use Livewire\Component;
use LarawireGarage\LarapexLivewire\Traits\HasChart;
use Livewire\Attributes\On;

abstract class LivewireChartComponent extends Component
{
    use HasChart;

    /** @var \LarawireGarage\LarapexLivewire\wireables\LarapexWirable $chart */
    protected $chart;

    /** initialize on mount */
    public $chart_id;

    /** initialize on mount */
    public $chart_code;

    /** options */
    public $options;

    abstract public function build();

    #[On('update:options')]
    public function changeOptions()
    {
        dd('in change options method');
        $this->build();
        $this->options = $this->chart->getOptionsAsJson();

        return $this->dispatch(
            'apex:chart:update:options',
            chart: $this->chart,
            options: $this->options,
            redraw: $this->redraw ?? false,
            animate: $this->animate ?? false,
            updateSyncCharts: $this->updateSyncCharts ?? false,
        )->self();
    }

    public function render()
    {
        $this->build();
        $this->options = $this->chart->getOptionsAsJson();

        return view('larapex-livewire::chart-component', [
            'chart' => $this->chart,
            'options' => $this->options,
            'redraw' => $this->redraw ?? false,
            'animate' => $this->animate ?? false,
            'updateSyncCharts' => $this->updateSyncCharts ?? false,
        ]);
    }
}
