window.apexCharts = Array.isArray(window.apexCharts) ? window.apexCharts : [];

window.initApexChart = function (elem, chartCode = '', options = []) {

    if (!elem) throw new TypeError("Invalid Chart Element ID !");
    if (chartCode.length <= 0) throw new TypeError("Invalid Chart Code !");
    if (options.length <= 0) throw new TypeError("Invalid Chart Options !");

    let chartName = window.getApexChartName(chartCode);

    try {
        window.apexCharts[chartName] = new ApexCharts(elem, options);

        window.apexCharts[chartName].render();
    } catch (error) {
        console.log('Error occurred !');
    }

}

window.getApexChartName = (code) => "chart_" + code;

window.getApexChart = (code) => window.apexCharts[window.getApexChartName(code)] ?? null;

window.updateLarapexChartOptions = function (chartCode, options, redraw = true, animate = true, updateSyncCharts = false) {
    let chart = window.getApexChart(chartCode);
    if (chart != null && options) chart.updateOptions(options, redraw, animate, updateSyncCharts);
}

window.updateLarapexBrushChartOptions = function (mainChartCode, subChartCode, mainOptions, subOptions, redraw = true, animate = true, updateSyncCharts = false) {

    let mainC = window.getApexChart(mainChartCode);
    let subC = window.getApexChart(subChartCode);

    if (subC != null && subOptions) subC.updateOptions(subOptions, redraw, animate, updateSyncCharts);
    if (mainC != null && mainOptions) mainC.updateOptions(mainOptions, redraw, animate, updateSyncCharts);

}

window.updateLarapexChartSeries = function (chartCode, series, animate = true) {

    let chart = window.getApexChart(chartCode);

    if (chart == null) throw new TypeError("Cannot find chart : Chart ID : " + chartCode);
    if (series.length <= 0) throw new TypeError("Chart ID : " + chartCode + " : Series Cannot be empty !");

    chart.updateSeries(series, animate);
}

window.resetLarapexChart = function (chartCode, update = false, zoom = true) {
    let chart = window.getApexChart(chartCode);

    if (chart == null) throw new TypeError("Cannot find chart : Chart ID : " + chartCode);
    if (series.length <= 0) throw new TypeError("Chart ID : " + chartCode + " : Series Cannot be empty !");

    chart.resetSeries(update, zoom);
}


