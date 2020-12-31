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
                        <div class="col-md-6">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-information"></i></div>
                                <p class="planner-tr-desc">Total Pengumuman <span>{{ $c_announce }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-wallet"></i></div>
                                <p class="planner-tr-desc">Total Saldo Penerimaan <span>Rp.{{ number_format($c_penerimaan,0) }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-user-group"></i></div>
                                <p class="planner-tr-desc">Total Pengguna <span>{{ $c_user }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
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
        <div class="col-md-12 col-lg-12 col-sm-12 m-b-30">
            <ul class="row support-faq nav justify-content-center" role="tablist">
                <li class="nav-link col-sm-12 m-b-20">
                    <a class="nav-tab-link" href="#g-started" role="tab" data-toggle="tab" aria-expanded="false">
                        <i class="dripicons-broadcast"></i>
                        PENGUMUMAN
                    </a>
                </li>
            </ul>
            <div class="support-tablist-content tab-content">
                <div role="tabpanel" class="tab-pane animated fadeInUp active" id="g-started">
                    <div class="accordion" id="accordionExample">
                        @foreach ($announces as $item)
                        <div class="card mb-2">
                            <div class="card-header" id="heading-{{ $item->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#row_ann-{{ $item->id }}" aria-expanded="true">
                                        <i class="fas fa-circle"></i> {{ $item->title }}
                                        <i class="card-m-l dripicons-chevron-down" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div id="row_ann-{{ $item->id }}" class="help-dsc collapse show"
                                aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $item->caption !!}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 m-b-30">
            <div class="card">
                <div class="card-header">
                    <h4>Komposisi Saldo</h4>
                </div>
                <div class="card-body">
                    <canvas id="chLine"></canvas>
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
        // chart colors
        var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        var colorSaldo = ['#FF0000','#00FF00'];

        /* large line chart */
        var chLine = document.getElementById("chLine");
        var chartData = {
            labels: [ "Januari", "Februari", "Maret", "April", "Mei", "Jeni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                data: [1100000, 1200000, 1400000, 1600000, 1700000, 1800000, 1900000, 2100000, 2200000, 2500000, 3000000, 4150000],
                backgroundColor: 'transparent',
                borderColor: colorSaldo[0],
                borderWidth: 4,
                pointBackgroundColor: colorSaldo[0],
                label: "Pengeluaran"
            },
            {
                data: [100000, 500000, 1000000, 1500000, 2000000, 3500000, 4000000, 5000000, 7000000, 8000000, 9000000, 10400000],
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

    });
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endpush