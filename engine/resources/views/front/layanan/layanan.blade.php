@extends('layouts.front.base')
@section('content')

<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title mb-4"> Layanan SISTAMAS</h4>
                <p class="text-muted"><span class="text-primary font-weight-bold"></span>
                </p>
                    <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                        <li><a href="{{ url('/')}}" class="text-uppercase font-weight-bold text-dark">Beranda</a></li>
                        <li>
                            <span class="text-uppercase text-primary font-weight-bold">Layanan SISTAMAS</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Hero End -->

<!-- Layanan Masyarakat Start -->
<section class="section">
    <div class="container">
        <div class="col-lg-12">
            
            @include('include.alert')
            <div class="row justify-content-md-center">
                <div class="col mt-12 pt-2">
                    <form>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select name="layanan" id="selectorlayanan" class="form-control"
                                    style=" height:70px; font-size:large">
                                    <option value="">Pilih Layanan SISTAMAS</option>
                                    <option value="daftar_masjid">Daftarkan Masjid</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <!--end form-->
                </div>
                <!--end col-->
            </div>

            {{-- form layanan--}}
            <div class="row formlayanan" id="daftar_masjid">
                <div class="col mt-4 pt-2">
                    <div class="component-wrapper rounded shadow">
                        <div class="p-4 border-bottom">
                            <h4 class="title mb-0"> Pendaftaran Masjid </h4>
                        </div>

                        <div class="p-4">
                            <form action="{{url('/layanan/daftar_masjid')}}" method="POST" autocomplete="off">
                                @csrf
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Daerah <span class="text-danger">*</span></label>
                                            <select name="wilayah" id="wilayah" class="custom-select form-control" required>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kode Masjid</label>
                                            <input type="text" name="kode" id="kode" class="form-control" style="font-size:large"
                                                class="validate-required" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Masjid <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="nama"
                                                class="validate-required" style="font-size:large" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat <span class="text-danger">*</span></label>
                                            <textarea name="alamat" id="alamat" rows="4" class="form-control pl-10"
                                                style="font-size:large" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap Admin <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name"
                                                class="validate-required" style="font-size:large" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="email"
                                                class="validate-required" style="font-size:large" required>
                                        </div>
                                    </div>

                                </div>
                                <!--end row-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" id="submit" name="send"
                                            class="btn btn-primary form-control" value="Kirim Permintaan">
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                            <!--end form-->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>

        </div>
    </div>

</section>
<!--end section-->

@endsection


@push('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script type="text/javascript">
    $(function () {

            $('.formlayanan').hide();

            $('#selectorlayanan').change(function () {
                $('.formlayanan').hide();
                $('#' + $(this).val()).show();
            });
        });
$(document).ready(function(){
    // Select your input element.
    var kode = document.getElementById('kode');
    // Listen for input event on numInput.
    kode.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106)
        || (e.keyCode > 47 && e.keyCode < 58) 
        || e.keyCode == 8)) {
            return false;
        }
    }
    $('#wilayah').select2({
        theme: "bootstrap",
        placeholder: 'Pilih Daerah',
        maximumSelectionSize: 6,
        containerCssClass: ':all:',
        width: '100%',
        "language": {
            "noResults": function(){
                return "Tidak Ditemukan";
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        ajax: {
            url: '{{ url("layanan/masjid_daerah") }}',
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
})
</script>
@endpush
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush