@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
  
    <div class="card-header py-3">
      <i class="fas fa-desktop text-primary"></i>
      <span class="m-0 font-weight-bold text-primary">
        Monitoring
    </span>
    </div>

    <div class="card-body">
      <ul class="nav nav-pills mb-4">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/saksi/monitoring?table=desa">Desa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/saksi/monitoring?table=kecamatan">Kecamatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/saksi/monitoring?table=kabupaten">Kabupaten</a>
        </li>
      </ul>

      <div class="row">
        <div class="col-lg-6">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Desa</th>
                <th>Caleg</th>
                <th>Partai</th>
                <th>Suara 2024</th>
                <th>Suara 2019</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataArr as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->desa->nama_desa }}</td>
                    <td>{{ $data->caleg->nama_caleg }}</td>
                    <td>{{ $data->partai->nama_partai }}</td>
                    <td>{{ $data->suara_2024 }}</td>
                    <td>{{ $data->suara_2019 }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-6 d-flex justify-content-center align-items-center" id="chart2">
        <div class="spinner-border" role="status"></div>
      </div>
    </div>
  </div>
</div>
    <script>

      anychart.onDocumentReady(function () {
          // create data set on our data
          fetch("/api/getChartDesa").then(resp => resp.json()).then(resp => {
          if (resp.length > 0) {
          document.getElementsByClassName("spinner-border")[0].style.display = "none";
          var dataSet = anychart.data.set(resp);
              
              // map data for the first series, take x from the zero column and value from the first column of data set
          var firstSeriesData = dataSet.mapAs({ x: 0, value: 1 });
          
          // map data for the second series, take x from the zero column and value from the second column of data set
          var secondSeriesData = dataSet.mapAs({ x: 0, value: 2 });
          
          // create column chart
          var chart = anychart.column3d();
          
          // turn on chart animation
          chart.animation(true);
          
          // set chart title text settings
          // chart.title('');
          
          // temp variable to store series instance
          var series;
          
          // helper function to setup label settings for all series
          var setupSeries = function (series, name) {
              series.name(name);
              series.selected().fill('#f48fb1 0.8').stroke('1.5 #c2185b');
          };

          // create first series with mapped data
          series = chart.column(firstSeriesData);
          series.xPointPosition(0.25);
          setupSeries(series, 'Pemilih');

          // create second series with mapped data
          // series = chart.column(secondSeriesData);
          // series.xPointPosition(0.45);
          // setupSeries(series, 'Perempuan');
          
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
          chart.container('chart2');
          
          // initiate chart drawing
          chart.draw();
      } else if (resp.length == 0) {
          document.getElementById("chart2").innerHTML = "Tidak Ada Suara Untuk Saat Ini";
      } else {
          document.getElementById("chart2").innerHTML = "Error When Getting Data";
      }

      });
  })
      </script>
@endsection
