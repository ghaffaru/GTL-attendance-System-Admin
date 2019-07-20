
@extends('backLayout.app')
@section('title')
  Login
@stop

@section('style')

@stop
@section('content')

<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Employees</span>
              <div class="count">{{ $employees->count() - 1 }}</div>
              <span class="count_bottom"><i class="green"> </i> Registered to the system</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Attendance </span>
              <div class="count">{{ $attendance_today->count() }}</div>
              <span class="count_bottom">today</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Absentees</span>
              <div class="count green">{{ $employees->count() - 1 - $attendance_today->count() }}</div>
              <span class="count_bottom">today</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Attendance </span>
            <div class="count">{{ $attendance_this_week->count() }}</div>
              <span class="count_bottom">this week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Absentees </span>
            <div class="count">{{ $employees->count() - 1 - $attendance_this_week->count() }}</div>
              <span class="count_bottom">this week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Office adherence</span>
              <div class="count">{{ ($attendance_this_week->count() / ($employees->count() - 1)) * 100 }}% </div>
              <span class="count_bottom">this week</span>
            </div>
</div>
          <!-- /top tiles -->
         
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        
            function drawChart() {
        
              var attendance_today = {!! json_encode($attendance_today->count()) !!};
              var temp = {!! json_encode($employees->count() - 1) !!};
              var absentees_today =  temp  - attendance_today;
              var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],

                ['Attendees today',  attendance_today ],
                ['Absentees today', absentees_today]
              ]);
        
              var options = {
                title: "Today's Analytics"
              };
        
              var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        
              chart.draw(data, options);
            }
            </script>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                  <h3>Office Activities <small>Matrices and charts</small></h3>

                <div class="row x_title">
                  <div class="col-md-6">
                    <div id="piechart" style="width:650px; height: 500px;">

                    </div>
                  </div>
                  <div class="col-md-6">
                      <div id="piechart_two" style="width:650px; height: 500px;"> </div>
                  </div>
                </div>

    
                </div>
            </div>

          </div>
          
@endsection

@section('scripts')
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart2);

  function drawChart2() {

    var attendance_this_week = {!! json_encode($attendance_this_week->count()) !!};
    var temp2 = {!! json_encode($employees->count() - 1) !!};
    var absentees_this_week =  temp2 - attendance_this_week;
    var data2 = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],

      ['Attendees this week',  attendance_this_week],
      ['Absentees this week', absentees_this_week]
    ]);

    var options2 = {
      title: "This week's analytics"
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_two'));

    chart.draw(data2, options2);
  }
  </script>

@endsection