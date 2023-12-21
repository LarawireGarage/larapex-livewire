<div x-data="{
    id: @entangle('brush_chart_id'),
    code: @entangle('brush_chart_code'),

    mainchart: null,
    main_id: @entangle('main_chart_id'),
    main_code: @entangle('main_chart_code'),
    options_main: @entangle('main_options').live,

    subchart: null,
    sub_id: @entangle('sub_chart_id'),
    sub_code: @entangle('sub_chart_code'), 
    options_sub: @entangle('sub_options').live,

    redraw: @entangle('redraw'),
    animate: @entangle('animate'),
    updateSyncCharts: @entangle('updateSyncCharts'),
    update: @entangle('update'),
    zoom: @entangle('zoom'),

    initChart() {
        console.log('init chart');
        this.mainchart = new ApexCharts($refs.chartElemMain, this.options_main);
        this.mainchart.render();

        this.subchart = new ApexCharts($refs.chartElemSub, this.options_sub);
        this.subchart.render();
    },
    updateOptions() {
        console.log('update chart');
        console.log('main : ', Object.keys(this.options_main));
        console.log('sub : ', Object.keys(this.options_sub));

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
        console.log(Object.keys(this.options_main.series));
        if (this.mainchart !== null && Object.keys(this.options_main).length > 0) {
            this.mainchart.updateSeries(
                this.options_main.series,
                this.animate
            );
        }
        if (this.subchart !== null && Object.keys(this.options_sub).length > 0) {
            this.subchart.updateSeries(
                this.options_sub.series,
                this.animate
            );
        }
    },
    resetChart() {
        console.log('reset chart');
        if (this.mainchart !== null) this.mainchart.updateSeries(
            this.update,
            this.zoom
        );
        if (this.subchart !== null) this.subchart.updateSeries(
            this.update,
            this.zoom
        );
    },
    destroyChart() {
        console.log('destroy chart');
        if (this.mainchart !== null) this.mainchart.destroy();
        if (this.subchart !== null) this.subchart.destroy();
    }
}" x-id="['apex_chart_brush','apex_chart_brush_main','apex_chart_brush_sub']"
    x-init="initChart()" x-on:update:chart="updateOptions" x-on:update:chart:series="updateSeries"
    x-on:reset:chart="resetChart" wire:ignore>
    <div :class="'apex-brush-wrapper-' + id">
        <div :id="$id('apex_chart_brush_sub')" x-ref="chartElemSub" style="position: relative; margin-top: -38px;"></div>
        <div :id="$id('apex_chart_brush_main')" x-ref="chartElemMain"></div>
    </div>
</div>
