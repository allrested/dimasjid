@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> Tugas Pokok dan Fungsi DPU Kota Bandung</h4>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li><a href="#" class="text-uppercase font-weight-bold text-dark">Profile</a></li> 
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Tugas Pokok dan Fungsi</span> 
                        </li> 
                    </ul>
                </div>
            </div>  <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->

<!-- tupoksi Start -->
<section class="section">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Tugas DPU Kota Bandung </h4>
                    <p class="text-muted para-desc mx-auto mb-0">Berupaya semaksimal mungkin untuk memberikan layanan kepada masyarakat Kota Bandung.</p>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                @foreach ($tugas as $item)
                <div class="key-feature d-flex p-3 rounded shadow bg-white mb-4">
                    <div class="icon text-center rounded-pill mr-3 btn-primary "> {{$loop->iteration}} </div>
                    <div class="content mt-2 ">
                        <h4 class="title mb-0 ">{{$item->data}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>

    <div class="container mt-100">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Fungsi DPU Kota Bandung </h4>
                    <p class="text-muted para-desc mx-auto mb-0">Berupaya semaksimal mungkin untuk memberikan layanan kepada masyarakat Kota Bandung.</p>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                @foreach ($fungsi as $item)
                <div class="key-feature d-flex p-3 rounded shadow bg-white mb-4">
                    <div class="icon text-center rounded-pill mr-3 btn-primary ">{{$loop->iteration}} </div>
                    <div class="content mt-2 ">
                        <h4 class="title mb-0 ">{{$item->data}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->

@endsection
