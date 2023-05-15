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
                Livewire.hook('message.processed', (message, component) => {
                    window.updateLarapexBrushChartOptions(
                        @this.main_chart_code,
                        @this.sub_chart_code,
                        JSON.parse(@this.main_options),
                        JSON.parse(@this.sub_options),
                        @this.redraw,
                        @this.animate,
                        @this.updateSyncCharts
                    );
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
            Livewire.hook('message.processed', (message, component) => {
                window.updateLarapexBrushChartOptions(
                    @this.main_chart_code,
                    @this.sub_chart_code,
                    JSON.parse(@this.main_options),
                    JSON.parse(@this.sub_options),
                    @this.redraw,
                    @this.animate,
                    @this.updateSyncCharts
                );
            });
        });
    </script>
@endif
