<?php

namespace LarawireGarage\LarapexLivewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use LarawireGarage\LarapexLivewire\contracts\ChartEssentials;

class LarapexChart implements ChartEssentials
{
    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    |
    | This class build the chart by passing setters to the object, it will
    | use the method container and scripts to generate a JSON
    | in blade views, it works also with Vue JS components
    |
    */

    /* chart */
    public $id;
    // public $id_sub; //  for brush type
    // public $type_sub; //  for brush type
    public $chart = [
        'id'                   => 'SampleChart',
        'background'           => '#fff0',
        // 'brush' => [
        //     'enabled' => false,
        // 'target' => 'chart2',
        // 'autoScaleYaxis' => false,
        // ],
        // 'defaultLocale' => 'en',
        // 'dropShadow' => [],
        // 'fontFamily' => '',
        // 'foreColor' => '',
        // 'group' => 'group1', // only for sync charts
        // 'events' =>, // not needed yet
        'height'               => 300,
        // 'offsetX' => 0,
        // 'offsetY' => 0,
        // 'parentHeightOffset' => 15,
        'redrawOnParentResize' => true,
        // 'redrawOnWindowResize' => true,
        // 'selection' => [
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
        // ],
        /** only for brush charts */
        // 'sparkline' => ['enabled' => false],
        // 'stacked' => false,
        // 'stackType' => 'normal',
        'toolbar'              => ['show' => false],
        // 'type' => 'line',
        // 'width' => '100%',
        // 'zoom' => [],
    ];
    /** colors
     * @var array $colors
     */
    public $colors = [];
    /** data labels */
    public $dataLabels = [
        // 'enabled' => false,
        // 'onSeries' => [],
        // // 'formatter' => null, // (callback func) no need yet
        // 'textAnchor' => 'middle',
        // 'distributed' => false,
        // 'offsetX' => 0,
        // 'offsetY' => 0,
        // 'styles' => [],
        // 'background' => [
        //     'enabled' => false,
        // foreColor: '#fff',
        // padding: 4,
        // borderRadius: 2,
        // borderWidth: 1,
        // borderColor: '#fff',
        // opacity: 0.9,
        // dropShadow: [
        //     enabled: false,
        //     top: 1,
        //     left: 1,
        //     blur: 1,
        //     color: '#000',
        //     opacity: 0.45
        // ]
        // ],
        // 'dropShadow' => [
        //     'enabled' => false,
        //     // top: 1,
        //     // left: 1,
        //     // blur: 1,
        //     // color: '#000',
        //     // opacity: 0.45
        // ],
    ];
    /** fill */
    public $fill = [
        // 'type' => 'solid',
        // 'colors' => [],
        // 'opacity' => 0.9,
        // 'gradient' => [
        //     'shade' => 'dark', // possible : light,dark
        //     'type' => "horizontal", // possible : horizontal, vertical, diagonal1, diagonal2
        //     'shadeIntensity' => 0.5,
        //     'gradientToColors' => [
        //         /** chart.colors => TO => fill.gradient.gradientToColors */
        //     ],
        //     'inverseColors' => true,
        //     'opacityFrom' => 1,
        //     'opacityTo' => 1,
        //     'stops' => [0, 100], // example : [0, 50, 100]
        //     'colorStops' => []
        // ],
    ];
    /** forecastDataPoints */
    public $forecastDataPoints = [
        'count'       => 0,
        'fillOpacity' => 0.5,
        'strokeWidth' => 4,
        'dashArray'   => 4,
    ];
    /** @var array $grid */
    public $grid = [
        'show' => false,
        // 'borderColor' => '#90A4AE',
        // 'strokeDashArray' => 0,
        // 'position' => 'back', // possible : front, back
        // 'xaxis' => ['lines' => ['show' => false]],
        // 'yaxis' => ['lines' => ['show' => false]],
        // row: {
        //     colors: '#90A423',
        //     opacity: 0.5
        // },
        // column: {
        //     colors: '#9032AE',
        //     opacity: 0.5
        // },
        // padding: {
        //     top: 0,
        //     right: 0,
        //     bottom: 0,
        //     left: 0
        // },
    ];
    /** labels */
    public $labels = [];
    /** legends */
    public $legend = []; // not using yet
    /** markers */
    public $markers = [
        // 'size' => 0,
        // 'colors' => [],
        // 'strokeColors' => '#fff',
        // 'strokeWidth' => 2,
        // 'strokeOpacity' => 0.9,
        // 'strokeDashArray' => 0,
        // 'fillOpacity' => 1,
        // 'discrete' => [],
        // 'shape' => "circle",
        // 'radius' => 2,
        // 'offsetX' => 0,
        // 'offsetY' => 0,
        // 'onClick' => null,
        // 'onDblClick' => null,
        // 'showNullDataPoints' => true,
        // 'hover' => [
        //     'size' => 7,
        //     'sizeOffset' => 3
        // ]
    ];
    /** noData */
    public $noData = [
        'text'          => 'No Data',
        'align'         => 'center',
        'verticalAlign' => 'middle',
        // 'offsetX' => 0,
        // 'offsetY' => 0,
        // 'style' => [
        //     'color' => '#111',
        //     'fontSize' => '14px',
        //     'fontFamily' => null
        // ]
    ];
    /** series */
    public $dataset = [];
    /** states */
    public $states = [
        // not using yet
        // normal: {
        //     filter: {
        //         type: 'none',
        //         value: 0,
        //     }
        // },
        // hover: {
        //     filter: {
        //         type: 'lighten',
        //         value: 0.15,
        //     }
        // },
        // active: {
        //     allowMultipleDataPointsSelection: false,
        //     filter: {
        //         type: 'darken',
        //         value: 0.35,
        //     }
        // },
    ];
    /** stroke */
    public $stroke = [
        // 'show' => true,
        // 'curve' => 'smooth',
        // 'lineCap' => 'butt',
        // 'colors' => [],
        // 'width' => 2,
        // 'dashArray' => 0,
    ];
    /** subtitle */
    public $subtitle = [
        // 'text' => 'Sub title',
        // 'align' => 'left', // subtitlePosition
        // 'margin' => 10,
        // 'offsetX' => 0,
        // 'offsetY' => 0,
        // 'floating' => false,
        // 'style' => [
        //     'fontSize' => '12px',
        //     'fontWeight' => 'normal',
        //     'fontFamily' => null,
        //     'color' => '#9699a2'
        // ],
    ];
    /** theme */
    public $theme = [
        'mode' => 'dark',
        // possible : light, dark
        // 'palette' => 'palette1', // possible : palette1 - palette10
        // 'monochrome' => [
        //     'enabled' => false,
        //     'color' => '#255aee',
        //     'shadeTo' => 'light', // possible : light, dark
        //     'shadeIntensity' => 0.65
        // ],
    ];
    /** title */
    public $title = [
        // 'text' => '',
        // 'align' => 'left',
        // 'margin' => 10,
        // 'offsetX' => 0,
        // 'offsetY' => 0,
        // 'floating' => false,
        // 'style' => [
        //     'fontSize' => '14px',
        //     'fontWeight' => 'bold',
        //     'fontFamily' => null,
        //     'color' => '#263238'
        // ],
    ];
    /** tooltip */
    public $tooltip = [
        'enabled'        => true,
        // 'enabledOnSeries' => [],
        // 'shared' => true,
        // 'followCursor' => false,
        // 'intersect' => false,
        // 'inverseOrder' => false,
        // 'custom'=> null,
        // 'fillSeriesColor' => false,
        'theme'          => 'dark',
        // 'style' => [
        //     'fontSize' => '12px',
        //     'fontFamily' => null
        // ],
        'onDatasetHover' => [
            'highlightDataSeries' => false,
        ],
        // x: {
        //     show: true,
        //     format: 'dd MMM',
        //     formatter: null,
        // },
        // y: {
        //     formatter: null,
        //     title: {
        //         formatter: (seriesName) => seriesName,
        //     },
        // },
        // z: {
        //     formatter: null,
        //     title: 'Size: '
        // },
        // marker: {
        //     show: true,
        // },
        // items: {
        //     display: flex,
        // },
        // fixed: {
        //     enabled: false,
        //     position: 'topRight',
        //     offsetX: 0,
        //     offsetY: 0,
        // },
    ];
    /** plotOptions[horizontal] */
    public $plotOptions = [
        // 'bar' => ['horizontal' => false], // horizontal
    ];
    /** xAxis */
    public $xAxis = [
        // 'type' => 'category',
        // 'categories' => [],
        // 'tickAmount' => 3,
        'tickPlacement' => 'on',
        // 'min' => null,
        // 'max' => null,
        // 'range' => null,
        // 'floating' => false,
        // 'decimalsInFloat' => null,
        // 'overwriteCategories' => null,
        // 'position' => 'bottom',
        // 'labels' => [
        //     'show' => true,
        //     'rotate' => -45,
        //     'rotateAlways' => false,
        //     'hideOverlappingLabels' => true,
        //     'showDuplicates' => false,
        //     'trim' => false,
        //     'minHeight' => null,
        //     'maxHeight' => 120,
        //     'style' => [
        //         'colors' => [],
        //         'fontSize' => '12px',
        //         'fontFamily' => 'Helvetica, Arial, sans-serif',
        //         'fontWeight' => 400,
        //         'cssClass' => 'apexcharts-xaxis-label',
        //     ],
        //     'offsetX' => 0,
        //     'offsetY' => 0,
        //     // 'format' => null,
        //     // 'formatter' => null,
        //     'datetimeUTC' => true,
        //     'datetimeFormatter' => [
        //         'year' => 'yyyy',
        //         'month' => "MMM 'yy",
        //         'day' => 'dd MMM',
        //         'hour' => 'HH:mm',
        //     ],
        // ],
        // 'axisBorder' => [
        //     'show' => true,
        //     'color' => '#78909C',
        //     'height' => 1,
        //     'width' => '100%',
        //     'offsetX' => 0,
        //     'offsetY' => 0
        // ],
        // 'axisTicks' => [
        //     'show' => true,
        //     'borderType' => 'solid',
        //     'color' => '#78909C',
        //     'height' => 6,
        //     'offsetX' => 0,
        //     'offsetY' => 0
        // ],
        // 'title' => [
        //     'text' => '',
        //     'offsetX' => 0,
        //     'offsetY' => 0,
        //     'style' => [
        //         'color' => null,
        //         'fontSize' => '12px',
        //         'fontFamily' => 'Helvetica, Arial, sans-serif',
        //         'fontWeight' => 600,
        //         'cssClass' => 'apexcharts-xaxis-title',
        //     ],
        // ],
        // 'crosshairs' => [
        // show: true,
        // width: 1,
        // position: 'back',
        // opacity: 0.9,
        // stroke: {
        //     color: '#b6b6b6',
        //     width: 0,
        //     dashArray: 0,
        // },
        // fill: {
        //     type: 'solid',
        //     color: '#B1B9C4',
        //     gradient: {
        //         colorFrom: '#D8E3F0',
        //         colorTo: '#BED1E6',
        //         stops: [0, 100],
        //         opacityFrom: 0.4,
        //         opacityTo: 0.5,
        //     },
        // },
        // dropShadow: {
        //     enabled: false,
        //     top: 0,
        //     left: 0,
        //     blur: 1,
        //     opacity: 0.4,
        // },
        // ],
        // 'tooltip' => [
        //     'enabled' => true,
        // formatter: null,
        // offsetY: 0,
        // style:[
        // fontSize: 0,
        // fontFamily: 0,
        // ],
        // ],
    ];

