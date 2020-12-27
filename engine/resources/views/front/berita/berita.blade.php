@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title mb-4"> Berita </h4>
                    <p class="text-muted"> Informasi berita terbaru Masjid
                    </p>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Berita</span>
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
<section class="section">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-12 mb-4">
                <div class="section-title text-center">
                    <h4 class="title mb-4"> Berita </h4>
                    <p class="text-muted"> Informasi berita terbaru Masjid
                    </p>
                </div>
            </div> --}}
            @foreach ($beritas as $item)
            <div class="col-lg-4 col-md-6 mb-4 pb-2">
                <div class="blog position-relative overflow-hidden shadow rounded">
                    <div class="position-relative">
                        <img src="{{ asset('uploads') }}/berita/{{ $item->image }}" class="img-fluid rounded-top"
                            alt="">
                        <div class="overlay rounded-top bg-dark"></div>
                    </div>
                    <div class="content p-4">
                        <h4><a href="{{ url('detail_berita', $item->slug) }}" class="title text-dark">{{ $item->title }}</a></h4>
                        <div class="post-meta mt-3">
                            <a href="{{ url('detail_berita', $item->slug) }}" class="text-muted float-right readmore">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item mr-2"><i class="mdi mdi-tag-outline mr-1"></i>{{ $item->category }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="author">
                        <small class="text-light user d-block"><i class="mdi mdi-account"></i> {{ $item->user->name }}</small>
                        <small class="text-light date"><i class="mdi mdi-calendar-check"></i> {{ date('d-m-Y', strtotime($item->created_at)) }}</small>
                    </div>
                </div>
            </div>
            <!--end col-->
            @endforeach
            <!-- PAGINATION START -->
            <div class="col-12">
                <ul class="pagination justify-content-center mb-0 list-unstyled">
                    {{ $beritas->links() }}
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
