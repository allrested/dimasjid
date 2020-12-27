@extends('layouts.back.base')

@section('page_title','Pengumuman')

@section('content')

<!-- Header -->
<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Pengumuman</h1>
                <p>Manajemen Pengumuman</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="{{ route('announce.create') }}"><button class="btn btn-success pull-right"
                    type="button">Tambah</button></a>
        </div>
    </div>

</div><!-- end #content-header -->

<div id="main-content">
    <div class="main-table-card">
        <div class="main-t-table table-responsive">
            <table class="table display" id="data-table">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengumuman</th>
                    <th scope="col">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($announces as $announce)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="table-name">{{$announce->title}}</td>
                        <td>{{strip_tags(str_limit($announce->caption, $limit = 150, $end = '...'))}}
                        </td>
                        <td width="100px">
                            <a href="{{route('announce.edit',$announce->id)}}">
                                <button type="button" class="btn btn-warning"><i class="dripicons-pencil"></i></button>
                            </a>
                            <a href="{{route('announce.destroy',$announce)}}">
                                <button type="button" class="btn btn-danger btnDelete"><i
                                        class="dripicons-trash"></i></button>
                            </a>
                            <form action="{{route('announce.destroy',$announce)}}" method="post"
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
