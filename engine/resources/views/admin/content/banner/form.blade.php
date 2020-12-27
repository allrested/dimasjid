@extends('layouts.back.base')

@section('page_title')
{{@$banner ? 'Edit Banner' : 'Tambah Banner'}}
@endsection

@section('content')


<div id="content-header">
    <h2 class="tour-step-one"><span>{{@$banner ? 'Edit Banner' : 'Tambah Banner'}}</span></h2>
    <p><a>Dashboard</a> / <a> Banner </a> / {{@$banner ? 'Edit Banner' : 'Tambah Banner'}}</p>
</div><!-- end #content-header -->

@include('include.alert')
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div style="margin-top:-40px" class="card">
                <form action="{{@$banner? route('banner.update',$banner) : route('banner.store')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{ @$banner ? method_field('PUT') : '' }}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-b-15">
                                    <label for="simpleinput">Judul</label>
                                    <input type="text" id="simpleinput" class="form-control" name="title"
                                        value="{{@$banner->title}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-textarea">Gambar Banner</label>
                                    <div class="input-group">
                                        <input type="file" class="file" accept="image/*" name="image"
                                            value="{{@$banner->image}}">
                                        <input type="text" class="form-control" disabled placeholder="Nama File"
                                            id="file" name="gambar_banner" value="{{@$banner->image}}">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Pilih Gambar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-b-15">
                                    <label for="example-textarea">Caption</label>
                                    <textarea class="form-control" id="example-textarea" rows="5"
                                        name="caption">{{@$banner->caption}}</textarea>
                                </div>

                                <div class="form-group m-b-15">
                                    <label for="example-textarea">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ @$banner->status == 1 ? 'selected' : ''}}>Aktif</option>
                                        <option value="0" {{ @$banner->status == 0 ? 'selected' : ''}}>Non Aktif</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="example-textarea">Pratinjau Gambar</label>
                                @if (isset($banner))

                                <img src="{{asset('assets-front')}}/images/banner/{{@$banner->image}}" alt=""
                                    id="preview" class="img-fluid">
                                @else
                                <div class="preview-image">
                                    <h5 center>Pratinjau Gambar</h5>
                                </div>
                                <img src="" alt="" id="preview" class="img-fluid">
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary pull-right"
                            style="padding:10px;">{{@$banner ? 'Edit' : 'Tambah'}}</button>
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