    public $yAxis = [
        // 'show' => true,
        // 'showAlways' => true,
        // showForNullSeries: true,
        // seriesName: null,
        // opposite: false,
        // reversed: false,
        // logarithmic: false,
        // tickAmount: 6,
        // min: 6,
        // max: 6,
        // forceNiceScale: false,
        // floating: false,
        // decimalsInFloat: null,
        // labels: {
        //     show: true,
        //     align: 'right',
        //     minWidth: 0,
        //     maxWidth: 160,
        //     style: {
        //         colors: [],
        //         fontSize: '12px',
        //         fontFamily: 'Helvetica, Arial, sans-serif',
        //         fontWeight: 400,
        //         cssClass: 'apexcharts-yaxis-label',
        //     },
        //     offsetX: 0,
        //     offsetY: 0,
        //     rotate: 0,
        //     formatter: (value) => {
        //         return val
        //     },
        // },
        // axisBorder: {
        //     show: true,
        //     color: '#78909C',
        //     offsetX: 0,
        //     offsetY: 0
        // },
        // axisTicks: {
        //     show: true,
        //     borderType: 'solid',
        //     color: '#78909C',
        //     width: 6,
        //     offsetX: 0,
        //     offsetY: 0
        // },
        // title: {
        //     text: null,
        //     rotate: -90,
        //     offsetX: 0,
        //     offsetY: 0,
        //     style: {
        //         color: null,
        //         fontSize: '12px',
        //         fontFamily: 'Helvetica, Arial, sans-serif',
        //         fontWeight: 600,
        //         cssClass: 'apexcharts-yaxis-title',
        //     },
        // },
        // crosshairs: {
        //     show: true,
        //     position: 'back',
        //     stroke: {
        //         color: '#b6b6b6',
        //         width: 1,
        //         dashArray: 0,
        //     },
        // },
        // tooltip: {
        //     enabled: true,
        //     offsetX: 0,
        // },
    ];
    private $chartLetters = 'abcdefghijklmnopqrstuvwxyz';


    /*
    |--------------------------------------------------------------------------
    | Constructors
    |--------------------------------------------------------------------------
    */

    public function __construct($id = null, array $options = [])
    {
        $this->id($id);

        $this->colors = config('larapex-livewire.chart_colors');

        $this->set('chart', 'fontFamily', config('larapex-livewire.font_family'));
        $this->set('chart', 'foreColor', config('larapex-livewire.font_color'));
        $this->set('chart', 'background', config('larapex-livewire.background_color'));

        if (!empty($options))
            $this->fill($options);

        // $this->set('chart', 'foreColor', 'Nunito');
        // $this->set('chart', 'background', '#ffffff00');
        // $this->set('chart', 'fontFamily', '#ffffff00');
        // $this->id_sub = $this->generateID();
        // $this->type_sub = 'line';
        // $this->horizontal = json_encode(['horizontal' => false]);
        // $this->xAxis = json_encode([]);
        // $this->grid = json_encode(['show' => false]);
        // $this->markers = json_encode(['show' => false]);
        // $this->toolbar = json_encode(['show' => false]);
        // $this->zoom = json_encode(['enabled' => true]);
        // $this->dataLabels = json_encode(['enabled' => false]);
        // $this->fill = json_encode(['type'   => 'solid']);
        // $this->noData = json_encode(['text' => 'No Data']);
        // return $this;
    }

    public function fill(array $options = [])
    {
        foreach ($options as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'chart':
                        $this->chart = $value;
                        break;
                    case 'colors':
                        $this->colors = $value;
                        break;
                    case 'dataLabels':
                        $this->dataLabels = $value;
                        break;
                    case 'fill':
                        $this->fill = $value;
                        break;
                    case 'forecastDataPoints':
                        $this->forecastDataPoints = $value;
                        break;
                    case 'grid':
                        $this->grid = $value;
                        break;
                    case 'labels':
                        $this->labels = $value;
                        break;
                    case 'legend':
                        $this->legend = $value;
                        break;
                    case 'markers':
                        $this->markers = $value;
                        break;
                    case 'noData':
                        $this->noData = $value;
                        break;
                    case 'series':
                        $this->dataset = $value;
                        break;
                    case 'states':
                        $this->states = $value;
                        break;
                    case 'stroke':
                        $this->stroke = $value;
                        break;
                    case 'subtitle':
                        $this->subtitle = $value;
                        break;
                    case 'theme':
                        $this->theme = $value;
                        break;
                    case 'title':
                        $this->title = $value;
                        break;
                    case 'tooltip':
                        $this->tooltip = $value;
                        break;
                    case 'plotOptions':
                        $this->plotOptions = $value;
                        break;
                    case 'xaxis':
                        $this->xAxis = $value;
                        break;
                    case 'yaxis':
                        $this->yAxis = $value;
                        break;

                    default:
                        break;
                }
            }
        }
    }

    public function generateID()
    {
        return substr(str_shuffle(str_repeat($x = $this->chartLetters, ceil(25 / strlen($x)))), 1, 25);
    }
    public function container()
    {
        return View::make('charts.container', ['id' => $this->id]);
    }
    public function script()
    {
        $this->finalizeData();
        return View::make('charts.larapex_script', ['chart' => $this]);
    }

    public function getOptionsAsJson()
    {
        return json_encode($this->getOptionsAsArray(), JSON_PRETTY_PRINT);
    }
    public function getOptionsAsArray()
    {
        $options = [
            'chart'              => $this->chart,
            'colors'             => $this->colors,
            'dataLabels'         => $this->dataLabels,
            'fill'               => $this->fill,
            'forecastDataPoints' => $this->forecastDataPoints,
            'grid'               => $this->grid,
            'labels'             => $this->labels,
            'legend'             => $this->legend,
            'markers'            => $this->markers,
            'noData'             => $this->noData,
            'series'             => $this->dataset,
            'states'             => $this->states,
            'stroke'             => $this->stroke,
            'subtitle'           => $this->subtitle,
            'theme'              => $this->theme,
            'title'              => $this->title,
            'tooltip'            => $this->tooltip,
            'plotOptions'        => $this->plotOptions,
            'xaxis'              => $this->xAxis,
            'yaxis'              => $this->yAxis,
        ];
        $options = collect($options)->filter(fn($option) => !empty($option))->all();
        return $options;
    }

    protected function finalizeData()
    {
        $this->chart = json_encode($this->chart);
        $this->colors = json_encode($this->colors);
        $this->dataLabels = json_encode($this->dataLabels);
        $this->fill = json_encode($this->fill);
        $this->forecastDataPoints = json_encode($this->forecastDataPoints);
        $this->grid = json_encode($this->grid);
        $this->labels = json_encode($this->labels);
        $this->legend = json_encode($this->legend);
        $this->markers = json_encode($this->markers);
        $this->noData = json_encode($this->noData);
        $this->dataset = json_encode($this->dataset);
        $this->states = json_encode($this->states);
        $this->stroke = json_encode($this->stroke);
        $this->subtitle = json_encode($this->subtitle);
        $this->theme = json_encode($this->theme);
        $this->title = json_encode($this->title);
        $this->tooltip = json_encode($this->tooltip);
        $this->plotOptions = json_encode($this->plotOptions);
        $this->xAxis = json_encode($this->xAxis);
        $this->yAxis = json_encode($this->yAxis);
    }

    public function set(string $var, $opt = null, $val = null)
    {
        if (property_exists($this, $var)) {
            if (func_num_args() == 2) {
                $this->$var = $opt;
            } else {
                if (!is_array($this->$var))
                    $this->$var = [];
                Arr::set($this->$var, $opt, $val);
            }
        }
        return $this;
    }

    public function getAsObject(array $array)
    {
        return json_decode(json_encode($array));
    }
    /**
     * @param \Illuminate\Support\Carbon|string $dateTime
     * @return int time in milliseconds
     */
    public static function getChartableDateTime($dateTime = null)
    {
        $timestamp = null;
        if ($dateTime instanceof Carbon) {
            $timestamp = $dateTime->timestamp;
        } elseif (is_string($dateTime) && !empty($dateTime)) {
            $timestamp = strtotime($dateTime);
        }

        return !empty($timestamp) && is_numeric($timestamp) ? intval($timestamp) * 1000 : null;
    }

    /**
     * |--------------------------------------------------------------------------
     * | Getters
     * |--------------------------------------------------------------------------
     */

    /**
     * Get the value of yAxis
     */
    public function getYAxis()
    {
        return $this->getAsObject($this->yAxis);
    }

    /**
     * Get the value of xAxis
     */
    public function getXAxis()
    {
        return $this->getAsObject($this->xAxis);
    }

    /**
     * Get the value of plotOptions
     */
    public function getPlotOptions()
    {
        return $this->getAsObject($this->plotOptions);
    }

    /**
     * Get the value of tooltip
     */
    public function getTooltip()
    {
        return $this->getAsObject($this->tooltip);
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->getAsObject($this->title);
    }

    /**
     * Get the value of theme
     */
    public function getTheme()
    {
        return $this->getAsObject($this->theme);
    }

    /**
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->getAsObject($this->subtitle);
    }

    /**
     * Get the value of stroke
     */
    public function getStroke()
    {
        return $this->getAsObject($this->stroke);
    }

    /**
     * Get the value of states
     */
    public function getStates()
    {
        return $this->getAsObject($this->states);
    }

    /**
     * Get the value of dataset
     */
    public function getDataset()
    {
        return $this->getAsObject($this->dataset);
    }

    /**
     * Get the value of noData
     */
    public function getNoData()
    {
        return $this->getAsObject($this->noData);
    }

    /**
     * Get the value of markers
     */
    public function getMarkers()
    {
        return $this->getAsObject($this->markers);
    }

    /**
     * Get the value of legend
     */
    public function getLegend()
    {
        return $this->getAsObject($this->legend);
    }

    /**
     * Get the value of labels
     */
    public function getLabels()
    {
        return $this->getAsObject($this->labels);
    }

    /**
     * Get the value of grid
     */
    public function getGrid()
    {
        return $this->getAsObject($this->grid);
    }

    /**
     * Get the value of forecastDataPoints
     */
    public function getForecastDataPoints()
    {
        return $this->getAsObject($this->forecastDataPoints);
    }

    /**
     * Get the value of fill
     */
    public function getFill()
    {
        return $this->getAsObject($this->fill);
    }

    /**
     * Get the value of dataLabels
     */
    public function getDataLabels()
    {
        return $this->getAsObject($this->dataLabels);
    }

    /**
     * Get the value of colors
     */
    public function getColors(): array
    {
        return $this->getAsObject($this->colors);
    }

    /**
     * Get the value of chart
     */
    public function getChart()
    {
        return $this->getAsObject($this->chart);
    }
    /**
     * Get the value of chart
     */
    public function getChartId()
    {
        return $this->chart['id'];
    }

    /**
     * |--------------------------------------------------------------------------
     * | Setters
     * |--------------------------------------------------------------------------
     */

    /**
     * Set the value of chart
     *
     * @return  self
     */
    public function setChart($chart)
    {
        $this->chart = $chart;

        return $this;
    }

    /**
     * Set the value of colors
     *
     * @return  self
     */
    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }

    /**
     * Set the value of dataLabels
     *
     * @return  self
     */
    public function setDataLabels($dataLabels)
    {
        $this->dataLabels = $dataLabels;

        return $this;
    }

    /**
     * Set the value of fill
     *
     * @return  self
     */
    public function setFill($fill)
    {
        $this->fill = $fill;

        return $this;
    }

    /**
     * Set the value of forecastDataPoints
     *
     * @return  self
     */
    public function setForecastDataPoints($forecastDataPoints)
    {
        $this->forecastDataPoints = $forecastDataPoints;

        return $this;
    }

    /**
     * Set the value of grid
     *
     * @return  self
     */
    public function setGrid($grid)
    {
        $this->grid = $grid;

        return $this;
    }

    /**
     * Set the value of labels
     *
     * @return  self
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Set the value of legend
     *
     * @return  self
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Set the value of markers
     *
     * @return  self
     */
    public function setMarkers($markers)
    {
        $this->markers = $markers;

        return $this;
    }

    /**
     * Set the value of noData
     *
     * @return  self
     */
    public function setNoData($noData)
    {
        $this->noData = $noData;

        return $this;
    }

    /**
     * Set the value of dataset
     *
     * @return  self
     */
    public function setDataset($dataset)
    {
        $this->dataset = $dataset;

        return $this;
    }

    /**
     * Set the value of states
     *
     * @return  self
     */
    public function setStates($states)
    {
        $this->states = $states;

        return $this;
    }

    /**
     * Set the value of stroke
     *
     * @return  self
     */
    public function setStroke($stroke)
    {
        $this->stroke = $stroke;

        return $this;
    }

    /**
     * Set the value of subtitle
     *
     * @return  self
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Set the value of theme
     *
     * @return  self
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the value of tooltip
     *
     * @return  self
     */
    public function setTooltip($tooltip)
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    /**
     * Set the value of plotOptions
     *
     * @return  self
     */
    public function setPlotOptions($plotOptions)
    {
        $this->plotOptions = $plotOptions;

        return $this;
    }

    /**
     * Set the value of xAxis
     *
     * @return  self
     */
    public function setXAxis($xAxis)
    {
        $this->xAxis = $xAxis;

        return $this;
    }

    /**
     * Set the value of yAxis
     *
     * @return  self
     */
    public function setYAxis($yAxis)
    {
        $this->yAxis = $yAxis;

        return $this;
    }

    /**
     * |-------------------------------------------------------------------------------
     * | Sub items Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * |-------------------------------------------------------------------------------
     * | Chart items Setters
     * |-------------------------------------------------------------------------------
     */
    public function id(string $id = null)
    {
        $id = $id ?? $this->generateID();
        $this->id = $id;
        $this->set('chart', 'id', $id);
        return $this;
        // $this->set('chart', 'id', $id ?? 'SampleChart' . Str::random(5));
    }
    public function type(string $type = 'line')
    {
        $this->set('chart', 'type', $type);
        return $this;
    }
    public function background(string $color = '#fff0')
    {
        $this->set('chart', 'background', $color);
        return $this;
    }
    public function foreColor(string $color = '#000')
    {
        $this->set('chart', 'foreColor', $color);
        return $this;
    }
    public function fontFamily(string $fontFamily = 'Nunito')
    {
        $this->set('chart', 'fontFamily', $fontFamily);
        return $this;
    }
    public function height(string $height = 'auto')
    {
        // $this->set('chart', 'height', is_numeric($height) ? (int)$height : $height);
        $this->set('chart', 'height', $height);
        return $this;
    }
    public function width(string $width = 'auto')
    {
        $this->set('chart', 'width', is_numeric($width) ? (int) $width : $width);
        return $this;
    }
    public function sparklineEnable(bool $enable = true)
    {
        $this->set('chart', 'sparkline', ['enabled' => $enable]);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Colors Setters
     * |-------------------------------------------------------------------------------
     */
    public function colors(array $colors = [])
    {
        $colors = !empty($colors) ? $colors : config('larapex-livewire.colors');
        $this->set('colors', $colors);
        return $this;
    }
    /**
     * Apply random colors from configs
     * @param int $limit Number of colors for the chart
     * @uses $param 0 for all Colors in config
     */
    public function randomColors(int $limit = 0)
    {
        $colors = collect(config('larapex-livewire.colors'))
            ->shuffle()
            ->when($limit > 0, fn($colors) => $colors->chunk($limit)->first())
            ->all();
        $this->set('colors', $colors);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | DataLabels items Setters
     * |-------------------------------------------------------------------------------
     */
    public function showDataLabels(bool $show = true)
    {
        $this->set('dataLabels', 'enabled', $show);
        return $this;
    }
    /**
     * Possible Values : start, middle, end
     */
    public function dataLabelsTextAnchor(string $anchor = 'middle')
    {
        $this->set('dataLabels', 'textAnchor', $anchor);
        return $this;
    }
    public function dataLabelsStyles(array $styles = [])
    {
        $this->set('dataLabels', 'style', $styles);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Fill items Setters
     * |-------------------------------------------------------------------------------
     */
    public function fillColors(array $colors = [])
    {
        $this->set('fill', 'colors', $colors);
        return $this;
    }
    /**
     * Possible Values : solid, gradient, pattern, image
     */
    public function fillType(string $type = 'solid')
    {
        $this->set('fill', 'type', $type);
        return $this;
    }
    public function fillOpacity(float $opacity = 0.9)
    {
        $this->set('fill', 'opacity', $opacity);
        return $this;
    }
    public function fillSolid(array $colors = [])
    {
        $this->set('fill', 'type', 'solid');
        $this->set('fill', 'colors', $colors);
        $this->fillOpacity();
        return $this;
    }
    /**
     * @param array $fromColors Starts Colors Array
     * @param array $toColors Ends Colors Array
     * @param array $others add or replace items of the gradient array
     * @param array $colorStops Stops defines the ramp of colors to use on a gradient
     * @param array $customStops Override everything and define your own stops with unlimited color stops.
     * @uses shade light,dark
     * @uses direction horizontal,vertical,diagonal1,diagonal2
     */
    public function fillGradient(array $fromColors, array $toColors = [], array $others = [], string $shade = 'dark', string $direction = 'horizontal', array $colorStops = [0, 100], array $customStops = [])
    {
        $this->set('fill', 'type', 'gradient');
        $this->set('fill', 'colors', $fromColors);
        $this->set('fill', 'opacity', 0.9);
        $ginfo = [
            'shade'            => $shade,
            // possible : light,dark
            'type'             => $direction,
            // possible : horizontal, vertical, diagonal1, diagonal2
            'gradientToColors' => $toColors,
            // chart.colors OR fill.colors ==> TO ==> fill.gradient.gradientToColors
            'stops'            => $colorStops,
            // example : [0, 50, 100]
            'colorStops'       => $customStops
            // 'shadeIntensity' => 0.5,
            // 'inverseColors' => true,
            // 'opacityFrom' => 1,
            // 'opacityTo' => 1,
        ];
        // change or replace items of the gradient array
        $ginfo = array_merge($ginfo, $others);
        $this->set('fill', 'gradient', $ginfo);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Grid items Setters
     * |-------------------------------------------------------------------------------
     */
    public function showGrid(bool $show = true)
    {
        $this->set('grid', 'show', $show);
        return $this;
    }
    public function setGridInfo(array $info = [])
    {
        $info = array_merge($this->grid, $info);
        $this->set('grid', $info);
        return $this;
        // 'show' => true,
        // 'borderColor' => '#90A4AE',
        // 'strokeDashArray' => 0,
        // 'position' => 'back', // possible : front, back
        // 'xaxis' => ['lines' => ['show' => false]],
        // 'yaxis' => ['lines' => ['show' => false]],
        // row: {
        //     colors: '#90A423',
        //     opacity: 0.5
        // },
        // column: {
        //     colors: '#9032AE',
        //     opacity: 0.5
        // },
        // padding: {
        //     top: 0,
        //     right: 0,
        //     bottom: 0,
        //     left: 0
        // },
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart labels Setters
     * |-------------------------------------------------------------------------------
     */
    public function labels(array $labels = [])
    {
        $this->set('labels', $labels);
        return $this;
    }

    /**
     * |-------------------------------------------------------------------------------
     * | Chart markers Setters
     * |-------------------------------------------------------------------------------
     */
    public function markers($colors = [], $width = 4, $hoverSize = 7, array $others = [])
    {
        $colors = $colors ?? config('larapex-livewire.colors');
        $info = $this->markers ?? [];
        $customInfo = [
            'size'         => $width,
            'colors'       => $colors,
            'strokeColors' => "#fff",
            'strokeWidth'  => $width / 2,
            'hover'        => [
                'size' => $hoverSize,
            ]
        ];
        $info = array_merge($info, $customInfo);
        $info = array_merge($info, $others);
        $this->set('markers', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart No Data Setters
     * |-------------------------------------------------------------------------------
     */
    public function noData($text = 'No Data', string $halign = 'center', string $valign = 'middle', array $others = [])
    {
        $info = [
            'text'          => $text,
            'align'         => $halign,
            'verticalAlign' => $valign,
            // 'offsetX' => 0,
            // 'offsetY' => 0,
            // 'style' => [
            //     'color' => '#111',
            //     'fontSize' => '14px',
            //     'fontFamily' => null
            // ]
        ];
        $info = array_merge($info, $others);
        $this->set('noData', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Stroke Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $curve 'smooth', 'straight', 'stepline'
     * @uses $others lineCap[ 'butt', 'square', 'round']
     */
    public function stroke(int $width, array $colors = [], string $curve = 'straight', array $others = [])
    {
        $colors = !empty($colors) && is_array($colors) ? $colors : config('larapex-livewire.colors');
        $info = [
            'show'   => true,
            'width'  => $width,
            'colors' => $colors,
            'curve'  => $curve,
            // 'lineCap' => 'butt',
            // 'dashArray' => 0,
        ];
        $info = array_merge($info, $others);
        $this->set('stroke', $info);
        return $this;
    }
    /**
     * @uses $curve 'smooth', 'straight', 'stepline'
     */
    public function curve(string $curve = 'straight')
    {
        $this->set('stroke', 'curve', $curve);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Subtitle Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $position left,center,right
     */
    public function subtitle(string $subtitle, string $position = 'left', array $others = [])
    {
        $info = [
            'text'  => $subtitle,
            'align' => $position,
            // subtitlePosition
            // 'margin' => 10,
            // 'offsetX' => 0,
            // 'offsetY' => 0,
            // 'floating' => false,
            // 'style' => [
            //     'fontSize' => '12px',
            //     'fontWeight' => 'normal',
            //     'fontFamily' => null,
            //     'color' => '#9699a2'
            // ],
        ];
        $info = array_merge($info, $others);
        $this->set('subtitle', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Theme Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $mode light,dark
     * @uses $others palette[palette1 - palette10]
     */
    public function theme(string $mode = 'dark', array $others = [])
    {
        $info = [
            'mode' => $mode,
            // possible : light, dark
            // 'palette' => 'palette1', // possible : palette1 - palette10
            // 'monochrome' => [
            //     'enabled' => false,
            //     'color' => '#255aee',
            //     'shadeTo' => 'light', // possible : light, dark
            //     'shadeIntensity' => 0.65
            // ],
        ];
        $info = array_merge($info, $others);
        $this->set('theme', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Title Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $align left,center,right
     */
    public function title(string $title, string $align = 'left', array $others = [])
    {
        $info = [
            'text'  => $title,
            'align' => $align,
            // 'margin' => 10,
            // 'offsetX' => 0,
            // 'offsetY' => 0,
            // 'floating' => false,
            // 'style' => [
            //     'fontSize' => '14px',
            //     'fontWeight' => 'bold',
            //     'fontFamily' => null,
            //     'color' => '#263238'
            // ],
        ];
        $info = array_merge($info, $others);
        $this->set('title', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Tooltip Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $theme dark,light
     */
    public function showTooltip(bool $show = true)
    {
        $info = ['enabled' => $show];
        $info = array_merge(is_array($this->tooltip) && !empty($this->tooltip) ? $this->tooltip : [], $info);
        $this->set('tooltip', $info);
        return $this;
    }
    public function tooltip(bool $show = true, string $theme = 'dark', bool $fillSeriesColor = false, array $others = [])
    {
        $info = [
            'enabled'         => $show,
            'theme'           => $theme,
            'fillSeriesColor' => $fillSeriesColor,
            // 'enabledOnSeries' => [],
            // 'shared' => true,
            // 'followCursor' => false,
            // 'intersect' => false,
            // 'inverseOrder' => false,
            // 'custom'=> null,
            // 'style' => [
            //     'fontSize' => '12px',
            //     'fontFamily' => null
            // ],
            'onDatasetHover'  => [
                'highlightDataSeries' => false,
            ],
        ];
        $info = array_merge($info, $others);
        $this->set('tooltip', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart XAxis Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $type category,datetime,numeric
     * @uses $others tickPlacement[on, between]
     * @uses $others position[bottom, top]
     */
    public function xAxis(array $categories = [], string $type = 'category', string $title = '', array $others = [])
    {
        $info = [
            'type'          => $type,
            // 'categories' => $categories,
            // 'tickAmount' => 3,
            'tickPlacement' => 'on',
            // 'min' => null,
            // 'max' => null,
            // 'range' => null,
            // 'floating' => false,
            // 'decimalsInFloat' => null,
            // 'overwriteCategories' => null,
            // 'position' => 'bottom',
            // 'labels' => [
            //     'show' => true,
            //     'rotate' => -45,
            //     'rotateAlways' => false,
            //     'hideOverlappingLabels' => true,
            //     'showDuplicates' => false,
            //     'trim' => false,
            //     'minHeight' => null,
            //     'maxHeight' => 120,
            //     'style' => [
            //         'colors' => [],
            //         'fontSize' => '12px',
            //         'fontFamily' => 'Helvetica, Arial, sans-serif',
            //         'fontWeight' => 400,
            //         'cssClass' => 'apexcharts-xaxis-label',
            //     ],
            //     'offsetX' => 0,
            //     'offsetY' => 0,
            //     // 'format' => null,
            //     // 'formatter' => null,
            //     'datetimeUTC' => true,
            //     'datetimeFormatter' => [
            //         'year' => 'yyyy',
            //         'month' => "MMM 'yy",
            //         'day' => 'dd MMM',
            //         'hour' => 'HH:mm',
            //     ],
            // ],
            // 'axisBorder' => [
            //     'show' => true,
            //     'color' => '#78909C',
            //     'height' => 1,
            //     'width' => '100%',
            //     'offsetX' => 0,
            //     'offsetY' => 0
            // ],
            // 'axisTicks' => [
            //     'show' => true,
            //     'borderType' => 'solid',
            //     'color' => '#78909C',
            //     'height' => 6,
            //     'offsetX' => 0,
            //     'offsetY' => 0
            // ],
            'title'         => [
                'text' => $title,
                // 'offsetX' => 0,
                // 'offsetY' => 0,
                // 'style' => [
                //     'color' => null,
                //     'fontSize' => '12px',
                //     'fontFamily' => 'Helvetica, Arial, sans-serif',
                //     'fontWeight' => 600,
                //     'cssClass' => 'apexcharts-xaxis-title',
                // ],
            ],
        ];
        if (!empty($categories)) {
            $info['categories'] = $categories;
        }
        $info = array_merge($info, $others);
        $this->set('xAxis', $info);
        return $this;
    }
    /**
     * @param string $type Xaxis category type
     * @uses $type category, datetime, numeric
     */
    public function xAxisType(string $type = 'category')
    {
        $this->set('xAxis', 'type', $type);
        return $this;
    }
    public function xAxisTickPlacement(string $placement = 'on')
    {
        $this->set('xAxis', 'tickPlacement', $placement);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart YAxis Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     *
     */
    public function yAxis(bool $show = true, array $others = [])
    {
        $info = [
            'show'       => $show,
            'showAlways' => $show,
            // showForNullSeries: true,
            // seriesName: null,
            // opposite: false,
            // reversed: false,
            // logarithmic: false,
            // 'tickAmount' => $tickAmount,
            // min: 6,
            // max: 6,
            // forceNiceScale: false,
            // floating: false,
            // decimalsInFloat: null,
            'labels'     => [
                'show' => $show,
                //     align: 'right',
                //     minWidth: 0,
                //     maxWidth: 160,
                //     style: {
                //         colors: [],
                //         fontSize: '12px',
                //         fontFamily: 'Helvetica, Arial, sans-serif',
                //         fontWeight: 400,
                //         cssClass: 'apexcharts-yaxis-label',
                //     },
                //     offsetX: 0,
                //     offsetY: 0,
                //     rotate: 0,
                //     formatter: (value) => {
                //         return val
                //     },
            ],
            // axisBorder: {
            //     show: true,
            //     color: '#78909C',
            //     offsetX: 0,
            //     offsetY: 0
            // },
            'axisTicks'  => [
                'show' => $show,
                // borderType: 'solid',
                // color: '#78909C',
                // width: 6,
                // offsetX: 0,
                // offsetY: 0
            ],
            // title: {
            //     text: null,
            //     rotate: -90,
            //     offsetX: 0,
            //     offsetY: 0,
            //     style: {
            //         color: null,
            //         fontSize: '12px',
            //         fontFamily: 'Helvetica, Arial, sans-serif',
            //         fontWeight: 600,
            //         cssClass: 'apexcharts-yaxis-title',
            //     },
            // },
            // crosshairs: {
            //     show: true,
            //     position: 'back',
            //     stroke: {
            //         color: '#b6b6b6',
            //         width: 1,
            //         dashArray: 0,
            //     },
            // },
            'tooltip'    => [
                'enabled' => $show,
                // offsetX: 0,
            ],
        ];
        $info = array_merge($info, $others);
        $this->set('yAxis', $info);
        return $this;
    }
    /**
     * |-------------------------------------------------------------------------------
     * | Chart Zoom Setters
     * |-------------------------------------------------------------------------------
     */
    /**
     * @uses $type x,y,xy
     */
    public function zoom(bool $enable = true, string $type = 'x', array $others = [])
    {
        $info = [
            'enabled' => $enable,
            'type'    => $type,
            // 'autoScaleYaxis' => false,
            // 'zoomedArea' => [
            //     'fill' => [
            //         'color' => '#90CAF9',
            //         'opacity' => 0.4
            //     ],
            //     'stroke' => [
            //         'color' => '#0D47A1',
            //         'opacity' => 0.4,
            //         'width' => 1
            //     ]
            // ]
        ];
        $info = array_merge($info, $others);
        $this->set('chart', 'zoom', $info);
        return $this;
    }
}