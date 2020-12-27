@extends('layouts.back.base')

@section('page_title','Berita')

@section('content')

<!-- Header -->
<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Berita</h1>
                <p>Manajemen berita</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="{{url('admin/berita/create')}}"><button class="btn btn-success pull-right" type="button">Buat
                    Berita</button></a>
        </div>
    </div>

</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content">

    <div class="main-table-card col-md-12 m-b-30">
        <div class="main-t-table table-responsive">
            <table class="table display" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">Gambar Header</th>
                        <th scope="col">Judul Berita</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th width="130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beritas as $berita)
                    <tr>
                        <td class="table-name"><img class="" src="{{ asset('uploads') }}/berita/{{ $berita->image }}"
                                width="100px"></td>
                        <td class="table-name">{{$berita->title}}</td>
                        <td class="table-amount">{{$berita->created_at->format('d M, Y')}}</td>
                        <td class="table-status"> {{ $berita->status == 1 ? 'Aktif' : 'Pending'}}
                        </td>
                        <td>
                            <a href="{{route('berita.edit',$berita->id)}}">
                                <button type="button" class="btn btn-warning"><i class="dripicons-pencil"></i></button>
                            </a>
                            <a href="{{route('berita.destroy',$berita)}}">
                                <button type="button" class="btn btn-danger btnDelete"><i
                                        class="dripicons-trash"></i></button>
                            </a>
                            <form action="{{route('berita.destroy',$berita)}}" method="POST" class="formDelete d-none">
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
