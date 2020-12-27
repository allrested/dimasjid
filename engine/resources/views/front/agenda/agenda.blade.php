@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> Agenda Masjid </h4>
                    <p class="text-muted"> Informasi berkaitan agenda terbaru dari kegiatan Masjid
                    </p>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Agenda</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Hero End -->


<!-- Blog STart -->
<section class="section pt-2">
    <div class="container">
        <div class="row">
            @if ($agendas->count() == 0)
            <div class="col-lg-12 text-center pt-5 mb-0">
                <h5>Belum ada Agenda untuk bulan ini</h5>
            </div>
            @else
            <div class="col-lg-12 text-center pt-2">
                <a class="nav-link rounded active" id="pills-dayone-tab" data-toggle="pill"
                        href="#" role="tab" aria-controls="pills-dayone"
                        aria-selected="false">
                    <div class="text-center pt-1 pb-1">                            
                        <h4 class="title font-weight-normal mb-0">Periode Bulan {{ date('M Y') }} </h4>
                    </div>
                </a>
            </div>
            @foreach ($agendas as $item)
            <div class="col-lg-6 mt-4 pt-2">
                <div class="event-schedule d-flex bg-white rounded p-3 border">
                    <div class="float-left">
                        <ul class="date text-center text-primary mr-md-4 mr-3 mb-0 list-unstyled">
                            <li class="day font-weight-bold mb-2">{{ date('d', strtotime($item->time_start)) }}
                            </li>
                            <li class="month font-weight-bold">{{ date('M', strtotime($item->time_start)) }}
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <h4><a href="{{url('agenda').'/'.$item->id}}" class="text-dark title">{{ $item->title }}</a></h4>
                        <p class="text-muted location-time"><span class="text-dark h6">Tempat:</span>
                            {{ $item->location }}
                            <br> <span class="text-dark h6">Jam:</span>
                            {{ date('H:i', strtotime($item->time_start)) }} sampai
                            {{ date('H:i', strtotime($item->time_end)) }}</p>
                        <a href="{{url('agenda').'/'.$item->id}}" class="btn btn-sm btn-outline-primary mouse-down">Detail</a>
                    </div>
                </div>
            </div>
            <!--end col-->
            @endforeach
            @endif            
            <!-- PAGINATION START -->
            <div class="col-12 pt-5">
                <ul class="pagination justify-content-center mb-0 list-unstyled">
                    {{ $agendas->links() }}
                </ul>
                <!--end pagination-->
            </div>
            <!--end col-->
            <!-- PAGINATION END -->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Blog End -->


@endsection
