@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    DPT
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $pemilih }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Suara
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1000</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-chart-bar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Relawan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $relawan }}</div>
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Calon Pemilih
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-pie text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>


        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-bar text-lg"></i>
                            Perolehan Suara Kecamatan
                        </h6>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" id="chart">
                        <div class="spinner-border" role="status">
                        </div>
                    </div>
                </div>

            </div>

            @auth("caleg")
            <div class="col-md-12 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-bar text-lg"></i>
                            Perolehan Total Suara
                        </h6>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" id="suaraChart">
                        <div class="spinner-border-suara" role="status">
                        </div>
                    </div>
                </div>

            </div>
            @endauth
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
                url: `{{ asset('api/getChart') }}`,
                method: "POST",
                data: {
                getData: true,
                data: "{{ auth('web')->check() ? 0 : auth()->user()->id_caleg }}"
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
        
                    @auth("caleg")
                    let getSuara = () => {
                        let result = $.ajax({
                                url: `{{ asset('api/getChartSuara') }}`,
                                method: "POST",
                                data: {
                                getData: true,
                                data: "{{ auth()->user()->id_caleg }}"
                                },
                                dataType: "json",
                                success: resp => resp
                            })
                            return result;
                    }

                    anychart.onDocumentReady(async function() {
                        let resp = await getSuara()
                        // create data set on our data
                           if (resp.length > 0) {
                            document.getElementsByClassName("spinner-border-suara")[0].style.display = "none";
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
                            setupSeries(series, 'Suara Harapan');

                            // create second series with mapped data
                            series = chart.column(secondSeriesData);
                            series.xPointPosition(0.45);
                            setupSeries(series, 'Total Suara');

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
                            chart.container('suaraChart');

                            // initiate chart drawing
                            chart.draw();
                        } else if (resp.length == 0) {
                            document.getElementById("suaraChart").innerHTML = "Tidak Ada Suara Untuk Saat Ini";
                        } else {
                            document.getElementById("suaraChart").innerHTML = "Error When Getting Data";
                        }
                        });
                    @endauth
</script>
@endsection