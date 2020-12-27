@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                         <h4 class="title mb-4"> Stuktur Organisasi DPU Kota Bandung</h4>
                     <p class="text-muted"><span class="text-primary font-weight-bold">Terwujudnya Kota Bandung yang
                        Unggul, Nyaman, Sejahtera dan Agamis.</span>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li><a href="#" class="text-uppercase font-weight-bold text-dark">Profile</a></li> 
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Tujuan dan Sasaran</span> 
                        </li> 
                    </ul>
                </div>
            </div>  <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->

<!-- Stuktur Organisasi Start -->
<section class="section">
    <div class="container">
        {{-- <div class="col-lg-12">
            <div class="section-title text-center">
                <h4 class="title mb-4"> Stuktur Organisasi DPU Kota Bandung</h4>
                <p class="text-muted"><span class="text-primary font-weight-bold">Terwujudnya Kota Bandung yang
                        Unggul, Nyaman, Sejahtera dan Agamis.</span>
                </p>
            </div>
        </div> --}}
        <div class="row justify-content-center">
            @foreach ($pimpinan as $item)
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        @if ($item->foto == '-')
                            <img src="{{ asset('assets-front') }}/images/client/dummy-profile.png" class="img-fluid avatar avatar-ex-large rounded-pill shadow" alt="">
                        @else
                            <img src="{{asset('uploads/struktur-organisasi/')}}/{{$item->foto}}" class="img-fluid avatar avatar-ex-large rounded-pill shadow" alt="">
                        @endif
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="#" class="name text-dark">{{$item->nama}}</a></h5>
                        <small class="designation text-muted">{{$item->jabatan}}</small>
                    </div>
                </div>
            </div><!--end col-->

            @endforeach
        </div>
        <div class="row">            
            @foreach ($jajaran as $item)
            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        @if ($item->foto == '-')
                            <img src="{{ asset('assets-front') }}/images/client/dummy-profile.png" class="img-fluid avatar avatar-ex-large rounded-pill shadow" alt="">
                        @else
                            <img src="{{asset('uploads/struktur-organisasi/')}}/{{$item->foto}}" class="img-fluid avatar avatar-ex-large rounded-pill shadow" alt="">
                        @endif  
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">{{$item->nama}}</a></h5>
                        <small class="designation text-muted">{{$item->jabatan}}</small>
                    </div>
                </div>
            </div><!--end col-->
            @endforeach   
        </div><!--end row-->
    </div>

</section>
<!--end section-->

@endsection
