@extends('layouts.back.base')

@section('page_title','Album')

@section('content')
<!-- Header -->
<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Album</h1>
                <p>Manajemen Album</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="{{ route('album.create') }}"><button class="btn btn-success pull-right" type="button">Tambah Album</button></a>
        </div>
    </div>

</div><!-- end #content-header -->
<div id="main-content">
    <div class="team-tablist-content tab-content">
        <div role="tabpanel" class="tab-pane active" id="d-tables">
            <div class="row">
                <div class="main-table-card col-md-12 m-b-30">
                    <div class="main-t-table table-responsive">
                        <table class="table display" id="data-table">
                            <thead>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($albums as $album)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="table-name">{{$album->title}}</td>
                                    <td width="300px">
                                        <a href="{{url('admin/album/'.$album->id.'/gallery')}}">
                                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Gallery"><i
                                                    class="dripicons-camera"></i></button>
                                        </a>
                                        <a href="{{route('album.edit',$album->id)}}">
                                            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="dripicons-pencil"></i></button>
                                        </a>
                                        <a href="{{route('album.destroy',$album)}}">
                                            <button type="button" class="btn btn-danger btnDelete" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="dripicons-trash"></i></button>
                                        </a>
                                        <form action="{{route('album.destroy',$album)}}" method="post"
                                            class="formDelete d-none">
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
            e.preventDefault();
            var parent = $(this).parent();

            swal({
                    title: "Apa anda yakin?",
                    text: "Data album dihapus",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then(function (willDelete) {
                    if (willDelete) {
                        $(".formDelete").submit();
                    }
                });
        });
    });
</script>
@endsection
