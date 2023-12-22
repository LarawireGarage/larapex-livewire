<div class="larapex-chart-component" x-data="{
    chart: null,
    id: @entangle('chart_id'),
    code: @entangle('chart_code'),
    options: @entangle('options'),
    redraw: @entangle('redraw'),
    animate: @entangle('animate'),
    updateSyncCharts: @entangle('updateSyncCharts'),
    update: @entangle('update'),
    zoom: @entangle('zoom'),
    isReset: false,
    isDestroy: false,
    initChart() {
        console.log('init chart');
        this.chart = new ApexCharts($refs.chartElem, this.options);
        this.chart.render();
    },
    updateOptions() {
        console.log('update chart options');
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
        console.log('update chart series');
        if (this.chart !== null && Object.keys(this.options).length > 0) {
            this.chart.updateSeries(
                this.options.series,
                this.animate
            );
        }
    },
    resetChart() {
        console.log('reset chart');
        if (this.chart !== null) {
            this.chart.resetSeries(
                this.update,
                this.zoom
            );
        }
        this.isReset = true;
    },
    destroyChart() {
        console.log('destroy chart');
        if (this.chart !== null) this.chart.destroy();
        this.isDestroy = true;
    }
}" x-id="['apex_chart']" x-init="initChart();
$watch('options', (newOptions) => {
    if (chart && (isReset !== true) && (isDestroy !== true) && JSON.stringify(chart.opts) !== JSON.stringify(newOptions)) {
        updateSeries();
    }
    isReset = false;
});"
    x-on:update:chart:options="updateOptions" x-on:reset:chart="resetChart" x-on:delete:chart="destroyChart" wire:ignore>
    <div :id="$id('apex_chart')" x-ref="chartElem" class="m-0"></div>
</div>
