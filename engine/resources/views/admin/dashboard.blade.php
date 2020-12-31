@extends('layouts.back.base')

@section('page_title','Dashboard')

@section('content')
<!-- Header -->
<div id="content-header">
    <div class="header-name">
        <h1 class="tour-step-one">Selamat Datang, {{ Auth::user()->name }}</h1>
        <span class="font-weight-bold"> Portal Utama SISTAMAS</span>
    </div>
</div><!-- end #content-header -->
<!-- Main content -->
<div id="main-content">
    <div class="row">
        <div class="col-md-12 m-b-30">
            <div class="card-box">
                <div class="card-b">
                    <div class="row">
                    </div>

                    <div class="row view-project-info-footer palaner-tr">
                        <div class="col-md-4">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-information"></i></div>
                                <p class="planner-tr-desc">Total Masjid Terdaftar <span>{{ $c_masjid }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-calendar"></i></div>
                                <p class="planner-tr-desc">Total Agenda <span>{{ $c_agenda }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-wallet"></i></div>
                                <p class="planner-tr-desc">Total Saldo Penerimaan <span>Rp.{{ number_format($c_penerimaan,0) }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-user-group"></i></div>
                                <p class="planner-tr-desc">Total Pengguna <span>{{ $c_user }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-article"></i></div>
                                <p class="planner-tr-desc">Total Berita <span>{{ $c_berita }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-export"></i></div>
                                <p class="planner-tr-desc">Total Saldo Pengeluaran <span>Rp.{{ number_format($c_pengeluaran,0) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Komposisi Saldo</h4>
                </div>
                <div class="card-body">
                    <canvas id="chLine"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Saldo Penerimaan
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="chPie"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Saldo Pengeluaran
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="chPieKeluaran"></canvas>
                </div>
            </div>
        </div>
    </div>
</div><!-- end #main-content -->
@endsection

@push('custom_script')
<script src="{{ asset('assets-back') }}/js/chart.js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
                   /* chart.js chart examples */

    // chart colors
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var colorSaldo = ['#FF0000','#00FF00'];

    /* large line chart */
    var chLine = document.getElementById("chLine");
    var chartData = {
    labels: [ "Triwulan I", "Triwulan II", "Triwulan III", "Triwulan IV"],
    datasets: [{
        data: [589, 445, 483, 503, 689, 692, 634],
        backgroundColor: 'transparent',
        borderColor: colorSaldo[0],
        borderWidth: 4,
        pointBackgroundColor: colorSaldo[0],
         label: "Pengeluaran"
    },
       {
         data: [639, 465, 493, 478, 589, 632, 674],
         backgroundColor: colors[3],
         borderColor: colorSaldo[1],
         borderWidth: 4,
         pointBackgroundColor: colorSaldo[1],
         label: "Pemasukan"
       }
    ]
    };
    if (chLine) {
    new Chart(chLine, {
    type: 'line',
    data: chartData,
    options: {
        scales: {
        xAxes: [{
            ticks: {
            beginAtZero: false
            }
        }]
        },
        legend: {
        display: true
        },
        responsive: true
    }
    });
    }

    /* large pie/donut chart */
    var chPie = document.getElementById("chPie");
    if (chPie) {
    new Chart(chPie, {
        type: 'pie',
        data: {
        labels: ['KOTA BANDUNG', 'Sleman', 'Depok'],
        datasets: [
            {
            backgroundColor: [colors[1],colors[0],colors[2],colors[5]],
            borderWidth: 0,
            data: [5000000, 2000000, 1400000]
            }
        ]
        },
        plugins: [{
        beforeDraw: function(chart) {
            var width = chart.chart.width,
                height = chart.chart.height,
                ctx = chart.chart.ctx;
            ctx.restore();
            ctx.save();
        }
        }],
        options: {layout:{padding:0}, legend:{display:false}, cutoutPercentage: 0}
    });
    }

    var chPie2 = document.getElementById("chPieKeluaran");
    if (chPie2) {
    new Chart(chPie2, {
        type: 'pie',
        data: {
        labels: ['KOTA BANDUNG', 'Sleman', 'Depok'],
        datasets: [
            {
            backgroundColor: [colors[1],colors[0],colors[2],colors[5]],
            borderWidth: 0,
            data: [3500000, 2005000, 1000000]
            }
        ]
        },
        plugins: [{
        beforeDraw: function(chart) {
        }
        }],
        options: {layout:{padding:0}, legend:{display:false}, cutoutPercentage: 0}
    });
    }

    });
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endpush