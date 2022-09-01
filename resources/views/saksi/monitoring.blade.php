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
          <a class="nav-link @if (request("table") == 'desa') ? active : '' @endif" aria-current="page" href="?table=desa">Desa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (request("table") == 'kecamatan') ? active : '' @endif" href="?table=kecamatan">Kecamatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (request("table") == 'kabupaten') ? active : '' @endif" href="?table=kabupaten">Kabupaten</a>
        </li>
      </ul>

      <div class="row">
        
        <div class="col-lg-12 d-flex justify-content-center align-items-center" id="chart">
          <div class="spinner-border" role="status"></div>
        </div>
        <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                @if (request("table") == "desa")
                <th>Penanggung Jawab</th>
                <th>Desa</th>
                <th>Caleg</th>
                <th>Partai</th>
                @endif
                @if (request("table") == "kecamatan")
                <th>Kecamatan</th>
                <th>Penanggung Jawab</th>
                @elseif (request("table") == "kabupaten")
                <th>Kabupaten</th>
                @endif
                <th>Total Suara 2024</th>
                <th>Total Suara 2019</th>
              </tr>
            </thead>
            <tbody>
              @if (request("table") == "desa")
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
              @endif
              @if (request("table") == "kecamatan")
              @foreach ($dataArr as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data[0] }}</td>
                    <td>{{ $data[1] }}</td>
                    <td>{{ $data[2] }}</td>
                  </tr>
              @endforeach
              @endif
              @if (request("table") == "kabupaten")
              @foreach ($dataArr as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data[0] }}</td>
                    <td>{{ $data[1] }}</td>
                    <td>{{ $data[2] }}</td>
                  </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
    <script>

      anychart.onDocumentReady(function () {
          // create data set on our data
          @if (request("table") == "desa")
          fetch("{{ asset('api/getChartDesa') }}").then(resp => resp.json()).then(resp => {
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
          setupSeries(series, 'Pemilih 2024');

          // create second series with mapped data
          series = chart.column(secondSeriesData);
          series.xPointPosition(0.45);
          setupSeries(series, 'Pemilih 2019');
          
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
      }

      }).catch(err => document.getElementById("chart").innerHTML = "Error When Getting Data");
      @else

      @if ($dataArr->count()) 
          document.getElementsByClassName("spinner-border")[0].style.display = "none";
          var dataSet = anychart.data.set({!! $dataArr !!});
              
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
          setupSeries(series, 'Pemilih 2024');

          // create second series with mapped data
          series = chart.column(secondSeriesData);
          series.xPointPosition(0.45);
          setupSeries(series, 'Pemilih 2019');
          
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
      @else 
          document.getElementById("chart").innerHTML = "Tidak Ada Suara Untuk Saat Ini";
      @endif
      @endif
    })
      </script>
@endsection
