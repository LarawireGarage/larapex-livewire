<?php

namespace LarawireGarage\LarapexLivewire;

use Livewire\Component;
use LarawireGarage\LarapexLivewire\Traits\HasBrushChart;
use LarawireGarage\LarapexLivewire\Wireable\WireableBrushChart;

abstract class LivewireBrushChartComponent extends Component
{
    use HasBrushChart;

    /** @var \LarawireGarage\LarapexLivewire\Wireable\WireableBrushChart $brushChart */
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
        $this->main_options = $this->brushChart->getMainChart()->getOptionsAsJson();
        $this->sub_options = $this->brushChart->getSubChart()->getOptionsAsJson();
    }

    public function render()
    {
        $this->buildCharts();

        $this->feedCharts();

        $this->configureSelection();

        $this->extractOptions();

        return view('larapex-livewire::brush-chart-component', [
            'brushChart' => $this->brushChart,
            'redraw' => $this->redraw ?? false,
            'animate' => $this->animate ?? false,
            'updateSyncCharts' => $this->updateSyncCharts ?? false,
        ]);
    }
}
