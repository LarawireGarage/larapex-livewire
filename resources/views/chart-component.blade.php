<div class="larapex-chart-component" wire:ignore>
    <div id="{!! $chart_id !!}" class="m-0"></div>
</div>

@if (!empty(config('larapex-charts.script_section', '')))
    @push(config('larapex-charts.script_section'))
        <script>
            // component scripts
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.processed', (message, component) => {
                    window.updateLarapexChartOptions(
                        @this.chart_code,
                        JSON.parse(@this.options),
                        @this.redraw,
                        @this.animate,
                        @this.updateSyncCharts
                    );
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
            Livewire.hook('message.processed', (message, component) => {
                window.updateLarapexChartOptions(
                    @this.chart_code,
                    JSON.parse(@this.options),
                    @this.redraw,
                    @this.animate,
                    @this.updateSyncCharts
                );
            });
        });

        window.initApexChart(
            document.querySelector("#{{ $chart_id }}"),
            "{{ $chart_code }}",
            {!! $chart->getOptionsAsJson() !!}
        );
    </script>
@endif
