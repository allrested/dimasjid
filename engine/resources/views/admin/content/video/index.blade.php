@extends('layouts.back.base')

@section('page_title','Video')

@section('content')
<!-- Header -->

<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Video</h1>
                <p>Manajemen Video</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="#addModal"><button class="btn btn-success pull-right" type="button" data-toggle="modal"
                    data-target="#addModal">Tambah
                    Video</button></a>
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
                        <th>Video</th>
                        <th>Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $item)
                    <tr>
                        <td width="200px" class="table-name"><iframe width="200px" height="auto" src="{{$item->link}}" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe></td>
                        <td class="table-name align-middle">{{$item->judul}}</td>
                        <td width="150px" class="align-middle">
                            <a href="#editModal">
                                <a href="#editModal" class="btn btn-warning" data-id="{{ $item->id }}"
                                    data-judul="{{ $item->judul }}" data-link="{{ $item->link }}" data-placement="top"
                                    title="Edit" data-toggle="modal" data-target="#editModal"><i
                                        class="dripicons-pencil"></i></a>
                            </a>
                            <a href="{{route('videos.destroy',$item)}}">
                                <button type="button" class="btn btn-danger btnDelete" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>
                            </a>
                            <form action="{{route('videos.destroy',$item)}}" method="post" class="formDelete d-none">
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
{{-- MODAL --}}
<div class="modal" tabindex="-1" role="dialog" id="addModal">
    <form action="{{ route('videos.store') }}" method="post">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleAdd">Tambah Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Judul<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="judul" id="judul" style="font-size:large"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Link Video<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="link" id="link" style="font-size:large"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal" tabindex="-1" role="dialog" id="editModal">
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleUpdate">Ubah Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Judul<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="judul" id="judul" style="font-size:large"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Link Video<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="link" id="link" style="font-size:large"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {

        $('#editModal').on('show.bs.modal', function (event) {
            var data = $(event.relatedTarget)
            var modal = $(this)
            modal.find('form').attr('action', 'videos/' + data.data('id'));
            modal.find('.modal-body #judul').val(data.data('judul'));
            modal.find('.modal-body #link').val(data.data('link'));
        })

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
