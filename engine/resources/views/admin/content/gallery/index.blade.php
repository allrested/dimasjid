@extends('layouts.back.base')

@section('page_title','Gallery')

@section('content')
<!-- Header -->
<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Gallery</h1>
                <p>Manajemen Gallery</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <a href="{{ url('admin/gallery/create')}}"><button class="btn btn-success pull-right" type="button">Tambah
                    Gallery</button></a>
            <a hidden href="{{ route('album.index') }}"><button class="btn btn-dark pull-right"
                    type="button">Kembali</button></a>
        </div>
    </div>
</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content">
    <div class="main-table-card col-md-12 m-b-30">
        <div class="main-t-table table-responsive">
            <table class="table display" id="data-table">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="table-name">
                            <img src="{{ asset('uploads/gallery') }}/{{ $gallery->image ?? 'no-image.png' }}" alt=""
                                style="max-width:25%">
                        </td>
                        <td class="table-name">{{$gallery->title}}</td>
                        <td width="300px">
                            <a href="{{route('gallery.edit',$gallery->id)}}">
                                <button type="button" class="btn btn-warning"><i class="dripicons-pencil"></i></button>
                            </a>
                            <a href="{{route('gallery.destroy',$gallery)}}">
                                <button type="button" class="btn btn-danger btnDelete" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>
                            </a>
                            <form action="{{route('gallery.destroy',$gallery)}}" method="post"
                                class="formDelete d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- end #main-content -->
<script>
    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $('.btnDelete').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent();

          Swal.fire({
                title: 'Apa anda yakin?',
                text: "Data akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $(".formDelete").submit();
                    Swal.fire(
                        'Berhasil!',
                        'Data telah dihapus',
                        'success'
                    )
                }
            })
        });
    });

</script>
@endsection
