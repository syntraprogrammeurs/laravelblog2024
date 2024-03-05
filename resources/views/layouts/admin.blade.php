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
                <x-card></x-card>
                <x-chart></x-chart>
            </div>
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
</div>
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
