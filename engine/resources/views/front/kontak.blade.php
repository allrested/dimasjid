@extends('layouts.front.base')

@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> Kontak Kami </h4>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Kontak Kami</span> 
                        </li> 
                    </ul>
                </div>
            </div>  <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->


<!-- Start Contact -->
<section class="section">
    <div class="container">
        @include('include.alert')
        <div class="row">
            <div class="col-lg-4 col-md-6  mt-4 pt-2">
                <div class="pt-5 pb-5 p-4 bg-white rounded shadow">
                    <h4>Hubungi Kami</h4>
                    <div class="custom-form mt-4">
                        <div id="message"></div>
                        <form method="POST" action="{{route('kontak_kami.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <label>Nama Anda <span class="text-danger">*</span></label>
                                        <i class="mdi mdi-account ml-3 icons"></i>
                                        <input name="nama" id="name" type="text" class="form-control pl-5" placeholder="Nama Anda " required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <label>Email Anda <span class="text-danger">*</span></label>
                                        <i class="mdi mdi-email ml-3 icons"></i>
                                        <input name="email" id="email" type="email" class="form-control pl-5" placeholder="Email Anda " required>
                                    </div> 
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <label>Komentar</label>
                                        <i class="mdi mdi-comment-text-outline ml-3 icons"></i>
                                        <textarea name="komentar" id="comments" rows="4" class="form-control pl-5" placeholder="Pesan Anda " required></textarea>
                                    </div>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" id="submit" class="submitBnt btn btn-primary btn-block" value="Send Message">                                    
                                </div><!--end col-->
                            </div><!--end row-->
                        </form><!--end form-->
                    </div><!--end custom-form-->
                </div>
            </div><!--end col-->

            <div class="col-lg-8 col-md-6 pl-md-3 pr-md-3 mt-4 pt-2">
                <div class="map map-height-two rounded map-gray">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d75363.69880844012!2d107.59833380323393!3d-6.912530234988699!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C+Bandung+City%2C+West+Java!5e0!3m2!1sen!2sid!4v1565311436216!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    
    <div class="container mt-100 mt-60">
        <div class="row">
            <div class="col-md-4">
                <div class="contact-detail text-center">
                    <div class="icon">
                        <img src="{{asset('assets-front/images/icon/bitcoin.svg')}}" class="avatar avatar-small" alt="">
                    </div>
                    <div class="content mt-3">
                        <h4 class="title font-weight-bold">Telepon</h4>
                        <p class="text-muted"> Hubungi Kami<br><br></p>
                        <a href=#" class="text-primary">085722271448</a>
                    </div>  
                </div>
            </div><!--end col-->
            
            <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="contact-detail text-center">
                    <div class="icon">
                        <img src="{{asset('assets-front/images/icon/Email.svg')}}" class="avatar avatar-small" alt="">
                    </div>
                    <div class="content mt-3">
                        <h4 class="title font-weight-bold">Email</h4>
                        <p class="text-muted">Hubungi Kami Melalui Email<br><br></p>
                        <a href="mailto:hello@buidlme.id" class="text-primary">hello@buidlme.id</a>
                    </div>  
                </div>
            </div><!--end col-->
            
            <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="contact-detail text-center">
                    <div class="icon">
                        <img src="{{asset('assets-front/images/icon/location.svg')}}" class="avatar avatar-small" alt="">
                    </div>
                    <div class="content mt-3">
                        <h4 class="title font-weight-bold">Alamat</h4>
                        <p class="text-muted">Bandung </p>
                        <a href="https://goo.gl/maps/kGi4htj3uKjG1EaSA" class="video-play-icon h6 text-primary">View on Google map</a>
                    </div>  
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End contact -->

@endsection
