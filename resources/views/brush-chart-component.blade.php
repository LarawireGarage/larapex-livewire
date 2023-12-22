<div x-data="{
    id: @entangle('brush_chart_id'),
    code: @entangle('brush_chart_code'),

    mainchart: null,
    main_id: @entangle('main_chart_id'),
    main_code: @entangle('main_chart_code'),
    options_main: @entangle('main_options'),
    isResetMain: false,
    isDestroyMain: false,

    subchart: null,
    sub_id: @entangle('sub_chart_id'),
    sub_code: @entangle('sub_chart_code'),
    options_sub: @entangle('sub_options'),
    isResetSub: false,
    isDestroySub: false,

    redraw: @entangle('redraw'),
    animate: @entangle('animate'),
    updateSyncCharts: @entangle('updateSyncCharts'),
    update: @entangle('update'),
    zoom: @entangle('zoom'),

    initChart() {
        console.log('init chart');
        if (this.subchart == null) {
            this.subchart = new ApexCharts($refs.chartElemSub, this.options_sub);
            this.subchart.render();
        }
        if (this.mainchart == null) {
            this.mainchart = new ApexCharts($refs.chartElemMain, this.options_main);
            this.mainchart.render();
        }

    },
    updateOptions() {
        console.log('update chart');
        if (this.mainchart !== null && Object.keys(this.options_main).length > 0) {
            this.mainchart.updateOptions(
                this.options_main,
                this.redraw,
                this.animate,
                this.updateSyncCharts
            );
        }
        if (this.subchart !== null && Object.keys(this.options_sub).length > 0) {
            this.subchart.updateOptions(
                this.options_sub,
                this.redraw,
                this.animate,
                this.updateSyncCharts
            );
        }
    },
    updateSeries() {
        console.log('update series');
        this.updateMainSeries();
        this.updateSubSeries();
    },
    updateMainSeries() {
        console.log('main series : ', this.options_main.series);
        if (this.mainchart !== null && Object.keys(this.options_main).length > 0) {
            this.mainchart.updateSeries(
                this.options_main.series,
                this.animate
            );
        }
    },
    updateSubSeries() {
        console.log('sub series : ', this.options_sub.series);
        if (this.subchart !== null && Object.keys(this.options_sub).length > 0) {
            this.subchart.updateSeries(
                this.options_sub.series,
                this.animate
            );
        }
    },
    resetChart() {
        console.log('reset chart');
        this.resetMainChart();
        this.resetSubChart();
    },
    resetMainChart() {
        if (this.mainchart !== null) this.mainchart.resetSeries(
            this.update,
            this.zoom
        );
        this.isResetMain = true;
    },
    resetSubChart() {
        if (this.subchart !== null) this.subchart.resetSeries(
            this.update,
            this.zoom
        );
        this.isResetSub = true;
    },
    destroyChart() {
        console.log('destroy chart');
        if (this.mainchart !== null) {
            this.mainchart.destroy();
            this.isDestroyMain = true;
        }
        if (this.subchart !== null) {
            this.subchart.destroy();
            this.isDestroySub = true;
        }
    }
}" x-id="['apex_chart_brush','apex_chart_brush_main','apex_chart_brush_sub']"
    x-init="initChart();
    $watch('options_main', (newOptions) => {
        if (mainchart && (isResetMain !== true) && (isDestroyMain !== true) && JSON.stringify(mainchart.opts) !== JSON.stringify(newOptions)) {
            updateMainSeries();
        }
        isResetMain = true;
    });
    $watch('options_sub', (newOptions) => {
        if (subchart && (isResetSub !== true) && (isDestroySub !== true) && JSON.stringify(subchart.opts) !== JSON.stringify(newOptions)) {
            updateSubSeries();
        }
        isResetSub = true;
    });" x-on:update:chart:options="updateOptions" x-on:reset:chart="resetChart"
    x-on:delete:chart="destroyChart" wire:ignore>
    <div :class="'apex-brush-wrapper-' + id">
        <div :id="$id('apex_chart_brush_sub')" x-ref="chartElemSub" style="position: relative; margin-top: -38px;"></div>
        <div :id="$id('apex_chart_brush_main')" x-ref="chartElemMain"></div>
    </div>
</div>
