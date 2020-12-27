@extends('layouts.back.base')

@section('page_title','Agenda')
@push('custom_script')
<link href='{{asset('assets-back')}}/fullcalendar/core/main.css' rel='stylesheet' />
<link href='{{asset('assets-back')}}/fullcalendar/daygrid/main.css' rel='stylesheet' />
<script src='{{asset('assets-back')}}/fullcalendar/core/main.js'></script>
<script src='{{asset('assets-back')}}/fullcalendar/interaction/main.js'></script>
<script src='{{asset('assets-back')}}/fullcalendar/daygrid/main.js'></script>
<script src='{{asset('assets-back')}}/fullcalendar/locale/id.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('kalender');

        var calendar = new FullCalendar.Calendar(calendarEl, {
           plugins: ['dayGrid'],
               header: {
                   left: 'prevYear,prev,next,nextYear today',
                   center: 'title',
                   right: 'dayGridMonth,dayGridWeek,dayGridDay'
               },
               navLinks: true, // can click day/week names to navigate views
               editable: true,
               eventLimit: true, // allow "more" link when too many events
               locale: 'id',
               events: [
                   @foreach($agendas as $agenda)
                   {
                       title: '{{$agenda->title}}',
                       start: '{{$agenda->time_start->format('Y-m-d')}}',
                   },
                   @endforeach
               ]
        });

        calendar.render();
    });

</script>
<script>
    $(document).ready(function () {
        $('#calendartab').click(function () {
            $(this).addClass('active');
            $('#cal').addClass('active');
            $(this).removeClass('active');
            $('#list').removeClass('active');
        });
        $('#listtab').click(function () {
            $(this).addClass('active');
            $('#list').addClass('active');
            $(this).removeClass('active');
            $('#cal').removeClass('active');
        });
        $('.btnDelete').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent();

            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Data akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $(".formDelete").submit();
                    Swal.fire(
                        'Berhasil!',
                        'Data telah dihapus',
                        'success'
                    )
                }
            })
        });
    });
</script>
@endpush
@section('content')
<!-- Header -->

<div id="content-header">

    <div class="row">
        <div class="col-md-9">
            <div class="header-name">
                <h1 class="tour-step-one">Agenda</h1>
                <p>Manajemen Agenda</p>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <br>
            <a href="{{route('agenda.create')}}"><button class="btn btn-success pull-right" type="button">Buat
                    Agenda</button></a>
        </div>
    </div>

</div><!-- end #content-header -->
@include('include.alert')
<div id="main-content">
    <div class="team-tablist-content tab-content">
        <div role="tabpanel" class="tab-pane active" id="d-tables">
            <div class="row">
                <!-- Beginning Tab -->
                <ul class="nav nav-tabs">
                    <li class="nav-item" id="calendartab">
                        <a class="nav-link active" href="#calendar" data-toggle="tab">Kalender</a>
                    </li>
                    <li class="nav-item" id="listtab">
                        <a class="nav-link" href="#list" data-toggle="tab">Daftar Agenda</a>
                    </li>
                </ul>
                <!-- End Of Tab -->
            </div>
            <div class="row">
                <div class="tab-content col-md-12">
                    <div class="tab-pane active mt-2" id="cal" style="padding-top:10px">
                        <div class="card-box">
                            <div class="card-body">
                                <div id='kalender'></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="list">
                        <div class="main-table-card col-md-12 m-b-30">
                            <div class="main-t-table table-responsive mt-5">
                                <table class="table display" id="data-table">
                                    <thead>
                                        <th>Image</th>
                                        <th>Judul Agenda</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Tempat</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($agendas as $agenda)
                                        <tr>
                                            <td><img src="{{ asset('uploads') }}/agenda/{{ $agenda->banner_img }}" alt=""
                                                    width="100px">
                                            </td>
                                            <td class="table-name">{{$agenda->title}}</td>
                                            <td>{{strip_tags(str_limit($agenda->content, $limit = 150, $end = '...'))}}
                                            </td>
                                            <td class="table-amount">{{$agenda->time_start->format('d M, Y')}}</td>
                                            <td class="table-status">{{$agenda->location}}</td>
                                            <td width="200px">
                                                <a href="{{route('agenda.edit',$agenda)}}">
                                                    <button type="button" class="btn btn-warning"><i
                                                            class="dripicons-pencil"></i>Edit</button>
                                                </a>
                                                <a href="{{route('agenda.destroy',$agenda)}}">
                                                    <button type="button" class="btn btn-danger btnDelete"><i
                                                            class="dripicons-trash"></i>Hapus</button>
                                                </a>
                                                <form action="{{route('agenda.destroy',$agenda)}}" method="POST"
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
        </div>
    </div>
</div><!-- end #main-content -->
@endsection
