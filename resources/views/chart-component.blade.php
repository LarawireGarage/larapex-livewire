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
    themes: @js(config('larapex-livewire.available_themes')),
    initChart() {
        let foptions = {!! $foptions !!};
        this.deepMergeObjects(this.options, foptions);
        this.handleTheme();

        window.addEventListener('themeChanged', (e) => {
            this.changeTheme(e.detail.theme);
            this.updateOptions();
        });

        this.chart = new ApexCharts($refs.chartElem, this.options);
        this.chart.render();
    },
    deepMergeObjects(options, mergeObject) {
        let setCallback = function(path, callback) {
            let schema = options; // a moving reference to internal objects within obj
            let pList = path.split('.'); // seperate do natation
            let len = pList.length;
            for (let i = 0; i < len - 1; i++) {
                let elem = pList[i];
                if (!schema[elem]) schema[elem] = {} // key not exists => assign new obj
                schema = schema[elem];
            }
            schema[pList[len - 1]] = callback;
        }
        for (let key in mergeObject) setCallback(key, mergeObject[key]);
    },
    osTheme() {
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    },
    handleTheme() {
        let theme = this.options.theme.mode;
        this.changeTheme(theme);
    },
    changeTheme(theme) {
        this.applyTheme(!['light', 'dark'].includes(theme) ? this.osTheme() : theme);
    },
    applyTheme(theme) {
        this.options.tooltip.theme = theme;
        this.options.theme.mode = theme;
        this.options.chart.foreColor = this.themes[theme]['font_color'];
        this.options.chart.background = this.themes[theme]['background_color']; 
    },
    updateChartOptions() {
        this.handleTheme();
        this.updateOptions();
    },
    updateOptions() {
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
        if (this.chart !== null && Object.keys(this.options).length > 0) {
            this.handleTheme();
            this.chart.updateSeries(
                this.options.series,
                this.animate
            );
        }
    },
    resetChart() {
        if (this.chart !== null) {
            this.handleTheme();
            this.chart.resetSeries(
                this.update,
                this.zoom
            );
        }
        this.isReset = true;
    },
    destroyChart() {
        if (this.chart !== null) this.chart.destroy();
        this.isDestroy = true;
    }
}" x-id="['apex_chart']" x-init="$watch('options', (newOptions) => {
    if (chart && (isReset !== true) && (isDestroy !== true) && JSON.stringify(chart.opts) !== JSON.stringify(newOptions)) {
        updateSeries();
    }
    isReset = false;
});
initChart();"
    x-on:update:chart:options="updateChartOptions" x-on:reset:chart="resetChart" x-on:delete:chart="destroyChart" wire:ignore>
    <div :id="$id('apex_chart')" x-ref="chartElem" class="m-0"></div>
</div>
