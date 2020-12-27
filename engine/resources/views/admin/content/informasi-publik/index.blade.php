@extends('layouts.back.base')

@section('page_title','Informasi Publik')
@section('content')
<div id="content-header" class="mb-1">
    <div class="row">
        <div class="col-md-8">
            <div class="header-name">
                <h1 class="tour-step-one">Informasi Publik</h1>
                <p>Manajemen Informasi Publik</p>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-success pull-right mt-3" type="button" data-toggle="modal"
                data-target="#createLaporanModal"><i class="fas fa-plus"></i> Tambah Informasi Publik</button>
        </div>
    </div>
</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content" class="mt-3">
    <div class="card-box pr-0 pl-0">
        <div class="card-body">
            <div class="main-table-card col-md-12 m-b-30">
                <div class="main-t-table table-responsive">
                    <table class="table display" id="data-table">
                        <thead>
                            <th scope="col">No</th>                            
                            <th scope="col">File</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>                            
                            <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($informasi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                
                                <td><a target="_blank" href="{{asset('uploads/informasi_publik').'/'.$item->file}}">{{$item->file}}</a></td>
                                <td>{{$item->judul}}</td>                                
                                <td>
                                    @if (is_null($item->deskripsi))
                                        -
                                    @else
                                        {{$item->deskripsi}}
                                    @endif                                    
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger btnDelete" data-toggle="tooltip"
                                        data-placement="top" title="Delete" data-id="{{$item->id}}"><i
                                            class="dripicons-trash"></i></button>
                                    </a>
                                    <form action="{{route('informasi-publik.destroy',$item->id)}}"
                                        method="post" class="d-none" id="formDelete-{{$item->id}}">
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="createLaporanModal">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleUpdate">Tambah Informasi Publik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('informasi-publik.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Judul Informasi</label>
                                    <input type="text" class="form-control" placeholder="Judul Informasi Publik" id="nama"
                                        name="judul" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Deskripsi</label>
                                    <input type="text" class="form-control" placeholder="Deskripsi" id="nama"
                                        name="deskripsi" required>
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Jika tidak terdapat keterangan, beri tanda strip (-) pada inputan.
                                        </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kecamatan">Upload File</label>
                                    <input type="file" class="form-control dropify" placeholder="Upload File" id="file"
                                        name="file">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right" type="submit">Simpan</button>
                </div>
                </form>
            </div>
        </div><!-- end #main-content -->
    </div>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('.btnDelete').on('click', function (e) {
            var id = $(this).data('id');
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
                    $("#formDelete-" + id).submit();
                }
            })
        });
    });

</script>
@endsection
