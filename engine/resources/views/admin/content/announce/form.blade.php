@extends('layouts.back.base')

@section('page_title')
{{@$announce ? 'Edit Pengumuman' : 'Tambah Pengumuman'}}
@endsection

@push('custom_script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            placeholder: 'Isi Pengumuman',
            height: 300
        });
    });

</script>
@endpush


@section('content')

    <div id="content-header">
        <h2 class="tour-step-one"><span>{{@$announce ? 'Edit Pengumuman' : 'Tambah Pengumuman'}}</span></h2>
        <p><a>Dashboard</a> / <a> Pengumuman </a> / {{@$announce ? 'Edit Pengumuman' : 'Tambah Pengumuman'}}</p>
    </div><!-- end #content-header -->
    @include('include.alert')
    <div id="main-content">
        <div class="row">
            <div class="col-md-12">
                <div style="mt-5" class="card">
                    <form action="{{@$announce? route('announce.update',$announce) : route('announce.store')}}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ @$announce ? method_field('PUT') : '' }}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-b-15">
                                        <label for="simpleinput">Judul Pengumuman</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{@$announce->title}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group m-b-15">
                                        <label for="example-textarea">Isi Pengumuman</label>
                                        <textarea class="summernote form-control"
                                            name="caption">{{@$announce->caption}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary pull-right"
                                style="padding:10px;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".browse", function () {
            $(".file").click()
        });
        $('input[type="file"]').change(function (e) {
            $('.preview-image').remove();
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

    </script>

@endsection
