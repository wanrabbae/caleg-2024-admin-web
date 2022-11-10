@extends('layouts.admin')

@section('content')
<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-bar text-lg"></i>
                    Total Data Relawan
                </h6>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center" id="chart">
                <div class="spinner-border" role="status">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("script")
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
        });

        let getData = () => {
                let result = $.ajax({
                url: `{{ asset('getChartRelawan') }}`,
                method: "POST",
                data: {
                getData: true,
                },
                dataType: "json",
                success: resp => resp
            })
            return result;
      }

        anychart.onDocumentReady(async function() {
            let resp = await getData()
                    // create data set on our data
                        if (resp.length > 0) {
                            document.getElementsByClassName("spinner-border")[0].style.display = "none";
                            var dataSet = anychart.data.set(resp);

                            // map data for the first series, take x from the zero column and value from the first column of data set
                            var firstSeriesData = dataSet.mapAs({
                                x: 0,
                                value: 1
                            });

                            // map data for the second series, take x from the zero column and value from the second column of data set
                            var secondSeriesData = dataSet.mapAs({
                                x: 0,
                                value: 2
                            });

                            // create column chart
                            var chart = anychart.column3d();

                            // turn on chart animation
                            chart.animation(true);

                            // set chart title text settings
                            // chart.title('');

                            // temp variable to store series instance
                            var series;

                            // helper function to setup label settings for all series
                            var setupSeries = function(series, name) {
                                series.name(name);
                                series.selected().fill('#f48fb1 0.8').stroke('1.5 #c2185b');
                            };

                            // create first series with mapped data
                            series = chart.column(firstSeriesData);
                            series.xPointPosition(0.25);
                            setupSeries(series, 'Laki-Laki');

                            // create second series with mapped data
                            series = chart.column(secondSeriesData);
                            series.xPointPosition(0.45);
                            setupSeries(series, 'Perempuan');

                            chart.yAxis().labels().format('{%Value}{groupsSeparator: }');

                            // set titles for Y-axis
                            // chart.yAxis().title('Revenue in Dollars');

                            // set chart title text settings
                            chart.barGroupsPadding(0.3);

                            // turn on legend
                            chart.legend().enabled(true).fontSize(13).padding([0, 0, 20, 0]);

                            chart.interactivity().hoverMode('single');

                            // chart.tooltip().valuePrefix('$');

                            // set container id for the chart
                            chart.container('chart');

                            // initiate chart drawing
                            chart.draw();
                        } else if (resp.length == 0) {
                            document.getElementById("chart").innerHTML = "Tidak Ada Suara Untuk Saat Ini";
                        } else {
                            document.getElementById("chart").innerHTML = "Error When Getting Data";
                        }
                        });
                    })
</script>
@endsection