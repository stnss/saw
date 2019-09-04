@extends('layout')

{{-- Start Content --}}
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Laporan Ranking Guru</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Tahun Ajaran</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['action' => 'LaporanController@laporanRanking', 'method' => 'POST']) }}
                            {{csrf_field()}}
                            <div class="form-group col-sm-6">
                                {{Form::label('title_nama', 'Tahun Awal')}}
                                <select name="tahun_awal" class="form-control">
                                    <option value="">Tahun Awal</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{$item->tahun_ajaran}}">{{$item->tahun_ajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                {{Form::label('title_nama', 'Tahun Akhir')}}
                                <select name="tahun_akhir" class="form-control">
                                    <option value="">Tahun Awal</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{$item->tahun_ajaran}}">{{$item->tahun_ajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                {{Form::label('title_nama', 'Semester Awal')}}
                                <select name="semester_awal" class="form-control">
                                    <option value="">Semester Awal</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                {{Form::label('title_nama', 'Semester Akhir')}}
                                <select name="semester_akhir" class="form-control">
                                    <option value="">Semester Awal</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            {{Form::button('<i class="fa fa-save"></i>&nbsp;&nbsp;Save', ['type' => 'submit', 'class' => 'btn btn-primary'])}}
                        {{ Form::close() }}
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

{{-- <script> --}}
    // $(document).ready(function() {
    //     $('#guru').DataTable();
    // });
{{-- </script> --}}
@endsection
{{-- End JS --}}
