@extends('layouts.back.base')

@section('page_title','Saldo Awal')
@push('custom_script')
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
            <form action="{{ route('anggaran.print') }}" id="frmFilter" method="post">
                    @csrf
                    <input type="hidden" name="is_pdf" value="0" id="is_pdf">
                    <input type="hidden" name="tipe" value="neraca" id="tipe">
                    <div class="row">
                        @if (auth()->user()->role == 1 )
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="masjidFilter">Masjid</label>
                                <select id="masjidFilter" class="masjid form-control" name="masjid" required>
                                </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="masjid" id="masjidFilter" value="{{ Auth()->user()->is_superuser}}">
                        @endif
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select id="tahun" class="pilihan form-control" name="tahun">
                                    <option value="">Semua Data</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{ $item->year }}" {{ Request::get('tahun') == $item->year ? 'selected' : ''}}>{{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <a href="#" class="btn btn-info btn-icon icon-left btnFilter" style="margin-top:32px">
                                <i class="entypo-search"></i>
                                Filter
                            </a>
                        </div>
                        
                        <div class="col-md-1">
                                <button type="button" role="group" class="btn btn-danger btn-group mb-3 dropdown-toggle"  style="margin-top:32px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laporan</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="neraca"><span>Laporan Neraca (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="neraca"><span>Laporan Neraca (PDF)</span></button>
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="operasional"><span>Laporan Operasional (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="operasional"><span>Laporan Operasional (PDF)</span></button>
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="kas"><span>Laporan Arus Kas (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="kas"><span>Laporan Arus Kas (PDF)</span></button>
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="calk"><span>Laporan Calk (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="calk"><span>Laporan Calk (PDF)</span></button>
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="penerimaan"><span>Laporan Kas Penerimaan (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="penerimaan"><span>Laporan Kas Penerimaan (PDF)</span></button>
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="pengeluaran"><span>Laporan Kas Pengeluaran (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="pengeluaran"><span>Laporan Kas Pengeluaran (PDF)</span></button>
                                    <button type="button" class="dropdown-item buttons-excel buttons-html5" data-tipe="periode"><span>Laporan Kas Harian (xlsx)</span></button>
                                    <button type="button" class="dropdown-item btn-pdf buttons-html5" data-tipe="periode"><span>Laporan Kas Harian (PDF)</span></button>
                                </div>
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
                                    <select name="masjid" class="custom-select" id="masjid" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="account">Kode Rekening</label>
                                    <select name="account" class="custom-select" id="account" required>
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

        $('.masjid').select2({
            theme: "bootstrap",
            placeholder: 'Pilih Masjid',
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
                url: '{{ url("admin/anggaran/saldo-masjid") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.nama+" - "+item.wilayah,
                            id: item.id
                        }
                    })
                };
                },
                cache: true
            }
        });

        $('#account').select2({
            theme: "bootstrap",
            placeholder: 'Pilih Rekening Akun',
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
                url: '{{ url("admin/anggaran/saldo-akun") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.kode+" - "+item.nama,
                            id: item.id
                        }
                    })
                };
                },
                cache: true
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
                "language": {
                    "url": "/assets-back/js/DataTables/Indonesian.json"
                },
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
                    {"data" : "kode","searchable": false},
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
        });
        $('.buttons-html5').on('click',function(){
            var tipe = $(this).data('tipe');
            $('#tipe').val(tipe);
            $('#frmFilter').submit();
        });
        $('#frmFilter').on('submit',function(){
            var allIsOk = true;
            var masjid = $('#masjidFilter').val();

            if(!masjid || masjid == 0){
                Swal.fire('Pilih Masjid Terlebih dahulu!', {
                    icon: 'warning',
                });
                $('#masjidFilter').focus();
                allIsOk = false;
            }
            return allIsOk;
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
        $(document).on('click','.btnEdit', function (e) {
            var id = $(this).data('id');
                $('#frmAdd').attr('action','{{ url("admin/anggaran/saldo") }}/'+id);
                $('#frmAdd').append('<div id="method"></div>');
                $('#method').html('{{ method_field("PATCH") }}');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/anggaran/saldo') }}/"+id,
                    success: function (response) {
                        $('#created_at').val(response.created_at);
                        var opTionMasjid = new Option(response.nama_masjid, response.masjid, true, true);
                        $('#masjid').append(opTionMasjid).trigger('change');
                        var optionAkun = new Option(response.nama_akun, response.account, true, true);
                        $('#account').append(optionAkun).trigger('change');
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
