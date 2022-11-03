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
      {{-- <ul class="nav nav-pills mb-4">
        <li class="nav-item">
          <a class="nav-link @if (request("table") == 'desa') ? active : '' @endif" aria-current="page" href="?table=desa">Desa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (request("table") == 'kecamatan') ? active : '' @endif" href="?table=kecamatan">Kecamatan</a>
        </li>
        @if (auth("caleg")->check() && auth()->user()->legislatif->type == "Provinsi")
        <li class="nav-item">
          <a class="nav-link @if (request("table") == 'kabupaten') ? active : '' @endif" href="?table=kabupaten">Kabupaten</a>
        </li>
        @endif
      </ul> --}}

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center align-items-center" id="chart">
          <div class="spinner-border" role="status"></div>
        </div>
        <div class="col-lg-12">
        <div class="table-responsive">
          <div class="d-flex justify-content-between flex-column flex-md-row">
            <div>
              <form action="" method="GET" class="d-block mb-2">
              @if (request()->has("search"))
              <input type="hidden" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
              @endif
              <span class="d-block">Data Per Page</span>
                <input type="number" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                <datalist id="paginates">
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </datalist>
              </form>
            </div>
            <div>
              <form action="" method="GET" class="d-block mb-2" onsubmit="return !/[^\w\d@\s]/gi.test(this['search'].value)">
                @if (request()->has("paginate"))
                <input type="hidden" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                @endif
                <span class="d-block">Search</span>
                <input type="text" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
              </div>
            </form>
          </div>
            {{-- {{ $dataArr->links() }} --}}
          <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                @if (request("table") == "kabupaten")
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Total Suara</th>
                <th>Detail</th>
                @endif
                @if (request("table") == "kecamatan")
                <th>Kecamatan</th>
                <th>Total Suara</th>
                <th>Kabupaten</th>
                <th>Detail</th>
                @endif
                @if (request("table") == "desa")
                <th>Desa</th>
                <th>Total Suara</th>
                <th>Kecamatan</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @if (request("table") != "desa")
              @foreach ($data as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item[1] }}</td>
                <td>{{ $item[2] }}</td>
                <td>{{ $item[3] }}</td>
                <td>
                  <a href="{{ asset(request('table') == 'kabupaten' ? "saksi/monitoring?table=kecamatan&kabupaten=$item[0]" : "saksi/monitoring?table=desa&kecamatan=$item[0]") }}" class="btn btn-primary">
                    Detail
                  </a>
                </td>
              </tr>
              @endforeach
              @else
              @foreach ($data as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item[0] }}</td>
                <td>{{ $item[1] }}</td>
                <td>{{ $item[2] }}</td>
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
@endsection
{{-- @section("script")
<script>
    $(document).ready(function() {
      @if (request("table") == "desa")
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
        });

        let getData = () => {
                let result = $.ajax({
                url: `{{ asset('api/getChartDesa') }}`,
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
                        } else {
                            document.getElementById("chart").innerHTML = "Error When Getting Data";
                        }
                        });
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
@endsection --}}
@section("script")
<script>
      anychart.onDocumentReady(function() {
          // create data set on our data
          @if ($diagram->count())
                  document.getElementsByClassName("spinner-border")[0].style.display = "none";
                  var dataSet = anychart.data.set({!! $diagram !!});

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
                  @elseif ($diagram->count() == 0)
                  document.getElementById("chart").innerHTML = "Tidak Ada Suara Untuk Saat Ini";
                  @else
                  document.getElementById("chart").innerHTML = "Error When Getting Data";
                  @endif
              });
</script>
@endsection