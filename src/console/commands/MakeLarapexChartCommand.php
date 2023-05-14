<?php

namespace LarawireGarage\LarapexLivewire\console\commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeLarapexChartCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:larapex {name : The name of the chart component class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a Larapex Livewire Chart';

    protected $chartTypes = [
        'Area Chart'            => 'WireableAreaChart',
        'Bar Chart'             => 'WireableBarChart',
        'Brush Chart'           => 'WireableBrushChart',
        'Donut Chart'           => 'WireableDonutChart',
        'Line Chart'            => 'WireableLineChart',
        'Pie Chart'             => 'WireablePieChart',
        // 'Radial Bar Chart'      => 'WireableRadialBarChart', // not available yet
        // 'Polar Area Chart'      => 'WireablePolarAreaChart', // not available yet
        // 'Horizontal Bar Chart'  => 'WireableHorizontalBarChart', // not available yet
        // 'Heatmap Chart'         => 'WireableHeatMapChart', // not available yet
        // 'Radar Chart'           => 'WireableRadarChart', // not available yet
    ];

    protected $selectedChart;

    protected function askChartType()
    {
        $option = $this->choice(
            'Select a chart type',
            array_keys($this->chartTypes),
        );
        $this->selectedChart = $this->chartTypes[$option];
        return $this->chartTypes[$option];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $chartClass = $this->askChartType();

        $this->selectedChart = $chartClass;

        $classPath = $this->generatePathFromQualifiedClass();

        $this->makeDirectory($classPath);

        $this->files->put($classPath, $this->sortImports($this->replaceChartClass($chartClass)));

        $this->info($classPath . ' created successfully.');

        return 0;
    }

    public function replaceChartClass($chartClass)
    {
        return Str::of($this->buildClass($this->qualifyClass($this->getNameInput())))
            ->replace('{{ chart }}', $chartClass);
    }

    public function getQualifiedChartClass($className)
    {
        return 'LarawireGarage\\LarapexLivewire\\Wireable\\' . $className;
    }

    public function getNameInput()
    {
        return Str::of($this->argument('name'))
            ->replace('\\', '/')
            ->replace('.', '/')
            ->explode('/')
            ->map(fn ($dir) => Str::studly($dir))
            ->implode('/');
        // return Str::of($this->argument('name'))->camel()->studly() . '';
    }

    public function getNamespace($qualifiedClass)
    {
        return Str::of($this->qualifyClass($this->getNameInput()))
            ->explode('\\')
            ->map(fn ($dirname) => Str::ucfirst($dirname))
            ->slice(0, -1)
            ->implode('\\');
    }
    /**
     * Get the destination class path.
     *
     * @param  string  $qualifiedClass
     * @return string
     */
    public function generatePathFromQualifiedClass()
    {
        $name = Str::of(Str::of($this->qualifyClass($this->getNameInput()))
            ->explode('\\')
            ->map(fn ($dirname) => Str::ucfirst($dirname))
            ->implode('\\'))
            ->replaceFirst(app()->getNamespace(), '')
            ->finish('.php');

        return app_path(str_replace('/', '\\', $name));
    }
    public function generateDirFromNamespace($qualifiedClass)
    {
        $name = Str::of($qualifiedClass)
            ->replaceFirst(app()->getNamespace(), '');
        return app_path(str_replace('/', '\\', $name));
    }



    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return $this->selectedChart == 'WireableBrushChart'
            ? __DIR__ . '/stubs/brush-chart-component.stub'
            : __DIR__ . '/stubs/chart-component.stub';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return config('larapex-livewire.class_namespace', 'App\\Http\\Livewire\\Charts');
    }

    protected function createClass()
    {
        $classPath = $this->parser->classPath();

        if (File::exists($classPath)) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->parser->classContents());

        return $classPath;
    }
}
