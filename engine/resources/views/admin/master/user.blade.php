@extends('layout.master')
@section('title', 'Data User')
@push('custom-scripts')
    <script>
        $(document).ready(function () {
            var myTable = $('#usertable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('user.all') }}",
                columns: [
                    {"data" : "rownum",'searchable' : 'false'},
                    {"data" : "username"},
                    {"data" : "email"},
                    {"data" : "created_at"},
                    {"data" : "action"},
                ]
            });
            $('.btn-add').click(function (e) {
                e.preventDefault();
                $('#role').val('');
                $('#username').val('');
                $('#password').val('');
                $('#email').val('');
                $('#name').val('');
                $('#modalUser').modal('show');
                $('#btn-submit').val('Tambah User');
                $('.modal-title').text('Tambah User');
            });

            $('#formUser').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var url = "{{url('/user')}}";
                if($('#btn-submit').val() == 'Ubah User'){
                    url = "{{url('/user-update')}}/"+id;
                }
                console.log(url);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: $('#formUser').serialize(),
                    success: function (response) {
                        console.log(response);

                        if(response == 1){
                            $('#modalUser').modal('hide');
                            myTable.ajax.reload( null, false );
                            var msg = "User berhasil ditambahkan!";
                            if($('#btn-submit').val() == 'Ubah User'){
                                msg = "User berhasil diubah!";
                            }
                            new PNotify({
                                title: 'Success notice',
                                text: msg,
                                icon: 'icofont icofont-info-circle',
                                type: 'success'
                            });
                        }
                    },
                    error : function (request, status, error) {
                        console.log(request.responseJSON);
                        // $.each(request.responseJSON.errors, function(key, value){
                        //     console.log(key);
                        // });
                    }
                });
            });
            $(document).on('click','.editUser', function () {
                var id = $(this).data('id');

                $('#btn-submit').val('Ubah User');
                $('.modal-title').text('Ubah User');
                $.ajax({
                    type: "get",
                    url: "{{url('user')}}"+'/'+id,
                    success: function (response) {
                        console.log(response);
                        $('#id').val(response.id);
                        $('#role').val(response.role);
                        $('#username').val(response.username);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#is_superuser').val(response.is_superuser);
                        $('#is_active').val(response.is_active);
                        $('#modalUser').modal('show');
                    }
                });
            });
            $(document).on('click','.deleteUser', function () {
                var id = $(this).data('id');

                $('#id').val(id);
                $('#delete-modal').modal('show');
            });

            $(document).on('click','.btn-confirm-delete', function () {
                var id = $('#id').val();
                $.ajax({
                    type: "delete",
                    url: "{{url('/user')}}"+'/'+id,
                    data: {
                        '_token' : '{{csrf_token()}}'
                    },
                    success: function (response) {
                        if(response == 1){
                            // Swal.fire(
                            //     'Deleted!',
                            //     'Data dihapus.',
                            //     'success'
                            // )
                            $('#delete-modal').modal('hide');
                            myTable.ajax.reload( null, false );
                        }
                    }
                });
            });
        });
    </script>
@endpush
@section('content')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalUser" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formUser" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header bg-primary">
                        <h3 class="modal-title text-white">Input User</h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">Fields with * are required</p><br>
                        <div class="form-group">
                            <label for="role">Bidang <span class="text-danger">*</span></label>
                            <select class="custom-select" name="role" id="role">
                                <option value = "" selected="selected">...Pilih Bidang...</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>  
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary btn-sm btn-submit" id="btn-submit" value="Tambah User">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <i class="mdi mdi-alert-outline mdi-6x text-warning"></i>
                        <h4 class="text-black font-weight-medium mb-4">Peringatan !</h4>
                        <p class="text-center text-dark">Data yang akan Anda hapus tidak dapat dikembalikan. Apakah Anda yakin data akan dihapus?</p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-sm btn-link text-black component-flat" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning btn-sm btn-confirm-delete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    {{--end modal--}}
    <div class="main-content">
         <div class="card-box shadow-sm card-breadcrumb">
            <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manage User
                </li>
            </ol>
        </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box shadow-sm">
                        <div class="card-title" style="padding: 10px 10px">
                            <div class="btn btn-primary has-icon float-right btn-add" data-toggle="modal" data-target="#modalUser"><i class="mdi mdi-plus"></i>Tambah User</div>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="table-responsive">
                                    <table id="usertable" class="data-table table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Tanggal Registrasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     
    </div>
@endsection