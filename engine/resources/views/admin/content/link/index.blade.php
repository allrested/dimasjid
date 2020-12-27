@extends('layouts.back.base')

@section('page_title','Link Terkait')

@section('content')
<!-- Header -->

<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Link Terkait</h1>
                <p>Manajemen Link Terkait</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="#addModal"><button class="btn btn-success pull-right" type="button" data-toggle="modal"
                    data-target="#addModal">Tambah
                    Link Terkait</button></a>
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
                        <th>Link</th>
                        <th>Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($links as $item)
                    <tr>
                        <td class="table-name"><a href="{{$item->link}}">{{$item->link}}</a></td>
                        <td class="table-name align-middle">{{$item->nama}}</td>
                        <td width="150px">
                            <a href="#editModal">
                                <a href="#editModal" class="btn btn-warning" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}" data-link="{{ $item->link }}" data-placement="top"
                                    title="Edit" data-toggle="modal" data-target="#editModal"><i
                                        class="dripicons-pencil"></i></a>
                            </a>
                            <a href="{{route('links.destroy',$item)}}">
                                <button type="button" class="btn btn-danger btnDelete" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="dripicons-trash"></i></button>
                            </a>
                            <form action="{{route('links.destroy',$item)}}" method="post" class="formDelete d-none">
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
    <form action="{{ route('links.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleAdd">Tambah Link Terkait</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Judul<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="nama" id="nama" style="font-size:large"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Link<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="link" id="link" style="font-size:large"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-textarea">Icon Link Terkait</label>
                                <div class="input-group">
                                    <input type="file" class="file" id="file_tambah" accept="image/*" name="image"
                                        value="{{@$banner->image}}">
                                    <input type="text" class="form-control" disabled placeholder="Nama File" id="file"
                                        name="gambar_banner" value="{{@$banner->image}}">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary" data-file="file_tambah">Pilih Gambar</button>
                                    </div>
                                </div>
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
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleUpdate">Ubah Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Judul<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="nama" id="nama" style="font-size:large"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Link<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="link" id="link" style="font-size:large"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-textarea">Icon Link Terkait</label>
                                <div class="input-group">
                                    <input type="file" class="file" accept="image/*" name="image" id="image_icon">                                    
                                    <input type="text" class="form-control" disabled placeholder="Nama File" id="file"
                                        name="gambar_banner" id="text_icon">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary" data-file="image_icon">Pilih Gambar</button>
                                    </div>
                                </div>
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
        $(document).on("click", ".browse", function () {
            var nama_file = $(this).data('file')
            $("#"+nama_file).click()
        });
        $('input[type="file"]').change(function (e) {            
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);                        
        });
        $('#editModal').on('show.bs.modal', function (event) {
            var data = $(event.relatedTarget)
            var modal = $(this)
            modal.find('form').attr('action', 'links/' + data.data('id'));
            modal.find('.modal-body #nama').val(data.data('nama'));
            modal.find('.modal-body #link').val(data.data('link'));
            modal.find('.modal-body #image_icon').val(data.data('icon'));
            modal.find('.modal-body #text_icon').val(data.data('icon'));
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