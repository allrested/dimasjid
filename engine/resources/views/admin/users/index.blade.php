@extends('layouts.back.base')

@section('page_title','Daftar Pengguna')

@section('content')
<!-- Header -->
<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Daftar Pengguna</h1>
                <p>Manajemen Pengguna Aplikasi SISTAMAS</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
        <a href="{{ route('users.create') }}"><button class="btn btn-success pull-right" type="button">Tambah Akses</button></a>
        </div>
    </div>

</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content">
    <div class="team-tablist-content tab-content">
        <div role="tabpanel" class="tab-pane active" id="d-tables">
            <div class="row">
                <div class="main-table-card col-md-12 m-b-30">
                    <div class="main-t-table table-responsive ">
                        <table class="table display" id="data-table">
                            <thead>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Akses</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @php
                                $masjid = 'Admin Pusat';
                                if($user->masjid || $user->role != 1){
                                    try{
                                        $masjid = $user->masjid->nama . ' - '. $user->masjid->wilayah;
                                    } catch (Exception $e) {
                                        $masjid = '-';
                                    }
                                }
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $masjid }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->is_active == 1)
                                            @if ($user->role == 1)
                                                <span class="btn btn-primary">{{ $user->roles->name }}</span>
                                            @elseif ($user->role == 2)
                                                <span class="btn btn-secondary">{{ $user->roles->name }}</span>
                                            @else
                                                <span class="btn btn-info">{{ $user->roles->name }}</span>
                                            @endif
                                        @else
                                            <a href="#">
                                                <button type="button" class="btn btn-danger btnActive" data-id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Aktifkan" >Aktivasi</button>
                                            </a>
                                            <form action="{{route('users.active')}}" method="POST"
                                            class="d-none" id="formActive-{{$user->id}}">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                @csrf
                                                @method('POST')
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit',$user->id)}}">
                                            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit" ><i
                                                    class="dripicons-pencil"></i></button>
                                        </a>
                                        <a href="{{ route('users.destroy',$user)}}">
                                            <button type="button" class="btn btn-danger btnDelete" data-id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="dripicons-trash"></i></button>
                                        </a>
                                        <form action="{{route('users.destroy',$user)}}" method="POST"
                                        class="d-none" id="formDelete-{{$user->id}}">
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
    </div>
</div><!-- end #main-content -->
<script>
    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $('.btnDelete').on('click', function (e) {
            var id = $(this).data('id');
            e.preventDefault();
            var parent = $(this).parent();

            Swal.fire({
                title: 'Apakah anda yakin?',
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

        $('.btnActive').on('click', function (e) {
            var id = $(this).data('id');
            e.preventDefault();
            var parent = $(this).parent();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Akun akan divalidasi",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.value) {
                    $("#formActive-" + id).submit();
                }
            })
        });
    });

</script>
@endsection
