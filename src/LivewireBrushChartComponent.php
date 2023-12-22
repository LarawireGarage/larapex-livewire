<?php

namespace LarawireGarage\LarapexLivewire;

use Livewire\Component;
use Livewire\Attributes\On;
use LarawireGarage\LarapexLivewire\Traits\HasBrushChart;
use LarawireGarage\LarapexLivewire\Wireable\WireableBrushChart;

abstract class LivewireBrushChartComponent extends Component
{
    use HasBrushChart;

    /** @var WireableBrushChart $brushChart */
    protected $brushChart;

    // /** @var \LarawireGarage\LarapexLivewire\Wireable\LarapexWirable $mainChart */
    protected $mainChart;

    // /** @var \LarawireGarage\LarapexLivewire\Wireable\LarapexWirable $subChart */
    protected $subChart;

    /** @var string|null $selection_max */
    public $selection_max;
    /** @var string|null $selection_min */
    public $selection_min;


    /** initialize on mount */
    public $brush_chart_id;
    public $main_chart_id;
    public $sub_chart_id;

    /** initialize on mount */
    public $brush_chart_code;
    public $main_chart_code;
    public $sub_chart_code;

    /** options */
    public $brush_options;
    public $main_options;
    public $sub_options;

    /**
     * @var string|null $selectionType
     * @uses $selectionType x, y, xy
     */
    protected $selectionType;
    /** @var string|null $selectionMin */
    protected $selectionMin;
    /** @var string|null $selectionMax */
    protected $selectionMax;

    #[On('refresh:chart')]
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
        if (empty($parameters)) {
            return;
        }

        if (is_array($parameters[0])) {
            $this->hydrateInstanceProperties($parameters[0]);
            return;
        }

        $this->hydrateInstanceProperties($parameters);
    }
    private function hydrateInstanceProperties(array $properties = [])
    {
        array_walk($properties, function (&$value, $key) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            };
        });
    }

    public function setSelectionType($type)
    {
        $this->selectionType = $type;
        return $this;
    }
    public function setSelectionMax($max)
    {
        $this->selectionMax = $max;
        return $this;
    }
    public function setSelectionMin($min)
    {
        $this->selectionMin = $min;
        return $this;
    }

    abstract protected function buildMainChart();

    abstract protected function buildSubChart();

    abstract protected function dataSource();

    abstract protected function feedData();

    private function buildCharts()
    {
        $this->mainChart = $this->buildMainChart();
        $this->subChart = $this->buildSubChart();
    }
    private function feedCharts()
    {
        // list($this->mainChart, $this->subChart) = $this->feedData($this->mainChart, $this->subChart);
        $this->feedData();

        $this->brushChart = (new WireableBrushChart($this->brush_chart_id))
            ->addMainChart($this->mainChart)
            ->addSubChart($this->subChart)
            ->configureBrush();
    }
    private function configureSelection()
    {
        if (
            !empty($this->selectionType) &&
            !empty($this->selectionMin) &&
            !empty($this->selectionMax)
        )
            $this->brushChart->configureSelection(
                $this->selectionType,
                $this->selectionMin,
                $this->selectionMax
            );
    }
    private function extractOptions()
    {
        $this->main_options = $this->brushChart->getMainChart()->getOptionsAsArray();
        $this->sub_options = $this->brushChart->getSubChart()->getOptionsAsArray();
    }

    public function render()
    {
        $this->buildCharts();

        $this->feedCharts();

        $this->configureSelection();

        $this->extractOptions();

        return view('larapex-livewire::brush-chart-component', [
            // 'brushChart'       => $this->brushChart,
            // 'redraw'           => $this->redraw ?? false,
            // 'animate'          => $this->animate ?? false,
            // 'updateSyncCharts' => $this->updateSyncCharts ?? false,
        ]);
    }
}