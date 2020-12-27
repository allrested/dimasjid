@extends('layouts.back.base')

@section('page_title')
{{@$album ? 'Edit Album' : 'Tambah Album'}}
@endsection



@section('content')
<div id="content-header">
    <h2 class="tour-step-one"><span>{{@$album ? 'Edit Album' : 'Tambah Album'}}</span></h2>
    <p><a>Dashboard</a> / <a> Album </a> / {{@$album ? 'Edit Album' : 'Tambah Album'}}</p>
</div><!-- end #content-header -->

<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div style="mt-5" class="card">
                <form action="{{@$album? route('album.update',$album) : route('album.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ @$album ? method_field('PUT') : '' }}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-b-15">
                                    <label for="simpleinput">Nama Album</label>
                                    <input type="text" class="form-control" name="title" value="{{@$album->title}}">
                                </div>
                            </div>
                            @if(Auth::user()->role == 1)
                            <div class="col-md-12">
                                <div class="form-group m-b-15">
                                    <label for="simpleinput">Id Balai</label>
                                    <select name="id_balai" class="form-control">
                                        @foreach($balais as $balai)
                                            <option {{ @$album->id_balai == $balai->id? 'selected' : '' }} value="{{ $balai->id }}">{{ $balai->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                                <input type="hidden" name="id_balai" value="{{ Auth::user()->id_balai }}">
                            @endif
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

@endsection
