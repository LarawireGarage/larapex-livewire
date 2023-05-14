window.addEventListener('apex:chart:update:options', function (e) {
    if (typeof window['updateLarapexChartOptions'] === 'function') {
        let code = e.detail.chart_code ?? null;
        let options = JSON.parse(e.detail.chart_options) ?? null;
        let redraw = e.detail.redraw ?? null;
        let animate = e.detail.animate ?? null;
        let updateSyncCharts = e.detail.updateSyncCharts ?? null;
        window.updateLarapexChartOptions(code, options, redraw, animate, updateSyncCharts);
    }
});
window.addEventListener('apex:chart:update:series', function (e) {
    if (typeof window['updateLarapexChartSeries'] === 'function') {
        let code = e.detail.chart_code ?? null;
        let series = JSON.parse(e.detail.series) ?? null;
        let animate = e.detail.animate ?? null;
        window.updateLarapexChartSeries(code, series, animate);
    }
});
window.addEventListener('apex:chart:reset', function (e) {
    if (typeof window['resetLarapexChart'] === 'function') {
        let code = e.detail.chart_code ?? null;
        let update = e.detail.update ?? null;
        let zoom = e.detail.zoom ?? null;
        window.resetLarapexChart(code, update, zoom);
    }
});
