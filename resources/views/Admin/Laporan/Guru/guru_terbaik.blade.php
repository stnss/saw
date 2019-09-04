@extends('layout')

{{-- Start Content --}}
@section('content')
@include('Include.message')

<div class="page-title">
    <h3 class="breadcrumb-header">Guru Terbaik</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            @foreach ($data as $index => $item)
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading clearfix">
                        @foreach ($item as $key2 => $item2)
                            <h2 class="panel-title">Guru Terbaik Tahun {{$item2['tahun_ajaran']}} Semester {{$item2['semester']}}</h2>
                            @break
                        @endforeach
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table id="guru" class="guru display responsive nowrap" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th width="10%">Kode Guru</th>
                                        <th>Nama Guru</th>
                                        @foreach ($item as $key2 => $item2)
                                                @foreach ($item2['hasil'] as $key4 => $item4)
                                                    <th>{{$item4['nama_kriteria']}}</th>
                                                @endforeach
                                                @break
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item as $key => $item2)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$item2['nama_guru']}}</td>
                                            @foreach ($item2['hasil'] as $item3)
                                                <td>{{$item3['nilai_preferensi']}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                    </div>
                    <div class="panel-body">
                        <a href="{{ url('laporanguru/output') }}" class="btn btn-primary">Print</a>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
</div><!-- Main Wrapper -->
@endsection
{{-- End Content --}}

{{-- Start CSS --}}
@section('css')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection
{{-- End CSS --}}

{{-- Start JS --}}
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
         $('.guru').DataTable();
    });
</script>
@endsection
{{-- End JS --}}
