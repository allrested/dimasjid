@extends('layouts.back.base')

@section('page_title','Banner')

@section('content')
<!-- Header -->

<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Banner</h1>
                <p>Manajemen Banner</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="{{url('admin/banner/create')}}"><button class="btn btn-success pull-right" type="button">Tambah
                    Banner</button></a>
        </div>
    </div>

</div><!-- end #content-header -->

<div id="main-content">
    <div class="main-table-card">
        <div class="main-t-table table-responsive">
            <table class="table display" id="data-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Judul</th>
                        <th>SubJudul</th>
                        <th>Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td><img src="{{ asset('uploads') }}/banner/{{ $banner->image }}" alt="" width="100px">
                        </td>
                        <td class="table-name">{{$banner->title}}</td>
                        <td class="table-name">{{$banner->caption}}</td>
                        <td class="table-status active">{{ $banner->status == 1 ? 'Aktif' : 'Non Aktif'}}</td>
                        <td width="100px">
                            <a href="{{route('banner.edit',$banner->id)}}">
                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top"
                                    title="Edit"><i class="dripicons-pencil"></i></button>
                            </a>
                            <a href="{{route('banner.destroy',$banner)}}">
                                <button type="button" class="btn btn-danger btnDelete" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>
                            </a>
                            <form action="{{route('banner.destroy',$banner)}}" method="post" class="formDelete d-none">
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
@push('custom-scripts')
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


@endpush
@endsection
