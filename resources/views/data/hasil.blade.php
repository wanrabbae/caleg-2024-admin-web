@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12 d-flex justify-content-center align-items-center" id="chart">
      <div class="spinner-border" role="status"></div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="col-md-3">
    </div>
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Ya</th>
                        <th>Tidak</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($relawanSurvey->count())
                        @foreach ($relawanSurvey as $jawaban)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jawaban[0] }}</td>
                                <td>{!! implode("<br>", $jawaban[1]) !!}</td>
                                <td>{!! implode("<br>", $jawaban[2]) !!}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section("script")
<script>
    $(document).ready(function() {
        anychart.onDocumentReady(function() {
                    @if ($data->count())
                    document.getElementsByClassName("spinner-border")[0].style.display = "none";
                    var dataSet = anychart.data.set({!! $data !!});
                        
                        // map data for the first series, take x from the zero column and value from the first column of data set
                    var firstSeriesData = dataSet.mapAs({ x: 0, value: 1 });
                    
                    // map data for the second series, take x from the zero column and value from the second column of data set
                    var secondSeriesData = dataSet.mapAs({ x: 0, value: 2 });
                    
                    // create column chart
                    var chart = anychart.column3d();
                    
                    // turn on chart animation
                    chart.animation(true);
                    
                    // set chart title text settings
                    chart.title("{{ $survey }}");
                    
                    // temp variable to store series instance
                    var series;
                    
                    // helper function to setup label settings for all series
                    var setupSeries = function (series, name) {
                        series.name(name);
                        series.selected().fill('#f48fb1 0.8').stroke('1.5 #fc0303');
                    };

                    // create first series with mapped data
                    series = chart.column(firstSeriesData);
                    series.xPointPosition(0.25);
                    setupSeries(series, 'Ya');

                    // create second series with mapped data
                    series = chart.column(secondSeriesData);
                    series.xPointPosition(0.45);
                    setupSeries(series, 'Tidak');
                    
                    chart.yAxis().labels().format('{%Value}{groupsSeparator: }');

                    // set titles for Y-axis
                    chart.xAxis().labels().width(200); 

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
                    @elseif ($data->count() == 0)
                    document.getElementById("chart").innerHTML = "Tidak Ada Suara Untuk Saat Ini";
                    @else
                    document.getElementById("chart").innerHTML = "Error When Getting Data";
                    @endif
                })
                })
</script>
@endsection