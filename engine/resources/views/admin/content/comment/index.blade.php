@extends('layouts.back.base')

@section('page_title','Komentar')

@section('content')

<!-- Header -->
<div id="content-header" class="mb-0">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Komentar</h1>
                <p>List Komentar</p>
            </div>
        </div>
    </div>

</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content" class="mt-3" >
    <div class="card-box" >
        <div class="card-body">
            <div class="main-table-card col-md-12 m-b-30">
                <div class="main-t-table table-responsive">
                    <table class="table display" id="data-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Komentar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $item)
                            <tr>
                                <td> {{$loop->iteration}}</td>
                                <td class="table-name">
                                    <h5 class="m-0">Judul Berita: {{ $item->berita()->first()->title}}</h5>
                                    <hr style="border-top: dashed 1px;color:#ccc">
                                    <b>Nama Pengirim: {{ $item->full_name }}</b><br>
                                    <em> Email Pengirim: {{ $item->email }}</em><br>
                                    <i>Waktu: {{ $item->created_at->format('d M Y H:i') }}</i>
                                    <hr style="border-top: dashed 1px;color:#ccc">
                                    <p>
                                        Komentar: <br>
                                        {{ $item->content }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div><!-- end #main-content -->

@endsection
