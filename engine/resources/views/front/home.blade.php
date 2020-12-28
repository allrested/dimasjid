@extends('layouts.front.base')

@section('content')
<!-- Hero Start -->
<section class="main-slider">
    <ul class="slides">

        @foreach ($banners as $banner)
        <li class="bg-slider d-flex align-items-center"
            style="background-image:url('{{ asset('uploads') }}/banner/{{ $banner->image}}')">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <div class="title-heading text-white mt-4">
                            <div class="text-center mb-3">
                                <h3 class="title-dark font-weight-bold" >{{ $banner->title }}
                                </h3>
                            </div>                        
                            <p class="para-desc para-dark mx-auto text-light">{{ $banner->caption }}
                            </p>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </li>
        @endforeach
    </ul>
</section>
<!--end section-->
<!-- Hero End -->

<!-- FEATURES START -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div
                    class="course-feature text-center position-relative d-block overflow-hidden bg-light rounded p-4 pt-5 pb-5">

                    <h3 class="mt-1 border-bottom "><a href="javascript:void(0)" class="title text-primary"> PENGUMUMAN
                        </a></h3>

                    <div id="carouselExampleSlidesOnly" class="carousel slide " data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active mt-3">
                                <p class="text-muted">Berikut adalah Pengumuman Resmi dari SISTAMAS</p>
                            </div>
                            
                            @foreach ($announces as $item)
                            <div class="carousel-item mt-3">

                                <p class="text-muted "><strong>{{ $item->title }} </strong> <br>
                                    {{strip_tags($item->caption)}}
                                </p>
                            </div>
                            @endforeach

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- FEATURES END -->

<!-- About Start -->
<section class="section pt-0 mb-0">
    <div class="container">
        <div class="row align-items-center">

            <div class="section-title ml-lg-4">
                <h4 class="title mb-4">Informasi <span class="text-primary"> Aplikasi
                    </span></h4>
                <p class="text-muted text-justify">SISTAMAS adalah sebuah aplikasi
                    berbasis web
                    yang dapat mengelola sistem keuangan masjid.

                </p>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--enc container-->
</section>
<!--end section-->
<!-- About End -->

<!-- Cta Start -->
<section class="section bg-cta pt-3 mb-0" id="cta">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4">Video</h4>
                    <p class="para-desc para-dark mx-auto">Video kajian dan kegiatan dari Masjid</p>
                    <div class="row">
                        @if (@$videos->count() == 0)
                            <div class="col-md-12 text-center">
                                <center><h5>Belum ada Video dari SISTAMAS untuk saat ini</h5></center>
                            </div>                            
                        @else
                            @foreach ($videos as $item)
                            <div class="col-sm-6 embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item p-2" src="{{$item->link}}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            @endforeach
                        @endif                    
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>


<!--end section-->
<!-- Cta End -->

<!-- Schedule Start -->
<section class="section pt-3 mb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Kegiatan Bulanan Masjid</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Berikut adalah agenda kegiatan yang dilakukan oleh
                        Masjid</p>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row mt-4 pt-2 justify-content-center">
            <div class="col-lg-8 col-md-12 text-center">
                <ul class="nav nav-pills rounded nav-justified flex-column flex-sm-row">
                    <li class="nav-item">
                         @if ($agendas->count() != 0)
                        <a class="nav-link rounded active" id="pills-dayone-tab" data-toggle="pill"
                            href="#" role="tab" aria-controls="pills-dayone"
                            aria-selected="false">
                            <div class="text-center pt-1 pb-1">                            
                                <h4 class="title font-weight-normal mb-0">Periode Bulan {{ date('M Y') }} </h4>
                            </div>
                        </a>
                         @endif      
                        <!--end nav link-->
                    </li>
                    <!--end nav item-->
                </ul>
                <!--end nav pills-->
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    @if ($agendas->count() == 0)
                    <div class="col-md-12 text-center">
                        <center><h5>Belum Agenda dari Masjid untuk bulan ini</h5></center>
                    </div>                    
                    @else
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
                   
                </div>
                <!--end row-->
            </div>
            <!--end teb pane-->
        </div>
        <!--end tab content-->
        <div class="mt-4 text-center">
            <a href="{{url('agenda')}}" class="btn btn-primary mt-2 mouse-down">Selengkapnya</a>
        </div>
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Schedule End -->

<!-- Galleri -->
<section class="section pt-3 mb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-60">
                    <h4 class="title mb-4">Galeri Foto</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Galeri Foto</p>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-12">
                @if ($galleries->count() == 0)
                <center><h5>Belum ada Galeri dari Masjid untuk Saat ini</h5></center>
                @else
                 <div id="customer-testi" class="owl-carousel owl-theme">
                    @foreach ($galleries as $item)
                    <div class="customer-testi mr-2 ml-2 text-center p-1 rounded border">
                        <img src="{{ asset('uploads') }}/gallery/{{ $item->image }}"
                            class="img-fluid mx-auto" alt="" style="min-height: 230px;max-height:230px;">
                    </div>
                    @endforeach
                </div>
                @endif
               
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->

<!-- Link Terkait -->
<section class="section pt-3 mb-0" id="link">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Link Terkait </h4>
                    <p class="text-muted para-desc mx-auto mb-0">Link Terkait</p>
                </div>
            </div>
            <!--end col-->
        </div>

        <!--end row-->
        <div class="row mt-3 justify-content-md-center">
            @if ($links->count() == 0)
              <center><h5>Belum ada Link Terkait dengan SISTAMAS untuk Saati ini</h5></center>
            @else
            @foreach ($links as $item)
            <div class="col-lg-3 col-md-3 col-12 text-center">
                <a class="p-4 border rounded d-block" href="{{'http://'.$item->link}}" target="_blank">{{$item->nama}}</a>
            </div>
            @endforeach
            @endif
          
            {{-- <div class="col-lg-2 col-md-2 col-6 text-center">
                <img src="{{ asset('assets-front') }}/images/client/amazon.svg" class="avatar avatar-ex-sm" alt="">
        </div> --}}
        <!--end col-->
    </div>
    </div>
    <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->


@endsection
