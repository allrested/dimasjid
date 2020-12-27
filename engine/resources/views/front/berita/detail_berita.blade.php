@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title">{{ $berita->title }}</h4>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li><a href="{{url('/berita')}}" class="text-uppercase font-weight-bold text-dark">Berita</a>
                        </li>
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">{{ $berita->title }}</span>
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
            <!-- BLog Start -->
            <div class="col-lg-9">
                <div class="mr-lg-3">
                    <div class="blog position-relative overflow-hidden shadow rounded">
                        <div class="position-relative">
                            <img src="{{ asset('uploads') }}/berita/{{ $berita->image }}" class="w-100 rounded-top"
                                alt="">
                        </div>
                        <div class="content p-4">
                            <h6><i class="mdi mdi-tag text-primary mr-1"></i>{{ $berita->category }}</h6>
                            <p class="text-muted mt-3">{!! $berita->content !!}</p>
                            <div class="post-meta mt-3 text-muted">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item mr-2"><i
                                            class="mdi mdi-clock-outline mr-1"></i>{{ date('d-m-Y', strtotime($berita->created_at)) }}
                                    </li>
                                    <li class="list-inline-item"><i
                                            class="mdi mdi-account mr-1"></i>{{ $berita->user->name }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if ($comments->count() > 0)
                    <div class="p-4 shadow rounded mt-4 pt-2">
                        <h4 class="page-title pb-3">Komentar :</h4>
                        <ul class="media-list list-unstyled mb-0">
                            @foreach ($comments as $item)
                            <li class="comment-desk mt-4">                               
                                <div class="commentor">
                                    <a class="float-left pr-3" href="page-blog-detail.html#">
                                        <img src="{{asset('assets-back\img\dummy-pic.png')}}"
                                            class="img-fluid avatar avatar-md-sm rounded-pill shadow" alt="img">
                                    </a>
                                    <div class="overflow-hidden d-block">
                                        <h4 class="media-heading mb-0 text-dark">{{$item->full_name}}</h4>
                                        <small class="text-muted">{{$item->created_at->format('d M, Y')}} pada {{$item->created_at->format('H:i')}}</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted font-italic p-3 bg-light rounded">{{$item->content}}</p>
                                </div>
                            </li>
                            @endforeach   
                        </ul>
                    </div>
                    @endif
                   
                    @if(count($related) > 0)
                    <div class="mt-4 pt-2 p-4 shadow rounded">
                        <h4 class="page-title">Berita Terkait :</h4>

                        <div class="row">
                            @foreach ($related as $item)
                            <div class="col-lg-6 mt-4 pt-2">
                                <div class="blog position-relative overflow-hidden shadow rounded bg-light">
                                    <div class="position-relative">
                                        <img src="{{ asset('uploads') }}/berita/{{ $item->image }}"
                                            class="img-fluid rounded-top" alt="">
                                        <div class="overlay rounded-top bg-dark"></div>
                                    </div>
                                    <div class="content p-4">
                                        <h4><a href="{{ url('detail_berita', $item->slug) }}"
                                                class="title text-dark">{{ $item->title }}</a></h4>
                                        <div class="post-meta mt-3">
                                            <a href="url('detail_berita', $item->slug)"
                                                class="text-muted float-right readmore">Read
                                                More <i class="mdi mdi-chevron-right"></i></a>
                                            <ul class="list-unstyled mb-0 text-muted">
                                                <li class="list-inline-item mr-2"><i
                                                        class="mdi mdi-tag-outline mr-1"></i>{{ $item->category }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="author">
                                        <small class="text-light user d-block"><i class="mdi mdi-account"></i>
                                            {{ $item->user->name }}</small>
                                        <small class="text-light date"><i class="mdi mdi-calendar-check"></i>
                                            {{ date('d-m-Y', strtotime($berita->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    @endif
                    <div class="mt-4 pt-2 p-4 shadow rounded">
                        <h4 class="page-title pb-3">Tinggalkan Komentar :</h4>
                        <form method="post" action="{{url('add_comments')}}">
                            <div class="row">
                                @csrf
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Komentar Anda: </label>
                                            <i class="mdi mdi-comment-outline ml-3 icons"></i>
                                            <textarea id="message" placeholder="Masukan Komentar" rows="5" name="content"
                                                class="form-control pl-5" required=""></textarea>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <input type="hidden" value="{{$berita->id}}" name="id_berita">  
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Nama <span class="text-danger">*</span></label>
                                            <i class="mdi mdi-account ml-3 icons"></i>
                                            <input id="name" name="full_name" type="text" placeholder="Masukan Nama"
                                                class="form-control pl-5" required="">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Email Anda <span class="text-danger">*</span></label>
                                            <i class="mdi mdi-email ml-3 icons"></i>
                                            <input id="email" type="email" placeholder="Masukan Email / Kontak" name="email"
                                                class="form-control pl-5" required="">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                    <div class="col-md-12">
                                        <div class="send">
                                            <button type="submit" class="btn btn-primary w-100">Kirim Komentar</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        <!--end form-->
                    </div>
                </div>
            </div>
            <!-- BLog End -->

            <!-- START SIDEBAR -->
            <div class="col-lg-3 col-md-5 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="sidebar p-4 rounded shadow">
                   

                    <!-- RECENT POST -->
                    <div class="widget mb-4 pb-2">
                        <h4 class="widget-title">Berita Terbaru</h4>
                        <div class="mt-4">
                            @foreach ($terbaru as $item)
                            <div class="clearfix post-recent">
                                <div class="post-recent-thumb float-left"> <a
                                        href="{{ url('detail_berita', $item->slug) }}"> <img alt="img"
                                            src="{{ asset('uploads') }}/berita/{{ $item->image }}"
                                            class="img-fluid rounded"></a></div>
                                <div class="post-recent-content float-left"><a
                                        href="{{ url('detail_berita', $item->slug) }}">{{ $item->title }}</a> <span
                                        class="text-muted mt-2">{{ date('d M, Y', strtotime($berita->created_at)) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- RECENT POST -->

                    <!-- SOCIAL -->
                    <div class="widget">
                        <h4 class="widget-title">Ikuti Kami</h4>
                        <ul class="list-unstyled social-icon mt-4 mb-0">
                            <li class="list-inline-item"><a href="https://www.instagram.com/" class="rounded" target="_blank"><i
                                        class="mdi mdi-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="https://twitter.com/" target="_blank" class="rounded"><i
                                        class="mdi mdi-twitter"></i></a></li>
                        </ul>
                    </div>
                    <!-- SOCIAL -->
                </div>
            </div>
            <!--end col-->
            <!-- END SIDEBAR -->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Blog End -->

@endsection
