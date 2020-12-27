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
                        <div class="view-project-info col-md-12">
                            <img src="{{asset('assets-front')}}/images/logo.png" alt="Logo" class="mt-4">
                            <div class="view-project-details">
                                <p class="view-project-name">SISTAMAS</p>
                                <p class="view-project-desc" style="text-align:justify">SISTAMAS
                                    adalah aplikasi akuntansi masjid
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row view-project-info-footer palaner-tr">
                        <div class="col-md-6">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-calendar"></i></div>
                                <p class="planner-tr-desc">Total Agenda <span>{{ $c_agenda }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="planner-tr-item">
                                <div class="planner-tr-icon"><i class="dripicons-article"></i></div>
                                <p class="planner-tr-desc">Total Berita <span>{{ $c_berita }}</span></p>
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
    </div>
</div><!-- end #main-content -->
@endsection
