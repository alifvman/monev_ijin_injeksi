@extends('internal.layout')

@section('content')


    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>TOTAL PERMOHONAN</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $permohonan['total'] }}</span></div>
                        </div>
                        <div class="col-auto"><i class="far fa-copy fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>PERMOHONAN SELESAI</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $permohonan['completed'] }}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-copy fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-info py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>PERSENTASE PENYELESAIAN</span></div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>{{ intval(($permohonan['completed']/($permohonan['total']-$permohonan['completed']))*100) }}%</span></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="sr-only"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="far fa-flag fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-warning py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>PERMOHONAN TERSISA</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ ($permohonan['total']-$permohonan['completed']) }}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-inbox fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="statistic"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Kinerja</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="performance"></canvas></div>
                    <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-primary"></i>&nbsp;Dalam Proses</span><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Selesai</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Dalam Proses</h6>
                </div>
                <div class="card-body">
@foreach ($proses as $p)
                    <h4 class="small font-weight-bold">{{ $p['nama'] }}<span class="float-right">
@if ($p['permohonan']>0)
    {{ $p['permohonan'] }} Permohonan
@else
    -
@endif
                        </span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" aria-valuenow="{{ intval(($p['permohonan']/($permohonan['total']-$permohonan['completed']))*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ intval(($p['permohonan']/($permohonan['total']-$permohonan['completed']))*100) }}%;"><span class="sr-only">{{ intval(($p['permohonan']/($permohonan['total']-$permohonan['completed']))*100) }}%</span></div>
                    </div>
@endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/assets/js/chart.min.js"></script>
@endsection

@section('in-script')
    $(document).ready(function() {
        new Chart($('#statistic'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'],
                datasets: [{
                    label: 'Total Permohonan',
                    fill: true,
                    data: [{{ implode(", ", $statistik['total']) }}],
                    backgroundColor: 'rgba(63, 63, 191, 0.05)',
                    borderColor: 'rgba(63, 63, 191, 1)'
                },{
                    label: 'Permohonan Selesai',
                    fill: true,
                    data: [{{ implode(", ", $statistik['selesai']) }}],
                    backgroundColor: 'rgba(63, 191, 63, 0.05)',
                    borderColor: 'rgba(63, 191, 63, 1)'
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                title: {},
                scales: {
                    xAxes:[{
                        gridLines: {
                            color: 'rgb(234, 236, 244)',
                            zeroLineColor: 'rgb(234, 236, 244)',
                            drawBorder: false,
                            drawTicks: false,
                            borderDash: ['2'],
                            zeroLineBorderDash: ['2'],
                            drawOnChartArea: false
                        },
                        ticks: {
                            fontColor: '#858796',
                            padding: 20
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: 'rgb(234, 236, 244)',
                            zeroLineColor: 'rgb(234, 236, 244)',
                            drawBorder: false,
                            drawTicks: false,
                            borderDash: ['2'],
                            zeroLineBorderDash: ['2']
                        },
                        ticks: {
                            fontColor: '#858796',
                            padding: 20
                        }
                    }]
                }
            }
        });
        new Chart($('#performance'), {
            type: 'doughnut',
            data: {
                labels: ['Dalam Proses', 'Selesai'],
                datasets: [{
                    label: '',
                    backgroundColor: ['#4e73df', '#1cc88a'],
                    borderColor: ['#ffffff', '#ffffff'],
                    data: [{{ $permohonan['total']-$permohonan['completed'] }}, {{ $permohonan['completed'] }}]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {display: false},
                title: {}
            }
        });

    }),
    function(e) {
        "use strict";
        e("#sidebarToggle, #sidebarToggleTop").on("click", function(o) {
            e("body").toggleClass("sidebar-toggled"), e(".sidebar").toggleClass("toggled"), e(".sidebar").hasClass("toggled") && e(".sidebar .collapse").collapse("hide")
        }), e(window).resize(function() {
            e(window).width() < 768 && e(".sidebar .collapse").collapse("hide")
        }), e("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(o) {
            if (e(window).width() > 768) {
                var t = o.originalEvent,
                    l = t.wheelDelta || -t.detail;
                this.scrollTop += 30 * (l < 0 ? 1 : -1), o.preventDefault()
            }
        }), e(document).on("scroll", function() {
            e(this).scrollTop() > 100 ? e(".scroll-to-top").fadeIn() : e(".scroll-to-top").fadeOut()
        }), e(document).on("click", "a.scroll-to-top", function(o) {
            var t = e(this);
            e("html, body").stop().animate({
                scrollTop: e(t.attr("href")).offset().top
            }, 1e3, "easeInOutExpo"), o.preventDefault()
        })
    }(jQuery);
@endsection
