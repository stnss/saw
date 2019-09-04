@extends('layout')

{{-- Start Content --}}
@section('content')
@include('Include.message')

<div class="page-title">
    <h3 class="breadcrumb-header">List Data Sub Kriteria</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">List Sub Kriteria</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table id="guru" class="display responsive nowrap" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th width="10%">Kode Sub Kriteria</th>
                                    <th>Nama Sub Kriteria</th>
                                    <th width="10%">Kode Kriteria</th>
                                    <th width="15%" style="text-align:center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub as $key => $item)
                                    <tr>
                                        <td>{{$item->kd_sub}}</td>
                                        <td>{{$item->nama_sub}}</td>
                                        <td>{{$item->kd_kriteria}}</td>
                                        <td style="text-align:center">
                                            {{Form::open(['action' => ['SubKriteriaController@destroy', $item->kd_sub], 'method' => 'POST'])}}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'])}}

                                                <a href="/sub/{{$item->kd_sub}}/edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            {{Form::close()}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <a href="/sub/create" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;Tambah Sub Kriteria</a>
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
        $('#guru').DataTable();
    });
</script>
@endsection
{{-- End JS --}}
