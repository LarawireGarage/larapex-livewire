<div class="larapex-chart-component" wire:ignore>
    <div id="{!! $chart_id !!}" class="m-0"></div>
</div>

@if (!empty(config('larapex-livewire.script_section')))
    @push(config('larapex-livewire.script_section'))
        <script>
            // component scripts
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('commit', ({
                    component,
                    commit,
                    respond,
                    succeed,
                    fail
                }) => {

                    succeed(({
                        snapshot,
                        effect
                    }) => {

                        let chartResponse = JSON.parse(snapshot);
                        let isLarapexChart = chartResponse.hasOwnProperty('data') ?
                            chartResponse['data'].hasOwnProperty('chart_code') :
                            false;

                        if (isLarapexChart) {
                            window.updateLarapexChartOptions(
                                chartResponse.data.chart_code,
                                JSON.parse(chartResponse.data.options),
                                chartResponse.data.redraw,
                                chartResponse.data.animate,
                                chartResponse.data.updateSyncCharts
                            );
                        }

                    })

                    fail(() => {
                        console.log('Chart updating failed !');
                    })

                });
            });

            window.initApexChart(
                document.querySelector("#{{ $chart_id }}"),
                "{{ $chart_code }}",
                {!! $chart->getOptionsAsJson() !!}
            );
        </script>
    @endpush
@else
    <script>
        // component scripts
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({
                component,
                commit,
                respond,
                succeed,
                fail
            }) => {

                succeed(({
                    snapshot,
                    effect
                }) => {

                    let chartResponse = JSON.parse(snapshot);
                    let isLarapexChart = chartResponse.hasOwnProperty('data') ?
                        chartResponse['data'].hasOwnProperty('chart_code') :
                        false;

                    if (isLarapexChart) {
                        window.updateLarapexChartOptions(
                            chartResponse.data.chart_code,
                            JSON.parse(chartResponse.data.options),
                            chartResponse.data.redraw,
                            chartResponse.data.animate,
                            chartResponse.data.updateSyncCharts
                        );
                    }

                })

                fail(() => {
                    console.log('Chart updating failed !');
                })

            });
        });

        window.initApexChart(
            document.querySelector("#{{ $chart_id }}"),
            "{{ $chart_code }}",
            {!! $chart->getOptionsAsJson() !!}
        );
    </script>
@endif
