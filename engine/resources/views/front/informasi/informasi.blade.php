@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                     <h4 class="title mb-4"> Informasi Publik </h4>
                    <p class="text-muted"> Informasi Publik Masjid
                    </p>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Informasi Publik</span>
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

<!-- Changelog Start -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">                 
            @if ($informasi->count() == 0)
                <center><h4>Belum ada Informasi Publik untuk Saat ini.</h4></center>
            @else
            @foreach ($informasi as $item)
                <div class="p-4 shadow rounded border row">
                    <div class="col-md-9">
                        <h5>{{$item->judul}}</h5>
                        @if (is_null($item->deskripsi))
                            <p class="text-muted">-</p> 
                        @else
                            <p class="text-muted">{{$item->deskripsi}}</p> 
                        @endif
                    </div>
                    <div class="col-md-3 text-right">
                        <a target="_blank" href="{{asset('uploads/informasi_publik').'/'.$item->file}}" class="btn btn-primary mt-4">Unduh</a>
                    </div>                                
                </div>
            @endforeach     
            @endif
                       
                
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Changelog End -->

@endsection
