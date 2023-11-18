<div wire:ignore>
    <div class="wrapper-{{ $brush_chart_id }}">
        <div class="" id="{{ $sub_chart_id }}"></div>
        <div class="" id="{{ $main_chart_id }}" style="position: relative; margin-top: -38px;"></div>
    </div>
</div>

@if (!empty(config('larapex-livewire.script_section', '')))
    @push(config('larapex-livewire.script_section'))
        <script>
            window.initApexChart(
                document.querySelector("#{{ $sub_chart_id }}"),
                "{{ $sub_chart_code }}",
                {!! $sub_options !!}
            );
            window.initApexChart(
                document.querySelector("#{{ $main_chart_id }}"),
                "{{ $main_chart_code }}",
                {!! $main_options !!}
            );
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

                            window.updateLarapexBrushChartOptions(
                                chartResponse.data.main_chart_code,
                                chartResponse.data.sub_chart_code,
                                JSON.parse(chartResponse.data.main_options),
                                JSON.parse(chartResponse.data.sub_options),
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
        </script>
    @endpush
@else
    <script>
        window.initApexChart(
            document.querySelector("#{{ $sub_chart_id }}"),
            "{{ $sub_chart_code }}",
            {!! $sub_options !!}
        );
        window.initApexChart(
            document.querySelector("#{{ $main_chart_id }}"),
            "{{ $main_chart_code }}",
            {!! $main_options !!}
        );
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
                        window.updateLarapexBrushChartOptions(
                            chartResponse.data.main_chart_code,
                            chartResponse.data.sub_chart_code,
                            JSON.parse(chartResponse.data.main_options),
                            JSON.parse(chartResponse.data.sub_options),
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
    </script>
@endif
