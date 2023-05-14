<?php

namespace LarawireGarage\LarapexLivewire\Wireable;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\Wireable\LarapexWirable;
use LarawireGarage\LarapexLivewire\Traits\ComplexChartDataAddable;

class WireableBrushChart extends LarapexWirable
{
    use ComplexChartDataAddable;

    /** @var LarapexChart $chartMain */
    protected $chartMain; // all data chart
    /** @var LarapexChart $chartSub */
    protected $chartSub; // highlight data class
    /** @var string $brushID */
    protected $brushID; // container id
    protected $brushMaxHeight = 400; // container max fixed height

    public function __construct($id = null, $chartMain = null, $chartSub = null, array $options = [])
    {
        parent::__construct($id, $options);
        $this->chartMain = $chartMain;
        $this->chartSub = $chartSub;
    }

    private function initiate()
    {
        $this->brushID = $this->generateID();
        if (!empty($this->chartMain) && !empty($this->chartSub))
            $this->configureBrush($this->chartSub);
    }

    public function addMainChart(&$chart)
    {
        $this->chartMain = $chart;
        return $this;
    }
    public function addSubChart(&$chart)
    {
        $this->chartSub = $chart;
        if (!empty($this->chartMain)) {
            $this->configureBrush($chart);
        }
        return $this;
    }

    public function solveChartHeights()
    {
        // $this->chartSub->set('chart', 'height', (intval($this->brushMaxHeight) / 3) * 2);
        $this->chartMain->set('chart', 'height', intval((intval($this->brushMaxHeight) / 3) * 1));
        return $this;
    }

    public function configureBrush($targetChart = null)
    {
        $targetChart = $targetChart ?? $this->chartSub;

        if (!$targetChart) throw new Exception("Invalid Sub Chart");

        $this->chartMain->set('chart', 'brush', [
            'enabled' => true,
            'target' => $targetChart->getChartId(),
            'autoScaleYaxis' => true,
        ]);

        $this->chartMain
            ->tooltip(false)
            ->yAxis(false);

        $this->solveChartHeights();

        return $this;
    }
    /**
     * Add selection to main Chart
     * @param string $type possible ["x", "y", "xy"]
     * @param string|int $min min selected value
     * @param string|int $max max selected value
     * @param array $selectionInfo other options
     */
    public function configureSelection(string $type = 'x', $min = 0, $max = 100, array $selectionInfo = [])
    {
        // if ($selectionInfo) throw new Exception("Invalid Sub Chart");

        // possible x, y, xy
        $info = ['enabled' => true, 'type' => $type];

        // xaxis min|max selected value
        if ($type == 'x')  $info['xaxis'] = ['min' => $min, 'max' => $max];
        // yaxis min|max selected value
        if ($type == 'y')  $info['yaxis'] = ['min' => $min, 'max' => $max];
        // xaxis|yaxis min|max selected value
        if ($type == 'xy') $info['xaxis'] = ['min' => $min, 'max' => $max];

        $info = array_merge($info, $selectionInfo);
        if (!empty($info)) {
            $this->chartMain->set('chart', 'selection', $info);
        }
        return $this;
        // [
        //     'enabled' => true,
        //     'type' => 'x', // possible x, y, xy
        //     'fill' => [
        //         'color' => '#24292e',
        //         'opacity' => 0.1
        //     ],
        //     'stroke' => [
        //         'width' => 1,
        //         'dashArray' => 3,
        //         'color' => '#24292e',
        //         'opacity' => 0.4
        //     ],
        //     'xaxis' => [
        //         'min' => null, // xaxis min selected value
        //         'max' => null, // xaxis max selected value
        //     ],
        //     'yaxis' => [
        //         'min' => null, // yaxis min selected value
        //         'max' => null, // yaxis max selected value
        //     ]
        // ]
    }

    public function getMainChart()
    {
        return $this->chartMain;
    }
    public function getSubChart()
    {
        return $this->chartSub;
    }

    public function setMainChartHeight(int $height = 100)
    {
        $this->chartMain->set('chart', 'height', $height);
    }
    public function setSubChartHeight(int $height = 100)
    {
        $this->chartSub->set('chart', 'height', $height);
    }
    public function showMainChartTooltip(bool $show = true)
    {
        $this->chartMain->set('tooltip', 'enabled', $show);
        return $this;
    }
    public function showSubChartTooltip(bool $show = true)
    {
        $this->chartSub->set('tooltip', 'enabled', $show);
        return $this;
    }
    public function setMaxHeight($height = 400)
    {
        $this->brushMaxHeight = is_numeric($height) ? $height . 'px' : $height;
        $this->solveChartHeights();
        return $this;
    }

    public function container()
    {
        $this->chartMain->finalizeData();
        $this->chartSub->finalizeData();
        return View::make('charts.brush_container', [
            'brushId' => $this->brushID,
            'brushMaxHeight' => $this->brushMaxHeight,
            'idMain' => $this->chartMain->id,
            'idSub' => $this->chartSub->id
        ]);
    }
    public function script()
    {
        return View::make('charts.larapex_brush_script', [
            'chartMain' => $this->chartMain,
            'chartSub' => $this->chartSub
        ]);
    }
}
