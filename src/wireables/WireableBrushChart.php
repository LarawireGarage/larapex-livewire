<?php

namespace LarawireGarage\LarapexLivewire\wireables;

use Exception;
use Illuminate\Support\Facades\View;
use LarawireGarage\LarapexLivewire\LarapexChart;
use LarawireGarage\LarapexLivewire\wireables\LarapexWirable;
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

    public function __construct($chartMain, $chartSub)
    {
        parent::__construct();
        $this->chartMain = $chartMain ?? null;
        $this->chartSub = $chartSub ?? null;
        $this->brushID = $this->generateID();
        $this->configureBrush($this->chartSub);
    }

    public function addMainChart($chart)
    {
        $this->chartMain = $chart;
        return $this;
    }
    public function addSubChart($chart)
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
            'target' => $targetChart->id,
            'autoScaleYaxis' => true,
        ]);
        $this->solveChartHeights();
        return $this;
    }
    public function configureSelection(string $type = 'x', $xmin = 0, $xmax = 100, array $selectionInfo = [])
    {
        // if ($selectionInfo) throw new Exception("Invalid Sub Chart");
        $info = [
            'enabled' => true,
            'type' => $type, // possible x, y, xy
            'xaxis' => [
                'min' => $xmin, // xaxis min selected value
                'max' => $xmax, // xaxis max selected value
            ],
        ];
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
