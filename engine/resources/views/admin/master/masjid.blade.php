@extends('layouts.back.base')

@section('page_title','Master Data Masjid')
@push('custom_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#wilayah').select2({
                theme: "bootstrap",
                placeholder: 'Pilih Daerah',
                maximumSelectionSize: 6,
                containerCssClass: ':all:',
                "language": {
                    "noResults": function(){
                        return "Tidak Ditemukan";
                    }
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                ajax: {
                    url: '{{ url("admin/masjid-daerah") }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            $('#kode').val(item.kode);
                            return {
                                text: item.nama,
                                id: item.nama
                            }
                        })
                    };
                    },
                    cache: true
                }
                });
            
        });
    </script>
@endpush
@section('content')
<div id="content-header" class="mb-1">
    <div class="row">
        <div class="col-md-8">
            <div class="header-name">
                <h1 class="tour-step-one">Master Data masjid</h1>
                <p>Manajemen Data Masjid</p>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-success pull-right mt-3 btnAdd" type="button"><i class="fas fa-plus"></i> Tambah Masjid</button>
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
                            <th scope="col">Daerah</th>                 
                            <th scope="col">Nama Masjid</th>
                            <th scope="col">Alamat</th>                         
                            <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($masjid as $item)
                            <tr>
                                <td>{{$item->kode}}</td> 
                                <td>{{$item->wilayah}}</td>   
                                <td>{{$item->nama}}</td>                               
                                <td>
                                    @if (is_null($item->alamat))
                                        -
                                    @else
                                        {{$item->alamat}}
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
                                    <form action="{{route('masjid.destroy',$item->id)}}"
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
                    <h5 class="modal-title" id="titleUpdate">Tambah Masjid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('masjid.store')}}" id="frmAdd" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Masjid" id="nama"
                                        name="nama" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="wilayah">Daerah </label>
                                    <select class="custom-select" name="wilayah" id="wilayah">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kode">Identitas Unik</label>
                                    <input type="text" min="0" class="form-control" placeholder="ID Masjid" id="kode"
                                        name="kode" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Alamat</label>
                                    <input type="text" class="form-control" placeholder="Alamat" id="alamat"
                                        name="alamat" required>
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Jika alamat tidak diketahui, beri tanda strip (-) pada inputan.
                                        </small>
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
            $('#frmAdd').attr('action',"{{route('masjid.store')}}");
            $('#frmAdd').append('<div id="method"></div>');
            $('#method').html('{{ method_field("POST") }}');
            $('#titleUpdate').html("Tambah Masjid");
            $('#nama').val('');
            $('#kode').val('');
            $('#wilayah').val(null).trigger('change');
            $('#alamat').val('');
            $('#createLaporanModal').modal('show');
        });
        $('.btnEdit').on('click', function (e) {
            var id = $(this).data('id');
                $('#frmAdd').attr('action','{{ url("admin/masjid") }}/'+id);
                $('#frmAdd').append('<div id="method"></div>');
                $('#method').html('{{ method_field("PATCH") }}');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/masjid') }}/"+id,
                    success: function (response) {
                        $('#nama').val(response.nama);
                        $('#kode').val(response.kode);
                        var newOption = new Option(response.wilayah, response.wilayah, true, true);
                        $('#wilayah').append(newOption).trigger('change');
                        $('#alamat').val(response.alamat);
                    }
                });
                $('#titleUpdate').html("Edit Masjid");
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
