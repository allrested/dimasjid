@extends('layouts.back.base')

@section('page_title')
{{@$agenda ? 'Edit Agenda' : 'Buat Agenda'}}
@endsection
@push('custom_script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
    $(document).ready(function () {
        $('.summernote').summernote({
            placeholder: 'Masukan Penjelasan Agenda',
            height: 300
        });
    });
    </script>
@endpush

@section('content')
<div id="content-header">
    <div class="header-name">
         <h2 class="tour-step-one"><span>{{@$agenda ? 'Edit Agenda' : 'Buat Agenda'}}</span></h2>
        <p><a>Dashboard</a> / <a> Agenda </a> / {{@$agenda ? 'Edit Agenda' : 'Buat Agenda'}}</p>
    </div>
</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div style="margin-top:-40px" class="card">
                <form method="POST" action="{{@$agenda ? route('agenda.update',$agenda) : route('agenda.store') }}"  enctype="multipart/form-data">
                    @csrf
                     {{ @$agenda ? method_field('PUT') : '' }}
                    <div class="card-body" style="padding-bottom:20px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-b-15">
                                    <label for="simpleinput">Judul</label>
                                <input type="text" id="simpleinput" class="form-control" name="title" value="{{@$agenda->title}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Mulai</label>
                                            <input type='date' class="form-control" name="tanggal" value="{{ @$agenda ? date('Y-m-d', strtotime(@$agenda->time_start)) : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Selesai</label>
                                            <input type='date' class="form-control" name="tanggal_end" value="{{ @$agenda ? date('Y-m-d', strtotime(@$agenda->time_end)) : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Waktu Mulai</label>
                                            <input type='time' class="form-control" name="jam" value="{{ @$agenda ? date('H:i', strtotime(@$agenda->time_start)) : date('H:i', strtotime('08:00')) }}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Waktu selesai</label>
                                            <input type='time' class="form-control" name="jam_end" value="{{ @$agenda ? date('H:i', strtotime(@$agenda->time_end)) : date('H:i', strtotime('08:00')) }}"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Upload Gambar Banner</label>
                                    <input type="file" class="form-control" name="banner_img" accept="image/*" value="{{@$agenda->banner_img}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Lokasi</label>
                                    <input type="text" id="simpleinput" class="form-control" name="location" value="{{@$agenda->location}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom:30px">
                                <div class="form-group m-b-15">
                                    <label for="simpleinput">Penjelasan Agenda</label>
                                    <textarea class="summernote form-control"
                                        name="content">{{@$agenda->content}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>         
                    <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary pull-right" style="padding:10px;">{{@$agenda ? 'Edit' : 'Buat'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
