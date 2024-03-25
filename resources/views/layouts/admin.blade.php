<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body class="sb-nav-fixed">
@include('includes.navbar')
<div id="layoutSidenav">
    @include('includes.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <x-alert/>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><h1>@yield('title')</h1></li>
                </ol>
{{--                @yield('cards', View::make('layouts.partials.cards'))--}}
{{--                @yield('charts', View::make('layouts.partials.charts'))--}}
                @section('graph')
                    <x-card></x-card>
                    <x-chart></x-chart>
                @show

            </div>
            <div>

            </div>
            @yield('content')
            <div id="piechart" style="width: 900px; height: 500px;"></div>
        </main>
        @include('includes.footer')
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
<script>
    //10 seconden de alert laten staan
    window.setTimeout(function () {
        document.querySelector(".alert").style.display = 'none';
    }, 10000);
</script>

@yield('page-specific-scripts')

</body>
</html>
