@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> Tujuan dan Sasaran </h4>
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

<!-- Tujuan dan Sasaran Start -->
<section class="section">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-title text-center">
                <h4 class="title mb-4"> Tujuan dan Sasaran DPU Kota Bandung</h4>
                <p class="text-muted"><span class="text-primary font-weight-bold">{{$headline->data}}</span>
                </p>
            </div>
            <div class="text-justify mt-5">
                <p>
                  {!! $isi->data !!}
                </p>
            </div>
        </div>
    </div>

</section>
<!--end section-->

@endsection
