@extends('layout')

{{-- Start Content --}}
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Cetak Keputusan Guru</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['action' => 'KeputusanGuru@store', 'method' => 'POST']) }}
                            {{csrf_field()}}
                            <div class="form-group col-sm-6">
                                {{Form::label('title_nama', 'Tahun Keputusan')}}
                                <select name="tahun" class="form-control" required>
                                    <option value="">Tahun Keputusan</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{$item->tahun_ajaran}}">{{$item->tahun_ajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                {{Form::label('title_nama', 'Semester')}}
                                <select name="semester" class="form-control" required>
                                    <option value="">Semester</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            {{Form::button('<i class="fa fa-spinner"></i>&nbsp;&nbsp;Proses', ['type' => 'submit', 'class' => 'btn btn-primary'])}}
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
