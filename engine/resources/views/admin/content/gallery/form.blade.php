@extends('layouts.back.base')

@section('page_title')
{{@$gallery ? 'Edit gallery' : 'Tambah gallery'}}
@endsection



@section('content')
<div id="content-header">
    <h2 class="tour-step-one"><span>{{@$gallery ? 'Edit Gallery' : 'Tambah Gallery'}}</span></h2>
    <p><a>Dashboard</a> / <a> Gallery </a> / {{@$gallery ? 'Edit Gallery' : 'Tambah Gallery'}}</p>
</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div style="mt-5" class="card">
                <form action="{{@$gallery? route('gallery.update',$gallery) : route('gallery.store')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{ @$gallery ? method_field('PUT') : '' }}

                    <div class="card-body">
                        <div class="clone">
                            <div class="cloneitem">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group m-b-15">
                                            <label for="simpleinput">Keterangan Gambar</label>
                                            <input type="text" id="simpleinput" class="form-control" name="title[]"
                                                value="{{@$gallery->title ?? '-'}}">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row" data-preview="0">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="example-textarea">Gambar Banner</label>

                                                <div class="input-group">
                                                    <input type="file" accept="image/*" name="image[]"
                                                        class="file-preview" onchange="readURL(this,$(this));">
                                                    {{-- <input type="file" class="file" accept="image/*" name="image" value="{{@$banner->image}}">
                                                    <input type="text" id="file" class="form-control file-text" disabled
                                                        placeholder="Nama File" name="image"
                                                        value="{{@$gallery->image}}">
                                                    <div class="input-group-append">
                                                        <button type="button" class="browse btn btn-primary">Pilih
                                                            Gambar</button>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="example-textarea">Pratinjau Gambar</label>
                                            @if (isset($gallery))

                                            <img src="{{asset('uploads')}}/gallery/{{@$gallery->image}}" alt=""
                                                id="preview" class="img-fluid">
                                            @else
                                            <div class="preview-image">
                                                <h5 center>Pratinjau Gambar</h5> <br>
                                            </div>
                                            <img src="" alt="" id="preview" class="img-fluid">
                                            @endif
                                        </div>
                                        <div class="col-md-3"><button type="button"
                                                class="btn btn-danger delete_image d-none" style="margin-top:5rem">Hapus
                                                Gambar</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!@$gallery)
                        <div class="col-md-12"><button type="button" id="copy" class="btn btn-primary btn btn-large"
                                style="display:inherit;margin: 0 auto;margin-top: 10px;"><i class="fa fa-plus"></i>
                                Tambah Gambar</button></div>
                        @endif
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary pull-right" style="padding:10px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var counter = 0;

    // $(document).on("click", ".browse", function () {
    //     $(".file").click()
    // });
    // $('input[type="file"]').change(function (e) {
    //     $('.preview-image').remove();
    //     var fileName = e.target.files[0].name;
    //     $("#file").val(fileName);

    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //         // get loaded data and render thumbnail.
    //         document.getElementById("preview").src = e.target.result;
    //     };
    //     // read the image file as a data URL.
    //     reader.readAsDataURL(this.files[0]);
    // });

    $('#copy').on('click', function () {
        counter = counter + 1;
        var clone = $('.clone .cloneitem:first').clone();
        clone.find('.file-preview').val('');
        clone.find('#simpleinput').val('');
        clone.find('img').attr("src", '');
        clone.find('.delete_image').removeClass('d-none');
        clone.find('.preview-image').show();
        clone.appendTo('.clone').attr('data-preview', counter);
        $('.delete_image').click(function(){
            $(this).parent().closest('.cloneitem').remove();
        })
    });

    function readURL(input, el) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                el.parents().eq(3).find('.preview-image').hide();
                el.parents().eq(3).find("img").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }






</script>

@endsection
