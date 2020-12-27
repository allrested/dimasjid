@extends('layouts.back.base')

@section('page_title','Master Akun')
@section('content')
<div id="content-header" class="mb-1">
    <div class="row">
        <div class="col-md-8">
            <div class="header-name">
                <h1 class="tour-step-one">Master Akun</h1>
                <p>Manajemen Akun Rekening</p>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-success pull-right mt-3 btnAdd" type="button"><i class="fas fa-plus"></i> Tambah Rekening</button>
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
                            <th scope="col">Kode</th>                            
                            <th scope="col">Nama Rekening</th>
                            <th scope="col">Keterangan</th>                         
                            <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($akun as $item)
                            <tr>
                                <td>{{$item->kode}}</td> 
                                <td>{{$item->nama}}</td>                               
                                <td>
                                    @if (is_null($item->deskripsi))
                                        -
                                    @else
                                        {{$item->deskripsi}}
                                    @endif                                    
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btnEdit" title="Edit" data-id="{{$item->id}}"><i
                                            class="dripicons-pencil"></i></button>
                                    </a>
                                    <a href="#" class="btn btn-danger btnDelete" data-toggle="tooltip"
                                        data-placement="top" title="Delete" data-id="{{$item->id}}"><i
                                            class="dripicons-trash"></i></button>
                                    </a>
                                    <form action="{{route('akun.destroy',$item->id)}}"
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
                    <h5 class="modal-title" id="titleUpdate">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('akun.store')}}" id="frmAdd" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Rekening" id="nama"
                                        name="nama" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="number" min="0" class="form-control" placeholder="Kode Rekening" id="kode"
                                        name="kode" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Deskripsi" id="deskripsi"
                                        name="deskripsi">
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Jika tidak terdapat deskripsi, kosongkan inputan.
                                        </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="parent">Parent </label>
                                    <select class="custom-select" name="parent" id="parent">
                                        <option value = "0" selected="selected">...Pilih Parent...</option>
                                        @foreach ($akun as $akun)
                                            <option value="{{$akun->id}}">{{$akun->kode . " - " .$akun->nama}}</option>  
                                        @endforeach
                                    </select>
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

        $('.btnAdd').on('click', function (e) {
            $('#frmAdd').attr('action',"{{route('akun.store')}}");
            $('#frmAdd').append('<div id="method"></div>');
            $('#method').html('{{ method_field("POST") }}');
            $('#titleUpdate').html("Tambah Akun");
            $('#nama').val('');
            $('#kode').val('');
            $('#deskripsi').val('');
            $('#parent').val(0);
            $('#createLaporanModal').modal('show');
        });
        $('.btnEdit').on('click', function (e) {
            var id = $(this).data('id');
                $('#frmAdd').attr('action','{{ url("admin/akun") }}/'+id);
                $('#frmAdd').append('<div id="method"></div>');
                $('#method').html('{{ method_field("PATCH") }}');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/akun') }}/"+id,
                    success: function (response) {
                        $('#nama').val(response.nama);
                        $('#kode').val(response.kode_dasar);
                        $('#deskripsi').val(response.deskripsi);
                        $('#parent').val(response.parent);
                    }
                });
                $('#titleUpdate').html("Edit Akun");
                $('#createLaporanModal').modal('show');
        });

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
