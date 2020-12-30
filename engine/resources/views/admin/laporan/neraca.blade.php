@extends('layouts.front.print')

@section('page_title','Laporan Neraca')
@push('css')
<style>
    @media print{
        .border-0{border:0!important}.border-top-0{border-top:0!important}.border-right-0{border-right:0!important}.border-bottom-0{border-bottom:0!important}.border-left-0{border-left:0!important}
    }
</style>
@endpush
@section('content')
<h3 class="text-center">Laporan Neraca</h3>
<h4 class="text-center">{{ $masjid->nama }}</h4>
<h5 class="text-center">{{ $filters }}</h5>
<table class="table table-bordered table-striped"  id="tabel">
    <thead>
    <tr>
        <th class="text-center" colspan="2">Keterangan</th>
        <th class="text-center">Total (Rp.)</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($akun as $key => $val)
            <tr>
                @if(strlen($val->kode) < 4)
                <td colspan="2">{{ $val->nama }}</td>
                @else
                <td class="border-right-0"></td>
                <td class="border-left-0">{{ $val->nama }}</td>
                @endif
                <td class="text-right">{{ number_format($val->jumlah,0) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection