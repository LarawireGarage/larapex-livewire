# Larapex Livewire
Laravel wrapper for [ApexCharts javascript plugin](https://apexcharts.com/) advanced features with livewire

**Installation**
```
composer require larawire-garage/larapex-livewire
```


**Publish configurations**
```
php artisan vendor:publish --tag=larapex-livewire-configs
```
**Publish assets**
```
php artisan vendor:publish --tag=larapex-livewire-assets
```
**Add Scripts**

add `@larapexScripts` blade directive end of the body tag and before other scripts in main app layout file
```
// layouts.app.blade.php
<body>
    <!-- Your Layout HTML content -->

    @larapexScripts

    <script>
        // your scripts
    </script>
</body>
```
If you want to use chart only in sub pages or livewire component and need to push scripts to specific stack add stack name to script_section in `larapex-livewire.php` config file

```
// layouts.app.blade.php
<body>
    <!-- Your layout HTML content -->

    @yield('scripts')

    @stack('lw_scripts')
</body>
@larapexScripts
```
```
// posts.stats.blade.php [normal or livewire component blade]
<div>
    <!-- Your Sub Page HTML content -->

    @larapexScripts
</div>
```
```
'script_section' => 'lw_scripts',
```

**Make a chart**
```
php artisan make:larapex YOUR_CHART_CLASS_NAME
```

and Select a Chart Type from
   1. Area Chart
   2. Bar Chart
   3. Brush Chart
   4. Donut Chart
   5. Line Chart
   6. Pie Chart

then its generate a chart class. 


## Fill Data

>Chart class is a normal livewire class and you can use livewire features inside the class. For example event_listeners, parse value through mount() method etc.

Add data generating code in `getData()` function and use it to fill data in `build()` method.
```
private function getData(){
    // Data generating logic
}

public function build()
{
    $this->chart = (new WireableAreaChart($this->chart_id))
        ->addArea('sample-1', $this->getData());
}
```

## Add chart to page

add chart like any other livewire component into the blade file
```
<div>
    @livewire('chart-class-name-in-slug-format')
</div>
```
>Use chart class namespace in dot notation and all in slug format for chart component name in `@livewire()` blade directive. <br>example:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; app/Http/Livewire/TestChart.php Class can use as 'test-chart'.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;app/Http/Livewire/Charts/TestChart.php Class can use as 'charts.test-chart'.

## Customize Chart

Can use any option except javascript callback functions as a array using `set` functions

- setChart()
- setColors()
- setDataLabels()
- setFill()
- setForecastDataPoints()
- setGrid()
- setLabels()
- setLegend()
- setMarkers()
- setNoData()
- setDataset()
- setStates()
- setStroke()
- setSubtitle()
- setTheme()
- setTitle()
- setTooltip()
- setPlotOptions()
- setXAxis()
- setYAxis()

also ApexChart has few helper functions

- sparklineEnable(bool $enable)
- colors(array $colors)
- randomColors(int $limit)
- showDataLabels(bool $show)
- dataLabelsTextAnchor(string $anchor)
- dataLabelsStyles(array $styles)
- fillColors(array $colors)
- fillType(string $type)
- fillOpacity(float $opacity)
- fillSolid(array $colors)
- fillGradient(array $fromColors, array $toColors, array $others, string $shade, string $direction, array $colorStops, array $customStops)
- showGrid(bool $show)
- setGridInfo(array $info)
- labels(array $labels)
- markers(array $colors,int $width,int $hoverSize, array $others)
- noData($text, string $halign, string $valign, array $others)
- stroke(int $width, array $colors, string $curve, array $others)
- curve(string $curve)
- subtitle(string $subtitle, string $position, array $others)
- theme(string $mode, array $others)
- title(string $title, string $align, array $others)
- showTooltip(bool $show)
- tooltip(bool $show, string $theme, bool $fillSeriesColor, array $others)
- xAxis(array $categories, string $type, string $title, array $others)
- xAxisType(string $type)
- xAxisTickPlacement(string $placement)
- yAxis(bool $show, array $others)
- zoom(bool $enable, string $type, array $others)

**Overwrite configs**
- background(string $color)
- foreColor(string $color)
- fontFamily(string $fontFamily)
- height(string $height)
- width(string $width)

## Inspiration
Highly inspired by [Larapex Charts Package](https://github.com/ArielMejiaDev/larapex-charts).


!!! :tada::tada::tada: Enjoy :tada::tada::tada: !!!
