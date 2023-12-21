<div class="larapex-chart-component" x-data="{
    chart: null,
    id: @entangle('chart_id'),
    code: @entangle('chart_code'),
    options: @entangle('options').live,
    redraw: @entangle('redraw'),
    animate: @entangle('animate'),
    updateSyncCharts: @entangle('updateSyncCharts'),
    update: @entangle('update'),
    zoom: @entangle('zoom'),
    initChart() {
        console.log('init chart');
        this.chart = new ApexCharts($refs.chartElem, this.options);
        this.chart.render();
    },
    updateOptions() {
        console.log('update chart');
        console.log(Object.keys(this.options));
        if (this.chart !== null && Object.keys(this.options).length > 0) {
            this.chart.updateOptions(
                this.options,
                this.redraw,
                this.animate,
                this.updateSyncCharts
            );
        }
    },
    updateSeries() {
        console.log('update series');
        console.log(Object.keys(this.options.series));
        if (this.chart !== null && Object.keys(this.options).length > 0) {
            this.chart.updateSeries(
                this.options.series,
                this.animate
            );
        }
    },
    resetChart() {
        console.log('reset chart');
        if (this.chart !== null) this.chart.updateSeries(
            this.update,
            this.zoom
        );
    },
    destroyChart() {
        console.log('destroy chart');
        if (this.chart !== null) this.chart.destroy();
    }
}" x-id="['apex_chart']" x-init="initChart()"
    x-on:update:chart="updateOptions" x-on:update:chart:series="updateSeries" x-on:reset:chart="resetChart" wire:ignore>
    <div :id="$id('apex_chart')" x-ref="chartElem" class="m-0"></div>
</div>
