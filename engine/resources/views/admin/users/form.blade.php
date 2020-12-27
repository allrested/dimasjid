@extends('layouts.back.base')

@section('page_title')
{{@$user ? 'Edit Pengguna' : 'Tambah Pengguna'}}
@endsection
@push('custom_script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('.select2').select2({
                "language": {
                    "noResults": function(){
                        return "Tidak Ditemukan";
                    }
                },
                escapeMarkup: function (markup) {
                    return markup;
                }
            });
            
        });
    </script>
@endpush
@push('styles')
<style>
    .select2-container{
        width: 100% !important;
    }
</style>
@endpush
@section('content')

<div id="content-header">
    <h2 class="tour-step-one"><span>{{ @$user ? 'Edit Pengguna' : 'Buat Pengguna'}}</span></h2>
    <p><a>Dashboard</a> / <a> Pengguna </a> / {{@$user ? 'Edit Pengguna' : 'Buat Pengguna'}}</p>
</div>
@include('include.alert')
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div style="margin-top:-40px" class="card">
                <form action="{{ @$user ? route('users.update',$user->id): route('users.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{ @$user ? method_field('PUT') : '' }}
                    <div class="card-body" style="padding-bottom:20px">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="" class="label-control">Jenis Akses</label>
                                    <select name="role" class="form-control" id="role">
                                        <option value="">Pilih Role</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" {{ @$user->role == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="" class="label-control">Pilih Masjid</label>
                                    <select name="is_superuser" class="form-control select2">
                                        @if(auth()->user()->role == 1)
                                        <option value="0">Admin Pusat</option>
                                        @endif
                                        @foreach ($masjid as $item)
                                            <option value="{{ $item->id }}" {{ @$user->is_superuser == $item->id ? 'selected' : ''}}>{{ $item->wilayah.' - '.$item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="label-control">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ @$user->name }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="label-control"> Email </label>
                                    <input type="email" name="email" id="email" value="{{ @$user->email }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for=""password class="label-control">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="***">
                                </div>

                                <div class="form-group">
                                    <label for="konfirmasi" class="label-control"> Konfirmasi Password </label>
                                    <input type="password" name="konfirmasi" id="konfirmasi" class="form-control" placeholder="***">
                                </div>

                                @if(auth()->user()->role == 1)
                                <div class="form-group">
                                    <label for="is_active" class="label-control">Status</label>
                                    <select name="is_active" class="form-control" id="is_active">
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ @$user->is_active == 1 ? 'selected' : ''}}>Aktif</option>
                                        <option value="0" {{ @$user->is_active == 0 ? 'selected' : ''}}>Tidak Aktif</option>
                                    </select>
                                </div>
                                @endif

                            </div>
                           
                        </div>
                    </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary pull-right" style="padding:10px;">Simpan</button>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
