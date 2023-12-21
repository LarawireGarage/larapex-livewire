<?php

namespace LarawireGarage\LarapexLivewire;

use Livewire\Component;
use Livewire\Attributes\On;
use LarawireGarage\LarapexLivewire\Traits\HasChart;

abstract class LivewireChartComponent extends Component
{
    use HasChart;

    /** @var \LarawireGarage\LarapexLivewire\Wireable\LarapexWirable $chart */
    protected $chart;

    /** initialize on mount */
    public $chart_id;

    /** initialize on mount */
    public $chart_code;

    /** options */
    public $options;

    abstract public function build();

    #[On('update:chart')]
    public function updateChart(...$params)
    {
        $this->hydrateParameters($params);
    }
    #[On('update:chart:series')]
    public function updateChartSeries(...$params)
    {
        $this->hydrateParameters($params);
    }
    #[On('reset:chart')]
    public function resetChart(...$params)
    {
        $this->hydrateParameters($params);
    }

    private function hydrateParameters($parameters = [])
    {
        if (is_array($parameters[0])) {
            $this->hydrateInstanceProperties($parameters[0]);
            // $this->dispatch('larapex-chart-update');
            return;
        }

        $this->hydrateInstanceProperties($parameters);
        // $this->dispatch('larapex-chart-update');
    }
    private function hydrateInstanceProperties(array $properties = [])
    {
        array_walk($properties, function (&$value, $key) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            };
        });
    }

    public function render()
    {
        $this->build();
        $this->options = $this->chart->getOptionsAsArray();

        return view('larapex-livewire::chart-component', [
            // 'chart'            => $this->chart,
            // 'options'          => $this->options,
            // 'redraw'           => $this->redraw ?? false,
            // 'animate'          => $this->animate ?? false,
            // 'updateSyncCharts' => $this->updateSyncCharts ?? false,
        ]);
    }
}