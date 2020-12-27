@extends('layouts.back.base')

@section('page_title','Komentar')

@section('content')

<!-- Header -->
<div id="content-header" class="mb-0">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Kotak Masuk</h1>
                <p>List Pesan</p>
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
                                <th scope="col">Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontak as $item)
                            <tr>
                                <td> {{$loop->iteration}}</td>
                                <td class="table-name">                                                                       
                                    <b>Nama Pengirim: {{ $item->nama }}</b><br>
                                    <em> Email Pengirim: {{ $item->email }}</em><br>
                                    <i>Waktu: {{ $item->created_at->format('d M Y H:i') }}</i>
                                    <hr style="border-top: dashed 1px;color:#ccc">
                                    <p>
                                        Komentar: <br>
                                        {{ $item->komentar }}
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
