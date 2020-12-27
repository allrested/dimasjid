@extends('layouts.back.base')

@section('page_title')
{{@$berita ? 'Edit Berita' : 'Buat Berita'}}
@endsection

@section('content')

<div id="content-header">
    <h2 class="tour-step-one"><span>{{@$berita ? 'Edit Berita' : 'Buat Berita'}}</span></h2>
    <p><a>Dashboard</a> / <a> Berita </a> / {{@$berita ? 'Edit Berita' : 'Buat Berita'}}</p>
</div>

@include('include.alert')
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div style="margin-top:-40px" class="card">
                <form action="{{@$berita ? route('berita.update',$berita->id): route('berita.store')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{ @$berita ? method_field('PUT') : '' }}
                    <div class="card-body" style="padding-bottom:20px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-textarea">Gambar Header</label>
                                    <div class="input-group">
                                        <input type="file" class="file" accept="image/*" name="image"
                                            value="{{@$berita->image}}">
                                        <input type="text" class="form-control" disabled placeholder="Nama File"
                                            id="file" name="image" value="{{@$berita->image}}">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Pilih Gambar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if (isset($berita))
                                <img src="{{asset('assets-front')}}/images/header_berita/{{@$berita->image}}" alt=""
                                    id="preview" class="img-fluid">
                                @else
                                <div class="preview-image">
                                    <h5 center>Pratinjau Gambar</h5>
                                </div>
                                <img src="" alt="" id="preview" class="img-fluid">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-b-15">
                                    <label>
                                        Judul Berita
                                    </label>
                                    <input type="text" id="simpleinput" class="form-control form-control-lg"
                                        placeholder="Masukan Judul" name="title" value="{{@$berita->title}}">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="summernote form-control"
                                        name="content">{{@$berita->content}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kategori</label>
                                    <select class="form-control" id="category" name="category">
                                        @foreach ($category as $cat)
                                            <option value="{{$cat}}" {{@$berita->category == $cat ? 'selected' : ''}}>
                                                {{$cat}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (auth()->user()->role == 1)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Penulis</label>
                                    <select class="form-control" id="id_user" name="id_user" required>
                                        @if (isset($berita))
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}"
                                                    {{$berita->id_user == $user->id ? 'selected' : ''}}>
                                                    {{$user->name}}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}"
                                                    {{$user->role == auth()->user()->role? 'selected' : ''}}>
                                                    {{$user->name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        @if (@$berita->status == "pending")
                        <a href="{{route('berita.approve',$berita->id)}}"><button
                                class="btn btn-success pull-right btnSetuju" style="padding:10px;">Setujui</button></a>
                        @endif
                        <button type="submit" class="btn btn-primary pull-right"
                            style="padding:10px;"><b>{{@$berita ? 'Edit' : 'Tambah'}}</b></button>
                    </div>
                </form>

                @if (@$berita->status == "pending")
                <form action="{{route('berita.approve',$berita->id)}}" method="POST" class="formDelete d-none">
                    @csrf
                    @method('PATCH')
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            placeholder: 'Masukan Isi Berita',
            height: 300
        });
    });
    $('.btnSetuju').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent();

            swal({
                    title: "Apa anda yakin?",
                    text: "Berita akan diterbitkan di halaman utama",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then(function (willDelete) {
                    if (willDelete) {
                        $(".formDelete").submit();
                    }
                });
        });

    $(document).on("click", ".browse", function () {
        $(".file").click()
    });
    $('input[type="file"]').change(function (e) {
        $('.preview-image').remove();
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

</script>

@endsection
