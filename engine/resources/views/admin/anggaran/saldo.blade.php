@extends('layouts.back.base')

@section('page_title','Saldo Awal')
@push('custom_script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <script src="{{ asset('assets-back') }}/js/jquery.mask.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/terbilang.js"></script>
    <script type="text/javascript">
        function inputTerbilang() {
            //membuat inputan otomatis jadi mata uang
            $('.mata-uang').mask('000.000.000.000.000', {reverse: true});

            //mengambil data uang yang akan dirubah jadi terbilang
            var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
            document.getElementById("jumlah").value = input;

            //menampilkan hasil dari terbilang
            document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
        } 
    </script>
@endpush
@section('content')
<div id="content-header" class="mb-1">
    <div class="row">
        <div class="col-md-8">
            <div class="header-name">
                <h1 class="tour-step-one">Saldo Awal</h1>
                <p>Manajemen Saldo Awal</p>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-success pull-right mt-3 btnAdd" type="button"><i class="fas fa-plus"></i> Tambah Saldo Awal</button>
        </div>
    </div>
</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content" class="mt-3">
    <div class="card-box pr-0 pl-0">
        <div class="card-body">
            <div class="main-table-card col-md-12 m-b-30">
            <form action="{{ route('anggaran.saldo.neraca') }}" id="frmFilter" method="post">
                    @csrf
                    <input type="hidden" name="is_pdf" value="0" id="is_pdf">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select id="tahun" class="pilihan form-control" name="tahun">
                                    <option value="">Semua Data</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <a href="#" class="btn btn-info btn-icon icon-left btnFilter" style="margin-top:24px">
                                <i class="entypo-search"></i>
                                Filter
                            </a>
                        </div>
                        <div class="col-md-1">
                                <button type="submit" class="btn btn-secondary buttons-excel buttons-html5 mb-3"  style="margin-top:24px"><span>Excel</span></button>
                        </div>
                        <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-pdf buttons-html5 mb-3"  style="margin-top:24px"><span>PDF</span></button>
                        </div>
                    </div>
                </form>
                <div class="main-t-table table-responsive">
                    <table class="table display" id="ajax-table">
                        <thead>
                            <th scope="col">Tanggal</th> 
                            <th scope="col">Kode Rekening</th>                            
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>                         
                            <th scope="col">Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" role="dialog" id="createLaporanModal">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleUpdate">Tambah Saldo Awal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('anggaran.saldo.store')}}" id="frmAdd" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Tanggal</label>
                                    <input id="created_at" class="form-control datepicker" type="text" 
                                        name="created_at" value="" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="masjid">Pilih Masjid</label>
                                    <select name="masjid" class="form-control select2">
                                        @foreach ($masjid as $item)
                                            <option value="{{ $item->id }}" {{ @$user->is_superuser == $item->id ? 'selected' : ''}}>{{ $item->wilayah.' - '.$item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Kode Rekening</label>
                                    <select class="pilihan" name="account" id="account">
                                        @foreach ($akun as $akun)
                                            <option value="{{$akun->id}}">{{$akun->kode . " - " .$akun->nama}}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="hidden" id="jumlah" name="jumlah">
                                    <input type="text" id="terbilang-input" class="form-control mata-uang" 
                                    onkeyup="inputTerbilang();" required>
                                    <input type="text" id="terbilang-output" class="form-control mata-uang" 
                                    readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Deskripsi" id="deskripsi"
                                        name="deskripsi" required>
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                        Jika tidak terdapat keterangan, beri tanda strip (-) pada inputan.
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
        initDatatable();
        $('.pilihan').select2({
            theme: "bootstrap",
            maximumSelectionSize: 6,
            containerCssClass: ':all:',
            "language": {
                "noResults": function(){
                    return "Tidak Ditemukan";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        $('.datepicker').daterangepicker({
            autoUpdateInput: true,
            autoApply: true,
            timePicker: true,
            timePicker24Hour: true,
            locale: { format: "YYYY-MM-DD HH:mm:ss" },
            singleDatePicker: true
        });

        function initDatatable(){
            var formData = $('#frmFilter').serializeArray();
            var data = { };
            $.each(formData, function() {
                data[this.name] = this.value;
            });
            
            $('#ajax-table').DataTable().clear().destroy();
            myTable = $('#ajax-table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                        "headers" : {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        "url": "{{ url('admin/anggaran/saldo-all') }}",
                        "type": "POST",
                        "data": data
                    },
                
                columns: [
                    {"data" : "created_at"},
                    {"data" : "kode"},
                    {"data" : "jumlah"},
                    {"data" : "deskripsi"},
                    {"data" : "action"},
                ]
            });
        }

        $('[data-toggle="tooltip"]').tooltip();
        $('.btnFilter').on('click',function(){
            $('.loader').show();
            initDatatable();
            $('.loader').hide();
        });
        $('.btn-pdf').on('click',function(){
            $('#is_pdf').val(1);
            $('#frmFilter').submit();
        });
        $('.btnAdd').on('click', function (e) {
            $('#frmAdd').attr('action',"{{route('anggaran.saldo.store')}}");
            $('#frmAdd').append('<div id="method"></div>');
            $('#method').html('{{ method_field("POST") }}');
            $('#titleUpdate').html("Tambah Saldo Awal");
            $('#created_at').val('');
            $('#masjid').val(null).trigger('change');
            $('#account').val(null).trigger('change');
            $('#jumlah').val(0);
            $('#terbilang-input').val('');
            $('#terbilang-output').val('');
            $('#deskripsi').val('');
            $('#createLaporanModal').modal('show');
        });
        $('.btnEdit').on('click', function (e) {
            var id = $(this).data('id');
                $('#frmAdd').attr('action','{{ url("admin/anggaran/saldo") }}/'+id);
                $('#frmAdd').append('<div id="method"></div>');
                $('#method').html('{{ method_field("PATCH") }}');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/anggaran/saldo') }}/"+id,
                    success: function (response) {
                        $('#created_at').val(response.created_at);
                        $('#masjid').append(response.masjid).trigger('change');
                        $('#account').val(response.account).trigger('change');
                        $('#jumlah').val(response.jumlah);
                        $('#terbilang-input').val(response.jumlah);
                        $('#deskripsi').val(response.deskripsi);
                        inputTerbilang();
                    }
                });
                $('#titleUpdate').html("Edit Saldo Awal");
                $('#createLaporanModal').modal('show');
        });

        $(document).on('click','.btnDelete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apa anda yakin?',
                    text: "Data akan dihapus",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "{{ url('admin/anggaran/saldo') }}/"+id,
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                '_method' : 'DELETE',
                            },
                            dataType: "json",
                            success: function (response) {
                                if(response == 1){
                                    initDatatable();
                                    Swal.fire('Data terhapus!', {
                                    icon: 'success',
                                    });
                                }
                            }
                        });
                    }
                });
            });
    });

</script>
@endsection
