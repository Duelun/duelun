@extends('app')

@section('content')
<div class="container admin">

@include('admin_nav')

<aside class="">
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <div>
        <p>You have received {{ $data['emails_received'] }} emails this week.</p>
        <p>{{$data['emails_blocked']}} emails have been blocked from sending.</p>
    </div>
    <br/>

    <div class="top-row">
        <form id="graph_filter">
            <input type="date" id="start_date" name="start_date"
            value="{{ $data['start_date'] }}">
            <input type="date" id="end_date" name="end_date"
            value="{{ $data['end_date'] }}">

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <div id="graphs">
        <div class="graph_container">
            <canvas id="dailyVisitors"></canvas>
        </div>

        <div class="graph_container">
            <canvas id="dailyReadtime"></canvas>
        </div>

        <div class="graph_container">
            <canvas id="top5"></canvas>
        </div>

        <div class="graph_container">
            <canvas id="dailyClickthrough"></canvas>
        </div>
</div>

    </div>
</aside>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    const colourSchemes = [
        {"bg": 'rgb(34, 96, 150)', "border": 'rgb(12, 67, 119)'},
        {"bg": 'rgb(243, 55, 139)', "border": 'rgb(218, 17, 93)'},
        {"bg": 'rgb(204, 153, 204)', "border": 'rgb(102, 0, 102)'},
        {"bg": 'rgb(245, 173, 40)', "border": 'rgb(235, 137, 33)'},
        {"bg": 'rgb(162, 155, 76)', "border": 'rgb(131, 125, 60)'}
    ]

  const data = {
    labels: @json($data['daily_visitors']['labels']),
        datasets: [{
            label: 'Daily Visitors',
            backgroundColor: colourSchemes[0]['bg'],
            borderColor: colourSchemes[0]['border'],
            data: @json($data['daily_visitors']['data']),
        }]
    };

    const config = {
        type: 'line',
        data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Daily Visitors'
                }
            }
        }
    };

  var myChart = new Chart(
    document.getElementById('dailyVisitors'), config
  );


    const top5data = {
    labels: @json($data['top5']['labels']),
    datasets: [
        {
            label: 'Top 5 Visited Pages',
            data: @json($data['top5']['data']),
            backgroundColor: colourSchemes[0]['bg'],
            borderColor: colourSchemes[0]['border'],
        }
    ]
    };
    const top5config = {
    type: 'bar',
    data: top5data,
    options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Top 5 Most visited'
        }
        }
    },
    };
    var top5chart = new Chart(
        document.getElementById('top5'), top5config
    );


    //Clickthrough data
    var clickthroughData = {
    labels: @json($data['clickthrough']['labels']),
    datasets: []
    };
    var clickthrough_json = @json($data['clickthrough']);
    var cnt = 0;
    for(const [k, v] of Object.entries(clickthrough_json['data'])) {
        clickthroughData["datasets"].push({
            label: k,
            data: v,
            backgroundColor: colourSchemes[cnt]['bg'],
            borderColor: colourSchemes[cnt]['border']
        });
        cnt++;
    }
    const clickthroughConfig = {
        type: 'bar',
        data: clickthroughData,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Link Clickthrough Rate'
            }
            }
        },
    };
    var clickthroughChart = new Chart(
        document.getElementById('dailyClickthrough'), clickthroughConfig
    );


    //Clickthrough data
    var readtimeData = {
    labels: @json($data['readtime']['labels']),
    datasets: []
    };
    var readtime_json = @json($data['readtime']);
    var cnt = 0;
    for(const [k, v] of Object.entries(readtime_json['data'])) {
        readtimeData["datasets"].push({
            label: k,
            data: v,
            backgroundColor: colourSchemes[cnt]['bg'],
            borderColor: colourSchemes[cnt]['border']
        });
        cnt++;
    }
    const readtimeConfig = {
        type: 'line',
        data: readtimeData,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Daily Readtime in Minutes'
            }
            }
        },
    };
    var readtimeChart = new Chart(
        document.getElementById('dailyReadtime'), readtimeConfig
    );

</script>

@endsection
